<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAKE - Login</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/log.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>

    @include('header')

    <section id="log" class="section_log">
        <div class="log_container">

            <h2 class="section_title">Login</h2>

            <form action="{{ route('auth.logined') }}" method="POST" class="log_form">
                @csrf
                <div class="form_group">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_group">
                    <label for="password"><strong>Password</strong></label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="log_button">LOGIN</button>

                <p class="log_link_text">Don't have an account? <a href='/register'>Register here</a></p>
            </form>

        </div>
    </section>

    @include('footer')

</body>
</html>