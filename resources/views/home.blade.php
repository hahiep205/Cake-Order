@extends('layouts.app')

@section('title', 'CAKE - Trang Chủ')

@section('content')
    <!-- Hero Slider Section -->
    <section class="hero-section">
        <div class="slider-container">
            <!-- Slide 1 -->
            <div class="slide active" style="background-image: url('{{ asset('images/banner/banner1.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🎂 Chào Mừng Đến Với Cakes</h1>
                    <p>Bánh Kem Tươi Ngon - Làm Từ Tình Yêu</p>
                    <button class="btn-order" style="width: auto; padding: 12px 40px;"
                        onclick="location.href='#products'">Xem Sản Phẩm</button>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide" style="background-image: url('{{ asset('images/banner/banner2.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🍰 Bánh Sinh Nhật Đặc Biệt</h1>
                    <p>Tạo Nên Kỷ Niệm Ngọt Ngào</p>
                    <button class="btn-order" style="width: auto; padding: 12px 40px;"
                        onclick="location.href='#products'">Đặt Hàng Ngay</button>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide" style="background-image: url('{{ asset('images/banner/banner3.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🎉 Ưu Đãi Đặc Biệt</h1>
                    <p>Giảm Giá Lên Đến 20% Cho Đơn Hàng Đầu Tiên</p>
                    <button class="btn-order" style="width: auto; padding: 12px 40px;"
                        onclick="location.href='#products'">Khám Phá Ngay</button>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button class="slider-arrow prev" onclick="changeSlide(-1)">❮</button>
            <button class="slider-arrow next" onclick="changeSlide(1)">❯</button>

            <!-- Dots -->
            <div class="slider-dots">
                <span class="dot active" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section" id="products">
        <h2 style="text-align: center; margin-bottom: 40px; font-size: 2.5rem; color: #333;">Sản Phẩm Nổi Bật</h2>

        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ asset('images/cakes/' . $product['image']) }}" alt="{{ $product['name'] }}"
                        class="product-image">
                    <div class="product-info">
                        <h3>{{ $product['name'] }}</h3>
                        <p>{{ $product['description'] }}</p>
                        <div class="price">{{ $product['price'] }}</div>
                        <button class="btn-order">Đặt Hàng Ngay</button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        let autoSlideInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                dots[i].classList.remove('active');
            });

            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function changeSlide(direction) {
            currentIndex += direction;
            if (currentIndex >= slides.length) currentIndex = 0;
            if (currentIndex < 0) currentIndex = slides.length - 1;
            showSlide(currentIndex);
            resetAutoSlide();
        }

        function currentSlide(index) {
            currentIndex = index;
            showSlide(currentIndex);
            resetAutoSlide();
        }

        function autoSlide() {
            currentIndex++;
            if (currentIndex >= slides.length) currentIndex = 0;
            showSlide(currentIndex);
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(autoSlide, 4000);
        }

        autoSlideInterval = setInterval(autoSlide, 4000);
    </script>
@endsection