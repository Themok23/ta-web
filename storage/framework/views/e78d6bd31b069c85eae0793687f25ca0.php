<!-- aiz-main-wrapper -->
<div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white">
    <section class="bg-white overflow-hidden">
        <div class="row">
            <div class="col-xxl-6 col-xl-9 col-lg-10 col-md-7 mx-auto py-lg-4">
                <div class="card shadow-none rounded-0 border-0">
                    <div class="row no-gutters">
                        <!-- Left Side Image-->
                        <div class="col-lg-6">
                            <img src="<?php echo e(uploaded_asset(get_setting('admin_login_page_image'))); ?>" alt="<?php echo e(translate('Admin Login Page Image')); ?>" class="img-fit h-100">
                        </div>

                        <div class="col-lg-6 p-4 p-lg-5 d-flex flex-column justify-content-center border right-content" style="height: auto;">
                            <!-- Site Icon -->
                            <div class="size-48px mb-3 mx-auto mx-lg-0">
                                <img src="<?php echo e(uploaded_asset(get_setting('site_icon'))); ?>" alt="<?php echo e(translate('Site Icon')); ?>" class="img-fit h-100">
                            </div>

                            <!-- Titles -->
                            <div class="text-center text-lg-left">
                                <h1 class="fs-20 fs-md-20 fw-700 text-primary" style="text-transform: uppercase;"><?php echo e(translate('Welcome to')); ?> <?php echo e(env('APP_NAME')); ?></h1>
                                <h5 class="fs-14 fw-400 text-dark"><?php echo e(translate('Login to your account')); ?></h5>
                            </div>

                            <!-- Login form -->
                            <div class="pt-3">
                                <div class="">
                                    <form class="form-default" id="login-form" role="form" action="<?php echo e(route('login')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        
                                        <!-- Email -->
                                        <div class="form-group">
                                            <label for="email" class="fs-12 fw-700 text-soft-dark"><?php echo e(translate('Email')); ?></label>
                                            <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?> rounded-0" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(translate('johndoe@example.com')); ?>" name="email" id="email" autocomplete="off">
                                            <?php if($errors->has('email')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                            
                                        <!-- password -->
                                        <div class="form-group">
                                            <label for="password" class="fs-12 fw-700 text-soft-dark"><?php echo e(translate('Password')); ?></label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control rounded-0 <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(translate('Password')); ?>" name="password" id="password">
                                                <i class="password-toggle las la-2x la-eye"></i>
                                            </div>
                                        </div>

                                        <!-- Recaptcha -->
                                        <?php if(get_setting('google_recaptcha') == 1 && get_setting('recaptcha_admin_login') == 1): ?>
                                            
                                            <?php if($errors->has('g-recaptcha-response')): ?>
                                                <span class="border invalid-feedback rounded p-2 mb-3 bg-danger text-white" role="alert" style="display: block;">
                                                    <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <div class="row mb-2">
                                            <!-- Remember Me -->
                                            <div class="col-6">
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                                    <span class="has-transition fs-12 fw-400 text-gray-dark hov-text-primary"><?php echo e(translate('Remember Me')); ?></span>
                                                    <span class="aiz-square-check"></span>
                                                </label>
                                            </div>
                                            
                                            <!-- Forgot password -->
                                            <div class="col-6 text-right">
                                                <a href="<?php echo e(route('password.request')); ?>" class="text-reset fs-12 fw-400 text-gray-dark hov-text-primary"><u><?php echo e(translate('Forgot password?')); ?></u></a>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="mb-4 mt-4">
                                            <button type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-0"><?php echo e(translate('Login')); ?></button>
                                        </div>
                                    </form>

                                    <!-- DEMO MODE -->
                                    <?php if(env("DEMO_MODE") == "On"): ?>
                                        <div class="mt-4">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>admin@example.com</td>
                                                        <td>123456</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-info btn-xs" onclick="autoFillAdmin()"><?php echo e(translate('Copy')); ?></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Go Back -->
                    <div class="mt-3 mr-4 mr-md-0">
                        <a href="<?php echo e(url()->previous()); ?>" class="ml-auto fs-14 fw-700 d-flex align-items-center text-primary" style="max-width: fit-content;">
                            <i class="las la-arrow-left fs-20 mr-1"></i>
                            <?php echo e(translate('Back to Previous Page')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/auth/boxed/admin_login.blade.php ENDPATH**/ ?>