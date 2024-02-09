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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $viewData = $this->serviceData->listarOrcamentos($request);
        return Inertia::render('Orcamentos', ['viewData' => $viewData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrcamentoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Orcamento $orcamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orcamento $orcamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrcamentoRequest $request, Orcamento $orcamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orcamento $orcamento)
    {
        //
    }
}
