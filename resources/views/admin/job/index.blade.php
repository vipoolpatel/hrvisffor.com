@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
   .table td, .table th {
   font-size: 12px;
   line-height: 2.42857 !important;
   }    
</style>
<div class="page-content-wrapper">
   <!-- BEGIN CONTENT BODY -->
   <div class="page-content">
      <!-- BEGIN PAGE HEADER--> 
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
         <ul class="page-breadcrumb">
            <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
            <li> <span>Jobs</span> </li>
         </ul>
      </div>
      <!-- END PAGE BAR --> 
      <!-- BEGIN PAGE TITLE-->
      <h3 class="page-title">Manage Jobs <small>Jobs</small> </h3>
      <!-- END PAGE TITLE--> 
      <!-- END PAGE HEADER-->
      <div class="row">
         <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
               <div class="portlet-title">
                  <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Jobs</span> </div>
                  <div class="actions"> <a href="{{ route('create.job') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Job</a> </div>
               </div>
               <div class="portlet-body">
                  <div class="table-container">
                     <form method="post" role="form" id="job-search-form">
                        <table class="table table-striped table-bordered table-hover"  id="jobDatatableAjax">
                           <thead>
                              <tr role="row" class="filter">
                                 <td>
                                    <div class="form-group">
                                       <select class="form-control common_file" id="r_school_id" name="r_school_id">
                                          <option value="">{{__("What type of your school?")}}</option>
                                          @foreach($getSchoolJoin as $value_s)
                                          <option value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control common_file"  id="r_work_type_id" name="r_work_type_id">
                                          <option value="">{{__("What's type of position will you provide?")}}</option>
                                          @foreach($getWorkType as $value_w)
                                          <option value="{{ $value_w->id }}">{{ $value_w->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_english_speaker_id" id="r_english_speaker_id">
                                          <option value="">{{__("Do you need this teacher is a Native English Speaker or not?")}}</option>
                                          <option value="Yes">{{__("Yes")}}</option>
                                          <option value="No">{{__("Don't Mind")}}</option>
                                       </select>
                                    </div>

                                     <div class="form-group">
                                       <select class="form-control common_file" name="r_visa_id" id="r_visa_id">
                                          <option value="">{{__("What type of visa do you require for teachers?")}}</option>
                                          @foreach($getVisa as $value)
                                          <option value="{{ $value->id }}">{{ $value->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>

                                    <div class="form-group">
                                       <input type="text" placeholder="School ID" name="school_id" id="school_id" class="form-control">
                                    </div>
                                  
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_teach_id" id="r_teach_id">
                                          <option value="">{{__("What's the general location of your school?")}}</option>
                                          @foreach($getTeach as $value_t)
                                          <option  value="{{ $value_t->id }}">{{ $value_t->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control common_file" name="title" id="title">
                                          <option value="">{{__("What's the tile of your position?")}}</option>
                                          @foreach($getPositionLooking as $value_p)
                                          <option value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_city_line_id" id="r_city_line_id">
                                          <option value="">{{__("City Line")}}</option>
                                          @foreach($getCityLine as $value_c)
                                          <option value="{{ $value_c->id }}">{{ $value_c->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>

                                      <div class="form-group">
                                       <select class="form-control common_file" name="r_visa_qualification_id" id="r_visa_qualification_id">
                                          <option value="">{{__("VISA Qualification")}}</option>
                                          <option value="T">{{__("T")}}</option>
                                          <option value="O">{{__("O")}}</option>
                                       </select>
                                    </div>

                                   

                 {{--                    {!! Form::select('company_id', ['' => 'Select Company']+$companies, null, array('id'=>'company_id', 'class'=>'form-control')) !!} --}}

                                    <div class="form-group">
                                       <input type="text" placeholder="Company Name" name="company_name" id="company_name" class="form-control">
                                    </div>

                                 </td>
                                 <td>
                                    
                                  
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_colour_id" id="r_colour_id">
                                          <option value="">{{__("Colour")}}</option>
                                          <option value="W">{{__("W")}}</option>
                                          <option value="N">{{__("N")}}</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_current_location_id" id="r_current_location_id">
                                          <option value="">{{__("Current location")}}</option>
                                          <option value="G">{{__("G")}}</option>
                                          <option value="C">{{__("C")}}</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_emerency_level_id" id="r_emerency_level_id">
                                          <option value="">{{__("Emerency level")}}</option>
                                          @foreach($getEmerencyLevel as $value_el)
                                          <option value="{{ $value_el->id }}">{{ $value_el->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                     <div class="form-group">
                                       <select class="form-control common_file" name="r_hour_id" id="r_hour_id">
                                          <option value="">{{__("Working hours per week")}}</option>
                                          @for($i=1; $i<=50; $i++)
                                          <option value="{{ $i }}">{{ $i }}</option>
                                          @endfor
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_working_schedule_id" id="r_working_schedule_id">
                                          <option value="">{{__("Working Schedule")}}</option>
                                          @foreach($getWorkingSchedule as $value)
                                          <option value="{{ $value->id }}">{{ $value->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </td>
                                 {{--     
                                 <td><input type="text" class="form-control" name="description" id="description" autocomplete="off" placeholder="Job description"></td>
                                 --}}
                                 <td>
                                    <div class="form-group"> 
                                       <?php $default_country_id = Request::query('country_id', $siteSetting->default_country_id); ?>
                                       {!! Form::select('country_id', ['' => 'Select Country']+$countries, $default_country_id, array('id'=>'country_id', 'class'=>'form-control')) !!}
                                    </div>
                                    <div class="form-group"> 
                                       <span id="default_state_dd">
                                       {!! Form::select('state_id', ['' => 'Select State'], null, array('id'=>'state_id', 'class'=>'form-control')) !!}
                                       </span>
                                    </div>
                                    <div class="form-group"> 
                                       <span id="default_city_dd">
                                       {!! Form::select('city_id', ['' => 'Select City'], null, array('id'=>'city_id', 'class'=>'form-control')) !!}
                                       </span>
                                    </div>
                                   
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_class_size_id" id="r_class_size_id">
                                          <option value="">{{__("Class size for teacher")}}</option>
                                          @for($i=1; $i<=50; $i++)
                                          <option value="{{ $i }}">{{ $i }}</option>
                                          @endfor
                                       </select>
                                    </div>
                                     <div class="form-group">
                                       <select class="form-control common_file" name="r_position_id" id="r_position_id">
                                          <option value="">{{__("When you need new teachers join the new work?")}}</option>
                                          @foreach($getPosition as $value_p)
                                          <option value="{{ $value_p->id }}">{{ $value_p->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <input type="text" class="form-control" name="search_note" id="search_note" placeholder="Search Note" autocomplete="off">
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <select name="is_active" id="is_active" class="form-control">
                                          <option value="-1">Is Active?</option>
                                          <option value="1" selected="selected">Active</option>
                                          <option value="0">In Active</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select name="is_featured" id="is_featured" class="form-control">
                                          <option value="-1">Is Featured?</option>
                                          <option value="1">Featured</option>
                                          <option value="0">Not Featured</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_min_age_requirement_id" id="r_min_age_requirement_id">
                                          <option value="">{{__("Minimum Age requirement")}}</option>
                                          @for($i=18; $i<=65; $i++)
                                          <option value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
                                          @endfor
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_max_age_requirement_id" id="r_max_age_requirement_id">
                                          <option value="">{{__("Maximum Age requirement")}}</option>
                                          @for($i=18; $i<=65; $i++)
                                          <option @if(!empty($job)) {{ ($job->r_max_age_requirement_id == $i) ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }} {{__("ysr")}}</option>
                                          @endfor
                                       </select>
                                    </div>
                                   
                                    <div class="form-group">
                                       <select class="form-control common_file" name="r_salary_id" id="r_salary_id">
                                          <option value="">{{__("Minimum Salary")}}</option>
                                          @foreach($getSalaryExpect as $value_s)
                                          <option value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                   <div class="form-group">
                                       <select class="form-control common_file" name="r_max_salary_id" id="r_max_salary_id">
                                          <option value="">{{__("Maximum Salary")}}</option>
                                          @foreach($getSalaryExpect as $value_s)
                                          <option value="{{ $value_s->id }}">{{ $value_s->name }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row" class="heading">
                                 <th>School ID</th>
                                 <th>Company</th>
                                 <th>Job title</th>
                                 {{-- 
                                 <th>Job description</th>
                                 --}}
                                 <th>City</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- END CONTENT BODY --> 
</div>

<div class="modal fade" id="GetNote" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="display: block ruby;">
                    <h4 class="modal-title">All Notes</h4>
                    <button type="button" class="btn btn-success" style="float: right" data-toggle="modal" data-target="#AddNote"><i class="glyphicon glyphicon-plus"></i> Add New Note</button>
                </div>
                <div class="modal-body" id="GetNotes">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
 <div class="modal fade" id="AddNote" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Add New Note</h4>
             </div>
             <div class="modal-body">
                 <span class="alert alert-success msgs" style="float: left;display: none;width: 100%"></span>
                 <div class="form-group">
                     <label for="message-text" class="col-form-label">Note:</label>
                     <textarea class="form-control" id="message"></textarea>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-success" id="get_job_id">Submit</button>
             </div>
         </div>
     </div>
 </div>


@endsection
@push('scripts') 
<script type="text/javascript">

$('document').ready(function(){


       $('table').delegate('.AddNotes','click',function(){
            var job_id = $(this).attr('id');
            getNote(job_id);
        });

        $('#GetNote').delegate('.DeleteNote','click',function(){
            var action = $(this).attr('action');
            var res = action.split("_");
            var id = res[0];
            var job_id = res[1];

            var confirmation = confirm("are you sure you want to remove the note?");
            if (confirmation) {
                $.ajax({
                    url: '{{ url('admin/delete-note-job') }}',
                    type: 'GET',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        getNote(job_id);
                    }
                });
            }
        });

        function getNote(job_id){
            $.ajax({
                url: '{{ url('admin/getnotejob') }}',
                type: 'GET',
                data: {
                    job_id: job_id,
                },
                dataType: 'json',
                success: function(data) {
                    $('#get_job_id').attr('action',job_id);
                    $('#GetNotes').html(data.success);
                    $('#message').val('');
                }
            });
        }

        $('#get_job_id').on('click', function (){

            var job_id = $(this).attr('action');
            var message = $('#message').val();

            $.ajax({
                url: '{{ url('admin/add-note-job') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    job_id: job_id,
                    message,message,
                },
                dataType: 'json',
                success: function(data) {
                    $('#AddNote').modal('hide');
                    getNote(job_id);
                }
            });

        });

   });









   $(function () {
       var oTable = $('#jobDatatableAjax').DataTable({
           processing: true,
           serverSide: true,
           stateSave: true,
           searching: false,
           /*       
            "order": [[1, "asc"]],            
            paging: true,
            info: true,
            */
           ajax: {
               url: '{!! route('fetch.data.jobs') !!}',
               data: function (d) {
                   d.company_id = $('#company_id').val();
                   d.r_school_id = $('#r_school_id').val();
                   d.r_work_type_id = $('#r_work_type_id').val();
                   d.r_english_speaker_id = $('#r_english_speaker_id').val();
                   d.r_visa_id = $('#r_visa_id').val();
                   d.r_teach_id = $('#r_teach_id').val();
                   d.r_position_id = $('#r_position_id').val();
                   d.r_salary_id = $('#r_salary_id').val();
                   d.r_hour_id = $('#r_hour_id').val();
                   d.r_working_schedule_id = $('#r_working_schedule_id').val();
                   d.r_class_size_id = $('#r_class_size_id').val();
                   d.r_min_age_requirement_id = $('#r_min_age_requirement_id').val();
                   d.r_max_age_requirement_id = $('#r_max_age_requirement_id').val();
                   d.r_city_line_id = $('#r_city_line_id').val();
                   d.r_visa_qualification_id = $('#r_visa_qualification_id').val();
                   d.r_colour_id = $('#r_colour_id').val();
                   d.r_current_location_id = $('#r_current_location_id').val();
                   d.r_emerency_level_id = $('#r_emerency_level_id').val();
                   d.company_name = $('#company_name').val();
                   d.school_id = $('#school_id').val();
                   d.r_max_salary_id = $('#r_max_salary_id').val();
                   d.search_note = $('#search_note').val();
                   
                   
                   
                   
                   
                   d.title = $('#title').val();
                   // d.description = $('#description').val();
                   d.country_id = $('#country_id').val();
                   d.state_id = $('#state_id').val();
                   d.city_id = $('#city_id').val();
                   d.is_active = $('#is_active').val();
                   d.is_featured = $('#is_featured').val();
               }
           }, columns: [
               {data: 'school_id', name: 'school_id'},
               {data: 'company_id', name: 'company_id'},
               {data: 'title', name: 'title'},
               // {data: 'description', name: 'description'},
               {data: 'city_id', name: 'city_id'},
               {data: 'action', name: 'action', orderable: false, searchable: false}
           ]
       });
       $('#job-search-form').on('submit', function (e) {
           oTable.draw();
           e.preventDefault();
       });
       $('#company_id').on('change', function (e) {
           oTable.draw();
           e.preventDefault();
       });
   
       $('.common_file').on('change', function (e) {
           oTable.draw();
           e.preventDefault();
       });
   
      
      $('#search_note').on('keyup', function (e) {
           oTable.draw();
           e.preventDefault();
       });
   
   
       $('#company_name').on('keyup', function (e) {
           oTable.draw();
           e.preventDefault();
       });
       
       $('#title').on('keyup', function (e) {
           oTable.draw();
           e.preventDefault();
       });

       $('#school_id').on('keyup', function (e) {
           oTable.draw();
           e.preventDefault();
       });


       
       // $('#description').on('keyup', function (e) {
       //     oTable.draw();
       //     e.preventDefault();
       // });
       $('#country_id').on('change', function (e) {
           oTable.draw();
           e.preventDefault();
           filterDefaultStates(0);
       });
       $(document).on('change', '#state_id', function (e) {
           oTable.draw();
           e.preventDefault();
           filterDefaultCities(0);
       });
       $(document).on('change', '#city_id', function (e) {
           oTable.draw();
           e.preventDefault();
       });
       $('#is_active').on('change', function (e) {
           oTable.draw();
           e.preventDefault();
       });
       $('#is_featured').on('change', function (e) {
           oTable.draw();
           e.preventDefault();
       });
       filterDefaultStates(0);
   });
   function deleteJob(id, is_default) {
       var msg = 'Are you sure?';
       if (confirm(msg)) {
           $.post("{{ route('delete.job') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                   .done(function (response) {
                       if (response == 'ok')
                       {
                           var table = $('#jobDatatableAjax').DataTable();
                           table.row('jobDtRow' + id).remove().draw(false);
                       } else
                       {
                           alert('Request Failed!');
                       }
                   });
       }
   }
   function makeActive(id) {
       $.post("{{ route('make.active.job') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
               .done(function (response) {
                   if (response == 'ok')
                   {
                       var table = $('#jobDatatableAjax').DataTable();
                       table.row('jobDtRow' + id).remove().draw(false);
                   } else
                   {
                       alert('Request Failed!');
                   }
               });
   }
   function makeNotActive(id) {
       $.post("{{ route('make.not.active.job') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
               .done(function (response) {
                   if (response == 'ok')
                   {
                       var table = $('#jobDatatableAjax').DataTable();
                       table.row('jobDtRow' + id).remove().draw(false);
                   } else
                   {
                       alert('Request Failed!');
                   }
               });
   }
   function makeFeatured(id) {
       $.post("{{ route('make.featured.job') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
               .done(function (response) {
                   if (response == 'ok')
                   {
                       var table = $('#jobDatatableAjax').DataTable();
                       table.row('jobDtRow' + id).remove().draw(false);
                   } else
                   {
                       alert('Request Failed!');
                   }
               });
   }
   function makeNotFeatured(id) {
       $.post("{{ route('make.not.featured.job') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
               .done(function (response) {
                   if (response == 'ok')
                   {
                       var table = $('#jobDatatableAjax').DataTable();
                       table.row('jobDtRow' + id).remove().draw(false);
                   } else
                   {
                       alert('Request Failed!');
                   }
               });
   }
   function filterDefaultStates(state_id)
   {
       var country_id = $('#country_id').val();
       if (country_id != '') {
           $.post("{{ route('filter.default.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                   .done(function (response) {
                       $('#default_state_dd').html(response);
                   });
       }
   }
   function filterDefaultCities(city_id)
   {
       var state_id = $('#state_id').val();
       if (state_id != '') {
           $.post("{{ route('filter.default.cities.dropdown') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                   .done(function (response) {
                       $('#default_city_dd').html(response);
                   });
       }
   }
</script>
@endpush