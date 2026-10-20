<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabela: vendedor
 */
class Vendedor extends Model
{
    protected $table = 'vendedor';

    protected $primaryKey = 'cod_vendedor';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'cod_vendedor',
        'cod_regiao',
        'nome',
    ];

    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'cod_regiao', 'cod_regiao');
    }

    public function veiculos()
    {
        return $this->belongsToMany(
            Veiculo::class,
            'vendedor_veiculo',
            'cod_vendedor',
            'cod_veiculo'
        )->withPivot('data');
    }

    public function notasFiscais()
    {
        return $this->hasMany(NotaFiscal::class, 'cod_vendedor', 'cod_vendedor');
    }

    public function usuarios()
    {
        return $this->hasMany(User::class, 'cod_vendedor', 'cod_vendedor');
    }
}
