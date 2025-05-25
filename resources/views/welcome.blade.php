<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRM - Accueil</title>
    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: Verdana, sans-serif;
        text-decoration: none;
    }
    
    body {
        font-family: Verdana, sans-serif;
        font-size: 14px;
        position: relative;
        min-height: 100vh;
        color: #D5D7CC;
    }
    
    .background-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: url("{{ asset('images/safi3.jpeg') }}") center/cover no-repeat;
        z-index: -1;
        filter: brightness(0.7);
    }
    
    header {
        max-width: 90%;
        margin: 0 auto;
        padding-top: 20px;
    }
    
    nav {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        width: 100%;
        padding: 20px 0;
    }
    
    .logo-container {
        display: flex;
        align-items: center;
    }
    
    .logo {
        width: 200px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
    }
    
    .company-name {
        color: #D5D7CC;
        font-size: 1.5rem;
        font-weight: bold;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }
    
    nav ul {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        padding-right: 20px;
    }
    
    nav ul li {
        list-style: none;
        margin-left: 25px;
    }
    
    nav ul li a {
        color: #D5D7CC;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        padding: 5px 10px;
        border-radius: 3px;
    }
    
    nav ul li a:hover {
        color: #5e152f;
    }
    
    .main-content {
        max-width: 80%;
        margin: 100px auto 0;
        padding: 30px;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 10px;
        backdrop-filter: blur(5px);
    }
    
    .main-content h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #fff;
    }
    
    .main-content p {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 30px;
    }
    
    .auth-links {
        display: flex;
        gap: 15px;
    }
    
    .auth-link {
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    
    .login-btn {
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid #D5D7CC;
        color: #D5D7CC;
    }
    
    .login-btn:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
    }
    
    .register-btn {
        background-color: #5e152f;
        color: white;
        border: 1px solid #5e152f;
    }
    
    .register-btn:hover {
        background-color: #013a63;
    }
    
    @media (max-width: 768px) {
        nav {
            flex-direction: column;
        }
        
        nav ul {
            margin-top: 20px;
            justify-content: center;
            padding-right: 0;
        }
        
        .main-content {
            max-width: 95%;
            margin-top: 50px;
        }
    }
    </style>
</head>
<body>
    <div class="background-overlay"></div>
    
    <header>
        <nav>
            <div class="logo-container">
                <img src="{{ asset('images/srm.png') }}" alt="Logo SRM" class="logo">
            </div>
            
            <ul>
                <li><a href="#">Accueil</a></li>

                @if (Route::has('login'))
                    @auth
                        @if (auth()->user()->role === 'admin_general')
                            <li><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                        @elseif (auth()->user()->role === 'technicien')
                            <li><a href="{{ route('technicien.dashboard') }}">Tableau de bord</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">Connexion</a></li>
                    @endauth
                @endif
            </ul>

        </nav>
    </header>
    
    <main class="main-content">
        <h1>Bienvenue </h1>
        <p>
            Système de gestion des ressources matérielles pour une optimisation 
            complète de votre parc d'équipements et une meilleure allocation 
            des moyens techniques.
        </p>
        
        <div class="auth-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="auth-link login-btn">Tableau de bord</a>
                @else
                    <a href="{{ route('login') }}" class="auth-link login-btn">Se connecter</a>
                   
                @endauth
            @endif
        </div>
    </main>
</body>
</html>