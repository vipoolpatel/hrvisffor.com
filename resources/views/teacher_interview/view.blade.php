<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/22/2020
 * Time: 1:32 AM
 */
?>
@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title'=>__('My Profile')])
    <!-- Inner Page Title end -->
    <div class="listpgWraper">
        <div class="container">
            <div class="row">
                @include('includes.user_dashboard_menu')

                <div class="col-md-9 col-sm-8 py-3 bg-white">
                    @if(session('msg'))
                        <div class="alert alert-primary mt-2" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <div class="alert alert-info alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Notice!</strong> Indicates a neutral informative change or action.
                    </div>
                    <a href="#" data-toggle="modal" data-target="#exampleModalLong" class="btn btn-success btn-sm">Set Up Availability</a>
                    <div class="row py-3">
                        <div class="col-md-12">
                            <h5>Available Time List:</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Duration(Minute)</th>
                                    <th>Note</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teacher_availabilities as $teacher_availability)
                                    <tr>
                                        <td>{{ $teacher_availability->date }}</td>
                                        <td>{{ $teacher_availability->time }}</td>
                                        <td>{{ $teacher_availability->duration }}</td>
                                        <td>{{ $teacher_availability->note }}</td>
                                        <td>
                                            <a href="{{ url('teacher-setup-time/destroy/'.encrypt($teacher_availability->id)) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row py-3">
                        <div class="col-md-12">
                            <h5>Interview Request from Schools:</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th colspan=1>School ID</th>
                                    <th colspan=1>Type of School</th>
                                    <th colspan=1>City</th>
                                    <th colspan=1>Interview time</th>
                                    <th colspan=2>Choose an action</th>
                                    <th colspan="2">Status</th>
                                </tr>
                                <tr>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top">Confirmed</th>
                                    <th align="center" valign="top">Reject</th>
                                    <th align="center" valign="top">Rescheduled</th>
                                    <th align="center" valign="top">Reject</th>
                                </tr>
                                </thead>
                                @inject('job_invitations','App\Services\InterviewService')
                                <tbody>
                                @foreach($job_invitations->getInterviewRequest() as $job_invite)
                                    <tr>
                                        <td><a href="{{ url('auto-company-login?company_id='.$job_invite->company_id) }}">{{ $job_invite->school_id }}</a></td>
                                        <td>{{ $job_invite->name }}</td>
                                        <td>{{ $job_invite->city_name }}</td>
                                        <td><a href="#" >Interview Time</a></td>
                                        <td><a href="#" class="btn btn-sm btn-success">Confirmed</a></td>
                                        <td><a href="#" class="btn btn-sm btn-danger">Reject</a></td>
                                        <td><a href="#">Rescheduled</a></td>
                                        <td><a href="#" >Reject</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12">
                            <h5>Confirmed Interviews:</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-center">
                                    <th colspan=1>School ID</th>
                                    <th colspan=1>Type of School</th>
                                    <th colspan=1>Interview Time</th>
                                    <th colspan="3">Status</th>
                                </tr>
                                <tr>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top">Confirmed</th>
                                    <th align="center" valign="top">Rescheduled</th>
                                    <th align="center" valign="top">Reject</th>
                                </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Set Up Availability Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('teacher-setup-time') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="date" class="col-form-label">Date:<span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" id="date" required>

                            @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="time" class="col-form-label">Time:<span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="time" name="time" required>

                            @if ($errors->has('time'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('time') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="duration" class="col-form-label">Duration(Minute):<span class="text-danger">*</span></label>
                            <input type="number" name="duration" class="form-control" id="duration" required>

                            @if ($errors->has('duration'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('duration') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" name="note" id="message-text"></textarea>

                            @if ($errors->has('note'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('note') }}</strong>
                            </span>
                            @endif
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showInterviewTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style type="text/css">
        .userccount p{ text-align:left !important;}
    </style>
@endpush
@push('scripts')
    <script>
        $('#showInterviewTime').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var date = button.data('date') // Extract info from data-* attributes
            var time = button.data('time') // Extract info from data-* attributes
            var duration = button.data('duration') // Extract info from data-* attributes
            var note = button.data('note') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    </script>
    @include('includes.immediate_available_btn')
@endpush
