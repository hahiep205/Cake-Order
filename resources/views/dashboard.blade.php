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
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
        <a href="dashboard#products"><button>Order Now <i class="ri-arrow-right-line"></i></button></a>
      </div>
      <div class="content">
        <h1>Flavours.<br><span>Taste</span></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
        <a href="dashboard#products"><button>Order Now <i class="ri-arrow-right-line"></i></button></a>
      </div>
      <div class="content">
        <h1>Soft Layers.<br><span>Feeling</span></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
        <a href="dashboard#products"><button>Order Now <i class="ri-arrow-right-line"></i></button></a>
      </div>
        <div class="content">
        <h1>Best Recipe.<br><span>Fresh</span></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
        <a href="dashboard#products"><button>Order Now <i class="ri-arrow-right-line"></i></button></a>
      </div>
        <div class="content">
        <h1>Sweet Life.<br><span>Bliss</span></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
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
                <p>Here you can see different categories for any occasions. Click on the right category to find your dessert. Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            </div>

            <!-- Product grid -->
            <div class="products-grid">
                <div class="product-card card-pink">
                    <img src="img/product1.png" alt="">
                    <div class="overlay"><h3>All cakes</h3></div>
                </div>
                <div class="product-card card-yellow">
                    <img src="img/product2.png" alt="">
                    <div class="overlay"><h3>For women</h3></div>
                </div>
                <div class="product-card card-blue">
                    <img src="img/product3.png" alt="">
                    <div class="overlay"><h3>For children</h3></div>
                </div>
                <div class="product-card card-mint">
                    <img src="img/product4.png" alt="">
                    <div class="overlay"><h3>For men</h3></div>
                </div>
                <div class="product-card card-pink">
                    <img src="img/product5.png" alt="">
                    <div class="overlay"><h3>Wedding<br>cakes</h3></div>
                </div>
                <div class="product-card card-yellow">
                    <img src="img/product6.png" alt="">
                    <div class="overlay"><h3>Desserts</h3></div>
                </div>
            </div>
        </section>

        <!-- ================= ABOUT SECTION ================= -->
        <section class="about-section" id="about">
            <div class="about-container">
                <!-- Top Row -->
                <div class="about-top">
                    <div class="about-image-left">
                        <img src="img/avt-about.png" alt="">
                    </div>
                    <div class="about-text-right">
                        <h2 class="about-t">About <span class="text-pink">us</span></h2>
                        <p>Cooking was always my passion and I enjoyed it very much. It started at home, when I was baking for my relatives and friends. I also loved to decorate my pastries and sweets in a unique and creative manner.</p>
                        <p>When I started taking pictures of my baking and posting it on my Social Media - different people started paying attention to my work and I was being asked to make custom cakes more and more often. At one point, it became too much and I found the assistant who later became a full team member.</p>
                        <p>When I started taking pictures of my baking and posting it on my Social Media - different people started paying attention to my work. When I started taking pictures of my baking and posting it on my Social Media - different people started paying attention to my work. When I started taking pictures of my baking and posting it on my Social Media - different people started paying attention to my work.</p>
                    </div>
                </div>

                <!-- Bottom Row -->
                <div class="about-bottom">
                    <div class="about-text-left">
                        <h2 class="about-b">Made with <br> <span class="text-mint">love</span></h2>
                        <p>Our production is 100% handmade. It also explains why we bake naked cakes. These cakes, easily recognized by their exposed layers and minimal garnishes, where we want to show off the cake and filling. For our desserts we always use only the natural ingredients, it is very important for us not just impress with the look of a dessert but also with a quality.</p>
                        <p>It also explains why we bake naked cakes. These cakes, easily recognized by their exposed layers and minimal garnishes, where we want to show off the cake and filling. It also explains why we bake naked cakes. These cakes, easily recognized by their exposed layers and minimal garnishes, where we want to show off the cake and filling.</p>
                    </div>
                    <div class="about-image-right">
                        <img src="img/cake-about.png" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>

  <script src="/js/dashboard.js"></script>

@endsection