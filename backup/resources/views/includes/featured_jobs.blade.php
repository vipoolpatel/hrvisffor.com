<div class="section">
    <div class="container"> 
        <!-- title start -->
        <div class="titleTop">
            <h3>{{__('Featured')}} <span>{{__('Jobs')}}</span></h3>
        </div>
        <!-- title end --> 

        <!--Featured Job start-->
        <ul class="jobslist row">
            @if(isset($featuredJobs) && count($featuredJobs))
            @foreach($featuredJobs as $featuredJob)
            <?php $company = $featuredJob->getCompany(); ?>
            @if(null !== $company)
            <!--Job start-->
            <li class="col-md-6">
                <div class="jobint">
                    <div class="row">
                      {{--   <div class="col-lg-2 col-md-2">
                            <a href="{{route('job.detail', [$featuredJob->slug])}}" title="{{$featuredJob->title}}">
                                <img class="lazy" data-src="resize.php?img={{asset('company_logos/'.$company->logo)}}&w=60" alt="{{$company->name}}">
                            </a>
                        </div> --}}
                        <div class="col-lg-9 col-md-9" style="padding-left: 10px;">

                            <h4><a href="{{route('job.detail', [$featuredJob->slug])}}" title="{{$featuredJob->title}}">{{!empty($featuredJob->getpositionlooking->name) ? $featuredJob->getpositionlooking->name : $featuredJob->title }}</a></h4>

                            <div class="company"><a href="{{route('company.detail', $company->slug)}}" title="{{$company->school_id}}">{{$company->school_id}}</a></div>
                            <div class="jobloc">
                                <label class="fulltime">{{$featuredJob->getLocation()}}</label>
                            </div>


                        </div>
                        <div class="col-lg-3 col-md-3"><a href="{{route('job.detail', [$featuredJob->slug])}}" class="applybtn">{{__('View Detail')}}</a></div>
                    </div>
                </div>
            </li>
            <!--Job end--> 
            @endif
            @endforeach
            @endif

        </ul>
        <!--Featured Job end--> 

        <!--button start-->
        <div class="viewallbtn"><a href="{{route('job.list', ['is_featured'=>1])}}">{{__('View All Featured Jobs')}}</a></div>
        <!--button end--> 
    </div>
</div>