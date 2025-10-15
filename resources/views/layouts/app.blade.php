<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Cake Order')</title>

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
    @stack('styles')
</head>

<body>

    @include('header')

    @yield('content')

    @include('footer')

    <script src="/js/notification.js"></script>
    <script src="/js/dashboard.js"></script>
    <script src="/js/dashboard-cart.js"></script>
    <script>
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif

        @if($errors->any())
            showNotification('{{ $errors->first() }}', 'error');
        @endif
    </script>
    @stack('scripts')

</body>

</html>