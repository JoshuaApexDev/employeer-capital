<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        .col {
            float: left;
            width: 33.33%;
        }

        .col2 {
            float: left;
            width: 50%;
            padding-left: 10%;
        }

        .col-head {
            float: left;
            width: 50%;
        }

        .col-head2 {
            float: left;
            width: 50%;
            text-align: center;
        }

        .col4 {
            float: left;
            width: 25%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>


<div class="container-fluid">
    <div class="row">
        <div class="">
            <form>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-head">
                                <h6>Lead Information</h6>
                            </div>
                            <div class="col-head2">
                                <h3>Lead ID: {{$crmCustomer->id}}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header text-center">
                        <h4><b>Personal Information</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <b>{{ trans('cruds.crmCustomer.fields.first_name') }}</b>
                                <p> {{$crmCustomer->first_name}}</p>
                            </div>
                            <div class="col">
                                <b>{{ trans('cruds.crmCustomer.fields.last_name') }}</b>
                                <p> {{$crmCustomer->last_name}}</p>
                            </div>
                            <div class="col">

                                <b>Phone number</b>
                                <p> {{$crmCustomer->phone}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <b>Email</b>
                                    <p> {{$crmCustomer->email}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <b>Cell Phone</b>
                                <p> {{$crmCustomer->cell_phone}}</p>
                            </div>
                            <div class="col">
                                <b>Address</b>
                                <p> {{$crmCustomer->address}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Country</b>
                                <p> {{$crmCustomer->country}}</p>
                            </div>
                            <div class="col">
                                <b>State</b>
                                <p> {{$crmCustomer->state}}</p>
                            </div>
                            <div class="col">
                                <b>City</b>
                                <p> {{$crmCustomer->city}}</p>
                            </div>
                            <div class="col">
                                <b>Zip Code</b>
                                <p> {{$crmCustomer->zip_code}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>File code</b>
                                <p> {{$crmCustomer->file_code}}</p>
                            </div>
                            <div class="col">
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="card card-primary">--}}
                    {{--                        <div class="card-header text-center">--}}
                    {{--                            <h4><b>Custom fields</b></h4>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="card-body">--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 1</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_1}}</p>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 2</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_2}}</p>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 3</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_3}}</p>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 4</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_4}}</p>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 5</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_5}}</p>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 6</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_6}}</p>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 7</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_7}}</p>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 8</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_8}}</p>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 9</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_9}}</p>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col">--}}
                    {{--                                    <b>Custom field 10</b>--}}
                    {{--                                    <p> {{$crmCustomer->custom_field_10}}</p>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col">--}}

                    {{--                                </div>--}}
                    {{--                                <div class="col">--}}

                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </form>
        </div>
    </div>
</div>


