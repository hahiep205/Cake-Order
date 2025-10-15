<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Managenment</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/log.css">
    <link rel="stylesheet" href="/css/notification.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/modals.css">
    <link rel="stylesheet" href="/css/admin-management.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="admin_page">

    @include('header')

    <!-- Notification Container -->
    <div id="notificationContainer" class="notification-container"></div>

    <div class="container">
        <div class="admin_layout">

            <!-- SIDEBAR -->
            <div class="admin_sidebar">
                <h3 class="sidebar_title">ADMIN PANEL</h3>
                <ul class="sidebar_menu">

                    <li class="menu_item active" data-section="products">
                        <i class="ri-cake-line"></i>
                        <span>Product Management</span>
                    </li>

                    <li class="menu_item" data-section="users">
                        <i class="ri-user-line"></i>
                        <span>User Management</span>
                    </li>

                    <li class="menu_item" data-section="menu">
                        <i class="ri-box-3-line"></i>
                        <span>Menu Management</span>
                    </li>

                    <li class="menu_item" data-section="orders">
                        <i class="ri-shopping-cart-line"></i>
                        <span>Order Management</span>
                    </li>

                </ul>
            </div>

            <!-- MAIN CONTENT -->
            <div class="admin_content">

                <!-- Section: Product Management -->
                <div class="content_section active" id="section_products">
                    @include('admin.products')
                </div>

                <!-- Section: User Management -->
                <div class="content_section" id="section_users">
                    @include('admin.users')
                </div>

                <!-- Section: Menu Management -->
                <div class="content_section" id="section_menu">
                    @include('admin.menu')
                </div>

                <!-- Section: Order Management -->
                <div class="content_section" id="section_orders">
                    @include('admin.orders')
                </div>

            </div>

        </div>
    </div>

    @include('footer')

    <!-- Form ẩn để xử lý DELETE request -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Product Management Modals -->
    @include('modals.product-management.edit-product')
    @include('modals.product-management.add-product')
    @include('modals.product-management.delete-confirm')

    <!-- User Management Modals -->
    @include('modals.user-management.edit-user')
    @include('modals.user-management.add-user')
    @include('modals.user-management.delete-confirm')

    <!-- Include JavaScript Files -->
    <script src="{{asset('js/notification.js')}}"></script>
    <script src="{{asset('js/admin-menu.js')}}"></script>
    <script src="{{asset('js/product-management.js')}}"></script>
    <script src="{{asset('js/user-management.js')}}"></script>
    <script src="{{asset('js/menu-management.js')}}"></script>
    <script src="{{asset('js/modal-handler.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>

    <!-- Notification Handler -->
    <script>
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function () {
                showNotification('{{ session('success') }}', 'success');
            });
        @endif

        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function () {
                showNotification('{{ session('error') }}', 'error');
            });
        @endif

        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function () {
                showNotification('{{ $errors->first() }}', 'error');
            });
        @endif
    </script>

</body>

</html>