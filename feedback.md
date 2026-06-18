# VIP Ketering — Admin Panel

## Login credentials

- **URL:** https://vipketering.pwa.mk/admin
- **Email:** `admin@vipketering.mk`
- **Password:** `vipketering2026`

> ⚠️ Change this password after first login. The account is seeded by
> `database/seeders/DatabaseSeeder.php`. To reset it, re-run `php artisan db:seed --force`
> (idempotent) or update the user directly.

## What was requested

> Create admin panel for managing the website. Each page needs to be fully
> manageable via the admin panel, all images must be replaceable via the admin panel.
>
> Decisions chosen by the user:
> - Admin stack: **Inertia + Vue** (same stack as the public site)
> - Content model: **Structured CMS** (typed fields per page)
> - Auth: **Single admin role**, seeded account, simple email/password login
>
> Follow-up: "when you're done, save the feedback in feedback.md along with login credentials"

## What the admin panel can manage

Everything that was previously hard-coded in the Vue templates is now editable
from `/admin`:

- **Страници (Pages)** — every text block and image on Home, About, Menia,
  Oprema, Contact, plus SEO meta title/description. Driven by a schema-based
  editor (`app/Support/PageSchemas.php`).
- **Мениа (Menus)** — full CRUD: title, group (шведска/свечени), price, note,
  dishes (name + detail), and the "included" list. Reorder + publish toggle.
- **Опрема (Equipment)** — the rental price list (name, note, price), inline edit.
- **Галерии (Galleries)** — home-food, menia, oprema collections; upload/replace,
  caption, alt, aspect ratio, publish toggle.
- **Поставки (Settings)** — brand name, tagline, logo, two phone numbers + labels,
  email, address, Facebook/Instagram. Shared into the header/footer everywhere.
- **All images** are replaceable via the upload widget (stored on the public disk
  under `storage/app/public/uploads`, served through the existing `public/storage`
  symlink). Existing images keep their original `/img/...` paths until replaced.

## Notes / follow-ups for later

- The public contact form is still front-end-only (demo). Wiring it to a real
  controller + email was out of scope for this task.
- Headings that contain line breaks / gold accent words are stored as small HTML
  snippets (marked `HTML` in the editor) so the original design is preserved.
- Stat numbers, menu prices and partner contacts were transcribed from the
  existing site — have the client confirm them before launch.
