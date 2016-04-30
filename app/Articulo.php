<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model {

    protected $table = 'articulos';

    protected $primaryKey = "IdArticulo";

    public $timestamps = false;
        
}
