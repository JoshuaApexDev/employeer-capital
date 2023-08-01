<?php

namespace App\Http\Controllers;

use App\Mail\SecureLinkMail;
use App\Models\CrmCustomer;
use App\Models\DocumentType;
use App\Models\SecureLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SecureLinkController extends Controller
{
    public function sendSecureLink(Request $request)
    {
        $idReceived = $request->id;
        $idVerified = CrmCustomer::where('id', $idReceived)->first();

        if (!$idVerified) {
            return response()->json([
                'message' => 'Customer not found!',
            ], 404);
        }
        else {
        $secureLink = new SecureLink();
        $secureLink->email = $idVerified->email;
        $secureLink->employee_id = Auth::id();
        $secureLink->customer_id = $idReceived;
        $secureLink->save();

        $link = URL::temporarySignedRoute(
            'external-add-files', now()->addMinutes(20160), ['id' => $idReceived]
        );

        $data = [
            'subject' => 'Secure Link',
            'title' => 'Secure Link to upload files',
            'link' => $link,
        ];

//        return dd($data);

        Mail::to($idVerified->email)->send(new SecureLinkMail($data));

        return response()->json([
            'message' => 'Email sent successfully!',
        ], 200);

        }
    }
    public function secureLinkVerification(Request $request)
    {
        if(! $request->hasValidSignature()) {
            abort(401);
        }
        else {
            $customers = CrmCustomer::all();
            $document_types = DocumentType::all();
            $customer = CrmCustomer::where('id', $request->id)->first();

            $data = [
                'customer' => $customer,
            ];
            return view('external.addFiles', compact( 'customers', 'document_types', 'data'));
        }
    }
}
