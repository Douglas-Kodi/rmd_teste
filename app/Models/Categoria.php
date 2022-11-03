<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = [
        'nome', 
        'imagem', 
        'deleted_at'
    ];

    public function produtos() {
        return $this->hasMany('App\Models\Produto', 'idcateg');
    }
}
