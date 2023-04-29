
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
            <div class="row w-100"> 
                <div class="col-6">
                    <h4 class=""><span style="border-bottom: 4px solid #6773ff;">Language </span></h4>
                </div>
                <div class="col-6">                      
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addlanguage" style="float:right"><?php echo e(__('Add Language')); ?></button>
                </div>           
            </div>
            <div class=" justify-content-between align-items-center flex-wrap grid-margin">
              
                    <!-- Modal -->
                 <div class="modal fade" id="addlanguage" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="folderLabel">Add Language</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <form action="<?php echo e(route('admin.language.store')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="modal-body">                                            
                                    <div class="form-group">
                                    <label id="folderLabel"><?php echo e(__('Language Name')); ?></label>
                                    <input type="text" name="language_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                    <label id="folderLabel"><?php echo e(__('Language Code')); ?></label>
                                    <input type="text" name="language_code" class="form-control">
                                    </div>           
                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                    <button type="submit" id="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
                    <!-- Modal -->
                 <div class="modal fade" id="editlanguage" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="folderLabel">Add Language</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <form action="<?php echo e(route('admin.language.store')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="modal-body">                                            
                                    <div class="form-group">
                                    <label id="folderLabel"><?php echo e(__('Language Name')); ?></label>
                                    <input type="text" name="language_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                    <label id="folderLabel"><?php echo e(__('Language Code')); ?></label>
                                    <input type="text" name="language_code" class="form-control">
                                    </div>           
                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                    <button type="submit" id="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
        <div class="card-body">
            <div class="card-content collapse show">
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="data-table table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('#')); ?></th>
                                    <th><?php echo e(__('Language Name')); ?></th>
                                    <th><?php echo e(__('Language Code')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>                          
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
  
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(route('admin.language.index')); ?>",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'language_name',
                    name: 'language_name'
                },                
                {
                    data: 'language_code',
                    name: 'language_code'
                },                  
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });

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
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Codefuse\ecom\cashfuse-new\resources\views/admin/language/list.blade.php ENDPATH**/ ?>