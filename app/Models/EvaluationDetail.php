<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Indicator;

class EvaluationDetail extends Model
{
    use HasFactory;    
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'idEvaluation',
        'idIndicator'
    ];

    // Relacion de muchos a uno
    public function evaluation() {
        return $this->belongsTo('App\Models\Evaluation', 'id');
    }    
    
    public function indicator() {
        return $this->belongsTo('App\Models\Indicator', 'id');
    }

    // Calculate score
    public function scopeCalculateScore($query, $arrayIndicators) {
        $count = 0;
        foreach ($arrayIndicators as $id) {
            // check if the indicator exists
            $indicatorFound = Indicator::where("id","=", $id)->first();
            if( $indicatorFound != null ) {
                $count += $indicatorFound['score'];
            }
        }

        return $count;
    }

    // Save detail
    public function scopeSaveDetail($query, $arrayIndicators, $idE) {
        try {
            foreach ($arrayIndicators as $id) {
                // Create Object
                $newDetail = new EvaluationDetail();
                $newDetail->idEvaluation = $idE;
                $newDetail->idIndicator = $id;
                $newDetail->save();
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
