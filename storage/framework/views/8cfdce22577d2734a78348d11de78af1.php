<!-- Top Bar Banner -->
<?php
    $top_banner_background_color = get_setting('top_banner_background_color', get_setting('base_color'));
    $top_banner_text_color = get_setting('top_banner_text_color');
    $top_banner_image = get_setting('top_banner_image');
    $top_banner_image_for_tabs = get_setting('top_banner_image_for_tabs');
    $top_banner_image_for_mobile = get_setting('top_banner_image_for_mobile');
    $topBanners = \App\Models\TopBanner::where('status', 1)->orderBy('id','desc')->get();
?> 
    <?php if(count($topBanners) > 0 || $top_banner_image != null): ?>
    <div class="position-relative top-banner removable-session z-1035 d-none" 
         data-key="top-banner" data-value="removed" style="background-color: <?php echo e($top_banner_background_color); ?>">
        <div class="d-block text-reset h-40px h-lg-60px position-relative overflow-hidden">

            <?php if($top_banner_image != null): ?>
            <!-- For Large device -->
            <img src="<?php echo e(uploaded_asset($top_banner_image)); ?>"
                class="d-none d-xl-block img-fit h-100 w-100" alt="<?php echo e(translate('top_banner')); ?>">

            <!-- For Medium device -->
            <img src="<?php echo e(uploaded_asset($top_banner_image_for_tabs ?? $top_banner_image)); ?>"
                class="d-none d-md-block d-xl-none img-fit h-100 w-100" alt="<?php echo e(translate('top_banner')); ?>">

            <!-- For Small device -->
            <img src="<?php echo e(uploaded_asset($top_banner_image_for_mobile ?? $top_banner_image)); ?>"
                class="d-md-none img-fit h-100 w-100" alt="<?php echo e(translate('top_banner')); ?>">
            <?php endif; ?>

            <!-- Scroll Text -->
            <div class="top-banner-scroll-text position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
                <div class="container">
                    <div class="overflow-hidden">
                        <div class="top-banner-scroll-inner">
                            <?php $__currentLoopData = $topBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($banner->link ?? '#'); ?>" style="color: <?php echo e($top_banner_text_color); ?>;"
                                    class="<?php echo e($banner->link ? 'has-link' : 'no-link'); ?>">
                                    <?php echo e($banner->getTranslation('text')); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn text-white h-100 absolute-top-right set-session" 
            data-key="top-banner" data-value="removed"
            data-toggle="remove-parent" data-parent=".top-banner">
            <i style="color: <?php echo e($top_banner_text_color); ?>;" class="la la-close la-2x"></i>
        </button>
    </div>
    <?php endif; ?>
	<?php echo $__env->make('header.' .get_element_type_by_id(get_setting('header_element')), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Top Menu Sidebar -->
<div class="aiz-top-menu-sidebar collapse-sidebar-wrap sidebar-xl sidebar-left d-lg-none z-1035">
    <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".aiz-top-menu-sidebar"
        data-same=".hide-top-menu-bar"></div>
    <div class="collapse-sidebar c-scrollbar-light text-left">
        <button type="button" class="btn btn-sm p-4 hide-top-menu-bar" data-toggle="class-toggle"
            data-target=".aiz-top-menu-sidebar">
            <i class="las la-times la-2x text-primary"></i>
        </button>
        <?php if(auth()->guard()->check()): ?>
            <span class="d-flex align-items-center nav-user-info pl-4">
                <!-- Image -->
                <span class="size-40px rounded-circle overflow-hidden border border-transparent nav-user-img">
                    <?php if($user->avatar_original != null): ?>
                        <img src="<?php echo e($user_avatar); ?>" class="img-fit h-100" alt="<?php echo e(translate('avatar')); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/avatar-place.png')); ?>';">
                    <?php else: ?>
                        <img src="<?php echo e(static_asset('assets/img/avatar-place.png')); ?>" class="image"
                            alt="<?php echo e(translate('avatar')); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/avatar-place.png')); ?>';">
                    <?php endif; ?>
                </span>
                <!-- Name -->
                <h4 class="h5 fs-14 fw-700 text-dark ml-2 mb-0"><?php echo e($user->name); ?></h4>
            </span>
        <?php else: ?>
            <!--Login & Registration -->
            <span class="d-flex align-items-center nav-user-info pl-4">
                <!-- Image -->
                <span
                    class="size-40px rounded-circle overflow-hidden border d-flex align-items-center justify-content-center nav-user-img">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19.902" height="20.012" viewBox="0 0 19.902 20.012">
                        <path id="fe2df171891038b33e9624c27e96e367"
                            d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1.006,1.006,0,1,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1,10,10,0,0,0-6.25-8.19ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z"
                            transform="translate(-2.064 -1.995)" fill="#91919b" />
                    </svg>
                </span>

                <a href="<?php echo e(route('user.login')); ?>"
                    class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block border-right border-soft-light border-width-2 pr-2 ml-3"><?php echo e(translate('Login')); ?></a>
                <a href="<?php echo e(route('user.registration')); ?>"
                    class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block py-2 pl-2"><?php echo e(translate('Registration')); ?></a>
            </span>
            
        <?php endif; ?>
        <hr>
        <ul class="mb-0 pl-3 pb-3 h-100">
            <?php if(get_setting('header_menu_labels') != null): ?>
                <?php $__currentLoopData = json_decode(get_setting('header_menu_labels'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="mr-0">
                        <a href="<?php echo e(json_decode(get_setting('header_menu_links'), true)[$key]); ?>"
                            class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                                    <?php if(url()->current() == json_decode(get_setting('header_menu_links'), true)[$key]): ?> active <?php endif; ?>">
                            <?php echo e(translate($value)); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
                <?php if(isAdmin()): ?>
                    <hr>
                    <li class="mr-0">
                        <a href="<?php echo e(route('admin.dashboard')); ?>"
                            class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links">
                            <?php echo e(translate('My Account')); ?>

                        </a>
                    </li>
                <?php else: ?>
                    <hr>
                    <li class="mr-0">
                        <a href="<?php echo e(route('dashboard')); ?>" class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                                        <?php echo e(areActiveRoutes(['dashboard'], ' active')); ?>">
                            <?php echo e(translate('My Account')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(isCustomer()): ?>
                    <li class="mr-0">
                        <a href="<?php echo e(route('customer.all-notifications')); ?>" class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                                        <?php echo e(areActiveRoutes(['customer.all-notifications'], ' active')); ?>">
                            <?php echo e(translate('Notifications')); ?>

                        </a>
                    </li>
                    <li class="mr-0">
                        <a href="<?php echo e(route('wishlists.index')); ?>" class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                                        <?php echo e(areActiveRoutes(['wishlists.index'], ' active')); ?>">
                            <?php echo e(translate('Wishlist')); ?>

                        </a>
                    </li>
                    <li class="mr-0">
                        <a href="<?php echo e(route('compare')); ?>" class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                                        <?php echo e(areActiveRoutes(['compare'], ' active')); ?>">
                            <?php echo e(translate('Compare')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <hr>
                <li class="mr-0">
                    <a href="<?php echo e(route('logout')); ?>"
                        class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-primary header_menu_links">
                        <?php echo e(translate('Logout')); ?>

                    </a>
                </li>
            <?php endif; ?>
        </ul>
        <br>
        <br>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function show_order_details(order_id) {
            $('#order-details-modal-body').html(null);

            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }

            $.post('<?php echo e(route('orders.details')); ?>', {
                _token: AIZ.data.csrf,
                order_id: order_id
            }, function (data) {
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }
    </script>
<?php $__env->stopSection(); ?><?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/frontend/inc/nav.blade.php ENDPATH**/ ?>