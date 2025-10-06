<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'CAKE Order')</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/log.css">
    <link rel="stylesheet" href="/css/notification.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/modals.css">
    <link rel="stylesheet" href="/css/products.css">
    <link rel="stylesheet" href="/css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    @yield('styles')

</head>

<body>

    <!-- Header -->
    @include('header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('footer')

    <script src="/js/notification.js"></script>
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