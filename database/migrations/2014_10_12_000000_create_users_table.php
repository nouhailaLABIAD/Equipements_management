<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    { 
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id auto-incrémentée (clé primaire)
            $table->string('name'); // le nom de l'utilisateur
            $table->string('email')->unique(); // l'email, unique
            $table->timestamp('email_verified_at')->nullable(); // utilisé si tu veux la vérification d’email
            $table->string('password'); // le mot de passe hashé
            $table->enum('role', ['admin_general', 'technicien']); // le rôle (ajouté par toi)
            $table->rememberToken(); // utilisé pour "remember me" (connexion persistante)
            $table->timestamps(); // champs created_at et updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
