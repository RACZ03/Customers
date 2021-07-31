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
        'name',
        'lastName',
        'dni',
        'phoneNumber',
        'status'
    ];

    public function scopeSearch($query, $text){
        return $query->where('name', 'LIKE', '%'.$text.'%')
                     ->orWhere('lastName', 'LIKE', '%'.$text.'%')
                     ->orWhere('dni', 'LIKE', '%'.$text.'%')
                     ->orWhere('phoneNumber', 'LIKE', '%'.$text.'%');
    }
}
