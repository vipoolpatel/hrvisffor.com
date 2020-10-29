 @foreach($getcompanymessage as $messagevalue)
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-success"> <i class="fa fa-envelope"></i> </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    {{ $messagevalue->seeker_name }} sent "{{ $messagevalue->message }}" to <a href="{{ url('admin/my-teacher-message') }}" title="Media Wave" >{{ $messagevalue->company_name }}.</a>
                    Time : {{ date('d-m-Y h:i A', strtotime($messagevalue->created_at)) }}
                </div>
            </div>
        </div>
    </div>
</li>
@endforeach     