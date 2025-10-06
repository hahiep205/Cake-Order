<header class="header">
    <nav class="nav container">

        <a class="logo" href="/">CAKE</a>

        <div class="nav_menu">

            <ul class="nav_list pacifico" >
                <li class="nav_item">
                    <a href="#home" class="nav_link">HOME</a>
                </li>
                <li class="nav_item">
                    <a href="#about" class="nav_link">ABOUT</a>
                </li>                
                <li class="nav_item">
                    <a href="#products" class="nav_link">PRODUCTS</a>
                </li>
                <li class="nav_item">
                    <a href="#contact" class="nav_link">CONTACT</a>
                </li>
            </ul>

        </div>

        <div class="nav_search pacifico">
            <input type="text" placeholder="Search...">
            <a href="#">
                <i class="ri-search-line fas"></i>
            </a>
        </div>

        <div class="nav_right pacifico">
            <ul class="nav_item_right" style="list-style: none;">

                @if(Auth::check())

                    @if(auth()->user()->isUser())
                        <li class="nav_item nav_item_right">
                            <span class="nav_name">{{ auth()->user()->name }}</span>
                            <a href="" class="nav_link"><i class="ri-user-settings-line icon"></i></a>
                            <a href="{{ route('logout') }}" class="nav_link"><i class="ri-logout-box-r-line icon"></i></a>
                        </li>
                    @else
                        <li class="nav_item nav_item_right">
                            <span class="nav_name">Welcome {{ auth()->user()->name }}!</span>
                            <a href="{{ route('admin') }}" class="nav_link"><i class="ri-user-star-line icon"></i></a>
                            <a href="{{ route('logout') }}" class="nav_link"><i class="ri-logout-box-r-line icon"></i></a>
                        </li>
                    @endif
                    
                @else
                    <li class="nav_item nav_item_right">
                        <a href="/login" class="nav_link">LOGIN</a>
                        <a href="/register" class="nav_link">REGISTER</a>
                    </li>
                @endif
                
            </ul>
        </div>

    </nav>
</header>