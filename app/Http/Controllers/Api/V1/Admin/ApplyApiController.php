<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAPICrmCustomerRequest;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Models\CrmCustomer;
use App\Models\CrmNote;
use App\Models\CrmStatus;
use App\Models\RequiredDocument;
use Carbon\Carbon;
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
        if(isset($data['appointment'])){
            $cita = Carbon::createFromFormat('m/d/Y H:i a', $data['appointment'])->format('m-d-Y H:i');
            $status = CrmStatus::where('name', '=', 'Appointment')->first();
            $data['status_id'] = $status->id;
        }else{
            $status = crmStatus::where('name', '=', 'New Lead')->first();
            $data['status_id'] = $status->id;
        }

//        if request don't have first_name, last_name, phone, address, file_code return error
        if (!$request->has('first_name') || !$request->has('last_name') || !$request->has('phone') || !$request->has('address') || !$request->has('file_code')) {
            return response()->json(['error' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        }

        if (isset($request->key)) {
//            if hashed key match with .env SECRET_PHRASE
            if (Hash::check(env('SECRET_PHRASE'), $request->key)) {

                $phone = $request->phone;
//                if(substr($phone, 0, 1) != '1'){
//                    $phone = '1'.$phone;
//                }

                $data['phone'] = $phone;

                if(CrmCustomer::where('phone', $phone)->exists()) {
                    $lead = CrmCustomer::where('phone', $phone)->first();
                    $lead->update($data);
                    if(isset($data['appointment'])){
                        crmNote::create([
                            'note' => 'Call this lead on '.$cita,
                            'customer_id' => $lead->id,
                            'user_id' => 1,
                        ]);
                    }
                }else {
                    $lead = CrmCustomer::create($data);
                    if(isset($data['appointment'])){
                        crmNote::create([
                            'note' => 'Call this lead on '.$cita,
                            'customer_id' => $lead->id,
                            'user_id' => 1,
                        ]);
                    }
                }

//                retreaver posting ready2xfer
                $url = 'https://retreaverdata.com/data_writing?key=efd5e62a-b3d2-4a26-9697-f50db36c77f0&caller_number=1'.$phone.'&ready2xfer=true';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);

                return response()->json(['success' => 'success'], Response::HTTP_OK);
            }else{
                return response()->json(['error' => 'Invalid key'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['error' => 'Missing key'], Response::HTTP_BAD_REQUEST);
        }
    }

}
