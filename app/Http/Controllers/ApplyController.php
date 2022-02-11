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
use Symfony\Component\HttpFoundation\Response;

class ApplyController extends Controller
{
    public function index()
    {

        $positions = Position::all();

        return view('apply', compact( 'positions'));
    }

    public function Store(Request $request){
        $crmCustomer = CrmCustomer::create($request->all());

        return redirect('/apply');

    }


}
