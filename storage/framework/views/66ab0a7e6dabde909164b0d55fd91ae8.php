<!DOCTYPE html>

<?php
    $rtl = get_session_language()->rtl;
?>

<?php if($rtl == 1): ?>
    <html dir="rtl" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<?php else: ?>
    <html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<?php endif; ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', get_setting('meta_description')); ?>" />
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', get_setting('meta_keywords')); ?>">
    <title><?php echo $__env->yieldContent('meta_title', get_setting('website_name') . ' | ' . get_setting('site_motto')); ?></title>

    <!-- Favicon -->
    <?php
        $site_icon = uploaded_asset(get_setting('site_icon'));
    ?>
    <link rel="icon" href="<?php echo e($site_icon); ?>">
    <link rel="apple-touch-icon" href="<?php echo e($site_icon); ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo e(static_asset('assets/css/vendors.css')); ?>">
    <?php if($rtl == 1): ?>
        <link rel="stylesheet" href="<?php echo e(static_asset('assets/css/bootstrap-rtl.min.css')); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(static_asset('assets/css/aiz-core.css?v=')); ?><?php echo e(rand(1000, 9999)); ?>">
    
    <style>
        :root{
            --blue: #3490f3;
            --hov-blue: #2e7fd6;
            --soft-blue: rgba(0, 123, 255, 0.15);
            --secondary-base: <?php echo e(get_setting('secondary_base_color', '#ffc519')); ?>;
            --hov-secondary-base: <?php echo e(get_setting('secondary_base_hov_color', '#dbaa17')); ?>;
            --soft-secondary-base: <?php echo e(hex2rgba(get_setting('secondary_base_color', '#ffc519'), 0.15)); ?>;
            --gray: #9d9da6;
            --gray-dark: #8d8d8d;
            --secondary: #919199;
            --soft-secondary: rgba(145, 145, 153, 0.15);
            --success: #85b567;
            --soft-success: rgba(133, 181, 103, 0.15);
            --warning: #f3af3d;
            --soft-warning: rgba(243, 175, 61, 0.15);
            --light: #f5f5f5;
            --soft-light: #dfdfe6;
            --soft-white: #b5b5bf;
            --dark: #292933;
            --soft-dark: #1b1b28;
            --primary: <?php echo e(get_setting('base_color', '#d43533')); ?>;
            --hov-primary: <?php echo e(get_setting('base_hov_color', '#9d1b1a')); ?>;
            --soft-primary: <?php echo e(hex2rgba(get_setting('base_color', '#d43533'), 0.15)); ?>;
        }
        body{
            font-family: <?php echo !empty(get_setting('system_font_family')) ? get_setting('system_font_family') : "'Public Sans', sans-serif"; ?>, sans-serif;
            font-weight: 400;
        }

        .form-control:focus {
            border-width: 2px !important;
        }
        @media (max-width: 991px) {
            .right-content{
                background: var(--white);
                margin-top: -60%;
                border-radius: 24px;
                min-height: 550px;
            }
        }
        @media (min-width: 991px) {
            .right-content{
                height: 100%;
            }
        }
    </style>

    <?php echo $__env->yieldContent('css'); ?>
    <script>
        var AIZ = AIZ || {};
    </script>
</head>
<body>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- SCRIPTS -->
    <?php echo $__env->make('auth.login_register_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('script'); ?>

</body>
</html>
<?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/auth/layouts/authentication.blade.php ENDPATH**/ ?>