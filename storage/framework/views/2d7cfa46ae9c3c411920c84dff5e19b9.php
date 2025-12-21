<script src="<?php echo e(static_asset('assets/js/vendors.js')); ?>"></script>
<script>
    (function ($) {
        // USE STRICT
        "use strict";

        AIZ.data = {
            csrf: $('meta[name="csrf-token"]').attr("content"),
            appUrl: $('meta[name="app-url"]').attr("content"),
            fileBaseUrl: $('meta[name="file-base-url"]').attr("content"),
        };
        AIZ.plugins = {
            notify: function (type = "dark", message = "") {
                $.notify(
                    {
                        // options
                        message: message,
                    },
                    {
                        // settings
                        showProgressbar: true,
                        delay: 2500,
                        mouse_over: "pause",
                        placement: {
                            from: "bottom",
                            align: "left",
                        },
                        animate: {
                            enter: "animated fadeInUp",
                            exit: "animated fadeOutDown",
                        },
                        type: type,
                        template:
                            '<div data-notify="container" class="aiz-notify alert alert-{0}" role="alert">' +
                            '<button type="button" aria-hidden="true" data-notify="dismiss" class="close"><i class="las la-times"></i></button>' +
                            '<span data-notify="message">{2}</span>' +
                            '<div class="progress" data-notify="progressbar">' +
                            '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                            "</div>" +
                            "</div>",
                    }
                );
            }
        };

    })(jQuery);
</script>
<script>
    <?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        AIZ.plugins.notify('<?php echo e($message['level']); ?>', '<?php echo e($message['message']); ?>');
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    $('.password-toggle').click(function(){
        var $this = $(this);
        if ($this.siblings('input').attr('type') == 'password') {
            $this.siblings('input').attr('type', 'text');
            $this.removeClass('la-eye').addClass('la-eye-slash');
        } else {
            $this.siblings('input').attr('type', 'password');
            $this.removeClass('la-eye-slash').addClass('la-eye');
        }
    });
</script>

<?php if(addon_is_activated('otp_system')): ?>
    <script type="text/javascript">
        // Country Code
        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if (country.iso2 == 'bd') {
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "<?php echo e(static_asset('assets/js/intlTelutils.js')); ?>?1590403638580",
            onlyCountries: <?php echo get_active_countries()->pluck('code') ?>,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if (selectedCountryData.iso2 == 'bd') {
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;
            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el) {
            if (isPhoneShown) {
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('*<?php echo e(translate('Use Phone Number Instead')); ?>');

                $('.toggle-login-with-otp').addClass('d-none');

            } else {
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('<i>*<?php echo e(translate('Use Email Instead')); ?></i>');

                $('.toggle-login-with-otp').removeClass('d-none');
            }
            
            $('.submit-button').html('<?php echo e(translate('Login')); ?>');
            $('.password-login-block').removeClass('d-none');
            
            var url = '<?php echo e(route('login')); ?>';
            $('.loginForm').attr('action', url);
        }

        function toggleLoginPassOTP() {
            $('.password-login-block').addClass('d-none');
            $('.submit-button').html('<?php echo e(translate('Login With OTP')); ?>');

            var url = '<?php echo e(route('send-otp')); ?>';
            $('.loginForm').attr('action', url);
        }
    </script> 
<?php endif; ?>

<script>
    function showError(input, message) {
        const formGroup = input.closest('.form-group');
        $(formGroup).find('.invalid-feedback').remove(); 
        $(input).removeClass('is-valid').addClass('is-invalid');
        $(formGroup).append(`<div class="invalid-feedback d-block text-left">${message}</div>`);
    }


    document.addEventListener("input", function(e) {
        const input = e.target;
        if (input.hasAttribute("phone-number")) {
            const formGroup = input.closest('.form-group');
            const original = input.value;
            const numeric = original.replace(/[^0-9]/g, "");

            // Update input
            input.value = numeric;
            // Remove old errors
            $(formGroup).find('.invalid-feedback').remove();
            $(input).removeClass('is-invalid');

            // Show error if original != numeric
            if (original !== numeric) {
                $(input).addClass('is-invalid');
                $(formGroup).append(`<div class="invalid-feedback d-block text-left">
                    <?php echo e(translate('Please enter a valid phone number format')); ?>

                </div>`);
            }
        }
    });

</script><?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/auth/login_register_js.blade.php ENDPATH**/ ?>