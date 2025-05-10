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
        Schema::create('members', function (Blueprint $table) {
            $table->id(); // ID de membre auto-incrémenté
            $table->string('nom'); // Nom du membre
            $table->string('prenom'); // Prénom du membre
            $table->string('matricule')->unique(); // Matricule unique pour chaque membre
            $table->string('centre'); // Le centre auquel appartient le membre
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
