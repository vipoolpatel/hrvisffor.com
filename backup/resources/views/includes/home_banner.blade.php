<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/12/2020
 * Time: 12:04 PM
 */
?>
<section class="home-banner">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6">
                <div class="banner-text">
                    <div class="welcome">
                        <span>Welcome</span>
                    </div>
                    <div class="banner-title">
                        <h2> Work in China as an <br/>
                            English Teacher
                        </h2>
                    </div>
                    <div class="banner-btn-area">
                        <a href="{{url('/jobs')}}" class="banner-white-btn">View Chinese School</a>
                        <a href="{{url('/job-seekers')}}" class="banner-green-btn">View English Teacher</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="banner-image">
                <img src="{{ asset('images/home/7_Web Design V1.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
