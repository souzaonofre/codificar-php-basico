<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
#use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            \App\Models\Vendedor::factory()->create([
                'id_user' => $user->id,
                'alias' => explode(' ', $user->name)[0],
            ]);
        }
    }
}
