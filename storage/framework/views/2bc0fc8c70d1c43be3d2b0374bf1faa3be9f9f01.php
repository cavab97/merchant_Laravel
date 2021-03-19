<?php $__env->startSection('page-title'); ?> <?php echo e(__('Orders')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="selection-datatable" class="table" width="100%">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Order Id')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Plan Name')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Payment Type')); ?></th>
                                <th><?php echo e(__('Coupon')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Invoice')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php ($color = ($order->payment_status == 'succeeded' || $order->payment_status == 'approved') ? 'success' : 'danger'); ?>
                                <tr>
                                    <td><?php echo e($order->order_id); ?></td>
                                    <td><?php echo e($order->user_name); ?></td>
                                    <td><?php echo e($order->plan_name); ?></td>
                                    <td><?php echo e(env('CURRENCY_SYMBOL')); ?><?php echo e(number_format($order->price)); ?></td>
                                    <td><i class="fas fa-circle text-<?php echo e($color); ?>"></i> <?php echo e(__(ucfirst($order->payment_status))); ?></td>
                                    <td><?php echo e(__($order->payment_type)); ?></td>
                                    <td><?php echo e(!empty($order->appliedCoupon->coupon_detail) ? (!empty($order->appliedCoupon->coupon_detail->code) ? $order->appliedCoupon->coupon_detail->code : '') : ''); ?></td>
                                    <td><?php echo e(Utility::dateFormat($order->created_at)); ?></td>
                                    <td class="Id sorting_1">
                                        <?php if(!empty($order->receipt)): ?>
                                            <a href="<?php echo e($order->receipt); ?>" target="_blank">
                                                <i class="fas fa-print mr-1"></i> <?php echo e(__('Invoice')); ?>

                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/order/index.blade.php ENDPATH**/ ?>