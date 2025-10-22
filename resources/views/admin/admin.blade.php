<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Managenment</title>

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

                <div class="content_section active" id="section_products">
                    @include('admin.products')
                </div>

                <div class="content_section" id="section_users">
                    @include('admin.users')
                </div>

                <div class="content_section" id="section_menu">
                    @include('admin.menu')
                </div>

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

    <!-- Image Preview Modal -->
    <div id="imagePreviewModal" class="modal">
        <div class="modal_content">
            <div class="modal_header">
                <h3>Image Preview</h3>
                <button type="button" class="modal_close" onclick="closeImagePreviewModal()">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            
            <div class="modal_body image_preview_body">
                <img id="previewImage" src="" alt="Product Image" />
            </div>
        </div>
    </div>

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