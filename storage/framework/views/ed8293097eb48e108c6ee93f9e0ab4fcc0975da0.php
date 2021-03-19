<?php $__env->startSection('page-title', __('Settings')); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs border-bottom-0">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#site-settings" class="active"><?php echo e(__('Site Setting')); ?></a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#task-stages-settings" class=""><?php echo e(__('Task Stages')); ?> </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#bug-stages-settings" class=""><?php echo e(__('Bug Stages')); ?> </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#taxes-settings" class=""><?php echo e(__('Taxes')); ?> </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#billing-settings" class=""><?php echo e(__('Billing')); ?> </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#payment-settings" class=""><?php echo e(__('Payment')); ?> </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#invoices-settings" class=""><?php echo e(__('Invoices')); ?> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="site-settings" class="tab-pane active  ">
                        <?php echo e(Form::open(array('route'=>['workspace.settings.store', $currentWorkspace->slug],'method'=>'post', 'enctype' => 'multipart/form-data'))); ?>

                        <div class="row justify-content-center">
                            <div class="col-md-12 col-sm-12">
                                <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Site settings')); ?></h4>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-4">
                                <h4 class="small-title"><?php echo e(__('Logo')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="<?php if($currentWorkspace->logo): ?><?php echo e(asset(Storage::url('logo/'.$currentWorkspace->logo))); ?><?php else: ?><?php echo e(asset(Storage::url('logo/logo-blue.png'))); ?><?php endif; ?>" class="big-logo"/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="logo">
                                            <div><?php echo e(__('Choose file here')); ?></div>
                                            <input type="file" class="form-control" name="logo" id="logo" data-filename="edit-logo">
                                        </label>
                                        <p class="edit-logo"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-4">
                                <h4 class="small-title"><?php echo e(__('Workspace Settings')); ?></h4>
                                <div class="card setting-card">
                                    <div class="form-group">
                                        <?php echo e(Form::label('name',__('Name'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('name',$currentWorkspace->name,array('class'=>'form-control', 'required' => 'required','placeholder'=>__('Enter Name')))); ?>

                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-name" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-2 col-lg-12">
                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <div id="task-stages-settings" class="tab-pane">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card task-stages" data-value="<?php echo e(json_encode($stages)); ?>">
                                    <div class="card-header">
                                        <h6 class="float-left">
                                            <?php echo e(__('Task Stages')); ?>

                                            <small class="d-block mt-2"><?php echo e(__('System will consider last stage as a completed / done task for get progress on project.')); ?></small>
                                        </h6>
                                        <button data-repeater-create type="button" class="btn-submit float-right">
                                            <i class="fas fa-plus mr-1"></i><?php echo e(__('Create')); ?>

                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo e(route('stages.store',$currentWorkspace->slug)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <table class="table table-hover" data-repeater-list="stages">
                                                <thead>
                                                <th>
                                                    <div data-toggle="tooltip" data-placement="left" data-title="<?php echo e(__('Drag Stage to Change Order')); ?>" data-original-title="" title="">
                                                        <i class="fas fa-crosshairs"></i>
                                                    </div>
                                                </th>
                                                <th><?php echo e(__('Color')); ?></th>
                                                <th><?php echo e(__('Name')); ?></th>
                                                <th class="text-right"><?php echo e(__('Delete')); ?></th>
                                                </thead>
                                                <tbody>
                                                <tr data-repeater-item>
                                                    <td><i class="fas fa-crosshairs sort-handler"></i></td>
                                                    <td>
                                                        <input type="color" name="color">
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="id" id="id"/>
                                                        <input type="text" name="name" class="form-control mb-0" required/>
                                                    </td>
                                                    <td class="text-right">
                                                        <a data-repeater-delete class="delete-icon"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="text-right p-4">
                                                <button class="btn-submit" type="submit"><?php echo e(__('Save')); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bug-stages-settings" class="tab-pane">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card bug-stages" data-value="<?php echo e(json_encode($bugStages)); ?>">
                                    <div class="card-header">
                                        <h6 class="float-left">
                                            <?php echo e(__('Bug Stages')); ?>

                                            <small class="d-block mt-2"><?php echo e(__('System will consider last stage as a completed / done task for get progress on project.')); ?></small>
                                        </h6>
                                        <button data-repeater-create type="button" class="btn-submit float-right">
                                            <i class="fas fa-plus mr-1"></i><?php echo e(__('Create')); ?>

                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo e(route('bug.stages.store',$currentWorkspace->slug)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <table class="table table-hover" data-repeater-list="stages">
                                                <thead>
                                                <th>
                                                    <div data-toggle="tooltip" data-placement="left" data-title="<?php echo e(__('Drag Stage to Change Order')); ?>" data-original-title="" title="">
                                                        <i class="fas fa-crosshairs"></i>
                                                    </div>
                                                </th>
                                                <th><?php echo e(__('Color')); ?></th>
                                                <th><?php echo e(__('Name')); ?></th>
                                                <th class="text-right"><?php echo e(__('Delete')); ?></th>
                                                </thead>
                                                <tbody>
                                                <tr data-repeater-item>
                                                    <td><i class="fas fa-crosshairs sort-handler"></i></td>
                                                    <td>
                                                        <input type="color" name="color">
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="id" id="id"/>
                                                        <input type="text" name="name" class="form-control mb-0" required/>
                                                    </td>
                                                    <td class="text-right">
                                                        <a data-repeater-delete class="delete-icon"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="text-right p-4">
                                                <button class="btn-submit" type="submit"><?php echo e(__('Save')); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="taxes-settings" class="tab-pane">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="float-left">
                                            <?php echo e(__('Taxes')); ?>

                                        </h6>
                                        <button class="btn-submit float-right" type="button" data-ajax-popup="true" data-title="<?php echo e(__('Add Tax')); ?>" data-url="<?php echo e(route('tax.create',$currentWorkspace->slug)); ?>">
                                            <i class="fas fa-plus mr-1"></i><?php echo e(__('Create')); ?>

                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">

                                            <table id="selection-datatable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(__('Name')); ?></th>
                                                    <th><?php echo e(__('Rate')); ?></th>
                                                    <th width="200px" class="text-right"><?php echo e(__('Action')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($tax->name); ?></td>
                                                        <td><?php echo e($tax->rate); ?>%</td>
                                                        <td class="text-right">
                                                            <a href="#" class="edit-icon" data-ajax-popup="true" data-title="<?php echo e(__('Edit Tax')); ?>" data-url="<?php echo e(route('tax.edit',[$currentWorkspace->slug,$tax->id])); ?>">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <a href="#" class="delete-icon" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($tax->id); ?>').submit();">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <form id="delete-form-<?php echo e($tax->id); ?>" action="<?php echo e(route('tax.destroy',[$currentWorkspace->slug,$tax->id])); ?>" method="POST" style="display: none;">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="billing-settings" class="tab-pane">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="float-left">
                                            <?php echo e(__('Billing Details')); ?>

                                        </h6>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="post" action="<?php echo e(route('workspace.settings.store',$currentWorkspace->slug)); ?>" class="payment-form">
                                            <?php echo csrf_field(); ?>
                                            <div class="row mt-3">
                                                <div class="form-group col-md-6">
                                                    <label for="company" class="form-control-label"><?php echo e(__('Name')); ?></label>
                                                    <input type="text" name="company" id="company" class="form-control" value="<?php echo e($currentWorkspace->company); ?>" required="required"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="address" class="form-control-label"><?php echo e(__('Address')); ?></label>
                                                    <input type="text" name="address" id="address" class="form-control" value="<?php echo e($currentWorkspace->address); ?>" required="required"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="city" class="form-control-label"><?php echo e(__('City')); ?></label>
                                                    <input class="form-control" name="city" type="text" value="<?php echo e($currentWorkspace->city); ?>" id="city">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="state" class="form-control-label"><?php echo e(__('State')); ?></label>
                                                    <input class="form-control" name="state" type="text" value="<?php echo e($currentWorkspace->state); ?>" id="state">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="zipcode" class="form-control-label"><?php echo e(__('Zip/Post Code')); ?></label>
                                                    <input class="form-control" name="zipcode" type="text" value="<?php echo e($currentWorkspace->zipcode); ?>" id="zipcode">
                                                </div>
                                                <div class="form-group  col-md-6">
                                                    <label for="country" class="form-control-label"><?php echo e(__('Country')); ?></label>
                                                    <input class="form-control" name="country" type="text" value="<?php echo e($currentWorkspace->country); ?>" id="country">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="telephone" class="form-control-label"><?php echo e(__('Telephone')); ?></label>
                                                    <input class="form-control" name="telephone" type="text" value="<?php echo e($currentWorkspace->telephone); ?>" id="telephone">
                                                </div>
                                            </div>

                                            <button type="submit" class="btn-submit"><?php echo e(__('Update')); ?></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="payment-settings" class="tab-pane">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="float-left">
                                            <?php echo e(__('Payment Details')); ?>

                                            <small class="d-block mt-2"><?php echo e(__("This detail will use for get payment of invoice from workspace's client")); ?></small>
                                        </h6>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="post" action="<?php echo e(route('workspace.settings.store',$currentWorkspace->slug)); ?>" class="payment-form">
                                            <?php echo csrf_field(); ?>
                                            <div class="row mt-3">
                                                <div class="form-group col-md-6">
                                                    <label for="currency" class="form-control-label"><?php echo e(__('Currency')); ?></label>
                                                    <input type="text" name="currency" id="currency" class="form-control" value="<?php echo e($currentWorkspace->currency); ?>" required="required"/>
                                                    <?php if($errors->has('currency')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('currency')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="currency_code" class="form-control-label"><?php echo e(__('Currency Code')); ?></label>
                                                    <input type="text" name="currency_code" id="currency_code" class="form-control" value="<?php echo e($currentWorkspace->currency_code); ?>" required="required"/>
                                                    <?php if($errors->has('currency_code')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('currency_code')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                    <small> <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?> <a href="https://stripe.com/docs/currencies" target="_new"><?php echo e(__('you can find out here.')); ?></a>.</small>
                                                </div>
                                            </div>

                                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                                <li>
                                                    <a class="active" id="stripe-settings-tab" data-toggle="tab" href="#stripe-settings-data" role="tab" aria-controls="home" aria-selected="false"> <?php echo e(__('Stripe')); ?> </a>
                                                </li>
                                                <li class="annual-billing">
                                                    <a id="paypal-settings-tab" data-toggle="tab" href="#paypal-settings-data" role="tab" aria-controls="profile" aria-selected="false"> <?php echo e(__('Paypal')); ?> </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade active show" id="stripe-settings-data" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <div class="custom-control custom-switch mt-2">
                                                                <input type="checkbox" class="custom-control-input" name="is_stripe_enabled" id="is_stripe_enabled" <?php echo e($currentWorkspace->is_stripe_enabled ? 'checked="checked"' : ''); ?>>
                                                                <label class="custom-control-label form-control-label" for="is_stripe_enabled"><?php echo e(__('Enable Stripe')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="stripe_key" class="form-control-label"><?php echo e(__('Stripe Key')); ?></label>
                                                            <input class="form-control" name="stripe_key" type="text" value="<?php echo e($currentWorkspace->stripe_key); ?>" id="stripe_key">
                                                            <?php if($errors->has('stripe_key')): ?>
                                                                <span class="invalid-feedback d-block">
                                                                    <?php echo e($errors->first('stripe_key')); ?>

                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="stripe_secret" class="form-control-label"><?php echo e(__('Stripe Secret')); ?></label>
                                                            <input class="form-control" name="stripe_secret" type="text" value="<?php echo e($currentWorkspace->stripe_secret); ?>" id="stripe_secret">
                                                            <?php if($errors->has('stripe_secret')): ?>
                                                                <span class="invalid-feedback d-block">
                                                                    <?php echo e($errors->first('stripe_secret')); ?>

                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="paypal-settings-data" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <div class="custom-control custom-switch mt-2">
                                                                <input type="checkbox" class="custom-control-input" name="is_paypal_enabled" id="is_paypal_enabled" <?php echo e($currentWorkspace->is_paypal_enabled ? 'checked="checked"' : ''); ?>>
                                                                <label class="custom-control-label form-control-label" for="is_paypal_enabled"><?php echo e(__('Enable Paypal')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="paypal_mode" class="form-control-label"><?php echo e(__('Paypal Mode')); ?></label>
                                                            <div class="selectgroup w-50">
                                                                <label class="selectgroup-item">
                                                                    <input type="radio" name="paypal_mode" value="sandbox" class="selectgroup-input" <?php echo e($currentWorkspace->paypal_mode == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                    <span class="selectgroup-button"><?php echo e(__('Sandbox')); ?></span>
                                                                </label>
                                                                <label class="selectgroup-item">
                                                                    <input type="radio" name="paypal_mode" value="live" class="selectgroup-input" <?php echo e($currentWorkspace->paypal_mode == 'live' ? 'checked="checked"' : ''); ?>>
                                                                    <span class="selectgroup-button"><?php echo e(__('Live')); ?></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="paypal_client_id" class="form-control-label"><?php echo e(__('Client ID')); ?></label>
                                                            <input class="form-control" name="paypal_client_id" type="text" value="<?php echo e($currentWorkspace->paypal_client_id); ?>" id="paypal_client_id">
                                                            <?php if($errors->has('paypal_client_id')): ?>
                                                                <span class="invalid-feedback d-block">
                                                                    <?php echo e($errors->first('paypal_client_id')); ?>

                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="paypal_secret_key" class="form-control-label"><?php echo e(__('Secret Key')); ?></label>
                                                            <input class="form-control" name="paypal_secret_key" type="text" value="<?php echo e($currentWorkspace->paypal_secret_key); ?>" id="paypal_secret_key">
                                                            <?php if($errors->has('paypal_secret_key')): ?>
                                                                <span class="invalid-feedback d-block">
                                                                    <?php echo e($errors->first('paypal_secret_key')); ?>

                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn-submit"><?php echo e(__('Update')); ?></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="invoices-settings" class="tab-pane">

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="float-left">
                                            <?php echo e(__('Invoice Footer Details')); ?>

                                            <small class="d-block mt-2"><?php echo e(__('This detail will be displayed into invoice footer.')); ?></small>
                                        </h6>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="post" action="<?php echo e(route('workspace.settings.store',$currentWorkspace->slug)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="invoice_footer_title" class="form-control-label"><?php echo e(__('Invoice Footer Title')); ?></label>
                                                    <input class="form-control" name="invoice_footer_title" type="text" value="<?php echo e($currentWorkspace->invoice_footer_title); ?>" id="invoice_footer_title">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="invoice_footer_notes" class="form-control-label"><?php echo e(__('Invoice Footer Notes')); ?></label>
                                                    <textarea class="form-control" name="invoice_footer_notes"><?php echo e($currentWorkspace->invoice_footer_notes); ?></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn-submit">
                                                        <?php echo e(__('Update')); ?>

                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="float-left">
                                            <?php echo e(__('Invoice')); ?>

                                        </h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <form action="<?php echo e(route('workspace.settings.store',$currentWorkspace->slug)); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="form-group">
                                                        <label for="address" class="form-control-label"><?php echo e(__('Invoice Template')); ?></label>
                                                        <select class="form-control select2" name="invoice_template">
                                                            <option value="template1" <?php if($currentWorkspace->invoice_template == 'template1'): ?> selected <?php endif; ?>>New York</option>
                                                            <option value="template2" <?php if($currentWorkspace->invoice_template == 'template2'): ?> selected <?php endif; ?>>Toronto</option>
                                                            <option value="template3" <?php if($currentWorkspace->invoice_template == 'template3'): ?> selected <?php endif; ?>>Rio</option>
                                                            <option value="template4" <?php if($currentWorkspace->invoice_template == 'template4'): ?> selected <?php endif; ?>>London</option>
                                                            <option value="template5" <?php if($currentWorkspace->invoice_template == 'template5'): ?> selected <?php endif; ?>>Istanbul</option>
                                                            <option value="template6" <?php if($currentWorkspace->invoice_template == 'template6'): ?> selected <?php endif; ?>>Mumbai</option>
                                                            <option value="template7" <?php if($currentWorkspace->invoice_template == 'template7'): ?> selected <?php endif; ?>>Hong Kong</option>
                                                            <option value="template8" <?php if($currentWorkspace->invoice_template == 'template8'): ?> selected <?php endif; ?>>Tokyo</option>
                                                            <option value="template9" <?php if($currentWorkspace->invoice_template == 'template9'): ?> selected <?php endif; ?>>Sydney</option>
                                                            <option value="template10" <?php if($currentWorkspace->invoice_template == 'template10'): ?> selected <?php endif; ?>>Paris</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label"><?php echo e(__('Color')); ?></label>
                                                        <div class="row gutters-xs">
                                                            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="col-auto">
                                                                    <label class="colorinput">
                                                                        <input name="invoice_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php if($currentWorkspace->invoice_color == $color): ?> checked <?php endif; ?>>
                                                                        <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                                    </label>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>

                                                    <button class="btn-submit" type="submit">
                                                        <?php echo e(__('Save')); ?>

                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-10">
                                                <iframe frameborder="0" width="100%" height="1080px" src="<?php echo e(route('invoice.preview',[$currentWorkspace->slug,($currentWorkspace->invoice_template)?$currentWorkspace->invoice_template:'template1',($currentWorkspace->invoice_color)?$currentWorkspace->invoice_color:'fff'])); ?>"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/repeater.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/colorPick.js')); ?>"></script>

    <script>

        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function () {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('iframe').attr('src', '<?php echo e(url($currentWorkspace->slug.'/invoices/preview')); ?>/' + template + '/' + color);
        });

        $(document).ready(function () {

            var $dragAndDrop = $("body .task-stages tbody").sortable({
                handle: '.sort-handler'
            });

            var $repeater = $('.task-stages').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('<?php echo e(__('Are you sure ?')); ?>')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });


            var value = $(".task-stages").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

            var $dragAndDropBug = $("body .bug-stages tbody").sortable({
                handle: '.sort-handler'
            });

            var $repeaterBug = $('.bug-stages').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('<?php echo e(__('Are you sure ?')); ?>')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function (setIndexes) {
                    $dragAndDropBug.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });


            var valuebug = $(".bug-stages").attr('data-value');
            if (typeof valuebug != 'undefined' && valuebug.length != 0) {
                valuebug = JSON.parse(valuebug);
                $repeaterBug.setList(valuebug);
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/users/setting.blade.php ENDPATH**/ ?>