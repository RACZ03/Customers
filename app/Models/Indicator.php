<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;    
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'description',
        'score',
        'status'
    ];

    // Relacion de uno a muchos
    public function detail() {
        return $this->hasMany('App\Models\EvaluationDetail');
    }
}
