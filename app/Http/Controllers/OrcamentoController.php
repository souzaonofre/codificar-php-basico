<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Orcamento;
use Illuminate\Http\Request;
use App\Services\OrcamentoService;
use App\Http\Requests\StoreOrcamentoRequest;
use App\Http\Requests\UpdateOrcamentoRequest;

class OrcamentoController extends Controller
{
    protected OrcamentoService $serviceData;

    public function __construct()
    {
        $this->serviceData = new OrcamentoService();
    }

    /**
     * Listar Orçamentos
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function listar(Request $request): \Inertia\Response
    {
        $viewData = $this->serviceData->listarOrcamentos($request);
        $result = $request->get('result');
        return Inertia::render('Orcamento/Listar', ['view_data' => $viewData, 'result' => $result]);
    }

    /**
     * Salvar dados de Orçamento
     *
     * @param StoreOrcamentoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(StoreOrcamentoRequest $request): \Illuminate\Http\RedirectResponse
    {
        $status = $this->serviceData->salvarOrcamento($request);
        return to_route('orcamento.listar', ['result' => ['action' => 'save', 'status' => $status]]);
    }


    /**
     * Atualizar dados de Orçamento
     *
     * @param UpdateOrcamentoRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function atualizar(UpdateOrcamentoRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $status = $this->serviceData->atualizarOrcamento($request, $id);
        return to_route('orcamento.listar', ['result' => ['action' => 'update', 'status' => $status]]);
    }

    /**
     * Remover dados de Orçamento
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remover(int $id): \Illuminate\Http\RedirectResponse
    {
        $status = $this->serviceData->removerOrcamento($id);
        return to_route('orcamento.listar', ['result' => ['action' => 'delete', 'status' => $status]]);
    }
}
