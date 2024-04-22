<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\View\View;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_return_all_products_in_the_index_page()
    {
        $products = Product::factory()->count(3)->create();
        $controller = new ProductController();

        $view = $controller->index();

        $this->assertInstanceOf(View::class, $view);
        $this->assertArrayHasKey('products', $view->getData());
        $this->assertCount(3, $view->getData()['products']);
    }

    public function test_can_return_a_specific_product_in_the_show_page()
    {
        $product = Product::factory()->create();
        $controller = new ProductController();

        $view = $controller->show($product);

        $this->assertInstanceOf(View::class, $view);
        $this->assertArrayHasKey('product', $view->getData());
        $this->assertEquals($product->id, $view->getData()['product']->id);
    }
}
