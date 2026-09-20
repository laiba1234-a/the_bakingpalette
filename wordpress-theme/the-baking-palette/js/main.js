document.addEventListener('DOMContentLoaded', () => {
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Mobile nav toggle
  const navToggle = document.querySelector('.nav-toggle');
  const navLinks = document.querySelector('.nav-links');

  if (navToggle && navLinks) {
    navToggle.setAttribute('aria-expanded', 'false');

    navToggle.addEventListener('click', () => {
      const open = navToggle.classList.toggle('open');
      navLinks.classList.toggle('open', open);
      // Tell screen readers whether the menu is currently open.
      navToggle.setAttribute('aria-expanded', String(open));
    });

    navLinks.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        navToggle.classList.remove('open');
        navLinks.classList.remove('open');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  // Active nav link is set server-side by WordPress (current-menu-item class
  // via wp_nav_menu), so there's no client-side page-matching needed here.

  // Scroll reveal animation
  const revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && revealEls.length) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15 }
    );
    revealEls.forEach((el) => observer.observe(el));
  } else {
    revealEls.forEach((el) => el.classList.add('visible'));
  }

  // Gallery lightbox
  const lightbox = document.querySelector('.lightbox');
  if (lightbox) {
    const lightboxContent = lightbox.querySelector('.lightbox-content');
    const closeBtn = lightbox.querySelector('.lightbox-close');

    // Gallery tiles that link to a cake page navigate instead of opening the
    // lightbox; the lightbox stays for tiles that are not links.
    document.querySelectorAll('.gallery-item:not(a)').forEach((item) => {
      item.addEventListener('click', () => {
        lightboxContent.innerHTML = item.innerHTML;
        lightbox.classList.add('open');
      });
    });

    const closeLightbox = () => lightbox.classList.remove('open');
    closeBtn.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeLightbox();
    });
  }

  // Filter buttons: gallery items by category, testimonials by source
  const filterBtns = document.querySelectorAll('.filter-btn');
  const filterItems = document.querySelectorAll('.gallery-item, .testimonial-card');
  if (filterBtns.length && filterItems.length) {
    filterBtns.forEach((btn) => {
      btn.addEventListener('click', () => {
        filterBtns.forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');
        const wanted = btn.dataset.filter;

        filterItems.forEach((item) => {
          // An item can belong to several groups, e.g. "wedding tiered".
          const groups = (item.dataset.category || item.dataset.source || '').split(/\s+/);
          if (wanted === 'all' || groups.includes(wanted)) {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  // Navbar shrinks + gains a stronger shadow once the page scrolls
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    const setScrolled = () => navbar.classList.toggle('scrolled', window.scrollY > 20);
    setScrolled();
    window.addEventListener('scroll', setScrolled, { passive: true });
  }

  // Floating cake/cupcake particles drifting through hero, page header & CTA sections
  if (!prefersReducedMotion) {
    const sprinkleEmojis = ['🧁', '🍰', '✨', '🍓', '🎂'];
    document.querySelectorAll('.hero, .page-header, .cta-banner').forEach((section) => {
      const wrap = document.createElement('div');
      wrap.className = 'bg-sprinkles';
      wrap.setAttribute('aria-hidden', 'true');
      const count = 8;
      for (let i = 0; i < count; i++) {
        const sprinkle = document.createElement('span');
        sprinkle.className = 'sprinkle';
        sprinkle.textContent = sprinkleEmojis[Math.floor(Math.random() * sprinkleEmojis.length)];
        sprinkle.style.setProperty('--sx', `${Math.random() * 100}%`);
        sprinkle.style.setProperty('--ssize', `${0.9 + Math.random() * 1}rem`);
        sprinkle.style.setProperty('--sdur', `${10 + Math.random() * 10}s`);
        sprinkle.style.setProperty('--sdelay', `${(Math.random() * -18).toFixed(2)}s`);
        wrap.appendChild(sprinkle);
      }
      section.prepend(wrap);
    });
  }

  // Count-up animation for the hero stat numbers
  const countEls = document.querySelectorAll('.hero-stats strong');
  if (countEls.length && !prefersReducedMotion && 'IntersectionObserver' in window) {
    const animateCount = (el) => {
      const raw = el.textContent.trim();
      const match = raw.match(/[\d.]+/);
      if (!match) return;
      const target = parseFloat(match[0]);
      const suffix = raw.slice(match.index + match[0].length);
      const duration = 1200;
      const start = performance.now();

      const step = (now) => {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        const value = Math.round(target * eased);
        el.textContent = `${value}${suffix}`;
        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          el.textContent = raw;
        }
      };
      requestAnimationFrame(step);
    };

    const countObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            animateCount(entry.target);
            countObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.6 }
    );
    countEls.forEach((el) => countObserver.observe(el));
  }

  // Subtle 3D tilt on cards as the cursor moves over them
  if (!prefersReducedMotion && window.matchMedia('(hover: hover)').matches) {
    document.querySelectorAll('.highlight-card, .testimonial-card, .menu-card').forEach((card) => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        card.style.transform = `perspective(1200px) rotateX(${y * -8}deg) rotateY(${x * 8}deg) translateY(-6px)`;
      });
      card.addEventListener('mouseleave', () => {
        card.style.transform = '';
      });
    });
  }

  // Floating "back to top" button
  const backToTop = document.createElement('button');
  backToTop.type = 'button';
  backToTop.className = 'back-to-top';
  backToTop.setAttribute('aria-label', 'Back to top');
  backToTop.textContent = '🍰';
  document.body.appendChild(backToTop);
  window.addEventListener(
    'scroll',
    () => backToTop.classList.toggle('show', window.scrollY > 480),
    { passive: true }
  );
  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: prefersReducedMotion ? 'auto' : 'smooth' });
  });

  // Instagram has no prefilled-message link like wa.me, so this button copies
  // the cake's name and link to the clipboard instead. On most phones,
  // following the link replaces the current page immediately (target="_blank"
  // is ignored by many mobile/in-app browsers), which wiped the confirmation
  // before anyone could read it. So the click is held for a beat, the "copied"
  // toast is shown, and only then does the page move on to Instagram. The
  // toast is appended straight to <body> rather than living in the page
  // markup: this page's scroll-reveal elements sit under a `filter` (even
  // `blur(0px)` at rest counts), and a `filter` on any ancestor turns it into
  // the containing block for `position: fixed` descendants, which pinned an
  // in-page toast hundreds of pixels below the viewport instead of on screen.
  document.querySelectorAll('[data-copy-text]').forEach((link) => {
    link.addEventListener('click', (event) => {
      if (!navigator.clipboard) {
        return;
      }
      event.preventDefault();
      const destination = link.href;

      const toast = document.createElement('p');
      toast.className = 'cake-copy-toast';
      toast.textContent = "Copied this cake's name and link — paste it into the Instagram chat once it opens.";
      document.body.appendChild(toast);
      requestAnimationFrame(() => toast.classList.add('is-visible'));

      // Best-effort copy: a stuck or denied clipboard permission must never
      // trap the customer on this page, so it isn't awaited before moving on.
      navigator.clipboard.writeText(link.dataset.copyText).catch(() => {});

      setTimeout(() => {
        window.location.href = destination;
      }, 1400);
    });
  });
});
