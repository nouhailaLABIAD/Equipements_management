<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SBN - Réinitialisation de mot de passe</title>
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
            --success: #16a34a;
            --error: #dc2626;
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
            height: 40px;
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
            max-width: 500px;
            background: var(--form-bg);
            border-radius: 0.75rem;
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        
        .login-header {
            padding: 2.5rem 2.5rem 1rem;
            text-align: center;
        }
        
        .login-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
            color: var(--text);
        }
        
        .login-body {
            padding: 0 2.5rem 2.5rem;
        }
        
        .login-form {
            max-width: 380px;
            margin: 0 auto;
        }
        
        .info-text {
            color: var(--light-text);
            font-size: 0.9375rem;
            margin-bottom: 1.75rem;
            text-align: center;
            line-height: 1.5;
        }
        
        .form-group {
            margin-bottom: 1.75rem;
            width: 100%;
        }
        
        label {
            display: block;
            margin-bottom: 0.75rem;
            font-size: 0.9375rem;
            font-weight: 500;
            color: var(--text);
        }
        
        input {
            width: 100%;
            padding: 1rem;
            background-color: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.2s;
            box-sizing: border-box;
        }
        
        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background-color: var(--white);
        }
        
        .auth-session-status {
            color: var(--success);
            font-size: 0.9375rem;
            margin-bottom: 1.75rem;
            text-align: center;
            font-weight: 500;
        }
        
        .input-error {
            color: var(--error);
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        
        .login-btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 1rem;
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
        <img src="{{ asset('images/sbn-logo.png') }}" alt="SBN Logo" class="logo">
    </div>

    <!-- Carte de réinitialisation -->
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <h1 class="login-title">Réinitialisation de mot de passe</h1>
            </div>
            
            <div class="login-body">
                <form method="POST" action="{{ route('password.email') }}" class="login-form">
                    <!-- Message d'information -->
                    <div class="info-text">
                        Mot de passe oublié ? Aucun problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation.
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="auth-session-status">
                            {{ session('status') }}
                        </div>
                    @endif

                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <div class="input-error">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit" class="login-btn">
                        Envoyer le lien de réinitialisation
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>