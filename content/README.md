# Cake details — `cakes.csv`

This is the one file to edit when you want to describe your cakes. Fill it in,
then the details appear under every photo on the gallery page **and** in the
structured data that Google and AI assistants read.

## Why this matters

A search engine or an AI assistant cannot see your photos. Right now each cake
is a filename and one line of alt text, which is why ChatGPT said it "couldn't
find enough reliable public information to compare the actual custom designs
against the other Sialkot bakers." Filling this file is what fixes that.

## How to edit it

Open `cakes.csv` in Excel or Google Sheets, fill in the columns, save as CSV.
Then tell Claude to rebuild, or run:

```
python3 scripts/build_gallery.py
```

Safe to run as often as you like. It only ever rewrites what it wrote before.

## The columns

**Don't change these three** — they link each row to the right photo:

| Column | |
|---|---|
| `image_url` | a real link to the cake — **click it to open the photo** while you write |
| `category` | which filter buttons the cake appears under |
| `alt` | the description for screen readers |

The links point at the live site, so they work from any device with no server
running. To see thumbnails right inside the sheet, add a column in Google
Sheets with `=IMAGE(A2)` and fill it down.

**Fill in whatever you know.** Every one of these is optional, and blanks are
simply left out:

| Column | Example |
|---|---|
| `title` | `Frozen Ice Castle Cake` |
| `occasion` | `5th birthday` |
| `size_tiers` | `Single tier, 3 lb` |
| `flavour` | `Chocolate with Nutella filling` |
| `technique` | `Buttercream rosettes, fondant castle topper` |
| `price_band` | `Rs. 6,000 - 7,500` |
| `lead_time` | `3 days` |
| `description` | `A single-tier blue buttercream cake finished with piped rosettes and a hand-built fondant ice castle.` |

## If you only have time for one column

Fill in **`description`**. One or two honest sentences per cake does more than
all the other columns put together — it is the part that gets read and quoted.

## Tips

- Write the way a customer would ask: "two-tier nikkah cake", "half-birthday
  smash cake", "graduation cake with sunflowers".
- Only describe cakes you actually made. Invented details are the one thing
  that can genuinely damage you here.
- A few rows at a time is fine. Nothing breaks if the rest stay blank — those
  cakes just show as photos until you get to them.
