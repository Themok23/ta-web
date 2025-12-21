<?php if(count($todays_deal_products) > 0): ?>
    <section class="">
        <div class="container">
            <?php
                $lang = get_system_language()->code;
                $todays_deal_banner = get_setting('todays_deal_banner', null, $lang);
                $todays_deal_banner_small = get_setting('todays_deal_banner_small', null, $lang);
            ?>
            <!-- Banner -->
            <?php if($todays_deal_banner != null || $todays_deal_banner_small != null): ?>
                <div class="overflow-hidden d-none d-md-block">
                    <img src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>"
                        data-src="<?php echo e(uploaded_asset($todays_deal_banner)); ?>" alt="<?php echo e(env('APP_NAME')); ?> promo"
                        class="lazyload img-fit h-100 has-transition"
                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>';">
                </div>
                <div class="overflow-hidden d-md-none">
                    <img src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>"
                        data-src="<?php echo e($todays_deal_banner_small != null ? uploaded_asset($todays_deal_banner_small) : uploaded_asset($todays_deal_banner)); ?>"
                        alt="<?php echo e(env('APP_NAME')); ?> promo" class="lazyload img-fit h-100 has-transition"
                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>';">
                </div>
            <?php endif; ?>
            <!-- Products -->
            <?php
                $todays_deal_banner_text_color =
                    get_setting('todays_deal_banner_text_color') == 'light' ||
                    get_setting('todays_deal_banner_text_color') == null
                        ? 'text-white'
                        : 'text-dark';
            ?>
            <div class="" style="background-color: <?php echo e(get_setting('todays_deal_bg_color', '#3d4666')); ?>">
                <div class="text-right px-4 px-xl-5 pt-4 pt-md-3">
                    <a href="<?php echo e(route('todays-deal')); ?>"
                        class="fs-12 fw-700 <?php echo e($todays_deal_banner_text_color); ?> has-transition hov-text-secondary-base"><?php echo e(translate('View All')); ?></a>
                </div>
                <div class="c-scrollbar-light overflow-hidden px-4 px-md-5 pb-3 pt-3 pt-md-3 pb-md-5">
                    <div class="h-100 d-flex flex-column justify-content-center">
                        <div class="todays-deal aiz-carousel" data-items="7" data-xxl-items="7" data-xl-items="6"
                            data-lg-items="5" data-md-items="4" data-sm-items="3.5" data-xs-items="3.5"
                            data-arrows="true" data-dots="false" data-autoplay="true" data-infinite="false"
                            data-center="false" data-variablewidth="false">
                            <?php $__currentLoopData = $todays_deal_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-box h-100 px-3 px-lg-0">
                                    <a href="<?php echo e(route('product', $product->slug)); ?>"
                                        class="h-100 overflow-hidden hov-scale-img mx-auto"
                                        title="<?php echo e($product->getTranslation('name')); ?>">
                                        <!-- Image -->
                                        <div class="img h-80px w-80px rounded-content overflow-hidden mx-auto">
                                            <img class="lazyload img-fit m-auto has-transition"
                                                src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                                data-src="<?php echo e(get_image($product->thumbnail)); ?>"
                                                alt="<?php echo e($product->getTranslation('name')); ?>"
                                                onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
                                        </div>
                                        <!-- Price -->
                                        <div class="fs-14 mr-1 mt-3 text-center">
                                            <span
                                                class="d-block <?php echo e($todays_deal_banner_text_color); ?> fw-700"><?php echo e(home_discounted_base_price($product)); ?></span>
                                            <?php if(home_base_price($product) != home_discounted_base_price($product)): ?>
                                                <del
                                                    class="d-block text-secondary fw-400"><?php echo e(home_base_price($product)); ?></del>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/frontend/classic/partials/todays_deal.blade.php ENDPATH**/ ?>