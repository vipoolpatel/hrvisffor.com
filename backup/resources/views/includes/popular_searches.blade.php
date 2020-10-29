<div class="section greybg">
   <div class="container">
      <div class="topsearchwrap">
         <div class="tabswrap">
            <div class="row">
               <div class="col-md-4">
                  <h3>{{__('Browse Jobs By')}}</h3>
               </div>
               <div class="col-md-8">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#bycities" aria-expanded="false">{{__('Cities')}}</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="tab-content" id="jobsby">

            <div class="tab-pane fade show active" id="bycities" role="tabpanel" aria-labelledby="bycities-tab">
               <div class="srchbx">
                  <!--Cities start-->
                  <div class="srchint">
                     <ul class="row catelist">
                        @if(isset($topCityIds) && count($topCityIds)) @foreach($topCityIds as $city_id_num_jobs)
                        <?php
                           $city = App\ City::getCityById($city_id_num_jobs->city_id);
                           ?> @if(null !== $city)
                        <li class="col-md-3 col-sm-4 col-xs-6"><a href="{{route('job.list', ['city_id[]'=>$city->city_id])}}" title="{{$city->city}}">{{$city->city}} <span>({{$city_id_num_jobs->num_jobs}})</span></a>
                        </li>
                        @endif @endforeach @endif
                     </ul>
                     <!--Cities end-->
                  </div>
               </div>
            </div>


          

         </div>
      </div>
   </div>
</div>
