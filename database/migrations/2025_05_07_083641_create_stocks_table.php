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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('type_equipement'); // ex: PC, Imprimante
            $table->string('reference'); // ex: un code 
            $table->string('configuration'); // ex: HP, Intel i5, 8Go RAM
            $table->integer('quantite');
            $table->date('date_arrivee');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
