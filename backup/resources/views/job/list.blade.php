@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <style type="text/css">
        .jobimg img {
            height: 100px;
            width: : 100px;
        }
        .pb-3, .py-3 {
            padding-bottom: 0rem !important;
        }
        .searchList {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(50%, 1fr));
            /*grid-gap: 1%;*/
        }
        .searchList li{
            margin: 10px;
        }
        @media (max-width: 768px){
            .searchList {
                grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
            }
        }
    </style>
    <!-- Inner Page Title start -->
    {{--@include('includes.inner_page_title', ['page_title'=>__('Job Listing')])--}}
    @include('flash::message')
    {{-- @include('includes.inner_top_search') --}}
    {{--
    <form action="{{route('job.list')}}" method="get">
       --}}
    <!-- Page Title start -->
    <div class="page-title">
        <div class="container">
            <div class="searchform">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="text-white p-0 m-0">Matched Job list</h4>
                    </div>
                    <div class="col-md-9 text-right">
                        If you can't find many positions, try to change conditions in your profile to get more job opportunities.
                    </div>
                </div>
                {{--
                <div class="row">
                   <div class="col-lg-9">
                      <select class="form-control" name="position_looking_id">
                         <option value="">Select Job Title</option>
                         @foreach($getPositionLooking as $value)
                         <option {{ (Request()->position_looking_id == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                         @endforeach
                      </select>
                   </div>
                   <div class="col-lg-3">
                      <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i> {{__('Search Jobs')}}</button>
                   </div>
                </div>
                --}}
            </div>
        </div>
    </div>
    <!-- Page Title end -->
    {{--
 </form>
 --}}
    {{--<div class="container py-3">
        <div class="row">
            <div class="col-md-6">
                <div class="find-map-text">
                    <h2>Find your favourite <br />
                        location <span>on China map</span></h2>
                    <p>Choose a location click on the map you will see your<br />
                        perfect matched job list and school.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div id="container"></div>
            </div>
        </div>
    </div>--}}
    <!-- Inner Page Title end -->
    <div class="listpgWraper-job">
        <div class="container-fluid">
            <form action="{{route('job.list')}}" method="get">
                <!-- Search Result and sidebar start -->
                <div class="row">
                    {{-- @include('includes.job_list_side_bar') --}}
                    <div class="col-lg-12 col-sm-12">
                        <!-- Search List -->
                        <ul class="new-searchList">
                            <!-- job start -->
                            @if(isset($jobs) && count($jobs))  @foreach($jobs as $job) @php
                                $company = $job->getCompany();  @endphp
                            <?php if(isset($company))
                            {
                            ?>

                            <li>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="job-list">
                                            <div class="job-img-title">
                                                {{-- <div class="job-img">{{$company->printCompanyImage()}}</div> --}}
                                                <div class="jobinfo">
                                                    <div class="job-info-title pt-2" style="margin-left: 7px;">
                                                        <div class="row">
                                                            <div class="col-md-7 col-sm-7" style="padding-right: 0px;">
                                                                <h3>{{ $company->school_id }} 
                                                                    @if(!empty(Auth::guard('admin')->user()->id))
                                                                    - {{ $company->name }} 
                                                                    @endif
                                                                </h3>
                                                            </div>
                                                            <div class="col-md-5 col-sm-5">
                                                                <div class="job-main-title">
                                                                    <a href="{{route('job.detail', [$job->slug])}}" class="job-info-type"
                                                                       title="{{$job->title}}" class="">{{!empty($job->getpositionlooking->name) ? $job->getpositionlooking->name : $job->title }} - {{ !empty($job->getworktype->name) ? $job->getworktype->name : '' }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="companyName" style="margin-left: 7px;">
                                                        <a href="{{ url('job/'.$job->slug) }}"
                                                           title="">{{ !empty($job->getschooljoin->name) ? $job->getschooljoin->name : '' }}</a>
                                                    </div>
                                                    <div class="location px-2">
                                                        <div class="address-area">
                                                            {{$job->getLocation()}}:
                                                            {{ !empty($job->getteach->name) ? $job->getteach->name : '' }}
                                                        </div>
                                                        <div class="salary-area-new">
                                                            <div class="salary-text">SALARY:{{ !empty($job->getexpectsalary->name) ? $job->getexpectsalary->name : '' }}</div>
                                                        </div>
                                                        {{--<label class="fulltime"
                                                           title="{{$job->getJobType('job_type')}}">{{$job->getJobType('job_type')}}</label>
                                                        - <span>{{$job->getCity('city')}}</span>--}}
                                                    </div>
                                                </div>
                                                {{--
                                                <p>{{str_limit(strip_tags($job->description), 150, '...')}}</p>
                                                --}}
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                            <div class="job-info-details-area px-2 pb-3">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="job-requirement-area">
                                                            <div class="requirement-title pt-3">REQUIREMENTS:</div>
                                                            <div class="requirement-list">
                                                                <div class="row py-3">
                                                                    <div class="col-md-6 col-sm-6 col-6">Entry Time:</div>
                                                                    <div class="col-md-6 col-sm-6 col-6">{{ !empty($job->getposition->name) ? $job->getposition->name : '' }}</div>
                                                                </div>
                                                                <div class="row py-3">
                                                                    <div class="col-md-6 col-sm-6 col-6">Native English Speaker:</div>
                                                                    <div class="col-md-6 col-sm-6 col-6">{{$job->r_english_speaker_id}}</div>
                                                                </div>
                                                                <div class="row py-3">
                                                                    <div class="col-md-6 col-sm-6 col-6">Age requirement:</div>
                                                                    <div class="col-md-6 col-sm-6 col-6">{{ !empty($job->r_min_age_requirement_id) ? $job->r_min_age_requirement_id : '' }} to {{ !empty($job->r_max_age_requirement_id) ? $job->r_max_age_requirement_id : '' }} ysr</div>
                                                                </div>
                                                                <div class="row py-3">
                                                                    <div class="col-md-6 col-sm-6 col-6">Visa requirement:</div>
                                                                    <div class="col-md-6 col-sm-6 col-6">{{ !empty($job->getvisa->name) ? $job->getvisa->name : '' }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            @if(!empty($job) && !empty(count($job->jobschoolenvironment)))
                                                                <div class="img-grid">
                                                                    @foreach($job->jobschoolenvironment as $key=>$jobschoolenvironment)
                                                                        @if($key < 3 )
                                                                            <div class="job-list-image">
                                                                                <a href="{{ url('public/company/'.$jobschoolenvironment->image_name) }}" target="_blank">
                                                                                    {{--<img style="width: 100%;" src="{{ url('public/company/'.$jobschoolenvironment->image_name) }}">--}}
                                                                                    <img src="{{ url('public/company/'.$jobschoolenvironment->image_name) }}" style="width: 100%; height: 85px;">
                                                                                </a>
                                                                            </div>
                                                                            @if($key==2)
                                                                                <div class="clearfix"></div>
                                                                                <div class="listbtn"><a href="{{route('job.detail', [$job->slug])}}" class="view-details">View more</a>
                                                                                </div>
                                                                            @endif

                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 p-2 col-sm-6">
                                                        <div class="job-details-area">
                                                            <div class="requirement-title">DETAILS:</div>
                                                            <div class="job-details-list-area">
                                                                <ul>
                                                                    <li><div class="row pt-3">
                                                                            <div class="col-md-7 col-sm-7 col-7">
                                                                                Class size for teacher:</div>
                                                                            <div class="col-md-5 col-sm-5 col-5">
                                                                                {{ !empty($job->r_class_size_id) ? $job->r_class_size_id : '' }}
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li><div class="row py-1">
                                                                            <div class="col-md-7 col-sm-7 col-7">Working hours per week:</div>
                                                                            <div class="col-md-5 col-sm-5 col-5"> {{ !empty($job->r_hour_id) ? $job->r_hour_id : '' }}</div></div></li>
                                                                    <li><div class="row py-1">
                                                                            <div class="col-md-7 col-sm-7 col-7">Working time:</div>
                                                                            <div class="col-md-5 col-sm-5 col-5"> {{ !empty($job->getworkingschedule->name) ? $job->getworkingschedule->name : '' }}</div></div></li>
                                                                    <li>
                                                                        <div class="row py-1">
                                                                            <div class="col-md-7 col-sm-7 col-7">Welfare:</div>  @foreach($job->jobwelfare as $key=>$welfare_id)
                                                                                @if($key==0)
                                                                                    <span class="text-right">{{ $welfare_id->getwelfare->name }}</span><br />
                                                                                @else
                                                                                    <div class="col-md-12"> {{ $welfare_id->getwelfare->name }} </div><br />
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 pl-0">

                                        {{--
                                        <div class="listbtn">
                                           <a href="{{route('job.detail', [$job->slug])}}">{{__('View Details')}}</a>
                                        </div>
                                        --}}
                                    </div>
                                </div>
                            </li>
                        <?php }
                        ?>
                        <!-- job end -->
                        @endforeach
                        @endif
                        <!-- job end -->
                        </ul>
                        <!-- Pagination Start -->
                        <div class="pagiWrap">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="showreslt">
                                        {{__('Showing Pages')}} : {{ $jobs->firstItem() }}
                                        - {{ $jobs->lastItem() }} {{__('Total')}} {{ $jobs->total() }}
                                    </div>
                                </div>
                                <div class="col-md-7 text-right">
                                    @if(isset($jobs) && count($jobs))
                                        {{ $jobs->appends(request()->query())->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Pagination end -->
                    </div>
                    {{--
                    <div class="col-lg-3 col-sm-6 pull-right">
                       <!-- Sponsord By -->
                       <div class="sidebar">
                          <h4 class="widget-title">{{__('Sponsord By')}}</h4>
                          <div class="gad">{!! $siteSetting->listing_page_vertical_ad !!}</div>
                       </div>
                    </div>
                    --}}
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="show_alert" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form id="submit_alert">
                    @csrf
                    <input type="hidden" name="search" value="{{ Request::get('search') }}">
                    <input type="hidden" name="country_id"
                           value="@if(isset(Request::get('country_id')[0])) {{ Request::get('country_id')[0] }} @endif">
                    <input type="hidden" name="state_id"
                           value="@if(isset(Request::get('state_id')[0])){{ Request::get('state_id')[0] }} @endif">
                    <input type="hidden" name="city_id"
                           value="@if(isset(Request::get('city_id')[0])){{ Request::get('city_id')[0] }} @endif">
                    <input type="hidden" name="functional_area_id"
                           value="@if(isset(Request::get('functional_area_id')[0])){{ Request::get('functional_area_id')[0] }} @endif">
                    <div class="modal-header">
                        <h4 class="modal-title">Job Alert</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h3>Get the latest <strong>{{ ucfirst(Request::get('search')) }}</strong>
                            jobs @if(Request::get('location')!='') in
                            <strong>{{ ucfirst(Request::get('location')) }}</strong>@endif sent straight to your inbox
                        </h3>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email"
                                   placeholder="Enter your Email"
                                   value="@if( Auth::check() ) {{Auth::user()->email}} @endif">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
@push('styles')
    <style type="text/css">
        .searchList li .jobimg {
            min-height: 80px;
        }
        .hide_vm_ul {
            height: 100px;
            overflow: hidden;
        }
        .hide_vm {
            display: none !important;
        }
        .view_more {
            cursor: pointer;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/mapdata/countries/cn/cn-all.js"></script>

    <script>
        $('.btn-job-alert').on('click', function () {

            $('#show_alert').modal('show');

        })

        $(document).ready(function ($) {

            $("form").submit(function () {

                $(this).find(":input").filter(function () {

                    return !this.value;

                }).attr("disabled", "disabled");

                return true;

            });

            $("form").find(":input").prop("disabled", false);


            $(".view_more_ul").each(function () {

                if ($(this).height() > 100) {

                    $(this).addClass('hide_vm_ul');

                    $(this).next().removeClass('hide_vm');

                }

            });

            $('.view_more').on('click', function (e) {

                e.preventDefault();

                $(this).prev().removeClass('hide_vm_ul');

                $(this).addClass('hide_vm');

            });


        });

        if ($("#submit_alert").length > 0) {

            $("#submit_alert").validate({


                rules: {

                    email: {

                        required: true,

                        maxlength: 5000,

                        email: true

                    }

                },

                messages: {

                    email: {

                        required: "Email is required",

                    }


                },

                submitHandler: function (form) {

                    $.ajaxSetup({

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        }

                    });

                    $.ajax({

                        url: "{{route('subscribe.alert')}}",

                        type: "GET",

                        data: $('#submit_alert').serialize(),

                        success: function (response) {

                            $("#submit_alert").trigger("reset");

                            $('#show_alert').modal('hide');

                            swal({

                                title: "Success",

                                text: response["msg"],

                                icon: "success",

                                button: "OK",

                            });

                        }

                    });

                }

            })

        }
        var data = [
            ['cn-3664', 1000],
            ['cn-gd', 341],
            ['cn-sh', 223],
            ['cn-zj', 232],
            ['cn-ha', 223],
            ['cn-xz', 123],
            ['cn-yn', 356],
            ['cn-ah', 176],
            ['cn-hu', 155],
            ['cn-sa', 146],
            ['cn-cq', 130],
            ['cn-gz', 133],
            ['cn-hn', 132],
            ['cn-sc', 122],
            ['cn-sx', 111],
            ['cn-he', 115],
            ['cn-jx', 116],
            ['cn-nm', 117],
            ['cn-gx', 111],
            ['cn-hl', 119],
            ['cn-fj', 210],
            ['cn-bj', 111],
            ['cn-hb', 212],
            ['cn-ln', 231],
            ['cn-sd', 214],
            ['cn-tj', 215],
            ['cn-js', 126],
            ['cn-qh', 117],
            ['cn-gs', 118],
            ['cn-xj', 119],
            ['cn-jl', 310],
            ['cn-nx', 301]
        ];

        // Create the chart
        Highcharts.mapChart('container', {
            chart: {
                map: 'countries/cn/cn-all'
            },
            legend:{ enabled:false },
            title: {
                text: ''
            },

            subtitle: {
                text: ''
            },

            mapNavigation: {
                enabled: false,
                buttonOptions: {
                    verticalAlign: 'bottom'

                }
            },
            exporting: {
                buttons: {
                    contextButton: {
                        enabled: false
                    }
                }
            },

            colorAxis: {
                min: 0
            },

            series: [{
                data: data,
                name: 'School List',
                states: {
                    hover: {
                        color: '#BADA55'
                    }
                },
                dataLabels: {
                    enabled: false,
                    format: '{point.name}'
                }
            }]
        });

    </script>
    @include('includes.country_state_city_js')
@endpush
