<script>
    function account_delete_confirm_modal(delete_url)
    {
        jQuery('#account_delete_confirm').modal('show', {backdrop: 'static'});
        document.getElementById('account_delete_link').setAttribute('href' , delete_url);
    }
</script>

<div class="modal fade" id="account_delete_confirm" tabindex="-1" role="dialog" aria-labelledby="account_delete_confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header d-block py-4">
                <div class="d-flex justify-content-center">
                    <span class="avatar avatar-md mb-2 mt-2">
                        <?php if(Auth::check() && Auth::user()->avatar_original != null): ?>
                            <img src="<?php echo e(uploaded_asset(Auth::user()->avatar_original)); ?>" class="m-auto"
                                onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/avatar-place.png')); ?>';" alt="<?php echo e(translate('avatar')); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(static_asset('assets/img/avatar-place.png')); ?>" class="image rounded-circle m-auto"
                                onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/avatar-place.png')); ?>';" alt="<?php echo e(translate('avatar')); ?>">
                        <?php endif; ?>
                    </span>
                </div>
                <h4 class="modal-title text-center fw-700" id="account_delete_confirmModalLabel" style="color: #ff9819;"><?php echo e(translate('Delete Your Account')); ?></h4>
                <p class="fs-16 fw-600 text-center" style="color: #8d8d8d;"><?php echo e(translate('Warning: You cannot undo this action')); ?></p>
            </div>

            <div class="modal-body pt-3 pb-5 px-xl-5">
                <p class="text-danger mt-3 fw-800"><i><?php echo e(translate('Note: ')); ?>&nbsp;<?php echo e(translate("Don't Click to any button or don't do any action during account Deletion, it may takes some times.")); ?></i></p>
                <p class="fs-14 fw-700" style="color: #8d8d8d;"><?php echo e(translate('Deleting Account Means:')); ?></p>
                <div class="row bg-soft-warning py-2 mb-2 ml-0 mr-0 border-left border-width-2 border-danger">
                    <div class="col-1">
                        <img src="<?php echo e(static_asset('assets/img/warning.png')); ?>" class="h-20px" alt="<?php echo e(translate('warning')); ?>">
                    </div>
                    <div class="col">
                        <p class="fw-600 mb-0"><?php echo e(translate('If you create any classified ptoducts, after deleting your account, those products will no longer in our system')); ?></p>
                    </div>
                </div>
                <div class="row bg-soft-warning py-3 ml-0 mr-0 border-left border-width-2 border-danger">
                    <div class="col-1">
                        <img src="<?php echo e(static_asset('assets/img/warning.png')); ?>" class="h-20px" alt="<?php echo e(translate('warning')); ?>">
                    </div>
                    <div class="col">
                        <p class="fw-600 mb-0"><?php echo e(translate('After deleting your account, wallet balance will no longer in our system')); ?></p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-0 w-150px" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                <a id="account_delete_link" class="btn btn-danger rounded-0 w-150px"><?php echo e(translate('Delete Account')); ?></a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/1565794.cloudwaysapps.com/aytqftgpga/public_html/resources/views/frontend/partials/account_delete_modal.blade.php ENDPATH**/ ?>