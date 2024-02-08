<?php

use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::query()->create([
        'name' => 'Vendedor1 User Test',
        'email' => 'user@teste.com',
        'password' => Hash::make('teste1234'),
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10)
    ]);
});

test('criar e verificar dados vendedor', function () {
    $user = $this->user;

    $alias = Str::wordwrap($user->name, 1);
    $telefone = fake()->unique()->phoneNumber();

    $vendedor = Vendedor::query()->create([
        'id_user' => $user?->id,
        'alias' => $alias,
        'telefone' => $telefone
    ]);

    expect($vendedor)->toBeInstanceOf(Vendedor::class);

    expect($vendedor->id_user)->toEqual($user?->id);

    expect($vendedor->user)->toBeInstanceOf(User::class);

    expect($vendedor->nome)->toEqual($user?->name);

    expect($vendedor->email)->toEqual($user?->email);

    expect($vendedor->alias)->toEqual($alias);

    expect($vendedor->telefone)->toEqual($telefone);
});
