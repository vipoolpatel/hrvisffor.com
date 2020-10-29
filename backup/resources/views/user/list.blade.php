@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    {{--@include('includes.inner_page_title', ['page_title'=>__('Job Seekers')])--}}
    <!-- Inner Page Title end -->

    @include('flash::message')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="text-white p-0 m-0">
                        @if(!empty($getJobData) && !empty($getJobData->company->name))
                            <a target="_blank" style="color: #fff" href="{{ url('job/'.$getJobData->slug) }}">{{ $getJobData->company->name }}</a> 
                            <a target="_blank" href="{{ url('admin/edit-job/'.$getJobData->id) }}" style="color: #fff;margin-left: 12px;"><i class="fa fa-edit"></i></a>
                        @else
                            Teacher list
                        @endif
                    </h4>
                </div>
                <div class="col-md-8 text-right">
                    If yo can't find many teacher, pleas try to change your requirements in jobs details. Only matched teachers will show here
                </div>
            </div>

        </div>
    </div>
    {{--<form action="{{route('job.seeker.list')}}" method="get">
        <!-- Page Title start -->
        <div class="pageSearch">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2">
                        @if(Auth::guard('company')->check())
                            <a href="{{ route('post.job') }}" class="btn"><i class="fa fa-file-text"
                                                                             aria-hidden="true"></i> {{__('Post Job')}}
                            </a>
                        @else
                            <a href="{{url('my-profile#cvs')}}" class="btn"><i class="fa fa-file-text"
                                                                               aria-hidden="true"></i> {{__('Upload Your Resume')}}
                            </a>
                        @endif

                    </div>
                    <div class="col-lg-10">
                        <div class="searchform">
                            <div class="row">
                                <div class="col-md-{{((bool)$siteSetting->country_specific_site)? 5:3}}">
                                    <input type="text" name="search" value="{{Request::get('search', '')}}"
                                           class="form-control"
                                           placeholder="{{__('Enter Skills or job seeker details')}}"/>
                                </div>
                                <div class="col-md-2"> {!! Form::select('functional_area_id[]', ['' => __('Select Functional Area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')) !!} </div>


                                @if((bool)$siteSetting->country_specific_site)
                                    {!! Form::hidden('country_id[]', Request::get('country_id[]', $siteSetting->default_country_id), array('id'=>'country_id')) !!}
                                @else
                                    <div class="col-md-2">
                                        {!! Form::select('country_id[]', ['' => __('Select Country')]+$countries, Request::get('country_id', $siteSetting->default_country_id), array('class'=>'form-control', 'id'=>'country_id')) !!}
                                    </div>
                                @endif

                                <div class="col-md-2">
                                    <span id="state_dd">
                                        {!! Form::select('state_id[]', ['' => __('Select State')], Request::get('state_id', null), array('class'=>'form-control', 'id'=>'state_id')) !!}
                                    </span>
                                </div>
                                <div class="col-md-2">
                                    <span id="city_dd">
                                        {!! Form::select('city_id[]', ['' => __('Select City')], Request::get('city_id', null), array('class'=>'form-control', 'id'=>'city_id')) !!}
                                    </span>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Title end -->
    </form>--}}



    <div class="listpgWraper-job">
        <div class="container-fluid">

            <form action="{{route('job.seeker.list')}}" method="get">
                <!-- Search Result and sidebar start -->
                <div class="row"> {{--@include('includes.job_seeker_list_side_bar')--}}
                    <div class="col-lg-12">
                        <!-- Search List -->
                        <ul class="jobsearchList">
                            <!-- job start -->
                            @if(isset($jobSeekers) && count($jobSeekers))

                                @foreach($jobSeekers as $jobSeeker)

                                    <li>
                                        <div class="job-seeker p-4">
                                            <div class="row">
                                                <div class="col-lg-54 col-md-5 pl-0 col-sm-5">

                                                    <div class="jobimg job-seeker-img">
                                                        {{$jobSeeker->printUserImage(120, 150)}}</div>
                                                    <h6 class="text-white pt-3" >ID: {{$jobSeeker->rule_id}}</h6>
                                                    <h4 class="job-seeker-title">
                                                        <a style="color: #fff;" href="{{route('user.profile', $jobSeeker->id)}}">{{$jobSeeker->first_name}}</a>
                                                    </h4>
                                                    @if(!empty($jobSeeker->getProfileSummary('summary')))
                                                        <div class="seeker-bio">Bio:

                                                            {{str_limit($jobSeeker->getProfileSummary('summary'),150,'...')}}

                                                            {{-- @if(!empty($jobSeeker->userwelfare))

                                                                 @foreach($jobSeeker->userwelfare as $value)
                                                                     {{ $value->getwelfare->name }} <br/>
                                                                 @endforeach

                                                             @endif--}}{{--{{str_limit($jobSeeker->getProfileSummary('summary'),150,'...')}}--}}
                                                        </div>
                                                    @endif
                                                    {{--<div class="listbtn">
                                                        <a href="{{route('user.profile', $jobSeeker->id)}}">{{__('View Profile')}}</a>
                                                    </div>--}}
                                                    {{--<p>
                                                        @if(!empty($jobSeeker->chinese_visa_are_you_holding))
                                                            <span>{{__("Any type of Chinese visa are you holding now? And when it expired?")}}</span>
                                                            <span class="text text-success">{{ $jobSeeker->chinese_visa_are_you_holding }}</span>

                                                        @endif
                                                    </p>
                                                    <p>
                                                        @if(!empty($jobSeeker->online_interview))
                                                            <span>{{__("When will you be available to attend the online interview?")}}</span>
                                                            <span class="text text-success">{{ $jobSeeker->online_interview }}</span>

                                                        @endif
                                                    </p>--}}
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-7">
                                                    <div class="jobinfo job-seeker-list">

                                                        <div class="job-seeker-details pt-3">
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Age:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ (!empty($jobSeeker->r_age_id)?$jobSeeker->r_age_id:'N/A') }}
                                                                </div>

                                                            </div>
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Nationality:</div>
                                                                <div class="col-md-6 col-sm-6 col-6"> {{ (!empty($jobSeeker->getnationality->nationality)?$jobSeeker->getnationality->nationality:'') }}
                                                                </div>

                                                            </div>
                                                            {{--  <div class="row job-seeker-pad">
                                                                 <div class="col-md-6 col-sm-6 col-6">
                                                                     Native English Speaker:
                                                                 </div>
                                                                 <div class="col-md-6 col-sm-6 col-6">  @if(!empty($jobSeeker->r_english_speaker_id))
                                                                         {{ $jobSeeker->r_english_speaker_id }}

                                                                     @endif</div>
                                                             </div> --}}
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Degree:</div>

                                                                <div class="col-md-6 col-sm-6 col-6">@if(!empty($jobSeeker->gethighesteducation->name))
                                                                        {{ $jobSeeker->gethighesteducation->name }}
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                            Current Location:
                                                                </div>

                                                                    <div class="col-md-6 col-sm-6 col-6">
                                                                        {{ !empty($jobSeeker->getcurrentlocatioin->name)?$jobSeeker->getcurrentlocatioin->name:'' }}
                                                                    </div>
                                                            </div> --}}
                                                            {{-- <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Graduated  two years or more:</div>

                                                                    <div class="col-md-6 col-sm-6 col-6">@if(!empty($jobSeeker->r_graduated_id))
                                                                    {{ $jobSeeker->r_graduated_id }}

                                                                        @endif</div>
                                                            </div>
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Position:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($jobSeeker->getpositionlooking->name)?$jobSeeker->getpositionlooking->name:'' }}</div>
                                                            </div>

                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Type of work:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($jobSeeker->getworktype->name)?$jobSeeker->getworktype->name:'' }}</div>
                                                            </div> --}}


                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Arrival time: </div>
                                                                <div class="col-md-6 col-sm-6 col-6">@if(!empty($jobSeeker->getposition->name))
                                                                        {{ $jobSeeker->getposition->name }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Expected Salary: </div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($jobSeeker->getexpectsalary->name) ? $jobSeeker->getexpectsalary->name : '' }} {{ !empty($jobSeeker->getexpectsalarymax->name) ?  ' - '.$jobSeeker->getexpectsalarymax->name : '' }}</div>

                                                            </div>

                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Expected Working Location:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($jobSeeker->getCity('city')) ? $jobSeeker->getCity('city') : '' }} {{ !empty($jobSeeker->getState('state')) ? ' '.$jobSeeker->getState('state') : '' }}</div>
                                                            </div>

                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Expected General Location:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($jobSeeker->userteach->name)?$jobSeeker->userteach->name:'N/A' }}</div>
                                                            </div>


                                                            {{-- <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Expected type of school:</div>
                                                                @if(!empty(count($jobSeeker->userschooljoin)) && !empty($jobSeeker->userschooljoin))
                                                                    @foreach($jobSeeker->userschooljoin as $key=>$value)
                                                                        @if(!empty($value->getschool->name))
                                                                            @if($key==0)
                                                                                <div class="col-md-6 col-sm-6 col-6">{{ $value->getschool->name }}</div> <br/>
                                                                            @else
                                                                                <div class="col-md-12 py-1">{{ $value->getschool->name }}</div>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach


                                                                @endif
                                                            </div> --}}
                                                        </div>
                                                        {{--<div class="location"> {{$jobSeeker->getLocation()}}</div>--}}
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>

                                            </div>

                                        </div>
                                    </li>
                                    <!-- job end -->
                                @endforeach
                            @endif
                        </ul>

                        <!-- Pagination Start -->
                        <div class="pagiWrap">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="showreslt">
                                        {{__('Showing Pages')}} : {{ $jobSeekers->firstItem() }}
                                        - {{ $jobSeekers->lastItem() }} {{__('Total')}} {{ $jobSeekers->total() }}
                                    </div>
                                </div>
                                <div class="col-md-7 text-right">
                                    @if(isset($jobSeekers) && count($jobSeekers))
                                        {{ $jobSeekers->appends(request()->query())->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Pagination end -->
                        {{--<div class=""><br/>{!! $siteSetting->listing_page_horizontal_ad !!}</div>--}}

                    </div>
                    {{--<div class="col-lg-3">
                        <!-- Sponsord By -->
                        <div class="sidebar">
                            <h4 class="widget-title">{{__('Sponsord By')}}</h4>
                            <div class="gad">{!! $siteSetting->listing_page_vertical_ad !!}</div>
                        </div>
                    </div>--}}
                </div>
            </form>
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
    <script>
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
    </script>
    @include('includes.country_state_city_js')
@endpush