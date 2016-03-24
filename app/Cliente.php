<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected $table = 'clientes';

    protected $primaryKey = "idCliente";

    public $timestamps = false;
        
}
