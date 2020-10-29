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
   .message-history {
     margin: 0;
     padding: 0;
     list-style: none;
     overflow-y: auto;
     overflow-x: hidden;
     max-height: 500px;
   }
   .message-history li {
      border-bottom: 1px solid #d1d1d1;
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
            <li> <span>My Company Message</span> </li>
         </ul>
      </div>
      <!-- END PAGE BAR --> 
      <!-- BEGIN PAGE TITLE-->
      <h3 class="page-title">My Company Message</h3>
      <!-- END PAGE TITLE--> 
      <!-- END PAGE HEADER-->
      <div class="row">
         <div class="col-md-12">
            <div class="portlet light portlet-fit portlet-datatable bordered">
               <div class="portlet-body">
                  <div class="table-container">
                     <div class="myads message-body">
                        <div class="row" >
                           <div class="col-lg-4 col-md-4">
                              <div class="message-inbox">
                                 <div class="message-header">
                                 </div>
                                 <div class="list-wrap">
                                    <ul class="message-history">
                                       <?php if(null !== ($getcompany)): ?>
                                       <?php foreach($getcompany as $company){?>
                                       <li class="message-grid" id="adactive<?php echo e($company->id); ?>">
                                          <a  href="javascript:;" data-gift="<?php echo e($company->id); ?>" id="company_id_<?php echo e($company->id); ?>"  onclick="show_messages('<?php echo e($company->id); ?>','<?php echo e($company->staff_id); ?>')">
                                             <div class="image"> 
                                                <?php echo e($company->printCompanyImage()); ?>

                                             </div>
                                             <div class="user-name">
                                                <div class="author"> <span><?php echo e($company->name); ?> 
                                                    <?php if($company->countStaffMessages($company->staff_id)): ?>
                                                        (<?php echo e($company->countStaffMessages($company->staff_id)); ?>)
                                                    <?php endif; ?>
                                                </span>                       
                                                </div>
                                                <?php if(!empty($company->OnlineUser())): ?>
                                                <div class="count-messages" style="margin-top: -21px;font-weight: bold;color: green;"><i class="fa fa-circle" aria-hidden="true"></i></div>
                                                <?php endif; ?>
                                             </div>
                                          </a>
                                       </li>
                                       <?php } ?>
                                       <?php endif; ?>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-8 col-md-8 clearfix message-content">
                              <div class="message-details">
                                 <h4> </h4>
                                 <div id="append_messages">
                                 </div>
                              </div>
                           </div>
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
   function show_messages(id,staff_id)
   {
           $.ajax({
               type: "GET",
               url: "<?php echo e(url('admin/company-change-message-status')); ?>",
               data: { 
                   'company_id': id, 
                   'staff_id' : staff_id
              },
           });
   
   
         $.ajax({
           type: 'get',
           url: "<?php echo e(url('admin/company-append-message')); ?>",
           data: {
             '_token': $('input[name=_token]').val(),
             'company_id': id,
             'staff_id' : staff_id
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
     
   
   
     
       
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>