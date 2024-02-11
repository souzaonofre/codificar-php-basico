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

        $buscar = $request->string('buscar');
        if (Str::length($buscar) >= 3) {
            $builder->where('descricao', 'LIKE', "%{$buscar}%");
        }

        $cliente = $request->integer('cliente');
        if ($cliente > 0) {
            $builder->where('id_cliente', $cliente);
        }

        $data = $request->string('data');
        if (Str::length($data) >= 8) {
            $data =  Date::createFromFormat('d/m/Y', $data)->format('Y-m-d');
            $builder->where('data', $data);
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
