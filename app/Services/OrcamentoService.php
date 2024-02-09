<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Orcamento;
use Illuminate\Http\Request;

class OrcamentoService
{

    public function listarOrcamentos(Request $request, int $perPage = 10): array
    {
        $vendedor = $request->user()?->vendedor;

        //$page = $request->integer('page', 0);
        $cols = ['id', 'data', 'hora', 'descricao', 'valor'];

        $list = Orcamento::query()
            ->where('id_vendedor', $vendedor?->id)
            ->paginate($perPage, $cols)
            ->items();

        return $list;
    }
}
