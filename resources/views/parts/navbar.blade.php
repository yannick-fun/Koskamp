<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0, 0, 0, 0.05);">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('product_index') }}">Products</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a href="{{ route('cart_index') }}">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </a>
        </div>
    </div>
</nav>
