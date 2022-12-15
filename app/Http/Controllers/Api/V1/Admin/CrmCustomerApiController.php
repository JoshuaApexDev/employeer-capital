<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Http\Requests\UpdateCrmCustomerRequest;
use App\Http\Resources\Admin\CrmCustomerResource;
use App\Models\CrmCustomer;
use App\Models\CrmStatus;
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
        $crmStatuses = CrmStatus::all();
        $status_count = [];
        foreach ($crmStatuses as $status) {
            $stat = [
                'count' => CrmCustomer::where('status_id', $status->id)->count(),
                'id' => $status->id,
                'name' => $status->name,
            ];
            array_push($status_count, $stat);
        }

        return response()->json($status_count);
    }

    public function getLead(Request $request)
    {
        if (isset($request->key)) {
//            if hashed key match with .env SECRET_PHRASE
            if (Hash::check(env('SECRET_PHRASE'), $request->key)) {
                if (!CrmCustomer::where('phone', '=', $request->phone)->exists()) {
                    return response()->json(['error' => 'Phone not found'], Response::HTTP_BAD_REQUEST);
                } else {
                    $lead = CrmCustomer::where('phone', '=', $request->phone)->first();
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
