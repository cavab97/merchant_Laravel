<?php $__env->startSection('page-title'); ?> <?php echo e(__('Dashboard')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="section">
        <?php if(Auth::user()->type=='admin'): ?>
            <div class="row">
                <div class="col-12">
                    <?php if(empty(env('PUSHER_APP_ID')) || empty(env('PUSHER_APP_KEY')) || empty(env('PUSHER_APP_SECRET')) || empty(env('PUSHER_APP_CLUSTER'))): ?>
                        <div class="alert alert-warning"><i class="fas fa-warning"></i> <?php echo e(__('Please Add Pusher Detail in Setting Page ')); ?><u><a href="<?php echo e(route('settings.index')); ?>"><?php echo e(__('here')); ?></a></u></div>
                    <?php endif; ?>
                    <?php if(empty(env('MAIL_DRIVER')) || empty(env('MAIL_HOST')) || empty(env('MAIL_PORT')) || empty(env('MAIL_USERNAME'))  || empty(env('MAIL_PASSWORD'))  || empty(env('MAIL_PASSWORD'))): ?>
                        <div class="alert alert-warning"><i class="fas fa-warning"></i> <?php echo e(__('Please Add Mail Details in Setting Page ')); ?> <u><a href="<?php echo e(route('settings.index')); ?>"><?php echo e(__('here')); ?></a></u></div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-info"><i class="fas fa-users"></i></div>
                            <h4><?php echo e(__('Total')); ?> <span><?php echo e($totalUsers); ?> <?php echo e(__('Users')); ?></span></h4>
                        </div>
                        <div class="mt-2">
                            <small class="font-weight-bold"><?php echo e($totalPaidUsers); ?></small> <small><?php echo e(__('Paid Users')); ?></small>
                        </div>
                    </div>
                    <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-success"><i class="fas fa-cash-register"></i></div>
                            <h4><?php echo e(__('Total')); ?> <span><?php echo e($totalUsers); ?> <?php echo e(__('Orders')); ?></span></h4>
                        </div>
                        <div class="mt-2">
                            <small class="font-weight-bold"><?php echo e((env('CURRENCY_SYMBOL') != '' ? env('CURRENCY_SYMBOL') : '$') . $totalOrderAmount); ?></small> <small><?php echo e(__('Order Amount')); ?></small>
                        </div>
                    </div>
                    <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-whitesmoke"><i class="fas fa-trophy"></i></div>
                            <h4><?php echo e(__('Total')); ?> <span><?php echo e($totalPlans); ?> <?php echo e(__('Plans')); ?></span></h4>
                        </div>
                        <div class="mt-2">
                            <small class="font-weight-bold"><?php if($mostPlans): ?> <?php echo e($mostPlans->name); ?> <?php else: ?> - <?php endif; ?></small> <small><?php echo e(__('Most purchase plan')); ?></small>
                        </div>
                    </div>
                    <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card animated">
                        <div class="card-header">
                            <h6 class="float-left">
                                <?php echo e(__('Recent Orders')); ?>

                                <small class="d-block mt-2"><?php echo e(__('Last Week Orders')); ?></small>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div id="task-area-chart" class="chartjs-render-monitor" height="210"></div>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif($currentWorkspace): ?>

            <div class="row mt-3">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-primary"><i class="fas fa-tasks"></i></div>
                            <h4><?php echo e(__('Total')); ?> <span><?php echo e(__('Projects')); ?></span></h4>
                        </div>
                        <div class="number-icon"><?php echo e($totalProject); ?></div>
                    </div>
                    <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-info"><i class="fas fa-tag"></i></div>
                            <h4><?php echo e(__('Total')); ?> <span><?php echo e(__('Tasks')); ?></span></h4>
                        </div>
                        <div class="number-icon"><?php echo e($totalTask); ?></div>
                    </div>
                    <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-success"><i class="fas fa-users"></i></div>
                            <h4><?php echo e(__('Total')); ?> <span><?php echo e(__('Members')); ?></span></h4>
                        </div>
                        <div class="number-icon"><?php echo e($totalMembers); ?></div>
                    </div>
                    <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-bug"></i></div>
                            <h4><?php echo e(__('Total')); ?> <span><?php echo e(__('Bugs')); ?></span></h4>
                        </div>
                        <div class="number-icon"><?php echo e($totalBugs); ?></div>
                    </div>
                    <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="float-left">
                                <?php echo e(__('Tasks Overview')); ?>

                                <small class="d-block mt-2"><?php echo e(__('Last Week Tasks')); ?></small>
                            </h6>
                        </div>
                        <div class="card-body py-0">
                            <div class="scrollbar-inner">
                                <div id="task-area-chart" class="chartjs-render-monitor" height="210"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card animated">
                        <div class="card-header">
                            <h6><?php echo e(__('Project Status')); ?></h6>
                        </div>
                        <div class="card-body">

                            <div class="chartjs-chart">
                                <div id="project-status-chart"></div>
                            </div>

                            <div class="row text-center mt-2 py-2">

                                <?php $__currentLoopData = $arrProcessPer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="col-4">
                                        <i class="fas fa-chart <?php echo e($arrProcessClass[$index]); ?> mt-3 h3"></i>
                                        <h6 class="font-weight-bold">
                                            <span><?php echo e($value); ?>%</span>
                                        </h6>
                                        <p class="text-muted mb-0"><?php echo e(__($arrProcessLabel[$index])); ?></p>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card animated">
                        <div class="card-header">
                            <h6 class="float-left">
                                <?php echo e(__('Tasks')); ?>

                                <small class="d-block mt-2"><b><?php echo e($completeTask); ?></b> <?php echo e(__('Tasks completed out of')); ?> <?php echo e($totalTask); ?></small>
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-centered table-hover mb-0 animated">
                                    <tbody>
                                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="font-14 my-1"><a href="<?php echo e(route('projects.task.board',[$currentWorkspace->slug,$task->project_id])); ?>" class="text-body"><?php echo e($task->title); ?></a></div>

                                                <?php ($due_date = '<span class="text-'.($task->due_date < date('Y-m-d') ? 'danger' : 'success').'">'.date('Y-m-d', strtotime($task->due_date)).'</span> '); ?>

                                                <span class="text-muted font-13"><?php echo e(__('Due Date')); ?> : <?php echo $due_date; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-13"><?php echo e(__('Status')); ?></span> <br/>
                                                <?php if($task->complete=='1'): ?>
                                                    <span class="badge badge-success"><?php echo e(__($task->status)); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-primary"><?php echo e(__($task->status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-muted font-13"><?php echo e(__('Project')); ?></span>
                                                <div class="font-14 mt-1 font-weight-normal"><?php echo e($task->project->name); ?></div>
                                            </td>
                                            <?php if($currentWorkspace->permission == 'Owner' || Auth::user()->getGuard() == 'client'): ?>
                                                <td>
                                                    <span class="text-muted font-13"><?php echo e(__('Assigned to')); ?></span>
                                                    <div class="font-14 mt-1 font-weight-normal">
                                                        <?php $__currentLoopData = $task->users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span class="badge badge-secondary"><?php echo e(isset($user->name) ? $user->name : '-'); ?></span>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0 mt-3 text-center text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title mb-0"><?php echo e(__('There is no active Workspace. Please create Workspace from right side menu.')); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/apexcharts.min.js')); ?>"></script>

    <?php if(Auth::user()->type=='admin'): ?>

        <script>

            var taskAreaOptions = {
                series: [
                    {
                        name: '<?php echo e(__("Order")); ?>',
                        data: <?php echo json_encode($chartData['data']); ?>

                    },
                ],
                chart: {
                    height: 350,
                    type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#37b37e'],
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                grid: {
                    borderColor: '#e7e7e7',
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                markers: {
                    size: 1
                },
                xaxis: {
                    categories: <?php echo json_encode($chartData['label']); ?>,
                    title: {
                        text: '<?php echo e(__("Days")); ?>'
                    }
                },
                yaxis: {
                    title: {
                        text: '<?php echo e(__("Orders")); ?>'
                    },

                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            setTimeout(function () {
                var taskAreaChart = new ApexCharts(document.querySelector("#task-area-chart"), taskAreaOptions);
                taskAreaChart.render();
            }, 100);

        </script>

    <?php elseif(isset($currentWorkspace) && $currentWorkspace): ?>
        <script>

            var taskAreaOptions = {
                series: [
                        <?php $__currentLoopData = $chartData['stages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        name: "<?php echo e(__($name)); ?>",
                        data: <?php echo json_encode($chartData[$id]); ?>

                    },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                chart: {
                    height: 350,
                    type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: <?php echo json_encode($chartData['color']); ?>,
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                grid: {
                    borderColor: '#e7e7e7',
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                markers: {
                    size: 1
                },
                xaxis: {
                    categories: <?php echo json_encode($chartData['label']); ?>,
                    title: {
                        text: '<?php echo e(__("Days")); ?>'
                    }
                },
                yaxis: {
                    title: {
                        text: '<?php echo e(__("Tasks")); ?>'
                    },

                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            setTimeout(function () {
                var taskAreaChart = new ApexCharts(document.querySelector("#task-area-chart"), taskAreaOptions);
                taskAreaChart.render();
            }, 100);

            var projectStatusOptions = {
                series: <?php echo json_encode($arrProcessPer); ?>,

                chart: {
                    height: '400px',
                    width: '500px',
                    type: 'pie',
                },
                colors: ["#00B8D9", "#36B37E", "#2359ee"],
                labels: <?php echo json_encode($arrProcessLabel); ?>,

                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        }
                    }
                },
                title: {
                    text: ""
                },
                dataLabels: {},
                legend: {
                    display: false
                },

            };
            var projectStatusChart = new ApexCharts(document.querySelector("#project-status-chart"), projectStatusOptions);
            projectStatusChart.render();

        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/home.blade.php ENDPATH**/ ?>