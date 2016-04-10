<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PresupuestoDetalle extends Model {

    protected $table = 'presupuestosdetalle';

    protected $primaryKey = "IdPresupDetalle";

    public $timestamps = false;
        
}
