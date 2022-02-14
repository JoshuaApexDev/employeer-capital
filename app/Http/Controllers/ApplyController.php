<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCrmCustomerRequest;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Http\Requests\UpdateCrmCustomerRequest;
use App\Models\CrmCustomer;
use App\Models\CrmStatus;
use App\Models\Position;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\DomPDF\PDF;

class ApplyController extends Controller
{
    public function index()
    {

        $positions = Position::all();

        return view('apply', compact( 'positions'));
    }

    public function Store(Request $request){
        if ($crmCustomer = CrmCustomer::create($request->all())){
            return view('admin.crmCustomers.thankyou');
        }else{
            return redirect('apply');
        }

    }

    public function Print($id){
        $crmCustomer = CrmCustomer::find($id);
        if ($crmCustomer->proof_of_residence === 1){
            $crmCustomer->proof_of_residence = 'Yes';
        }else{
            $crmCustomer->proof_of_residence = 'No';
        }
        if ($crmCustomer->birth_certificate === 1){
            $crmCustomer->birth_certificate = 'Yes';
        }else{
            $crmCustomer->birth_certificate = 'No';
        }
        if ($crmCustomer->official_valid === 1){
            $crmCustomer->official_valid = 'Yes';
        }else{
            $crmCustomer->official_valid = 'No';
        }
        if ($crmCustomer->payment_method === 1){
            $crmCustomer->payment_method = 'Yes';
        }else{
            $crmCustomer->payment_method = 'No';
        }
        $crmCustomer->load('position');
        $positions = Position::all();
        $html = view('admin.crmCustomers.print',compact('crmCustomer', 'positions'));
        $file = Storage::disk('public')->put('leadapplication'.$crmCustomer->id.'.html', $html);
        $file = Storage::disk('public')->path('leadapplication'.$crmCustomer->id.'.html');
        $pdf = \PDF::loadView('admin.crmCustomers.print',compact('crmCustomer', 'positions'));
        return $pdf->download('archivo.pdf');
        return response($html)->withHeaders([
            'Content-Type' => 'text/html',
            'Cache-Control' => 'no-store, no-cache',
            'Content-Disposition' => 'attachment; filename="job_application.html',
        ]);
    }


}
