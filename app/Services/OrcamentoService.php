<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Orcamento;
use Illuminate\Http\Request;

class OrcamentoService
{

    public function listarOrcamentos(Request $request): array
    {
        $vendedor = $request->user()?->vendedor;

        $list = Orcamento::query()
            ->where('id_vendedor', $vendedor?->id)
            ->get(['id', 'data', 'hora', 'descricao', 'valor'])
            ->toArray();

        return $list;
    }
}
