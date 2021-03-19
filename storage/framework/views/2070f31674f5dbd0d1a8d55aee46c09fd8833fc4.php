<?php $__env->startSection('page-title'); ?> <?php echo e(__('Tasks')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="card">
            <div class="card-body pt-3 pl-3">
                <div class="row">
                    <div class="col-md-2">
                        <select class="select2" size="sm" name="project" id="project">
                            <option value=""><?php echo e(__('All Projects')); ?></option>
                            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php if($currentWorkspace->permission == 'Owner'): ?>
                        <div class="col-md-2">
                            <select class="select2" size="sm" name="all_users" id="all_users">
                                <option value=""><?php echo e(__('All Users')); ?></option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-2">
                        <select class="select2" size="sm" name="status" id="status">
                            <option value=""><?php echo e(__('All Status')); ?></option>
                            <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($stage->id); ?>"><?php echo e(__($stage->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <select class="select2" size="sm" name="priority" id="priority">
                            <option value=""><?php echo e(__('All Priority')); ?></option>
                            <option value="Low"><?php echo e(__('Low')); ?></option>
                            <option value="Medium"><?php echo e(__('Medium')); ?></option>
                            <option value="High"><?php echo e(__('High')); ?></option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="month-btn form-control-light" id="duration1" name="duration" value="<?php echo e(__('Select Date Range')); ?>">
                        <input type="hidden" name="start_date1" id="start_date1">
                        <input type="hidden" name="due_date1" id="end_date1">
                    </div>
                    <div class="col-md-2">
                        <select class="select2" size="sm" name="due_date_order" id="due_date_order">
                            
                            <option value="due_date,asc"><?php echo e(__('Oldest')); ?></option>
                            <option value="due_date,desc"><?php echo e(__('Newest')); ?></option>
                        </select>
                    </div>
                    <button class="btn-create badge-blue btn-filter"><?php echo e(__('Apply')); ?></button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-centered table-hover mb-0 animated" id="tasks-selection-datatable">
                                <thead>
                                <th><?php echo e(__('Task')); ?></th>
                                <th><?php echo e(__('Project')); ?></th>
                                <th><?php echo e(__('Milestone')); ?></th>
                                <th><?php echo e(__('Due Date')); ?></th>
                                <?php if($currentWorkspace->permission == 'Owner' || Auth::user()->getGuard() == 'client'): ?>
                                    <th><?php echo e(__('Assigned to')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Priority')); ?></th>
                                <?php if($currentWorkspace->permission == 'Owner'): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(function () {
            // var start = moment().startOf('hour').add(-15,'day');
            // var end = moment().add(45,'day');
            function cb(start, end) {
                $("#duration1").val(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
                $('input[name="start_date1"]').val(start.format('YYYY-MM-DD'));
                $('input[name="due_date1"]').val(end.format('YYYY-MM-DD'));
            }

            $('#duration1').daterangepicker({
                // timePicker: true,
                autoApply: true,
                autoclose: true,
                autoUpdateInput: false,
                // startDate: start,
                // endDate: end,
                locale: {
                    format: 'MMM D, YY hh:mm A',
                    applyLabel: "<?php echo e(__('Apply')); ?>",
                    cancelLabel: "<?php echo e(__('Cancel')); ?>",
                    fromLabel: "<?php echo e(__('From')); ?>",
                    toLabel: "<?php echo e(__('To')); ?>",
                    daysOfWeek: [
                        "<?php echo e(__('Sun')); ?>",
                        "<?php echo e(__('Mon')); ?>",
                        "<?php echo e(__('Tue')); ?>",
                        "<?php echo e(__('Wed')); ?>",
                        "<?php echo e(__('Thu')); ?>",
                        "<?php echo e(__('Fri')); ?>",
                        "<?php echo e(__('Sat')); ?>"
                    ],
                    monthNames: [
                        "<?php echo e(__('January')); ?>",
                        "<?php echo e(__('February')); ?>",
                        "<?php echo e(__('March')); ?>",
                        "<?php echo e(__('April')); ?>",
                        "<?php echo e(__('May')); ?>",
                        "<?php echo e(__('June')); ?>",
                        "<?php echo e(__('July')); ?>",
                        "<?php echo e(__('August')); ?>",
                        "<?php echo e(__('September')); ?>",
                        "<?php echo e(__('October')); ?>",
                        "<?php echo e(__('November')); ?>",
                        "<?php echo e(__('December')); ?>"
                    ],
                }
            }, cb);
            // cb(start,end);
        });

        $(document).ready(function () {
            var table = $("#tasks-selection-datatable").DataTable({
                order: [],
                select: {style: "multi"},
                "language": dataTableLang,
                drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            });

            $(document).on("click", ".btn-filter", function () {
                getData();
            });

            function getData() {
                table.clear().draw();
                $("#tasks-selection-datatable tbody tr").html('<td colspan="11" class="text-center"> <?php echo e(__("Loading ...")); ?></td>');

                var data = {
                    project: $("#project").val(),
                    assign_to: $("#all_users").val(),
                    priority: $("#priority").val(),
                    due_date_order: $("#due_date_order").val(),
                    status: $("#status").val(),
                    start_date: $("#start_date1").val(),
                    end_date: $("#end_date1").val(),
                };

                $.ajax({
                    url: '<?php echo e(route('tasks.ajax',[$currentWorkspace->slug])); ?>',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        table.rows.add(data.data).draw();
                        loadConfirm();
                    },
                    error: function (data) {
                        show_toastr('Info', data.error, 'info')
                    }
                })
            }

            getData();

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/projects/tasks.blade.php ENDPATH**/ ?>