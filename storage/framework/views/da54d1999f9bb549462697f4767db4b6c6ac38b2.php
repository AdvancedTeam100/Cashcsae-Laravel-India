
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
    <?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible">
         <?php echo session("error"); ?>

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
            <div class="col-6">            
            <h4 class=""><span style="border-bottom: 4px solid #6773ff;">Language </span></h4>
            </div>
            <div class="col-6">                
                <a class="btn btn-primary" href="<?php echo e(route('admin.language.index')); ?>" style="float:right;">Back</a>
            </div>
        </div>
        <form action="<?php echo e(route('admin.language.update',$language->id)); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card-body">            
                <div class="form-group">
                    <label id="folderLabel"><?php echo e(__('Language Name')); ?></label>
                    <input type="text" name="language_name" class="form-control" value="<?php echo e($language->language_name); ?>">
                </div>
                <div class="form-group">
                    <label id="folderLabel"><?php echo e(__('Language Code')); ?></label>
                    <input type="text" name="language_code" class="form-control" value="<?php echo e($language->language_code); ?>">
                </div>                 
            </div>
            <div class="card-footer">  
                <button class="btn btn-primary" type="submit" value="Submit">Submit</button>          
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Codefuse\ecom\cashfuse-new\resources\views/admin/language/edit.blade.php ENDPATH**/ ?>