<style type="text/css">
    .form-checkbox-margin {
        margin-left: 10px;
    }
    .field-hide {
        display: none;
    }
</style>


{!! Form::model($user, array('method' => 'put', 'route' => array('my.profile'), 'class' => 'form', 'files'=>true)) !!}

<h5>{{__('Account Information')}}</h5>
<div class="row">
<div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'email') !!}">
			<label for="">{{__('Email')}}</label>
			{!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>__('Email'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'email') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'password') !!}">
			<label for="">{{__('Password')}}</label>
			{!! Form::password('password', array('class'=>'form-control', 'id'=>'password', 'placeholder'=>__('Password'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'password') !!} </div>
    </div>
</div>

<hr>

<h5>{{__('Personal Information')}}</h5>

<div class="row">
    <div class="col-md-6">
        <div class="formrow">
			<label>{{__('Profile Image')}}</label>
			{{ ImgUploader::print_image("user_images/$user->image", 100, 100) }} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow">
            <div id="thumbnail"></div>
            <label class="btn btn-default"> {{__('Select Profile Image')}}
                <input type="file" name="image" id="image" style="display: none;">
            </label>
            {!! APFrmErrHelp::showErrors($errors, 'image') !!} </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="formrow">
            <label>{{__('Self-intro video (including your name+age+nationality on passport+your highest degree+major+how many years working experience+why you want to work in China?)')}}</label>
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
    </div>
    <div class="col-md-6">
        <div class="formrow">
            <label class="btn btn-default"> {{__('Select Self-intro Video')}}
                <input type="file" name="self_intro" id="self_intro" style="display: none;">
            </label>
            {!! APFrmErrHelp::showErrors($errors, 'self_intro') !!} </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <hr />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'first_name') !!}">
			<label for="">{{__('First Name')}}</label>
			{!! Form::text('first_name', null, array('class'=>'form-control', 'id'=>'first_name', 'placeholder'=>__('First Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'first_name') !!} </div>
    </div>
  
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'last_name') !!}">
			<label for="">{{__('Last Name')}}</label>
			{!! Form::text('last_name', null, array('class'=>'form-control', 'id'=>'last_name', 'placeholder'=>__('Last Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'last_name') !!}</div>
    </div>


    <div class="col-md-6">
        <div class="formrow">
            <label for="">{{__("What's your current locatioin?")}}</label>
            <select class="form-control" name="r_current_locatioin_id" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getCurrentLocatioin as $value_l)
                    <option {{ ($user->r_current_locatioin_id == $value_l->id) ? 'selected' : '' }} value="{{ $value_l->id }}">{{ $value_l->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="">{{__("What's your nationality?")}}</label>
            <select class="form-control general_chine" required id="nationality_id" name="nationality_id">
                <option value="">{{__("Select your nationality?")}}</option>
                @foreach($nationalities as $value_c)
                    <option {{ ($user->nationality_id == $value_c->country_id) ? 'selected' : '' }} data-val="{{ $value_c->is_native }}" value="{{ $value_c->country_id }}">{{ $value_c->nationality }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-md-6">
        <div class="formrow">
            <label for="">{{__("Native English Speaker or not?")}}</label>
            <input class="form-control" type="text" readonly value="<?=!empty($user->r_english_speaker_id) ? $user->r_english_speaker_id : 'No'?>" name="r_english_speaker_id" id="r_english_speaker">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="">{{__("What your highest education level?")}}</label>
            <select class="form-control general_chine" name="r_highest_education_id" id="r_highest_education_id" required>
                <option value="">{{__("Select your highest education level?")}}</option>
                @foreach($getHighestEducation as $value_h)
                    <option {{ ($user->r_highest_education_id == $value_h->id) ? 'selected' : '' }} value="{{ $value_h->id }}">{{ $value_h->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12" style="text-align: center;display: none;" id="ChineseWorkingZVisa">
        <div class="formrow">
            {{-- <label style="color: blue;">{{__("You can apply Chinese Working Z Visa")}}</label> --}}
            <input type="hidden" name="r_visa_id" id="r_visa_id">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="">{{__("Have you graduated two years or more?")}}</label>
            <select class="form-control general_chine" name="r_graduated_id" id="r_graduated" required>
                <option value="">{{__("Select graduated two years or more?")}}</option>
                <option {{ ($user->r_graduated_id == 'Yes') ? 'selected' : '' }} value="Yes">{{__("Yes")}}</option>
                <option {{ ($user->r_graduated_id == 'No') ? 'selected' : '' }} value="No">{{__("No")}}</option>
            </select>        
        </div>
    </div>

   <div class="col-md-12" style="text-align: center;display: none;" id="ChineseWorkingZVisaOther">
        <div class="formrow">
            {{-- <label style="color: blue">{{__("You can apply the other types of Chinese Visa")}}</label> --}}
        </div>
    </div>

     <div class="col-md-12">
        <div class="formrow">
            <label for="">{{__("What type of school you want to join?")}}</label>
            <br />
            @foreach($getSchoolJoin as $value_s)
                    @php $checked = ''; @endphp
                    @foreach($user->userschooljoin as $school_join_id)
                        @if($school_join_id->school_join_id == $value_s->id)
                            @php $checked = 'checked'; @endphp
                        @endif
                    @endforeach
                   <label><input {{ $checked }} type="checkbox" value="{{ $value_s->id }}" name="school_join[]"> {{ $value_s->name }}</label>
            @endforeach
        </div>
    </div>

<div class="col-md-6">
   <div class="formrow">
      <label>{{__("Age")}}</label>
      <select class="form-control" name="r_age_id" required="">
         <option value="">{{__("Select")}}</option>
        @for($i=18;$i<=65;$i++)
         <option {{ ($user->r_age_id == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} ysr</option>
        @endfor
      </select>
   </div>
</div>



<div class="col-md-6 hide_english_speaker">
    <div class="formrow"> 
        <label>{{__("Is Your Subject related to education or English?")}}</label>
        <select class="form-control" name="r_subject_education" id="r_subject_education">
            <option value="">{{__("Select")}}</option>
            <option {{ ($user->r_subject_education == 'Yes') ? 'selected' : '' }} value="Yes">{{__("Yes")}}</option>
            <option {{ ($user->r_subject_education == 'No') ? 'selected' : '' }} value="No">{{__("No")}}</option>        
        </select>
     </div>
</div>

 
    <div class="col-md-12"><hr /></div>
 
    <div class="col-md-12" style="text-align: center;" >
        <div class="formrow">
            <label style="color: red;line-height: normal;font-size: 16px;">{{__("If you are not clear which city do you want to work, you can just choose a general location below and do not select State and City.")}}</label>

            <input type="hidden" name="country_id" value="44" id="country_id">
        </div>
    </div>


     <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'state_id') !!}">
            <label for="">{{__('State')}}</label>
            <span id="state_dd"> {!! Form::select('state_id', [''=>__('Select State')], null, array('class'=>'form-control', 'id'=>'state_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'state_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'city_id') !!}">
            <label for="">{{__('City')}}</label>
            <span id="city_dd"> {!! Form::select('city_id', [''=>__('Select City')], null, array('class'=>'form-control', 'id'=>'city_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'city_id') !!} </div>
    </div>

@php
$display_none = '';
if(!empty($user->city_id) && !empty($user->state_id)) {
    $display_none = 'display : none;';
}    
@endphp


    <div class="col-md-6 r_teach_id_show" style="{{ $display_none  }}">
        <div class="formrow">
            <label for="">{{__("Where do you want to teach?")}}</label>
            <select class="form-control" name="r_teach_id" id="r_teach_id" >
                <option value="">{{__("Select")}}</option>
                @foreach($getTeach as $value_t)
                    <option {{ ($user->r_teach_id == $value_t->id) ? 'selected' : '' }} value="{{ $value_t->id }}">{{ $value_t->name }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-md-12"><hr /></div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="" >{{__("What position are you looking for?")}}</label>
            <select class="form-control" name="r_position_looking_id" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getPositionLooking as $value_p)
                    <option {{ ($user->r_position_looking_id == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'last_name') !!}">
            <label for="">{{__("What's type of work do you want?")}}</label>
            <select class="form-control" name="r_work_type_id" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getWorkType as $value_w)
                    <option {{ ($user->r_work_type_id == $value_w->id) ? 'selected' : '' }} value="{{ $value_w->id }}">{{ $value_w->name }}</option>
                @endforeach
            </select>
        </div>
    </div>




    <div class="col-md-12">
        <div class="formrow">
            <label for="" style="line-height: normal;">{{__("When you can join this new position if you got a satisfied offer?")}}</label>
            <select class="form-control" name="r_position_id" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getPosition as $value_p)
                    <option {{ ($user->r_position_id == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

<div class="col-md-6">
    <div class="formrow"> 
        <label>{{__("Working Experience")}}</label>
        <select class="form-control" name="r_working_experience" required="">
            <option value="">{{__("Select")}}</option>
            @for($i=0;$i<=47;$i++)
               <option {{ ($user->r_working_experience == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
     </div>
</div>



<div class="col-md-6 hide_english_speaker">
    <div class="formrow"> 
        <label>{{__("Did you study in native English speaking countries?")}}</label>
        <select class="form-control" name="r_native_english_speaking" id="r_native_english_speaking">
            <option value="">{{__("Select")}}</option>
            <option {{ ($user->r_native_english_speaking == 'Yes') ? 'selected' : '' }} value="Yes">{{__("Yes")}}</option>
            <option {{ ($user->r_native_english_speaking == 'No') ? 'selected' : '' }} value="No">{{__("No")}}</option>
        </select>
     </div>
</div>


<div class="col-md-12">
    <div class="formrow"> 
        <label>{{__("Other requirements")}}</label>
        <input type="text" class="form-control" placeholder="Other requirements" value="{{ $user->r_other_requirements }}" name="r_other_requirements">
     </div>
</div>





   {{--   <div class="col-md-12">
        <div class="formrow">
            <label for="">{{__("What welfare do you want?")}}</label>
            <br />
            @foreach($getWelfare as $value_w)
                @php $checked = ''; @endphp
                @foreach($user->userwelfare as $welfare_id)
                    @if($welfare_id->welfare_id == $value_w->id)
                        @php $checked = 'checked'; @endphp
                    @endif
                @endforeach
                <label><input {{ $checked }} type="checkbox" value="{{ $value_w->id }}" name="welfare[]"> {{ $value_w->name }}</label>
            @endforeach
        </div>
    </div>
 --}}

    <div class="col-md-6">
        <div class="formrow">
            <label for="">{{__("What's the salary do you expect minimum monthly?")}}</label>
            <select class="form-control" name="r_salary_id" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getSalaryExpect as $value_s)
                    <option {{ ($user->r_salary_id == $value_s->id) ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

   <div class="col-md-6">
        <div class="formrow">
            <label for="">{{__("What's the salary do you expect maximum monthly?")}}</label>
            <select class="form-control" name="r_max_salary_id" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getSalaryExpect as $value_s)
                    <option {{ ($user->r_max_salary_id == $value_s->id) ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                @endforeach
            </select>
        </div>
    </div>


   

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'chinese_visa_are_you_holding') !!}">
            <label for="">{{__('Any type of Chinese visa are you holding now?')}}</label>
            <select class="form-control" name="chinese_visa_are_you_holding" required>
                <option value="">{{__("Select")}}</option>
                @foreach($getTypeChineseVisa as $value_visa)
                    <option {{ ($user->chinese_visa_are_you_holding == $value_visa->id) ? 'selected' : '' }} value="{{ $value_visa->id }}">{{ $value_visa->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'online_interview') !!}">
            <label for="">{{__('When will you be available to attend the online interview? (Please provide a general available time)')}}</label>
            {!! Form::text('online_interview', null, array('class'=>'form-control', 'id'=>'online_interview', 'placeholder'=>__('When will you be available to attend the online interview?'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'online_interview') !!} 
        </div>
    </div>

</div>
	
	<div class="row">
	
    <div class="col-md-12">
    <div class="formrow {!! APFrmErrHelp::hasError($errors, 'is_subscribed') !!}">
    <?php
	$is_checked = 'checked="checked"';	
	if (old('is_subscribed', ((isset($user)) ? $user->is_subscribed : 1)) == 0) {
		$is_checked = '';
	}
	?>
      <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} />
      {{__('Subscribe to news letter')}}
      {!! APFrmErrHelp::showErrors($errors, 'is_subscribed') !!}
      </div>
  </div>
    <div class="col-md-12">
        <div class="formrow"><button type="submit" class="btn">{{__('Update Profile and Save')}}  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></div>
    </div>
</div>


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
                    if(nationality_id == '1' && english_speaker == 'Yes' && (r_highest_education_id == 1 || r_highest_education_id == 2 || r_highest_education_id == 3))
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


        $('body').delegate('#state_id','change',function(){
            var state_id = $(this).val();
            StateCityCondition();
        });


        $('body').delegate('#city_id','change',function(){
            var city_id = $(this).val();
            StateCityCondition();
        });

        function StateCityCondition() 
        {
            var city_id = $('#city_id').val();
            var state_id = $('#state_id').val();
            if(city_id != "" && state_id != "")
            {
                $('.r_teach_id_show').hide();
                $('.r_teach_id').val('');
            }
            else
            {
                $('.r_teach_id_show').show();
            }
        }


      
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
            filterStates(0);
        });



        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterCities(0);
        });

        filterStates(<?php echo old('state_id', $user->state_id); ?>);

        /*******************************/
        var fileInput = document.getElementById("image");
        fileInput.addEventListener("change", function (e) {
            var files = this.files
            showThumbnail(files)
        }, false)
        function showThumbnail(files) {
            $('#thumbnail').html('');
            for (var i = 0; i < files.length; i++) {
                var file = files[i]
                var imageType = /image.*/
                if (!file.type.match(imageType)) {
                    console.log("Not an Image");
                    continue;
                }
                var reader = new FileReader()
                reader.onload = (function (theFile) {
                    return function (e) {
                        $('#thumbnail').append('<div class="fileattached"><img height="100px" src="' + e.target.result + '" > <div>' + theFile.name + '</div><div class="clearfix"></div></div>');
                    };
                }(file))
                var ret = reader.readAsDataURL(file);
            }
        }
    });

    function filterStates(state_id)
    {
        var country_id = 44;
        if (country_id != '') {
            $.post("{{ route('filter.lang.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#state_dd').html(response);
                        filterCities(<?php echo old('city_id', $user->city_id); ?>);
                    });
        }
    }
    function filterCities(city_id)
    {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.lang.cities.dropdown') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#city_dd').html(response);
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