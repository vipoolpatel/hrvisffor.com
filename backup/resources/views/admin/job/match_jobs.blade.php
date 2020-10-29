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
                <li> <span>Match Jobs</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Match Job Seeker Profile </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">


            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">General Match</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="job-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="jobDatatableAjax">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($users as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->first_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>    
                                                    @if($value->getState('state'))
                                                    {{ $value->getState('state') }}
                                                    @endif

                                                    @if($value->getCity('city'))
                                                    , {{ $value->getCity('city') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ url('user-profile/'.$value->id) }}" class="btn btn-primary">View Profile</a>
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



             <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Accurate Match</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="job-search-form">
                                 <table class="table table-striped table-bordered table-hover"  id="jobDatatableAjaxState">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($Stateusers as $valuestate)
                                            <tr>
                                                <td>{{ $valuestate->id }}</td>
                                                <td>{{ $valuestate->first_name }}</td>
                                                <td>{{ $valuestate->email }}</td>
                                                <td>    
                                                    @if($valuestate->getState('state'))
                                                    {{ $valuestate->getState('state') }}
                                                    @endif

                                                    @if($valuestate->getCity('city'))
                                                    , {{ $valuestate->getCity('city') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ url('user-profile/'.$valuestate->id) }}" class="btn btn-primary">View Profile</a>
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

<script type="text/javascript">

    $('document').ready(function(){
        $('#jobDatatableAjax').DataTable({});
        $('#jobDatatableAjaxState').DataTable({});
        
        
    });

</script>

@endpush