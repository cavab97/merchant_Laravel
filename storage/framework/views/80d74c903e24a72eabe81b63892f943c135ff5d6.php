<div class="table-responsive timesheet-table">
    <table id="dt-all-checkbox" class="table data-table" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class="th-sm">
                <span class="pr-1 text-left"><?php echo e(__('Task')); ?></span> <i class="fas fa-sort-alt"></i>
            </th>
            <?php $__currentLoopData = $days['datePeriod']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $perioddate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th class="th-sm">
                    <div class="day-name">
                        <p class="m-0"><?php echo e($perioddate->format('l d')); ?></p><small><?php echo e($perioddate->format('F')); ?></small>
                    </div>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th class="th-sm">
                <span class="pr-1"><?php echo e(__('Total')); ?></span>
            </th>
        </tr>
        </thead>
        <tbody>

        <?php if(isset($allProjects) && $allProjects == true): ?>

            <?php $__currentLoopData = $timesheetArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td colspan="9"><span class="project-name"><?php echo e($timesheet['project_name']); ?></span></td>
                </tr>

                <?php $__currentLoopData = $timesheet['taskArray']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $taskTimesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td colspan="9">
                            <div class="task-name ml-3">
                                <?php echo e($taskTimesheet['task_name']); ?>

                            </div>
                        </td>
                    </tr>

                    <?php $__currentLoopData = $taskTimesheet['dateArray']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateTimeArray): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td>
                                <div class="task blue ml-5">
                                    <?php echo e($dateTimeArray['user_name']); ?>

                                </div>
                            </td>

                            <?php $__currentLoopData = $dateTimeArray['week']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateSubArray): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <td>
                                    <?php if(auth()->guard('client')->check()): ?>
                                        <div class="day-time"><?php echo e($dateSubArray['time'] != '00:00' ? $dateSubArray['time'] : '-'); ?></div>
                                    <?php elseif(auth()->guard()->check()): ?>
                                        <div class="day-time" title="<?php echo e($dateSubArray['type'] == 'edit' ? __('Click to Edit/Delete Timesheet') : __('Click to Add Timesheet')); ?>" data-ajax-timesheet-popup="true" data-type="<?php echo e($dateSubArray['type']); ?>" data-user-id="<?php echo e($dateTimeArray['user_id']); ?>" data-project-id="<?php echo e($timesheet['project_id']); ?>" data-task-id="<?php echo e($taskTimesheet['task_id']); ?>" data-date="<?php echo e($dateSubArray['date']); ?>"
                                             data-url="<?php echo e($dateSubArray['url']); ?>"><?php echo e($dateSubArray['time'] != '00:00' ? $dateSubArray['time'] : '-'); ?></div>
                                    <?php endif; ?>
                                </td>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <div class="total day-time">
                                    <?php echo e($dateTimeArray['totaltime']); ?>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php else: ?>
            <?php $__currentLoopData = $timesheetArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <div class="task-name ml-3">
                            <?php echo e($timesheet['task_name']); ?>

                        </div>
                    </td>

                    <?php $__currentLoopData = $timesheet['dateArray']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $datetime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <td>
                            <?php if(auth()->guard('client')->check()): ?>
                                <div class="day-time"><?php echo e($datetime['time'] != '00:00' ? $datetime['time'] : '-'); ?></div>
                            <?php elseif(auth()->guard()->check()): ?>
                                <div class="day-time" title="<?php echo e($datetime['type'] == 'edit' ? __('Click to Edit/Delete Timesheet') : __('Click to Add Timesheet')); ?>" data-ajax-timesheet-popup="true" data-type="<?php echo e($datetime['type']); ?>" data-task-id="<?php echo e($timesheet['task_id']); ?>" data-date="<?php echo e($datetime['date']); ?>" data-url="<?php echo e($datetime['url']); ?>"><?php echo e($datetime['time'] != '00:00' ? $datetime['time'] : '-'); ?></div>
                            <?php endif; ?>
                        </td>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <td>
                        <div class="total day-time">
                            <?php echo e($timesheet['totaltime']); ?>

                        </div>
                    </td>
                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>

        </tbody>
        <tfoot>
        <tr class="footer-total">
            <td><?php echo e(__('Total')); ?></td>

            <?php $__currentLoopData = $totalDateTimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $totaldatetime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td>
                    <div class="value">
                        <?php echo e($totaldatetime != '00:00' ? $totaldatetime : '-'); ?>

                    </div>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <td>
                <div class="total-value">
                    <?php echo e($calculatedtotaltaskdatetime); ?>

                </div>
            </td>
        </tr>
        </tfoot>

    </table>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/projects/timesheet-week.blade.php ENDPATH**/ ?>