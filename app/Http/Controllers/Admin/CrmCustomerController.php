<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\RequestOptions;
use App\Models\CrmDocument;

class CrmCustomerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('crm_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomers = CrmCustomer::with(['status', 'position'])->get();

        $crm_statuses = CrmStatus::get();

        $positions = Position::get();

        return view('admin.crmCustomers.index', compact('crmCustomers', 'crm_statuses', 'positions'));
    }

    public function create()
    {
        abort_if(Gate::denies('crm_customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $positions = Position::pluck('position_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.crmCustomers.create', compact('positions', 'statuses'));
    }

    public function store(StoreCrmCustomerRequest $request)
    {
        $crmCustomer = CrmCustomer::create($request->all());

        return redirect()->route('admin.crm-customers.index');
    }

    public function edit(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client = new Client();
        $res = $client->request('get', 'https://management.apexcallcenters.xyz/api/locations');
        $locations = json_decode($res->getBody()->getContents());

        $statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $positions = Position::pluck('position_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $crmCustomer->load('status', 'position');

        return view('admin.crmCustomers.edit', compact('crmCustomer', 'positions', 'statuses', 'locations'));
    }

    public function update(UpdateCrmCustomerRequest $request, CrmCustomer $crmCustomer)
    {
        $status = crmStatus::where('id', '=', $request->status_id)->first();
        $documents = CrmDocument::where('customer_id','=',$crmCustomer->id)->get();
        $documents_array = [];
        foreach($documents as $document)
        {
            if($document->document_file != null)
            {
                $documents_array[] = $document->document_file->getUrl();
            }
        }
        $crmCustomer->update($request->all());
        $crmCustomer->load('status', 'position');
        if ($crmCustomer->status->name === 'Hired') {
            $client = new Client();
            $res = $client->post('https://management.apexcallcenters.xyz/api/apply/employee/create', [
//            $res = $client->post('http://management.gml/api/apply/employee/create', [
                RequestOptions::JSON => [
                    'full_name' => $crmCustomer->first_name . ' ' . $crmCustomer->last_name,
                    'location_id' => $request->location_id,
                    'position' => $crmCustomer->position->position_name,
                    'documents' => $documents_array
                    ]
            ]);
            $response = json_decode($res->getBody()->getContents());

            return redirect()->route('admin.crm-customers.index');
        }
        else {
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
        }

        return redirect()->route('admin.crm-customers.index');
    }

    public function show(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->load('status', 'position', 'leadTasks');

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
}
