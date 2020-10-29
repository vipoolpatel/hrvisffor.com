<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/21/2020
 * Time: 1:20 AM
 */
?>
@extends('admin.layouts.admin_layout')
@section('content')
    <style type="text/css">
        .table td, .table th {
            font-size: 12px;
            line-height: 2.42857 !important;
        }
    </style>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="{{ url('admin/job-invitations') }}">Job Invitation List</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Job Invitation Details</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Job Invitation <small>Details</small> </h3>

            @if($row->is_approve!=1 && $row->is_reject!=1)
                <a class="btn btn-sm btn-success" href="{{ url('/admin/job-invitation/approve/'.$row->id.'/true') }}">Approve</a>
                <a class="btn btn-sm btn-danger" href="{{ url('/admin/job-invitation/reject/'.$row->id.'/true') }}">Reject</a>
            @endif
            <a href="{{ url('admin/job-invitations') }}" class="btn btn-sm btn-primary">Back</a>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase"> Job Invitation</span> </div></div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="job-search-form">
                                    <table class="table table-striped table-bordered table-hover"  id="jobDatatableAjax">

                                        <tbody>
                                        <tr>
                                            <th>School ID</th>
                                            <td><a href="{{ url('auto-company-login?company_id=1') }}">{{ $row->school_id }}</a></td>
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

                                </form>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <h4>Available Time List:</h4>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Duration</th>
                                    <th>Note</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($school_availabilities))
                                    @foreach($school_availabilities as $school_availability)
                                        <tr>
                                            <td>{{ $school_availability->date }}</td>
                                            <td>{{ $school_availability->time }}</td>
                                            <td>{{ $school_availability->duration }}</td>
                                            <td>{{ $school_availability->note }}</td>

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
        <!-- END CONTENT BODY -->
    </div>
@endsection
@push('scripts')
    <script>

    </script>
@endpush

