<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model {

    protected $connection = 'contfpp';
    
    protected $table = 'empresas';

    protected $primaryKey = "IdEmpresa";

    public $timestamps = false;
        
}
