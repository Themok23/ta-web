<div class="card-columns">
    <?php $__currentLoopData = $categories->childrenCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card shadow-none border-0">
            <ul class="list-unstyled mb-3">
                <li class="fs-14 fw-700 mb-3">
                    <a class="text-reset hov-text-primary" href="<?php echo e(route('products.category', $category->slug)); ?>">
                        <?php echo e($category->getTranslation('name')); ?>

                    </a>
                </li>
                <?php if($category->childrenCategories->count()): ?>
                    <?php $__currentLoopData = $category->childrenCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $child_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mb-2 fs-14 pl-2">
                            <a class="text-reset hov-text-primary animate-underline-primary" href="<?php echo e(route('products.category', $child_category->slug)); ?>">
                                <?php echo e($child_category->getTranslation('name')); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/frontend/partials/category_elements.blade.php ENDPATH**/ ?>