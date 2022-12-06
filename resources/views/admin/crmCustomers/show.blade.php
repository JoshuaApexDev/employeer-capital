@extends('layouts.admin')
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Compose your email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route("admin.crm-customers.sendEmail") }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div id="spinner" class="spinner-border" role="status" hidden>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lead" id="lead" value="{{$crmCustomer->id}}" hidden>
                        </div>
                        <div class="form-group">
                            <label for="recipient_email" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient_email" disabled>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Body message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="btnSend" type="button" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} lead: {{ $crmCustomer->first_name }} {{ $crmCustomer->last_name }} |
            status:
            <div class="badge badge-primary">{{ $crmCustomer->status->name ?? '' }}</div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.crm-customers.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                    <a class="btn btn-warning" href="print/{{$crmCustomer->id }}">
                        Print
                    </a>
                    <button id="btnEmail" type="button" class="btn btn-primary" data-toggle="modal" data-target="#emailModal">
                        Send Email
                    </button>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.id') }}
                        </th>
                        <td>
                            {{ $crmCustomer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.first_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.last_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.email') }}
                        </th>
                        <td>
                            {{ $crmCustomer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.phone') }}
                        </th>
                        <td>
                            {{ $crmCustomer->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Cellphone
                        </th>
                        <td>
                            {{ $crmCustomer->cellphone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Other Phone
                        </th>
                        <td>
                            {{ $crmCustomer->other_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.address') }}
                        </th>
                        <td>
                            {{ $crmCustomer->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Country
                        </th>
                        <td>
                            {{ $crmCustomer->country ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            State
                        </th>
                        <td>
                            {{ $crmCustomer->state ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            City
                        </th>
                        <td>
                            {{ $crmCustomer->city ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Zip Code
                        </th>
                        <td>
                            {{ $crmCustomer->zip_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            File code
                        </th>
                        <td>
                            {{ $crmCustomer->file_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            W2 Employees
                        </th>
                        <td>
                            {{ $crmCustomer->w2_employees ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Receive ERC
                        </th>
                        <td>
                            {{ $crmCustomer->receive_erc ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            PPP Loan
                        </th>
                        <td>
                            {{ $crmCustomer->ppp_loan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Employee count
                        </th>
                        <td>
                            {{ $crmCustomer->employee_count ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            First name verified
                        </th>
                        <td>
                            {{ $crmCustomer->first_name_verified ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Last name verified
                        </th>
                        <td>
                            {{ $crmCustomer->last_name_verified ?? '' }}
                        </td>
                    </tr>
                    @for($i = 1; $i <= 10; $i++)
                        @php
                            $field = 'custom_field_'.$i;
                            $field = $crmCustomer->$field;
                        @endphp
                        <tr>
                            <th>
                                Custom Field {{$i}}
                            </th>
                            <td>
                                {{ $field ?? '' }}
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.crm-customers.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#lead_tasks" role="tab" data-toggle="tab">
                    {{ trans('cruds.task.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="lead_tasks">
                @includeIf('admin.crmCustomers.relationships.leadTasks', ['tasks' => $crmCustomer->leadTasks])
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>


        $(document).ready(function(){
            $('#btnEmail').click(function(){
                var email = '{{ $crmCustomer->email }}';
                var name = '{{ $crmCustomer->first_name }}';
                var subject = 'Hello '+name;
                var body = 'Hello '+name+',';
                $('#recipient_email').val(email);
                $('#subject').val(subject);
                $('#body').val(body);
            });

            $('#btnSend').click(function (){
                var email = $('#recipient_email').val();
                var subject = $('#subject').val();
                var message = $('#message').val();
                var lead = $('#lead').val();
                var url = '{{ route('admin.crm-customers.sendEmail', $crmCustomer->id) }}';

                //disable inputs and buttons until request is sent

                $('#spinner').removeAttr('hidden');
                $('#subject').attr('disabled', 'disabled');
                $('#message').attr('disabled', 'disabled');
                $('#btnSend').attr('disabled', 'disabled');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        recipient_email: email,
                        subject: subject,
                        message: message,
                        lead: lead
                    },
                    success: function (data) {
                        console.log(data);
                        $('#spinner').attr('hidden', 'hidden');
                        $('#subject').removeAttr('disabled');
                        $('#message').removeAttr('disabled');
                        $('#btnSend').removeAttr('disabled');
                        $('.modal-backdrop').removeClass('show');
                        $('#emailModal').modal('toggle');
                        Swal.fire(
                            'Email sent!',
                            'Your email has been sent succesfully!',
                            'success'
                        )
                    },
                    error: function (data) {
                        console.log(data);
                        $('#spinner').attr('hidden', 'hidden');
                        $('#subject').removeAttr('disabled');
                        $('#message').removeAttr('disabled');
                        $('#btnSend').removeAttr('disabled');
                        $('.modal-backdrop').removeClass('show');
                        $('#emailModal').modal('toggle');
                        Swal.fire(
                            'Oh no!',
                            'There is a problem sending your email, talk to your system administrator.',
                            'error'
                        )
                    }
                });
            });


        });

    </script>

@endsection
