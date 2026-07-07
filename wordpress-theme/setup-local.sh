#!/bin/sh
# One-time setup for the local WordPress preview stack.
# Run this once after `docker compose up -d`; it installs WordPress,
# activates the theme, creates the 5 pages, and wires up the nav menu.
set -e
cd "$(dirname "$0")"

echo "Waiting for the database..."
for i in $(seq 1 30); do
  docker compose exec -T db mysqladmin ping -h127.0.0.1 -uwp -pwppass 2>/dev/null | grep -q "mysqld is alive" && break
  sleep 2
done

echo "Waiting for WordPress core files..."
for i in $(seq 1 30); do
  docker compose exec -T wpcli test -f /var/www/html/wp-load.php && break
  sleep 2
done

WP="docker compose exec -T wpcli wp --path=/var/www/html"

$WP core install \
  --url="http://localhost:8792" \
  --title="The Baking Palette" \
  --admin_user=admin \
  --admin_password=admin123 \
  --admin_email=admin@example.com \
  --skip-email

$WP theme activate the-baking-palette
$WP rewrite structure '/%postname%/'
$WP rewrite flush

GALLERY_ID=$($WP post create --post_type=page --post_title="Gallery" --post_name=gallery --post_status=publish --porcelain)
MENU_ID=$($WP post create --post_type=page --post_title="Menu & Pricing" --post_name=menu --post_status=publish --porcelain)
TESTIMONIALS_ID=$($WP post create --post_type=page --post_title="Testimonials" --post_name=testimonials --post_status=publish --porcelain)
ABOUT_ID=$($WP post create --post_type=page --post_title="About" --post_name=about --post_status=publish --porcelain \
  --post_content="<p>The Baking Palette is a custom cake studio based in Sialkot, Pakistan, creating premium customized cakes and cupcakes for birthdays, weddings, and every celebration in between.</p><p>Every order starts with a conversation on Instagram — tell us your event, your theme, and your flavor, and we design a cake around it. Orders are made fresh to order, so we ask for a 2-3 day pre-order window to make sure every detail is right.</p><p>Once it's ready, choose pickup or delivery — either way, your cake arrives fresh and ready for your special day.</p>")
HOME_ID=$($WP post create --post_type=page --post_title="Home" --post_name=home --post_status=publish --porcelain)

$WP option update show_on_front page
$WP option update page_on_front "$HOME_ID"

$WP menu create "Primary"
$WP menu item add-custom Primary "Home" "http://localhost:8792/"
$WP menu item add-post Primary "$GALLERY_ID" --title="Gallery"
$WP menu item add-post Primary "$MENU_ID" --title="Menu & Pricing"
$WP menu item add-post Primary "$TESTIMONIALS_ID" --title="Testimonials"
$WP menu item add-post Primary "$ABOUT_ID" --title="About"
$WP menu location assign Primary primary

echo ""
echo "Done. Site:      http://localhost:8792/"
echo "      Admin:     http://localhost:8792/wp-admin/  (admin / admin123)"
