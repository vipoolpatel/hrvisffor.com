<?php $__env->startSection('content'); ?>
<style type="text/css">
   .table td, .table th {
   font-size: 12px;
   line-height: 2.42857 !important;
   }    
   .message-history li a {
   display: block;
   overflow: hidden;
   padding: 15px 20px;
   text-decoration: none;
   }
   .message-history li {
   border-bottom: 1px solid #d1d1d1;
   }
   .message-history {
   margin: 0;
   padding: 0;
   list-style: none;
   overflow-y: auto;
   overflow-x: hidden;
   max-height: 500px;
   }
   .message-history li .image img {
   width: 100%;
   }
   .message-history li .image {
   width: 50px;
   height: 50px;
   border-radius: 50% !important;
   overflow: hidden;
   float: left;
   }
   .message-history li .user-name {
   position: relative;
   margin-left: 65px;
   }
   .message-history li .user-name .author {
   margin-top: 13px;
   }
   .message-history li .user-name .count-messages {
   float: right;
   margin: -13px;
   margin-right: -13px;
   margin-right: 2px;
   }
   .message-history .active {
   background-color: #f8f8f8;
   }
   /*right side*/
   .messages {
   list-style: outside none none;
   margin: 0;
   padding: 10px;
   overflow-y: auto;
   overflow-x: hidden;
   height: 440px;
   }
   .messages > li {
   margin-bottom: 10px;
   }
   .my-message .profile-picture {
   float: right;
   }
   .messages .profile-picture {
   height: 40px;
   margin: 0;
   width: 40px;
   }
   .my-message .message {
   background-color: #007bff;
   color: #fff;
   margin-right: 50px;
   }
   .messages .message {
   border-radius: 5px !important;
   font-size: 14px;
   font-weight: 500;
   margin-bottom: 10px;
   min-height: 40px;
   padding: 15px 20px;
   position: relative;
   }
   .messages .message .time {
   font-size: 12px;
   line-height: 10px;
   margin-top: 0;
   text-align: right;
   }
   .messages .profile-picture img {
   border: medium none;
   border-radius: 50% !important;
   }
   .messages .profile-picture {
   height: 40px;
   margin: 0;
   width: 40px;
   }
   .friend-message .profile-picture {
   float: left;
   }
   .friend-message .message {
   background-color: #fff;
   margin-left: 50px;
   }
   .messages .message .time {
   font-size: 12px;
   line-height: 10px;
   margin-top: 0;
   text-align: right;
   }
   .profile-picture img { 
   width: 100%;
   }
   .chat-form {
   background-color: #dcdcdc;
   clear: both;
   margin-top: 15px;
   padding: 10px;
   }
   .form-inline {
   display: -ms-flexbox;
   display: flex;
   -ms-flex-flow: row wrap;
   flex-flow: row wrap;
   -ms-flex-align: center;
   align-items: center;
   }
   .chat-form .form-group {
   width: 100%;
   }
   .chat-form .input-wrap {
   width: 100%;
   position: relative;
   }
   .chat-form .input-group-prepend {
   position: absolute;
   top: 7px;
   right: 6px;
   }
   .chat-form .input-group-prepend .input-group-text {
   -webkit-appearance: none;
   background: #007bff;
   color: #fff;
   width: 75px;
   display: block;
   border: none;
   line-height: 17px;
   align-items: center;
   padding: 15px 0;
   cursor: pointer;
   border-radius: 5px !important;
   }
   .chat-form .form-group textarea {
       width: 100%;
       padding: 5px 11px;
       border-radius: 5px !important;
       height: 65px;
   }
</style>
<div class="page-content-wrapper">
   <!-- BEGIN CONTENT BODY -->
   <div class="page-content">
      <!-- BEGIN PAGE HEADER--> 
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
         <ul class="page-breadcrumb">
            <li> <a href="<?php echo e(route('admin.home')); ?>">Home</a> <i class="fa fa-circle"></i> </li>
            <li> <span>My Teacher Message</span> </li>
         </ul>
      </div>
      <!-- END PAGE BAR --> 
      <!-- BEGIN PAGE TITLE-->
      <h3 class="page-title">My Teacher Message</h3>
      <!-- END PAGE TITLE--> 
      <!-- END PAGE HEADER-->
      <div class="row">
         <div class="col-md-12">
            <label>Company</label>
            <select class="form-control" id="getCompanySeeker" style="width: 400px;">
               <option value="">Select Company</option>
               <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
            </select>
            <br />
            <div class="portlet light portlet-fit portlet-datatable bordered">
               <div class="portlet-body">
                  <div class="table-container">
                     <div class="myads message-body">
                        <div class="row" id="getJobSeekerData">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- END CONTENT BODY --> 
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script type="text/javascript">
   function show_messages(id)
   {
           var company_id = $('#getCompanySeeker').val();
   
           $.ajax({
               type: "GET",
               url: "<?php echo e(url('admin/teacher-change-message-status')); ?>",
               data: { 
                   'sender_id': id, 
                   'company_id' : company_id,
               },
           });
   
   
         $.ajax({
           type: 'get',
           url: "<?php echo e(url('admin/append-message')); ?>",
           data: {
             '_token': $('input[name=_token]').val(),
             'seeker_id': id,
             'company_id' : company_id,
           },
           success: function(res) {
             $('#append_messages').html('');
             $('#append_messages').html(res);
             $('.message-grid').removeClass('active');
             $("#adactive"+id).addClass('active');
             $(".messages").scrollTop(1000000000000);
             $('.messages').off('scroll');
           }
         });
   
     }
     
   
     $('#getCompanySeeker').change(function(){
           var company_id = $(this).val();
           $.ajax({
               type: 'get',
               url: "<?php echo e(url('admin/get-teacher-seeker')); ?>",
               data: {
                 'company_id': company_id,
               },
               success: function(res) {
                   $('#getJobSeekerData').html(res);
               }
         });
     });
   
     
       
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>