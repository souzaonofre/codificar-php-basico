<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
#use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrcamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendedor = \App\Models\Vendedor::query()->first(['id']);
        $clientes = \App\Models\Cliente::all();

        foreach ($clientes as $cliente) {
            \App\Models\Orcamento::factory()->create([
                'id_cliente' => $cliente->id,
                'id_vendedor' => $vendedor->id,
            ]);
        }
    }
}
