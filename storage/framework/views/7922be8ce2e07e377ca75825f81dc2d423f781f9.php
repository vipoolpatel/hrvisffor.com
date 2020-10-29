<div class="col-md-3 col-sm-4">
	<div class="usernavwrap">
    <ul class="usernavdash">
        <li class="active"><a href="<?php echo e(route('company.home')); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> <?php echo e(__('Dashboard')); ?></a></li>
        <li><a href="<?php echo e(route('company.profile')); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo e(__('Edit Profile')); ?></a></li>
        <li><a href="<?php echo e(route('company.detail', Auth::guard('company')->user()->slug)); ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('Company Public Profile')); ?></a></li>
        <li><a href="<?php echo e(route('post.job')); ?>"><i class="fa fa-desktop" aria-hidden="true"></i> <?php echo e(__('Post Job')); ?></a></li>
        <li><a href="<?php echo e(route('posted.jobs')); ?>"><i class="fa fa-black-tie" aria-hidden="true"></i> <?php echo e(__('Company Jobs')); ?></a></li>

        <li><a href="<?php echo e(route('company.messages')); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo e(__('Company Messages')); ?></a></li>
		<li><a href="<?php echo e(route('school.interview')); ?>"><i class="fa fa-calendar"></i> School's Interview</a></li>
		 <li><a href="<?php echo e(route('invitation.list')); ?>"><i class="fa fa-paper-plane Blink" aria-hidden="true"></i> Invitation</a></li>
        <li><a href="<?php echo e(route('company.followers')); ?>"><i class="fa fa-users" aria-hidden="true"></i> <?php echo e(__('Company Followers')); ?></a></li>
        <li><a href="<?php echo e(route('company.logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo e(__('Logout')); ?></a>
            <form id="logout-form" action="<?php echo e(route('company.logout')); ?>" method="POST" style="display: none;"><?php echo e(csrf_field()); ?></form>
        </li>
    </ul>
	</div>
  
</div>