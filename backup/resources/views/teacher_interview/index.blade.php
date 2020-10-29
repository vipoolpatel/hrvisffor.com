<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/19/2020
 * Time: 10:14 PM
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
                                    <th>School ID</th>
                                    <th>Type of School</th>
                                    <th>Degree</th>
                                    <th>Interview time</th>
                                    <th>Choose an action</th>
                                </tr>
                                </thead>
                                <tbody>

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
@endsection
@push('styles')
    <style type="text/css">
        .userccount p{ text-align:left !important;}
    </style>
@endpush
@push('scripts')
    @include('includes.immediate_available_btn')
@endpush
