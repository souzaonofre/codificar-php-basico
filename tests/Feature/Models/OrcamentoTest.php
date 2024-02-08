<?php

use App\Models\Orcamento;

test('criar e verificar dados de "Orçamento"', function () {
    $instance = new Orcamento();

    expect($instance)->toBeInstanceOf(Orcamento::class);
});
