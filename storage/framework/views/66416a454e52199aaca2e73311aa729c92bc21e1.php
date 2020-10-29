<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/12/2020
 * Time: 12:28 PM
 */
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="tab-list">
                    <nav class="nav-justified ">
                        <div class="nav nav-tabs " id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="pop1-tab" href="#application" role="tab"
                               aria-controls="pop1" aria-selected="true"><i class="fa fa-envelope"></i> Application
                                Process</a>
                            <a class="nav-item nav-link" id="pop2-tab" href="#videos" role="tab"
                               aria-controls="pop2" aria-selected="false"><i class="fa fa-sticky-note"></i> Testimonials</a>
                            <a class="nav-item nav-link" id="pop3-tab" href="<?php echo e(url('beijing-profile')); ?>" role="tab"
                               aria-controls="pop3" aria-selected="false"><i class="fa fa-building"></i> China City
                                Profile</a>
                            <a class="nav-item nav-link" id="pop4-tab" href="<?php echo e(route('blogs')); ?>" role="tab"
                               aria-controls="pop3" aria-selected="false"><i class="fa fa-search-plus"></i>
                                Resources</a>
                            

                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-md-12" id="map">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                    <div class="pt-3"></div>
                    <h2 class="text-center py-3">Teacher Join Us <br/>
                        Around The World</h2>
                    <div class="row">

                        <div class="col-md-10 mx-auto">

                            <div id="container"></div>
                           
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                    <div class="pt-3"></div>
                    <p></p>

                </div>
                <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                    <div class="pt-3"></div>
                    <p></p>

                </div>

            </div>
            </div>
        </div>

    </div>
</section>
