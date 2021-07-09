<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'nascimento', 'sexo', 'cep', 'endereco', 'numero', 'complemento', 'bairro', 'uf', 'cidade'
    ];
}
