<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600"><?php echo e(translate('Login')); ?></h6>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <form class="form-default" role="form" action="<?php echo e(route('cart.login.submit')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <?php if(addon_is_activated('otp_system')): ?>
                            <!-- Phone -->
                            <div class="form-group phone-form-group mb-1">
                                <input type="tel" id="phone-code"
                                    class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                    value="<?php echo e(old('phone')); ?>" placeholder="" name="phone" autocomplete="off">
                            </div>
                            <!-- Country Code -->
                            <input type="hidden" name="country_code" value="">
                            <!-- Email -->
                            <div class="form-group email-form-group mb-1 d-none">
                                <input type="email"
                                    class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                    value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(translate('Email')); ?>" name="email"
                                    id="email" autocomplete="off">
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <!-- Use Email Instead -->
                            <div class="form-group text-right">
                                <button class="btn btn-link p-0 text-primary" type="button"
                                    onclick="toggleEmailPhone(this)"><i>*<?php echo e(translate('Use Email Instead')); ?></i></button>
                            </div>
                        <?php else: ?>
                            <!-- Email -->
                            <div class="form-group">
                                <input type="email"
                                    class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                    value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(translate('Email')); ?>" name="email"
                                    id="email" autocomplete="off">
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Password -->
                        <div class="form-group">
                            <input type="password" name="password" class="form-control h-auto rounded-0 form-control-lg"
                                placeholder="<?php echo e(translate('Password')); ?>">
                        </div>

                        <!-- Remember Me & Forgot password -->
                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                    <span class=opacity-60><?php echo e(translate('Remember Me')); ?></span>
                                    <span class="aiz-square-check"></span>
                                </label>
                            </div>
                            <div class="col-6 text-right">
                                <a href="<?php echo e(route('password.request')); ?>"
                                    class="text-reset opacity-60 hov-opacity-100 fs-14"><?php echo e(translate('Forgot password?')); ?></a>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="mb-5">
                            <button type="submit"
                                class="btn btn-primary btn-block fw-600 rounded-0"><?php echo e(translate('Login')); ?></button>
                        </div>
                    </form>

                    <!-- Register Now -->
                    <div class="text-center mb-3">
                        <p class="text-muted mb-0"><?php echo e(translate('Dont have an account?')); ?></p>
                        <a href="<?php echo e(route('user.registration')); ?>"><?php echo e(translate('Register Now')); ?></a>
                        
                    </div>
                    
                    <!-- Social Login -->
                    <?php if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1): ?>
                        <div class="separator mb-3">
                            <span class="bg-white px-3 opacity-60"><?php echo e(translate('Or Login With')); ?></span>
                        </div>
                        <ul class="list-inline social colored text-center mb-5">
                            <!-- Facebook -->
                            <?php if(get_setting('facebook_login') == 1): ?>
                                <li class="list-inline-item">
                                    <a href="<?php echo e(route('social.login', ['provider' => 'facebook'])); ?>"
                                        class="facebook">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <!-- Twitter -->
                            <?php if(get_setting('twitter_login') == 1): ?>
                                <li class="list-inline-item">
                                    <a href="<?php echo e(route('social.login', ['provider' => 'twitter'])); ?>"
                                        class="x-twitter">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#ffffff" viewBox="0 0 16 16" class="mb-2 pb-1">
                                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 
                                            .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <!-- Google -->
                            <?php if(get_setting('google_login') == 1): ?>
                                <li class="list-inline-item">
                                    <a href="<?php echo e(route('social.login', ['provider' => 'google'])); ?>"
                                        class="google">
                                        <i class="lab la-google"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <!-- Apple -->
                            <?php if(get_setting('apple_login') == 1): ?>
                                <li class="list-inline-item">
                                    <a href="<?php echo e(route('social.login', ['provider' => 'apple'])); ?>"
                                        class="apple">
                                        <i class="lab la-apple"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/frontend/partials/login_modal.blade.php ENDPATH**/ ?>