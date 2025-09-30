<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAKE - Login</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>

    <section id="log" class="section_log">
        <div class="container">

            <h2 class="section_title">Login</h2>

            <form action="{{ route('auth.logined') }}" method="POST" class="log_form">
                @csrf
                <div class="form_group">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_group">
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required>
                </div> <br>

                <button type="submit" class="log_button">Login</button><br>

                <p>Don't have an account? <a href='/register'>Register here</a>.</p> <br>
            </form>

        </div>
    </section>

</body>
</html>