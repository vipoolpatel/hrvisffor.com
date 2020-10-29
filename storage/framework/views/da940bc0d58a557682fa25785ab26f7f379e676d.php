<?php $__env->startSection('content'); ?> 
<!-- Header start --> 
<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<style type="text/css">
   .jobimg img {
   height: 100px;
   width: 100px;
   }
</style>
<!-- Header end --> 
<!-- Inner Page Title start --> 
<?php echo $__env->make('includes.inner_page_title', ['page_title'=>__('Dashboard')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<!-- Inner Page Title end -->
<div class="listpgWraper">
   <div class="container">
      <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="row">
         <?php echo $__env->make('includes.company_dashboard_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         <div class="col-md-9 col-sm-8"> 
            <?php echo $__env->make('includes.company_dashboard_stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
            <?php echo $__env->make('includes.company_job_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         </div>
      </div>
   </div>
</div>
<?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<?php echo $__env->make('includes.immediate_available_btn', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
   function deleteJob(id) {
   var msg = 'Are you sure?';
   if (confirm(msg)) {
   $.post("<?php echo e(route('delete.front.job')); ?>", {id: id, _method: 'DELETE', _token: '<?php echo e(csrf_token()); ?>'})
           .done(function (response) {
           if (response == 'ok')
           {
           $('#job_li_' + id).remove();
           } else
           {
           alert('Request Failed!');
           }
           });
   }
   }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>