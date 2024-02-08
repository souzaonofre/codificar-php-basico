<?php

use App\Models\Cliente;

beforeEach(function () {
    $this->clienteData = [
        'nome' => 'Cliente1 Test',
        'email' => 'client1@teste.com',
        'telefone' => fake()->unique()->phoneNumber()
    ];
    $this->cliente = Cliente::query()->create($this->clienteData);
});

test('criar e verificar dados de "Cliente"', function () {

    expect($this->cliente)->toBeInstanceOf(Cliente::class);

    expect($this->cliente->nome)->toBeString();
    expect($this->cliente->nome)->toEqual($this->clienteData['nome']);

    expect($this->cliente->email)->toBeString();
    expect($this->cliente->email)->toEqual($this->clienteData['email']);

    expect($this->cliente->telefone)->toBeString();
    expect($this->cliente->telefone)->toEqual($this->clienteData['telefone']);
});
