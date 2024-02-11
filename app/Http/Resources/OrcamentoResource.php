<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class OrcamentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $vendedorData = (new VendedorResource($this->vendedor))->toArray($request);
        $clienteData = (new ClienteResource($this->cliente))->toArray($request);

        return [
            'id' => $this->id,
            'data' => (new Carbon($this->data))->format('d/m/Y'),
            'hora' => (new Carbon($this->hora))->format('H:i'),
            'descricao' => $this->descricao,
            'valor' => $this->valor,
            'cliente' => $clienteData,
            'vendedor' => $vendedorData
        ];
    }
}
