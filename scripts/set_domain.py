#!/usr/bin/env python3
"""Point the whole site at a different base URL.

Canonical tags, og:url, social images, JSON-LD and the sitemap all need
absolute URLs, so the site has to know where it lives. Until the real domain is
bought that is the GitHub Pages address; this swaps every occurrence in one go
when it changes.

    python3 scripts/set_domain.py https://thebakingpalette.pk

Run it from anywhere; paths are resolved relative to the repo.
"""

import io
import os
import re
import sys

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

# Every file that can contain an absolute site URL.
TARGETS = [
    'index.html', 'gallery.html', 'menu.html', 'testimonials.html',
    'about.html', 'sitemap.xml', 'robots.txt', 'llms.txt',
    os.path.join('content', 'cakes.csv'),
]

# Any base URL we have used before, so re-running is safe whichever one is live.
KNOWN = re.compile(
    r'https://(?:laiba1234-a\.github\.io/the_bakingpalette|'
    r'[a-z0-9.-]+\.(?:pk|com|net|org|io|github\.io)(?:/[A-Za-z0-9_-]+)?)')


def normalise(base):
    base = base.strip().rstrip('/')
    if not base.startswith('http'):
        base = 'https://' + base
    return base


def main():
    if len(sys.argv) != 2:
        sys.exit(__doc__)
    base = normalise(sys.argv[1])

    changed = []
    for name in TARGETS:
        path = os.path.join(ROOT, name)
        if not os.path.exists(path):
            continue
        text = io.open(path, encoding='utf-8').read()
        new = KNOWN.sub(base, text)
        if new != text:
            io.open(path, 'w', encoding='utf-8').write(new)
            changed.append(name)

    if not changed:
        print('nothing to change — the site already points at %s' % base)
        return
    print('base URL set to %s in:' % base)
    for name in changed:
        print('  %s' % name)
    print('\nRemember to update the website field in your Google Business '
          'Profile to match.')


if __name__ == '__main__':
    main()
