<?php

namespace Tests\Feature;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method_creates_cart_if_not_exists()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cartItemController = new CartItemController();
        $controller = new CartController($cartItemController);

        $response = $controller->index();

        $this->assertInstanceOf(Cart::class, $response->getData()['cart']);
    }

    public function test_index_method_shows_existing_cart()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);
        CartItem::factory()->count(2)->create(['cart_id' => $cart->id]);

        $this->actingAs($user);

        $cartItemController = new CartItemController();
        $controller = new CartController($cartItemController);

        $response = $controller->index();

        $this->assertEquals($cart->id, $response->getData()['cart']->id);
    }

    public function test_addItem_method_adds_item_to_cart_and_redirects_to_cart_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cart = Cart::factory()->create(['user_id' => $user->id]);
        $product = Product::factory()->create();

        $request = new Request(['product' => $product->id, 'amount' => 2]);

        $cartItemController = new CartItemController();
        $controller = new CartController($cartItemController);

        $response = $controller->addItem($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('cart_index'), $response->getTargetUrl());

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
            'product_id' => $product->id,
        ]);
    }

    public function test_updateCartItem_method_updates_cart_item_and_redirects_to_cart_index()
    {
        $cartItem = CartItem::factory()->create();
        $request = new Request(['amount' => 5]);

        $controller = new CartItemController();
        $response = $controller->updateCartItem($cartItem->id, $request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('cart_index'), $response->getTargetUrl());

        $this->assertDatabaseHas('cart_items', [
            'id' => $cartItem->id,
            'amount' => 5,
        ]);
    }

    public function test_removeCartItem_method_removes_cart_item_and_redirects_to_cart_index()
    {
        $cartItem = CartItem::factory()->create();

        $controller = new CartItemController();
        $response = $controller->removeCartItem($cartItem->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('cart_index'), $response->getTargetUrl());

        $this->assertDatabaseMissing('cart_items', [
            'id' => $cartItem->id,
        ]);
    }
}
