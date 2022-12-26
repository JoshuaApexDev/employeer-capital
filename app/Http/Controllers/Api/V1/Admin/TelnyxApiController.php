<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrmCustomer;
use App\Models\CrmNote;
use App\Models\TelnyxCallEntry;
use App\Models\User;
use Illuminate\Http\Request;
use Telnyx\Call;
use Telnyx\CredentialConnection;
use Telnyx\Telnyx;


class TelnyxApiController extends Controller
{
    public function __construct()
    {
        Telnyx:: setApiKey(env('TELNYX_API_KEY'));
    }

    public function getConections()
    {
        $connections = CredentialConnection::all();
        return response()->json($connections);
    }

    public function getCalls()
    {
        $calls = Call::all();
        return response()->json($calls);
    }

    public function incomingCallQueue(Request $request)
    {
        $call_control_id = $request->data['payload']['call_control_id']; // call control id
        $call = Call::retrieve($call_control_id);

        if (isset($request->data['payload']['state'])) {
            $state = $request->data['payload']['state'];
            if ($state == 'parked') {
                $call->answer();
                $to = $request->data['payload']['to'];
                $user = User::where('sip_caller_id', $to)->first();
                $entry = TelnyxCallEntry::where('main_control_id', $request->data['payload']['call_control_id'])->first();
                if ($entry) {
                    $entry->main_control_id = $call_control_id;
                    $entry->main_call_json = json_encode($request->all());
                    $entry->to = $request->data['payload']['to'];
                    $entry->from = $request->data['payload']['to'];
                    $entry->sip_to = 'sip:' . $user->sip_extension . '@sip.telnyx.com';
                    $entry->save();
                } else {
                    $entry = new TelnyxCallEntry();
                    $entry->main_control_id = $call_control_id;
                    $entry->main_call_json = json_encode($request->all());
                    $entry->to = $request->data['payload']['to'];
                    $entry->from = $request->data['payload']['from'];
                    $entry->sip_to = 'sip:' . $user->sip_extension . '@sip.telnyx.com';
                    $entry->save();
                }
            }
//do the xfer to agent
            if ($user && $state != 'bridging') {
                $sip_endpoint = 'sip:' . $user->sip_extension . '@sip.telnyx.com';
                $call = Call::retrieve($call_control_id);
                $from = substr($request->data['payload']['from'], 1);
                $xfer = $call->transfer([
                    'to' => $sip_endpoint, 'from' => $from,
                    'webhook_url' => 'https://crmerc.apexcallcenters.xyz/api/telnyx/xfers'
                ]);
                $entry = TelnyxCallEntry::where('main_control_id', $request->data['payload']['call_control_id'])->first();
                if ($entry) {
                    $entry->child_call_json = json_encode($xfer);
                    $entry->save();
                }
                return response()->json('xfered:' . json_encode($xfer));
            }

        }

        return response()->json($call);
    }

    public function xfers(Request $request)
    {
        $call_control_id = $request->data['payload']['call_control_id'];
        $call = Call::retrieve($call_control_id);
        $to = $request->data['payload']['to'];
        $from = '+'.$request->data['payload']['from'];
        $main_call_entry = TelnyxCallEntry::where('sip_to', $to)->where('from', $from)->where('child_control_id',null)->first();
        if(!$main_call_entry){
            $main_call_entry = TelnyxCallEntry::where('sip_to', $to)->where('from', $from)->where('child_control_id',$call_control_id)->first();
        }else{
            $main_call_entry->child_control_id = $call_control_id;
        }
        $main_call_entry->child_call_json = json_encode($request->all());
        $main_call_entry->save();
        $main_call = Call::retrieve($main_call_entry->main_control_id);

        if (isset($request->data['payload']['sip_hangup_cause'])) {
            $hangup_cause = $request->data['payload']['sip_hangup_cause'];
            $hangup_source = $request->data['payload']['hangup_source'];
            if ($hangup_cause == '480' && $hangup_source == 'unknown') {
                $to = $request->data['payload']['to'];
                $to = substr($to, 4);
                $to = substr($to, 0, -15);
                $from = $request->data['payload']['from'];

                $user = User::where('sip_extension', $to)->first();
                $customer = CrmCustomer::where('phone', $from)->first();

                if ($customer) {
                    $customer->user_id = $user->id;
                    $customer->save();

                    $note = new CrmNote();
                    $note->customer_id = $customer->id;
                    $note->note = 'missing call asigned to ' . $user->name;
                    $note->save();

                } else {
                    $lead = new CrmCustomer();
                    $lead->first_name = 'missing lead';
                    $lead->last_name = 'missing lead';
                    $lead->phone = $from;
                    $lead->user_id = $user->id;
                    $lead->save();

                    $note = new CrmNote();
                    $note->customer_id = $lead->id;
                    $note->note = 'missing call asigned to ' . $user->name;
                    $note->save();
                }

                $main_call->speak([
                    'payload' => 'Agent not available, please try again later.',
                    'language' => 'en-US',
                    'voice' => 'female'
                ]);

                return response()->json('lead created!');
            }
        }

        return response()->json(json_encode($request->all()));
    }
}
