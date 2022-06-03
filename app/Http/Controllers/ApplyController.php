<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCrmCustomerRequest;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Http\Requests\UpdateCrmCustomerRequest;
use App\Mail\newLead;
use App\Models\CrmCustomer;
use App\Models\CrmStatus;
use App\Models\Position;
use Carbon\Carbon;
use Gate;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
//use Barryvdh\DomPDF\PDF;
class ApplyController extends Controller
{
    public function index()
    {

        $positions = Position::all();

        return view('apply', compact( 'positions'));
    }
    public function indexsp()
    {

        $positions = Position::all();

        return view('applyspanish', compact( 'positions'));
    }

    public function Store(Request $request){
        $mails = [];
        $fields = $request->all();
        $status = CrmStatus::where('name', '=', 'Lead')->first();
        $fields['status_id'] = $status->id;
        if ($crmCustomer = CrmCustomer::create($fields)) {
            $date = Carbon::now();
            $guzzle = new Client();
            $req = $guzzle->request('GET', 'management.apexcallcenters.xyz/api/auto-reports/get/');
            $res = json_decode($req->getBody()->getContents());
            foreach ($res as $r) {
                if ($r->name == 'Applicants Mailing Report') {
                    $req = $guzzle->request('GET', 'management.apexcallcenters.xyz/api/auto-reports/get-user-reports/' . $r->id);
                    $res2 = json_decode($req->getBody()->getContents());
                    $users = $res2;
                    foreach ($users as $user) {
                        $mail = $user->email;
                        $mails[] = $mail;
                    }
                }
            }
            foreach ($mails as $mail) {
                Mail::to($mail)->send(new newLead($crmCustomer, $date, $status));
            }
            if ($request->lang == 'spanish'){
                return view('admin.crmCustomers.thankyousp');
            }else{
                return view('admin.crmCustomers.thankyou');
            }

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
	    //dd(env('APP_URL').'/storage/leadapplication'.$crmCustomer->id.'.html');
	    $pdf = PDF::loadHtml(file_get_contents(base_path().'/public/storage/'.'leadapplication'.$crmCustomer->id.'.html'));
	    //dd($pdf);
        //$file = Storage::disk('public')->path('leadapplication'.$crmCustomer->id.'.html');
	    $pdf->render();
        return  $pdf->stream();
	    //echo file_get_contents(base_path().'/public/storage/'.'leadapplication'.$crmCustomer->id.'.html');
    }


}
