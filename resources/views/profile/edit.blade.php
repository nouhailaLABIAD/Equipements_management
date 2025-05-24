<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information -->
            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    
                    
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    
                    
                    @include('profile.partials.update-password-form')
                </div>
            </div>
             <!-- Delete Account -->
            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styles pour les inputs - Couleur focus changée */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="current_password"] {
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
            margin-bottom: 1rem;
            color: #374151;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        /* Remplacement du bleu par une couleur neutre */
        input:focus {
            outline: none;
            border-color: #9CA3AF; /* Gris neutre */
            box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.2); /* Ombre grise */
        }

        /* Styles pour les boutons - Couleur changée */
        button[type="submit"] {
            background-color: #7A1C3F; /* Bordeaux */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button[type="submit"]:hover {
            background-color: #5E152F; /* Bordeaux plus foncé */
        }

        /* Style pour header fixe */
        header.fixed {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
        }
        
        /* Compensation pour le header fixe */
        @media (min-width: 640px) {
            div.pt-24 {
                padding-top: 6rem;
            }
        }
    </style>
</x-app-layout>