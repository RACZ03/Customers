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
        return $this->belongsTo('App\Models\Evaluation', 'idEvaluation');
    }    
    
    public function indicator() {
        return $this->belongsTo('App\Models\Indicator', 'idIndicator');
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

    // Calculate bond 
    public function scopeCalculateBond($query, $totalScore) {
        $bond = 0;
        // Calculate bonus based on score
        //     Maximum score 25 == $ 10
        //     If it is less than 20 pts = 0;
        if ( $totalScore <= 25 && $totalScore >= 20 ) {
            // The initial amount based on the maximum value (10) is defined and divided by the candida to be averaged
            $amount = 10 / 6; 
            // Obtain the multiplier value of the last digit of the summary score
            $x = substr($totalScore, 1) + 1;
            $bond = ( $amount * $x );
        } 
        return $bond;
    }

    // Get detail by id Evaluation
    public function scopeGetDetailById($query, $id) {
        return EvaluationDetail::select('idIndicator')
                                       ->where('idEvaluation', '=' , $id)
                                       ->get();
    }

    // Save detail
    public function scopeSaveDetail($query, $arrayIndicators, $idE) {
        try {
            foreach ($arrayIndicators as $id) {
                // Create new detail
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

    // Update detail
    public function scopeUpdateDetail ( $query, $arrayIndicators, $idE ) {

        try {
            //if it is edit consult the previous records
            $details = EvaluationDetail::GetDetailById($idE);
    
            // Loop through arrangement that comes from request
            foreach($arrayIndicators as $id) {
                // Check if a record exists
                $detailfound = EvaluationDetail::where('idEvaluation', '=', $idE)
                                               ->where('idIndicator', '=', $id)
                                               ->first();
                if ( !$detailfound ) { // If it does not exist
                    // Create new detail
                    $newDetail = new EvaluationDetail();
                    $newDetail->idEvaluation = $idE;
                    $newDetail->idIndicator = $id;
                    $newDetail->save();
                }
            }
    
            // Reverse check to remove the if a previous record does not belong to the new one
            foreach ( $details as $detail ) {
                if ( !in_array($detail->idIndicator, $arrayIndicators) ) {
                    $found = EvaluationDetail::where('idEvaluation', '=', $idE)
                                             ->where('idIndicator', '=', $detail->idIndicator)
                                             ->first();
                    if ( $found ) $found->delete();
                }
            }
            return true;
        } catch ( \Exception $e) {
            return true;
        }
        
    }

}
