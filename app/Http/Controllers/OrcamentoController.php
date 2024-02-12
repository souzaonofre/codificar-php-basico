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
        return Inertia::render('Orcamentos', ['view_data' => $viewData]);
    }

    /**
     * Salvar dados de Orçamento
     *
     * @param StoreOrcamentoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(StoreOrcamentoRequest $request): \Illuminate\Http\RedirectResponse
    {
        //

        return to_route('orcamento.listar');
    }


    /**
     * Atualizar dados de Orçamento
     *
     * @param UpdateOrcamentoRequest $request
     * @param Orcamento $orcamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function atualizar(UpdateOrcamentoRequest $request, Orcamento $orcamento): \Illuminate\Http\RedirectResponse
    {
        //
        return to_route('orcamento.listar');
    }

    /**
     * Remover dados de Orçamento
     *
     * @param Orcamento $orcamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remover(Orcamento $orcamento): \Illuminate\Http\RedirectResponse
    {

        return to_route('orcamento.listar');
    }
}
