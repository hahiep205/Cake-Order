@extends('layouts.app')

@section('title', 'CAKES - Dashboard')

@section('content')

    <!-- ================= HOME SECTION ================= -->
    <section class="home" id="home">
        <img class="image-slide active" src="/img/slide1.jpg" alt="">
        <img class="image-slide" src="/img/slide2.jpg" alt="">
        <img class="image-slide" src="/img/slide3.jpg" alt="">
        <img class="image-slide" src="/img/slide4.jpg" alt="">
        <img class="image-slide" src="/img/slide5.jpg" alt="">

        <div class="content active">
            <h1>Delicious.<br><span>Cake Art</span></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat.</p>
            <a href="dashboard#products"><button>Order Now <i class="ri-arrow-right-line"></i></button></a>
        </div>
        <div class="content">
            <h1>Flavours.<br><span>Taste</span></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat.</p>
            <a href="dashboard#products"><button>Order Now <i class="ri-arrow-right-line"></i></button></a>
        </div>
        <div class="content">
            <h1>Soft Layers.<br><span>Feeling</span></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat.</p>
            <a href="dashboard#products"><button>Order Now <i class="ri-arrow-right-line"></i></button></a>
        </div>
        <div class="content">
            <h1>Best Recipe.<br><span>Fresh</span></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat.</p>
            <a href="dashboard#products"><button>Order Now <i class="ri-arrow-right-line"></i></button></a>
        </div>
        <div class="content">
            <h1>Sweet Life.<br><span>Bliss</span></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat.</p>
            <a href="dashboard#products"><button>Order Now <i class="ri-arrow-right-line"></i></button></a>
        </div>

        <div class="media-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>

        <div class="slider-nav">
            <div class="nav-btn active"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
        </div>

    </section>

    <!-- ================= PRODUCTS SECTION ================= -->
    <section class="products-section" id="products">
        <div class="products-header">
            <h2>Products</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quas tempora fugiat sapiente dicta deleniti,
                animi itaque maxime enim suscipit ullam autem numquam mollitia!</p>
        </div>

        <div class="products-grid">
            @if(isset($products) && $products->count() > 0)
                @foreach($products as $product)
                    <div class="products-item">
                        <div class="products-image">
                            <img src="{{ asset('product_img/' . $product->image) }}" alt="{{ $product->product_name }}">
                        </div>
                        <h3 class="products-name">{{ $product->product_name }}</h3>
                        <p class="products-description">{{ $product->description }}</p>
                        <span class="products-price">${{ number_format($product->price, 2) }}</span>

                        <button class="add_to_cart_button" data-product-id="{{ $product->product_id }}"
                            data-product-name="{{ $product->product_name }}" @guest disabled title="Please login to add to cart"
                            @endguest>
                            <i class="ri-shopping-cart-line"></i>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <!-- ================= ABOUT SECTION ================= -->
    <section class="about-section" id="about">
        <div class="about-container">
            <!-- Top Row -->
            {{-- <div class="about-top"> --}}
                <div class="about-image-left">
                    <img src="img/avt-about.png" alt="">
                </div>
                <div class="about-text-right">
                    <h2 class="about-t">About <span class="text-pink">us</span></h2>
                    <p>Cooking was always my passion and I enjoyed it very much. It started at home, when I was baking for
                        my relatives and friends. I also loved to decorate my pastries and sweets in a unique and creative
                        manner.</p>
                    <p>When I started taking pictures of my baking and posting it on my Social Media - different people
                        started paying attention to my work and I was being asked to make custom cakes more and more often.
                        At one point, it became too much and I found the assistant who later became a full team member.</p>
                    <p>When I started taking pictures of my baking and posting it on my Social Media - different people
                        started paying attention to my work. When I started taking pictures of my baking and posting it on
                        my Social Media - different people started paying attention to my work. When I started taking
                        pictures of my baking and posting it on my Social Media - different people started paying attention
                        to my work.</p>
                </div>
            {{-- </div> --}}

            <!-- Bottom Row -->
            {{-- <div class="about-bottom"> --}}
                <div class="about-text-left">
                    <h2 class="about-b">Made with <br> <span class="text-mint">love</span></h2>
                    <p>Our production is 100% handmade. It also explains why we bake naked cakes. These cakes, easily
                        recognized by their exposed layers and minimal garnishes, where we want to show off the cake and
                        filling. For our desserts we always use only the natural ingredients, it is very important for us
                        not just impress with the look of a dessert but also with a quality.</p>
                    <p>It also explains why we bake naked cakes. These cakes, easily recognized by their exposed layers and
                        minimal garnishes, where we want to show off the cake and filling. It also explains why we bake
                        naked cakes. These cakes, easily recognized by their exposed layers and minimal garnishes, where we
                        want to show off the cake and filling.</p>
                </div>
                <div class="about-image-right">
                    <img src="img/cake-about.png" alt="">
                </div>
            {{-- </div> --}}
        </div>
    </section>
    </div>

@endsection