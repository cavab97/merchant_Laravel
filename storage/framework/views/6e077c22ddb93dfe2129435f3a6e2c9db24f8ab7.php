<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#site-settings" class="active"><?php echo e(__('Site Setting')); ?></a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#email-settings" class=""><?php echo e(__('Email Setting')); ?> </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#payment-settings" class=""><?php echo e(__('Payment Setting')); ?> </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#pusher-settings" class=""><?php echo e(__('Pusher Setting')); ?> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="site-settings" class="tab-pane in active">
                        <div class="col-md-12">
                            <?php echo e(Form::open(['route'=>'settings.store','method'=>'post', 'enctype' => 'multipart/form-data'])); ?>

                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Site settings')); ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-md-6">
                                    <h4 class="small-title"><?php echo e(__('Favicon')); ?></h4>
                                    <div class="card setting-card setting-logo-box">
                                        <div class="logo-content">
                                            <img src="<?php echo e(asset(Storage::url('logo/favicon.png'))); ?>" class="small-logo" alt=""/>
                                        </div>
                                        <div class="choose-file mt-5">
                                            <label for="favicon">
                                                <div><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control" name="favicon" id="small-favicon" data-filename="edit-favicon">
                                            </label>
                                            <p class="edit-favicon"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-md-6">
                                    <h4 class="small-title"><?php echo e(__('Logo')); ?></h4>
                                    <div class="card setting-card setting-logo-box">
                                        <div class="logo-content">
                                            <img src="<?php echo e(asset(Storage::url('logo/logo-blue.png'))); ?>" class="big-logo" alt=""/>
                                        </div>
                                        <div class="choose-file mt-5">
                                            <label for="logo_blue">
                                                <div><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control" name="logo_blue" id="logo_blue" data-filename="edit-logo_blue">
                                            </label>
                                            <p class="edit-logo_blue"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-md-6">
                                    <h4 class="small-title"><?php echo e(__('Landing Logo')); ?></h4>
                                    <div class="card setting-card setting-logo-box">
                                        <div class="logo-content">
                                            <img src="<?php echo e(asset(Storage::url('logo/logo-white.png'))); ?>" class="logo_white" alt=""/>
                                        </div>
                                        <div class="choose-file mt-5">
                                            <label for="logo_white">
                                                <div><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control" name="logo_white" id="logo_white" data-filename="edit-logo_white">
                                            </label>
                                            <p class="edit-logo_white"></p>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="display_landing" id="display_landing" <?php if(env('DISPLAY_LANDING') == 'on'): ?> checked <?php endif; ?>>
                                                <label class="custom-control-label form-control-label" for="display_landing"><?php echo e(__('Landing Page Display')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-md-6">
                                    <h4 class="small-title"><?php echo e(__('Settings')); ?></h4>
                                    <div class="card setting-card">
                                        <div class="form-group">
                                            <?php echo e(Form::label('app_name',__('App Name'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('app_name',env('APP_NAME'),array('class'=>'form-control','placeholder'=>__('App Name')))); ?>

                                            <?php $__errorArgs = ['app_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-app_name" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('footer_text',__('Footer Text'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('footer_text',env('FOOTER_TEXT'),array('class'=>'form-control','placeholder'=>__('Footer Text')))); ?>

                                            <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_text" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('default_language',__('Default Language'),array('class'=>'form-control-label'))); ?>

                                            <div class="changeLanguage">
                                                <select name="default_language" id="default_language" class="form-control select2">
                                                    <?php $__currentLoopData = $workspace->languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($lang); ?>" <?php if(env('DEFAULT_LANG') == $lang): ?> selected <?php endif; ?>>
                                                            <?php echo e(Str::upper($lang)); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-12 text-right">
                                    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit">
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                    <div id="email-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Email settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card p-3">
                                <?php echo e(Form::open(['route'=>'email.settings.store','method'=>'post'])); ?>

                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_driver',__('Mail Driver'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control','placeholder'=>__('Enter Mail Driver')))); ?>

                                        <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_host',__('Mail Host'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control ','placeholder'=>__('Enter Mail Driver')))); ?>

                                        <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_port',__('Mail Port'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control','placeholder'=>__('Enter Mail Port')))); ?>

                                        <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_port" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_username',__('Mail Username'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Username')))); ?>

                                        <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_username" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_password',__('Mail Password'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control','placeholder'=>__('Enter Mail Password')))); ?>

                                        <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_password" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_encryption',__('Mail Encryption'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))); ?>

                                        <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_encryption" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_from_address',__('Mail From Address'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Address')))); ?>

                                        <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_from_address" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_from_name',__('Mail From Name'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))); ?>

                                        <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_from_name" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                </div>
                                <div class="col-lg-12 ">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <a href="#" data-url="<?php echo e(route('test.email')); ?>" data-title="<?php echo e(__('Send Test Mail')); ?>" class="btn btn-sm btn-info send_email">
                                                <?php echo e(__('Send Test Mail')); ?>

                                            </a>
                                        </div>
                                        <div class="form-group col-md-6 text-right">
                                            <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                                        </div>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div id="payment-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Payment settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card p-3">
                                <?php echo e(Form::open(['route'=>'payment.settings.store','method'=>'post'])); ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('currency_symbol',__('Currency Symbol *'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('currency_symbol',env('CURRENCY_SYMBOL'),array('class'=>'form-control','required','placeholder'=>__('Enter Currency Symbol')))); ?>

                                            <?php $__errorArgs = ['currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-currency_symbol" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('currency',__('Currency *'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('currency',env('CURRENCY'),array('class'=>'form-control font-style','required','placeholder'=>__('Enter Currency')))); ?>

                                            <small> <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?><br> <a href="https://stripe.com/docs/currencies" target="_blank"><?php echo e(__('you can find out here..')); ?></a></small> <br>
                                            <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-currency" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-6 py-2">
                                        <h5 class="h5"><?php echo e(__('Stripe')); ?></h5>
                                    </div>
                                    <div class="col-6 py-2 text-right">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_stripe" id="enable_stripe" <?php echo e(env('ENABLE_STRIPE') == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="custom-control-label form-control-label" for="enable_stripe"><?php echo e(__('Enable Stripe')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo e(Form::label('stripe_key',__('Stripe Key'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('stripe_key',env('STRIPE_KEY'),['class'=>'form-control','placeholder'=>__('Enter Stripe Key')])); ?>

                                            <?php $__errorArgs = ['stripe_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-stripe_key" role="alert">
                                             <strong class="text-danger"><?php echo e($message); ?></strong>
                                         </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo e(Form::label('stripe_secret',__('Stripe Secret'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('stripe_secret',env('STRIPE_SECRET'),['class'=>'form-control ','placeholder'=>__('Enter Stripe Secret')])); ?>

                                            <?php $__errorArgs = ['stripe_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-stripe_secret" role="alert">
                                             <strong class="text-danger"><?php echo e($message); ?></strong>
                                         </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo e(Form::label('stripe_webhook_secret',__('Stripe Webhook Secret'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('stripe_webhook_secret',env('STRIPE_WEBHOOK_SECRET'),['class'=>'form-control ','placeholder'=>__('Enter Stripe Webhook Secret')])); ?>

                                            <?php $__errorArgs = ['stripe_webhook_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-stripe_webhook_secret" role="alert">
                                                     <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-6 py-2">
                                        <h5 class="h5"><?php echo e(__('PayPal')); ?></h5>
                                    </div>
                                    <div class="col-6 py-2 text-right">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_paypal" id="enable_paypal" <?php echo e(env('ENABLE_PAYPAL') == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="custom-control-label form-control-label" for="enable_paypal"><?php echo e(__('Enable Paypal')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pb-4">
                                        <label class="paypal-label form-control-label" for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label> <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-primary btn-sm  <?php echo e(env('PAYPAL_MODE') == '' || env('PAYPAL_MODE') == 'sandbox' ? 'active' : ''); ?>">
                                                <input type="radio" name="paypal_mode" value="sandbox"><?php echo e(__('Sandbox')); ?>

                                            </label>
                                            <label class="btn btn-primary btn-sm  <?php echo e(env('PAYPAL_MODE') == 'live' ? 'active' : ''); ?>">
                                                <input type="radio" name="paypal_mode" value="live"><?php echo e(__('Live')); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="paypal_client_id" class="form-control-label"><?php echo e(__('Client ID')); ?></label>
                                            <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="<?php echo e(env('PAYPAL_CLIENT_ID')); ?>" placeholder="<?php echo e(__('Client ID')); ?>"/>
                                            <?php if($errors->has('paypal_client_id')): ?>
                                                <span class="invalid-feedback d-block">
                                            <?php echo e($errors->first('paypal_client_id')); ?>

                                        </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="paypal_secret_key" class="form-control-label"><?php echo e(__('Secret Key')); ?></label>
                                            <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="<?php echo e(env('PAYPAL_SECRET_KEY')); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                            <?php if($errors->has('paypal_secret_key')): ?>
                                                <span class="invalid-feedback d-block">
                                            <?php echo e($errors->first('paypal_secret_key')); ?>

                                        </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div id="pusher-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Pusher settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card p-3">
                                <form method="POST" action="<?php echo e(route('pusher.settings.store')); ?>" accept-charset="UTF-8">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="enable_chat" id="enable_chat" value="yes" <?php echo e(env('CHAT_MODULE') == 'yes' ? 'checked="checked"' : ''); ?>>
                                                <label class="custom-control-label form-control-label" for="enable_chat"><?php echo e(__('Enable Chat')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_id" class="form-control-label"><?php echo e(__('Pusher App Id')); ?></label>
                                            <input class="form-control" placeholder="Enter Pusher App Id" name="pusher_app_id" type="text" value="<?php echo e(env('PUSHER_APP_ID')); ?>" id="pusher_app_id">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_key" class="form-control-label"><?php echo e(__('Pusher App Key')); ?></label>
                                            <input class="form-control " placeholder="Enter Pusher App Key" name="pusher_app_key" type="text" value="<?php echo e(env('PUSHER_APP_KEY')); ?>" id="pusher_app_key">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_secret" class="form-control-label"><?php echo e(__('Pusher App Secret')); ?></label>
                                            <input class="form-control " placeholder="Enter Pusher App Secret" name="pusher_app_secret" type="text" value="<?php echo e(env('PUSHER_APP_SECRET')); ?>" id="pusher_app_secret">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_cluster" class="form-control-label"><?php echo e(__('Pusher App Cluster')); ?></label>
                                            <input class="form-control " placeholder="Enter Pusher App Cluster" name="pusher_app_cluster" type="text" value="<?php echo e(env('PUSHER_APP_CLUSTER')); ?>" id="pusher_app_cluster">
                                        </div>
                                    </div>
                                    <div class="col-lg-12  text-right">
                                        <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).on("click", '.send_email', function (e) {
            e.preventDefault();
            var title = $(this).attr('data-title');

            var size = 'md';
            var url = $(this).attr('data-url');
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');

                $.post(url, {
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                }, function (data) {
                    $('#commonModal .modal-body .card-box').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function (e) {
            e.preventDefault();
            $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                beforeSend: function () {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('Error', data.message, 'error');
                    }
                    $("#email_sending").hide();
                },
                complete: function () {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/setting.blade.php ENDPATH**/ ?>