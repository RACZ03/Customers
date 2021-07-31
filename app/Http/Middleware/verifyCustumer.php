<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Customer;
use Hamcrest\Type\IsObject;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use function Ramsey\Uuid\v1;

class verifyCustumer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //Recoger los datos por POST
        $json = $request->input('json', null);

        if ( $json == null ) return $next($request);

        $params_array = json_decode($json, true);

        if( !array_key_exists('dni', $params_array) ) return $next($request);

        // check if there is a user with the same ID
        $customer = Customer::where("dni","=",$params_array['dni'])->first();
        if ( $customer == null ) {
            // check if there is a user with the same phoneNumber
            if ( $params_array['phoneNumber'] ) {
                $found = Customer::where("phoneNumber","=",$params_array['phoneNumber'])->first();

                if ( $found == null ) return $next($request);

                // If the number is the same but the params has an id, it is an update
                if( $params_array['id'] > 0 ) return $next($request);

                return response()->json(['message' => 'Ya existe un cliente con ese número de teléfono', "code" => 400], 200);
            }
            return $next($request);
        }
        // If the ID is the same but the params has an id, it is an update
        if( $params_array['id'] > 0 ) return $next($request);

        return response()->json(['message' => 'Ya existe un cliente con ese número de cédula', "code" => 400], 200);
    }
}
