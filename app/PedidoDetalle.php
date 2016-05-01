<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model {

    protected $table = 'pedidosdetalle';

    protected $primaryKey = "IdPedidoDetalle";

    public $timestamps = false;
        
}
