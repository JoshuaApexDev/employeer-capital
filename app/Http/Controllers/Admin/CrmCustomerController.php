<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCrmCustomerRequest;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Http\Requests\UpdateCrmCustomerRequest;
use App\Mail\emailLead;
use App\Models\CrmCustomer;
use App\Models\CrmStatus;
use App\Models\User;
use App\Models\DocumentType;
use App\Models\Position;
use App\Models\RequiredDocument;
use Carbon\Carbon;
use Gate;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\RequestOptions;
use App\Models\CrmDocument;

class CrmCustomerController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('crm_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = auth()->user();
        if($user->getIsAdminAttribute() === true){
            $crmCustomers = CrmCustomer::with(['status', 'owner'])->get();
        }else{
            $crmCustomers = CrmCustomer::where('user_id', '=', null)->orwhere('user_id', '=', $user->id)->with(['status', 'owner'])->get();
        }

        if(isset($request->status)){
            $crmCustomers = CrmCustomer::where('status_id', '=', $request->status)->with(['status', 'owner'])->get();
        }
        $crm_statuses = CrmStatus::get();
        return view('admin.crmCustomers.index', compact('crmCustomers', 'crm_statuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('crm_customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.crmCustomers.create', compact('statuses'));
    }

    public function store(StoreCrmCustomerRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();

        if($user->getIsAdminAttribute() !== true) {
            $data['user_id'] = $user->id;
        }

        $status = crmStatus::where('name', '=', 'New Lead')->first();
        $data['status_id'] = $status->id;

        $phone = $request->phone;
        if(substr($phone, 0, 1) != '1'){
            $phone = '1'.$phone;
        }
        $data['phone'] = $phone;
        $crmCustomer = CrmCustomer::create($data);

        return redirect()->route('admin.crm-customers.index');
    }

    public function edit(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $users = User::pluck('name', 'id')->prepend(trans('Please select'), '');
        $documentTypes = DocumentType::all();
        $types = $documentTypes->pluck('id')->toArray();
        $documents = $crmCustomer->documents->pluck('document_type_id')->toArray();
        foreach($documentTypes as $documentType){
            $requested_documents = json_decode($crmCustomer->requested_documents);
            if(isset($requested_documents)){
                if(in_array($documentType->id, $requested_documents)){
                    $documentType->requested = true;
                }else{
                    $documentType->requested = false;
                }
            }else{
                $documentType->requested = false;
            }
            if(CrmDocument::where('customer_id', $crmCustomer->id)->where('document_type_id', $documentType->id)->exists()){
                $documentType->received = true;
            }else{
                $documentType->received = false;
            }
        }
//        dd($documentTypes->toArray());
        $user = auth()->user();

        $crmCustomer->load('status', 'owner');
        $crmDocuments = CrmDocument::where('customer_id', '=', $crmCustomer->id)->with(['customer', 'media'])->get();


        return view('admin.crmCustomers.edit', compact('crmCustomer',  'statuses', 'crmDocuments', 'documentTypes', 'users', 'user'));
    }

    public function update(UpdateCrmCustomerRequest $request, CrmCustomer $crmCustomer)
    {
        $data = $request->all();
        $data['requested_documents'] = json_encode($request['requested_documents']);
        $crmCustomer->update($data);
        $crmCustomer->load('status');

        return redirect()->route('admin.crm-customers.index');
    }

    public function show(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->load('status', 'leadTasks', 'owner');

        return view('admin.crmCustomers.show', compact('crmCustomer'));
    }

    public function destroy(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->delete();

        return back();
    }

    public function massDestroy(MassDestroyCrmCustomerRequest $request)
    {
        CrmCustomer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function sendEmail(Request $request){
        $email = $request->recipient_email;
        $subject = $request->subject;
        $message = $request->message;
        $leadid = $request->lead;
        $lead = CrmCustomer::where('id', '=', $leadid)->first();

        Mail::to($email)->send(new emailLead($subject, $message, $lead));

    }

    public function claim($id){
        $crmCustomer = CrmCustomer::where('id', '=', $id)->first();
        $crmCustomer->user_id = auth()->user()->id;
        $crmCustomer->save();
        $crmCustomer->load('status', 'owner');
        return redirect()->route('admin.crm-customers.edit', $crmCustomer);
    }

}
