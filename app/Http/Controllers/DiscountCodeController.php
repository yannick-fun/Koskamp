<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DiscountCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    /**
     * Add discount to a cart
     */
    public function addDiscount(int $id, Request $request): RedirectResponse
    {
        $discountCode = DiscountCode::where('code', $request->input('code'))->first();
        $cart = Cart::find($id);

        if($discountCode && $cart->discount_code_id === null) {
            $cart->discount_code_id = $discountCode->id;
            $cart->save();
        }

        return redirect()->route('cart_index');
    }

    /**
     * remove discount from a cart
     */
    public function removeDiscount(int $id): RedirectResponse
    {
        $cart = Cart::find($id);

        $cart->discount_code_id = null;
        $cart->save();

        return redirect()->route('cart_index');
    }
}
