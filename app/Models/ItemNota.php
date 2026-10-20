<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabela: item_nota
 *
 * ATENCAO: a chave primaria real e COMPOSTA (num_nota + cod_produto).
 * O Eloquent nao suporta chave composta nativamente, por isso usamos
 * num_nota como chave "principal" para leitura. Para inserts/updates
 * confiaveis, prefira o Query Builder (DB::table('item_nota')).
 */
class ItemNota extends Model
{
    protected $table = 'item_nota';

    protected $primaryKey = 'num_nota';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'num_nota',
        'cod_produto',
        'preco_unitario',
        'quantidade',
    ];

    protected $casts = [
        'preco_unitario' => 'decimal:2',
    ];

    public function notaFiscal()
    {
        return $this->belongsTo(NotaFiscal::class, 'num_nota', 'num_nota');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'cod_produto', 'cod_produto');
    }
}
