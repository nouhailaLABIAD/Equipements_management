<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #7a1c3f;  /* Rouge bordeaux */
            --primary-light: #9e2a5b;
            --primary-dark: #5e152f;
            --secondary: #8b5a2b;  /* Marron/terre */
            --danger: #c53030;    /* Rouge plus chaud */
            --warning: #dd6b20;   /* Orange terre */
            --info: #4c51bf;      /* Bleu profond */
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #e2e8f0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: var(--dark);
        }
        
        /* Main content styling */
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.5rem;
        }
        
        /* Welcome section */
        .welcome-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(226, 232, 240, 0.5);
        }
        
        .welcome-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
        
        .welcome-subtitle {
            color: var(--gray);
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
            max-width: 600px;
            line-height: 1.6;
        }
        
        /* Stats cards grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            border: 1px solid rgba(226, 232, 240, 0.7);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }
        
        .stat-card:nth-child(1)::before { background: var(--primary); }
        .stat-card:nth-child(2)::before { background: var(--secondary); }
        .stat-card:nth-child(3)::before { background: var(--info); }
        .stat-card:nth-child(4)::before { background: var(--warning); }
        .stat-card:nth-child(5)::before { background: var(--danger); }
        
        .stat-card-title {
            color: var(--gray);
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }
        
        .stat-card-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .stat-card-footer {
            color: #94a3b8;
            font-size: 0.75rem;
            border-top: 1px dashed var(--gray-light);
            padding-top: 0.75rem;
            display: flex;
            align-items: center;
        }
        
        /* Main content grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        @media (min-width: 1024px) {
            .content-grid {
                grid-template-columns: 2fr 1fr;
            }
        }
        
        /* Cards styling */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(226, 232, 240, 0.5);
            overflow: hidden;
        }
        
        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(226, 232, 240, 0.7);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-title {
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .card-title-icon {
            margin-right: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(122, 28, 63, 0.1); /* Couleur primaire avec opacité */
            color: var(--primary);
        }
        
        .card-link {
            color: var(--primary);
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }
        
        .card-link:hover {
            color: var(--primary-dark);
        }
        
        .card-link svg {
            margin-left: 0.25rem;
            width: 1rem;
            height: 1rem;
        }
        
        /* Equipement list items */
        .equipement-item {
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s;
            border-bottom: 1px dashed var(--gray-light);
        }
        
        .equipement-item:last-child {
            border-bottom: none;
        }
        
        .equipement-item:hover {
            background-color: rgba(248, 250, 252, 0.7);
        }
        
        .equipement-info {
            display: flex;
            align-items: center;
        }
        
        .equipement-icon {
            margin-right: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(226, 232, 240, 0.5);
            color: var(--gray);
        }
        
        .equipement-name {
            font-weight: 500;
            color: var(--dark);
        }
        
        .equipement-meta {
            display: flex;
            align-items: center;
            margin-top: 0.25rem;
        }
        
        .equipement-state {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-weight: 500;
        }
        
        .state-neuf { background: rgba(122, 28, 63, 0.1); color: var(--primary); }
        .state-bon { background: rgba(139, 90, 43, 0.1); color: var(--secondary); }
        .state-hors { background: rgba(197, 48, 48, 0.1); color: var(--danger); }
        
        .equipement-ref {
            font-size: 0.75rem;
            color: var(--gray);
            margin-left: 0.75rem;
        }
        
        .equipement-time {
            font-size: 0.875rem;
            color: var(--gray);
        }
        
        /* Summary cards */
        .summary-card {
            padding: 1.75rem;
            text-align: center;
        }
        
        .summary-value {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .summary-label {
            color: var(--gray);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .btn-primary {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            box-shadow: 0 1px 2px 0 rgba(122, 28, 63, 0.1);
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 100%);
            box-shadow: 0 4px 6px -1px rgba(122, 28, 63, 0.2), 0 2px 4px -1px rgba(122, 28, 63, 0.1);
        }
        
        .btn-icon {
            margin-right: 0.5rem;
            width: 1rem;
            height: 1rem;
        }
        
        /* Empty state */
        .empty-state {
            padding: 3rem 1.5rem;
            text-align: center;
        }
        
        .empty-icon {
            width: 5rem;
            height: 5rem;
            margin: 0 auto 1.5rem;
            color: var(--gray-light);
        }
        
        .empty-text {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <!-- Main Content -->
        <div class="dashboard-container">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1 class="welcome-title">Bonjour, Admin</h1>
                <p class="welcome-subtitle">Aperçu de votre activité aujourd'hui et statistiques des équipements en temps réel.</p>
                
                <!-- Stats Cards Grid -->
                <div class="stats-grid">
                    <!-- Neuf -->
                    <div class="stat-card">
                        <div class="stat-card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Neuf
                        </div>
                        <div class="stat-card-value">{{ $equipementsNeufs }}</div>
                        <div class="stat-card-footer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                Dernier ajout: {{ $dernierNeufDate }}
                        </div>
                    </div>
                    
                    <!-- Bon état -->
                    <div class="stat-card">
                        <div class="stat-card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Bon état
                        </div>
                        <div class="stat-card-value">{{ $equipementsBonEtat }}</div>
                        <div class="stat-card-footer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                Dernier ajout: {{ $dernierBonEtatDate }}
                        </div>
                    </div>
                    
                    <!-- Affecté -->
                    <div class="stat-card">
                        <div class="stat-card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                            Affecté
                        </div>
                        <div class="stat-card-value">{{ $equipementsAffectes }}</div>
                        <div class="stat-card-footer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                Dernière affectation: {{ $dernierAffectationDate }}
                        </div>
                    </div>
                    
                    <!-- Hors service -->
                    <div class="stat-card">
                        <div class="stat-card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            Hors service
                        </div>
                        <div class="stat-card-value">{{ $equipementsHorsService }}</div>
                        <div class="stat-card-footer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                Dernier signalement: {{ $dernierHorsServiceDate }}
                        </div>
                    </div>
                    
                    <!-- Non affecté -->
                    <div class="stat-card">
                        <div class="stat-card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                            </svg>
                            Non affecté
                        </div>
                        <div class="stat-card-value">{{ $equipementsNonAffectes }}</div>
                        <div class="stat-card-footer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            En stock: {{ $equipementsNonAffectes }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content Grid -->
            <div class="content-grid">
                <!-- Left Column -->
                <div>
                    <!-- Recent Equipements Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="card-title-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                Derniers équipements
                            </h3>
                            <a href="{{ route('equipements.index') }}" class="card-link">
                                Voir tout
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        
                        <div>
                            @forelse ($recentEquipements as $equipement)
                            <div class="equipement-item">
                                <div class="equipement-info">
                                    <div class="equipement-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="equipement-name">{{ $equipement->nom }}</div>
                                        <div class="equipement-meta">
                                            <span class="equipement-state 
                                                @if($equipement->etat === 'Neuf') state-neuf
                                                @elseif($equipement->etat === 'Bon état') state-bon
                                                @elseif($equipement->etat === 'Hors service') state-hors
                                                @endif">
                                                {{ $equipement->etat }}
                                            </span>
                                            <span class="equipement-ref">{{ $equipement->reference }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="equipement-time">
                                    {{ $equipement->created_at->diffForHumans() }}
                                </div>
                            </div>
                            @empty
                            <div class="empty-state">
                                <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <p class="empty-text">Aucun équipement récent</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Techniciens Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="card-title-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                </span>
                                Techniciens
                            </h3>
                        </div>
                        <div class="summary-card">
                            <div class="summary-value">{{ $totalTechniciens }}</div>
                            <p class="summary-label">Techniciens disponibles</p>
                            <a href="{{ route('techniciens.index') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Gérer les techniciens
                            </a>
                        </div>
                    </div>
                    
                    <!-- Affectations Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <span class="card-title-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                Affectations
                            </h3>
                        </div>
                        <div class="summary-card">
                            <div class="summary-value">{{ $totalAffectations }}</div>
                            <p class="summary-label">Affectations ce mois</p>
                            <a href="{{ route('affectations.index') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Voir les affectations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>