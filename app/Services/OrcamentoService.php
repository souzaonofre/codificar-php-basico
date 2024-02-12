<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Orcamento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ClienteService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Date;
use App\Http\Resources\OrcamentoResource;

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

        $strObj = $request->string('data_inicio');
        $data_inicio = null;
        if ($strObj->isNotEmpty()) {
            $data_inicio = Date::createFromFormat('d/m/Y', $strObj->value);
        }

        $strObj = $request->string('data_fim');
        $data_fim = null;
        if ($strObj->isNotEmpty()) {
            $data_fim = Date::createFromFormat('d/m/Y', $strObj->value);
        }

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

        /**
         * @var Paginator
         */
        $paginate = $builder->paginate($perPage);


        $resourceData = OrcamentoResource::collection($paginate);

        $paginateData = $paginate->toArray();

        $clienteIds = Orcamento::all(['id_cliente'])->pluck('id_cliente')->toArray();
        $clienteSelectOpts = (new ClienteService())->makeSelectOptionsData($clienteIds);

        $viewData = [
            'data' => $resourceData->toArray($request),
            'links' => $paginateData['links'],
            'from' => $paginateData['from'],
            'to' => $paginateData['to'],
            'per_page' => $paginateData['per_page'],
            'total' => $paginateData['total'],
            'cliente_select_options' => $clienteSelectOpts
        ];

        return $viewData;
    }
}
