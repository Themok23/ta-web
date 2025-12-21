<script>
    function confirm_modal(delete_url)
    {
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                
                <h4 class="modal-title" id="myModalLabel"><?php echo e(translate('Confirmation')); ?></h4>
            </div>

            <div class="modal-body">
                <p><?php echo e(translate('Delete confirmation message')); ?></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                <a id="delete_link" class="btn btn-danger btn-ok rounded-0"><?php echo e(translate('Delete')); ?></a>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<?php if(!Auth::check()): ?>
<?php echo $__env->make('frontend.partials.login_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<!-- Bid Modal -->
<div class="modal fade" id="bid_for_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Bid For Product')); ?> <small id="min_bid_amount"></small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo e(route('auction_product_bids.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_id" id="bid_product_id" value="">
                    <div class="form-group">
                        <label class="form-label">
                            <?php echo e(translate('Place Bid Price')); ?>

                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <input type="number" step="0.01" class="form-control form-control-sm" name="amount" id="bid_amount" min="" placeholder="<?php echo e(translate('Enter Amount')); ?>" required>
                            <small class="text-danger" id="gst_applicable_alert"> </small>
                        </div>
                        
                    </div>
                    
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1"><?php echo e(translate('Submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/frontend/partials/modal.blade.php ENDPATH**/ ?>