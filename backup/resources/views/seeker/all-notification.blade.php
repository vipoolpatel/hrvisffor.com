@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('My Notification')])
<div class="listpgWraper messageWrap">
    <div class="container">
        <div class="row"> @include('includes.user_dashboard_menu')
            <div class="col-md-9 col-sm-8">
                <div class="myads message-body">
                    <h3>{{__('Seeker Notifications')}}</h3> 
                          <div class="row">
                            <div class="col-lg-12 col-md-12">
                              <div class="message-inbox">
                                <div class="message-header">
                                </div>
                                <div class="list-wrap">
                                  <ul class="list-group">
                                    @if(null !== ($notification))
                                    <?php $data= json_decode( json_encode($notification), true);
									 
 foreach($data as $notification_1){ ?>
                                    <li class="list-group-item">
										You have a new message <a href="https://chat.hrvisffor.com/grupo/signin/{{ Auth::user()->id }}_{{ Auth::user()->email }}_{{ Auth::user()->first_name }}" style="margin-left:20px;" class=""> {{ $notification_1['msg'] }}</a>
									</li>
                                    <?php } ?>
                                    @endif
                                  </ul>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </section>
                </div>
            </div>
          </div>
@endsection
@push('scripts')
<script type="text/javascript">
function show_messages(id)
{
    $.ajax({
            type: "GET",
            url: "{{route('seeker-change-message-status')}}",
            data: { 
                'sender_id': id, 
            },
            })
      $.ajax({
        type: 'get',
        url: "{{route('seeker-append-messages')}}",
        data: {
          '_token': $('input[name=_token]').val(),
          'company_id': id,
        },
        success: function(res) {
          $('#append_messages').html('');
          $('#append_messages').html(res);
          $(".messages").scrollTop(100000000000000000);
          $('.messages').off('scroll');
          $('.message-grid').removeClass('active');
          $("#adactive"+id).addClass('active');
        }
      });

  }
  
    
</script>

@endpush
