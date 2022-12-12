<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Csv\Reader;

class LeadUploaderController extends Controller
{
    //
    public function index()
    {
        return view('admin.leadsUploader.index');
    }

    public function uploadLeadsReport(Request $request)
    {
        dd($request);
    }

    public function validateFile($file)
    {
        $csv_path = $file->getRealPath();
        $csv_file = Reader::createFromPath($csv_path);
        $csv_file->setHeaderOffset(0);
        $headers = $csv_file->getHeader();
        dd($headers);
    }

}
