
<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(session()->has('success')): ?>
        <div class="alert alert-success">
        <?php if(is_array(session()->get('success'))): ?>
            <ul>
                <?php $__currentLoopData = session()->get('success'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($message); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <?php echo e(session()->get('success')); ?>

        <?php endif; ?>
            </div>
    <?php endif; ?>
    <?php if(count($errors) > 0): ?>
        <?php if($errors->any()): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo e($errors->first()); ?>


        </div>
        <?php endif; ?>
    <?php endif; ?>
    <br>
    <div class="card">
        <div class="card-header">
            <div class="col-6 card-title">
                <p style="float: left">Edit Country </p> 
            </div>
            <div class="col-6">                
                <a class="btn btn-primary" href="<?php echo e(route('admin.country.index')); ?>" style="float:right;">Back</a>
            </div>
        </div>
        <div class="card-body">
            <form class="form-group" action="<?php echo e(route('admin.country.update',$country->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <label id="folderLabel"><?php echo e(__('Cuntry Name')); ?></label>
                    <input type="text" name="country_name"  class="form-control" value="<?php echo e($country->country_name); ?>">
                </div>
                <div class="form-group mb-3">
                    <label id="folderLabel"><?php echo e(__('Country Code')); ?></label>
                    <input type="text" name="country_code"  class="form-control" value="<?php echo e($country->country_code); ?>">
                </div>
                <div class="form-group mb-3">
                    <label id="folderLabel"><?php echo e(__('Phone Code')); ?></label>
                    <input type="text" name="phone_code"  class="form-control" value="<?php echo e($country->phone_code); ?>">
                </div>
                <div class="form-group mb-3">
                    <label id="folderLabel"><?php echo e(__('Currency Symbol')); ?></label>
                    <input type="text" name="currency_symbol"  class="form-control" value="<?php echo e($country->currency_symbol); ?>">
                </div>
                <div class="form-group mb-3">
                    <label id="folderLabel"><?php echo e(__('Slug')); ?></label>
                    <input type="text"  name="slug"  class="form-control no-space" value="<?php echo e($country->slug); ?>">
                </div>
           
        </div>
        <div class="card-footer">
            <div>
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </div>
    </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script type="text/javascript">
$(document).ready(function() {

// do not allow users to enter spaces:
$(".no-space").on({
  keydown: function(event) {
    if (event.which === 32)
      return false;
  },
  // if a space copied and pasted in the input field, replace it (remove it):
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});

});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Codefuse\ecom\cashfuse-new\resources\views/admin/country/edit.blade.php ENDPATH**/ ?>