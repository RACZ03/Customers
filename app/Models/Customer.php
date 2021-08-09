<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'firstName',
        'secondName',
        'surname',
        'secondSurname',
        'dni',
        'phoneNumber',
        'status'
    ];

    // Search method
    public function scopeSearch($query, $text){
        return $query->where('firstName', 'LIKE', '%'.$text.'%')
                     ->orWhere('secondName', 'LIKE', '%'.$text.'%')
                     ->orWhere('surname', 'LIKE', '%'.$text.'%')
                     ->orWhere('secondSurname', 'LIKE', '%'.$text.'%')
                     ->orWhere('dni', 'LIKE', '%'.$text.'%')
                     ->orWhere('phoneNumber', 'LIKE', '%'.$text.'%');
    }

    // Relacion de uno a muchos
    public function evaluation() {
        return $this->hasMany('App\Models\Evaluation');
    }
}
