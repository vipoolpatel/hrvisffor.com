@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Apply on Job')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container"> @include('flash::message')
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="userccount">
                    <div class="formpanel"> {!! Form::open(array('method' => 'post', 'route' => ['post.apply.job', $job_slug])) !!} 
                        <!-- Job Information -->
                        <h5>{{$job->title}}</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="formrow{{ $errors->has('cv_id') ? ' has-error' : '' }}"> {!! Form::select('cv_id', [''=>__('Select CV')]+$myCvs, null, array('class'=>'form-control', 'id'=>'cv_id')) !!}
                                    @if ($errors->has('cv_id')) <span class="help-block"> <strong>{{ $errors->first('cv_id') }}</strong> </span> @endif </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formrow{{ $errors->has('current_salary') ? ' has-error' : '' }}"> {!! Form::number('current_salary', null, array('class'=>'form-control', 'id'=>'current_salary', 'placeholder'=>__('Current salary').' ('.$job->getSalaryPeriod('salary_period').')' )) !!}
                                    @if ($errors->has('current_salary')) <span class="help-block"> <strong>{{ $errors->first('current_salary') }}</strong> </span> @endif </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formrow{{ $errors->has('expected_salary') ? ' has-error' : '' }}"> {!! Form::number('expected_salary', null, array('class'=>'form-control', 'id'=>'expected_salary', 'placeholder'=>__('Expected salary').' ('.$job->getSalaryPeriod('salary_period').')')) !!}
                                    @if ($errors->has('expected_salary')) <span class="help-block"> <strong>{{ $errors->first('expected_salary') }}</strong> </span> @endif </div>
                            </div>
                            <div class="col-md-12">
                                <div class="formrow{{ $errors->has('salary_currency') ? ' has-error' : '' }}"> {!! Form::text('salary_currency', Request::get('salary_currency', $siteSetting->default_currency_code), array('class'=>'form-control', 'id'=>'salary_currency', 'placeholder'=>__('Salary Currency'), 'autocomplete'=>'off')) !!}
                                    @if ($errors->has('salary_currency')) <span class="help-block"> <strong>{{ $errors->first('salary_currency') }}</strong> </span> @endif </div>
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
                                                        <td><input type="text" name="addmore[0][placeholder]" class="form-control" placeholder="Note"></td>
                                                        <td><button type="button" name="add" id="add" class="btn btn-success font-sm btn-sm"><i class="fa fa-plus"></i></button></td>
                                                    </tr>
                                                </table>


                                </div>


                        </div>
                        <br>
                        <input type="submit" class="btn" value="{{__('Apply on Job')}}">
                        {!! Form::close() !!} </div>
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