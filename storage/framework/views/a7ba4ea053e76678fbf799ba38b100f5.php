

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('auth.'.get_setting('authentication_layout_select').'.admin_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function autoFillAdmin(){
            $('#email').val('admin@example.com');
            $('#password').val('123456');
        }
    </script>

     <?php if(get_setting('google_recaptcha') == 1 && get_setting('recaptcha_admin_login') == 1): ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(env('CAPTCHA_KEY')); ?>"></script>
        
        <script type="text/javascript">
                document.getElementById('login-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    grecaptcha.ready(function() {
                        grecaptcha.execute(`<?php echo e(env('CAPTCHA_KEY')); ?>`, {action: 'register'}).then(function(token) {
                            var input = document.createElement('input');
                            input.setAttribute('type', 'hidden');
                            input.setAttribute('name', 'g-recaptcha-response');
                            input.setAttribute('value', token);
                            e.target.appendChild(input);

                            var actionInput = document.createElement('input');
                            actionInput.setAttribute('type', 'hidden');
                            actionInput.setAttribute('name', 'recaptcha_action');
                            actionInput.setAttribute('value', 'recaptcha_admin_login');
                            e.target.appendChild(actionInput);
                            
                            e.target.submit();
                        });
                    });
                });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.layouts.authentication', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/auth/login.blade.php ENDPATH**/ ?>