@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        Leads Uploader
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Leads Report</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('admin.upload.leads-report')}}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="file">.Csv file</label>
                                        <input type="file" class="form-control" id="file" name="file" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
