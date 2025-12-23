@extends('layouts.app')

@section('title', 'CAKES - Your Orders')

@section('content')

    <section id="orders" class="section section_orders">
        <div class="container orders_page">

            <h2 class="section_title"><i class="ri-file-list-3-line"></i> My Orders</h2>

            @if($orders->isEmpty())
                <!-- Empty State -->
                <div class="empty_orders_state">
                    <p>You haven't placed any orders. Start shopping to see your orders here!</p>
                    <a href="{{ route('dashboard') }}#products">
                        <button class="shop_now_button">Shop Now</button>
                    </a>
                </div>
            @else
                <!-- Orders List -->
                <div class="orders_list_container">
                    @foreach($orders as $order)
                        <div class="single_order_card">
                            
                            <!-- Order Header -->
                            <div class="order_header_info">
                                <div class="order_basic_info">
                                    <h3>{{ $order->order_number }}</h3>
                                    <p>{{ $order->created_at->format('M d, Y - H:i') }}</p>
                                </div>
                                <div class="order_status_display">
                                    <span class="order_status_badge badge_{{ strtolower($order->status) }}">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Order Products -->
                            <div class="order_products_list">
                                @foreach($order->orderItems as $item)
                                    <div class="single_order_product">
                                        <div class="order_product_image">
                                            {{-- ✅ SỬA LẠI: ƯU TIÊN product_image từ order_items --}}
                                            @if($item->product_image)
                                                <img src="{{ asset('product_img/' . $item->product_image) }}" alt="{{ $item->product_name }}">
                                            @elseif($item->product && $item->product->image)
                                                <img src="{{ asset('product_img/' . $item->product->image) }}" alt="{{ $item->product_name }}">
                                            @else
                                                <img src="{{ asset('product_img/cake1-1.jpg') }}" alt="{{ $item->product_name }}">
                                            @endif
                                        </div>
                                        <div class="order_product_details">
                                            <h4 class="order_product_name">{{ $item->product_name }}</h4>
                                            <p class="order_product_code">{{ $item->product_id }}</p>
                                            <p class="order_product_price">${{ number_format($item->unit_price, 2) }} × {{ $item->quantity }}</p>
                                            @if($item->note)
                                                <p class="order_product_note">Note: {{ $item->note }}</p>
                                            @endif
                                        </div>
                                        <div class="order_product_total">
                                            ${{ number_format($item->item_total, 2) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Order Footer -->
                            <div class="order_footer_summary">
                                <div class="order_summary_details">
                                    <span class="order_payment_info">
                                        <i class="ri-money-dollar-circle-line"></i>
                                        {{ $order->payment_method }}
                                    </span>
                                    <span class="order_items_count">
                                        {{ $order->orderItems->count() }} item(s)
                                    </span>
                                </div>
                                <div class="order_grand_total">
                                    ${{ number_format($order->total_amount, 2) }}
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    <script src="/js/header-scrolled.js"></script>

@endsection