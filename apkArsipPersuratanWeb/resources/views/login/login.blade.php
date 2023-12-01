<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="{{ asset('css/login_style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Login landing page</title>
</head>
<body>
    <section class="side">
        <img src="{{ asset('images/logo_a.png') }}" alt="">
    </section>

    <section class="main">
        <div class="login-container">
            <p class="title">TATA USAHA</p>
            <div class="separator"></div>
            <p class="welcome-message">
                -ARCHIE- 
                <br>
                Untuk Segala Kebutuhan Persuratan Anda ^^
            </p>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            <form action="" method="POST" class="login-form">
                @csrf
                <div class="form-control">
                    <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                    <input type="password" placeholder="Password" name="password">
                    <i class="fas fa-lock"></i>
                </div>

                <button class="submit">Login</button>
            </form>
        </div>
    </section>
    
</body>
</html>