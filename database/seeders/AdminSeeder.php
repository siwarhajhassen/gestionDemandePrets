<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'prenom' => 'Admin',
            'nom' => 'System',
            'email' => 'admin@bna.tn',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'num_tel' => '+216 00 000 000',
        ]);

        Admin::create([
            'user_id' => $user->id,
            'role' => 'super_admin',
        ]);

        $this->command->info('Administrateur créé avec succès!');
        $this->command->info('Email: admin@bna.tn');
        $this->command->info('Mot de passe: admin123');
    }
}