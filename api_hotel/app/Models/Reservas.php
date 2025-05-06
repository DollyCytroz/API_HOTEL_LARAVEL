<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    protected $fillable = [
        'nome_hospede',
        'data_checkin',
        'data_checkout',
    ];
}
