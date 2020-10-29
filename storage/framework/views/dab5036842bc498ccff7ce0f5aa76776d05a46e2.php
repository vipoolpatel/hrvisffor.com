<?php $__env->startSection('content'); ?>
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
                    <li> <a href="<?php echo e(route('admin.home')); ?>">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Users</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage Users <small>Users</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Users</span> </div>
                            <div class="actions">
                                <a href="<?php echo e(route('create.user')); ?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New User</a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="user-search-form">
                                    <table class="table table-striped table-bordered table-hover"  id="user_datatable_ajax">
                                        <thead>
                                        <tr role="row" class="filter">
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_current_locatioin_id" id="r_current_locatioin_id">
                                                        <option value=""><?php echo e(__("What's your current locatioin?")); ?></option>
                                                        <?php $__currentLoopData = $getCurrentLocatioin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value_l->id); ?>"><?php echo e($value_l->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control common_change"  id="r_english_speaker_id" name="r_english_speaker_id">
                                                        <option value=""><?php echo e(__("Native English Speaker or not? ")); ?></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_highest_education_id" id="r_highest_education_id">
                                                        <option value=""><?php echo e(__("What your highest education level?")); ?></option>
                                                        <?php $__currentLoopData = $getHighestEducation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value_h->id); ?>"><?php echo e($value_h->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="id" id="id" placeholder="ID" autocomplete="off">
                                                </div>
                                            </td>
                                            <td>
                                                
                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_subject_education" id="r_subject_education">
                                                        <option value=""><?php echo e(__("Is Your Subject related to education or English?")); ?></option>
                                                        <option value="Yes"><?php echo e(__("Yes")); ?></option>
                                                        <option value="No"><?php echo e(__("No")); ?></option>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_school_join_id" id="r_school_join_id">
                                                        <option value=""><?php echo e(__("What type of school you want to join?")); ?></option>
                                                        <?php $__currentLoopData = $getSchoolJoin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_join): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value_join->id); ?>"><?php echo e($value_join->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>



                                                


                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" autocomplete="off">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_salary_id" id="r_salary_id">
                                                        <option value=""><?php echo e(__("Select Minimum Salary")); ?></option>
                                                        <?php $__currentLoopData = $getSalaryExpect; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value_s->id); ?>"><?php echo e($value_s->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                               <div class="form-group">
                                                    <select class="form-control common_change" name="r_max_salary_id" id="r_max_salary_id">
                                                        <option value=""><?php echo e(__("Select Maximum Salary")); ?></option>
                                                        <?php $__currentLoopData = $getSalaryExpect; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value_s->id); ?>"><?php echo e($value_s->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>



                                                
                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_colour_id" id="r_colour_id">
                                                        <option value=""><?php echo e(__("Colour")); ?></option>
                                                        <?php $__currentLoopData = $getColour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_Co): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value_Co->id); ?>"><?php echo e($value_Co->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_position_id" id="r_position_id">
                                                        <option value=""><?php echo e(__("When you can join this new position if you got a satisfied offer?")); ?></option>
                                                        <?php $__currentLoopData = $getPosition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value_p->id); ?>"><?php echo e($value_p->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_native_english_speaking" id="r_native_english_speaking">
                                                        <option value=""><?php echo e(__("Did you study in native English speaking countries?")); ?></option>
                                                        <option value="Yes"><?php echo e(__("Yes")); ?></option>
                                                        <option value="No"><?php echo e(__("No")); ?></option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="search_note" id="search_note" placeholder="Search Note" autocomplete="off">
                                                </div>


                                                
                                            </td>
                                            <td>
                                                
                                                <div class="form-group" >
                                                    <select class="form-control common_change" name="r_teach_id" id="r_teach_id" >
                                                        <option value=""><?php echo e(__("Where do you want to teach?")); ?></option>
                                                        <?php $__currentLoopData = $getTeach; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option  value="<?php echo e($value_t->id); ?>"><?php echo e($value_t->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_work_type_id" id="r_work_type_id">
                                                        <option value=""><?php echo e(__("What's type of work do you want?")); ?></option>
                                                        <?php $__currentLoopData = $getWorkType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value_w->id); ?>"><?php echo e($value_w->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>


                                            </td>
                                            <?php if(Auth::user()->role_id == 1): ?>
                                                <td></td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control common_change" name="r_position_looking_id" id="r_position_looking_id">
                                                        <option value=""><?php echo e(__("What position are you looking for?")); ?></option>
                                                        <?php $__currentLoopData = $getPositionLooking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value_p->id); ?>"><?php echo e($value_p->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <select name="verified" id="verified" class="form-control common_change">
                                                        <option value="">Is Verified?</option>
                                                        <option value="1">Verified</option>
                                                        <option value="100">Not Verified</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" id="start_date" style="padding: 0px;padding-left: 10px;" class="form-control common_change" name="start_date">
                                                </div>
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" id="end_date" style="padding: 0px;padding-left: 10px;" class="form-control common_change" name="end_date">
                                                </div>


                                            </td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>Id</th>
                                            <th>Name</th>
                                            
                                            <th>Colour</th>
                                            <th>Nationality</th>
                                            <th>Current Location</th>
                                            <?php if(Auth::user()->role_id == 1): ?>
                                                <th>Assign Staff</th>
                                            <?php endif; ?>
                                            <th width="18%">Actions</th>
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
                    <button type="button" class="btn btn-success" id="get_user_id">Submit</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $('table').delegate('.AddNotes','click',function(){
            var user_id = $(this).attr('id');
            getNote(user_id);
        });

        $('#GetNote').delegate('.DeleteNote','click',function(){
            var action = $(this).attr('action');
            var res = action.split("_");
            var id = res[0];
            var user_id = res[1];

            var confirmation = confirm("are you sure you want to remove the note?");
            if (confirmation) {
                $.ajax({
                    url: '<?php echo e(url('admin/delete-note')); ?>',
                    type: 'GET',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        getNote(user_id);
                    }
                });
            }
        });

        function getNote(user_id){
            $.ajax({
                url: '<?php echo e(url('admin/getnote')); ?>',
                type: 'GET',
                data: {
                    user_id: user_id,
                },
                dataType: 'json',
                success: function(data) {
                    $('#get_user_id').attr('action',user_id);
                    $('#GetNotes').html(data.success);
                    $('#message').val('');
                }
            });
        }

        $('#get_user_id').on('click', function (){

            var user_id = $(this).attr('action');
            var message = $('#message').val();

            $.ajax({
                url: '<?php echo e(url('admin/add-note')); ?>',
                type: 'POST',
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    user_id: user_id,
                    message,message,
                },
                dataType: 'json',
                success: function(data) {
                    $('#AddNote').modal('hide');
                    getNote(user_id);
                }
            });

        });


        $('table').delegate('.AssignStaff','change',function(){
            var user_id = $(this).attr('id');
            var staff_id = $(this).val();

            $.ajax({
                url: '<?php echo e(url('admin/assign-user-staff')); ?>',
                type: 'GET',
                data: {
                    user_id: user_id,
                    staff_id: staff_id,
                },
                dataType: 'json',
                success: function(data) {
                    alert('Staff successfully assign');
                }
            });
        });



        $(function () {
            var oTable = $('#user_datatable_ajax').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                "order": [[0, "desc"]],
                /*
                 paging: true,
                 info: true,
                 */
                ajax: {
                    url: '<?php echo route('fetch.data.users'); ?>',
                    data: function (d) {
                        d.id = $('input[name=id]').val();
                        d.name = $('input[name=name]').val();
                        // d.email = $('input[name=email]').val();

                        d.r_current_locatioin_id = $('#r_current_locatioin_id').val();
                        d.nationality_id = $('#nationality_id').val();
                        d.r_english_speaker_id = $('#r_english_speaker_id').val();
                        d.r_highest_education_id = $('#r_highest_education_id').val();
                        d.r_position_looking_id = $('#r_position_looking_id').val();
                        d.r_graduated_id = $('#r_graduated_id').val();
                        d.r_subject_education = $('#r_subject_education').val();
                        d.r_school_join_id = $('#r_school_join_id').val();
                        d.r_teach_id = $('#r_teach_id').val();
                        d.r_work_type_id = $('#r_work_type_id').val();
                        d.r_position_id = $('#r_position_id').val();
                        d.r_working_experience = $('#r_working_experience').val();
                        d.r_native_english_speaking = $('#r_native_english_speaking').val();
                        d.r_salary_id = $('#r_salary_id').val();
                        d.r_max_salary_id = $('#r_max_salary_id').val();
                        d.r_colour_id = $('#r_colour_id').val();
                        d.is_active = $('#is_active').val();
                        d.verified = $('#verified').val();
                        d.search_note = $('#search_note').val();
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        

                        
                        

                    }
                }, columns: [
                    /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                    {data: 'rule_id', name: 'rule_id',orderable: false},
                    {data: 'first_name', first_name: 'first_name'},
                    // {data: 'email', name: 'email'},
                    {data: 'colour', name: 'colour',orderable: false},
                    {data: 'nationality', name: 'nationality',orderable: false},

                    {data: 'current_location', name: 'current_location',orderable: false},

                        <?php if(Auth::user()->role_id == 1): ?>
                    {data: 'assign_staff', name: 'assign_staff', orderable: false, searchable: false},
                        <?php endif; ?>
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#user-search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#id').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#name').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
           $('#search_note').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });

            


            $('#email').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });


            $('.common_change').on('change', function (e) {
                oTable.draw();
                e.preventDefault();
            });




        });
        function delete_user(id) {
            if (confirm('Are you sure! you want to delete?')) {
                $.post("<?php echo e(route('delete.user')); ?>", {id: id, _method: 'DELETE', _token: '<?php echo e(csrf_token()); ?>'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#user_datatable_ajax').DataTable();
                            table.row('user_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
            }
        }
        function make_active(id) {
            $.post("<?php echo e(route('make.active.user')); ?>", {id: id, _method: 'PUT', _token: '<?php echo e(csrf_token()); ?>'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_active_' + id).attr("onclick", "make_not_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Make InActive");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
        }
        function make_not_active(id) {
            $.post("<?php echo e(route('make.not.active.user')); ?>", {id: id, _method: 'PUT', _token: '<?php echo e(csrf_token()); ?>'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_active_' + id).attr("onclick", "make_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Make Active");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
        }
        function make_verified(id) {
            $.post("<?php echo e(route('make.verified.user')); ?>", {id: id, _method: 'PUT', _token: '<?php echo e(csrf_token()); ?>'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_verified_' + id).attr("onclick", "make_not_verified(" + id + ")");
                        $('#onclick_verified_' + id).html("<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Verified");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
        }
        function make_not_verified(id) {
            $.post("<?php echo e(route('make.not.verified.user')); ?>", {id: id, _method: 'PUT', _token: '<?php echo e(csrf_token()); ?>'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_verified_' + id).attr("onclick", "make_verified(" + id + ")");
                        $('#onclick_verified_' + id).html("<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Not Verified");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
        }
        $('table').delegate('.rcolourid','change',function(){
            var user_id = $(this).attr('id');
            var r_colour_id = $(this).val();

            $.ajax({
                url: '<?php echo e(url('admin/user-colour')); ?>',
                type: 'GET',
                data: {
                    user_id: user_id,
                    r_colour_id: r_colour_id,
                },
                dataType: 'json',
                success: function(data) {
                    alert('Colour successfully Added');
                }
            });
        });

        /*$('#rcolourid').on('change', function(){
            var complaint_id = $('#r_colour_id').val();
            var selected = $(this).find('option:selected');
            var id = selected.data('id');
            console.log(id);
            $.post('',
                    {_token:'', r_colour_id:r_colour_id},
                    function(data){
                    location.reload();

                });

        });*/
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>