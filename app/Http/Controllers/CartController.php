<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
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
        $cart = Cart::with(['cartItems.product'])->find(46);

        if ($cart === null) {
            $cart = $this->getCart(46);
        }

        return view('pages.cart', [
            'cart' => $cart
        ]);
    }

    public function addItem(Request $request): RedirectResponse
    {
        $cart = $this->getCart(46);

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

    public function getCart(int $userId): Cart
    {
        $cart = Cart::find($userId); //TODO aan user koppelen

        if ($cart === null) {
            $cart = new Cart();
            $cart->user_id = 1; //todo
            $cart->save();
        }

        return $cart;
    }
}
