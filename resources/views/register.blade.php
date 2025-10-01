<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAKE - Register</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>

    @include('header')

    <section id="log" class="section_log">
        <div class="container">

            <h2 class="section_title">Register</h2>

            <form action="/register" method="POST" class="log_form">
                @csrf
                <div class="form_group">
                    <label for="name"><strong>Name:</strong></label><br>
                    <input type="name" id="name" name="name" required>
                </div>
                <div class="form_group">
                    <label for="email"><strong>Email:</strong></label><br>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_group">
                    <label for="password"><strong>Password:</strong></label><br>
                    <input type="password" id="password" name="password" required>
                </div><br>

                <button type="submit" class="log_button">REGISTER</button><br>

                <p>Have an account? <a href='/login'>Login here</a>.</p><br>
            </form>

        </div>
    </section>

    @include('footer')

</body>

</html>