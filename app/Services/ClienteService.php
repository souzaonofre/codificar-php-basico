<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    public function makeSelectOptionsData(?array $ids = null, array $cols = ['id', 'nome']): array
    {
        if (!is_array($ids) || \count($ids) === 0) {
            return Cliente::all($cols)->toArray();
        }

        return Cliente::query()
            ->whereIn('id', $ids)
            ->get($cols)
            ->toArray();
    }
}
