<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quartos extends Model
{
    protected $fillable = [
        'numero',
        'tipo',
        'preco_diaria',
    ];
}
