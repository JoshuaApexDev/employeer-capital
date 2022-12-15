<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Http\Requests\UpdateCrmCustomerRequest;
use App\Http\Resources\Admin\CrmCustomerResource;
use App\Models\CrmCustomer;
use App\Models\CrmNote;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CrmCustomerApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('crm_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CrmCustomerResource(CrmCustomer::with(['status', 'position'])->get());
    }

    public function store(StoreCrmCustomerRequest $request)
    {
        $crmCustomer = CrmCustomer::create($request->all());

        return (new CrmCustomerResource($crmCustomer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CrmCustomerResource($crmCustomer->load(['status', 'position']));
    }

    public function update(UpdateCrmCustomerRequest $request, CrmCustomer $crmCustomer)
    {
        $crmCustomer->update($request->all());

        return (new CrmCustomerResource($crmCustomer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function status()
    {
        $crmStatuses = CrmCustomer::all();
        $status_count = [];
        foreach ($crmStatuses as $crmStatus) {
            if ($crmStatus->status != null) {
                $status_count[$crmStatus->status->name] = 0;
            }
        }
        foreach ($crmStatuses as $crmStatus) {
            if ($crmStatus->status != null) {
                $status_count[$crmStatus->status->name]++;
            }
        }
        return response()->json($status_count);
    }

    public function getLead(Request $request)
    {
        if (isset($request->key)) {
//            if hashed key match with .env SECRET_PHRASE
            if (Hash::check(env('SECRET_PHRASE'), $request->key)) {
                $user = User::find($request->user_id);
                if (!CrmCustomer::where('phone', '=', $request->phone)->exists()) {
                    $lead = new CrmCustomer();
                    $lead->first_name = 'new lead';
                    $lead->last_name = 'new lead';
                    $lead->phone = $request->phone;
                    $lead->user_id = $user->id;
                    $lead->save();

                    $note = new CrmNote();
                    $note->customer_id = $lead->id;
                    $note->note = 'incoming call asigned to ' . $user->name;
                    $note->save();

                    return response()->json($lead, Response::HTTP_OK);
                } else {
                    
                    $lead = CrmCustomer::where('phone', '=', $request->phone)->first();
                    $lead->user_id = $user->id;
                    $lead->save();

                    $note = new CrmNote();
                    $note->customer_id = $lead->id;
                    $note->note = 'incoming call asigned to ' . $user->name;
                    $note->save();

                    return response()->json($lead, Response::HTTP_OK);


                }
            } else {
                return response()->json(['error' => 'Invalid key'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['error' => 'Missing key'], Response::HTTP_BAD_REQUEST);
        }
    }

}
