@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
{{--@include('includes.inner_page_title', ['page_title'=>__($page_title)]) --}}
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-white p-0 m-0">Teacher Profile</h4>
            </div>
            <div class="col-md-9 text-right page-title-text">

            </div>
        </div>

    </div>
</div>
<style type="text/css">
    .hide-info {
        display: none;
    }
    .table-panding-left tr td {
        padding-left: 0px;
        word-wrap: anywhere;
        line-height: 1.5;
    }

</style>
<!-- Inner Page Title end -->
<div class="listpgWraper">
   <div class="container">
      @include('flash::message')
      <!-- Job Detail start -->
      <div class="row">
         <div class="col-md-8">
            <!-- Job Header start -->
            <div class="job-header">
               <div class="jobinfo">
                  <!-- Candidate Info -->
                  <div class="candidateinfo">
                     <div class="userPic">{{$user->printUserImage()}}</div>
                     <div class="row">
                         <div class="col-md-9 p-0">
                             <div class="title">
                        {{$user->getName()}}
                        @if((bool)$user->is_immediate_available)
                        <sup style="font-size:12px; color:#1DB3DC;">{{__('Immediate Available For Work')}}</sup>
                             </div>
                        @endif
                             <div class="desi">{{$user->getLocation()}}</div>
                             <div class="loctext"><i class="fa fa-clock-o" aria-hidden="true"></i> {{__('Member Since')}}, {{$user->created_at->format('M d, Y')}}
                                 {{-- 	  <a style="text-align:left" href="https://chat.hrvisffor.com/" class="btn btn-danger">{{__('Request This Seeker')}}</a> --}}
                             </div>

                             @if(!empty(Auth::guard('company')->user()->staff_id))

                             @endif

                         </div>
                         <div class="col-md-3 p-0">
                         <a  href="javascript:;" onclick="send_message()" class="btn teacher-msg-btn"> {{__('Send Message')}}</a>
                         @if(!empty(Auth::guard('admin')->user()->id))                         
                           <a  href="{{ url('admin/edit-user/'.$user->id) }}" class="btn teacher-msg-btn"> {{__('Edit')}}</a>
                         @endif

                         @if(!empty(Auth::guard('company')->user()->staff_id))
                             <a  href="{{ url('job-invitation/'.$user->id) }}" class="btn btn-danger m-1 float-right btn-sm"> {{__('Invite Interview')}}</a>
                         @endif
                         </div>
                         </div>
                     <div class="clearfix"></div>
                  </div>
               </div>

               <div class="jobButtons" >
                  @if(isset($job) && isset($company))
                  @if(Auth::guard('company')->check() && Auth::guard('company')->user()->isFavouriteApplicant($user->id, $job->id, $company->id))
                  <a href="{{route('remove.from.favourite.applicant', [$job_application->id, $user->id, $job->id, $company->id])}}" class="btn"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Short Listed Applicant')}} </a>
                  @else
                  <a href="{{route('add.to.favourite.applicant', [$job_application->id, $user->id, $job->id, $company->id])}}" class="btn"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Short List This Applicant')}}</a>
                  @endif
                  @endif

                  @if(null !== $profileCv)<a style="display: none;" href="{{asset('cvs/'.$profileCv->cv_file)}}" class="btn"><i class="fa fa-download" aria-hidden="true"></i> {{__('Download CV')}}</a>@endif

               </div>
            </div>

         </div>
          <div class="col-md-4">
              <!-- Candidate Contact -->
              <div class="job-header hide-info">
                  <div class="jobdetail">
                      <h3>{{__('Candidate Contact')}}</h3>
                      <div class="candidateinfo">
                          @if(!empty($user->phone))
                              <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$user->phone}}">{{$user->phone}}</a></div>
                          @endif
                          @if(!empty($user->mobile_num))
                              <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$user->mobile_num}}">{{$user->mobile_num}}</a></div>
                          @endif
                          @if(!empty($user->email))
                              <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$user->email}}">{{$user->email}}</a></div>
                          @endif
                          <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$user->street_address}}</div>
                      </div>
                  </div>
              </div>
              <!-- Candidate Detail start -->
              <div class="job-header">
                  <div class="jobdetail">
                      <h3>{{__('Candidate Detail')}}</h3>
                      <ul class="jbdetail">
                          <li class="row">
                              <div class="col-md-6 col-xs-6">{{__('Is Email Verified')}}</div>
                              <div class="col-md-6 col-xs-6"><span>{{((bool)$user->verified)? 'Yes':'No'}}</span></div>
                          </li>
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__("Expected Salary")}}</div>
                                <div class="col-md-6 col-xs-6"><span style="color: #F4796E;">{{ $user->getexpectsalary->name }} {{ !empty($user->getexpectsalarymax->name) ?' - '.$user->getexpectsalarymax->name : '' }}
                                </span></div>
                            </li>
                      </ul>
                  </div>
              </div>

          </div>
      </div>
          <div class="row">
              <div class="col-md-12">
            <!-- Video Employee start -->
           @if(!empty($user->self_intro) && file_exists('public/video/'.$user->self_intro))
                <div class="job-header">
                   <div class="contentbox">
                @php
                $filename = explode('.', $user->self_intro);
                $extension = end($filename);
                @endphp
                <video poster="" height="500"  width="100%" id="player" playsinline controls>
                      @if (strtolower($extension) == 'mp4')
                          <source src="{{ url('public/video') }}/{{ $user->self_intro }}" type="video/mp4">
                      @elseif (strtolower($extension) == 'webm')
                          <source src="{{ url('public/video') }}/{{ $user->self_intro }}" type="video/webm">
                      @endif
                </video>
                   </div>
                </div>
            @endif

            <!-- About Employee start -->
            <div class="job-header">
               <div class="contentbox">
                  <h3>{{__('About me')}}</h3>
                  <p>{{$user->getProfileSummary('summary')}}</p>
               </div>
            </div>
            <!-- About Employee start -->
        <div class="job-header">
           <div class="contentbox">
                <div class="jobdetail" style="padding: 0px;">
                  <h3 class="job-detail-title">{{__('Info')}}</h3>
                    <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-condensed table-panding-left">
                            <tbody>
                            <tr>
                               @if(!empty($user->r_age_id))

                                    <td width="25%"><span>{{__("Age")}}</span></td>
                                    <td width="25%"><span class="text teacher-text">{{ $user->r_age_id }} ysr</span></td>

                                @endif
                                   @if(!empty($user->r_graduated_id))
                                       <td width="25%"><span>{{__("Graduated two years or more")}}</span></td>
                                       <td width="25%"><span class="text teacher-text">{{ $user->r_graduated_id }}</span></td>
                                   @endif
                            </tr>
                               <tr>
                               @if(!empty($user->getexpectsalary->name))

                                    <td width="25%"><span>{{__("Expected Salary")}}</span></td>
                                    <td width="25%"><span class="text teacher-text">{{ $user->getexpectsalary->name }} {{ !empty($user->getexpectsalarymax->name) ?' - '.$user->getexpectsalarymax->name : '' }}</span></td>


                                @endif
                               @if(!empty($user->r_working_experience))

                                   <td><span>{{__("Working Experience")}}</span></td>
                                   <td><span class="text teacher-text">{{ $user->r_working_experience }} years</span></td>

                               @endif
                               </tr>
                            <tr>
                               @if(!empty($user->getcurrentlocatioin->name))

                                    <td width="25%"><span>{{__("Locatioin")}}</span></td>
                                    <td width="25%"><span class="text teacher-text">{{ $user->getcurrentlocatioin->name }}</span></td>

                                @endif
                                   @if(!empty(count($user->userschooljoin)) && !empty($user->userschooljoin))

                                       <td><span>{{__("Expect type of school")}}</span></td>
                                       <td><span class="text teacher-text">

                                      @foreach($user->userschooljoin as $value)
                                                   @if(!empty($value->getschool->name))
                                                       {{ $value->getschool->name }} <br />
                                                   @endif
                                               @endforeach

                                    </span></td>

                                   @endif

                            </tr>
                            <tr>
                                @if(!empty($user->getnationality->nationality))

                                    <td width="25%"><span>{{__("Nationality")}}</span></td>
                                    <td width="25%"><span class="text teacher-text">{{ $user->getnationality->nationality }}</span></td>


                                @endif
                                    @if(!empty($user->getpositionlooking->name))

                                        <td><span>{{__("Type of position")}}</span></td>
                                        <td><span class="text teacher-text">{{ $user->getpositionlooking->name }}</span></td>

                                    @endif

                            </tr>
                            <tr>
                                @if(!empty($user->r_english_speaker_id))

                                    <td><span>{{__("Native English Speaker or not")}}</span></td>
                                    <td><span class="text teacher-text">{{ $user->r_english_speaker_id }}</span></td>

                                @endif
                                    @if(!empty($user->getworktype->name))

                                        <td><span>{{__("Type of work")}}</span></td>
                                        <td><span class="text teacher-text">{{ $user->getworktype->name }}</span></td>

                                    @endif

                            </tr>
                            <tr>
                                @if(!empty($user->gethighesteducation->name))

                                    <td><span>{{__("Education level")}}</span></td>
                                    <td><span class="text teacher-text">{{ $user->gethighesteducation->name }}</span></td>

                                @endif
                                    @if(!empty($user->getposition->name))

                                        <td><span>{{__("Boarding time")}}</span></td>
                                        <td><span class="text teacher-text">{{ $user->getposition->name }}</span></td>

                                    @endif

                            </tr>
                            <tr>
                                @if(!empty($user->r_subject_education))

                                    <td><span>{{__("Is Your Subject related to education or English?")}}</span></td>
                                    <td><span class="text teacher-text">{{ $user->r_subject_education }}</span></td>

                                @endif
                                    @if(!empty($user->userwelfare))

                                        <td><span>{{__("Other requirements")}}</span></td>
                                        <td>
                                        <span class="text teacher-text">
                                          @foreach($user->userwelfare as $value)
                                                {{ $value->getwelfare->name }} <br />
                                            @endforeach
                                        </span>
                                        </td>

                                    @endif

                            </tr>
                            <tr>
                                  @if(!empty($user->r_native_english_speaking))

                                    <td><span>{{__("Did you study in native English speaking countries?")}}</span></td>
                                    <td><span class="text teacher-text">{{ $user->r_native_english_speaking }}</span></td>

                                @endif
                                      @if(!empty($user->get_type_chinese_visa->name))

                                          <td><span>{{__("Chinese Visa status")}}</span></td>
                                          <td><span class="text teacher-text">{{ $user->get_type_chinese_visa->name }}</span></td>

                                      @endif
                            </tr>



                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>
            </div>
        </div>



          <div class="job-header">
               <div class="contentbox">
                  <h3>{{__('Education History')}}</h3>
                  <table class="table">
                    <thead>
                      <tr>
                          <th>{{__('Start Date')}}</th>
                          <th>{{__('End Date')}}</th>
                          <th>{{__('Company Name')}}</th>
                          <th>{{__('Position')}}</th>
                          <th>{{__('Title')}}</th>
                          <th>{{__('Duty')}}</th>
                      </tr>
                    </thead>
                    <tbody id="education_div">
                      <tr>
                          <td class="100%">
                              {{__('Record not found.')}}
                          </td>
                        </tr>
                    </tbody>
                  </table>
               </div>
            </div>
            <!-- Experience start -->
            <div class="job-header">
               <div class="contentbox">
                  <h3>{{__('Working Experience')}}</h3>
                  <table class="table">
                    <thead>
                      <tr>
                          <th>{{__('Start Date')}}</th>
                          <th>{{__('End Date')}}</th>
                          <th>{{__('Company Name')}}</th>
                          <th>{{__('Position')}}</th>
                          <th>{{__('Title')}}</th>
                          <th>{{__('Duty')}}</th>
                      </tr>
                    </thead>
                    <tbody id="experience_div">
                      <tr>
                          <td class="100%">
                              {{__('Record not found.')}}
                          </td>
                        </tr>
                    </tbody>
                  </table>

               </div>
            </div>
           <div class="row py-3">
               <div class="col-md-12 text-center">
                    <h3>Teacher <span class="card-sub">Card</span></h3>
               </div>
           </div>
                  <div class="row">
                      <div class="col-md-12 mx-auto">
                          <ul class="teacher-details">
                          <li>
                              <div class="job-seeker p-4">
                                  <div class="row">
                                      <div class="col-lg-54 col-md-5 pl-0 col-sm-5">

                                          <div class="jobimg job-seeker-img">
                                              {{$user->printUserImage(120, 150)}}</div>
                                          <h6 class="text-white pt-3">ID: {{$user->rule_id}}</h6>
                                          <h4 class="job-seeker-title">
                                              <a href="{{route('user.profile', $user->id)}}">{{$user->first_name}}</a>
                                          </h4>

                                          @if(!empty($user->getProfileSummary('summary')))
                                            <div class="seeker-bio">Bio:
                                                {{str_limit($user->getProfileSummary('summary'),150,'...')}}
                                            </div>
                                          @endif
                                          
                                      </div>



                                      
                                                <div class="col-lg-7 col-md-7 col-sm-7">
                                                    <div class="jobinfo job-seeker-list">

                                                        <div class="job-seeker-details pt-3">
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Age:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ (!empty($user->r_age_id)?$user->r_age_id:'N/A') }}
                                                                </div>

                                                            </div>
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Nationality:</div>
                                                                <div class="col-md-6 col-sm-6 col-6"> {{ (!empty($user->getnationality->nationality)?$user->getnationality->nationality:'') }}
                                                                </div>

                                                            </div>
                                                            {{--  <div class="row job-seeker-pad">
                                                                 <div class="col-md-6 col-sm-6 col-6">
                                                                     Native English Speaker:
                                                                 </div>
                                                                 <div class="col-md-6 col-sm-6 col-6">  @if(!empty($user->r_english_speaker_id))
                                                                         {{ $user->r_english_speaker_id }}

                                                                     @endif</div>
                                                             </div> --}}
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Degree:</div>

                                                                <div class="col-md-6 col-sm-6 col-6">@if(!empty($user->gethighesteducation->name))
                                                                        {{ $user->gethighesteducation->name }}
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                            Current Location:
                                                                </div>

                                                                    <div class="col-md-6 col-sm-6 col-6">
                                                                        {{ !empty($user->getcurrentlocatioin->name)?$user->getcurrentlocatioin->name:'' }}
                                                                    </div>
                                                            </div> --}}
                                                            {{-- <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Graduated  two years or more:</div>

                                                                    <div class="col-md-6 col-sm-6 col-6">@if(!empty($user->r_graduated_id))
                                                                    {{ $user->r_graduated_id }}

                                                                        @endif</div>
                                                            </div>
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Position:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($user->getpositionlooking->name)?$user->getpositionlooking->name:'' }}</div>
                                                            </div>

                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Type of work:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($user->getworktype->name)?$user->getworktype->name:'' }}</div>
                                                            </div> --}}


                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Arrival time: </div>
                                                                <div class="col-md-6 col-sm-6 col-6">@if(!empty($user->getposition->name))
                                                                        {{ $user->getposition->name }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">
                                                                    Expected Salary: </div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($user->getexpectsalary->name) ? $user->getexpectsalary->name : '' }} {{ !empty($user->getexpectsalarymax->name) ?  ' - '.$user->getexpectsalarymax->name : '' }}</div>

                                                            </div>
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Expected working
                                                                    location:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($user->getCity('city')) ? $user->getCity('city') : '' }} {{ !empty($user->getState('state')) ? ' '.$user->getState('state') : '' }}</div>
                                                            </div>
                                                            <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">General Work
                                                                    Location:</div>
                                                                <div class="col-md-6 col-sm-6 col-6">{{ !empty($user->getTeach->name)?$user->getTeach->name:'N/A' }}</div>
                                                            </div>


                                                            {{-- <div class="row job-seeker-pad">
                                                                <div class="col-md-6 col-sm-6 col-6">Expected type of school:</div>
                                                                @if(!empty(count($user->userschooljoin)) && !empty($user->userschooljoin))
                                                                    @foreach($user->userschooljoin as $key=>$value)
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
                                                        {{--<div class="location"> {{$user->getLocation()}}</div>--}}
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>


                                      





                                  </div>

                              </div>
                          </li>
                          </ul>
                      </div>
                  </div>


         </div>

      </div>
   </div>
</div>
<div class="modal fade" id="sendmessage" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <form action="" id="send-form">
            @csrf
            <input type="hidden" name="seeker_id" id="seeker_id" value="{{$user->id}}">
            <div class="modal-header">
               <h4 class="modal-title">Send Message</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <textarea class="form-control" name="message" id="message" cols="10" rows="7"></textarea>
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
   .formrow iframe {
   height: 78px;
   }
</style>
@endpush
@push('scripts')
<script type="text/javascript">
   $(document).ready(function () {

   function showExperience()
   {
   $.post("{{ route('show.applicant.profile.experience', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
           .done(function (response) {
           $('#experience_div').html(response);
           });
   }
   function showEducation()
   {
   $.post("{{ route('show.applicant.profile.education', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
           .done(function (response) {
           $('#education_div').html(response);
           });
   }



   showEducation();
   showExperience();






   $(document).on('click', '#send_applicant_message', function () {
   var postData = $('#send-applicant-message-form').serialize();
   $.ajax({
   type: 'POST',
           url: "{{ route('contact.applicant.message.send') }}",
           data: postData,
           //dataType: 'json',
           success: function (data)
           {
           response = JSON.parse(data);
           var res = response.success;
           if (res == 'success')
           {
           var errorString = '<div role="alert" class="alert alert-success">' + response.message + '</div>';
           $('#alert_messages').html(errorString);
           $('#send-applicant-message-form').hide('slow');
           $(document).scrollTo('.alert', 2000);
           } else
           {
           var errorString = '<div class="alert alert-danger" role="alert"><ul>';
           response = JSON.parse(data);
           $.each(response, function (index, value)
           {
           errorString += '<li>' + value + '</li>';
           });
           errorString += '</ul></div>';
           $('#alert_messages').html(errorString);
           $(document).scrollTo('.alert', 2000);
           }
           },
   });
   });




   });





   function send_message() {
       const el = document.createElement('div')
       el.innerHTML = "Please <a class='btn' href='{{route('login')}}' onclick='set_session()'>log in</a> as a Employer and try again."
       @if(null!==(Auth::guard('company')->user()))
       $('#sendmessage').modal('show');
       @else
       swal({
           title: "You are not Loged in",
           content: el,
           icon: "error",
           button: "OK",
       });
       @endif
   }
   if ($("#send-form").length > 0) {
       $("#send-form").validate({
           validateHiddenInputs: true,
           ignore: "",

           rules: {
               message: {
                   required: true,
                   maxlength: 5000
               },
           },
           messages: {

               message: {
                   required: "Message is required",
               }

           },
           submitHandler: function(form) {
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
               @if(null !== (Auth::guard('company')->user()))
               $.ajax({
                   url: "{{route('submit-message-staff')}}",
                   type: "POST",
                   data: $('#send-form').serialize(),
                   success: function(response) {
                       $("#send-form").trigger("reset");
                       $('#sendmessage').modal('hide');
                       swal({
                           title: "Success",
                           text: response["msg"],
                           icon: "success",
                           button: "OK",
                       });
                   }
               });
               @endif
           }
       })
   }
</script>
@endpush
