<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCrmDocumentRequest;
use App\Http\Requests\StoreCrmDocumentRequest;
use App\Http\Requests\UpdateCrmDocumentRequest;
use App\Models\CrmCustomer;
use App\Models\CrmDocument;
use App\Models\DocumentType;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CrmDocumentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('crm_document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmDocuments = CrmDocument::with(['customer', 'media', 'documentType'])->get();

        return view('admin.crmDocuments.index', compact('crmDocuments'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('crm_document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = CrmCustomer::all();
        $document_types = DocumentType::all();

        $customer_id = $request->customer_id ?? null;
        $customer = CrmCustomer::find($customer_id);

        return view('admin.crmDocuments.create', compact('customers', 'customer', 'document_types'));
    }

    public function store(StoreCrmDocumentRequest $request)
    {
        $crmDocument = CrmDocument::create($request->all());

        if ($request->input('document_file', false)) {
            $crmDocument->addMedia(storage_path('tmp/uploads/' . basename($request->input('document_file'))))->toMediaCollection('document_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $crmDocument->id]);
        }

        return redirect()->route('admin.crm-documents.index');
    }

    public function edit(CrmDocument $crmDocument)
    {
        abort_if(Gate::denies('crm_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = CrmCustomer::all();
        $document_types = DocumentType::all();

        $crmDocument->load('customer', 'documentType');

        return view('admin.crmDocuments.edit', compact('customers', 'crmDocument', 'document_types'));
    }

    public function update(UpdateCrmDocumentRequest $request, CrmDocument $crmDocument)
    {
        $crmDocument->update($request->all());

        if ($request->input('document_file', false)) {
            if (!$crmDocument->document_file || $request->input('document_file') !== $crmDocument->document_file->file_name) {
                if ($crmDocument->document_file) {
                    $crmDocument->document_file->delete();
                }
                $crmDocument->addMedia(storage_path('tmp/uploads/' . basename($request->input('document_file'))))->toMediaCollection('document_file');
            }
        } elseif ($crmDocument->document_file) {
            $crmDocument->document_file->delete();
        }

        return redirect()->route('admin.crm-documents.index');
    }

    public function show(CrmDocument $crmDocument)
    {
        abort_if(Gate::denies('crm_document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmDocument->load('customer', 'documentType');

        return view('admin.crmDocuments.show', compact('crmDocument'));
    }

    public function destroy(CrmDocument $crmDocument)
    {
        abort_if(Gate::denies('crm_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmDocument->delete();

        return back();
    }

    public function massDestroy(MassDestroyCrmDocumentRequest $request)
    {
        CrmDocument::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('crm_document_create') && Gate::denies('crm_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CrmDocument();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function storeSecureLink(Request $request)
    {
        // Get the whole URL from the request
        $parsedUrl = parse_url($request->headers->get('referer'));
        // Get the host from the parsed URL
        $parsedHost = $parsedUrl['host'];

        // Get the host of your project
        $projectHost = strtok($_SERVER['HTTP_HOST'], ':');

        // Compare the two host values
        if ($parsedHost === $projectHost) {
            // The hosts match, perform the verification
            $crmDocument = CrmDocument::create($request->all());
            if ($request->input('document_file', false)) {
                $crmDocument->addMedia(storage_path('tmp/uploads/' . basename($request->input('document_file'))))->toMediaCollection('document_file');
            }
            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $crmDocument->id]);
            }
        } else {
            // The hosts do not match, handle the mismatch
            echo "Host mismatch! Verification failed.";
        }

//        return dd(Route::current(), $parsedUrl, $parsedHost, $projectHost);
            return Redirect::away($request->headers->get('referer'))->with('message', 'Document uploaded successfully!');
//        return redirect()->with('message', 'Document uploaded successfully!');
    }
    public function sendSecureLink(Request $request)
    {
        $crmDocument = CrmDocument::find($request->id);
        $crmDocument->sendSecureLink($request->email);
        return redirect()->route('admin.crm-documents.index');
    }
}
