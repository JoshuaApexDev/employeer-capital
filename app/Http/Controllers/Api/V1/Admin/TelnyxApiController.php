<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use http\Client\Response;
use Illuminate\Http\Request;
use Telnyx\Call;
use Telnyx\Connection;
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
        foreach ($connections as $connection) {
//            get random connection a
        }
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
        $call = $call->answer();
        $call = $call->transfer(['to' => 'sip:crm1005@sip.telnyx.com']);
        return response()->json(['success' => 'success'], 200);
    }
}
