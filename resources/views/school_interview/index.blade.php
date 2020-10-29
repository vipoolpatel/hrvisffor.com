<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/19/2020
 * Time: 10:13 PM
 */
?>
@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <style type="text/css">
        .jobimg img {
            height: 100px;
            width: 100px;
        }
    </style>
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title'=>__('Interview')])
    <!-- Inner Page Title end -->
    <div class="listpgWraper">
        <div class="container">
            @include('flash::message')
            <div class="row">
                @include('includes.company_dashboard_menu')
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
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Duration</th>
                                    <th>Note</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($school_availabilities as $school_availability)
                                    <tr>
                                        <td>{{ $school_availability->date }}</td>
                                        <td>{{ $school_availability->time }}</td>
                                        <td>{{ $school_availability->duration }}</td>
                                        <td>{{ $school_availability->note }}</td>
                                        <td>
                                            <a href="{{ url('school-setup-time/destroy/'.encrypt($school_availability->id)) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12">
                            <h5>Interview List:</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered ">
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
                                   @inject('interviews','App\Services\InterviewService')
                                   @php
                                       $interview_lists = $interviews->getInvitationList();
                                           $index = $interview_lists->perPage() * ($interview_lists->currentPage() - 1);
                                           @endphp
                                    @foreach($interview_lists as $key=>$row)
                                        <tr>
                                            <td>{{++$index}}</td>
                                            <td><a href="{{ url('auto-company-login?company_id='.$row->company_id) }}">{{ $row->school_id }}</a></td>

                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->first_name.' '.$row->last_name }}</td>

                                            <td>@if($row->is_accept==1)
                                                    {{ 'Confirmed' }}
                                                @elseif($row->is_cancel==1)
                                                    {{ 'Rejected' }}
                                                @else
                                                    {{ 'Pending' }}
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info" href="{{ url('job-invitation-details/'.$row->id) }}">View</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            {!! $interview_lists->render() !!}
                    </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12">
                            <h5>Interview Request from teachers:</h5>
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>

                                <tr>
                                    <th colspan="1">Teacher ID</th>
                                    <th colspan="1">Nationality</th>
                                    <th colspan="1">Degree</th>
                                    <th colspan="1">Interview time</th>
                                    <th colspan="2">Choose an action</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Reschedule</th>
                                    <th>Cancel</th>
                                </tr>
                                </thead>
                                <tbody>
                                @inject('interview_requests','App\Services\InterviewService')
                                @php
                                    $interview_reqs = $interview_requests->getJobAppliedList();
                                        $index = $interview_reqs->perPage() * ($interview_reqs->currentPage() - 1);
                                @endphp

                                @foreach($interview_reqs as $key=>$row)
                                    <tr>
                                        <td><a href="{{ url('applicant-profile/'.$row->user_id) }}">{{ $row->first_name.' '.$row->last_name }}</a></td>

                                        <td>{{ $row->nationality }}</td>

                                        <td>{{ $row->name }}</td>
                                        <td><a href="{{ url('apply-job-details/'.$row->id) }}"> View Time</a></td>
                                        <td class="text-center">
                                            <a href="#" data-toggle="modal" data-target="#rescheduleModal" data-id={{$row->id}} class="btn btn-sm btn-primary"><i class="fa fa-calendar-check-o"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" data-id={{ url('applied-job-reject/'.encrypt($row->id).'/1')}}    data-toggle="modal"
                                               data-target="#deleteModal" class="btn btn-sm btn-danger delete"><i class="fa fa-times"></i> </a>
                                        </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12">
                            <h5>Confirmed Interviews:</h5>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th colspan="1">Teacher ID</th>
                                    <th colspan="1">Nationality</th>
                                    <th colspan="1">Degree</th>
                                    <th colspan="1">Interview time</th>
                                    <th colspan="2">Choose an action</th>
                                    <th colspan="1">Status</th>
                                    <th colspan="1"></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Reschedule</th>
                                    <th>Cancel</th>
                                    <th>Confirmed/Canceled</th>
                                    <th>Enter Interview Room</th>
                                </tr>
                                </thead>
                                <tbody>
                                @inject('interview_requests','App\Services\InterviewService')
                                @php
                                    $interview_reqs = $interview_requests->getInterviewConfirm();
                                        $index = $interview_reqs->perPage() * ($interview_reqs->currentPage() - 1);
                                @endphp

                                @foreach($interview_reqs as $key=>$row_1)
                                    <tr>
                                        <td><a href="{{ url('applicant-profile/'.$row_1->user_id) }}">{{ $row_1->first_name.' '.$row_1->last_name }}</a></td>

                                        <td>{{ $row_1->nationality }}</td>

                                        <td>{{ $row_1->name }}</td>
                                        <td><a href="#" data-toggle="modal" data-target="#interviewTimeModal" data-id={{$row_1->id}}> View Time</a></td>
                                        <td class="text-center">
                                            <a href="#" data-toggle="modal" data-target="#rescheduleModal" data-id={{$row_1->id}} class="btn btn-sm btn-primary"><i class="fa fa-calendar-check-o"></i></a>
                                        </td>
                                        <td class="text-center"><a href="#" data-id={{url('confirm-interview-cancel/'.$row_1->id)}} data-toggle="modal"
                                            data-target="#deleteModal" class="btn btn-sm btn-danger delete"><i class="fa fa-times"></i> </a></td>
                                        <td>
                                            @if($row_1->is_confirm==1)
                                                {{ 'Confirmed' }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(empty($row_1->interview_room))
                                            <a href="#" data-toggle="modal" data-target="#addRoomModal" data-interview="{{ $row_1->id }}" data-name="{{$row_1->first_name.' '.$row_1->last_name}}" data-user="{{$row_1->user_id}}" data-job="{{ $row_1->job_id }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> </a>
                                            @else
                                                <a href="">{{ $row_1->interview_room }}</a>
                                            @endif
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
    <!-- Modal -->
    <div class="modal fade" id="interviewTimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header list-header p-2">
                    <h5 class="modal-title" id="exampleModalLabel">Interview Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body room-confirm">
                    <div id="interviewTimeModal">
                        @include('includes.school_interview_time')
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="rescheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header list-header p-2">
                    <h5 class="modal-title" id="exampleModalLabel">Reschedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/confirm-job-reschedule') }}" method="post">
                    @csrf
                    <div class="modal-body room-confirm">
                        <div id="rescheduleID">
                            @include('includes.reschedule')
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success submit addReschedule" id="addReschedule">Update</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Set Up Availability Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('school-setup-time') }}" method="post">
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
    <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Interview Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('add-interview-room') }}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Teacher Name:</label>
                            <input type="text" class="form-control" id="name">
                            <input type="hidden" name="job_id" class="form-control" id="job_id">
                            <input type="hidden" name="user_id" class="form-control" id="user">
                            <input type="hidden" name="interview_id" class="form-control" id="interview">
                        </div>
                        <div class="form-group">
                            <label for="interview_room" class="col-form-label">Room:</label>
                            <input type="text" name="interview_room" class="form-control" placeholder="Enter Room" id="interview_room">
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                    <div class="modal-body">

                        Are you sure want to cancel?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <a type="submit" id="confirm" class="btn btn-danger btn-sm">Confirm</a>
                    </div>

            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>

        $('#addRoomModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var user = button.data('user') // Extract info from data-* attributes
            var name = button.data('name') // Extract info from data-* attributes
            var job = button.data('job') // Extract info from data-* attributes
            var interview = button.data('interview') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-body #job_id').val(job)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #user').val(user)
            modal.find('.modal-body #interview').val(interview)
        })
        $(document).on('click','.delete',function(){
            let id = $(this).attr('data-id');
            $('#confirm').attr('href',id);
        });
        $('#rescheduleModal').on('shown.bs.modal', function (e) {
            var button = $(e.relatedTarget) // Button that triggered the modal
            var id = button.data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('api/school-interview-reschedule') }}"+'/'+id,
                dataType: "html",
                success:function(data){

                    $('#rescheduleID').html(data)

                },

            });
        });
        $('#interviewTimeModal').on('shown.bs.modal', function (e) {
            var button = $(e.relatedTarget) // Button that triggered the modal
            var id = button.data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('api/school-interview-time') }}"+'/'+id,
                dataType: "html",
                success:function(data){

                    $('#interviewTimeID').html(data)

                },

            });
        });
        $(document).ready(function() {
            var timeZone = moment.tz.guess();
            $("#timeZone").val(timeZone);
            // Add a 'click' event instead of an invalid 'submit' event.


        });
    </script>
@endpush

