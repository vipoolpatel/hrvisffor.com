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
                                <h5>Applied List:</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>

                                        <tr>
                                            <th colspan="1">School ID</th>
                                            <th colspan="1">Type of School</th>
                                            <th colspan="1">City</th>
                                            <th colspan="1">Interview time</th>
                                            <th colspan="1">Status</th>
                                            <th colspan="1"></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Confirmed/Rejected</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @inject('interview_requests','App\Services\InterviewService')
                                        @php
                                            $interview_reqst = $interview_requests->getTeacherAppliedList();
                                                $index = $interview_reqst->perPage() * ($interview_reqst->currentPage() - 1);
                                        @endphp

                                        @foreach($interview_reqst as $key=>$row)
                                            <tr>
                                                <td><a href="{{ url('job/'.$row->slug) }}">{{ $row->school_id }}</a></td>

                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->city_name }}</td>
                                                <td><a href="{{ url('apply-details-job/'.$row->id) }}"> View Time</a></td>
                                                <td class="text-center">
                                                    @if($row->is_confirm==1)
                                                        {{ 'Confirmed' }}
                                                    @elseif($row->is_reject==1)
                                                        {{ 'Rejected' }}
                                                    @else
                                                        {{ 'Pending' }}
                                                    @endif

                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ url('apply-details-job/'.$row->id) }}" class="btn btn-sm btn-primary">View </a>
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
                            <h5>Interview Request from Schools:</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th colspan=1>School ID</th>
                                    <th colspan=1>Type of School</th>
                                    <th colspan=1>City</th>
                                    <th colspan=1>Interview time</th>
                                    <th colspan=3>Choose an action</th>
                                    <th colspan="1"></th>
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
                                        <td><a href="{{ url('job/'.$job_invite->slug) }}">{{ $job_invite->school_id }}</a></td>
                                        <td>{{ $job_invite->name }}</td>
                                        <td>{{ $job_invite->city_name }}</td>
                                        <td><a href="{{ url('teacher-invitation-details/'.$job_invite->id) }}" >Interview Time</a></td>
                                        <td><a class="btn btn-sm btn-success" href="{{ url('/job-invitation/accept/'.$job_invite->id.'/true') }}">Confirm</a></td>
                                        <td><a class="btn btn-sm btn-danger" href="{{ url('/job-invitation/reject/'.$job_invite->id.'/true') }}">Reject</a></td>
                                        <td class="text-center"><a href="#" data-toggle="modal" data-target="#rescheduleModal" data-id={{$job_invite->id}} class="btn btn-sm btn-primary"><i class="fa fa-calendar-check-o"></i></a></td>
                                        <td><a href="#" ></a></td>
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
                                    <th colspan=1>City</th>
                                    <th colspan=1>Interview Time</th>
                                    <th colspan="2">Choose an action</th>
                                    <th colspan="1">Status</th>
                                    <th colspan="1"></th>
                                </tr>
                                <tr>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top"></th>
                                    <th align="center" valign="top"></th>
                                    <th>Reschedule</th>
                                    <th>Cancel</th>
                                    <th>Confirmed/Canceled</th>
                                    <th>Enter Interview Room</th>

                                </tr>
                                </thead>
                                <tbody>
                                @inject('interview_requests','App\Services\InterviewService')
                                @php
                                    $interview_reqs = $interview_requests->getTeacherInterviewConfirm();
                                        $index = $interview_reqs->perPage() * ($interview_reqs->currentPage() - 1);
                                @endphp

                                @foreach($interview_reqs as $key=>$interview_req)
                                    <tr>
                                        <td><a href="{{ url('job/'.$interview_req->slug) }}">{{ $interview_req->school_id }}</a></td>
                                        <td>{{ $interview_req->name }}</td>
                                        <td>{{ $interview_req->city_name }}</td>
                                        <td><a href="#" data-toggle="modal" data-target="#interviewTimeModal" data-id={{$interview_req->id}}> View Time</a></td>
                                        <td class="text-center">
                                            <a href="#" data-toggle="modal" data-target="#rescheduleModal" data-id={{$interview_req->id}} class="btn btn-sm btn-primary"><i class="fa fa-calendar-check-o"></i></a>
                                        </td>
                                        <td class="text-center"><a href="#" data-id={{ url('confirminterview-cancel/'.$interview_req->id)}}    data-toggle="modal"
                                                                   data-target="#deleteModal" class="btn btn-sm btn-danger delete"><i class="fa fa-times"></i> </a></td>
                                        <td>
                                            @if($interview_req->is_confirm==1)
                                                {{ 'Confirmed' }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(empty($interview_req->interview_room))
                                                <a href="#" data-name="{{$interview_req->first_name.' '.$interview_req->last_name}}" data-user="{{$interview_req->user_id}}" data-job="{{ $interview_req->job_id }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> </a>
                                            @else
                                                <a href="">{{ $interview_req->interview_room }}</a>
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
    <div class="modal fade" id="rescheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header list-header p-2">
                    <h5 class="modal-title" id="exampleModalLabel">Reschedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('confirmjob-reschedule') }}" method="post">
                    @csrf
                    <div class="modal-body room-confirm">
                        <div id="rescheduleID">
                            @include('includes.teacher_reschedule')
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success submit" id="addReschedule">Update</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
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
                            @include('includes.teacher_interview_time')
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>

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
@push('styles')
    <style type="text/css">
        .userccount p{ text-align:left !important;}
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/moment-timezone-with-data.js') }}"></script>


    <script>

        $('#addRoomModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var user = button.data('user') // Extract info from data-* attributes
            var name = button.data('name') // Extract info from data-* attributes
            var job = button.data('job') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-body #job_id').val(job)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #user').val(user)
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
                url: "{{ url('api/teacher-interview-reschedule') }}"+'/'+id,
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
                url: "{{ url('api/teacher-interview-time') }}"+'/'+id,
                dataType: "html",
                success:function(data){

                    $('#interviewTimeID').html(data)

                },

            });
        });

        $(document).ready(function() {
            var timeZone = moment.tz.guess();
            $("#timeZone").val(timeZone);

        });
    </script>
    @include('includes.immediate_available_btn')
@endpush
