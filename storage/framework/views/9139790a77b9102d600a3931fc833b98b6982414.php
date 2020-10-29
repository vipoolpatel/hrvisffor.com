<div class="myads">
    <h3><?php echo e(__('Company Posted Jobs')); ?></h3>
    <ul class="searchList">
        <!-- job start --> 
        <?php if(isset($jobs) && count($jobs)): ?>
        <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $company = $job->getCompany(); ?>
        <?php if(null !== $company): ?>
        <li id="job_li_<?php echo e($job->id); ?>">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="jobimg"><?php echo e($company->printCompanyImage()); ?></div>
                    <div class="jobinfo">
                        <h3 style="margin-top: 10px;"><a style="color: #fff;" href="<?php echo e(route('job.detail', [$job->slug])); ?>" title="<?php echo e(!empty($job->getpositionlooking->name) ? $job->getpositionlooking->name : ''); ?>"><?php echo e(!empty($job->getpositionlooking->name) ? $job->getpositionlooking->name : ''); ?></a></h3>
                        <div class="companyName"><a style="color: #fff;" href="<?php echo e(route('company.detail', $company->slug)); ?>" title="<?php echo e($company->name); ?>"><?php echo e($company->name); ?></a></div>

                        <div class="location">
                            <label class="fulltime" title="<?php echo e($job->getJobShift('job_shift')); ?>"><?php echo e($job->getLocation()); ?></label>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-4 col-sm-4">                
                    

                    <div class="listbtn"><a href="<?php echo e(url('job-seekers?id='.$job->id)); ?>"><?php echo e(__('Match Candidates')); ?></a></div>

                    <div class="listbtn"><a href="<?php echo e(route('list.applied.users', [$job->id])); ?>"><?php echo e(__('List Candidates')); ?></a></div>
                    <div class="listbtn"><a href="<?php echo e(route('edit.front.job', [$job->id])); ?>"><?php echo e(__('Edit')); ?></a></div>
                    <div class="listbtn"><a href="javascript:;" onclick="deleteJob(<?php echo e($job->id); ?>);"><?php echo e(__('Delete')); ?></a></div>
                </div>
            </div>
            <p><?php echo e(str_limit(strip_tags($job->description), 150, '...')); ?></p>
        </li>
        <!-- job end --> 
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</div>