<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Customer;
use App\Models\Indicator;
use App\Models\EvaluationDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDO;

class EvaluationController extends Controller
{
    // Get view
    public function index( Request $request ) {
        // Consultation staff evaluation
        $evaluations = Evaluation::where('status', '=', 1)
                                 ->orderBy('id', 'DESC')
                                 ->paginate(6);
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

            // Method to obtain the sum of the score
            $totalScore = EvaluationDetail::CalculateScore($params_array['arrayId']);
            
            // Create object
            $newEvaluation = new Evaluation();
            $newEvaluation->idUser = $params_array['idUser'];
            $newEvaluation->startDate = $params_array['startDate'];
            $newEvaluation->endDate = $params_array['endDate'];
            $newEvaluation->score = $totalScore;
            $newEvaluation->status = 1;

            // Calculate bonus based on score
            $newEvaluation->bond = EvaluationDetail::CalculateBond($totalScore);

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

    // Look at the edit evaluation view
    public function edit($id) {
        // Search Evaluation Record
        $evaluation = Evaluation::where('id', '=' , $id)
                                ->where('status', '=', 1)
                                ->first();
        // Get all evaluation detail
        $listDetails = EvaluationDetail::getDetailById($id);
        // Convert an array of object to a matrix to be able to be analyzed with the array_serach method and validate the marking of the checks
        $details = json_decode(json_encode($listDetails), true);
        // Get all candidates
        $candidates = Customer::where('status', '=', 1)->get();
        // Ge all indicators
        $indicators = Indicator::where('status', '=', 1)->get();

        return view('pages.newEvaluation', compact('evaluation', 'details', 'candidates', 'indicators'));
    }

    // Edit evaluation
    public function update($id, Request $request) {
        //Recoger los datos por POST
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        // Validate data
        $validate = Validator::make($params_array, [
            'idUser' => 'required',
            'startDate' => 'required|date|date_format:Y-m-d|before:endDate',
            'endDate' => 'required|date|date_format:Y-m-d|after:startDate',
        ]);
        // If there is an error exit
        if ( $validate->fails() ) {
            $data = array(
                'status' =>  'error',
                'code' => 404,
                'message' => 'Datos incorrectos'
            );
        } else {
            $arrayIds = $params_array['arrayId'];
            // Remove the id's from the array
            unset($params_array['arrayId']);

            // update evaluation details
            $updateDetail = EvaluationDetail::UpdateDetail($arrayIds, $id);

            // Method to obtain the score
            $totalScore = EvaluationDetail::CalculateScore($arrayIds);
            $params_array['score'] = $totalScore;
            
            // Calculate bonus based on score
            $params_array['bond'] = EvaluationDetail::CalculateBond($totalScore);

            // update evaluation
            $updateEvaluation = Evaluation::where('id',$id)->update($params_array);


            //Check if the storage was correct
            if ( $updateEvaluation && $updateDetail )  {
                $data = array(
                    'status' =>  'success',
                    'code' => 200,
                    'message' => 'Actualizacion exitosa'
                );
            } else {
                // If an error occurred delete the evaluation and its detail
                $updateEvaluation->detail->delete();
                $updateEvaluation->delete();

                $data = array(
                    'status' =>  'error',
                    'code' => 400,
                    'message' => 'Error al guardar'
                );
            }
        }
        return response()->json($data, $data['code']);
    }

    // Delete evaluation
    public function destroy($id)
    {
        $evaluationFound = Evaluation::where('id', '=', $id);

        if ( $evaluationFound == null ) {
            $data = array(
                'status' =>  'success',
                'code' => 403,
                'message' => 'No existe el usuario'
            );
        } else {
            // delete detail
            EvaluationDetail::where('idEvaluation', '=', $id)->delete();
            
            $evaluationFound->update(['status' => 0]);

            $data = array(
                'status' =>  'success',
                'code' => 200,
                'message' => 'Evaluacion eliminada'
            );
            
        }

        return response()->json($data, $data['code']);
    }
}
