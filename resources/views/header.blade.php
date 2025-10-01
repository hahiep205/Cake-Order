<header class="header">
    <nav class="nav container">

        <a class="logo" href="/">CAKE</a>

        <div class="nav_menu">

            <ul class="nav_list">
                <li class="nav_item">
                    <a href="/" class="nav_link">Home</a>
                </li>
                <li class="nav_item">
                    <a href="/" class="nav_link">About us</a>
                </li>
                <li class="nav_item">
                    <a href="/" class="nav_link">Popular</a>
                </li>
                <li class="nav_item">
                    <a href="/" class="nav_link">Recently</a>
                </li>
            </ul>

        </div>

        <div class="nav_right">
            <ul class="nav_item_right" style="list-style: none;">

                @if(Auth::check())

                    <li class="nav_item nav_item_right">
                        <span class="nav_name">{{ auth()->user()->name }}</span>
                        <a href="" class="nav_link"><i class="ri-user-settings-line icon"></i></a>
                        <a href="{{ route('logout') }}" class="nav_link"><i class="ri-logout-box-r-line icon"></i></a>
                    </li>
                @else
                    <li class="nav_item nav_item_right">
                        <a href="/login" class="nav_link">Login</a>
                        <a href="/register" class="nav_link">Register</a>
                    </li>
                @endif
                
            </ul>
        </div>

    </nav>
</header>