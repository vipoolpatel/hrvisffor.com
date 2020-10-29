<?php echo APFrmErrHelp::showErrorsNotice($errors); ?>

<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="form-body">        
    <?php echo Form::hidden('id', null); ?>

    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'company_id'); ?>" id="company_id_div">
        <?php echo Form::label('company_id', 'Company', ['class' => 'bold']); ?>                    
        <?php echo Form::select('company_id', ['' => 'Select Company']+$companies, null, array('class'=>'form-control', 'id'=>'company_id')); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'company_id'); ?>                                       
    </div>


  
     <div class="form-group"> 
        <label class="bold"><?php echo e(__("What's the tile of your position?")); ?></label>
        <select class="form-control" name="r_position_looking_id" required>
               <option value=""><?php echo e(__("Select")); ?></option>
                <?php $__currentLoopData = $getPositionLooking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_position_looking_id == $value_p->id) ? 'selected' : ''); ?> <?php endif; ?>
                value="<?php echo e($value_p->id); ?>"><?php echo e($value_p->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
     </div>


     <div class="form-group"> 
        <label class="bold"><?php echo e(__('What type of your school?')); ?></label>
        <select class="form-control" required="" name="r_school_id">
             <option value=""><?php echo e(__("Select")); ?></option>
              <?php $__currentLoopData = $getSchoolJoin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option <?php if(!empty($job)): ?> <?php echo e(($job->r_school_id == $value_s->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_s->id); ?>"><?php echo e($value_s->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
     </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("What's type of position will you provide?")); ?></label>
        <select class="form-control" required name="r_work_type_id">
               <option value=""><?php echo e(__("Select")); ?></option>
                <?php $__currentLoopData = $getWorkType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option <?php if(!empty($job)): ?> <?php echo e(($job->r_work_type_id == $value_w->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_w->id); ?>"><?php echo e($value_w->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


    <div class="form-group"> 
      <hr />
    </div>

    <div class="form-group"> 
        <label class="bold" style="color: red;line-height: normal;font-size: 16px;">
                <?php echo e(__("What's the location of your school?")); ?>

                <input type="hidden" value="44" name="country_id" id="country_id">
        </label>
    </div>

     <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'state_id'); ?>" id="state_id_div">
        <?php echo Form::label('state_id', 'State', ['class' => 'bold']); ?>                    
        <span id="default_state_dd">
            <?php echo Form::select('state_id', ['' => 'Select State'], null, array('class'=>'form-control', 'id'=>'state_id')); ?>

        </span>
        <?php echo APFrmErrHelp::showErrors($errors, 'state_id'); ?>                                       
    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'city_id'); ?>" id="city_id_div">
        <?php echo Form::label('city_id', 'City', ['class' => 'bold']); ?>                    
        <span id="default_city_dd">
            <?php echo Form::select('city_id', ['' => 'Select City'], null, array('class'=>'form-control', 'id'=>'city_id')); ?>

        </span>
        <?php echo APFrmErrHelp::showErrors($errors, 'city_id'); ?>                                       
    </div>



    <div class="form-group"> 
        <label class="bold"><?php echo e(__('Do you need this teacher is a Native English Speaker or not?')); ?> </label>
        <select class="form-control" name="r_english_speaker_id" required>
           <option value=""><?php echo e(__("Select")); ?></option>
           <option <?php if(!empty($job)): ?> <?php echo e(($job->r_english_speaker_id == 'Yes') ? 'selected' : ''); ?> <?php endif; ?> value="Yes"><?php echo e(__("Yes")); ?></option>
           <option <?php if(!empty($job)): ?> <?php echo e(($job->r_english_speaker_id == 'No') ? 'selected' : ''); ?> <?php endif; ?> value="No"><?php echo e(__("No")); ?></option>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__('What type of visa do you require for teachers?')); ?></label>
        <select class="form-control" name="r_visa_id" required>
            <option value=""><?php echo e(__("Select")); ?></option>
            <?php $__currentLoopData = $getVisa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option <?php if(!empty($job)): ?> <?php echo e(($job->r_visa_id == $value->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("What's the general location of your school?")); ?></label>
        <select class="form-control" name="r_teach_id" required>
               <option value=""><?php echo e(__("Select")); ?></option>
                <?php $__currentLoopData = $getTeach; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if(!empty($job)): ?> <?php echo e(($job->r_teach_id == $value_t->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_t->id); ?>"><?php echo e($value_t->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group"> 
         <label class="bold"><?php echo e(__("When you need new teachers join the new work?")); ?></label>
        <select class="form-control" name="r_position_id" required>
            <option value=""><?php echo e(__("Select")); ?></option>
            <?php $__currentLoopData = $getPosition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_position_id == $value_p->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_p->id); ?>"><?php echo e($value_p->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

  <div class="col-md-6" style="padding-left: 0px;"> 
    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Salary Minimum Provided")); ?></label>
        <select class="form-control" name="r_salary_id" required="">
              <option value=""><?php echo e(__("Select")); ?></option>
              <?php $__currentLoopData = $getSalaryExpect; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_salary_id == $value_s->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_s->id); ?>"><?php echo e($value_s->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
  </div>

  <div class="col-md-6" > 
     <div class="form-group"> 
        <label class="bold"><?php echo e(__("Salary Maximum Provided")); ?></label>
        <select class="form-control" name="r_max_salary_id" required="">
              <option value=""><?php echo e(__("Select")); ?></option>
              <?php $__currentLoopData = $getSalaryExpect; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_max_salary_id == $value_s->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_s->id); ?>"><?php echo e($value_s->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
  </div>


    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Working hours per week")); ?></label>
        <select class="form-control" name="r_hour_id" required>
              <option value=""><?php echo e(__("Select")); ?></option>
              <?php for($i=1; $i<=50; $i++): ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_hour_id == $i) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
              <?php endfor; ?>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Working Schedule")); ?></label>
        <select class="form-control" name="r_working_schedule_id" required>
            <option value=""><?php echo e(__("Select")); ?></option>
            <?php $__currentLoopData = $getWorkingSchedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_working_schedule_id == $value->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Class size for teacher")); ?></label>
        <select class="form-control" name="r_class_size_id" required>
              <option value=""><?php echo e(__("Select")); ?></option>
              <?php for($i=1; $i<=50; $i++): ?>
                <option  <?php if(!empty($job)): ?> <?php echo e(($job->r_class_size_id == $i) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
              <?php endfor; ?>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Minimum Age requirement")); ?></label>
        <select class="form-control" name="r_min_age_requirement_id" required>
              <option value=""><?php echo e(__("Select")); ?></option>
              <?php for($i=18; $i<=65; $i++): ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_min_age_requirement_id == $i) ? 'selected' : ''); ?> <?php endif; ?>  value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(__("ysr")); ?></option>
              <?php endfor; ?>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Maximum Age requirement")); ?></label>
        <select class="form-control" name="r_max_age_requirement_id" required>
              <option value=""><?php echo e(__("Select")); ?></option>
              <?php for($i=18; $i<=65; $i++): ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_max_age_requirement_id == $i) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(__("ysr")); ?></option>
              <?php endfor; ?>
        </select>
    </div>

    <div class="form-group"> 
        <hr />
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("City Line")); ?></label>
        <select class="form-control" name="r_city_line_id" required>
              <option value=""><?php echo e(__("Select")); ?></option>
              <?php $__currentLoopData = $getCityLine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_city_line_id == $value_c->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_c->id); ?>"><?php echo e($value_c->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

      <div class="form-group"> 
        <label class="bold"><?php echo e(__("VISA Qualification")); ?></label>
        <select class="form-control" name="r_visa_qualification_id" required>
              <option value=""><?php echo e(__("Select")); ?></option>
              <option <?php if(!empty($job)): ?> <?php echo e(($job->r_visa_qualification_id == 'T') ? 'selected' : ''); ?> <?php endif; ?> value="T"><?php echo e(__("T")); ?></option>
              <option <?php if(!empty($job)): ?> <?php echo e(($job->r_visa_qualification_id == 'O') ? 'selected' : ''); ?> <?php endif; ?> value="O"><?php echo e(__("O")); ?></option>
        </select>
    </div>


    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Colour")); ?></label>
        <select class="form-control" name="r_colour_id" required>
              <option value=""><?php echo e(__("Select")); ?></option>
              <option <?php if(!empty($job)): ?> <?php echo e(($job->r_colour_id == 'W') ? 'selected' : ''); ?> <?php endif; ?> value="W"><?php echo e(__("W")); ?></option>
              <option <?php if(!empty($job)): ?> <?php echo e(($job->r_colour_id == 'N') ? 'selected' : ''); ?> <?php endif; ?> value="N"><?php echo e(__("N")); ?></option>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Current location")); ?></label>
        <select class="form-control" name="r_current_location_id" required>
              <option value=""><?php echo e(__("Select")); ?></option>
              <option <?php if(!empty($job)): ?> <?php echo e(($job->r_current_location_id == 'G') ? 'selected' : ''); ?> <?php endif; ?> value="G"><?php echo e(__("G")); ?></option>
              <option <?php if(!empty($job)): ?> <?php echo e(($job->r_current_location_id == 'C') ? 'selected' : ''); ?> <?php endif; ?> value="C"><?php echo e(__("C")); ?></option>
        </select>
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Emerency level")); ?></label>
        <select class="form-control" name="r_emerency_level_id" required>
              <option value=""><?php echo e(__("Select")); ?></option>
              <?php $__currentLoopData = $getEmerencyLevel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_el): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($job)): ?> <?php echo e(($job->r_emerency_level_id == $value_el->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_el->id); ?>"><?php echo e($value_el->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="form-group"> 
        <hr />
    </div>



    


    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Welfare Provided (Multiple Selections)")); ?></label>
        <br>
       <?php $__currentLoopData = $getWelfare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $checked = ''; ?>
            <?php if(!empty($job)  && !empty(count($job->jobwelfare))): ?>
            <?php $__currentLoopData = $job->jobwelfare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $welfare_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($welfare_id->welfare_id == $value_w->id): ?>
                    <?php $checked = 'checked'; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <label><input <?php echo e($checked); ?> type="checkbox" value="<?php echo e($value_w->id); ?>" name="welfare[]"> <?php echo e($value_w->name); ?></label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Photo of your school environment (Maximum 6 photos)")); ?></label>
        <input type="file" name="school_environment[]" accept="image/*" multiple class="form-control">
    </div>

      <?php if(!empty($job) && !empty(count($job->jobschoolenvironment))): ?>
      <div style="clear: both;"></div>
       <div class="form-group"> 
         <?php $__currentLoopData = $job->jobschoolenvironment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school_environment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <div class="col-md-2" style="padding-left: 0px; "> 
            <img alt="" style="height: 120px; width: 100%;" src="<?php echo e(url('public/company/'.$school_environment->image_name)); ?>">
            <a href="<?php echo e(url('delete-front-job-school-environment/'.$school_environment->job_id.'/'.$school_environment->id.'')); ?>" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger"><?php echo e(__("Delete")); ?></a>
          </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </div>
       <div style="clear: both;"></div>
      <div class="form-group"> 
        <hr />
      </div>
      <?php endif; ?>


      <div style="clear: both;"></div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Photo of teacher's accommodation (Maximum 6 photos)")); ?></label>
        <input type="file" name="teachers_accommodation[]" accept="image/*" multiple class="form-control">
    </div>


      <?php if(!empty($job) && !empty(count($job->jobteachersaccommodation))): ?>
      <div style="clear: both;"></div>
       <div class="form-group"> 
         <?php $__currentLoopData = $job->jobteachersaccommodation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teachers_accommodation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <div class="col-md-2" style="padding-left: 0px; "> 
            <img alt="" style="height: 120px; width: 100%;" src="<?php echo e(url('public/company/'.$teachers_accommodation->image_name)); ?>">
            <a href="<?php echo e(url('delete-front-job-teachers-accommodation/'.$teachers_accommodation->job_id.'/'.$teachers_accommodation->id.'')); ?>" style="background: #dc3545;padding: 6px;margin-top: 5px;margin-bottom: 5px;text-transform: capitalize;font-weight: normal;" class="btn btn-danger"><?php echo e(__("Delete")); ?></a>
          </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </div>
       <div style="clear: both;"></div>
      <div class="form-group"> 
        <hr />
      </div>
      <?php endif; ?>


    <div style="clear: both;"></div>


    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Contact name")); ?></label>
        <input type="text" value="<?php if(!empty($job)): ?> <?php echo e($job->r_contact_name); ?> <?php endif; ?>" name="r_contact_name" required placeholder="<?php echo e(__("Contact name")); ?>" class="form-control">
    </div>


    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Wechat ID")); ?></label>
        <input type="text" name="r_wechat_id" value="<?php if(!empty($job)): ?> <?php echo e($job->r_wechat_id); ?> <?php endif; ?>"  placeholder="<?php echo e(__("Wechat ID")); ?>" class="form-control"> 
    </div>


    <div class="form-group"> 
        <label class="bold"><?php echo e(__("School name")); ?></label>
        <input type="text" name="r_school_name" value="<?php if(!empty($job)): ?> <?php echo e($job->r_school_name); ?> <?php endif; ?>" required placeholder="<?php echo e(__("School name")); ?>" class="form-control">
    </div>

    <div class="form-group"> 
        <label class="bold"><?php echo e(__("Job Expiry Date")); ?></label>
        <input type="text" name="expiry_date" value="<?php if(!empty($job)): ?> <?php echo e(date('Y-m-d',strtotime($job->expiry_date))); ?> <?php endif; ?>" required placeholder="<?php echo e(__("Expiry Date")); ?>" class="form-control datepicker">
    </div>



    <div class="form-group"> 
        <hr />
    </div>


    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'is_active'); ?>">
        <?php echo Form::label('is_active', 'Is Active?', ['class' => 'bold']); ?>

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
                <input id="active" name="is_active" type="radio" value="1" <?php echo e($is_active_1); ?>>
                Active </label>
            <label class="radio-inline">
                <input id="not_active" name="is_active" type="radio" value="0" <?php echo e($is_active_2); ?>>
                In-Active </label>
        </div>
        <?php echo APFrmErrHelp::showErrors($errors, 'is_active'); ?>

    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'is_featured'); ?>">
        <?php echo Form::label('is_featured', 'Is Featured?', ['class' => 'bold']); ?>

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
                <input id="featured" name="is_featured" type="radio" value="1" <?php echo e($is_featured_1); ?>>
                Featured </label>
            <label class="radio-inline">
                <input id="not_featured" name="is_featured" type="radio" value="0" <?php echo e($is_featured_2); ?>>
                Not Featured </label>
        </div>
        <?php echo APFrmErrHelp::showErrors($errors, 'is_featured'); ?> </div>	
    <div class="form-actions">
        <?php echo Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')); ?>

    </div>
</div>
<?php $__env->startPush('css'); ?>
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<?php echo $__env->make('admin.shared.tinyMCEFront', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
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
            $.post("<?php echo e(route('filter.default.states.dropdown')); ?>", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '<?php echo e(csrf_token()); ?>'})
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
            $.post("<?php echo e(route('filter.default.cities.dropdown')); ?>", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '<?php echo e(csrf_token()); ?>'})
                    .done(function (response) {
                        $('#default_city_dd').html(response);
                    });
        }
    }
</script>
<?php $__env->stopPush(); ?>