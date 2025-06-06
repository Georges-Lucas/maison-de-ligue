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
        Schema::create('Admin', function (Blueprint $table) {
            $table->id_admin();
            $table->string('nom_admin');
            $table->string('prenom_admin'); 
            $table->string('email');
            $table->string('telephone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
