<?php $__env->startSection('page-title'); ?> <?php echo e(__('Invoices')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if(auth()->guard('web')->check()): ?>
        <?php if($currentWorkspace->creater->id == Auth::user()->id): ?>
            <div class="all-button-box mb-3">
                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Invoice')); ?>" data-url="<?php echo e(route('invoices.create',$currentWorkspace->slug)); ?>">
                    <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                </a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-hover mb-0 animated" id="selection-datatable">
                                <thead>
                                <th><?php echo e(__('Invoice')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Issue Date')); ?></th>
                                <th><?php echo e(__('Due Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <?php if(auth()->guard('web')->check()): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="Id sorting_1">
                                            <a href="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('invoices.show',[$currentWorkspace->slug,$invoice->id])); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.invoices.show',[$currentWorkspace->slug,$invoice->id])); ?><?php endif; ?>">
                                                <?php echo e(Utility::invoiceNumberFormat($invoice->invoice_id)); ?>

                                            </a>
                                        </td>
                                        <td><?php echo e($invoice->project->name); ?></td>
                                        <td><?php echo e(Utility::dateFormat($invoice->issue_date)); ?></td>
                                        <td><?php echo e(Utility::dateFormat($invoice->due_date)); ?></td>
                                        <td><?php echo e($currentWorkspace->priceFormat($invoice->getTotal())); ?></td>
                                        <td>
                                            <?php if($invoice->status == 'sent'): ?>
                                                <span class="badge badge-warning"><?php echo e(__('Sent')); ?></span>
                                            <?php elseif($invoice->status == 'paid'): ?>
                                                <span class="badge badge-success"><?php echo e(__('Paid')); ?></span>
                                            <?php elseif($invoice->status == 'canceled'): ?>
                                                <span class="badge badge-danger"><?php echo e(__('Canceled')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <?php if(auth()->guard('web')->check()): ?>
                                            <td class="text-right">
                                                <a href="#" class="edit-icon" data-url="<?php echo e(route('invoices.edit',[$currentWorkspace->slug,$invoice->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Invoice')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="#" class="delete-icon" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($invoice->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoices.destroy',[$currentWorkspace->slug,$invoice->id]],'id'=>'delete-form-'.$invoice->id]); ?>

                                                <?php echo Form::close(); ?>

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

    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/invoices/index.blade.php ENDPATH**/ ?>