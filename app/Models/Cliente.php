<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabela: cliente
 */
class Cliente extends Model
{
    protected $table = 'cliente';

    protected $primaryKey = 'cod_cliente';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'cod_cliente',
        'nome',
    ];

    public function notasFiscais()
    {
        return $this->hasMany(NotaFiscal::class, 'cod_cliente', 'cod_cliente');
    }
}
