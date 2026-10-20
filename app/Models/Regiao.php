<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabela: regiao
 */
class Regiao extends Model
{
    protected $table = 'regiao';

    protected $primaryKey = 'cod_regiao';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'cod_regiao',
        'cep',
        'nome',
    ];

    public function vendedores()
    {
        return $this->hasMany(Vendedor::class, 'cod_regiao', 'cod_regiao');
    }

    public function pontosEstrategicos()
    {
        return $this->hasMany(PontoEstrategico::class, 'cod_regiao', 'cod_regiao');
    }
}
