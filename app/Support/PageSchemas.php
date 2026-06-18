<?php

namespace App\Support;

/**
 * Declarative content schema for every editable page.
 *
 * Each page is a list of sections; each section is a list of fields. The admin
 * page editor renders a form from this schema, and the public pages read the
 * matching values out of Page::$content. Field keys use dot notation and map
 * to nested arrays inside the content JSON (e.g. "hero.heading").
 *
 * Field types:
 *   text     — single line
 *   textarea — multi-line plain text
 *   html     — multi-line; rendered with v-html on the site (allows <br>, accent spans)
 *   image    — single image (upload/replace), stored as a URL path
 *   images   — ordered list of images (add/remove/reorder)
 *   list     — ordered list of strings (set "html" => true to allow markup per item)
 *   repeater — ordered list of objects; "fields" defines the sub-fields
 */
class PageSchemas
{
    public static function all(): array
    {
        return [
            'home' => self::home(),
            'about' => self::about(),
            'menia' => self::menia(),
            'oprema' => self::oprema(),
            'contact' => self::contact(),
        ];
    }

    public static function for(string $slug): array
    {
        return self::all()[$slug] ?? [];
    }

    private static function home(): array
    {
        return [
            ['title' => 'Херо (почетна секција)', 'fields' => [
                ['key' => 'hero.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'hero.heading', 'label' => 'Наслов', 'type' => 'html', 'help' => 'Дозволени се <br> и акцент: <span class="italic-accent text-[var(--gold-bright)]">збор</span>'],
                ['key' => 'hero.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'hero.image', 'label' => 'Позадинска слика', 'type' => 'image'],
                ['key' => 'hero.cta_primary', 'label' => 'Главно копче', 'type' => 'text'],
                ['key' => 'hero.cta_secondary', 'label' => 'Споредно копче', 'type' => 'text'],
            ]],
            ['title' => 'Добредојде', 'fields' => [
                ['key' => 'welcome.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'welcome.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'welcome.paragraphs', 'label' => 'Параграфи', 'type' => 'list', 'html' => true],
                ['key' => 'welcome.image', 'label' => 'Слика', 'type' => 'image'],
                ['key' => 'welcome.badge_number', 'label' => 'Беџ — број', 'type' => 'text'],
                ['key' => 'welcome.badge_label', 'label' => 'Беџ — текст', 'type' => 'text'],
                ['key' => 'welcome.features', 'label' => 'Мали картички', 'type' => 'repeater', 'fields' => [
                    ['key' => 'title', 'label' => 'Наслов', 'type' => 'text'],
                    ['key' => 'text', 'label' => 'Текст', 'type' => 'text'],
                ]],
            ]],
            ['title' => 'Бројки (статистика)', 'fields' => [
                ['key' => 'stats', 'label' => 'Бројки', 'type' => 'repeater', 'fields' => [
                    ['key' => 'value', 'label' => 'Број', 'type' => 'text'],
                    ['key' => 'suffix', 'label' => 'Суфикс (+, ★)', 'type' => 'text'],
                    ['key' => 'label', 'label' => 'Опис', 'type' => 'text'],
                ]],
            ]],
            ['title' => 'Што нудиме (услуги)', 'fields' => [
                ['key' => 'services.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'services.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'services.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'services.items', 'label' => 'Услуги', 'type' => 'repeater', 'fields' => [
                    ['key' => 'title', 'label' => 'Наслов', 'type' => 'text'],
                    ['key' => 'text', 'label' => 'Текст', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'Зошто токму ние', 'fields' => [
                ['key' => 'why.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'why.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'why.points', 'label' => 'Точки', 'type' => 'repeater', 'fields' => [
                    ['key' => 'text', 'label' => 'Текст', 'type' => 'textarea'],
                ]],
                ['key' => 'why.images', 'label' => 'Слики', 'type' => 'images'],
            ]],
            ['title' => 'Галерија (наслов)', 'fields' => [
                ['key' => 'gallery.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'gallery.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'gallery.link_label', 'label' => 'Копче „сите мениа“', 'type' => 'text'],
            ]],
            ['title' => 'Повик за акција (дно)', 'fields' => [
                ['key' => 'cta.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'cta.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'cta.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'cta.image', 'label' => 'Позадинска слика', 'type' => 'image'],
            ]],
        ];
    }

    private static function about(): array
    {
        return [
            ['title' => 'Херо', 'fields' => [
                ['key' => 'hero.title', 'label' => 'Наслов', 'type' => 'text'],
                ['key' => 'hero.image', 'label' => 'Позадинска слика', 'type' => 'image'],
            ]],
            ['title' => 'Вовед', 'fields' => [
                ['key' => 'intro.paragraphs', 'label' => 'Параграфи', 'type' => 'list', 'html' => true],
                ['key' => 'intro.image', 'label' => 'Слика', 'type' => 'image'],
            ]],
            ['title' => 'Нашите услуги', 'fields' => [
                ['key' => 'services.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'services.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'services.items', 'label' => 'Услуги', 'type' => 'repeater', 'fields' => [
                    ['key' => 'title', 'label' => 'Наслов', 'type' => 'text'],
                    ['key' => 'text', 'label' => 'Текст', 'type' => 'text'],
                ]],
            ]],
            ['title' => 'Зошто токму ние', 'fields' => [
                ['key' => 'why.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'why.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'why.points', 'label' => 'Точки', 'type' => 'repeater', 'fields' => [
                    ['key' => 'text', 'label' => 'Текст', 'type' => 'textarea'],
                ]],
                ['key' => 'why.images', 'label' => 'Слики', 'type' => 'images'],
            ]],
            ['title' => 'Бројки (статистика)', 'fields' => [
                ['key' => 'stats', 'label' => 'Бројки', 'type' => 'repeater', 'fields' => [
                    ['key' => 'value', 'label' => 'Број', 'type' => 'text'],
                    ['key' => 'suffix', 'label' => 'Суфикс', 'type' => 'text'],
                    ['key' => 'label', 'label' => 'Опис', 'type' => 'text'],
                ]],
            ]],
            ['title' => 'Повик за акција (дно)', 'fields' => [
                ['key' => 'cta.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'cta.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'cta.image', 'label' => 'Позадинска слика', 'type' => 'image'],
            ]],
        ];
    }

    private static function menia(): array
    {
        return [
            ['title' => 'Херо', 'fields' => [
                ['key' => 'hero.title', 'label' => 'Наслов', 'type' => 'text'],
                ['key' => 'hero.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'hero.image', 'label' => 'Позадинска слика', 'type' => 'image'],
            ]],
            ['title' => 'Шведска маса (наслов)', 'fields' => [
                ['key' => 'shvedska.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'shvedska.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'shvedska.lead', 'label' => 'Опис', 'type' => 'textarea'],
            ]],
            ['title' => 'Свечени мениа (наслов)', 'fields' => [
                ['key' => 'svecheni.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'svecheni.heading', 'label' => 'Наслов', 'type' => 'html'],
            ]],
            ['title' => 'Забелешка под мениата', 'fields' => [
                ['key' => 'footnote', 'label' => 'Текст', 'type' => 'html'],
            ]],
            ['title' => 'Галерија (наслов)', 'fields' => [
                ['key' => 'gallery.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'gallery.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'gallery.lead', 'label' => 'Опис', 'type' => 'textarea'],
            ]],
            ['title' => 'Повик за акција (дно)', 'fields' => [
                ['key' => 'cta.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'cta.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'cta.image', 'label' => 'Позадинска слика', 'type' => 'image'],
            ]],
        ];
    }

    private static function oprema(): array
    {
        return [
            ['title' => 'Херо', 'fields' => [
                ['key' => 'hero.title', 'label' => 'Наслов', 'type' => 'text'],
                ['key' => 'hero.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'hero.image', 'label' => 'Позадинска слика', 'type' => 'image'],
            ]],
            ['title' => 'Ценовник (текст)', 'fields' => [
                ['key' => 'pricing.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'pricing.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'pricing.intro', 'label' => 'Вовед', 'type' => 'textarea'],
                ['key' => 'pricing.card_title', 'label' => 'Наслов на картичка', 'type' => 'text'],
                ['key' => 'pricing.card_group', 'label' => 'Поднаслов на картичка', 'type' => 'text'],
                ['key' => 'pricing.footnote', 'label' => 'Забелешка (*)', 'type' => 'text'],
                ['key' => 'pricing.contact_intro', 'label' => 'Текст пред телефони', 'type' => 'text'],
            ]],
            ['title' => 'Партнери', 'fields' => [
                ['key' => 'partners.intro', 'label' => 'Вовед', 'type' => 'textarea'],
                ['key' => 'partners.image', 'label' => 'Слика на картичка', 'type' => 'image'],
                ['key' => 'partners.items', 'label' => 'Партнери', 'type' => 'repeater', 'fields' => [
                    ['key' => 'title', 'label' => 'Наслов', 'type' => 'text'],
                    ['key' => 'label', 'label' => 'Име/ознака', 'type' => 'text'],
                    ['key' => 'phone1', 'label' => 'Телефон 1', 'type' => 'text'],
                    ['key' => 'phone2', 'label' => 'Телефон 2', 'type' => 'text'],
                    ['key' => 'instagram', 'label' => 'Instagram URL', 'type' => 'text'],
                    ['key' => 'facebook', 'label' => 'Facebook URL', 'type' => 'text'],
                ]],
            ]],
            ['title' => 'Галерија (наслов)', 'fields' => [
                ['key' => 'gallery.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'gallery.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'gallery.lead', 'label' => 'Опис', 'type' => 'textarea'],
            ]],
            ['title' => 'Повик за акција (дно)', 'fields' => [
                ['key' => 'cta.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'cta.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'cta.image', 'label' => 'Позадинска слика', 'type' => 'image'],
            ]],
        ];
    }

    private static function contact(): array
    {
        return [
            ['title' => 'Херо', 'fields' => [
                ['key' => 'hero.title', 'label' => 'Наслов', 'type' => 'text'],
                ['key' => 'hero.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'hero.image', 'label' => 'Позадинска слика', 'type' => 'image'],
            ]],
            ['title' => 'Формулар', 'fields' => [
                ['key' => 'form.eyebrow', 'label' => 'Надкровен текст', 'type' => 'text'],
                ['key' => 'form.heading', 'label' => 'Наслов', 'type' => 'text'],
                ['key' => 'form.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'form.event_types', 'label' => 'Типови настани (паѓачко мени)', 'type' => 'list'],
            ]],
            ['title' => 'Странична картичка', 'fields' => [
                ['key' => 'aside.heading', 'label' => 'Наслов', 'type' => 'html'],
                ['key' => 'aside.lead', 'label' => 'Опис', 'type' => 'textarea'],
                ['key' => 'aside.social_note', 'label' => 'Текст до социјални мрежи', 'type' => 'text'],
            ]],
        ];
    }
}
