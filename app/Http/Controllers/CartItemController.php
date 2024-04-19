<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function updateCartItem(int $id, Request $request): RedirectResponse
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->amount = $request->input('amount');

        $cartItem->save();

        return redirect()->route('cart_index');
    }

    public function removeCartItem(int $id): RedirectResponse
    {
        $cartItem = CartItem::findOrFail($id);

        $cartItem->delete();

        return redirect()->route('cart_index');
    }

    public function createCartItem(int $productId, Request $request): CartItem
    {
//        $cartItem = CartItem::findOrFail($cartItemId);

//        if ($cartItem === null) {
            $cartItem = new CartItem();
//        }

        $cartItem->product_id = $productId;
        $cartItem->amount = $request->input('amount');

        return $cartItem;
    }
}
