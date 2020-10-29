<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/12/2020
 * Time: 12:54 PM
 */
?>
<section class="why-choose" id="why_us">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12 text-center py-3">
                <div class="titleTop">

                    <h3>{{__('Why Choose')}} <span>{{__('Visffor?')}}</span></h3>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="legal">
                    <div class="why-tech-image py-3">
                        <i class="fa fa-handshake-o fa-2x"></i>
                    </div>
                    <div>
                        <h4>Legal Protection</h4>
                        <div class="why-choose-details">
                            <p>Starting your job in China Is
                                not the end of our service Our
                                lawyers protect you while you
                                are working in China.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="support">
                    <div class="why-tech-image py-3">
                        <i class="fa fa-support fa-2x"></i>
                    </div>
                <div>
                    <h4>24 hour support</h4>
                    <div class="why-choose-details">
                        <p>With offices in China, USA, UK
                            and Australia, there is always
                            someone available to answer
                            your questions.</p>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-3">
                <div class="visa">
                <div class="why-tech-image py-3">
                    <i class="fa fa-cc-visa fa-2x"></i>
                </div>
                <div>
                    <h4>Visa support</h4>
                    <div class="why-choose-details">
                        <p>Our professional visa team are
                            expertsin Chinese and other
                            countries' visa policies. Every
                            teacher gets a personal visa
                            support team.</p>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-3">
                <div class="loyalty">
                <div class="why-tech-image py-3">
                    <i class="fa fa-hand-spock-o fa-2x"></i>
                </div>
                <div >
                    <h4>Loyalty</h4>
                    <div class="why-choose-details">
                        <p>We will help you every step of
                            the way. We've helped over 500
                            teacher start their adventure in
                            China.</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pb-3" id="videos">
        <div class="row">
            <div class="owl-carousel">

                <div class="item black">
                    <a href="#" class="video" data-video="https://www.youtube.com/embed/FxiskmF16gU" data-toggle="modal" data-target="#videoModal">
                        <img src="{{ asset('images/home/slider.PNG') }}" alt="1" />

                    </a>
                </div>
                <div class="item">
                    <a href="#" class="video" data-video="https://www.youtube.com/embed/FxiskmF16gU" data-toggle="modal" data-target="#videoModal">
                        <img src="{{ asset('images/home/slider.PNG') }}" alt="2" />

                    </a>
                </div>
                <div class="item black">
                    <a href="#" class="video" data-video="https://www.youtube.com/embed/FxiskmF16gU" data-toggle="modal" data-target="#videoModal">
                        <img src="{{ asset('images/home/slider.PNG') }}" alt="3" />

                    </a>
                </div>
                <div class="item">
                    <a href="#" class="video" data-video="https://www.youtube.com/embed/FxiskmF16gU" data-toggle="modal" data-target="#videoModal">
                        <img src="{{ asset('images/home/slider.PNG') }}" alt="4" />

                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <iframe width="100%" height="350" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
