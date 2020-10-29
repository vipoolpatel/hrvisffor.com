<?php $__env->startSection('content'); ?>
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="background-color:#eef1f5;"> 
        <!-- BEGIN PAGE HEADER-->     
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="index.html">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span><?php echo e($siteSetting->site_name); ?> Admin Panel</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo e($siteSetting->site_name); ?> Admin Panel <small><?php echo e($siteSetting->site_name); ?> Admin Panel</small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                        <div class="visual"> <i class="fa fa-user"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349"><?php echo e($totalTodaysUsers); ?></span> </div>
                            <div class="desc"> Todays Users </div>
                        </div>
                    </a> </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                        <div class="visual"> <i class="fa fa-user"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349"><?php echo e($totalActiveUsers); ?></span> </div>
                            <div class="desc"> Active Users </div>
                        </div>
                    </a> </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                        <div class="visual"> <i class="fa fa-user"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349"><?php echo e($totalVerifiedUsers); ?></span> </div>
                            <div class="desc"> Verified Users </div>
                        </div>
                    </a> </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                        <div class="visual"> <i class="fa fa-list"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349"><?php echo e($totalTodaysJobs); ?></span> </div>
                            <div class="desc"> Todays Jobs </div>
                        </div>
                    </a> </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                        <div class="visual"> <i class="fa fa-list"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349"><?php echo e($totalActiveJobs); ?></span> </div>
                            <div class="desc"> Active Jobs </div>
                        </div>
                    </a> </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                        <div class="visual"> <i class="fa fa-list"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349"><?php echo e($totalFeaturedJobs); ?></span> </div>
                            <div class="desc"> Featured Jobs </div>
                        </div>
                    </a> </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-share font-dark hide"></i> <span class="caption-subject font-dark bold uppercase">Recent Registered Users</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="slimScrol">
                            <ul class="feeds">
                                <?php $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info"> <i class="fa fa-check"></i> </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc"><a href="<?php echo e(route('edit.user', $recentUser->id)); ?>"> <?php echo e($recentUser->name); ?> (<?php echo e($recentUser->email); ?>) </a>  - <i class="fa fa-home" aria-hidden="true"></i> <?php echo e($recentUser->getLocation()); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="scroller-footer">
                            <div class="btn-arrow-link pull-right"> <a href="<?php echo e(route('list.users')); ?>">See All Users</a> <i class="icon-arrow-right"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-share font-dark hide"></i> <span class="caption-subject font-dark bold uppercase">Recent Jobs</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="slimScrol">
                            <ul class="feeds">
                                <?php $__currentLoopData = $recentJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info"> <i class="fa fa-check"></i> </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc"><a href="<?php echo e(route('edit.job', $recentJob->id)); ?>"> <?php echo e(str_limit($recentJob->getpositionlooking->name, 50)); ?> </a>  - <i class="fa fa-list" aria-hidden="true"></i> <?php echo e($recentJob->getCompany('name')); ?> - <i class="fa fa-home" aria-hidden="true"></i> <?php echo e($recentJob->getLocation()); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
                            </ul>
                        </div>
                        <div class="scroller-footer">
                            <div class="btn-arrow-link pull-right"> <a href="<?php echo e(route('list.jobs')); ?>">See All Jobs</a> <i class="icon-arrow-right"></i> </div>
                        </div>
                    </div>
                </div>
            </div>


			<div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-share font-dark hide"></i> <span class="caption-subject font-dark bold uppercase">Notifications</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="slimScrol">
                            <ul class="feeds">
                                <?php $__currentLoopData = $job_noti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-<?php if($noti['all']->status === 'pending'){ echo 'info';}else{ echo 'success';} ?>"> <i class="fa fa-bell"></i> </div>
                                            </div>
                                            <div class="cont-col2" <?php if($noti['all']->status === 'pending'){ echo 'onclick="markAsRead('.$noti['all']->id.')"';}else{ 'not_get';} ?>>
                                                <div class="desc">
													<a href="list-users"  target="_blank"><?php echo e($noti['user']->name); ?></a> applied 
													<a href="<?php echo e(route('job.detail', $noti['job']->slug)); ?>" title="<?php echo e($noti['job']->title); ?>" target="_blank"><?php echo e($noti['job']->title); ?>.</a>
													
													
													<?php echo e($noti['job']->title); ?>. 


                                        
 <a href="<?php echo e(url('auto-company-login?company_id='.$noti['job']->company_id)); ?>" title="<?php echo e($noti['job']->company_name); ?>" target="_blank"><?php echo e($noti['job']->company_name); ?>.</a>


                                                     <?php if(!empty($noti['apply'])): ?>Current salary $<?php echo e($noti['apply']->current_salary); ?>. Expected salary $<?php echo e($noti['apply']->expected_salary); ?>. Resume: <a target="_blank" href="https://hrvisffor.com/cvs/<?php echo e($noti['cv']->cv_file); ?>">View</a> <?php endif; ?>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-share font-dark hide"></i> <span class="caption-subject font-dark bold uppercase">Teacher Message Notification</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="slimScrol">
                            <input value="<?php echo e(count($getcompanymessage)); ?>" type="hidden" id="getcompanymessageTotalCount">
                            <ul class="feeds" id="getcompanymessage">
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-share font-dark hide"></i> <span class="caption-subject font-dark bold uppercase">Company Message Notification</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="slimScrol">
                            <input value="<?php echo e(count($getstaffcompanymessage)); ?>" type="hidden" id="getstaffcompanymessageTotalCount">
                            <ul class="feeds" id="getstaffcompanymessage">
                                <?php $__currentLoopData = $getstaffcompanymessage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messagestaffvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $getSeeker = App\User::find($messagestaffvalue->seeker_id);
                                ?>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-success"> <i class="fa fa-envelope"></i> </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    <?php echo e($messagestaffvalue->seeker_name); ?> sent "<?php echo e($messagestaffvalue->message); ?>" to <a href="<?php echo e(url('admin/my-company-message')); ?>" title="Media Wave"><?php echo e($messagestaffvalue->company_name); ?>.</a>
                                                    Time : <?php echo e(date('d-m-Y h:i A', strtotime($messagestaffvalue->created_at))); ?>


                                                    <?php if(!empty($getSeeker)): ?>
                                                        <span> <a target="_blank" href="<?php echo e(url('user-profile/'.$messagestaffvalue->seeker_id)); ?>"><?php echo e($getSeeker->first_name); ?> <?php echo e($getSeeker->last_name); ?></a></span>
                                                    <?php endif; ?>
                                                    

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>




