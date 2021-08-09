<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Customer;
use App\Models\Indicator;
use App\Models\EvaluationDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    // Get view
    public function index( Request $request ) {
        // Consultation staff evaluation
        $evaluations = Evaluation::where('status', '=', 1)
                                 ->orderBy('id', 'DESC')
                                 ->paginate(6);
        // var_dump($evaluations);die();
        return view('index', compact('evaluations'));
    }

    // Show evaluation page
    public function create( Request $request ) {

        // Get all candidates
        $candidates = Customer::where('status', '=', 1)->get();
        // Ge all indicators
        $indicators = Indicator::where('status', '=', 1)->get();
        return view('pages.newEvaluation', compact('candidates', 'indicators'));
    }

    // Save new evaluation
    public function store( Request $request) {
        //Recoger los datos por POST
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        $validate = Validator::make($params_array, [
            'idUser' => 'required',
            'startDate' => 'required|date|date_format:Y-m-d|before:endDate',
            'endDate' => 'required|date|date_format:Y-m-d|after:startDate',
        ]);

        if ( $validate->fails() ) {
            $data = array(
                'status' =>  'error',
                'code' => 404,
                'message' => 'Datos incorrectos'
            );
        } else {

            // Method to obtain the score
            $totalScore = EvaluationDetail::CalculateScore($params_array['arrayId']);
            

            // Create object
            $newEvaluation = new Evaluation();
            $newEvaluation->idUser = $params_array['idUser'];
            $newEvaluation->startDate = $params_array['startDate'];
            $newEvaluation->endDate = $params_array['endDate'];
            $newEvaluation->score = $totalScore;
            $newEvaluation->status = 1;

            // Calculate bonus based on score
            //     Maximum score 25 == $ 10
            //     If it is less than 20 pts = 0;
            if ( $totalScore < 25 && $totalScore >= 20 ) {
                $query = Indicator::sum('score');
                $newEvaluation->bond = ( ( 10 * $totalScore ) / $query );
            } else {
                $newEvaluation->bond = 0;
            }

            $newEvaluation->save();
            // Save evaluation details
            $saveDetail = EvaluationDetail::SaveDetail($params_array['arrayId'], $newEvaluation->id);

            //Check if the storage was correct
            if ( $saveDetail )  {
                $data = array(
                    'status' =>  'success',
                    'code' => 201,
                    'message' => 'Registro exitoso'
                );
            } else {
                // If an error occurred delete the evaluation and its detail
                $newEvaluation->detail->delete();
                $newEvaluation->delete();

                $data = array(
                    'status' =>  'error',
                    'code' => 400,
                    'message' => 'Error al guardar'
                );
            }
        }
        return response()->json($data, $data['code']);
    }

    public function edit($id) {
        // Search Evaluation Record
        $evaluation = Evaluation::where('id', '=' , $id)
                                ->where('status', '=', 1)
                                ->first();

        // Get all evaluation detail
        $details = EvaluationDetail::where('idEvaluation', '=' , $id)->get();

        // Get all candidates
        $candidates = Customer::where('status', '=', 1)->get();
        // Ge all indicators
        $indicators = Indicator::where('status', '=', 1)->get();

        return view('pages.newEvaluation', compact('evaluation', 'details', 'candidates', 'indicators'));
    }
}
