<?php echo APFrmErrHelp::showErrorsNotice($errors); ?>

<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(isset($user)): ?>
<?php echo Form::model($user, array('method' => 'put', 'route' => array('update.user', $user->id), 'class' => 'form', 'files'=>true)); ?>

<?php echo Form::hidden('id', $user->id); ?>

<?php else: ?>
<?php echo Form::open(array('method' => 'post', 'route' => 'store.user', 'class' => 'form', 'files'=>true)); ?>

<?php endif; ?>
<div class="form-body">    
    <input type="hidden" name="front_or_admin" value="admin" />
    <div class="row">
        <div class="col-md-12">
            <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'image'); ?>">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <?php if(!empty($user->image)): ?>
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <?php echo e(ImgUploader::print_image("user_images/$user->image")); ?>  
                        </div>
                    <?php else: ?>
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo e(asset('/')); ?>admin_assets/no-image.png" alt="" /></div>
                    <?php endif; ?>


                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                    <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select Profile Image </span> <span class="fileinput-exists"> Change </span> <?php echo Form::file('image', null, array('id'=>'image')); ?> </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                </div>
                <?php echo APFrmErrHelp::showErrors($errors, 'image'); ?> </div>
        </div>
    </div>

    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'email'); ?>">
        <label class="bold">Select Self-intro Video</label>
        <br />
        <input type="file" accept="video/*"  name="self_intro"  >
        <br />

         <?php if(!empty($user->self_intro) && file_exists('public/video/'.$user->self_intro)): ?>
                <?php
            $filename = explode('.', $user->self_intro);
            $extension = end($filename);
            ?>
            <video poster="" height="150" id="player" playsinline controls>
              <?php if(strtolower($extension) == 'mp4'): ?>
                  <source src="<?php echo e(url('public/video')); ?>/<?php echo e($user->self_intro); ?>" type="video/mp4">
              <?php elseif(strtolower($extension) == 'webm'): ?>
                  <source src="<?php echo e(url('public/video')); ?>/<?php echo e($user->self_intro); ?>" type="video/webm">
              <?php endif; ?>
            </video>        
        <?php endif; ?>


    </div>



     <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'email'); ?>">
        <?php echo Form::label('email', 'Email', ['class' => 'bold']); ?>                    
        <?php echo Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email')); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'email'); ?>                                       
    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'password'); ?>">
        <?php echo Form::label('password', 'Password', ['class' => 'bold']); ?>                    
        <?php echo Form::password('password', array('class'=>'form-control', 'id'=>'password', 'placeholder'=>'Password')); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'password'); ?>                                       
    </div>
    <div class="form-group">
        <hr />
    </div>

     <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'first_name'); ?>">
        <?php echo Form::label('first_name', 'First Name', ['class' => 'bold']); ?>                    
        <?php echo Form::text('first_name', null, array('class'=>'form-control', 'id'=>'first_name', 'placeholder'=>'First Name')); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'first_name'); ?>                                       
    </div>

     <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'last_name'); ?>">
        <?php echo Form::label('last_name', 'Last Name', ['class' => 'bold']); ?>                    
        <?php echo Form::text('last_name', null, array('class'=>'form-control', 'id'=>'last_name', 'placeholder'=>'Last Name')); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'last_name'); ?>                                       
    </div>

    <div class="form-group">
        <label class="bold"><?php echo e(__("What's your current locatioin?")); ?></label>
        <select class="form-control" name="r_current_locatioin_id" required>
            <option value=""><?php echo e(__("Select")); ?></option>
            <?php $__currentLoopData = $getCurrentLocatioin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($user)): ?> <?php echo e(($user->r_current_locatioin_id == $value_l->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_l->id); ?>"><?php echo e($value_l->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


    <div class="form-group">
        <label class="bold"><?php echo e(__("What's your nationality?")); ?></label>
        <select class="form-control general_chine" required id="nationality_id" name="nationality_id">
            <option value=""><?php echo e(__("Select your nationality?")); ?></option>
            <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($user)): ?> <?php echo e(($user->nationality_id == $value_c->country_id) ? 'selected' : ''); ?> <?php endif; ?> data-val="<?php echo e($value_c->is_native); ?>" value="<?php echo e($value_c->country_id); ?>"><?php echo e($value_c->nationality); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group">
        <label class="bold"><?php echo e(__("Native English Speaker or not?")); ?></label>
        <input class="form-control" type="text" readonly value="<?=!empty($user->r_english_speaker_id) ? $user->r_english_speaker_id : 'No'?>" name="r_english_speaker_id" id="r_english_speaker">
    </div>

    <div class="form-group">
        <label class="bold"><?php echo e(__("What your highest education level?")); ?></label>
        <select class="form-control general_chine" name="r_highest_education_id" id="r_highest_education_id" required>
            <option value=""><?php echo e(__("Select your highest education level?")); ?></option>
            <?php $__currentLoopData = $getHighestEducation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($user)): ?> <?php echo e(($user->r_highest_education_id == $value_h->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_h->id); ?>"><?php echo e($value_h->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group" style="text-align: center;display: none;"  id="ChineseWorkingZVisa">
        <label class="bold" style="color: blue"><?php echo e(__("You can apply Chinese Working Z Visa")); ?></label>
        <input type="hidden" name="r_visa_id" id="r_visa_id">    
    </div>

    <div class="form-group">
        <label class="bold"><?php echo e(__("Have you graduated two years or more?")); ?></label>
        <select class="form-control general_chine" name="r_graduated_id" id="r_graduated" required>
            <option value=""><?php echo e(__("Select graduated two years or more?")); ?></option>
            <option <?php if(!empty($user)): ?> <?php echo e(($user->r_graduated_id == 'Yes') ? 'selected' : ''); ?> <?php endif; ?> value="Yes"><?php echo e(__("Yes")); ?></option>
            <option <?php if(!empty($user)): ?> <?php echo e(($user->r_graduated_id == 'No') ? 'selected' : ''); ?> <?php endif; ?> value="No"><?php echo e(__("No")); ?></option>
        </select>
    </div>

    <div class="form-group" style="text-align: center;display: none;" id="ChineseWorkingZVisaOther">
        <label class="bold" style="color: blue"><?php echo e(__("You can apply the other types of Chinese Visa")); ?></label>
    </div>

    <div class="form-group">
        <label class="bold"><?php echo e(__("What type of school you want to join?")); ?></label>
        <br />
        <?php $__currentLoopData = $getSchoolJoin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $checked = ''; ?>
                <?php if(!empty($user)): ?>
                <?php $__currentLoopData = $user->userschooljoin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school_join_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($school_join_id->school_join_id == $value_s->id): ?>
                        <?php $checked = 'checked'; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
               <label><input <?php echo e($checked); ?> type="checkbox" value="<?php echo e($value_s->id); ?>" name="school_join[]"> <?php echo e($value_s->name); ?></label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

   <div class="form-group">
      <label class="bold"><?php echo e(__("Age")); ?></label>
      <select class="form-control" name="r_age_id" required="">
         <option value=""><?php echo e(__("Select")); ?></option>
        <?php for($i=18;$i<=65;$i++): ?>
         <option <?php if(!empty($user)): ?> <?php echo e(($user->r_age_id == $i) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($i); ?>"><?php echo e($i); ?> ysr</option>
        <?php endfor; ?>
      </select>
   </div>


   <div class="form-group hide_english_speaker">
        <label class="bold"><?php echo e(__("Is Your Subject related to education or English?")); ?></label>
        <select class="form-control" name="r_subject_education" id="r_subject_education" >
            <option value=""><?php echo e(__("Select")); ?></option>
            <option <?php if(!empty($user)): ?> <?php echo e(($user->r_subject_education == 'Yes') ? 'selected' : ''); ?> <?php endif; ?> value="Yes"><?php echo e(__("Yes")); ?></option>
            <option  <?php if(!empty($user)): ?> <?php echo e(($user->r_subject_education == 'No') ? 'selected' : ''); ?> <?php endif; ?> value="No"><?php echo e(__("No")); ?></option>        
        </select>
    </div>




   <div class="form-group">
        <hr />
    </div>

    <div class="form-group">
        <label class="bold" style="color: red;line-height: normal;font-size: 16px;"><?php echo e(__("If you are not clear which city do you want to work, you can just choose a general location below and do not select State and City.")); ?></label>
        <input type="hidden" name="country_id" value="44" id="country_id">
    </div>
    <div class="form-group">
        <hr />
    </div>

    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'state_id'); ?>">
        <?php echo Form::label('state_id', 'State', ['class' => 'bold']); ?>                    
        <span id="default_state_dd">
            <?php echo Form::select('state_id', [''=>'Select State'], null, array('class'=>'form-control', 'id'=>'state_id')); ?>

        </span>
        <?php echo APFrmErrHelp::showErrors($errors, 'state_id'); ?>                                       
    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'city_id'); ?>">
        <?php echo Form::label('city_id', 'City', ['class' => 'bold']); ?>                    
        <span id="default_city_dd">
            <?php echo Form::select('city_id', [''=>'Select City'], null, array('class'=>'form-control', 'id'=>'city_id')); ?>

        </span>
        <?php echo APFrmErrHelp::showErrors($errors, 'city_id'); ?>                                       
    </div>

    <?php
