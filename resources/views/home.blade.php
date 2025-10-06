@extends('layouts.app')

@section('title', 'Sweet Bakery - Home')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pacifico&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/home.css">
@endpush

@section('content')

    <!-- Home Section -->
    <section class="hero_section" id="home" style="background-image: url('/images/banner/home-background.png');">
        <div class="container">
            <div class="hero_content">
                <h1 class="hero_title">Sweet Cake</h1>
                <h2 class="hero_subtitle">HANDCAKE WITH LOVE</h2>
                <p class="hero_description">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tinci dunt ut laoreet dolore magna aliquam erat volutpat.
                </p>
                <p class="hero_hashtag">#sweetcake</p>
                <a href="#about" class="hero_button">SEE ABOUT</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section_about" id="about" style="background-image: url('/images/banner/about.png');">
        <div class="container">
            <div class="about_content">
                <div class="about_text">
                    <h2 class="section_title">About Us</h2>
                    <p class="section_subtitle">Our Sweet Story</p>
                    <p class="about_description">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tinci dunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                    </p>
                    <p class="about_description">
                        Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                    </p>
                    <a href="#products" class="hero_button">ORDER NOW</a>
                </div>
                {{-- <div class="about_image">
                    <img src="/images/banner/about-image.jpg" alt="About Sweet Cake">
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="section_products" id="products">
        <div class="container">
            <div class="section_header">
                <h3 class="section_title" style="font-size: 2.4rem">Our Products</h3>
                <p class="section_subtitle">Handcrafted with love, baked to perfection</p>
            </div>
            
            <div class="products_grid">
                @foreach($products as $product)
                    <div class="product_card">
                        <div class="product_image_wrapper">
                            <img src="{{ asset('images/cakes/' . $product->image) }}" alt="{{ $product->product_name }}" class="product_image">
                        </div>
                        <div class="product_info">
                            <h3 class="product_name">{{ $product->product_name }}</h3>
                            <p class="product_description">{{ $product->description }}</p>
                            <div class="product_footer">
                                <span class="product_price">${{ number_format($product->price, 2) }}</span>
                                <button class="product_button">
                                    <i class="ri-shopping-cart-line"></i> Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <!-- Contact Section -->
    <section class="section_contact" id="contact">
        <div class="container">
            <div class="section_header">
                <h3 class="section_title"  style="font-size: 2.4rem">Contact Us</h3>
                <p class="section_subtitle">We'd love to hear from you</p>
            </div>
            
            <div class="contact_content">
                <div class="contact_info">
                    <div class="contact_item">
                        <div class="contact_item_icon">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <div class="contact_item_text">
                            <h3>Address</h3>
                            <p>123 Sweet Street, Bakery Town, BK 12345</p>
                        </div>
                    </div>
                    <div class="contact_item">
                        <div class="contact_item_icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div class="contact_item_text">
                            <h3>Phone</h3>
                            <p>+1 (234) 567-8900</p>
                        </div>
                    </div>
                    <div class="contact_item">
                        <div class="contact_item_icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div class="contact_item_text">
                            <h3>Email</h3>
                            <p>info@sweetcake.com</p>
                        </div>
                    </div>
                    <div class="contact_item">
                        <div class="contact_item_icon">
                            <i class="ri-time-line"></i>
                        </div>
                        <div class="contact_item_text">
                            <h3>Opening Hours</h3>
                            <p>Mon - Sat: 8:00 AM - 8:00 PM</p>
                            <p>Sunday: 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>
                
                <form class="contact_form" action="/contact" method="POST">
                    @csrf
                    <div class="form_group">
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form_group">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form_group">
                        <input type="text" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form_group">
                        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="hero_button">Send Message</button>
                </form>
            </div>
        </div>
    </section>

@endsection