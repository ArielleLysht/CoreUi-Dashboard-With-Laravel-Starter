<?php

namespace Database\Seeders;
use App\Models\Compte;
use App\Models\Salary;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Struct;
use App\Models\Schema;
use App\Models\Type;



// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        Compte::insert([
            'firstname' => 'Lion',
            'lastname' => 'Sylvie',
            'matricule' => '12345678',
            'email' => 'lion0@gmail.com',
            'filiere' => 'ICT4D',
            'phone' => '695230508',
            // 'password' => bcrypt('password'),
            // 'role_id' => '1',
            // 'structure_id'=> '1',

        ]);

        Struct::insert([
            'code' => 'A22',
            'name' => 'Departement Informatique',
        ]);

        Role::insert([
            'name' => 'CD',
            'structure_id' => '1',
        ]);

        Role::insert([
            'name' => 'Secretaire du CD',
            'structure_id' => '1',
        ]);


        Salary::insert([
            'nom' => 'Atangana',
            'prenom' => 'Jean',
            'email' => 'service0@gmail.com',
            'phone' => '692832774',
            'role_id' => '1',
        ]);

        Salary::insert([
            'nom' => 'Meungue',
            'prenom' => 'Irène',
            'email' => 'user0@gmail.com',
            'phone' => '694019357',
            'role_id' => '2',
        ]);

        Admin::insert([
            'nom' => 'Biombo',
            'prenom' => 'Arielle',
            'email' => 'admin0@gmail.com',
            'phone' => '694019357',
        ]);

        Type::insert([
            'nom'=> 'Demande de diplome',
            'pieces'=>'Relevé de note, CNI',
        ]);

        Schema::insert([
            'type_id'=>'1',
            'role_id'=>'1',
            'Ordre'=>'1',
        ]);

        Schema::insert([
            'type_id'=>'1',
            'role_id'=>'2',
            'Ordre'=>'2',
        ]);

        Schema::insert([
            'type_id'=>'1',
            'role_id'=>'1',
            'Ordre'=>'3',
        ]);

        Type::insert([
            'nom'=> 'Demande attestation de réussite',
            'pieces'=>'Relevé de note, justificatif de paiement',
        ]);

        Schema::insert([
            'type_id'=>'2',
            'role_id'=>'2',
            'Ordre'=>'1',
        ]);

        Schema::insert([
            'type_id'=>'2',
            'role_id'=>'1',
            'Ordre'=>'2',
        ]);


    }
}
