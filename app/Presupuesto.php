<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model {

    protected $table = 'presupuestos';

    protected $primaryKey = "IdPresupuesto";

    public $timestamps = false;
        
}
