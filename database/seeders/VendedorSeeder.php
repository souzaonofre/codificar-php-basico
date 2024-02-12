<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
#use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Vendedor::factory()
            ->count(5)
            ->sequence(
                fn (Sequence $seq) => ['nome' => sprintf('Vendedor %s', str_pad(strval($seq->index + 1), 3, '0', STR_PAD_LEFT))]
            )->create();
    }
}
