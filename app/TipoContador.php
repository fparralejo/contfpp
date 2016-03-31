<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoContador extends Model {

    protected $table = 'tipo_contador';

    protected $primaryKey = "idContador";

    public $timestamps = false;
        
}
