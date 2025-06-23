<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CollaborateursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('collaborateurs')->insert([
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'email' => 'jean.dupont@example.com',
                'password' => bcrypt('password'),
                'date_naissance' => '1990-01-01',
                'telephone' => '0600000000',
                'photo' => null,
                'adresse' => '1 rue de Paris',
                'ville' => 'Paris',
                'rôle' => 'Employé',
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
            'nom' => 'Martin',
            'prenom' => 'Sophie',
            'email' => 'sophie.martin@example.com',
            'password' => bcrypt('secret'),
            'date_naissance' => '1985-05-15',
            'telephone' => '0612345678',
            'photo' => null,
            'adresse' => '2 avenue de Lyon',
            'ville' => 'Lyon',
            'rôle' => 'Manager',
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
                'nom' => 'Lefevre',
                'prenom' => 'Paul',
                'email' => 'paul.lefevre@example.com',
                'password' => bcrypt('azerty'),
                'date_naissance' => '1988-03-22',
                'telephone' => '0622334455',
                'photo' => null,
                'adresse' => '3 rue Victor Hugo',
                'ville' => 'Marseille',
                'rôle' => 'Développeur',
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Dubois',
                'prenom' => 'Claire',
                'email' => 'claire.dubois@example.com',
                'password' => bcrypt('motdepasse'),
                'date_naissance' => '1992-07-10',
                'telephone' => '0677889900',
                'photo' => null,
                'adresse' => '5 avenue des Fleurs',
                'ville' => 'Nice',
                'rôle' => 'Designer',
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Petit',
                'prenom' => 'Lucas',
                'email' => 'lucas.petit@example.com',
                'password' => bcrypt('lucas123'),
                'date_naissance' => '1995-11-30',
                'telephone' => '0655443322',
                'photo' => null,
                'adresse' => '10 chemin du Lac',
                'ville' => 'Bordeaux',
                'rôle' => 'Chef de projet',
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Moreau',
                'prenom' => 'Julie',
                'email' => 'julie.moreau@example.com',
                'password' => bcrypt('juliepass'),
                'date_naissance' => '1983-09-18',
                'telephone' => '0611223344',
                'photo' => null,
                'adresse' => '8 impasse des Lilas',
                'ville' => 'Toulouse',
                'rôle' => 'RH',
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Girard',
                'prenom' => 'Antoine',
                'email' => 'antoine.girard@example.com',
                'password' => bcrypt('antoinepass'),
                'date_naissance' => '1978-12-05',
                'telephone' => '0633445566',
                'photo' => null,
                'adresse' => '12 boulevard Saint-Michel',
                'ville' => 'Lille',
                'rôle' => 'Comptable',
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
