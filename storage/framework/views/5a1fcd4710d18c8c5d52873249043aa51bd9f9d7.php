 <?php $__currentLoopData = $getcompanymessage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messagevalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-success"> <i class="fa fa-envelope"></i> </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    <?php echo e($messagevalue->seeker_name); ?> sent "<?php echo e($messagevalue->message); ?>" to <a href="<?php echo e(url('admin/my-teacher-message')); ?>" title="Media Wave" ><?php echo e($messagevalue->company_name); ?>.</a>
                    Time : <?php echo e(date('d-m-Y h:i A', strtotime($messagevalue->created_at))); ?>

                </div>
            </div>
        </div>
    </div>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     