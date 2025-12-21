

<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <section class="pt-4 mb-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark">
                        <?php echo e(translate('All Categories')); ?>

                    </h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item has-transition opacity-60 hov-opacity-100">
                            <a class="text-reset" href="<?php echo e(route('home')); ?>"><?php echo e(translate('Home')); ?></a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            "<?php echo e(translate('All Categories')); ?>"
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- All Categories -->
    <section class="mb-5 pb-3">
        <div class="container">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-4 bg-white rounded-0 border">
                    <!-- Category Name -->
                    <a href="<?php echo e(route('products.category', $category->slug)); ?>" class="text-dark p-4 d-flex align-items-center">
                        <div class="size-60px overflow-hidden p-1 border mr-3">
                            <img src="<?php echo e(uploaded_asset($category->banner)); ?>" alt="" class="img-fit h-100">
                        </div>
                        <div class="text-reset fs-16 fs-md-20 fw-700 hov-text-primary">
                            <?php echo e($category->getTranslation('name')); ?>

                        </div>
                    </a>
                    <div class="px-4 py-2">
                        <div class="row row-cols-xl-5 row-cols-md-3 row-cols-sm-2 row-cols-1 gutters-16">
                            <?php $__currentLoopData = $category->childrenCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $child_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col text-left mb-3">
                                    <!-- Sub Category Name -->
                                    <h6 class="text-dark mb-3">
                                        <a class="text-reset fw-700 fs-14 hov-text-primary"
                                            href="<?php echo e(route('products.category', $child_category->slug)); ?>">
                                            <?php echo e($child_category->getTranslation('name')); ?>

                                        </a>
                                    </h6>

                                    <!-- Sub-sub Categories -->
                                    <ul
                                        class="mb-2 list-unstyled has-transition mh-100 <?php if($child_category->childrenCategories->count() > 5): ?> less <?php endif; ?>">
                                        <?php $__currentLoopData = $child_category->childrenCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $second_level_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="text-dark mb-2">
                                                <a class="text-reset fw-400 fs-14 hov-text-primary animate-underline-primary"
                                                    href="<?php echo e(route('products.category', $second_level_category->slug)); ?>">
                                                    <?php echo e($second_level_category->getTranslation('name')); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <?php if($child_category->childrenCategories->count() > 5): ?>
                                        <a href="javascript:void(1)"
                                            class="show-hide-cetegoty text-primary hov-text-primary fs-12 fw-700"><?php echo e(translate('More')); ?>

                                            <i class="las la-angle-down"></i></a>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $('.show-hide-cetegoty').on('click', function() {
            var el = $(this).siblings('ul');
            if (el.hasClass('less')) {
                el.removeClass('less');
                $(this).html('<?php echo e(translate('Less')); ?> <i class="las la-angle-up"></i>');
            } else {
                el.addClass('less');
                $(this).html('<?php echo e(translate('More')); ?> <i class="las la-angle-down"></i>');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/frontend/all_category.blade.php ENDPATH**/ ?>