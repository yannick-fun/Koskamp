<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0, 0, 0, 0.05);">
    <div class="container px-4 px-lg-5">
        <div class="collapse navbar-collapse">
            <a class="navbar-brand" href="{{ route('product_index') }}">
                <button class="btn btn-outline-dark">Products</button>
            </a>
            <a href="{{ route('cart_index') }}">
                <button class="btn btn-outline-dark">Cart</button>
            </a>
            @if (Route::has('login'))
                @auth
                    <form method="POST" id="logoutForm" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            <button class="btn btn-outline-dark">{{ __('Log Out') }}</button>
                        </a>
                    </form>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        <button class="btn btn-outline-dark">Log in</button>

                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            <button class="btn btn-outline-dark">Register</button>
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
