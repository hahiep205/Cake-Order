<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAKE - Register</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>

<body>

    <section id="log" class="section_log">
        <div class="container">

            <h2 class="section_title">Register</h2>

            <form action="/register" method="POST" class="log_form">
                @csrf
                <div class="form_group">
                    <label for="name">Name:</label><br>
                    <input type="name" id="name" name="name" required>
                </div>
                <div class="form_group">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_group">
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required>
                </div><br>

                <button type="submit" class="log_button">Register</button><br>

                <p>Have an account? <a href='/register'>Login here</a>.</p><br>
            </form>

        </div>
    </section>

</body>

</html>