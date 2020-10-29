<!--Footer-->



<div class="footerWrap">
    <div class="footer-area">
    <div class="container">
        <div class="row"> 
            <div class="col-md-6">
                <div class="row">
                <!--Quick Links-->
            <div class="col-md-4 col-sm-6 text-center">
                <img src="<?php echo e(asset('images/home/carton images.png')); ?>">
               
            </div>
            <!--Quick Links menu end-->

            <div class="col-md-4 col-sm-6">
                <h5><?php echo e(__('Visffor')); ?></h5>
                <!--Quick Links menu Start-->
                <ul class="quicklinks">
                    <li><a href="#"><?php echo e(__('About Us')); ?></a></li>
                    <li><a href="<?php echo e(route('contact.us')); ?>"><?php echo e(__('Contact Us')); ?></a></li>
                    <li><a href="<?php echo e(url('/#why_us')); ?>"><?php echo e(__('Why Us')); ?></a></li>
                    <li><a href="<?php echo e(url('/'.'#application')); ?>"><?php echo e(__('Process')); ?></a></li>
                    <li><a href="<?php echo e(url('/#map')); ?>"><?php echo e(__('Map')); ?></a></li>
                    
                    
                </ul>
            </div>
                    <div class="col-md-4 col-sm-6" style="padding-left: 0px;">
                        <h5><?php echo e(__('Location')); ?></h5>
                        <div>
                            <div class="font-weight-bold text-white py-1">United Kingdom</div>
                            <p>City Point, 1 Solly Street,
                                Sheffield, S1 4BX.
                                TEL:(+44)07455962168 </p>
                        </div>
                        <div>
                            <div class="font-weight-bold text-white py-1">China</div>
                            <p>Xicheng, Beijing.
                                100045. <br /> 
                                Landline: (+86)-01057958881</p>
                        </div>
                        <!--Quick Links menu Start-->
                        
                    </div>
            </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                <!--Jobs By Industry-->
            <div class="col-md-6 col-sm-6">
                <h5><?php echo e(__('Register Now')); ?></h5>
                <p>Sign up with your email address to receive news
                    and updates</p>
                <div class="newsletter py-3">
                    <div class="content">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <span class="input-group-btn">
         <button class="btn" type="submit">Register</button>
         </span>
                    </div>
                    </div>
                </div>
                <div class="font-weight-bold text-white py-1">Connect With us</div>
                <!-- Social Icons -->
                <div class="social py-3"><?php echo $__env->make('includes.footer_social', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
                <!-- Social Icons end -->
                <!--Industry menu Start-->
                
                <!--Industry menu End-->
                <div class="clear"></div>
            </div>

            <!--About Us-->
            <div class="col-md-6 col-sm-12">
                <h5><?php echo e(__('Get Visffor App')); ?></h5>
                <p>Download our app from ISO or
                    Android free cost</p>
                <div class="py-3">
                <a href="#" class="">
                    <img src="<?php echo e(asset('images/home/google-play-and-apple-app-store-logos-22.png')); ?>" class="img-fluid">
                </a>
                </div>
                <div class="py-3">
                <a href="#">
                    <img src="<?php echo e(asset('images/home/google-play-and-apple-app-store-logos-221.png')); ?>" class="img-fluid">
                </a>
                </div>
                <

            </div>
            </div>
            <!--About us End-->
            </div>
        </div>
        </div>
    </div>
</div>
<!--Footer end--> 
<!--Copyright-->

