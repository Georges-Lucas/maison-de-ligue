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
        Schema::create('collaborateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom'); 
            $table->string('email')->unique();
            $table->string('password');
            $table->date('date_naissance')->nullable();
            $table->string('telephone')->nullable();
            $table->string('photo')->nullable(); // URL or path to the photo
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('rôle');
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('collaborateurs');
    }
};
