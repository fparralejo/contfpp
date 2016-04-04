<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model {

    protected $table = 'productos';

    protected $primaryKey = "IdProducto";

    public $timestamps = false;
        
}
