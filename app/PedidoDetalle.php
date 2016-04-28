<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model {

    protected $table = 'pedidostosdetalle';

    protected $primaryKey = "IdPedidoDetalle";

    public $timestamps = false;
        
}
