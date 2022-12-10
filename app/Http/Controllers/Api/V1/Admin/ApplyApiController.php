<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAPICrmCustomerRequest;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Models\CrmCustomer;
use App\Models\CrmStatus;
use App\Models\RequiredDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ApplyApiController extends Controller
{
    public function Validar(Request $request)
    {
        // $email = $request->email;
        $phone = $request->phone;
//        if (CrmCustomer::where('email', $email)->exists()){
//            return response()->json(['error' => 'Email already exists']);
//        }
        if (CrmCustomer::where('phone', $phone)->exists()) {
            return response()->json(['error' => 'Phone already exists']);
        }
        return response()->json(['success' => 'success'], Response::HTTP_OK);
    }

    public function createLead(Request $request)
    {
        $data = $request->all();
        $status = crmStatus::where('name', '=', 'New Lead')->first();
        $data['status_id'] = $status->id;

//        if request don't have first_name, last_name, phone, address, file_code return error
        if (!$request->has('first_name') || !$request->has('last_name') || !$request->has('phone') || !$request->has('address') || !$request->has('file_code')) {
            return response()->json(['error' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        }

        if (isset($request->key)) {
//            if hashed key match with .env SECRET_PHRASE
            if (Hash::check(env('SECRET_PHRASE'), $request->key)) {
                $lead = CrmCustomer::create($data);
                return response()->json(['success' => 'success'], Response::HTTP_OK);
            }
        } else {
            return response()->json(['error' => 'Missing key'], Response::HTTP_BAD_REQUEST);
        }
    }

}
