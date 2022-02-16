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
        .col2{
            float: left;
            width: 50%;
            padding-left: 10%;
        }
        .col-head{
            float: left;
            width: 50%;
        }
        .col-head2{
            float: left;
            width: 50%;
            text-align: center;
        }
        .col4{
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
                                <h6>RG - RL - 07 </h6>
                                <h6>REV 01</h6>
                                Solicitud de nuevo ingreso
                            </div>
                            <div class="col-head2">
                                <h3>Job application</h3>
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
                                <b>Address</b>
                                <p> {{$crmCustomer->address}}</p>
                            </div>
                            <div class="col">
                                <b>Description</b>
                                <p> {{$crmCustomer->description}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Age</b>
                                <p> {{$crmCustomer->age}}</p>
                            </div>
                            <div class="col">
                                <b>Gender</b>
                                <p>{{$crmCustomer->gender}}</p>
                            </div>
                            <div class="col">
                                <b>Living with</b>
                                <p>{{$crmCustomer->living_with}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Dependents</b>
                                <p>{{$crmCustomer->dependents}}</p>
                            </div>
                            <div class="col">
                                <b>Date of birth</b>
                                <p>{{$crmCustomer->date_of_birth}}</p>
                            </div>
                            <div class="col">
                                <b>Nationality</b>
                                <p>{{$crmCustomer->nationality}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Marital Status</b>
                                <p>{{$crmCustomer->marital_status}}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header text-center">
                        <h4><b>Documentation</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <b>Social Security Number</b>
                                <p>{{$crmCustomer->ssn}}</p>
                            </div>
                            <div class="col">
                                <b>Curp</b>
                                <p>{{$crmCustomer->curp}}</p>
                            </div>
                            <div class="col">
                                <b>RFC</b>
                                <p>{{$crmCustomer->rfc}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Proof of residence</b>
                                <p>{{ $crmCustomer->proof_of_residence }}</p>
                            </div>
                            <div class="col">
                                <b>Birth Certificate</b>
                                <p>{{$crmCustomer->birth_certificate}}</p>
                            </div>
                            <div class="col">
                                <b>Official Valid ID</b>
                                <p>{{$crmCustomer->official_valid}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header text-center">
                        <h4><b>Health status and personal habits</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <b>Health Status</b>
                                <p>{{ $crmCustomer->health_status }}</p>
                            </div>
                            <div class="col">
                                <b>Chronic Illness</b>
                                <p>{{$crmCustomer->chronic_illness}}</p>
                            </div>
                            <div class="col">
                                <b>Have you had Covid</b>
                                <p>{{$crmCustomer->have_had_covid}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Covid Vaccine?</b>
                                <p>{{$crmCustomer->covid_vaccine}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header text-center">
                        <h4><b>Education History</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <b>Elementary School Name</b>
                                <p>{{ $crmCustomer->elementary_school_name }}</p>
                            </div>
                            <div class="col2">
                                <b>Elementary Graduate Date</b>
                                <p>{{$crmCustomer->elementary_graduate_date}}</p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Middle School Name</b>
                                <p>{{$crmCustomer->middle_school_name}}</p>
                            </div>
                            <div class="col2">
                                <b>Middle School Graduate Date</b>
                                <p>{{$crmCustomer->middle_school_graduate_date}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>High School Name</b>
                                <p>{{$crmCustomer->high_school_name}}</p>
                            </div>
                            <div class="col2">
                                <b>High School Graduate Date</b>
                                <p>{{$crmCustomer->high_school_graduate_date}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>College Name</b>
                                <p>{{$crmCustomer->college_name}}</p>
                            </div>
                            <div class="col2">
                                <b>College Graduate Date</b>
                                <p>{{$crmCustomer->college_graduate_date}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Professional Career</b>
                                <p>{{$crmCustomer->career}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header text-center">
                        <h4><b>Additional Information</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <b>Have you lived in USA?</b>
                                <p>{{$crmCustomer->lived_in_usa}}</p>
                            </div>
                            <div class="col">
                                <b>Do you speak english?</b>
                                <p>{{$crmCustomer->speak_english}}</p>
                            </div>
                            <div class="col">
                                <b>English level?</b>
                                <p>{{$crmCustomer->english_level}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Written english</b>
                                <p>{{$crmCustomer->written_english}}</p>
                            </div>
                            <div class="col">
                                <b>Applying for?</b>
                                <p>{{$crmCustomer->position->position_name}}</p>
                            </div>
                            <div class="col">
                                <b>When can you start?</b>
                                <p>{{$crmCustomer->when_start}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Are you paying INFONAVIT?</b>
                                <p>{{$crmCustomer->infonavit_credit}}</p>
                            </div>
                            <div class="col2">
                                <b>Do you have a Bank account?</b>
                                <p>{{$crmCustomer->payment_method}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>How did you hear about us?</b>
                                <p>{{$crmCustomer->how_you_knew}}</p>
                            </div>
                            <div class="col2">
                                <b>Additional comments</b>
                                <p>{{$crmCustomer->additional_comments}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="card card-primary">
                    <div class="card-header text-center">
                        <h4><b>Family Data</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col2">
                                <b>Father name</b>
                                <p>{{$crmCustomer->father_name}}</p>
                            </div>
                            <div class="col2">
                                <b>Father age</b>
                                <p>{{$crmCustomer->father_age}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col2">
                                <b>Mother name</b>
                                <p>{{$crmCustomer->mother_name}}</p>
                            </div>
                            <div class="col2">
                                <b>Mother age</b>
                                <p>{{$crmCustomer->mother_name}}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header text-center">
                        <h4><b>References</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <b>Name</b>
                                <p>{{$crmCustomer->reference_name_1 ?? ''}}</p>
                            </div>
                            <div class="col">
                                <b>Relationship</b>
                                <p>{{$crmCustomer->reference_relationship_1 ?? ''}}</p>
                            </div>
                            <div class="col">
                                <b>Phone number</b>
                                <p>{{$crmCustomer->reference_phone_1}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Name</b>
                                <p>{{$crmCustomer->reference_name_2}}</p>
                            </div>
                            <div class="col">
                                <b>Relationship</b>
                                <p>{{$crmCustomer->reference_relationship_2}}</p>
                            </div>
                            <div class="col">
                                <b>Phone number</b>
                                <p>{{$crmCustomer->reference_phone_2}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Name</b>
                                <p>{{$crmCustomer->reference_name_3}}</p>
                            </div>
                            <div class="col">
                                <b>Relationship</b>
                                <p>{{$crmCustomer->reference_relationship_3}}</p>
                            </div>
                            <div class="col">
                                <b>Phone number</b>
                                <p>{{$crmCustomer->reference_phone_3}}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header text-center">
                        <h4><b>Work History</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col4">
                                <b>Company name</b>
                                <p>{{$crmCustomer->company_name_1 ?? ''}}</p>
                            </div>
                            <div class="col4">
                                <b>Phone number</b>
                                <p>{{$crmCustomer->company_phone_1}}</p>
                            </div>
                            <div class="col4">
                                <b>Worked from</b>
                                <p>{{$crmCustomer->worked_from_1}}</p>
                            </div>
                            <div class="col4">
                                <b>Worked to</b>
                                <p>{{$crmCustomer->worked_until_1}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col4">
                                <b>Company name</b>
                                <p>{{$crmCustomer->company_name_2 ?? ''}}</p>
                            </div>
                            <div class="col4">
                                <b>Phone number</b>
                                <p>{{$crmCustomer->company_phone_2}}</p>
                            </div>
                            <div class="col4">
                                <b>Worked from</b>
                                <p>{{$crmCustomer->worked_from_2}}</p>
                            </div>
                            <div class="col4">
                                <b>Worked to</b>
                                <p>{{$crmCustomer->worked_until_2}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col4">
                                <b>Company name</b>
                                <p>{{$crmCustomer->company_name_3 ?? ''}}</p>
                            </div>
                            <div class="col4">
                                <b>Phone number</b>
                                <p>{{$crmCustomer->company_phone_3}}</p>
                            </div>
                            <div class="col4">
                                <b>Worked from</b>
                                <p>{{$crmCustomer->worked_from_3}}</p>
                            </div>
                            <div class="col4">
                                <b>Worked to</b>
                                <p>{{$crmCustomer->worked_until_3}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


