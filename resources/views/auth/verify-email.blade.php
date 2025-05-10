<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SBN - Vérification d'email</title>
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
        
        .login-content {
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
        
        .success-message {
            color: var(--success);
            font-size: 0.9375rem;
            margin-bottom: 1.75rem;
            text-align: center;
            font-weight: 500;
        }
        
        .actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
        }
        
        .resend-btn {
            padding: 0.875rem 1.5rem;
            background-color: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .resend-btn:hover {
            background-color: var(--primary-hover);
        }
        
        .logout-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9375rem;
            transition: color 0.2s;
        }
        
        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Logo en haut à gauche -->
    <div class="logo-container">
        <img src="{{ asset('images/sbn-logo.png') }}" alt="SBN Logo" class="logo">
    </div>

    <!-- Carte de vérification -->
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <h1 class="login-title">Vérification d'email</h1>
            </div>
            
            <div class="login-body">
                <div class="login-content">
                    <!-- Message d'information -->
                    <div class="info-text">
                        Merci pour votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer ? Si vous n'avez pas reçu l'email, nous vous en enverrons un autre avec plaisir.
                    </div>

                    <!-- Message de succès -->
                    @if (session('status') == 'verification-link-sent')
                        <div class="success-message">
                            Un nouveau lien de vérification a été envoyé à l'adresse email que vous avez fournie lors de l'inscription.
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="actions-row">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="resend-btn">
                                Renvoyer l'email de vérification
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-link">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>