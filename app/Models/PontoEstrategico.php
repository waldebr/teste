<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabela: ponto_estrategico
 */
class PontoEstrategico extends Model
{
    protected $table = 'ponto_estrategico';

    protected $primaryKey = 'cod_ponto';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'cod_ponto',
        'cod_regiao',
        'descricao',
    ];

    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'cod_regiao', 'cod_regiao');
    }
}
