@extends('layouts.app')

@section('title', 'CAKES - Cart')

@section('content')

    <section id="cart" class="section section_cart">
        <div class="container cart">

            <h2 class="section_title"><i class="ri-shopping-cart-line"></i> Shopping Cart</h2>

            @if($cartItems->isEmpty())
                <!-- Giỏ hàng trống -->
                <div style="text-align: center; padding: 3rem 0;">
                    <i class="ri-shopping-cart-line" style="font-size: 5rem; color: #ddd;"></i>
                    <p style="font-size: 1.2rem; color: #666; margin: 1rem 0;">Your cart is empty</p>
                    <a href="{{ route('dashboard') }}#products" style="text-decoration: none;">
                        <button class="continue_btn hover-slide-left"
                            style="margin-top: 1rem; margin-left: 2rem; transform: translateY(3rem);">
                            <i class="ri-arrow-left-line"></i> CONTINUE SHOPPING
                        </button>
                    </a>
                </div>
            @else
                <!-- Giỏ hàng có sản phẩm -->
                <div class="cart_container">

                    <!-- Danh sách sản phẩm -->
                    <div class="cart_items">

                        @foreach($cartItems as $item)
                            <div class="cart_item" data-item-id="{{ $item->id }}" data-price="{{ $item->price }}">
                                <div class="cart_item_image">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('product_img/' . $item->product->image) }}" alt="{{ $item->product_name }}">
                                    @else
                                        <img src="{{ asset('img/cake1-1.jpg') }}" alt="{{ $item->product_name }}">
                                    @endif
                                </div>
                                <div class="cart_item_details">

                                    <h3 class="cart_item_name">{{ $item->product_name }}</h3>

                                    <p class="cart_item_code">{{ $item->product_id }}</p>

                                    <div class="form_group">
                                        <label for="note_{{ $item->id }}"><strong>Note:</strong></label><br>
                                        <textarea id="note_{{ $item->id }}" name="note" rows="2" class="note_textarea"
                                            data-item-id="{{ $item->id }}"
                                            placeholder="Add a note for this item...">{{ $item->note }}</textarea>
                                    </div>

                                    <div class="cart_item_price">
                                        $<span class="item_total">{{ number_format($item->price * $item->quantity, 2) }}</span>
                                    </div>

                                    <div class="cart_item_actions">

                                        <div class="quantity_controls">
                                            <button class="quantity_btn btn_decrease" data-item-id="{{ $item->id }}">-</button>
                                            <span class="quantity" data-item-id="{{ $item->id }}">{{ $item->quantity }}</span>
                                            <button class="quantity_btn btn_increase" data-item-id="{{ $item->id }}">+</button>
                                        </div>

                                        <button class="remove_btn" data-item-id="{{ $item->id }}">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Button Continue Shopping -->
                        <div class="continue_shopping">
                            <a href="{{ route('dashboard') }}#products">
                                <button class="continue_btn hover-slide-left">
                                    <i class="ri-arrow-left-line"></i> CONTINUE SHOPPING
                                </button>
                            </a>
                        </div>

                    </div>

                    <!-- Bảng tính tiền -->
                    <div class="order_summary">
                        <div class="summary_box">
                            <h3 class="summary_title">ORDER SUMMARY</h3>

                            <div class="summary_line">
                                <span class="items_count_label">Items:</span>
                                <span id="items_count">{{ $itemsCount }}</span>
                            </div>

                            <div class="summary_line">
                                <span>Subtotal</span>
                                <span>$<span id="subtotal">{{ number_format($totalAmount, 2) }}</span></span>
                            </div>

                            <div class="summary_line">
                                <span>Discount</span>
                                <span>$<span id="discount">0.00</span></span>
                            </div>

                            <div class="summary_total">
                                <span>Total</span>
                                <span>$<span id="total_amount">{{ number_format($totalAmount, 2) }}</span></span>
                            </div>

                            <p class="summary_note">Free shipping on all orders.</p>

                            <button class="checkout_btn hover-slide-left">PROCEED TO CHECKOUT</button>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <script src="/js/header-scrolled.js"></script>
    <script src="/js/cart.js"></script>

@endsection