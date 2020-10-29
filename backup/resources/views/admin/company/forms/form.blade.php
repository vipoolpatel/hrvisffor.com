{!! APFrmErrHelp::showOnlyErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'logo') !!}">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="{{ asset('/') }}admin_assets/no-image.png" alt="" /> </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                    <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select Company logo </span> <span class="fileinput-exists"> Change </span> {!! Form::file('logo', null, array('id'=>'logo')) !!} </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                </div>
                {!! APFrmErrHelp::showErrors($errors, 'logo') !!} </div>
        </div>
        @if(isset($company))
        <div class="col-md-6">
            {{ ImgUploader::print_image("company_logos/$company->logo") }}        
        </div>    
        @endif  
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'name') !!}"> {!! Form::label('name', 'Company Name', ['class' => 'bold']) !!}
        {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>'Company Name')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'name') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}"> {!! Form::label('email', 'Username', ['class' => 'bold']) !!}
        {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>'Username')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'email') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'password') !!}"> {!! Form::label('password', 'Password', ['class' => 'bold']) !!}
        {!! Form::password('password', array('class'=>'form-control', 'id'=>'password', 'placeholder'=>'Password')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'password') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'ceo') !!}"> {!! Form::label('ceo', 'Contact Name', ['class' => 'bold']) !!}
        {!! Form::text('ceo', null, array('class'=>'form-control', 'id'=>'ceo', 'placeholder'=>'Contact Name')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'ceo') !!} </div>

    <div class="form-group">
        <label class="bold">{{__('Wechat ID')}}</label>
        <input type="text" name="wechat_id" placeholder="Wechat ID" value="{{ !empty($company->wechat_id) ? $company->wechat_id : '' }}" class="form-control">
    </div>



        <div class="form-group">
            <label class="bold">{{__('Address')}}</label>
            <select class="form-control" required name="r_teach_id">
                <option value="">{{__('Select')}}</option>
                @foreach($getTeach as $value)
                    <option @if(!empty($company->r_teach_id)) {{ ($company->r_teach_id == $value->id) ? 'selected' : '' }}  @endif value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'phone') !!}"> {!! Form::label('phone', 'Contact Phone Number', ['class' => 'bold']) !!}
            {!! Form::text('phone', null, array('class'=>'form-control', 'id'=>'phone', 'placeholder'=>'Contact Phone Number')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'phone') !!} 
        </div>


    <input type="hidden" name="country_id" id="country_id" value="44">

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'state_id') !!}"> {!! Form::label('state_id', 'State', ['class' => 'bold']) !!}
        <span id="default_state_dd">                    
            {!! Form::select('state_id', ['' => 'Select State'], null, array('class'=>'form-control', 'id'=>'state_id')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'state_id') !!} </div>


    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'city_id') !!}"> {!! Form::label('city_id', 'City', ['class' => 'bold']) !!}  
        <span id="default_city_dd">                  
            {!! Form::select('city_id', ['' => 'Select City'], null, array('class'=>'form-control', 'id'=>'city_id')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'city_id') !!} </div>




<div class="form-group">
    <hr />
</div>



    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_active') !!}">
        {!! Form::label('is_active', 'Is Active?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_active_1 = 'checked="checked"';
            $is_active_2 = '';
            if (old('is_active', ((isset($company)) ? $company->is_active : 1)) == 0) {
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
            if (old('is_featured', ((isset($company)) ? $company->is_featured : 0)) == 1) {
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
        {!! APFrmErrHelp::showErrors($errors, 'is_featured') !!} 
    </div>

    <div class="form-actions"> {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!} </div>
</div>
@push('scripts')
@include('admin.shared.tinyMCEFront') 
<script type="text/javascript">
    $(document).ready(function () {
        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterDefaultStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterDefaultCities(0);
        });
        filterDefaultStates(<?php echo old('state_id', (isset($company)) ? $company->state_id : 0); ?>);
    });
    function filterDefaultStates(state_id)
    {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.default.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterDefaultCities(<?php echo old('city_id', (isset($company)) ? $company->city_id : 0); ?>);
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