<audio controls id="music" style="display: none;">
    <source src="<?php echo e(url('public/mp3/notification.mp3')); ?>" type="audio/mpeg">
</audio>



        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">

var myMusic = document.getElementById("music");

setInterval(play_notification, 10000);

function play_notification() {

    var total_count = $('#getcompanymessageTotalCount').val();


    $.ajax({
        url: "<?php echo e(url('admin/get_notification_message')); ?>",
        type: "GET",
        data:{},
        dataType: 'json',
        success:function(response){
            if(response.status > total_count) {
                myMusic.play();   
                $('#getcompanymessageTotalCount').val(response.status);
            }
            else
            {
                if(response.status == 0)
                {
                    $('#getcompanymessageTotalCount').val('0');       
                }
            }


            $('#getcompanymessage').html(response.items);
        },
   });
}


setInterval(play_company_notification, 10000);


function play_company_notification() {
    var total_count = $('#getstaffcompanymessageTotalCount').val();
    $.ajax({
        url: "<?php echo e(url('admin/get_company_notification_message')); ?>",
        type: "GET",
        data:{},
        dataType: 'json',
        success:function(response){
            if(response.status > total_count) {
                myMusic.play();   
                $('#getstaffcompanymessageTotalCount').val(response.status);
            }
            else
            {
                if(response.status == 0)
                {
                    $('#getstaffcompanymessageTotalCount').val('0');       
                }
            }


            $('#getstaffcompanymessage').html(response.items);
        },
   });
}




    $(function () {
        $('.slimScrol').slimScroll({
            height: '250px',
            railVisible: true,
            alwaysVisible: true
        });
    });
	function markAsRead(id){
		$.post("https://hrvisffor.com/mark-as-read", {id: id,_token:"<?php echo e(csrf_token()); ?>", _method: 'POST' })
			.done(function (response) {
				location.reload();
            });
    	
    
	}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>