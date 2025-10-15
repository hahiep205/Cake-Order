<header>
    <div class="container">

        <a href="dashboard" class="brand">Cakes</a>



        <div class="nav">

            <div class="nav-items">
                <a href="/#home">Home</a>
                <a href="/#products">Products</a>
                <a href="/#about">About</a>
                <a href="/">Reviews</a>
            </div>

            <div class="nav-logs">
                @if(Auth::check())
                    @if(auth()->user()->isUser())

                        <div class="">
                            {{-- <span class="nav_name">{{ auth()->user()->name }}</span> --}}
                            <a href="{{ route('cart') }}"><i class="ri-shopping-cart-line icon"></i></a>
                            <a href="{{ route('profile') }}"><i class="ri-user-line icon"></i></a>
                            <a href="{{ route('logout') }}"><i class="ri-logout-box-r-line icon"></i></a>
                        </div>

                    @else

                        <div class="">
                            {{-- <span class="nav_name">{{ auth()->user()->name }}</span> --}}
                            <a href="{{ route('admin') }}"><i class="ri-user-star-line icon"></i></a>
                            <a href="{{ route('logout') }}"><i class="ri-logout-box-r-line icon"></i></a>
                        </div>

                    @endif
                @else

                    <div class="">
                        <a href="/login">Login</a>
                        <a href="/register">Register</a>
                    </div>

                @endif
            </div>

        </div>
        <div class="menu-btn"></div>
    </div>
</header>