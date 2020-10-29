<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/20/2020
 * Time: 8:18 PM
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
                    <li> <span>Applied Jobs</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Applied Jobs <small>List</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Applied Jobs</span> </div></div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="job-search-form">
                                    <table class="table table-striped table-bordered table-hover"  id="jobDatatableAjax">
                                        <thead>

                                        <tr role="row" class="heading">
                                            <th>ID</th>
                                            <th>School ID</th>
                                            <th>Company</th>
                                            <th>Teacher</th>
                                            <th>CV</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($rows as $key=>$row)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td><a href="{{ url('auto-company-login?company_id=1') }}">{{ $row->school_id }}</a></td>

                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->first_name.' '.$row->last_name }}</td>
                                                <td><a href="{{ url('cvs/'.$row->cv_file)}}" target="_blank">CV</a></td>
                                                <td>@if($row->is_approve==1)
                                                        {{ 'Approved' }}
                                                    @elseif($row->is_reject==1)
                                                        {{ 'Rejected' }}
                                                    @else
                                                        {{ 'New' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($row->is_approve!=1 && $row->is_reject!=1)
                                                    <a class="btn btn-sm btn-success" href="{{ url('/admin/applied-job/approve/'.$row->id.'/true') }}">Approve</a>
                                                    <a class="btn btn-sm btn-danger" href="{{ url('/admin/applied-job/reject/'.$row->id.'/true') }}">Reject</a>
                                                    @endif
                                                    <a class="btn btn-sm btn-danger" href="{{ url('/admin/applied-job/destroy/'.$row->id) }}">Delete</a>
                                                    <a class="btn btn-sm btn-info" href="{{ url('admin/applied-job/details/'.$row->id) }}">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
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
