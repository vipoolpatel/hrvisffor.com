<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/16/2020
 * Time: 1:58 AM
 */
?>
@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!--StartBanner-->
    <div class="beijing-bg">
        <div class="beijing-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="beijing-title">
                        <h2>Work in Beijing</h2>
                            as an English Teacher
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--EndBanner-->
    <!-- More City -->
    <div class="more-city-bg">
        <div class="container py-5">
            <div class="row">


                    <div class="col-md-8">
                        <h2>Know About Our More <span class="card-sub">City in China</span></h2>
                    </div>
                <div class="col-md-4">
                    <div class="form-group has-search input-group">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-warning text-white" type="button">
                                Search
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="">
                <div class="carousel-wrap">
                    <div class="owl-carousel2 owl-carousel owl-theme">
                        <div class="item">
                            <div class="beijing-img">
                                <img src="{{ asset('images/home2/low-angle-photo-of-temple-1581555.png') }}">
                                <div class="image-grid-clickbox">
                                    <div class="beijing-over-text">
                                        <h4 class="beijing-title-slider">Beijing</h4>

                                         <a href="#" class="beijing-view">View</a>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="beijing-img">
                                <img src="{{ asset('images/home2/architecture-building-campus-clark-hall-207684.png') }}">
                            <div class="image-grid-clickbox">
                                <div class="beijing-over-text">
                                    <h4 class="beijing-title-slider">Beijing</h4>

                                    <a href="#" class="beijing-view">View</a>
                                </div>

                                </div>
                            </div>

                        </div>
                        <div class="item"> <div class="beijing-img">
                                <img src="{{ asset('images/home2/brown-black-and-grey-building-under-cumulus-clouds-207729.png') }}">
                            <div class="image-grid-clickbox">
                                <div class="beijing-over-text">
                                    <h4 class="beijing-title-slider">Beijing</h4>

                                    <a href="#" class="beijing-view">View</a>

                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="item"> <div class="beijing-img"><img src="{{ asset('images/home2/administration-ancient-architecture-art-208603.png') }}">

                            <div class="image-grid-clickbox">
                                <div class="beijing-over-text">
                                    <h4 class="beijing-title-slider">Beijing</h4>

                                    <a href="#" class="beijing-view">View</a>


                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end More city-->
    <!-- About Beijing -->
    <div class="about-beijing">
        <div class="container py-5">
            <div class="row">

                <div class="col-md-7">
                    <h2>About  <span class="card-sub">Beijing</span></h2>
                    <div class="py-3">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisc<br>
                        ing elit, sed do eiusmod tempor on</p>
                    <p class="py-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat. fugiat nulla pariatur. Excepteur sint </p>
                    </div>
                </div>
                <div class="col-md-5">
                    <img src="{{ asset('images/home2/brown-and-red-temple-2915957.png') }}">
                </div>
            </div>
        </div>
    </div>
    <!-- end About Beijing -->
    <!-- Teach Beijing -->
    <div class="teach-beijing">
        <div class="container py-5">
            <div class="row">


                <div class="col-md-5">
                    <img src="{{ asset('images/home2/Frame.png') }}" class="img-fluid">
                </div>
                <div class="col-md-7 py-5">
                    <h2>Teach in <span class="card-sub">Beijing</span></h2>
                    <div class="py-3">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisc<br>
                        ing elit, sed do eiusmod tempor on</p>
                    <p class="py-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat. fugiat nulla pariatur. Excepteur sint </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Teach Beijing -->
    <!-- Living Beijing -->
    <div class="teach-beijing">
        <div class="container pt-5">
            <div class="row">
            <div class="col-md-12 text-center">
                <h2>Living cost in <span class="card-sub">Beijing</span></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br />
                    tempor on Lorem ipsum dolor sit amet, consectetur</p>
            </div>
            </div>
        </div>
        <div class="container-fluid my-4">
            <div class="card-columns">
                <div class="card border-0 text-white"> <img src="{{ asset('images/home2/10980.png') }}" alt="" class="imgal-img">
                    <div class="card-img-overlay p-0">
                        <div class="card-block">
                            <h5 class="card-title">City Bus 12 RMB/KM<a class="stretched-link" href="#"></a></h5>
                            <p class="card-text"></p><small class="text-mutted"></small>
                        </div>
                    </div>
                </div>
                <div class="card border-0 text-white"> <img src="{{ asset('images/home2/new-york-street-cabs-taxis-8247.png') }}" alt="" class="imgal-img">
                    <div class="card-img-overlay p-0">
                        <div class="card-block">
                            <h5 class="card-title"><a class="stretched-link" href="#"></a></h5>
                            <p class="card-text"></p><small class="text-mutted"></small>
                        </div>
                    </div>
                </div>
                <div class="card border-0 text-white"><img src="{{ asset('images/home2/man-riding-bicycle-on-city-street-310983.png') }}" alt="" class="imgal-img">
                    <div class="card-img-overlay p-0">
                        <div class="card-block">
                            <h5 class="card-title">Ebike 12 RMB/KM<a class="stretched-link" href="#"></a></h5>
                            <p class="card-text"></p><small class="text-mutted"></small>
                        </div>
                    </div>
                </div>
                <div class="card border-0 text-white"> <img src="{{ asset('images/home2/apartment-bed-bedroom-chair-271624.png') }}" alt="" class="imgal-img">
                    <div class="card-img-overlay p-0">
                        <div class="card-block">
                            <h5 class="card-title">Card title four<a class="stretched-link" href="#"></a></h5>
                            <p class="card-text"></p><small class="text-mutted"></small>
                        </div>
                    </div>
                </div>
                <div class="card border-0 text-white"> <img src="{{ asset('images/home2/architecture-chairs-city-commuter-302428.png') }}" alt="" class="imgal-img">
                    <div class="card-img-overlay p-0">
                        <div class="card-block">
                            <h5 class="card-title">Card title five<a class="stretched-link" href="#"></a></h5>
                            <p class="card-text"></p><small class="text-mutted"></small>
                        </div>
                    </div>
                </div>
                <div class="card border-0 text-white"> <img src="{{ asset('images/home2/architecture-chairs-city-commuter-302428.png') }}" alt="" class="imgal-img">
                    <div class="card-img-overlay p-0">
                        <div class="card-block">
                            <h5 class="card-title">Card title six<a class="stretched-link" href="#"></a></h5>
                            <p class="card-text"></p><small class="text-mutted"></small>
                        </div>
                    </div>
                </div>
                <div class="card border-0 text-white"><img src="{{ asset('images/home2/apartment-bed-bedroom-chair-271624.png') }}" alt="" class="imgal-img">
                    <div class="card-img-overlay p-0">
                        <div class="card-block">
                            <h5 class="card-title">Card title seven<a class="stretched-link" href="#"></a></h5>
                            <p class="card-text"></p><small class="text-mutted"></small>
                        </div>
                    </div>
                </div>
                <div class="card border-0 text-white"> <img src="{{ asset('images/home2/man-riding-bicycle-on-city-street-310983.png') }}" alt="" class="imgal-img">
                    <div class="card-img-overlay p-0">
                        <div class="card-block">
                            <h5 class="card-title">Card title eight<a class="stretched-link" href="#"></a></h5>
                            <p class="card-text"></p><small class="text-mutted"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- end Living Beijing -->
    <!-- Climate Beijing -->
    <div class="climate-beijing">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12  text-center">
                    <h2>Climate in <span class="card-sub">Beijing</span></h2>
                </div>
            </div>

            <div class="row py-3">

                <div class="col-md-8 mx-auto">
                    <div class="climate-bg">
                    <table class="table">
                        <thead class="climate-tbl-head">
                        <tr>
                            <th scope="col">Months</th>
                            <th scope="col">Low-High(C)</th>
                            <th scope="col">Rain</th>
                            <th scope="col">Strom</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">January </th>
                            <td>-4 C - 16 C</td>
                            <td>1 day</td>
                            <td>1 day</td>
                        </tr>
                        <tr>
                            <th scope="row">January </th>
                            <td>-4 C - 16 C</td>
                            <td>1 day</td>
                            <td>1 day</td>
                        </tr>
                        <tr>
                            <th scope="row">January </th>
                            <td>-4 C - 16 C</td>
                            <td>1 day</td>
                            <td>1 day</td>
                        </tr>
                        <tr>
                            <th scope="row">January </th>
                            <td>-4 C - 16 C</td>
                            <td>1 day</td>
                            <td>1 day</td>
                        </tr>
                        <tr>
                            <th scope="row">January </th>
                            <td>-4 C - 16 C</td>
                            <td>1 day</td>
                            <td>1 day</td>
                        </tr>
                        <tr>
                            <th scope="row">January </th>
                            <td>-4 C - 16 C</td>
                            <td>1 day</td>
                            <td>1 day</td>
                        </tr>
                        <tr>
                            <th scope="row">January </th>
                            <td>-4 C - 16 C</td>
                            <td>1 day</td>
                            <td>1 day</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end Climate Beijing -->
    @include('includes.footer')
