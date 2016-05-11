<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model {

    protected $table = 'facturasdetalle';

    protected $primaryKey = "IdFacturaDetalle";

    public $timestamps = false;
        
}
