<?php

namespace App\Support;

use App\Models\Menu;
use App\Models\SiteSetting;
use Illuminate\Support\Collection;

/**
 * Builders for the JSON-LD (schema.org) blocks emitted in app.blade.php.
 *
 * Each method returns a plain array ready for json_encode. PageController
 * passes them to the root Blade view via withViewData(['jsonLd' => [...]]).
 */
class StructuredData
{
    /**
     * Business-level node (schema.org/Caterer, a LocalBusiness subtype).
     * Emitted on every public page; offers reference it via its @id.
     */
    public static function business(SiteSetting $settings): array
    {
        $node = [
            '@context' => 'https://schema.org',
            '@type' => 'Caterer',
            '@id' => url('/').'#business',
            'name' => $settings->brand_name ?: 'VIP Ketering',
            'url' => url('/'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Скопје',
                'postalCode' => '1000',
                'addressCountry' => 'MK',
            ],
            'areaServed' => ['@type' => 'City', 'name' => 'Скопје'],
        ];

        if ($settings->logo) {
            $node['logo'] = url($settings->logo);
            $node['image'] = url($settings->logo);
        }
        if ($settings->tagline) {
            $node['description'] = $settings->tagline;
        }
        if ($phone = self::phoneE164($settings->phone_primary)) {
            $node['telephone'] = $phone;
        }
        if ($settings->email) {
            $node['email'] = $settings->email;
        }

        $sameAs = array_values(array_filter([$settings->facebook_url, $settings->instagram_url]));
        if ($sameAs !== []) {
            $node['sameAs'] = $sameAs;
        }

        return $node;
    }

    /**
     * BreadcrumbList from ordered ['name' => ..., 'url' => ...] pairs.
     * Callers must pass at least two items (Google ignores shorter lists).
     */
    public static function breadcrumbs(array $trail): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_values(array_map(
                fn (array $crumb, int $i) => [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $crumb['name'],
                    'item' => $crumb['url'],
                ],
                $trail,
                array_keys($trail),
            )),
        ];
    }

    /**
     * ItemList of Products for the published catering menus on /menia.
     * Menus without a parsable price get a Product without offers.
     *
     * @param  Collection<int, Menu>  $menus
     */
    public static function menuList(Collection $menus, string $pageUrl, ?string $image): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'name' => 'Мениа — VIP Ketering',
            'itemListElement' => $menus->values()->map(
                fn (Menu $menu, int $i) => [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'item' => self::product($menu, $pageUrl, $image),
                ]
            )->all(),
        ];
    }

    private static function product(Menu $menu, string $pageUrl, ?string $image): array
    {
        $url = $pageUrl.'#'.$menu->slug;

        $node = [
            '@type' => 'Product',
            '@id' => $url,
            'url' => $url,
            'name' => trim($menu->title.($menu->group_label ? ' — '.$menu->group_label : '')),
            'description' => self::menuDescription($menu),
            'brand' => ['@type' => 'Brand', 'name' => 'VIP Ketering'],
        ];

        if ($image) {
            $node['image'] = url($image);
        }

        $price = self::numericPrice($menu->price);
        if ($price !== null) {
            $node['offers'] = [
                '@type' => 'Offer',
                'url' => $url,
                'price' => $price,
                'priceCurrency' => 'MKD',
                'availability' => 'https://schema.org/InStock',
                'priceSpecification' => [
                    '@type' => 'UnitPriceSpecification',
                    'price' => $price,
                    'priceCurrency' => 'MKD',
                    'referenceQuantity' => [
                        '@type' => 'QuantitativeValue',
                        'value' => 1,
                        'unitText' => 'особа',
                    ],
                ],
                'seller' => ['@id' => url('/').'#business'],
            ];
        }

        return $node;
    }

    private static function menuDescription(Menu $menu): string
    {
        $dishes = collect($menu->dishes ?? [])
            ->pluck('name')
            ->filter()
            ->implode('; ');

        $description = trim($dishes.($menu->note ? ' — '.$menu->note : ''), ' —');

        return mb_substr($description, 0, 500);
    }

    /**
     * Menu prices are stored as display strings (e.g. "550"); returns a
     * float suitable for offers.price, or null when absent/unparsable.
     */
    private static function numericPrice(?string $raw): ?float
    {
        $clean = preg_replace('/[^\d.]/u', '', (string) $raw);

        return is_numeric($clean) && (float) $clean > 0 ? (float) $clean : null;
    }

    /**
     * "078 226 005" → "+38978226005"; returns the raw value when it
     * doesn't look like a local Macedonian number.
     */
    private static function phoneE164(?string $raw): ?string
    {
        if (! $raw) {
            return null;
        }

        $digits = preg_replace('/\D/', '', $raw);

        if (preg_match('/^0\d{8}$/', $digits)) {
            return '+389'.substr($digits, 1);
        }
        if (str_starts_with($digits, '389')) {
            return '+'.$digits;
        }

        return $raw;
    }
}
