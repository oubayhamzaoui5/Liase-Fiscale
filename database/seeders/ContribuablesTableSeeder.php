<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ContribuablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contribuables')->insert([
            [
                'matricule_fiscale' => '001 O H',
                'raison_sociale' => 'Entreprise Tunisie',
                'adresse' => '67 Zone Urbaine Nord',
                'password' => Hash::make('user'), // Make sure to hash passwords
                'role' => 'user', // Set role as user
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('contribuables')->insert([
            [
                'matricule_fiscale' => '1012654G A M',
                'raison_sociale' => 'KROMBERG & SCHUBERT TUNISIE',
                'adresse' => '000 ZONE RT TABARKABEJA-NORD',
                'password' => Hash::make('user'), // Make sure to hash passwords
                'role' => 'user', // Set role as user
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('contribuables')->insert([
            [
                'matricule_fiscale' => 'admin',
                'raison_sociale' => 'Admin Company',
                'adresse' => 'admin',
                'password' => Hash::make('admin'), // Make sure to hash passwords
                'role' => 'admin', // Set role as user
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
