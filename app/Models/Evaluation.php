<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'idUser',
        'startDate',
        'endDate',
        'score',
        'bond'
    ];

    // Relacion de muchos a uno
    public function customer() {
        return $this->belongsTo('App\Models\Customer', 'id');
    }

}
