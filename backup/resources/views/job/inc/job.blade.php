<h5>{{__('Job Details')}}</h5>
@if(isset($job))
{!! Form::model($job, array('method' => 'put', 'route' => array('update.front.job', $job->id), 'class' => 'form', 'files'=>true)) !!}
{!! Form::hidden('id', $job->id) !!}
@else
{!! Form::open(array('method' => 'post', 'route' => array('store.front.job'), 'class' => 'form', 'files'=>true)) !!}
@endif
<style type="text/css">
    .lineheight label
    {
        line-height: normal;
    }
</style>
<div class="row lineheight">  

   <div class="col-md-12">
        <div class="formrow"> 
            <label>{{__("What's the tile of your position?")}}</label>
            <select class="form-control" name="r_position_looking_id" required>
                   <option value="">{{__("Select")}}</option>
                    @foreach($getPositionLooking as $value_p)
                    <option @if(!empty($job)) {{ ($job->r_position_looking_id == $value_p->id) ? 'selected' : '' }} @endif
                    value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                @endforeach
            </select>
         </div>
    </div>

     <div class="col-md-6">
        <div class="formrow"> 
            <label>{{__('What type of your school?')}}</label>
            <select class="form-control" required="" name="r_school_id">
                 <option value="">{{__("Select")}}</option>
                  @foreach($getSchoolJoin as $value_s)
                   <option @if(!empty($job)) {{ ($job->r_school_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                  @endforeach
            </select>
         </div>
    </div>

    <div class="col-md-6">
        <div class="formrow"> 
            <label>{{__("What's type of position will you provide?")}}</label>
            <select class="form-control" required name="r_work_type_id">
                   <option value="">{{__("Select")}}</option>
                    @foreach($getWorkType as $value_w)
                      <option @if(!empty($job)) {{ ($job->r_work_type_id == $value_w->id) ? 'selected' : '' }} @endif value="{{ $value_w->id }}">{{ $value_w->name }}</option>
                    @endforeach
            </select>
         </div>
    </div>


    <div class="col-md-12"><hr></div>

     <div class="col-md-12" style="text-align: center;">
        <div class="formrow">
            <label style="color: red;line-height: normal;font-size: 16px;">
                {{__("What's the location of your school?")}}
                <input type="hidden" value="44" name="country_id" id="country_id">
            </label>
        </div>
    </div>
   
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'state_id') !!}" id="state_id_div">
            <label>{{__("State")}}</label>
            <span id="default_state_dd"> {!! Form::select('state_id', ['' => __('Select State')], null, array('class'=>'form-control', 'id'=>'state_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'state_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'city_id') !!}" id="city_id_div"> 
            <label>{{__("City")}}</label>
            <span id="default_city_dd"> {!! Form::select('city_id', ['' => __('Select City')], null, array('class'=>'form-control', 'id'=>'city_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'city_id') !!} </div>
    </div>

    <div class="col-md-6">
        <div class="formrow"> 
            <label>{{__('Do you need this teacher is a Native English Speaker or not?')}} </label>
            <select class="form-control" name="r_english_speaker_id" required>
               <option value="">{{__("Select")}}</option>
               <option @if(!empty($job)) {{ ($job->r_english_speaker_id == 'Yes') ? 'selected' : '' }} @endif value="Yes">{{__("Yes")}}</option>
               <option @if(!empty($job)) {{ ($job->r_english_speaker_id == 'No') ? 'selected' : '' }} @endif value="No">{{__("No")}}</option>
            </select>
         </div>
    </div>

    <div class="col-md-6">
        <div class="formrow"> 
            <label>{{__('What type of visa do you require for teachers?')}}</label>
            <select class="form-control" name="r_visa_id" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getVisa as $value)
                      <option @if(!empty($job)) {{ ($job->r_visa_id == $value->id) ? 'selected' : '' }} @endif value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
         </div>
    </div>

    
    <div class="col-md-6">
        <div class="formrow"> 
            <label>{{__("What's the general location of your school?")}}</label>
            <select class="form-control" name="r_teach_id" required>
                   <option value="">{{__("Select")}}</option>
                    @foreach($getTeach as $value_t)
                        <option @if(!empty($job)) {{ ($job->r_teach_id == $value_t->id) ? 'selected' : '' }} @endif value="{{ $value_t->id }}">{{ $value_t->name }}</option>
                    @endforeach
            </select>
         </div>
    </div>

    <div class="col-md-6">
        <div class="formrow"> 
            <label>{{__("When you need new teachers join the new work?")}}</label>
            <select class="form-control" name="r_position_id" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getPosition as $value_p)
                    <option @if(!empty($job)) {{ ($job->r_position_id == $value_p->id) ? 'selected' : '' }} @endif value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                @endforeach
            </select>
         </div>
    </div>


    <div class="col-md-6">
       <div class="formrow">
          <label>{{__("Salary Minimum Provided")}}</label>
          <select class="form-control" name="r_salary_id" required="">
              <option value="">{{__("Select")}}</option>
              @foreach($getSalaryExpect as $value_s)
                <option @if(!empty($job)) {{ ($job->r_salary_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
              @endforeach
          </select>
       </div>
    </div>

    <div class="col-md-6">
       <div class="formrow">
          <label>{{__("Salary Maximum Provided")}}</label>
          <select class="form-control" name="r_max_salary_id" required="">
              <option value="">{{__("Select")}}</option>
              @foreach($getSalaryExpect as $value_s)
                <option @if(!empty($job)) {{ ($job->r_max_salary_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
              @endforeach
          </select>
       </div>
    </div>

    <div class="col-md-6">
       <div class="formrow">
          <label>{{__("Working hours per week")}}</label>
          <select class="form-control" name="r_hour_id" required>
              <option value="">{{__("Select")}}</option>
              @for($i=1; $i<=50; $i++)
                <option @if(!empty($job)) {{ ($job->r_hour_id == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }}</option>
              @endfor
          </select>
       </div>
    </div>


     <div class="col-md-6">
        <div class="formrow"> 
            <label>{{__("Working Schedule")}}</label>
            <select class="form-control" name="r_working_schedule_id" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getWorkingSchedule as $value)
                    <option @if(!empty($job)) {{ ($job->r_working_schedule_id == $value->id) ? 'selected' : '' }} @endif value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
         </div>
    </div>

   <div class="col-md-6">
       <div class="formrow">
          <label>{{__("Class size for teacher")}}</label>
          <select class="form-control" name="r_class_size_id" required>
              <option value="">{{__("Select")}}</option>
              @for($i=1; $i<=50; $i++)
                <option  @if(!empty($job)) {{ ($job->r_class_size_id == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }}</option>
              @endfor
          </select>
       </div>
    </div>


    <div class="col-md-6">
       <div class="formrow">
          <label>{{__("Minimum Age requirement")}}</label>
          <select class="form-control" name="r_min_age_requirement_id" required>
              <option value="">{{__("Select")}}</option>
              @for($i=18; $i<=65; $i++)
                <option @if(!empty($job)) {{ ($job->r_min_age_requirement_id == $i) ? 'selected' : '' }} @endif  value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
              @endfor
          </select>
       </div>
    </div>

   <div class="col-md-6">
       <div class="formrow">
          <label>{{__("Maximum Age requirement")}}</label>
          <select class="form-control" name="r_max_age_requirement_id" required>
              <option value="">{{__("Select")}}</option>
              @for($i=18; $i<=65; $i++)
                <option @if(!empty($job)) {{ ($job->r_max_age_requirement_id == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
              @endfor
          </select>
       </div>
    </div>

    

  
    <div class="col-md-12">
       <div class="formrow">
          <label>{{__("Welfare Provided (Multiple Selections)")}}</label>
          <br>
           @foreach($getWelfare as $value_w)
                @php $checked = ''; @endphp
                @if(!empty($job)  && !empty(count($job->jobwelfare)))
                @foreach($job->jobwelfare as $welfare_id)
                    @if($welfare_id->welfare_id == $value_w->id)
                        @php $checked = 'checked'; @endphp
                    @endif
                @endforeach
                @endif
                <label><input {{ $checked }} type="checkbox" value="{{ $value_w->id }}" name="welfare[]"> {{ $value_w->name }}</label>
            @endforeach
       </div>
    </div>


    <div class="col-md-12">
       <div class="formrow">
          <label>{{__("Photo of your school environment (Maximum 6 photos)")}}</label>
          <input type="file" name="school_environment[]" accept="image/*" multiple class="form-control">

       </div>
    </div>

      @if(!empty($job) && !empty(count($job->jobschoolenvironment)))
        @foreach($job->jobschoolenvironment as $school_environment)
           <div class="col-md-3">
            <img alt="" style="height: 100px; width: 100%;" src="{{ url('public/company/'.$school_environment->image_name) }}">
            <a href="{{ url('delete-front-job-school-environment/'.$school_environment->job_id.'/'.$school_environment->id.'') }}" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger">{{__("Delete")}}</a>
          </div>
        @endforeach
      <div class="col-md-12">
        <hr />
      </div>
      @endif

   <div class="col-md-12">
       <div class="formrow">
          <label>{{__("Photo of teacher's accommodation (Maximum 6 photos)")}}</label>
          <input type="file" name="teachers_accommodation[]" accept="image/*" multiple class="form-control">
       </div>
    </div>

      @if(!empty($job) && !empty(count($job->jobteachersaccommodation)))
        @foreach($job->jobteachersaccommodation as $teachers_accommodation)
           <div class="col-md-3">
            <img alt="" style="height: 100px; width: 100%;" src="{{ url('public/company/'.$teachers_accommodation->image_name) }}">
            <a href="{{ url('delete-front-job-teachers-accommodation/'.$teachers_accommodation->job_id.'/'.$teachers_accommodation->id.'') }}" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger">{{__("Delete")}}</a>
          </div>
        @endforeach
      <div class="col-md-12">
        <hr />
      </div>
      @endif

    <div class="col-md-6">
       <div class="formrow">
          <label>{{__("Contact name")}}</label>
          <input type="text" value="@if(!empty($job)) {{ $job->r_contact_name }} @endif" name="r_contact_name" required placeholder="{{__("Contact name")}}" class="form-control">
       </div>
    </div>

    <div class="col-md-6">
       <div class="formrow">
          <label>{{__("Contact phone number")}}</label>
          <input type="text" value="@if(!empty($job)) {{ $job->r_phone_number }} @endif"  name="r_phone_number" required placeholder="{{__("Contact phone number")}}" class="form-control">
       </div>
    </div>

    <div class="col-md-6">
       <div class="formrow">
          <label>{{__("Wechat ID")}}</label>
          <input type="text" name="r_wechat_id" value="@if(!empty($job)) {{ $job->r_wechat_id }} @endif"  placeholder="{{__("Wechat ID")}}" class="form-control">
       </div>
    </div>

    <div class="col-md-6">
       <div class="formrow">
          <label>{{__("School name")}}</label>
          <input type="text" name="r_school_name" value="@if(!empty($job)) {{ $job->r_school_name }} @endif" required placeholder="{{__("School name")}}" class="form-control">
       </div>
    </div>


    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'expiry_date') !!}"> 
          <label>{{__("Expiry Date")}}</label>
          <input type="text" name="expiry_date" id="expiry_date" value="@if(!empty($job)) {{ date('Y-m-d',strtotime($job->expiry_date)) }} @endif" required placeholder="{{__("Job expiry date")}}" class="form-control datepicker">
          </div>
    </div>

    
    <div class="col-md-12">
        <div class="formrow">
            <button type="submit" class="btn">{{__('Update Job')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>
    </div>
</div>
<input type="file" name="image" id="image" style="display:none;" accept="image/*"/>
{!! Form::close() !!}
<hr>
@push('styles')
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
@endpush
@push('scripts')
@include('includes.tinyMCEFront')
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2-multiple').select2({
            placeholder: "{{__('Select Required Skills')}}",
            allowClear: true
        });
        $(".datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-m-d'
        });
        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterLangStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterLangCities(0);
        });
        filterLangStates(<?php echo old('state_id', (isset($job)) ? $job->state_id : 0); ?>);
    });
    function filterLangStates(state_id)
    {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.lang.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterLangCities(<?php echo old('city_id', (isset($job)) ? $job->city_id : 0); ?>);
                    });
        }
    }
    function filterLangCities(city_id)
    {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.lang.cities.dropdown') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_city_dd').html(response);
                    });
        }
    }
</script> 
@endpush