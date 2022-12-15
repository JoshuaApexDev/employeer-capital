<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class LeadUploaderController extends Controller
{
    //
    public function index()
    {
        return view('admin.LeadsUploader.index');
    }

    public function uploadLeadsReport(Request $request)
    {
        $csv_path = $request->file('file')->getRealPath();
        $validate = $this->validateFile($request->file('file'));
//        dd($validate);
        $user_id = Auth::user()->id;
        if(!$validate){
            $csv_file = Reader::createFromPath($csv_path);
            $csv_file->setHeaderOffset(0);
            return redirect()->back()->with('error', 'The headers from the file uploaded are not correct. Please check the file and try again.');
        }else{
            $file = Storage::put('/tmp', $request->file('file'));
//            dd('cd '.base_path() . ' && nohup php artisan upload_leads:leads_uploader ' . storage_path('app/'.$file) . ' '.$user_id.' >/dev/null 2>&1 &');
            exec('cd '.base_path() . ' && nohup php artisan upload_leads:leads_uploader ' . storage_path('app/'.$file) . ' '.$user_id.' >/dev/null 2>&1 &');
            return redirect()->back()->with('success', 'File is processing ...');
        }
    }

    public function validateFile($file)
    {
        $csv_path = $file->getRealPath();
        $csv_file = Reader::createFromPath($csv_path);
        $csv_file->setHeaderOffset(0);
        $headers = $csv_file->getHeader();
        $headers_to_check = [
            'First name',
            'Last name',
            'Email',
            'Phone',
            'Address',
            'City',
            'State',
            'Zip',
            'W2_employees',
            'Receive_ERC',
            'ppp_loan',
            'Employee_count',
            'fname_verify',
            'Lname_verify',
        ];
        foreach ($headers_to_check as $header) {
            $search = in_array($header, $headers);
            if (!$search) {
//                dd('Missing header: ' . $header);
                return false;
            }
        }
        return true;
    }
}
