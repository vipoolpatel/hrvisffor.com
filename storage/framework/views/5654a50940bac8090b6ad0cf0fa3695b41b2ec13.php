<div class="header">
    <div class="top-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    Email us info@visfforjob.com, or Call us: +44 745 5962 168. or Skype us: info@vistfor.com
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-12 col-12"> <a href="<?php echo e(url('/')); ?>" class="logo"><img src="<?php echo e(asset('/')); ?>sitesetting_images/thumb/<?php echo e($siteSetting->site_logo); ?>" alt="<?php echo e($siteSetting->site_name); ?>" /></a>
                <div class="navbar-header navbar-light">
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-main" aria-controls="nav-main" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-10 col-md-12 col-12"> 

                <!-- Nav start -->
                <nav class="navbar navbar-expand-lg navbar-light">
					
                    <div class="navbar-collapse collapse" id="nav-main">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item <?php echo e(Request::url() == route('index') ? 'active' : ''); ?>"><a href="<?php echo e(url('/')); ?>" class="nav-link"><?php echo e(__('Home')); ?></a> </li>
							
                            <?php
                            $teacher_header = '';
                            ?>
                            <?php if(!empty(Auth::user()->id)): ?>
                                <?php
                                    $teacher_header = '?teacher='.Auth::user()->id;
                                ?>
                            <?php endif; ?>

                            
                            <?php if(!empty(Auth::guard('company')->user()->id)): ?>

                            <?php else: ?>
                                <li class="nav-item <?php echo e(Request::url() == url('/jobs') ? 'active' : ''); ?>"><a href="<?php echo e(url('/jobs'.$teacher_header)); ?>" class="nav-link">Find a Position</a></li>
                                <?php if(!empty(Auth::user()->id)): ?>
                                <?php else: ?>
                                    <li class="nav-item <?php echo e(Request::url() == url('/job-seekers') ? 'active' : ''); ?>"><a href="<?php echo e(url('/job-seekers')); ?>" class="nav-link">Find a Teacher</a></li>
                                <?php endif; ?>

                            <?php endif; ?>

                            


                            <li class="nav-item <?php echo e(Request::url() == route('faq') ? 'active' : ''); ?>"><a href="<?php echo e(route('faq')); ?>" class="nav-link">FAQ</a></li>
                            
                            
                            <li class="nav-item <?php echo e(Request::url() == route('contact.us') ? 'active' : ''); ?>"><a href="<?php echo e(route('contact.us')); ?>" class="nav-link"><?php echo e(__('Contact us')); ?></a> </li>
                            <?php if(Auth::check()): ?>
                            <li class="nav-item dropdown userbtn"><a href=""><?php echo e(Auth::user()->printUserImage()); ?></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="<?php echo e(route('home')); ?>" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i> <?php echo e(__('Dashboard')); ?></a> </li>
                                    <li class="nav-item"><a href="<?php echo e(route('my.profile')); ?>" class="nav-link"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('My Profile')); ?></a> </li>
                                    <li class="nav-item"><a href="<?php echo e(route('view.public.profile', Auth::user()->id)); ?>" class="nav-link"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo e(__('View Public Profile')); ?></a> </li>
                                    <li><a href="<?php echo e(route('my.job.applications')); ?>" class="nav-link"><i class="fa fa-desktop" aria-hidden="true"></i> <?php echo e(__('My Job Applications')); ?></a> </li>
                                    <li class="nav-item"><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo e(__('Logout')); ?></a> </li>
                                    <form id="logout-form-header" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </ul>
                            </li>
                            <?php endif; ?> <?php if(Auth::guard('company')->check()): ?>
                            <li class="nav-item postjob"><a href="<?php echo e(route('post.job')); ?>" class="nav-link register"><?php echo e(__('Post a job')); ?></a> </li>
                            <li class="nav-item dropdown userbtn"><a href=""><?php echo e(Auth::guard('company')->user()->printCompanyImage()); ?></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="<?php echo e(route('company.home')); ?>" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i> <?php echo e(__('Dashboard')); ?></a> </li>
                                    <li class="nav-item"><a href="<?php echo e(route('company.profile')); ?>" class="nav-link"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('Company Profile')); ?></a></li>
                                    <li class="nav-item"><a href="<?php echo e(route('post.job')); ?>" class="nav-link"><i class="fa fa-desktop" aria-hidden="true"></i> <?php echo e(__('Post Job')); ?></a></li>
                                    <li class="nav-item"><a href="<?php echo e(route('company.messages')); ?>" class="nav-link"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo e(__('Company Messages')); ?></a></li>
                                    <li class="nav-item"><a href="<?php echo e(route('company.logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-header1').submit();" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo e(__('Logout')); ?></a> </li>
                                    <form id="logout-form-header1" action="<?php echo e(route('company.logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </ul>
                            </li>
                            <?php endif; ?> <?php if(!Auth::user() && !Auth::guard('company')->user()): ?>
                                <li class="nav-item"><a href="<?php echo e(route('register')); ?>" class="nav-link regi-btn"><?php echo e(__('Sign Up')); ?></a> </li>
                                <li class="nav-item"><a href="<?php echo e(route('login')); ?>" class="nav-link sign-in-btn"><?php echo e(__('Log in')); ?></a> </li>

                            <?php endif; ?>
                            
                        </ul>

                        <!-- Nav collapes end --> 

                    </div>
                    <div class="clearfix"></div>
                </nav>

                <!-- Nav end --> 

            </div>
        </div>

        <!-- row end --> 

    </div>

    <!-- Header container end --> 

</div>






<?php /*?>@if(!Auth::user() && !Auth::guard('company')->user())
	<div class="">my dive 2</div>
@endif<?php */?>