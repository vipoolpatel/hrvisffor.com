<div class="section">
    <div class="container"> 
        <!-- title start -->
        <div class="titleTop">
            <h3>{{__('Latest')}} <span>{{__('Jobs')}}</span></h3>
        </div>
        <!-- title end -->

        <ul class="jobslist newjbox row">
            @if(isset($latestJobs) && count($latestJobs))
            @foreach($latestJobs as $latestJob)
            <?php $company = $latestJob->getCompany(); ?>
            @if(null !== $company)
            <!--Job start-->
            <li class="col-md-4">
                <div class="jobint">
                    <div class="row">
                        {{-- <div class="col-md-3 col-sm-3">
                            <a href="{{route('job.detail', [$latestJob->slug])}}" title="{{$latestJob->title}}">
                                <img class="lazy" data-src="resize.php?img={{asset('company_logos/'.$company->logo)}}&w=62" alt="{{$company->name}}">
                            </a>
                        </div> --}}
                        <div class="col-md-12 col-sm-12" style="padding-left: 10px;">
                            <h4><a href="{{route('job.detail', [$latestJob->slug])}}" title="{{$latestJob->title}}">{{!empty($latestJob->getpositionlooking->name) ? $latestJob->getpositionlooking->name : $latestJob->title }}</a></h4>


                            <div class="company"><a href="{{route('company.detail', $company->slug)}}" title="{{$company->school_id}}">{{$company->school_id}}</a> - <span>{{$latestJob->getLocation()}}</span></div>
                            <div class="jobloc">
                                <label class="fulltime" title="{{ !empty($latestJob->getworktype->name) ? $latestJob->getworktype->name : '' }}">{{ !empty($latestJob->getworktype->name) ? $latestJob->getworktype->name : '' }}</label> </div>
                        </div>                       
                    </div>
                </div>
            </li>
            <!--Job end--> 
            @endif
            @endforeach
            @endif
        </ul>
        <!--view button-->
        <div class="viewallbtn"><a href="{{route('job.list')}}">{{__('View All Latest Jobs')}}</a></div>
        <!--view button end--> 
    </div>
</div>