@endsection
@push('scripts')
    <!--Map-->

        <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/mapdata/custom/world-palestine-highres.js"></script>

    <!--End Map-->
    <script>
        $(document).ready(function ($) {
            $('.lazy').Lazy();
            $("form").submit(function () {
                $(this).find(":input").filter(function () {
                    return !this.value;
                }).attr("disabled", "disabled");
                return true;
            });
            $("form").find(":input").prop("disabled", false);
        });


        $(function() {
            $(".video").click(function () {
                var theModal = $(this).data("target"),
                    videoSRC = $(this).attr("data-video"),
                    videoSRCauto = videoSRC + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1";
                $(theModal + ' iframe').attr('src', videoSRCauto);
                $(theModal + ' button.close').click(function () {
                    $(theModal + ' iframe').attr('src', videoSRC);
                });
            });
        });


        $('.owl-carousel2').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navText: [
                "<i class='fa fa-arrow-circle-o-right'></i>",
                "<i class='fa fa-caret-right'></i>"
            ],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })


    </script>
    @include('includes.country_state_city_js')
    <style>
        .card-columns {
            -webkit-column-count: 1;
            -moz-column-count: 1;
            column-count: 1;
        }
        @media (min-width: 768px) {
            .card-columns {
                -webkit-column-count: 2;
                -moz-column-count: 2;
                column-count: 2;
            }
        }
        @media (min-width: 1200px) {
            .card-columns {
                -webkit-column-count: 4;
                -moz-column-count: 4;
                column-count: 4;
            }
        }

        .card-img-overlay .card-block {
            position: absolute;

            right: 0;
            bottom: 0;
            left: 0;
            padding: 1.25rem;
            z-index: 1;
        }
        .card-img-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 0;
            background-color: rgba(28, 46, 76, 0.8);
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }
        .card-img-overlay:hover::after {
            background-color: rgba(28, 46, 76, 0.2);
        }
    </style>
@endpush
