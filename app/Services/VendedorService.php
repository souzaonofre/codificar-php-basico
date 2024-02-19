<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Vendedor;

class VendedorService
{
    public function makeSelectOptionsData(?array $ids = null, array $cols = ['id', 'nome']): array
    {
        if (!is_array($ids) || \count($ids) === 0) {
            return Vendedor::all($cols)->toArray();
        }

        return Vendedor::query()
            ->whereIn('id', $ids)
            ->get($cols)
            ->toArray();
    }
}
