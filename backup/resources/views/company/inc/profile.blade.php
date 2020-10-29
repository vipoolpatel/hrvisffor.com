
{!! Form::model($company, array('method' => 'put', 'route' => array('update.company.profile'), 'class' => 'form', 'files'=>true)) !!}
<h5>{{__('Acount Information')}}</h5>
<div class="row">
<div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'email') !!}">
			<label>{{__('Email')}}</label>
			{!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>__('Company Email'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'email') !!} </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'password') !!}">
			<label>{{__('Password')}}</label>
			{!! Form::password('password', array('class'=>'form-control', 'id'=>'password', 'placeholder'=>__('Password'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'password') !!} </div>
    </div>
</div>
<hr>


<h5>{{__('Company Information')}}</h5>
<div class="row">
    <div class="col-md-6">
        <div class="formrow">
			<label>{{__('Company Logo')}}</label>
			{{ ImgUploader::print_image("company_logos/$company->logo", 100, 100) }} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow">
            <div id="thumbnail"></div>
            <label class="btn btn-default"> {{__('Select Company Logo')}}
                <input type="file" name="logo" id="logo" style="display: none;">
            </label>
            {!! APFrmErrHelp::showErrors($errors, 'logo') !!} </div>
    </div>
</div>
<div class="row">

     <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'name') !!}">
            <label>{{__('School ID')}} : {{ $company->school_id }}</label>
        </div>
    </div>
     <div class="col-md-12">
        <hr />
     </div>
    <div class="clearfix"></div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'name') !!}">
			<label>{{__('Company Name')}}</label>
			{!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>__('Company Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'name') !!} 
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'ceo') !!}">
			<label>{{__('Contact Name')}}</label>
			{!! Form::text('ceo', null, array('class'=>'form-control', 'id'=>'ceo', 'placeholder'=>__('Contact Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'ceo') !!} 
        </div>
    </div>

     <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'wechat_id') !!}">
            <label>{{__('Wechat ID')}}</label>
            <input type="text" name="wechat_id" value="{{ $company->wechat_id }}" placeholder="Wechat ID" class="form-control">
        </div>
    </div>
   
    <div class="clearfix"></div>
   
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'location') !!}">
			<label>{{__('Address')}}</label>

            <select class="form-control" required name="r_teach_id">
                <option value="">{{__('Select')}}</option>
                @foreach($getTeach as $value)
                    <option {{ ($company->r_teach_id == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>

        </div>
    </div>
 
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'phone') !!}">
        <label>{{__('Contact Phone Number')}}</label>
        {!! Form::text('phone', null, array('class'=>'form-control', 'id'=>'phone', 'placeholder'=>__('Contact Phone Number'))) !!}
        {!! APFrmErrHelp::showErrors($errors, 'phone') !!} </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-6">
        <input type="hidden" name="country_id" id="country_id" value="44">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'state_id') !!}">
			<label>{{__('State')}}</label>
			<span id="default_state_dd"> {!! Form::select('state_id', ['' => __('Select State')], null, array('class'=>'form-control', 'id'=>'state_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'state_id') !!} 
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'city_id') !!}">
			<label>{{__('City')}}</label>
			<span id="default_city_dd"> {!! Form::select('city_id', ['' => __('Select City')], null, array('class'=>'form-control', 'id'=>'city_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'city_id') !!} 
        </div>
    </div>

    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'is_subscribed') !!}">
            <?php
            	$is_checked = 'checked="checked"';	
            	if (old('is_subscribed', ((isset($company)) ? $company->is_subscribed : 1)) == 0) {
            		$is_checked = '';
            	}
    	    ?>
            <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} />
            {{__('Subscribe to news letter')}}
            {!! APFrmErrHelp::showErrors($errors, 'is_subscribed') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="formrow">
            <button type="submit" class="btn">{{__('Update Profile and Save')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
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
        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterLangStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterLangCities(0);
        });
        filterLangStates(<?php echo old('state_id', (isset($company)) ? $company->state_id : 0); ?>);

        /*******************************/
        var fileInput = document.getElementById("logo");
        fileInput.addEventListener("change", function (e) {
            var files = this.files
            showThumbnail(files)
        }, false)
    });

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


    function filterLangStates(state_id)
    {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.lang.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterLangCities(<?php echo old('city_id', (isset($company)) ? $company->city_id : 0); ?>);
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