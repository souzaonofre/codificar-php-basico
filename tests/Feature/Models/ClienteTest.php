<?php

use App\Models\Cliente;

test('criar e verificar dados vendedor', function () {
    $cliente = Cliente::query()->create([
        'nome' => fake()->name(),
        'telefone' => fake()->unique()->phoneNumber(),
        'email' => fake()->unique()->safeEmail(),
    ]);

    expect($cliente)->toBeInstanceOf(Cliente::class);

    expect($cliente->id)->toBeInt();
});
