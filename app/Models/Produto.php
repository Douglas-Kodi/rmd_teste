<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $fillable = [
        'idcateg', 
        'nome', 
        'imagem', 
        'deleted_at'
    ];
    
    public function categoria() {
        return $this->hasOne('App\Models\Categoria', 'id', 'idcateg');
    }
}
