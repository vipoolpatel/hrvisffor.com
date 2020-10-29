@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<style type="text/css">
   .jobimg img {
   height: 100px;
   width: 100px;
   }
</style>
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Dashboard')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
   <div class="container">
      @include('flash::message')
      <div class="row">
         @include('includes.company_dashboard_menu')
         <div class="col-md-9 col-sm-8"> 
            @include('includes.company_dashboard_stats')    
            @include('includes.company_job_list')
         </div>
      </div>
   </div>
</div>
@include('includes.footer')
@endsection
@push('scripts')
@include('includes.immediate_available_btn')
<script type="text/javascript">
   function deleteJob(id) {
   var msg = 'Are you sure?';
   if (confirm(msg)) {
   $.post("{{ route('delete.front.job') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
           .done(function (response) {
           if (response == 'ok')
           {
           $('#job_li_' + id).remove();
           } else
           {
           alert('Request Failed!');
           }
           });
   }
   }
</script>
@endpush
