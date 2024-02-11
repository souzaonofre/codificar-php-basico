<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Orcamento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ClienteService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Collection;

class OrcamentoService
{

    public function listarOrcamentos(Request $request, int $perPage = 5): array
    {
        $vendedor = $request->user()?->vendedor;

        $builder = Orcamento::query()
            ->where('id_vendedor', $vendedor?->id);

        $buscar = $request->string('buscar_descr');
        if (Str::length($buscar) >= 3) {
            $builder->where('descricao', 'LIKE', "%{$buscar}%");
        }

        $cliente = $request->integer('cliente');
        if ($cliente > 0) {
            $builder->where('id_cliente', $cliente);
        }

        $data_inicio = Date::createFromFormat('d/m/Y', $request->string('data_inicio', ''));
        $data_fim = Date::createFromFormat('d/m/Y', $request->string('data_fim', ''));

        if ($data_inicio && $data_fim) {
            $builder->whereDate('data', '>=', $data_inicio)
                ->whereDate('data', '<=', $data_fim);
        }

        if ($data_inicio && !$data_fim) {
            $builder->whereDate('data', '>=', $data_inicio);
        }

        if (!$data_inicio && $data_fim) {
            $builder->whereDate('data', '<=', $data_fim);
        }

        $builder->orderBy('data', 'DESC');

        $cols = ['id', 'id_cliente', 'data', 'hora', 'descricao', 'valor'];

        /**
         * @var Paginator
         */
        $paginate = $builder->paginate($perPage, $cols);

        $orcamentos = array_map(function ($oct) {
            $arrOct = $oct->toArray();
            $arrOct['nome_cliente'] = $oct->cliente->nome;
            return $arrOct;
        }, $paginate->items());

        $paginateData = $paginate->toArray();

        $clienteIds = $paginate->pluck('id_cliente')->toArray();

        $viewData = [
            'data' => $orcamentos,
            'links' => $paginateData['links'],
            'from' => $paginateData['from'],
            'to' => $paginateData['to'],
            'per_page' => $paginateData['per_page'],
            'total' => $paginateData['total'],
            'cliente_select_options' => (new ClienteService())->makeSelectOptionsData($clienteIds)
        ];

        return $viewData;
    }
}
