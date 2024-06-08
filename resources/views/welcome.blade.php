<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1544947950-fa07a98d237f') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Figtree', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            max-width: 400px;
            width: 100%;
        }
        .register-link {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 0.875rem;
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link:hover {
            color: #4338ca;
        }
        h2 {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
        form {
            width: 100%;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4a4a4a;
            margin-bottom: 0.5rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }
        .form-group input:focus {
            border-color: #4f46e5;
            outline: none;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .form-actions .remember-me {
            display: flex;
            align-items: center;
        }
        .form-actions .remember-me input {
            margin-right: 0.5rem;
        }
        .form-actions .forgot-password {
            font-size: 0.875rem;
            color: #4f46e5;
            text-decoration: none;
        }
        .form-actions .forgot-password:hover {
            color: #4338ca;
        }
        .submit-button {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 0.25rem;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            background-color: #4f46e5;
            cursor: pointer;
        }
        .submit-button:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <a href="{{ route('register') }}" class="register-link">Registrarse</a>
        <h2>Iniciar sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" name="email" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="form-actions">
                <div class="remember-me">
                    <input id="remember_me" name="remember" type="checkbox">
                    <label for="remember_me">Recordarme</label>
                </div>
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" class="submit-button">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
