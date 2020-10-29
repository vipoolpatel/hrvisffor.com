 <div class="col-lg-4 col-md-4">
   <div class="message-inbox">
      <div class="message-header">
      </div>
      <div class="list-wrap">
         <ul class="message-history">
            @if(null !== ($seekers))
          <?php foreach($seekers as $seeker){?>
          <li class="message-grid" id="adactive{{ $seeker->id}}"> 
            <a  href="javascript:;" data-gift="{{$seeker->id}}" id="company_id_{{$seeker->id}}"  onclick="show_messages({{ $seeker->id}})">
            <div class="image"> 
           {{$seeker->printUserImage(100, 100)}}
            </div>
            <div class="user-name">
              <div class="author"> <span>{{ $seeker->name}} 
                @if($seeker->countMessages($company_id))
                    ({{$seeker->countMessages($company_id)}})
                @endif
              </span>                       
              </div> 
              @if(!empty($seeker->OnlineUserSeeker()))
                  <div class="count-messages" style="margin-top: -21px;font-weight: bold;color: green;"><i class="fa fa-circle" aria-hidden="true"></i></div>
              @endif
            </div>
          
            </a> 
          </li>
          <?php } ?>
          @endif

         </ul>
      </div>
   </div>
</div>

<div class="col-lg-8 col-md-8 clearfix message-content">
   <div class="message-details">
      <h4> </h4>
      <div id="append_messages">
      </div>
   </div>
</div>