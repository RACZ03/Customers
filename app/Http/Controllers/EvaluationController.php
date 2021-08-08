<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Customer;
use App\Models\Indicator;
use Illuminate\Http\Response;
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

    // Evaluation page
    public function create( Request $request ) {

        // Get all candidates
        $candidates = Customer::where('status', '=', 1)->get();
        $indicators = Indicator::where('status', '=', 1)->get();
        return view('pages.newEvaluation', compact('candidates', 'indicators'));
    }
}
