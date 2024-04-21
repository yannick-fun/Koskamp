<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * update amount off item in the cart.
     */
    public function updateCartItem(int $id, Request $request): RedirectResponse
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->amount = $request->input('amount');

        $cartItem->save();

        return redirect()->route('cart_index');
    }

    /**
     * Remove one item form the cart.
     */
    public function removeCartItem(int $id): RedirectResponse
    {
        $cartItem = CartItem::findOrFail($id);

        $cartItem->delete();

        return redirect()->route('cart_index');
    }

    /**
     * add an item to the cart.
     */
    public function createCartItem(int $productId, Request $request): CartItem
    {
        $cartItem = CartItem::where('cart_id', auth()->user()->cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem === null) {
            $cartItem = new CartItem();
            $cartItem->product_id = $productId;
        }

        $cartItem->amount = $request->input('amount');

        return $cartItem;
    }
}
