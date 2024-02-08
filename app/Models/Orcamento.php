<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orcamento extends Model
{
    use HasFactory;

    protected $table = 'orcamentos';

    /**
     * The attributes to mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_cliente',
        'id_vendedor',
        'data',
        'hora',
        'valor'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'date:Y-m-d',
        'hora' => 'datetime:H-i-s',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_vendedor');
    }

    public function getNomeClienteAttribute(): ?String
    {
        return $this->cliente?->nome;
    }

    public function getNomeVendedorAttribute(): ?String
    {
        return $this->vendedor?->nome;
    }
}
