<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAKE - Register</title>
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/log.css">
    <link rel="stylesheet" href="/css/notification.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>

    @include('header')

    <section id="log" class="section_log">
        <div class="log_container">

            <h2 class="section_title">Register</h2>

            <form action="/register" method="POST" class="log_form">
                @csrf
                <div class="form_group">
                    <label for="name"><strong>Name</strong></label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form_group">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_group">
                    <label for="password"><strong>Password</strong></label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="log_button">REGISTER</button>

                <p class="log_link_text">Have an account? <a href='/login'>Login here</a></p>
            </form>

        </div>
    </section>

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

</body>

</html>