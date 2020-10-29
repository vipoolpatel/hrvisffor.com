<?php if(count($errors) > 0): ?>
<div class="alert alert-danger">
    There were some problems with your input.
</div>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo e($error); ?><br/>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="form-body">
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'name'); ?>">
        <?php echo Form::label('name', 'Name', ['class' => 'bold']); ?>                    
        <?php echo Form::text('name', null, array('required', 'class'=>'form-control', 'placeholder'=>'Name')); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'name'); ?>                                       
    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'email'); ?>">
        <?php echo Form::label('email', 'Email Address', ['class' => 'bold']); ?>

        <?php echo Form::text('email', null, array('required', 'class'=>'form-control', 'placeholder'=>'Email Address')); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'email'); ?>

    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'password'); ?>">
        <?php echo Form::label('password', 'Password', ['class' => 'bold']); ?>

        <?php echo Form::password('password', array('required', 'class'=>'form-control', 'placeholder'=>'Password')); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'password'); ?>

    </div>
    <div class="form-group <?php echo APFrmErrHelp::hasError($errors, 'role_id'); ?>">
        <?php echo Form::label('role', 'Role', ['class' => 'bold']); ?>

        <?php echo Form::select('role_id', ['' => 'Select a Role']+$roles, null, ['class' => 'form-control']); ?>

        <?php echo APFrmErrHelp::showErrors($errors, 'role_id'); ?>

    </div>
</div>