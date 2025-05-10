<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12">  <!-- Changé de py-12 à pt-24 pb-12 -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information -->
            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">  <!-- Changé de p-4 à p-6 -->
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Profile Information') }}</h3>
                    <p class="text-sm text-gray-600 mb-6">{{ __('Update your account\'s profile information and email address.') }}</p>
                    
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">  <!-- Changé de p-4 à p-6 -->
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Update Password') }}</h3>
                    <p class="text-sm text-gray-600 mb-6">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                    
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styles pour les inputs */
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
        }

        input:focus {
            outline: none;
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.3);
        }

        /* Styles pour les boutons */
        button[type="submit"] {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #2563eb;
        }
         /* Ajoutez ce style si votre header est fixe */
         header.fixed {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
        }
        
        /* Compensation pour le header fixe */
        @media (min-width: 640px) {
            div.pt-24 {
                padding-top: 6rem; /* Ajustez selon la hauteur de votre header */
            }
        }
    </style>
</x-app-layout>