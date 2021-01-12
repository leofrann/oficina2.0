<?php

namespace App;

use illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $table = 'orcamentos';
    public $timestamps = false;
    protected $fillable =
    [
        'id',
        'codigo',
        'cliente',
        'data',
        'hora',
        'vendedor',
        'valor',
        'descricao'
    ];

    protected $appends = ['data'];
    public function getData2Attribute()
    {
        return date('m-d-Y', strtotime($this->attributes['data']));
    }
}

