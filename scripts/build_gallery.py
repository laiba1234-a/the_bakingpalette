#!/usr/bin/env python3
"""Fold content/cakes.csv into gallery.html.

Fills in two things for every cake, matched by image filename:

  * a visible <figcaption> under its tile, so there is real text to read
  * its ImageObject entry in the page's JSON-LD

Blank CSV cells are skipped, so the file can be filled in a few rows at a
time. Re-running is safe: the script rewrites whatever it wrote last time
rather than stacking a second copy on top.

    python3 scripts/build_gallery.py
"""

import csv
import html
import io
import json
import os
import re
import sys

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
CSV_PATH = os.path.join(ROOT, 'content', 'cakes.csv')
PAGE = os.path.join(ROOT, 'gallery.html')

# Columns rendered as a labelled meta list, in the order they should appear.
META_FIELDS = [
    ('occasion', 'Occasion'),
    ('size_tiers', 'Size'),
    ('flavour', 'Flavour'),
    ('technique', 'Finish'),
    ('price_band', 'Price'),
    ('lead_time', 'Lead time'),
]

# Matches a tile in either shape: the original bare <div>, or the <figure>
# this script produces, so the first and every later run both work.
TILE = re.compile(
    r'(?:<figure class="gallery-card reveal" data-category="(?P<fcat>[^"]*)">\s*)?'
    r'<div class="gallery-item(?: reveal)?"(?: data-category="(?P<dcat>[^"]*)")?>\s*'
    r'(?P<img><img[^>]*src="images/gallery/(?P<slug>[^".]+)\.(?:webp|jpg)"[^>]*>)\s*'
    r'</div>'
    # Both halves are optional and matched separately: a tile this script has
    # already converted may or may not carry a caption, and the closing tag has
    # to be consumed either way or it accumulates on every run.
    r'(?:\s*<figcaption class="gallery-caption">.*?</figcaption>)?'
    r'(?:\s*</figure>)?',
    re.S)


def row_key(row):
    """The image filename, which is what ties a CSV row to its tile.

    Taken from `image_url` — a real link so the cake can be opened and looked at
    while its description is being written — or from a bare `slug` in an older
    copy of the file.
    """
    ref = (row.get('image_url') or row.get('slug') or '').strip()
    return os.path.splitext(os.path.basename(ref))[0]


def read_rows():
    if not os.path.exists(CSV_PATH):
        sys.exit('missing %s — nothing to build from' % CSV_PATH)
    with io.open(CSV_PATH, encoding='utf-8-sig', newline='') as f:
        rows = {}
        for r in csv.DictReader(f):
            key = row_key(r)
            if key:
                rows[key] = {k: (v or '').strip() for k, v in r.items() if k}
        return rows


def caption_html(row, indent):
    """Return a <figcaption> for this cake, or '' when the row is still blank."""
    pad = ' ' * indent
    title = row.get('title') or ''
    desc = row.get('description') or ''
    meta = [(label, row[key]) for key, label in META_FIELDS if row.get(key)]
    if not (title or desc or meta):
        return ''

    parts = ['%s<figcaption class="gallery-caption">' % pad]
    if title:
        parts.append('%s  <h3 class="gallery-caption-title">%s</h3>'
                     % (pad, html.escape(title)))
    if desc:
        parts.append('%s  <p class="gallery-caption-text">%s</p>'
                     % (pad, html.escape(desc)))
    if meta:
        parts.append('%s  <dl class="gallery-caption-meta">' % pad)
        for label, value in meta:
            parts.append('%s    <div><dt>%s</dt><dd>%s</dd></div>'
                         % (pad, html.escape(label), html.escape(value)))
        parts.append('%s  </dl>' % pad)
    parts.append('%s</figcaption>' % pad)
    return '\n'.join(parts)


def rebuild_tiles(page, rows, counts):
    def replace(m):
        slug = m.group('slug')
        category = m.group('fcat') or m.group('dcat') or ''
        row = rows.get(slug, {})
        cap = caption_html(row, 10)
        if cap:
            counts['captioned'] += 1
        counts['tiles'] += 1
        # `reveal` belongs on the grid child, not the inner tile: the staggered
        # transition delays in style.css key off `.gallery-grid .reveal:nth-child`.
        block = [
            '<figure class="gallery-card reveal" data-category="%s">' % category,
            '          <div class="gallery-item">',
            '            %s' % m.group('img'),
            '          </div>',
        ]
        if cap:
            block.append(cap)
        block.append('        </figure>')
        return '\n'.join(block)
    return TILE.sub(replace, page)


def describe(row):
    """Longest useful sentence we can hand a search or answer engine."""
    bits = []
    if row.get('description'):
        bits.append(row['description'])
    meta = ['%s: %s' % (label, row[key])
            for key, label in META_FIELDS if row.get(key)]
    if meta:
        bits.append('. '.join(meta) + '.')
    return ' '.join(bits).strip()


def rebuild_jsonld(page, rows, counts):
    """Refresh name/description/keywords on each ImageObject in the gallery list."""
    blocks = list(re.finditer(
        r'(<script type="application/ld\+json">\s*)(\{.*?\})(\s*</script>)',
        page, re.S))
    for m in reversed(blocks):
        try:
            data = json.loads(m.group(2))
        except ValueError:
            continue
        items = (data.get('mainEntity') or {}).get('itemListElement')
        if not isinstance(items, list):
            continue

        for entry in items:
            item = entry.get('item') or {}
            url = item.get('contentUrl', '')
            slug = os.path.splitext(os.path.basename(url))[0]
            row = rows.get(slug)
            if not row:
                continue

            # Fields are cleared as well as set, so emptying a row in the CSV
            # actually removes what a previous run wrote instead of stranding it.
            if row.get('alt'):
                item['caption'] = row['alt']
            item['name'] = row.get('title') or row.get('alt') or item.get('name', '')

            desc = describe(row)
            if desc:
                item['description'] = desc
            else:
                item.pop('description', None)

            kw = [row[k] for k in ('occasion', 'flavour', 'technique') if row.get(k)]
            if kw:
                item['keywords'] = ', '.join(kw)
            else:
                item.pop('keywords', None)

        counts["jsonld"] += 1
        body = json.dumps(data, indent=2, ensure_ascii=False)
        body = '\n'.join(('  ' + ln) if ln.strip() else ln
                         for ln in body.split('\n')).lstrip()
        page = page[:m.start()] + m.group(1) + body + m.group(3) + page[m.end():]
    return page


def main():
    rows = read_rows()
    page = io.open(PAGE, encoding='utf-8').read()
    before = page

    counts = {'tiles': 0, 'captioned': 0, 'jsonld': 0}
    page = rebuild_tiles(page, rows, counts)
    page = rebuild_jsonld(page, rows, counts)

    if page == before:
        print('gallery.html already up to date (%d tiles)' % counts['tiles'])
        return
    io.open(PAGE, 'w', encoding='utf-8').write(page)
    print('gallery.html updated — %d tiles, %d with captions, %d JSON-LD block(s)'
          % (counts['tiles'], counts['captioned'], counts['jsonld']))
    blank = counts['tiles'] - counts['captioned']
    if blank:
        print('%d cake(s) still blank in content/cakes.csv' % blank)


if __name__ == '__main__':
    main()
