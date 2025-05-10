<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SBN - Connexion</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --text: #1f2937;
            --light-text: #6b7280;
            --border: #d1d5db;
            --input-bg: #f9fafb;
            --white: #ffffff;
            --form-bg: #ffffff;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f3f4f6;
            color: var(--text);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .logo-container {
            padding: 2rem;
        }
        
        .logo {
        width: 150px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
    }
        
        .login-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 1.5rem;
        }
        
        .login-card {
            width: 100%;
            max-width: 500px; /* Carte agrandie (était à 420px) */
            background: var(--form-bg);
            border-radius: 0.75rem;
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        
        .login-header {
            padding: 2.5rem 2.5rem 1.5rem; /* Padding augmenté */
            text-align: center;
        }
        
        .login-title {
            font-size: 1.75rem; /* Taille de police augmentée */
            font-weight: 600;
            margin: 0;
            color: var(--text);
        }
        
        .login-body {
            padding: 0 2.5rem 2.5rem; /* Padding augmenté */
        }
        
        .login-form {
            max-width: 380px; /* Formulaire légèrement élargi */
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 1.75rem; /* Espacement augmenté */
            width: 100%;
        }
        
        label {
            display: block;
            margin-bottom: 0.75rem; /* Espacement augmenté */
            font-size: 0.9375rem; /* Taille de police légèrement augmentée */
            font-weight: 500;
            color: var(--text);
        }
        
        input {
            width: 100%;
            padding: 1rem; /* Padding augmenté */
            background-color: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            font-size: 1rem; /* Taille de police augmentée */
            transition: all 0.2s;
            box-sizing: border-box;
        }
        
        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background-color: var(--white);
        }
        
        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 2rem 0; /* Espacement augmenté */
            width: 100%;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            font-size: 0.9375rem; /* Taille de police légèrement augmentée */
            color: var(--light-text);
        }
        
        .remember-me input {
            width: 1.25rem; /* Taille augmentée */
            height: 1.25rem; /* Taille augmentée */
            margin-right: 0.75rem; /* Espacement augmenté */
        }
        
        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9375rem; /* Taille de police légèrement augmentée */
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .login-btn {
            width: 100%;
            padding: 1rem; /* Padding augmenté */
            background-color: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 1rem; /* Taille de police augmentée */
            cursor: pointer;
            transition: background-color 0.2s;
            box-sizing: border-box;
        }
        
        .login-btn:hover {
            background-color: var(--primary-hover);
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Logo en haut à gauche -->
    <div class="logo-container">
        <img src="{{ asset('images/srm.png') }}" alt="SBN Logo" class="logo">
    </div>

    <!-- Carte de connexion agrandie -->
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <h1 class="login-title">Connectez-vous à votre compte</h1>
            </div>
            
            <div class="login-body">
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <!-- Mot de passe -->
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input id="password" type="password" name="password" required>
                    </div>

                    <!-- Options -->
                    <div class="options-row">
                        <div class="remember-me">
                            <input type="checkbox" id="remember_me" name="remember">
                            <label for="remember_me">Se souvenir de moi</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password">Mot de passe oublié ?</a>
                    </div>

                    <!-- Bouton de connexion - Mêmes dimensions que les inputs -->
                    <button type="submit" class="login-btn">SE CONNECTER</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>