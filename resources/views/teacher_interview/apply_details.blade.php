<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/24/2020
 * Time: 2:33 AM
 */
?>
<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/22/2020
 * Time: 1:49 AM
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
                        <div class="row py-3">
                            <div class="col-md-12">
                                <h5>Apply Details:</h5>

                                <table class="table table-striped table-bordered table-hover"  id="jobDatatableAjax">

                                    <tbody>
                                    <tr>
                                        <th>School ID</th>
                                        <td><a href="{{ url('auto-company-login?company_id='.$row->company_id) }}">{{ $row->school_id }}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Company</th>
                                        <td>{{ $row->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Teacher</th>
                                        <td>{{ $row->first_name.' '.$row->last_name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($row->is_approve==1)
                                                {{ 'Approved' }}
                                            @elseif($row->is_reject==1)
                                                {{ 'Reject' }}
                                            @else
                                                {{ 'New' }}
                                            @endif
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                                <h4>Available Time List:</h4>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Duration</th>
                                        <th>Note</th>
                                        <th>Status</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($teacher_availabilities))
                                        @foreach($teacher_availabilities as $teacher_availability)
                                            <tr>
                                                <td>{{ $teacher_availability->date }}</td>
                                                <td>{{ $teacher_availability->time }}</td>
                                                <td>{{ $teacher_availability->duration }}</td>
                                                <td>{{ $teacher_availability->note }}</td>
                                                <td>@if($teacher_availability->is_approve==1)
                                                        {{ 'Confirmed' }}
                                                    @elseif($teacher_availability->is_reject==1)
                                                        {{ 'Rejected' }}
                                                    @else
                                                        {{ 'Pending' }}
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')


@endsection
@push('styles')
    <style type="text/css">
        .userccount p{ text-align:left !important;}
    </style>
@endpush
@push('scripts')

    @include('includes.immediate_available_btn')
@endpush

