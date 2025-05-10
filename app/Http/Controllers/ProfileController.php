<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mettre à jour les informations de l'utilisateur
        $request->user()->fill($request->validated());

        // Si l'email a été modifié, on remet la vérification à null
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Sauvegarder les modifications
        $request->user()->save();

        // Rediriger en fonction du rôle
        if ($request->user()->role == 'admin_general') {
            return Redirect::route('admin.dashboard')->with('status', 'profile-updated');
        } elseif ($request->user()->role == 'technicien') {
            return Redirect::route('technicien.dashboard')->with('status', 'profile-updated');
        }

        // Par défaut, rediriger vers la page d'accueil ou une autre route
        return Redirect::route('home')->with('status', 'profile-updated');
    }

    /** 
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Se déconnecter et supprimer le compte
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
