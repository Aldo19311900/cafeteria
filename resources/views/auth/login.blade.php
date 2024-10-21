<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-image: url('images/segunda.jpg');
                background-size: cover;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .login-container {
                background-color: rgba(255, 255, 255, 0.9);
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                width: 100%;
                text-align: center;
            }

            .login-container h1 {
                margin-bottom: 20px;
                font-size: 24px;
            }

            .login-container input[type="text"],
            .login-container input[type="password"] {
                width: 80%;
                padding: 10px;
                margin: 10px 0;
                border-radius: 4px;
                border: 1px solid #ccc;
            }

            .login-container input[type="submit"] {
                background-color: #ff4500;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                width: 100%;
            }

            .login-container input[type="submit"]:hover {
                background-color: #e63e00;
            }

            .login-container a {
                display: block;
                margin-top: 10px;
                color: #ff4500;
                text-decoration: none;
            }

            .login-container a:hover {
                text-decoration: underline;
            }

            .transparent-img {
            opacity: 0.5; /* Establece el nivel de transparencia */
            }
            
        </style>
        <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
</head>
<body>
    <div class="login-container">
        <img src="images/logouth.png" width="70%" class="transparent-img">
        <h1>Iniciar Sesión</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mt-4">
                    <x-text-input id="email" class="block mt-1 w-full" 
                        type="text" 
                        name="email" 
                        required autofocus autocomplete="username" 
                        placeholder="Email"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" 
                        placeholder="Password"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recordarme') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu password?') }}
                        </a>
                    @endif

                    <div>
                        <button class="submit">
                            <input type="submit" value="Ingresar">
                        </button>
                    </div>
                </div>
            </form>
    </div>

</html>
