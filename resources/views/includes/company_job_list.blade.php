<div class="myads">
    <h3>{{__('Company Posted Jobs')}}</h3>
    <ul class="searchList">
        <!-- job start --> 
        @if(isset($jobs) && count($jobs))
        @foreach($jobs as $job)
        @php $company = $job->getCompany(); @endphp
        @if(null !== $company)
        <li id="job_li_{{$job->id}}">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="jobimg">{{$company->printCompanyImage()}}</div>
                    <div class="jobinfo">
                        <h3 style="margin-top: 10px;"><a style="color: #fff;" href="{{route('job.detail', [$job->slug])}}" title="{{ !empty($job->getpositionlooking->name) ? $job->getpositionlooking->name : '' }}">{{ !empty($job->getpositionlooking->name) ? $job->getpositionlooking->name : '' }}</a></h3>
                        <div class="companyName"><a style="color: #fff;" href="{{route('company.detail', $company->slug)}}" title="{{$company->name}}">{{$company->name}}</a></div>

                        <div class="location">
                            <label class="fulltime" title="{{$job->getJobShift('job_shift')}}">{{$job->getLocation()}}</label>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-4 col-sm-4">                
                    {{-- <div class="listbtn"><a href="{{route('list.favourite.applied.users', [$job->id])}}">{{__('List Short Listed Candidates')}}</a></div> --}}

                    <div class="listbtn"><a href="{{ url('job-seekers?id='.$job->id) }}">{{__('Match Candidates')}}</a></div>

                    <div class="listbtn"><a href="{{route('list.applied.users', [$job->id])}}">{{__('List Candidates')}}</a></div>
                    <div class="listbtn"><a href="{{route('edit.front.job', [$job->id])}}">{{__('Edit')}}</a></div>
                    <div class="listbtn"><a href="javascript:;" onclick="deleteJob({{$job->id}});">{{__('Delete')}}</a></div>
                </div>
            </div>
            <p>{{str_limit(strip_tags($job->description), 150, '...')}}</p>
        </li>
        <!-- job end --> 
        @endif
        @endforeach
        @endif
    </ul>
</div>