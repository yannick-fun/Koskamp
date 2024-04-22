@extends('app')

@section('content')
<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="mb-3">Shopping cart</h5>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <p class="mb-0">{{ !empty($cart->cartItems) ? count($cart->cartItems) : 0 }} items in cart</p>
                                    </div>
                                    <div>
                                        <p class="mb-0">
                                            @if($cart->discount_code_id !== null)
                                                Total price with an {{ abs(($cart->discountCode->amount * 100) - 100) }}% discount: €{{ number_format((($totalPrice * $cart->discountCode->amount) / 100), 2) }},-
                                            @else
                                                Total price: €{{ number_format($totalPrice / 100, 2) }},-
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if($cart !== null || count($cart->cartItems) !== 0)
                                    @foreach ($cart->cartItems as $item)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div style="width: 80px;">
                                                            <img
                                                                src="{{ $item->product->image }}"
                                                                class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                        </div>
                                                        <div class="ms-3">
                                                            <h3>{{ $item->product->name }}</h3>
                                                            <p>SKU: {{ $item->product->sku }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div style="width: 100px;">
                                                            <form id="updateForm_{{ $item->id }}" action="{{ route('update_product', ['cartItem' => $item->id]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" value="{{ $item->id }}">
                                                                <input id="amountInput_{{ $item->id }}" class="form-control" name="amount" type="number" min="1" value="{{ $item->amount }}" style="max-width: 5rem" />
                                                            </form>
                                                        </div>
                                                        <script>
                                                            document.getElementById('amountInput_{{ $item->id }}').addEventListener('change', function() {
                                                                document.getElementById('updateForm_{{ $item->id }}').submit();
                                                            });
                                                        </script>
                                                        <div style="width: 120px;">
                                                            <h5 class="mb-0">
                                                                @if($cart->discount_code_id !== null)
                                                                    €{{ number_format(($item->product->price * $cart->discountCode->amount) * $item->amount / 100, 2) }},-
                                                                @else
                                                                    €{{ number_format($item->product->price * $item->amount / 100, 2) }},-
                                                                @endif
                                                            </h5>
                                                        </div>
                                                        <form action="{{ route('delete_product', ['cartItem' => $item->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" value="{{ $item->id }}">
                                                            <button type="submit" class="btn btn-outline-dark flex-shrink-0">
                                                                <i class="bi-cart-fill me-1"></i>
                                                                Remove
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex">
                                        @if($cart->discount_code_id !== null)
                                            <form action="{{ route('remove_discount', ['cart' => $cart->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex">
                                                    <input type="hidden" value="{{ $cart->id }}">
                                                    <button type="submit" class="btn btn-outline-dark flex-shrink-0">
                                                        <i class="bi-cart-fill me-1"></i>
                                                        Remove Discount
                                                    </button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{ route('add_discount', ['cart' => $cart->id]) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="d-flex">
                                                    <input type="hidden" value="{{ $cart->id }}">
                                                    <input class="form-control text-center me-3" name="code" type="text" style="max-width: 12rem" placeholder="Discount Code"/>
                                                    <button type="submit" class="btn btn-outline-dark flex-shrink-0">
                                                        <i class="bi-cart-fill me-1"></i>
                                                        Add Discount
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                        <form action="{{ route('delete_cart', ['cart' => $cart->id]) }}" method="POST" class="ml-auto">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{ $cart->id }}">
                                            <button type="submit" class="btn btn-outline-dark flex-shrink-0">
                                                <i class="bi-cart-fill me-1"></i>
                                                Remove All
                                            </button>
                                        </form>
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
