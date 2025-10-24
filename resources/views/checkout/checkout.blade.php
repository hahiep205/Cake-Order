@extends('layouts.app')

@section('title', 'CAKES - Checkout')

@section('content')

    <section id="checkout" class="section section_checkout">
        <div class="container checkout">

            <h2 class="section_title"><i class="ri-shopping-bag-line"></i> Checkout</h2>

            <div class="checkout_container">

                <!-- Section 1: Customer Info -->
                <div class="checkout_section">
                    <h3 class="section_header">
                        Delivery Information
                    </h3>
                    <div class="customer_info">
                        <div class="info_item">
                            <label>Name:</label>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="info_item">
                            <label>Phone:</label>
                            <span>{{ $user->phone }}</span>
                        </div>
                        <div class="info_item">
                            <label>Address:</label>
                            <span>{{ $user->address }}</span>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Order Items -->
                <div class="checkout_section">
                    <h3 class="section_header">
                        Order Summary
                    </h3>
                    <div class="order_items">
                        @foreach($cartItems as $item)
                            <div class="order_item">
                                <div class="item_image">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('product_img/' . $item->product->image) }}" alt="{{ $item->product_name }}">
                                    @else
                                        <img src="{{ asset('img/cake1-1.jpg') }}" alt="{{ $item->product_name }}">
                                    @endif
                                </div>
                                <div class="item_details">
                                    <h4 class="item_name">{{ $item->product_name }}</h4>
                                    <p class="item_code">{{ $item->product_id }}</p>
                                    <p class="item_price">${{ number_format($item->price, 2) }} × {{ $item->quantity }}</p>
                                    @if($item->note)
                                        <p class="item_note">Note: {{ $item->note }}</p>
                                    @endif
                                </div>
                                <div class="item_total">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Section 3: Payment -->
                <div class="checkout_section">
                    <h3 class="section_header">
                        Payment Details
                    </h3>
                    
                    <div class="payment_summary">
                        <div class="summary_line">
                            <span>Subtotal</span>
                            <span>${{ number_format($totalAmount, 2) }}</span>
                        </div>
                        <div class="summary_line">
                            <span>Shipping</span>
                            <span>$0.00</span>
                        </div>
                        <div class="summary_total">
                            <span>Total</span>
                            <span>${{ number_format($totalAmount, 2) }}</span>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('checkout.process') }}" id="checkoutForm">
                        @csrf
                        <div class="payment_methods">
                            <h4>Payment Method</h4>
                            <label class="payment_option">
                                <input type="radio" name="payment_method" value="COD" checked>
                                <span class="checkmark"></span>
                                <div class="method_info">
                                    <strong>Cash on Delivery (COD)</strong>
                                    <p>Pay when you receive your order</p>
                                </div>
                            </label>
                            <label class="payment_option">
                                <input type="radio" name="payment_method" value="Banking">
                                <span class="checkmark"></span>
                                <div class="method_info">
                                    <strong>Bank Transfer (COMING SOON..!)</strong>
                                    <p>Pay via online banking</p>
                                </div>
                            </label>
                        </div>
                        
                        <button type="submit" class="order_btn hover-slide-left">
                            <i class="ri-shopping-bag-line"></i>
                            Order Now
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </section>

    <script src="/js/header-scrolled.js"></script>

@endsection