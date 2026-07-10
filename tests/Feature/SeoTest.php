<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\Page;
use Database\Seeders\MenusSeeder;
use Database\Seeders\PagesSeeder;
use Database\Seeders\SettingsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([PagesSeeder::class, MenusSeeder::class, SettingsSeeder::class]);
    }

    public function test_sitemap_lists_all_public_pages_as_xml(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $this->assertStringContainsString('application/xml', $response->headers->get('Content-Type'));
        $response->assertSee('<urlset', false);

        foreach (['home', 'about', 'menia', 'oprema', 'contact'] as $name) {
            $response->assertSee('<loc>'.route($name).'</loc>', false);
        }
    }

    public function test_home_page_has_business_json_ld_but_no_breadcrumbs(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('application/ld+json', false);
        $response->assertSee('Caterer', false);
        $response->assertDontSee('BreadcrumbList', false);
    }

    public function test_menia_page_has_breadcrumbs_products_and_meta_description(): void
    {
        $response = $this->get('/menia');

        $response->assertOk();
        $response->assertSee('BreadcrumbList', false);
        $response->assertSee('ItemList', false);
        $response->assertSee('"priceCurrency":"MKD"', false);
        $response->assertSee('UnitPriceSpecification', false);

        $description = Page::where('slug', 'menia')->value('meta_description');
        $response->assertSee('name="description" content="'.$description.'"', false);
    }

    public function test_menu_without_price_gets_product_without_offers(): void
    {
        Menu::query()->delete();
        Menu::create([
            'slug' => 'meni-test',
            'title' => 'Тест мени',
            'group' => 'svecheni',
            'group_label' => 'Свечени менија',
            'price' => null,
            'dishes' => [['name' => 'Салата', 'detail' => null]],
            'included' => [],
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $response = $this->get('/menia');

        $response->assertOk();
        $response->assertSee('Тест мени', false);
        $response->assertDontSee('"offers"', false);
    }

    public function test_unpublished_menus_are_not_in_json_ld(): void
    {
        Menu::query()->update(['is_published' => false]);

        $response = $this->get('/menia');

        $response->assertOk();
        $response->assertDontSee('"@type":"Product"', false);
    }
}
