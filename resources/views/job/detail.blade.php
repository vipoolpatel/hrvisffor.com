@extends('layouts.app')
@section('content')
   <!-- Header start -->
   @include('includes.header')
   <!-- Header end -->
   <!-- Inner Page Title start -->
   {{--@include('includes.inner_page_title', ['page_title'=>__('Job Detail')]) --}}
   <div class="page-title">
      <div class="container">
         <div class="searchform">
            <div class="row">
               <div class="col-md-3">
                  <h4 class="text-white p-0 m-0">Position Profile</h4>
               </div>
               <div class="col-md-9 text-right page-title-text">

               </div>
            </div>

         </div>
      </div>
   </div>
   <!-- Inner Page Title end -->
   @include('flash::message')
   {{-- @include('includes.inner_top_search') --}}
   @php
      $company = $job->getCompany();
   @endphp
   <style type="text/css">
      .line_height{
         line-height: normal;
      }
      .jbdetail li
      {
         border-bottom: 1px solid #ddd;
         margin-bottom: 0px;
         padding-top: 10px;
         padding-bottom: 10px;
         color: #000;
      }
      .img-grid {
         display: grid;
         grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
      }
      .img-grid img {
         width: 100%;
         height: 100px;
         padding: 6px;
      }
   </style>
   <div class="listpgWraper">
      <div class="container">
      @include('flash::message')
      <!-- Job Detail start -->
         <div class="row">
            <div class="col-lg-7">
               <!-- Job Header start -->
               <div class="job-header">
                  <div class="jobinfo">
                     <h2 class="text-uppercase">{{ !empty($job->getschooljoin->name) ? $job->getschooljoin->name : '' }}</h2>
                     <div class="ptext">{{__('Date Posted')}}: {{$job->created_at->format('M d, Y')}}</div>
                  </div>
                  <!-- Job Detail start -->
                  <div class="jobmainreq">
                     <div class="jobdetail">
                        <h3><span><img src="{{ asset('images/home/school.png') }}"></span> {{__('School Detail')}}</h3>
                        <ul class="jbdetail">
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__('Company ID')}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><a style="color: blue;" href="{{route('company.detail', $company->slug)}}" class="job-detail-title">{{$company->school_id}}</a></div>
                           </li>

                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__('School type')}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->getschooljoin->name) ? $job->getschooljoin->name : '' }}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__("Position type")}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->getworktype->name) ? $job->getworktype->name : '' }}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__('Location')}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{$job->getLocation()}}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__("General Location")}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->getteach->name) ? $job->getteach->name : '' }}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__("Native English Speaker required")}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{$job->r_english_speaker_id}}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__('Visa Type')}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->getvisa->name) ? $job->getvisa->name : '' }}</span></div>
                           </li>

                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__("Required boarding time")}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->getposition->name) ? $job->getposition->name : '' }}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__("Salary")}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->getexpectsalary->name) ? $job->getexpectsalary->name : '' }} {{ !empty($job->getmaxexpectsalary->name) ?' - '. $job->getmaxexpectsalary->name : '' }}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__("Working hours per week")}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->r_hour_id) ? $job->r_hour_id : '' }}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__("Working Schedule")}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->getworkingschedule->name) ? $job->getworkingschedule->name : '' }}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__("Class size")}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->r_class_size_id) ? $job->r_class_size_id : '' }}</span></div>
                           </li>
                           <li class="row">
                              <div class="col-md-4 col-xs-5 line_height">{{__("Age requirement")}}</div>
                              <div class="col-md-8 col-xs-7 line_height"><span class="permanent">{{ !empty($job->r_min_age_requirement_id) ? $job->r_min_age_requirement_id : '' }} to {{ !empty($job->r_max_age_requirement_id) ? $job->r_max_age_requirement_id : '' }} ysr</span></div>
                           </li>
                           @if(!empty($job->jobwelfare) && !empty(count($job->jobwelfare)))
                              <li class="row">
                                 <div class="col-md-4 col-xs-5 line_height">{{__("Benefits")}}</div>
                                 <div class="col-md-8 col-xs-7 line_height"><span class="permanent">
                              @foreach($job->jobwelfare as $welfare_id)
                                          {{ $welfare_id->getwelfare->name }} <br />
                                       @endforeach
                              </span>
                                 </div>
                              </li>
                           @endif
                        </ul>
                     </div>
                  </div>

                  <div class="jobdetialButtons">
                     <a href="{{route('email.to.friend', $job->slug)}}" class="btn"><i class="fa fa-envelope" aria-hidden="true"></i> {{__('Email to Friend')}}</a>
                     @if(Auth::check() && Auth::user()->isFavouriteJob($job->slug)) <a href="{{route('remove.from.favourite', $job->slug)}}" class="btn"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Favourite Job')}} </a> @else <a href="{{route('add.to.favourite', $job->slug)}}" class="btn"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Add to Favourite')}}</a> @endif
                     <a href="{{route('report.abuse', $job->slug)}}" class="btn report"><i class="fa fa-info-circle" aria-hidden="true"></i> {{__('Report Abuse')}}</a>
                  </div>
               </div>
               <!-- Job Description end -->
            </div>
            <!-- related jobs end -->
            <div class="col-lg-5">
               <div class="jobButtons applybox">
                  @if($job->isJobExpired())
                     <span class="jbexpire"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Job is expired')}}</span>
                  @elseif(Auth::check() && Auth::user()->isAppliedOnJob($job->id))
                     <a href="javascript:;" class="btn apply applied"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Already Applied')}}</a>
                  @else
                     <a href="{{route('apply.job', $job->slug)}}" class="btn apply"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Apply Interview')}}</a>
                     <a href="{{url('beijing-profile')}}" class="btn city-profile"><i class="fa fa-home" aria-hidden="true"></i> {{__('City Profile')}}</a>
                  @endif
               </div>
               <div class="companyinfo">
                  <h3 class="job-detail-title"> {{__('Company Overview')}}</h3>
                  <div class="title"><a href="{{route('company.detail',$company->slug)}}">{{$company->school_id}}</a></div>
                  <div class="ptext">{{$company->getLocation()}}</div>
                  <div class="opening">
                     <a style="color: #000;" href="{{route('company.detail',$company->slug)}}">
                        {{App\Company::countNumJobs('company_id', $company->id)}} {{__('Current Jobs Openings')}}
                     </a>
                  </div>
                  <div class="clearfix"></div>
                  <hr>
               </div>
               <div class="cityname">
                  <h3><span class="job-detail-title"> {{__('City Name-')}}</span><span style="color: #000;" class="job-detail-subtitle">{{ 'Beijing' }}</span></h3>
                  <div class="city-shor-des">
                     Lorem ipsum, or lipsum as it is sometimes known
                     is dummy text used in laying out print, graphic or
                     web designs. The passage is attributed to an
                     unknown typesetter in the 15th century who is
                     thought to have scrambled parts of Cicero's De
                     Finibus Bonorum et Malorum for.
                  </div>
                  <div class="clearfix"></div>
                  <hr>
               </div>
               <div class="school-env">
                  <div class="row">
                     <div class="col-md-12 col-xs-12 line_height text-center"><h3 style="color: #000;" class="job-detail-title">{{__("School environment")}}</h3></div>
                     <div class="col-md-12 col-xs-12 line_height">
                        @if(!empty($job) && !empty(count($job->jobschoolenvironment)))
                           <div class="img-grid">
                              @foreach($job->jobschoolenvironment as $jobschoolenvironment)
                                 <a href="{{ url('public/company/'.$jobschoolenvironment->image_name) }}" target="_blank">
                                    <img style="width: 100%;" src="{{ url('public/company/'.$jobschoolenvironment->image_name) }}">
                                 </a>
                              @endforeach
                           </div>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="accomodation">
                  <div class="row">
                     <div class="col-md-12 col-xs-12 line_height text-center"><h3 style="color: #000;" class="job-detail-title">{{__("Accommodation photo")}}</h3></div>
                     <div class="col-md-12 col-xs-12 line_height">
                        @if(!empty($job) && !empty(count($job->jobteachersaccommodation)))
                           <div class="img-grid">
                              @foreach($job->jobteachersaccommodation as $teachers_accommodation)
                                 <a href="{{ url('public/company/'.$teachers_accommodation->image_name) }}" target="_blank">
                                    <img alt="" style="width: 100%;" src="{{ url('public/company/'.$teachers_accommodation->image_name) }}">
                                 </a>
                              @endforeach
                           </div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row py-3">
            <div class="col-md-12">
               <h2 class="text-center" style="color: red;">Position Card</h2>
            </div>

         </div>
         <div class="row">
            <div class="col-md-8 mx-auto">
               <ul class="new-jobdetails">
                  <li>
                     <div class="row">
                        <div class="col-md-12 col-sm-12">
                           <div class="job-list">
                              <div class="job-img-title">
                                 {{-- <div class="job-img">{{$company->printCompanyImage()}}</div> --}}
                                 <div class="jobinfo">
                                    <div class="job-info-title pt-2" style="margin-left: 7px;">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4">
                                             <h3>{{ $company->school_id }} :
                                             </h3>
                                          </div>
                                          <div class="col-md-8 col-sm-8">
                                             <div class="job-main-title">
                                                <a href="{{route('job.detail', [$job->slug])}}" class="job-info-type"
                                                   title="{{$job->title}}" class="">{{!empty($job->getpositionlooking->name) ? $job->getpositionlooking->name : $job->title }} - {{ !empty($job->getworktype->name) ? $job->getworktype->name : '' }}</a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="companyName" style="margin-left: 7px;">
                                       <a href="{{route('company.detail', $company->slug)}}"
                                          title="">{{ !empty($job->getschooljoin->name) ? $job->getschooljoin->name : '' }}</a>
                                    </div>
                                    <div class="location px-2">
                                       <div class="address-area">
                                          {{$job->getLocation()}}:
                                          {{ !empty($job->getteach->name) ? $job->getteach->name : '' }}
                                       </div>
                                       <div class="salary-area-new">
                                          <div class="salary-text">SALARY:{{ !empty($job->getexpectsalary->name) ? $job->getexpectsalary->name : '' }} {{ !empty($job->getmaxexpectsalary->name) ?' - '. $job->getmaxexpectsalary->name : '' }}</div>
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
                                             <div class="row pt-3 pb-1">
                                                <div class="col-md-6 col-sm-6 col-6">Entry Time:</div>
                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($job->getposition->name) ? $job->getposition->name : '' }}</div>
                                             </div>
                                             <div class="row py-1">
                                                <div class="col-md-6 col-sm-6 col-6">Native English Speaker:</div>
                                                <div class="col-md-6 col-sm-6 col-6">{{$job->r_english_speaker_id}}</div>
                                             </div>
                                             <div class="row py-1">
                                                <div class="col-md-6 col-sm-6 col-6">Age requirement:</div>
                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($job->r_min_age_requirement_id) ? $job->r_min_age_requirement_id : '' }} to {{ !empty($job->r_max_age_requirement_id) ? $job->r_max_age_requirement_id : '' }} ysr</div>
                                             </div>
                                             <div class="row py-1">
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

                                                         <div class="listbtn" style="padding: 7px;"><a href="{{route('job.detail', [$job->slug])}}" class="view-details">View more</a>
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
               </ul>
            </div>
         </div>
      </div>
   </div>
   @include('includes.footer')
@endsection
@push('styles')
   <style type="text/css">
      .view_more{display:none !important;}
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
            if ($(this).height() > 100)
            {
               $(this).css('height', 100);
               $(this).css('overflow', 'hidden');
               //alert($( this ).next());
               $(this).next().removeClass('view_more');
            }
         });



      });
   </script>
@endpush
