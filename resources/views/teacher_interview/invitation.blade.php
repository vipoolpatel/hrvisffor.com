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
                            <h5>Invitation List:</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row" class="heading">
                                    <th>ID</th>
                                    <th>School ID</th>
                                    <th>Company</th>
                                    <th>Teacher</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><a href="{{ url('job/'.$row->slug) }}">{{ $row->school_id }}</a></td>

                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->first_name.' '.$row->last_name }}</td>

                                        <td>@if($row->is_accept==1)
                                                {{ 'Confirmed' }}
                                            @elseif($row->is_cancel==1)
                                                {{ 'Rejected' }}
                                            @else
                                                {{ 'New' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->is_accept==0 && $row->is_cancel==0)
                                                <a class="btn btn-sm btn-success" href="{{ url('/job-invitation/accept/'.$row->id.'/true') }}">Confirm</a>
                                                <a class="btn btn-sm btn-danger" href="{{ url('/job-invitation/reject/'.$row->id.'/true') }}">Reject</a>
                                            @endif
                                          <a class="btn btn-sm btn-info" href="{{ url('teacher-invitation-details/'.$row->id) }}">View</a>
                                        </td>
                                    </tr>
                                @endforeach

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
