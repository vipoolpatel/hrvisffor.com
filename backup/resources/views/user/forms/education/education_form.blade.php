<div class="modal-body">
    <div class="form-body">

        <div class="formrow">
            <label>{{ __('Start Date') }}</label>
            <input type="date" name="r_start_date" value="<?=!empty($profileEducation->r_start_date) ? $profileEducation->r_start_date : ''?>" required class="form-control">
        </div>

        <div class="formrow">
            <label>{{ __('End Date') }}</label>
            <input type="date" name="r_end_date" value="<?=!empty($profileEducation->r_end_date) ? $profileEducation->r_end_date : ''?>" required class="form-control">
        </div>

        <div class="formrow">
           <label>{{ __('School Name') }}</label>
            <input type="text" name="r_school_name" value="<?=!empty($profileEducation->r_school_name) ? $profileEducation->r_school_name : ''?>" required class="form-control">
        </div>

        <div class="formrow" id="div_country_id">
            <?php
            $country_id = (isset($profileEducation) ? $profileEducation->country_id : $siteSetting->default_country_id);
            ?>
            {!! Form::select('country_id', [''=>__('Select Country')]+$countries, $country_id, array('class'=>'form-control', 'id'=>'education_country_id')) !!}
            <span class="help-block country_id-error"></span> 
        </div>

        <div class="formrow">
           <label>{{ __('Major') }}</label>
            <input type="text" name="r_major" value="<?=!empty($profileEducation->r_major) ? $profileEducation->r_major : ''?>" required class="form-control">
        </div>


        <div class="formrow">
           <label>{{ __('Degree') }}</label>
            <input type="text" name="r_degree" value="<?=!empty($profileEducation->r_degree) ? $profileEducation->r_degree : ''?>" required class="form-control">
        </div>

    </div>
</div>