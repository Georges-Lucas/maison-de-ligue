<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        $this->call(CollaborateursTableSeeder::class);
    
        $adminId = DB::table('collaborateurs')->insertGetId([
            'nom' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'date_naissance' => '1980-01-01',
            'telephone' => '0601010101',
            'photo' => null,
            'adresse' => '99 avenue de l’Administration',
            'ville' => 'Paris',
            'rôle' => 'Administrateur',
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
