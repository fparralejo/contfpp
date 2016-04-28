<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model {

    protected $table = 'pedidos';

    protected $primaryKey = "IdPedido";

    public $timestamps = false;
        
}
