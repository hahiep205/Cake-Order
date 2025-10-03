<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cake Order</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/log.css">
    <link rel="stylesheet" href="/css/notification.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>

    @include('header')

    <div class="container" style="padding: 11rem 0; padding-left: 1rem;">
        <h1>This is admin page.</h1>
    </div>

    @include('footer')

    <script src="/js/notification.js"></script>
    <script>
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif
    </script>

</body>
</html>