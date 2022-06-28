<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrmCustomer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyApiController extends Controller
{
    public function Validar(Request $request){
       // $email = $request->email;
        $phone = $request->phone;
//        if (CrmCustomer::where('email', $email)->exists()){
//            return response()->json(['error' => 'Email already exists']);
//        }
        if (CrmCustomer::where('phone', $phone)->exists()){
            return response()->json(['error' => 'Phone already exists']);
        }
        return response()->json(['success' => 'success'], Response::HTTP_OK);
    }

}
