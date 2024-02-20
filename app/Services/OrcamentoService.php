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
use Illuminate\Database\Eloquent\Builder;


class OrcamentoService
{

    /**
     * Serviço que seleciona, compõe, filtra, ordena e
     * executa paginação de dados para listagem de Orçamentos.
     *
     * @param Request $request "dados da requisição http"
     * @param integer $perPage "Qtd. items  por pagina (paginação de dados)"
     * @return array
     */
    public function listarOrcamentos(Request $request, int $perPage = 5): array
    {
        // $vendedor = $request->user()?->vendedor;

        // $builder = Orcamento::query()
            // ->where('id_vendedor', $vendedor?->id);

        $builder = Orcamento::query();

        $buscar = $request->string('buscar');
        if (Str::length($buscar) >= 3) {
            $builder->whereRelation('vendedor', 'nome', 'LIKE', "%{$buscar}%")
                ->orWhereRelation('cliente', 'nome', 'LIKE', "%{$buscar}%");
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

        $vendedorSelectOpts = (new VendedorService())->makeSelectOptionsData();

        $clienteIds = Orcamento::all(['id_cliente'])->pluck('id_cliente')->toArray();
        $clienteSelectOpts = (new ClienteService())->makeSelectOptionsData($clienteIds);

        $viewData = [
            'data' => $resourceData->toArray($request),
            'links' => $paginateData['links'],
            'from' => $paginateData['from'],
            'to' => $paginateData['to'],
            'per_page' => $paginateData['per_page'],
            'total' => $paginateData['total'],
            'modal_data' => [
                'vendedores' => $vendedorSelectOpts,
                'clientes' => $clienteSelectOpts
            ]
        ];

        return $viewData;
    }

    /**
     * Serviço para salvar os dados de um novo Orçamento.
     *
     * @param Request $request "dados da requisição http"
     * @return boolean
     */
    public function salvarOrcamento(Request $request) : bool {
        $createData = $request->all(['id_vendedor', 'id_cliente', 'descricao', 'valor']);
        return Orcamento::query()->create($createData)->exists();
    }

    /**
     * Serviço para atualizar os dados de um Orçamento registrado.
     *
     * @param Request $request "dados da requisição http"
     * @param integer $id "id do Orcamento"
     * @return boolean
     */
    public function atualizarOrcamento(Request $request, int $id) : bool {
        $orcamento = Orcamento::query()->findOrFail($id);
        $updateData = $request->all(['id_vendedor', 'id_cliente', 'descricao', 'valor']);
        return $orcamento->updateOrFail($updateData);
    }

    /**
     * Serviço para remover os dados de um Orçamento registrado.
     *
     * @param integer $id "id do Orcamento"
     * @return boolean
     */
    public function removerOrcamento(int $id) : bool {
        $orcamento = Orcamento::query()->findOrFail($id);
        return $orcamento->deleteOrFail();
    }

}
