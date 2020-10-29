{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
@if(isset($user))
{!! Form::model($user, array('method' => 'put', 'route' => array('update.user', $user->id), 'class' => 'form', 'files'=>true)) !!}
{!! Form::hidden('id', $user->id) !!}
@else
{!! Form::open(array('method' => 'post', 'route' => 'store.user', 'class' => 'form', 'files'=>true)) !!}
@endif
<div class="form-body">    
    <input type="hidden" name="front_or_admin" value="admin" />
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'image') !!}">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    @if(!empty($user->image))
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                {{ ImgUploader::print_image("user_images/$user->image") }}  
                        </div>
                    @else
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="{{ asset('/') }}admin_assets/no-image.png" alt="" /></div>
                    @endif


                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                    <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select Profile Image </span> <span class="fileinput-exists"> Change </span> {!! Form::file('image', null, array('id'=>'image')) !!} </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                </div>
                {!! APFrmErrHelp::showErrors($errors, 'image') !!} </div>
        </div>
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}">
        <label class="bold">Select Self-intro Video</label>
        <br />
        <input type="file" accept="video/*"  name="self_intro"  >
        <br />

         @if(!empty($user->self_intro) && file_exists('public/video/'.$user->self_intro))
                @php
            $filename = explode('.', $user->self_intro);
            $extension = end($filename);
            @endphp
            <video poster="" height="150" id="player" playsinline controls>
              @if (strtolower($extension) == 'mp4')
                  <source src="{{ url('public/video') }}/{{ $user->self_intro }}" type="video/mp4">
              @elseif (strtolower($extension) == 'webm')
                  <source src="{{ url('public/video') }}/{{ $user->self_intro }}" type="video/webm">
              @endif
            </video>        
        @endif


    </div>



     <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}">
        {!! Form::label('email', 'Email', ['class' => 'bold']) !!}                    
        {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'email') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'password') !!}">
        {!! Form::label('password', 'Password', ['class' => 'bold']) !!}                    
        {!! Form::password('password', array('class'=>'form-control', 'id'=>'password', 'placeholder'=>'Password')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'password') !!}                                       
    </div>
    <div class="form-group">
        <hr />
    </div>

     <div class="form-group {!! APFrmErrHelp::hasError($errors, 'first_name') !!}">
        {!! Form::label('first_name', 'First Name', ['class' => 'bold']) !!}                    
        {!! Form::text('first_name', null, array('class'=>'form-control', 'id'=>'first_name', 'placeholder'=>'First Name')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'first_name') !!}                                       
    </div>

     <div class="form-group {!! APFrmErrHelp::hasError($errors, 'last_name') !!}">
        {!! Form::label('last_name', 'Last Name', ['class' => 'bold']) !!}                    
        {!! Form::text('last_name', null, array('class'=>'form-control', 'id'=>'last_name', 'placeholder'=>'Last Name')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'last_name') !!}                                       
    </div>

    <div class="form-group">
        <label class="bold">{{__("What's your current locatioin?")}}</label>
        <select class="form-control" name="r_current_locatioin_id" required>
            <option value="">{{__("Select")}}</option>
            @foreach($getCurrentLocatioin as $value_l)
                <option @if(!empty($user)) {{ ($user->r_current_locatioin_id == $value_l->id) ? 'selected' : '' }} @endif value="{{ $value_l->id }}">{{ $value_l->name }}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label class="bold">{{__("What's your nationality?")}}</label>
        <select class="form-control general_chine" required id="nationality_id" name="nationality_id">
            <option value="">{{__("Select your nationality?")}}</option>
            @foreach($nationalities as $value_c)
                <option @if(!empty($user)) {{ ($user->nationality_id == $value_c->country_id) ? 'selected' : '' }} @endif data-val="{{ $value_c->is_native }}" value="{{ $value_c->country_id }}">{{ $value_c->nationality }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="bold">{{__("Native English Speaker or not?")}}</label>
        <input class="form-control" type="text" readonly value="<?=!empty($user->r_english_speaker_id) ? $user->r_english_speaker_id : 'No'?>" name="r_english_speaker_id" id="r_english_speaker">
    </div>

    <div class="form-group">
        <label class="bold">{{__("What your highest education level?")}}</label>
        <select class="form-control general_chine" name="r_highest_education_id" id="r_highest_education_id" required>
            <option value="">{{__("Select your highest education level?")}}</option>
            @foreach($getHighestEducation as $value_h)
                <option @if(!empty($user)) {{ ($user->r_highest_education_id == $value_h->id) ? 'selected' : '' }} @endif value="{{ $value_h->id }}">{{ $value_h->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group" style="text-align: center;display: none;"  id="ChineseWorkingZVisa">
        <label class="bold" style="color: blue">{{__("You can apply Chinese Working Z Visa")}}</label>
        <input type="hidden" name="r_visa_id" id="r_visa_id">    
    </div>

    <div class="form-group">
        <label class="bold">{{__("Have you graduated two years or more?")}}</label>
        <select class="form-control general_chine" name="r_graduated_id" id="r_graduated" required>
            <option value="">{{__("Select graduated two years or more?")}}</option>
            <option @if(!empty($user)) {{ ($user->r_graduated_id == 'Yes') ? 'selected' : '' }} @endif value="Yes">{{__("Yes")}}</option>
            <option @if(!empty($user)) {{ ($user->r_graduated_id == 'No') ? 'selected' : '' }} @endif value="No">{{__("No")}}</option>
        </select>
    </div>

    <div class="form-group" style="text-align: center;display: none;" id="ChineseWorkingZVisaOther">
        <label class="bold" style="color: blue">{{__("You can apply the other types of Chinese Visa")}}</label>
    </div>

    <div class="form-group">
        <label class="bold">{{__("What type of school you want to join?")}}</label>
        <br />
        @foreach($getSchoolJoin as $value_s)
                @php $checked = ''; @endphp
                @if(!empty($user))
                @foreach($user->userschooljoin as $school_join_id)
                    @if($school_join_id->school_join_id == $value_s->id)
                        @php $checked = 'checked'; @endphp
                    @endif
                @endforeach
                @endif
               <label><input {{ $checked }} type="checkbox" value="{{ $value_s->id }}" name="school_join[]"> {{ $value_s->name }}</label>
        @endforeach
    </div>

   <div class="form-group">
      <label class="bold">{{__("Age")}}</label>
      <select class="form-control" name="r_age_id" required="">
         <option value="">{{__("Select")}}</option>
        @for($i=18;$i<=65;$i++)
         <option @if(!empty($user)) {{ ($user->r_age_id == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }} ysr</option>
        @endfor
      </select>
   </div>


   <div class="form-group hide_english_speaker">
        <label class="bold">{{__("Is Your Subject related to education or English?")}}</label>
        <select class="form-control" name="r_subject_education" id="r_subject_education" >
            <option value="">{{__("Select")}}</option>
            <option @if(!empty($user)) {{ ($user->r_subject_education == 'Yes') ? 'selected' : '' }} @endif value="Yes">{{__("Yes")}}</option>
            <option  @if(!empty($user)) {{ ($user->r_subject_education == 'No') ? 'selected' : '' }} @endif value="No">{{__("No")}}</option>        
        </select>
    </div>




   <div class="form-group">
        <hr />
    </div>

    <div class="form-group">
        <label class="bold" style="color: red;line-height: normal;font-size: 16px;">{{__("If you are not clear which city do you want to work, you can just choose a general location below and do not select State and City.")}}</label>
        <input type="hidden" name="country_id" value="44" id="country_id">
    </div>
    <div class="form-group">
        <hr />
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'state_id') !!}">
        {!! Form::label('state_id', 'State', ['class' => 'bold']) !!}                    
        <span id="default_state_dd">
            {!! Form::select('state_id', [''=>'Select State'], null, array('class'=>'form-control', 'id'=>'state_id')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'city_id') !!}">
        {!! Form::label('city_id', 'City', ['class' => 'bold']) !!}                    
        <span id="default_city_dd">
            {!! Form::select('city_id', [''=>'Select City'], null, array('class'=>'form-control', 'id'=>'city_id')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'city_id') !!}                                       
    </div>

    @php
$display_none = '';
if(!empty($user->city_id) && !empty($user->state_id)) {
    $display_none = 'display : none;';
}    
@endphp


    <div class="form-group r_teach_id_show"  >
         <label class="bold">{{__("Where do you want to teach?")}}</label>
        <select class="form-control" name="r_teach_id" required id="r_teach_id" >
            <option value="">{{__("Select")}}</option>
            @foreach($getTeach as $value_t)
                <option @if(!empty($user)) {{ ($user->r_teach_id == $value_t->id) ? 'selected' : '' }} @endif value="{{ $value_t->id }}">{{ $value_t->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <hr />
    </div>

    <div class="form-group">
        <label class="bold" >{{__("What position are you looking for?")}}</label>
        <select class="form-control" name="r_position_looking_id" required>
            <option value="">{{__("Select")}}</option>
            @foreach($getPositionLooking as $value_p)
                <option @if(!empty($user)) {{ ($user->r_position_looking_id == $value_p->id) ? 'selected' : '' }}  @endif value="{{ $value_p->id }}">{{ $value_p->name }}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label class="bold">{{__("What's type of work do you want?")}}</label>
        <select class="form-control" name="r_work_type_id" required>
            <option value="">{{__("Select")}}</option>
            @foreach($getWorkType as $value_w)
                <option @if(!empty($user)) {{ ($user->r_work_type_id == $value_w->id) ? 'selected' : '' }}  @endif value="{{ $value_w->id }}">{{ $value_w->name }}</option>
            @endforeach
        </select>        
    </div>


    <div class="form-group">
        <label class="bold" style="line-height: normal;">{{__("When you can join this new position if you got a satisfied offer?")}}</label>
        <select class="form-control" name="r_position_id" required>
            <option value="">{{__("Select")}}</option>
            @foreach($getPosition as $value_p)
                <option  @if(!empty($user)) {{ ($user->r_position_id == $value_p->id) ? 'selected' : '' }} @endif value="{{ $value_p->id }}">{{ $value_p->name }}</option>
            @endforeach
        </select>
    </div>



  <div class="form-group">
        <label class="bold">{{__("Working Experience")}}</label>
        <select class="form-control" name="r_working_experience" required="">
            <option value="">{{__("Select")}}</option>
            @for($i=0;$i<=47;$i++)
               <option @if(!empty($user)) {{ ($user->r_working_experience == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
 </div>



  <div class="form-group hide_english_speaker">
        <label class="bold">{{__("Did you study in native English speaking countries?")}}</label>
        <select class="form-control" name="r_native_english_speaking" id="r_native_english_speaking" >
            <option value="">{{__("Select")}}</option>
            <option @if(!empty($user)) {{ ($user->r_native_english_speaking == 'Yes') ? 'selected' : '' }} @endif value="Yes">{{__("Yes")}}</option>
            <option  @if(!empty($user)) {{ ($user->r_native_english_speaking == 'No') ? 'selected' : '' }} @endif value="No">{{__("No")}}</option>
        </select>
 </div>



  <div class="form-group">
        <label class="bold">{{__("Other requirements")}}</label>
        <input type="text" class="form-control" placeholder="Other requirements" value="{{ !empty($user->r_other_requirements)?$user->r_other_requirements:'' }}" name="r_other_requirements">
 </div>





    {{-- <div class="form-group">
            <label class="bold">{{__("What welfare do you want?")}}</label>
            <br />
            @foreach($getWelfare as $value_w)
                @php $checked = ''; @endphp
                @if(!empty($user))
                    @foreach($user->userwelfare as $welfare_id)
                        @if($welfare_id->welfare_id == $value_w->id)
                            @php $checked = 'checked'; @endphp
                        @endif
                    @endforeach
                @endif
                <label><input {{ $checked }} type="checkbox" value="{{ $value_w->id }}" name="welfare[]"> {{ $value_w->name }}</label>
            @endforeach
    </div>
 --}}

 <div class="col-md-6" style="padding-left: 0px;">
    <div class="form-group">
        <label class="bold" >{{__("What's the salary do you expect minimum monthly?")}}</label>
        <select class="form-control" name="r_salary_id" required>
                <option value="">{{__("Select Minimum Salary")}}</option>
                @foreach($getSalaryExpect as $value_s)
                    <option @if(!empty($user)) {{ ($user->r_salary_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                @endforeach
        </select>
    </div>
</div>

<div class="col-md-6" style="padding-left: 0px;">
    <div class="form-group">
        <label class="bold" >{{__("What's the salary do you expect maximum monthly?")}}</label>
        <select class="form-control" name="r_max_salary_id" required>
                <option value="">{{__("Select Maximum Salary")}}</option>
                @foreach($getSalaryExpect as $value_s)
                    <option @if(!empty($user)) {{ ($user->r_max_salary_id == $value_s->id) ? 'selected' : '' }} @endif value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                @endforeach
        </select>
    </div>
</div>

    <div class="form-group">
        <label class="bold" >{{__('Any type of Chinese visa are you holding now?')}}</label>
        <select class="form-control" name="chinese_visa_are_you_holding" >
                <option value="">{{__("Select")}}</option>
                @foreach($getTypeChineseVisa as $value_visa)
                    <option @if(!empty($user)) {{ ($user->chinese_visa_are_you_holding == $value_visa->id) ? 'selected' : '' }} @endif value="{{ $value_visa->id }}">{{ $value_visa->name }}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="bold">{{__('When will you be available to attend the online interview? (Please provide a general available time)')}}</label>
        {!! Form::text('online_interview', null, array('class'=>'form-control', 'id'=>'online_interview', 'placeholder'=>__('When will you be available to attend the online interview?'))) !!}
    </div>

    <div class="form-group">
        <hr />
    </div>


    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_active') !!}">
        {!! Form::label('is_active', 'Active', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_active_1 = 'checked="checked"';
            $is_active_2 = '';
            if (old('is_active', ((isset($user)) ? $user->is_active : 1)) == 0) {
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
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'verified') !!}">
        {!! Form::label('verified', 'Verified', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $verified_1 = 'checked="checked"';
            $verified_2 = '';
            if (old('verified', ((isset($user)) ? $user->verified : 1)) == 0) {
                $verified_1 = '';
                $verified_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="verified" name="verified" type="radio" value="1" {{$verified_1}}>
                Verified </label>
            <label class="radio-inline">
                <input id="not_verified" name="verified" type="radio" value="0" {{$verified_2}}>
                Not Verified </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'verified') !!}
    </div> 
    {!! Form::button('Update Personal Information <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}   
</div>
{!! Form::close() !!}
@push('css')
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
@endpush
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {


        $('#nationality_id').change(function(){
            var nationality_id = $('option:selected', this).attr('data-val');
            
            if(nationality_id == '1')
            {
                $('#r_english_speaker').val('Yes');
            }
            else
            {
                $('#r_english_speaker').val('No');
            }
        });


        $('.general_chine').change(function(){
            general_chine();
        });



        function general_chine() {

            var nationality_id        =  $('#nationality_id option:selected').attr('data-val');
            var english_speaker         =  $('#r_english_speaker').val();
            var r_highest_education_id  =  $('#r_highest_education_id').val(); 
            var r_graduated  =  $('#r_graduated').val(); 

            if(r_highest_education_id == 4)
            {
                $('#r_visa_id').val('2');
                $('#ChineseWorkingZVisa').hide();  
                $('#ChineseWorkingZVisaOther').show();    
            }
            else
            {            
                if(nationality_id == '1' && english_speaker == 'Yes' && (r_highest_education_id == 1 || r_highest_education_id == 2 || r_highest_education_id == 3)  )
                {
                    $('#ChineseWorkingZVisa').show();  
                    $('#ChineseWorkingZVisaOther').hide();
                    $('#r_visa_id').val('1');
                }
                else
                {
                    if(r_highest_education_id == 4 && nationality_id == 0 && english_speaker == 'No')
                    {
                        $('#r_visa_id').val('2');
                        $('#ChineseWorkingZVisa').hide();  
                        $('#ChineseWorkingZVisaOther').show();    
                    }
                    else
                    {
                        if(r_graduated == 'Yes')
                        {
                            $('#r_visa_id').val('1');
                            $('#ChineseWorkingZVisa').show();      
                            $('#ChineseWorkingZVisaOther').hide();
                        }
                        else if(r_graduated == 'No')
                        {
                            $('#r_visa_id').val('2');
                            $('#ChineseWorkingZVisa').hide();      
                            $('#ChineseWorkingZVisaOther').show();
                        }
                        else
                        {

                            $('#r_visa_id').val('');
                            $('#ChineseWorkingZVisa').hide();      
                            $('#ChineseWorkingZVisaOther').hide();   
                        }
                    }                    
                }   
            }
            education_english();
        }

        general_chine();


        function education_english() {
            var r_visa_id = $('#r_english_speaker').val();
            if(r_visa_id == 'Yes')
            {
                $('.hide_english_speaker').show();
                $("#r_subject_education").prop('required',true);
                $("#r_native_english_speaking").prop('required',true);
            }
            else
            {
                $('.hide_english_speaker').hide();
                $("#r_subject_education").val('');
                $("#r_subject_education").prop('required',false);
                $("#r_native_english_speaking").val('');
                $("#r_native_english_speaking").prop('required',false);
            }
        }



        // $('body').delegate('#state_id','change',function(){
        //     var state_id = $(this).val();
        //     StateCityCondition();
        // });


        // $('body').delegate('#city_id','change',function(){
        //     var city_id = $(this).val();
        //     StateCityCondition();
        // });

        // function StateCityCondition() 
        // {
        //     var city_id = $('#city_id').val();
        //     var state_id = $('#state_id').val();
        //     if(city_id != "" && state_id != "")
        //     {
        //         $('.r_teach_id_show').hide();
        //         $('.r_teach_id').val('');
        //     }
        //     else
        //     {
        //         $('.r_teach_id_show').show();
        //     }
        // }









        initdatepicker();
        $('#salary_currency').typeahead({
            source: function (query, process) {
                return $.get("{{ route('typeahead.currency_codes') }}", {query: query}, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });

        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterDefaultStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterDefaultCities(0);
        });
        filterDefaultStates(<?php echo old('state_id', (isset($user)) ? $user->state_id : 0); ?>);
    });
    function filterDefaultStates(state_id)
    {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.default.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterDefaultCities(<?php echo old('city_id', (isset($user)) ? $user->city_id : 0); ?>);
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
    function initdatepicker() {
        $(".datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-m-d'
        });
    }
</script>
@endpush