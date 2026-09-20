# The Baking Palette — project notes

Two parallel copies of the same site live in this repo:

- **Static site** (`*.html`, `css/style.css`, `js/main.js` at repo root) —
  built from `content/cakes.csv` via `python3 scripts/build_gallery.py`
  (regenerates `gallery.html`; safe to re-run). Domain is swapped with
  `scripts/set_domain.py`. This mirror targets GitHub Pages
  (`laiba1234-a.github.io/the_bakingpalette`).
- **WordPress theme** (`wordpress-theme/the-baking-palette/`) — deployed to a
  live Hostinger install. This is the one real customers see; treat changes
  here as production changes.

They are not auto-synced. A content or style change usually needs to be made
in both places by hand.

## Local WordPress dev

```
cd wordpress-theme && docker compose up -d
```
Site: http://localhost:8792 — wp-admin: http://localhost:8792/wp-admin
If pages come back blank after the containers were already running, the
bind mount has gone stale; `docker compose restart wordpress wpcli` fixes it.

## Live site

- SSH alias: `bakingpalette` (see `~/.ssh/config`) — one Hostinger account
  hosts ~9 unrelated domains, so always confirm the target before touching
  anything. This project's site: `darkorange-narwhal-125093.hostingersite.com`
  (a temporary Hostinger preview domain), theme `the-baking-palette` active.
- WordPress root on the server:
  `/home/u136003538/domains/darkorange-narwhal-125093.hostingersite.com/public_html`
- `wp` (WP-CLI) is on the server's PATH — run it with `--path=` or `cd` into
  the WordPress root first.

### Deploying theme file changes

Sync only the files that changed, to their **exact nested destination path**.

```
rsync -avz wordpress-theme/the-baking-palette/functions.php \
  bakingpalette:/home/u136003538/domains/darkorange-narwhal-125093.hostingersite.com/public_html/wp-content/themes/the-baking-palette/functions.php
```

**Do not** pass multiple source files together with a bare directory as the
rsync destination (`rsync -avz css/style.css js/main.js user@host:theme-dir/`).
rsync flattens every source to its basename in that case, so `css/style.css`
and `js/main.js` both land loose in the theme's root — which also silently
overwrites the theme's required root `style.css` (the file holding the
`Theme Name:` header WordPress reads to recognize the theme) with the wrong
content. This happened once already; always give each file its own explicit
destination path, or use `rsync -avzR` (relative paths) from the theme
directory instead.

After syncing PHP that touches `register_post_type` or rewrite-affecting
code:
```
ssh bakingpalette "cd <wp-root> && wp rewrite flush --hard"
```

### Cake catalog data (tbp_cake posts)

Cake photos live in the theme (`images/gallery/`), referenced by filename in
post meta — not in the media library — so only post content + `_tbp_*` meta
needs to move between environments. Reuse the paired scripts:

```
# on the SOURCE site (usually local Docker):
docker compose exec -T wpcli wp eval-file /path/to/scripts/wp-cake-export.php --path=/var/www/html
docker compose cp wpcli:/tmp/cakes_export.json ./cakes_export.json

# copy to the target server, then:
scp ./cakes_export.json bakingpalette:/tmp/cakes_import.json
scp scripts/wp-cake-import.php bakingpalette:/tmp/
ssh bakingpalette "cd <wp-root> && wp eval-file /tmp/wp-cake-import.php"
```

Import matches on slug (`post_name`), so it's safe to re-run — existing cakes
get updated in place, not duplicated. The theme must already be deployed
(so `tbp_cake` is registered) and the images must already exist on the
target before importing.

### Cache — two separate layers

1. **LiteSpeed** (origin page cache): `wp litespeed-purge all`. Purges
   rendered HTML.
2. **Hostinger edge CDN** (`hcdn`, visible via the `x-hcdn-*` response
   headers, sits in front of LiteSpeed): no WP-CLI or SSH purge command has
   been found for this layer. Static assets (`css/style.css`, `js/main.js`)
   can keep serving a stale copy from some edge nodes for a while after a
   deploy, independent of the LiteSpeed purge and independent of the
   `?ver=<filemtime>` cache-busting query string the theme already adds
   automatically (some edge nodes appear to key their cache ignoring the
   query string). This resolves itself as edges naturally refetch; there is
   no known way to force it faster than that from the CLI. If a deploy needs
   to be visibly live immediately, check via hPanel's dashboard for a CDN
   purge control.

### Known pre-existing issue: intermittent 500s

The live site (Sep 2026) intermittently returns HTTP 500 on ordinary,
unrelated pages (homepage, `/menu/`, `/gallery/`, etc.) at roughly a
1-in-5 to 1-in-8 request rate, unrelated to any specific page or deploy —
retrying the same URL a moment later returns 200. This was present before
and after the cake-pages deploy and affects pages that were never touched,
so it's a hosting-side reliability issue (shared PHP-FPM/resource limits are
the likely cause), not something to chase in this repo. Worth flagging to
Hostinger support if it gets worse; not something a code change here fixes.

## Git

Branch `wordpress_site` tracks this work; `main` is the base branch. Commit
messages use `Co-Authored-By: Claude Sonnet 5 <noreply@anthropic.com>`.
