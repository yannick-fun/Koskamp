<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    protected CartItemController $cartItemController;

    public function __construct(CartItemController $cartItemController)
    {
        $this->cartItemController = $cartItemController;
    }

    public function index(): Application|Factory|View
    {
        if (auth()->user()->cart === null) {
            $cart = $this->createCart(auth()->user()->id);
        } else {
            $cart = Cart::with(['cartItems.product'])->find(auth()->user()->cart->id);
        }
        return view('pages.cart', [
            'cart' => $cart
        ]);
    }

    public function addItem(Request $request): RedirectResponse
    {
        $cart = Cart::where('user_id', auth()->user()->id)->first();

        if ($cart === null) {
            $cart = $this->createCart(auth()->user()->id);
        }

        $product = Product::findOrFail($request->input('product'));

        $cartItem = $this->cartItemController->createCartItem($product->id, $request);

        $cartItem->cart_id = $cart->id;
        $cart->cartItems()->save($cartItem);

        return redirect()->route('cart_index');
    }

    public function removeCart(int $id): RedirectResponse
    {
        $cart = Cart::findOrFail($id);
        $cart->cartItems()->delete();

        $cart->delete();

        return redirect()->route('cart_index');
    }

    public function createCart(int $userId)
    {
        $cart = new Cart();
        $cart->user_id = $userId;
        $cart->save();

        return $cart;
    }
}
