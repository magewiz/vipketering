# VIP Ketering — Redesign (static HTML + Tailwind)

A modern, restructured redesign of the existing WordPress site (`vip.local`),
built as a static prototype to be ported into the Laravel application.

## Concept

**Black & champagne editorial luxe.** Refined, premium feel suited to a VIP
catering brand. Real photography from the existing site, reorganized into a
cleaner, more modern structure (not a 1:1 copy). All copy is the original
Macedonian (Cyrillic) content, re-edited and re-grouped.

- **Display type:** Cormorant (high-contrast serif, full Cyrillic)
- **Body type:** Manrope (full Cyrillic)
- **Palette:** ink `#100F0D` · champagne gold `#C29A4B` / `#E6C77E` · cream `#F8F2E6`
- Gold hairlines, grain overlay, scroll-reveal, animated counters, Ken-Burns
  hero, gallery lightbox, sticky header, full-screen mobile menu.

## Pages (replace the live URLs)

| New file        | Replaces            |
|-----------------|---------------------|
| `index.html`    | `/`                 |
| `about.html`    | `/about-us/`        |
| `menia.html`    | `/menia/`           |
| `oprema.html`   | `/oprema/`          |
| `contact.html`  | `/contact/`         |

## Structure

```
design/
  index.html about.html menia.html oprema.html contact.html
  assets/
    site.css      ← design system (tokens, components, animations)
    site.js       ← header, mobile menu, reveal, counters, lightbox, form
    img/          ← logo + curated real photos (renamed for clarity)
```

Tailwind is loaded via the Play CDN for the prototype. Colors/fonts/components
live in `site.css` via CSS variables, so the look survives the move to a build.

## Porting to Laravel / Blade

1. **Layout partial:** the `<header>`, mobile menu, and `<footer>` are identical
   across pages → extract to `resources/views/layouts/site.blade.php` +
   `partials/header.blade.php` / `partials/footer.blade.php`. Mark the active
   nav link with `{{ request()->routeIs('about') ? 'active' : '' }}`.
2. **Assets:** move `assets/` into the Vite pipeline (`resources/css`, `resources/js`,
   `public/img`) and replace the Tailwind CDN with a real `tailwind.config.js`
   (port the CSS variables into `theme.extend.colors` / `fontFamily`).
3. **Dynamic data:** menu categories (`menia`), equipment list + gallery
   (`oprema`), and stats are currently hardcoded → back them with Eloquent
   models / config so they're editable.
4. **Contact form:** `data-form` is a demo (JS only). Wire it to a real
   controller + validation + mail (event type, date, guests, message).

## Menus (`menia.html`)

Real dish lists and per-person prices, transcribed from the original menu
images (`wp-content/uploads/2024-2025/…`), now rendered as structured,
text-based menu cards (not flat images) so they're searchable, translatable and
editable. Each card has a **share button** using the Web Share API — on mobile
it opens the native share sheet (WhatsApp/Viber/Messenger/…); on desktop it
copies the menu + deep-link (`#meni-1`) to the clipboard with a toast.

| Шведска маса | ден./особа |   | Свечени мениа | ден./особа |
|--------------|-----------:|---|---------------|-----------:|
| Мени 1 | 550 |  | Мени за слава | 800 |
| Мени 2 | 600 |  | Мени за роденден | 550 (деца 150) |
| Мени 3 | 750 |  | Мени за мекици | 500 |
| Мени 4 | 950 |  | Посно мени | 700 |
| Премиум | 1200 |  | Коктел мени | 750 |

When porting, move this data into a `menus` table / config so prices and dishes
are editable, and keep the `data-share`/`data-price` attributes on each card.

## Icons & contact

- One consistent **phone icon** is used before every phone number (header, hero,
  footer, contact, equipment), with envelope/pin icons for email/location.
- Real social links everywhere: `facebook.com/vipketering`,
  `instagram.com/vipketering`, with proper Facebook & Instagram brand icons.
- `contact.html` leads with **phone + email + social**; location is intentionally
  de-emphasized to a single small line.

## Notes / content decisions

- Stats numbers (clients/events/meals) are illustrative placeholders — confirm
  real figures before launch.
- Menu prices/dishes are transcribed from the source images — have the client
  double-check before launch (images may be outdated).
- Partner contacts on `oprema` (IR Creations, Creative Photography) are taken
  verbatim from the existing site.
- Map on `contact` uses an OpenStreetMap embed centered on Skopje — replace the
  marker with the exact address/coordinates.