$display_none = '';
if(!empty($user->city_id) && !empty($user->state_id)) {
    $display_none = 'display : none;';
}    
?>


    <div class="form-group r_teach_id_show"  >
         <label class="bold"><?php echo e(__("Where do you want to teach?")); ?></label>
        <select class="form-control" name="r_teach_id" required id="r_teach_id" >
            <option value=""><?php echo e(__("Select")); ?></option>
            <?php $__currentLoopData = $getTeach; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($user)): ?> <?php echo e(($user->r_teach_id == $value_t->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_t->id); ?>"><?php echo e($value_t->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group">
        <hr />
    </div>

    <div class="form-group">
        <label class="bold" ><?php echo e(__("What position are you looking for?")); ?></label>
        <select class="form-control" name="r_position_looking_id" required>
            <option value=""><?php echo e(__("Select")); ?></option>
            <?php $__currentLoopData = $getPositionLooking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($user)): ?> <?php echo e(($user->r_position_looking_id == $value_p->id) ? 'selected' : ''); ?>  <?php endif; ?> value="<?php echo e($value_p->id); ?>"><?php echo e($value_p->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


    <div class="form-group">
        <label class="bold"><?php echo e(__("What's type of work do you want?")); ?></label>
        <select class="form-control" name="r_work_type_id" required>
            <option value=""><?php echo e(__("Select")); ?></option>
            <?php $__currentLoopData = $getWorkType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(!empty($user)): ?> <?php echo e(($user->r_work_type_id == $value_w->id) ? 'selected' : ''); ?>  <?php endif; ?> value="<?php echo e($value_w->id); ?>"><?php echo e($value_w->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>        
    </div>


    <div class="form-group">
        <label class="bold" style="line-height: normal;"><?php echo e(__("When you can join this new position if you got a satisfied offer?")); ?></label>
        <select class="form-control" name="r_position_id" required>
            <option value=""><?php echo e(__("Select")); ?></option>
            <?php $__currentLoopData = $getPosition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option  <?php if(!empty($user)): ?> <?php echo e(($user->r_position_id == $value_p->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_p->id); ?>"><?php echo e($value_p->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>



  <div class="form-group">
        <label class="bold"><?php echo e(__("Working Experience")); ?></label>
        <select class="form-control" name="r_working_experience" required="">
            <option value=""><?php echo e(__("Select")); ?></option>
            <?php for($i=0;$i<=47;$i++): ?>
               <option <?php if(!empty($user)): ?> <?php echo e(($user->r_working_experience == $i) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
            <?php endfor; ?>
        </select>
 </div>



  <div class="form-group hide_english_speaker">
        <label class="bold"><?php echo e(__("Did you study in native English speaking countries?")); ?></label>
        <select class="form-control" name="r_native_english_speaking" id="r_native_english_speaking" >
            <option value=""><?php echo e(__("Select")); ?></option>
            <option <?php if(!empty($user)): ?> <?php echo e(($user->r_native_english_speaking == 'Yes') ? 'selected' : ''); ?> <?php endif; ?> value="Yes"><?php echo e(__("Yes")); ?></option>
            <option  <?php if(!empty($user)): ?> <?php echo e(($user->r_native_english_speaking == 'No') ? 'selected' : ''); ?> <?php endif; ?> value="No"><?php echo e(__("No")); ?></option>
        </select>
 </div>



  <div class="form-group">
        <label class="bold"><?php echo e(__("Other requirements")); ?></label>
        <input type="text" class="form-control" placeholder="Other requirements" value="<?php echo e(!empty($user->r_other_requirements)?$user->r_other_requirements:''); ?>" name="r_other_requirements">
 </div>





    

 <div class="col-md-6" style="padding-left: 0px;">
    <div class="form-group">
        <label class="bold" ><?php echo e(__("What's the salary do you expect minimum monthly?")); ?></label>
        <select class="form-control" name="r_salary_id" required>
                <option value=""><?php echo e(__("Select Minimum Salary")); ?></option>
                <?php $__currentLoopData = $getSalaryExpect; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if(!empty($user)): ?> <?php echo e(($user->r_salary_id == $value_s->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_s->id); ?>"><?php echo e($value_s->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<div class="col-md-6" style="padding-left: 0px;">
    <div class="form-group">
        <label class="bold" ><?php echo e(__("What's the salary do you expect maximum monthly?")); ?></label>
        <select class="form-control" name="r_max_salary_id" required>
                <option value=""><?php echo e(__("Select Maximum Salary")); ?></option>
                <?php $__currentLoopData = $getSalaryExpect; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if(!empty($user)): ?> <?php echo e(($user->r_max_salary_id == $value_s->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_s->id); ?>"><?php echo e($value_s->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

    <div class="form-group">
        <label class="bold" ><?php echo e(__('Any type of Chinese visa are you holding now?')); ?></label>
        <select class="form-control" name="chinese_visa_are_you_holding" >
                <option value=""><?php echo e(__("Select")); ?></option>
                <?php $__currentLoopData = $getTypeChineseVisa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_visa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if(!empty($user)): ?> <?php echo e(($user->chinese_visa_are_you_holding == $value_visa->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($value_visa->id); ?>"><?php echo e($value_visa->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group">
        <label class="bold"><?php echo e(__('When will you be available to attend the online interview? (Please provide a general available time)')); ?></label>
        <?php echo Form::text('online_interview', null, array('class'=>'form-control', 'id'=>'online_interview', 'placeholder'=>__('When will you be available to attend the online interview?'))); ?>

    </div>

    <div class="form-group">
        <hr />
    </div>


    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'is_active'); ?>">
        <?php echo Form::label('is_active', 'Active', ['class' => 'bold']); ?>

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
                <input id="active" name="is_active" type="radio" value="1" <?php echo e($is_active_1); ?>>
                Active </label>
            <label class="radio-inline">
                <input id="not_active" name="is_active" type="radio" value="0" <?php echo e($is_active_2); ?>>
                In-Active </label>
        </div>
        <?php echo APFrmErrHelp::showErrors($errors, 'is_active'); ?>

    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'verified'); ?>">
        <?php echo Form::label('verified', 'Verified', ['class' => 'bold']); ?>

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
                <input id="verified" name="verified" type="radio" value="1" <?php echo e($verified_1); ?>>
                Verified </label>
            <label class="radio-inline">
                <input id="not_verified" name="verified" type="radio" value="0" <?php echo e($verified_2); ?>>
                Not Verified </label>
        </div>
        <?php echo APFrmErrHelp::showErrors($errors, 'verified'); ?>

    </div> 
    <?php echo Form::button('Update Personal Information <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')); ?>   
</div>
<?php echo Form::close(); ?>

<?php $__env->startPush('css'); ?>
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
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
                return $.get("<?php echo e(route('typeahead.currency_codes')); ?>", {query: query}, function (data) {
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
            $.post("<?php echo e(route('filter.default.states.dropdown')); ?>", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '<?php echo e(csrf_token()); ?>'})
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
            $.post("<?php echo e(route('filter.default.cities.dropdown')); ?>", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '<?php echo e(csrf_token()); ?>'})
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
<?php $__env->stopPush(); ?>