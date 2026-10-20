<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabela: produtos
 */
class Produto extends Model
{
    protected $table = 'produtos';

    protected $primaryKey = 'cod_produto';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'cod_produto',
        'descricao',
        'estoque',
        'status_ativo',
    ];

    protected $casts = [
        'status_ativo' => 'boolean',
    ];

    public function itensNota()
    {
        return $this->hasMany(ItemNota::class, 'cod_produto', 'cod_produto');
    }
}
