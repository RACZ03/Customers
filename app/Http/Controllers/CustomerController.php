<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchText = $request->get('searchText');
        if ( $searchText == null) $searchText = '';
        $customers = Customer::where('status', '=', 1)
                             ->search($searchText)
                             ->orderBy('id', 'DESC')
                             ->paginate(6);
        return view('pages.customer', compact('customers', 'searchText'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response)
    {
        //Recoger los datos por POST
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        $validate = Validator::make($params_array, [
            'firstName' => 'required|max:30',
            'secondName' => 'required|max:30',
            'surname' => 'required|max:30',
            'secondSurname' => 'required|max:30',
            'dni' => 'required|max:16'
        ]);
        if ( $validate->fails() ) {
            $data = array(
                'status' =>  'error',
                'code' => 404,
                'message' => 'Datos incorrectos'
            );
        } else {
            $customer = new Customer();
            $customer->firstName = $params_array['firstName'];
            $customer->secondName = $params_array['secondName'];
            $customer->surname = $params_array['surname'];
            $customer->secondSurname = $params_array['secondSurname'];
            $customer->dni = $params_array['dni'];
            if ( $params_array['phoneNumber']) $customer->phoneNumber = $params_array['phoneNumber'];
            
            $customer->status = 1;

            $customer->save();

            $data = array(
                'status' =>  'success',
                'code' => 201,
                'message' => 'Registro exitoso'
            );
        }
        return response()->json($data, $data['code']);
    }

    public function update($id, Request $request)
    {
        //Recoger los datos por POST
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        unset($params_array['id']);
        $validate = Validator::make($params_array, [
            'firstName' => 'required|max:30',
            'secondName' => 'required|max:30',
            'surname' => 'required|max:30',
            'secondSurname' => 'required|max:30',
            'dni' => 'required|max:16'
        ]);
        if ( $validate->fails() ) {
            $data = array(
                'status' =>  'error',
                'code' => 404,
                'message' => 'Datos incorrectos'
            );
        } else {
            $updateCustomers = Customer::where('id',$id)->update($params_array);

            $data = array(
                'status' =>  'success',
                'code' => 201,
                'message' => 'Actualizacion exitosa'
            );
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userFound = Customer::where('id', '=', $id);

        if ( $userFound == null ) {
            $data = array(
                'status' =>  'success',
                'code' => 403,
                'message' => 'No existe el usuario'
            );
        } else {

            $userFound->update(['status' => 0]);
            $data = array(
                'status' =>  'success',
                'code' => 200,
                'message' => 'Cliente eliminado'
            );
            
        }

        return response()->json($data, $data['code']);
    }
}
