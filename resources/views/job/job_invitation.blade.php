<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/21/2020
 * Time: 1:55 AM
 */
?>
@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title'=>__('Job Invitation')])
    <!-- Inner Page Title end -->
    <div class="listpgWraper">
        <div class="container"> @include('flash::message')
            <div class="row">
                <div class="col-md-10 col-md-offset-2">
                    <div class="job-header">
                        <div class="jobinfo">
                            <div class="candidateinfo">

                                <div class="title">
                                    {{$user->getName()}}
                                    @if((bool)$user->is_immediate_available)
                                        <sup style="font-size:12px; color:#1DB3DC;">{{__('Immediate Available For Work')}}</sup>
                                        <a href="{{ url('user-profile/'.$user->id) }}" class="float-right btn btn-sm btn-success">Profile</a>
                                </div>
                                @endif
                                <div class="desi">{{$user->getLocation()}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="userccount">
                        <div class="formpanel">
                            <form action="{{ url('job-invitation',$user->id) }}" method="post">
                                {{ csrf_field() }}
                            <div class="col-md-12">
                                <h5>Job List:</h5>
                                <div class="">
                                    <select class="form-control" name="job_id" required>
                                        <option value="">Select Job</option>
                                        @foreach($jobs as $row)
                                        <option value="{{ $row->id }}">{{ $row->getpositionlooking->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 py-1">
                                <h5 class="pt-3">Note:</h5>
                                <div class="formrow{{ $errors->has('note') ? ' has-error' : '' }}">
                                    <textarea class="form-control" placeholder="Write here..." name="note"></textarea>
                                 @if ($errors->has('note')) <span class="help-block"> <strong>{{ $errors->first('note') }}</strong> </span> @endif </div>
                            </div>



                                <div class="col-md-12">
                                    <h4>Set Up Interview Time:</h4>
                                    <table class="table" id="dynamicTable">
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Duration</th>
                                            <th>Note</th>
                                            <td></td>
                                        </tr>
                                        <tr>

                                            <td><input type="date" name="addmore[0][date]" placeholder="Date" class="form-control" /></td>

                                            <td><input type="time" name="addmore[0][time]" placeholder="Time" class="form-control" /></td>
                                            <td><input type="number" name="addmore[0][duration]" placeholder="Duration" class="form-control" /></td>
                                            <td><input type="text" name="addmore[0][note]" class="form-control" placeholder="Note"></td>
                                            <td><button type="button" name="add" id="add" class="btn btn-success font-sm btn-sm"><i class="fa fa-plus"></i></button></td>
                                        </tr>
                                    </table>


                                </div>


                            <br>
                            <input type="submit" class="btn" value="{{__('Invite')}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#salary_currency').typeahead({
                source: function (query, process) {
                    return $.get("{{ route('typeahead.currency_codes') }}", {query: query}, function (data) {
                        console.log(data);
                        data = $.parseJSON(data);
                        return process(data);
                    });
                }
            });

        });
    </script>
    <script type="text/javascript">

        var i = 0;

        $("#add").click(function(){

            ++i;

            $("#dynamicTable").append(
                '<tr><td><input type="date" name="addmore['+i+'][date]" placeholder="Date" class="form-control" /></td>' +
                '<td><input type="time" name="addmore['+i+'][time]" placeholder="Time" class="form-control" /></td>' +
                '<td><input type="number" name="addmore['+i+'][duration]" placeholder="Duration" class="form-control" /></td>' +
                '<td><input type="text" name="addmore['+i+'][note]" placeholder="note" class="form-control" /></td>' +
                '<td><button type="button" class="btn btn-danger remove-tr btn-sm"><i class="fa fa-remove"> </button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });

    </script>
@endpush
