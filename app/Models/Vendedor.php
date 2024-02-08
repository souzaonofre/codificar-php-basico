<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendedor extends Model
{
    use HasFactory;

    protected $table = 'vendedores';

    /**
     * The attributes to mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'alias',
        'telefone',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getNomeAttribute(): ?String
    {
        return $this->user?->name;
    }

    public function getEmailAttribute(): ?String
    {
        return $this->user?->email;
    }
}
