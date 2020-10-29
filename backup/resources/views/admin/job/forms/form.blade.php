{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">        
    {!! Form::hidden('id', null) !!}
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'company_id') !!}" id="company_id_div">
        {!! Form::label('company_id', 'Company', ['class' => 'bold']) !!}                    
        {!! Form::select('company_id', ['' => 'Select Company']+$companies, null, array('class'=>'form-control', 'id'=>'company_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'company_id') !!}                                       
    </div>


  
     <div class="form-group"> 
        <label class="bold">{{__("What's the tile of your position?")}}</label>
        <select class="form-control" name="r_position_looking_id" required>
               <option value="">{{__("Select")}}</option>
                @foreach($getPositionLooking as $value_p)
                <option @if(!empty($job)) {{ ($job->r_position_looking_id == $value_p->id) ? 'selected' : '' }} @endif
                value="{{ $value_p->id }}">{{ $value_p->name }}</option>
            @endforeach
        </select>
     </div>


     <div class="form-group"> 
        <label class="bold">{{__('What type of your school?')}}</label>
        <select class="form-control" required="" name="r_school_id">
             <option value="">{{__("Select")}}</option>
              @foreach($getSchoolJoin as $value_s)
               <option @if(!empty($job)) {{ ($job->r_school_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
              @endforeach
        </select>
     </div>

    <div class="form-group"> 
        <label class="bold">{{__("What's type of position will you provide?")}}</label>
        <select class="form-control" required name="r_work_type_id">
               <option value="">{{__("Select")}}</option>
                @foreach($getWorkType as $value_w)
                  <option @if(!empty($job)) {{ ($job->r_work_type_id == $value_w->id) ? 'selected' : '' }} @endif value="{{ $value_w->id }}">{{ $value_w->name }}</option>
                @endforeach
        </select>
    </div>


    <div class="form-group"> 
      <hr />
    </div>

    <div class="form-group"> 
        <label class="bold" style="color: red;line-height: normal;font-size: 16px;">
                {{__("What's the location of your school?")}}
                <input type="hidden" value="44" name="country_id" id="country_id">
        </label>
    </div>

     <div class="form-group {!! APFrmErrHelp::hasError($errors, 'state_id') !!}" id="state_id_div">
        {!! Form::label('state_id', 'State', ['class' => 'bold']) !!}                    
        <span id="default_state_dd">
            {!! Form::select('state_id', ['' => 'Select State'], null, array('class'=>'form-control', 'id'=>'state_id')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'city_id') !!}" id="city_id_div">
        {!! Form::label('city_id', 'City', ['class' => 'bold']) !!}                    
        <span id="default_city_dd">
            {!! Form::select('city_id', ['' => 'Select City'], null, array('class'=>'form-control', 'id'=>'city_id')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'city_id') !!}                                       
    </div>



    <div class="form-group"> 
        <label class="bold">{{__('Do you need this teacher is a Native English Speaker or not?')}} </label>
        <select class="form-control" name="r_english_speaker_id" required>
           <option value="">{{__("Select")}}</option>
           <option @if(!empty($job)) {{ ($job->r_english_speaker_id == 'Yes') ? 'selected' : '' }} @endif value="Yes">{{__("Yes")}}</option>
           <option @if(!empty($job)) {{ ($job->r_english_speaker_id == 'No') ? 'selected' : '' }} @endif value="No">{{__("No")}}</option>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold">{{__('What type of visa do you require for teachers?')}}</label>
        <select class="form-control" name="r_visa_id" required>
            <option value="">{{__("Select")}}</option>
            @foreach($getVisa as $value)
                  <option @if(!empty($job)) {{ ($job->r_visa_id == $value->id) ? 'selected' : '' }} @endif value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold">{{__("What's the general location of your school?")}}</label>
        <select class="form-control" name="r_teach_id" required>
               <option value="">{{__("Select")}}</option>
                @foreach($getTeach as $value_t)
                    <option @if(!empty($job)) {{ ($job->r_teach_id == $value_t->id) ? 'selected' : '' }} @endif value="{{ $value_t->id }}">{{ $value_t->name }}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group"> 
         <label class="bold">{{__("When you need new teachers join the new work?")}}</label>
        <select class="form-control" name="r_position_id" required>
            <option value="">{{__("Select")}}</option>
            @foreach($getPosition as $value_p)
                <option @if(!empty($job)) {{ ($job->r_position_id == $value_p->id) ? 'selected' : '' }} @endif value="{{ $value_p->id }}">{{ $value_p->name }}</option>
            @endforeach
        </select>
    </div>

  <div class="col-md-6" style="padding-left: 0px;"> 
    <div class="form-group"> 
        <label class="bold">{{__("Salary Minimum Provided")}}</label>
        <select class="form-control" name="r_salary_id" required="">
              <option value="">{{__("Select")}}</option>
              @foreach($getSalaryExpect as $value_s)
                <option @if(!empty($job)) {{ ($job->r_salary_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
              @endforeach
        </select>
    </div>
  </div>

  <div class="col-md-6" > 
     <div class="form-group"> 
        <label class="bold">{{__("Salary Maximum Provided")}}</label>
        <select class="form-control" name="r_max_salary_id" required="">
              <option value="">{{__("Select")}}</option>
              @foreach($getSalaryExpect as $value_s)
                <option @if(!empty($job)) {{ ($job->r_max_salary_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
              @endforeach
        </select>
    </div>
  </div>


    <div class="form-group"> 
        <label class="bold">{{__("Working hours per week")}}</label>
        <select class="form-control" name="r_hour_id" required>
              <option value="">{{__("Select")}}</option>
              @for($i=1; $i<=50; $i++)
                <option @if(!empty($job)) {{ ($job->r_hour_id == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }}</option>
              @endfor
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold">{{__("Working Schedule")}}</label>
        <select class="form-control" name="r_working_schedule_id" required>
            <option value="">{{__("Select")}}</option>
            @foreach($getWorkingSchedule as $value)
                <option @if(!empty($job)) {{ ($job->r_working_schedule_id == $value->id) ? 'selected' : '' }} @endif value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold">{{__("Class size for teacher")}}</label>
        <select class="form-control" name="r_class_size_id" required>
              <option value="">{{__("Select")}}</option>
              @for($i=1; $i<=50; $i++)
                <option  @if(!empty($job)) {{ ($job->r_class_size_id == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }}</option>
              @endfor
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold">{{__("Minimum Age requirement")}}</label>
        <select class="form-control" name="r_min_age_requirement_id" required>
              <option value="">{{__("Select")}}</option>
              @for($i=18; $i<=65; $i++)
                <option @if(!empty($job)) {{ ($job->r_min_age_requirement_id == $i) ? 'selected' : '' }} @endif  value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
              @endfor
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold">{{__("Maximum Age requirement")}}</label>
        <select class="form-control" name="r_max_age_requirement_id" required>
              <option value="">{{__("Select")}}</option>
              @for($i=18; $i<=65; $i++)
                <option @if(!empty($job)) {{ ($job->r_max_age_requirement_id == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
              @endfor
        </select>
    </div>

    <div class="form-group"> 
        <hr />
    </div>

    <div class="form-group"> 
        <label class="bold">{{__("City Line")}}</label>
        <select class="form-control" name="r_city_line_id" required>
              <option value="">{{__("Select")}}</option>
              @foreach($getCityLine as $value_c)
                <option @if(!empty($job)) {{ ($job->r_city_line_id == $value_c->id) ? 'selected' : '' }} @endif value="{{ $value_c->id }}">{{ $value_c->name }}</option>
              @endforeach
        </select>
    </div>

      <div class="form-group"> 
        <label class="bold">{{__("VISA Qualification")}}</label>
        <select class="form-control" name="r_visa_qualification_id" required>
              <option value="">{{__("Select")}}</option>
              <option @if(!empty($job)) {{ ($job->r_visa_qualification_id == 'T') ? 'selected' : '' }} @endif value="T">{{__("T")}}</option>
              <option @if(!empty($job)) {{ ($job->r_visa_qualification_id == 'O') ? 'selected' : '' }} @endif value="O">{{__("O")}}</option>
        </select>
    </div>


    <div class="form-group"> 
        <label class="bold">{{__("Colour")}}</label>
        <select class="form-control" name="r_colour_id" required>
              <option value="">{{__("Select")}}</option>
              <option @if(!empty($job)) {{ ($job->r_colour_id == 'W') ? 'selected' : '' }} @endif value="W">{{__("W")}}</option>
              <option @if(!empty($job)) {{ ($job->r_colour_id == 'N') ? 'selected' : '' }} @endif value="N">{{__("N")}}</option>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold">{{__("Current location")}}</label>
        <select class="form-control" name="r_current_location_id" required>
              <option value="">{{__("Select")}}</option>
              <option @if(!empty($job)) {{ ($job->r_current_location_id == 'G') ? 'selected' : '' }} @endif value="G">{{__("G")}}</option>
              <option @if(!empty($job)) {{ ($job->r_current_location_id == 'C') ? 'selected' : '' }} @endif value="C">{{__("C")}}</option>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold">{{__("Emerency level")}}</label>
        <select class="form-control" name="r_emerency_level_id" required>
              <option value="">{{__("Select")}}</option>
              @foreach($getEmerencyLevel as $value_el)
                <option @if(!empty($job)) {{ ($job->r_emerency_level_id == $value_el->id) ? 'selected' : '' }} @endif value="{{ $value_el->id }}">{{ $value_el->name }}</option>
              @endforeach
        </select>
    </div>

    
    <div class="form-group"> 
        <hr />
    </div>



    


    <div class="form-group"> 
        <label class="bold">{{__("Welfare Provided (Multiple Selections)")}}</label>
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

    <div class="form-group"> 
        <label class="bold">{{__("Photo of your school environment (Maximum 6 photos)")}}</label>
        <input type="file" name="school_environment[]" accept="image/*" multiple class="form-control">
    </div>

      @if(!empty($job) && !empty(count($job->jobschoolenvironment)))
      <div style="clear: both;"></div>
       <div class="form-group"> 
         @foreach($job->jobschoolenvironment as $school_environment)
           <div class="col-md-2" style="padding-left: 0px; "> 
            <img alt="" style="height: 120px; width: 100%;" src="{{ url('public/company/'.$school_environment->image_name) }}">
            <a href="{{ url('delete-front-job-school-environment/'.$school_environment->job_id.'/'.$school_environment->id.'') }}" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger">{{__("Delete")}}</a>
          </div>
         @endforeach
       </div>
       <div style="clear: both;"></div>
      <div class="form-group"> 
        <hr />
      </div>
      @endif


      <div style="clear: both;"></div>

    <div class="form-group"> 
        <label class="bold">{{__("Photo of teacher's accommodation (Maximum 6 photos)")}}</label>
        <input type="file" name="teachers_accommodation[]" accept="image/*" multiple class="form-control">
    </div>


      @if(!empty($job) && !empty(count($job->jobteachersaccommodation)))
      <div style="clear: both;"></div>
       <div class="form-group"> 
         @foreach($job->jobteachersaccommodation as $teachers_accommodation)
           <div class="col-md-2" style="padding-left: 0px; "> 
            <img alt="" style="height: 120px; width: 100%;" src="{{ url('public/company/'.$teachers_accommodation->image_name) }}">
            <a href="{{ url('delete-front-job-teachers-accommodation/'.$teachers_accommodation->job_id.'/'.$teachers_accommodation->id.'') }}" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger">{{__("Delete")}}</a>
          </div>
         @endforeach
       </div>
       <div style="clear: both;"></div>
      <div class="form-group"> 
        <hr />
      </div>
      @endif


    <div style="clear: both;"></div>


    <div class="form-group"> 
        <label class="bold">{{__("Contact name")}}</label>
        <input type="text" value="@if(!empty($job)) {{ $job->r_contact_name }} @endif" name="r_contact_name" required placeholder="{{__("Contact name")}}" class="form-control">
    </div>


    <div class="form-group"> 
        <label class="bold">{{__("Wechat ID")}}</label>
        <input type="text" name="r_wechat_id" value="@if(!empty($job)) {{ $job->r_wechat_id }} @endif"  placeholder="{{__("Wechat ID")}}" class="form-control"> 
    </div>


    <div class="form-group"> 
        <label class="bold">{{__("School name")}}</label>
        <input type="text" name="r_school_name" value="@if(!empty($job)) {{ $job->r_school_name }} @endif" required placeholder="{{__("School name")}}" class="form-control">
    </div>

    <div class="form-group"> 
        <label class="bold">{{__("Job Expiry Date")}}</label>
        <input type="text" name="expiry_date" value="@if(!empty($job)) {{ date('Y-m-d',strtotime($job->expiry_date)) }} @endif" required placeholder="{{__("Expiry Date")}}" class="form-control datepicker">
    </div>



    <div class="form-group"> 
        <hr />
    </div>


    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_active') !!}">
        {!! Form::label('is_active', 'Is Active?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_active_1 = 'checked="checked"';
            $is_active_2 = '';
            if (old('is_active', ((isset($job)) ? $job->is_active : 1)) == 0) {
                $is_active_1 = '';
                $is_active_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="active" name="is_active" type="radio" value="1" {{$is_active_1}}>
                Active </label>
            <label class="radio-inline">
                <input id="not_active" name="is_active" type="radio" value="0" {{$is_active_2}}>
                In-Active </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_active') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_featured') !!}">
        {!! Form::label('is_featured', 'Is Featured?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_featured_1 = '';
            $is_featured_2 = 'checked="checked"';
            if (old('is_featured', ((isset($job)) ? $job->is_featured : 0)) == 1) {
                $is_featured_1 = 'checked="checked"';
                $is_featured_2 = '';
            }
            ?>
            <label class="radio-inline">
                <input id="featured" name="is_featured" type="radio" value="1" {{$is_featured_1}}>
                Featured </label>
            <label class="radio-inline">
                <input id="not_featured" name="is_featured" type="radio" value="0" {{$is_featured_2}}>
                Not Featured </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_featured') !!} </div>	
    <div class="form-actions">
        {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
@push('css')
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
@endpush
@push('scripts')
@include('admin.shared.tinyMCEFront') 
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2-multiple').select2({
            placeholder: "Select Required Skills",
            allowClear: true
        });
        $(".datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-m-d'
        });
        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterDefaultStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterDefaultCities(0);
        });
        filterDefaultStates(<?php echo old('state_id', (isset($job)) ? $job->state_id : 0); ?>);
    });
    function filterDefaultStates(state_id)
    {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.default.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterDefaultCities(<?php echo old('city_id', (isset($job)) ? $job->city_id : 0); ?>);
                    });
        }
    }
    function filterDefaultCities(city_id)
    {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.default.cities.dropdown') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_city_dd').html(response);
                    });
        }
    }
</script>
@endpush