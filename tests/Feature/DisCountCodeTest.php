<?php

use App\Http\Controllers\DiscountCodeController;
use App\Models\Cart;
use App\Models\DiscountCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

class DisCountCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_add_discount_to_cart()
    {
        $discountCode = DiscountCode::factory()->create();
        $cart = Cart::factory()->create(['discount_code_id' => null]);
        $request = new Request(['code' => $discountCode->code]);
        $controller = new DiscountCodeController();

        $response = $controller->addDiscount($cart->id, $request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('cart_index'), $response->getTargetUrl());
        $this->assertEquals($cart->fresh()->discount_code_id, $discountCode->id);
    }
}
