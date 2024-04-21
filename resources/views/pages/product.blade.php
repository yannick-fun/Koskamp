@extends('app')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                    <div class="fs-5 mb-5">
                        <span class="text-decoration-line-through">€{{ number_format($product->price / 100, 2) }},-</span>
                    </div>
                    <p class="lead">{{ $product->description }}</p>
                    <p>SKU: {{ $product->sku }}</p>
                    <form action="{{ route('add_product') }}" method="POST">
                        @csrf
                        <div class="d-flex">
                            <input type="hidden" name="product" value="{{ $product->id }}">
                            <input class="form-control text-center me-3" name="amount" id="inputQuantity" type="number" min="1" value="1" style="max-width: 3rem" />
                            <button type="submit" class="btn btn-outline-dark flex-shrink-0">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
