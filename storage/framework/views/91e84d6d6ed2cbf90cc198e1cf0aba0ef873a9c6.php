
<input type="hidden" name="staff_id" value="<?php echo e($staff_id); ?>">
<?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php
	$checked = '';
	?>
	<?php $__currentLoopData = $user_permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($permission_id->permission_id ==  $value->id): ?>
		<?php
		$checked = 'checked';
		?>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	

<div class="col-md-6">
	<div class="form-group">
	    <label><input type="checkbox" <?php echo e($checked); ?> name="permission[]" value="<?php echo e($value->id); ?>"> <?php echo e($value->name); ?></label>
	</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div style="clear: both;"></div>
