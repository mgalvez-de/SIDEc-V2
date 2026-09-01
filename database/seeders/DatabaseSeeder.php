<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $user = User::factory()->create([
            'name' => 'Analista',
            'email' => 'analist@a',
            'password'=> ('12345'),
        ]);
        $user->assignRole('Analist');

         $user = User::factory()->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@s',
            'password'=> ('12345'),
        ]);
        $user->assignRole('Supervisor');

        $user = User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@m',
            'password'=> ('12345'),
        ]);
        $user->assignRole('Manager');

        $user = User::factory()->create([
            'name' => 'Area Manager',
            'email' => 'areamanager@a',
            'password'=> ('12345'),
        ]);
        $user->assignRole('Area Manager');

    }
}
