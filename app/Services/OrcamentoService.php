<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Orcamento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class OrcamentoService
{

    public function listarOrcamentos(Request $request, int $perPage = 10): array
    {
        $vendedor = $request->user()?->vendedor;

        $builder = Orcamento::query()
            ->where('id_vendedor', $vendedor?->id);

        $buscar = $request->string('buscar');
        if (Str::length($buscar) >= 3) {
            $builder->where('descricao', 'LIKE', "%{$buscar}%");
        }

        $cliente = $request->integer('cliente');
        if ($cliente > 0) {
            $builder->where('cliente', $cliente);
        }

        $data = $request->string('data');
        if (Str::length($data) >= 8) {
            $builder->whereDate('data', Date::createFromFormat('d/m/Y', $data)->format('Y-m-D'));
        }

        $builder->orderBy('data', 'DESC');

        $cols = ['id', 'id_cliente', 'data', 'hora', 'descricao', 'valor'];

        $list = $builder->paginate($perPage, $cols)
            ->items();

        $list = array_map(function ($oct) {
            $arrOct = $oct->toArray();
            $arrOct['nome_cliente'] = $oct->cliente->nome;
            return $arrOct;
        }, $list);

        return $list;
    }
}
