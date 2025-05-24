<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRM - Connexion</title>
    <style>
        :root {
            --primary: #7a1c3f;
            --primary-hover: #5e152f;
            --secondary: #9e2a5b;
            --text: #2d3748;
            --light-text: #718096;
            --border: #e2e8f0;
            --input-bg: #f7fafc;
            --white: #ffffff;
            --focus-ring: rgba(122, 28, 63, 0.3);
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            background-color: #f9fafb;
            line-height: 1.5;
        }
        
        .left-column {
            flex: 0.6;
            background-image: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: white;
            text-align: center;
        }
        
        .right-column {
            flex: 1.1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: #f9fafb;
        }
        
        .logo-container {
            margin-bottom: 2.5rem;
        }
        
        .logo {
            width: 400px;
            height: auto;
            object-fit: contain;
        }
        
        .left-column h1 {
            font-size: 2rem;
            margin-bottom: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        
        .left-column h2 {
            font-size: 1.25rem;
            font-weight: 400;
            opacity: 0.95;
            margin-top: 0;
        }
        
        .login-form-container {
            width: 100%;
            max-width: 420px;
            padding: 0;
        }
        
        .login-header {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .login-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0 0 0.25rem 0;
            color: var(--text);
        }
        
        .login-subtitle {
            font-size: 0.9375rem;
            color: var(--light-text);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9375rem;
            font-weight: 500;
            color: var(--text);
        }
        
        input {
            width: 100%;
            padding: 0.875rem;
            background-color: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            font-size: 0.9375rem;
            transition: all 0.2s;
            box-sizing: border-box;
        }
        
        input:hover {
            border-color: #cbd5e0;
        }
        
        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--focus-ring);
            background-color: var(--white);
        }
        
        .login-btn {
            width: 100%;
            padding: 0.875rem;
            background-color: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 0.375rem;
            font-weight: 500;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.5rem;
        }
        
        .login-btn:hover {
            background-color: var(--primary-hover);
        }
        
        .forgot-password {
            display: block;
            text-align: right;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 1024px) {
            .left-column {
                flex: 0.7;
            }
            .right-column {
                flex: 1;
            }
        }
        
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .left-column, .right-column {
                flex: 1;
                padding: 2rem 1.5rem;
            }
            .logo {
                width: 320px;
            }
        }
        
        @media (max-width: 640px) {
            .logo {
                width: 280px;
            }
            .left-column h1 {
                font-size: 1.75rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Colonne de gauche -->
    <div class="left-column">
        <div class="logo-container">
            <img src="{{ asset('images/srmLogoWithout.png') }}" alt="Logo SRM" class="logo">
        </div>
        <h1>SRM-MS</h1>
        <h2>Direction provinciale Safi</h2>
    </div>

    <!-- Colonne de droite - Formulaire sans card -->
    <div class="right-column">
        <div class="login-form-container">
            <div class="login-header">
                <h1 class="login-title">CONNEXION</h1>
                <p class="login-subtitle">Connectez-vous pour accéder à votre compte</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password" required>
                    <a href="{{ route('password.request') }}" class="forgot-password">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="login-btn">SE CONNECTER</button>
            </form>
        </div>
    </div>
</body>
</html>