<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Vendedor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Testing\Fakes\Fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orcamento>
 */
class OrcamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loc = 'pt_BR';

        return [
            'data' => fake($loc)->date(),
            'hora' => fake($loc)->date('H:i:s'),
            'descricao' => sprintf('Texto orcamento: %s', fake($loc)->text()),
            'valor' => fake($loc)->randomFloat(2, 100, 10000)
        ];
    }
}
