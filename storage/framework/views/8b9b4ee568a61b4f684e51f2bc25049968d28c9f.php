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
                <li> <span>Admin Users List</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Manage Admin Users <small>Admin Users</small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Admin User(s)</span> </div>
                        <div class="actions">
                            <a href="<?php echo e(route('create.admin.user')); ?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Admin User</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover"  id="admin_user_datatable_ajax">
                                <thead>
                                    <tr role="row" class="heading"> 
                                      <!--<th><input type="checkbox" class="group-checkable"></th>-->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <?php if(Auth::user()->role_id == 1): ?>                        
                                        <th style="width: 20%">Assign Company</th>
                                        <?php endif; ?>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY --> 
</div>


<div class="modal fade" id="PermissionModel" role="dialog">
    <div class="modal-dialog">
        <form action="" method="post" id="SavePermission">
          <?php echo e(csrf_field()); ?>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Permission</h4>
            </div>
            <div class="modal-body" id="getPermission">
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
        </form>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?> 
<script type="text/javascript">


    $('#PermissionModel').delegate('#SavePermission','submit',function(e){
        e.preventDefault();
  
       $.ajax({
          url: "<?php echo e(url('admin/save_permission')); ?>",
          type: "POST",
          data: $(this).serialize(),
          dataType:"json",
          success:function(response){
                $('#PermissionModel').modal('hide');
                alert(response.message);
          },
      });


    });

    $('table').delegate('.SetPermission','click',function(){
        var staff_id = $(this).attr('id');

        $.ajax({
            url: '<?php echo e(url('admin/get_permission')); ?>',
            type: 'POST',
            data: {
                staff_id: staff_id,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            dataType: 'json',
            success: function(data) {
                $('#getPermission').html(data.success);
                $('#PermissionModel').modal('show');
            }
        });


    });


     $('table').delegate('.AssignStaffSave','click',function(){

        var staff_id = $(this).attr('id');
        var company_id = $('#AssignCompany'+staff_id).val();

      $.ajax({
            url: '<?php echo e(url('admin/assign-staff-company')); ?>',
            type: 'GET',
            data: {
                staff_id: staff_id,
                company_id: company_id,
            },
            dataType: 'json',
            success: function(data) {
                alert('Company successfully assign');
            }
        });


    });


    //  $('table').delegate('.AssignCompany','change',function(){
    //     var staff_id = $(this).attr('id');
    //     var company_id = $(this).val();

    //       $.ajax({
    //             url: '<?php echo e(url('admin/assign-staff-company')); ?>',
    //             type: 'GET',
    //             data: {
    //                 staff_id: staff_id,
    //                 company_id: company_id,
    //             },
    //             dataType: 'json',
    //             success: function(data) {
    //                 alert('Company successfully assign');
    //             }
    //         });
    // });


    $(function () {
        $('#admin_user_datatable_ajax').DataTable({
            "order": [[0, "asc"]],
            processing: true,
            serverSide: true,
            stateSave: true,
            /*
             searching: false,
             paging: true,
             info: true,
             */
            ajax: '<?php echo route('fetch.data.admin.users'); ?>',
            columns: [
                /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                {data: 'name', name: 'admins.name'},
                {data: 'email', name: 'admins.email'},
                {data: 'role_name', name: 'roles.role_name'},
                <?php if(Auth::user()->role_id == 1): ?>
                {data: 'assign_company', name: 'assign_company'},
                <?php endif; ?>
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    function delete_user(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("<?php echo e(route('delete.admin.user')); ?>", {id: id, _method: 'DELETE', _token: '<?php echo e(csrf_token()); ?>'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#admin_user_datatable_ajax').DataTable();
                            table.row('admin_user_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }
</script> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>