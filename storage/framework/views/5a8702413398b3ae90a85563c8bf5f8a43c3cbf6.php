
<?php $__env->startSection('title','Update Product'); ?>

<?php $__env->startPush('css_or_js'); ?>
<style>
    .flex.justify-between.flex-1.sm\:hidden {
    display: none;
}
                    
p.text-sm.text-gray-700.leading-5 {
    display: none;
}
svg.w-5.h-5 {
    width: 22px !important;
}


a.relative.inline-flex.items-center.px-4.py-2.-ml-px.text-sm.font-medium.text-gray-700.bg-white.border.border-gray-300.leading-5.hover\:text-gray-500.focus\:z-10.focus\:outline-none.focus\:ring.ring-gray-300.focus\:border-blue-300.active\:bg-gray-100.active\:text-gray-700.transition.ease-in-out.duration-150 {
    margin: 3px;
    padding: 9px !important;
}



span.relative.inline-flex.items-center.px-4.py-2.-ml-px.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.cursor-default.leading-5 {
    background-color: blue !important;
    color: white;
    margin: 3px;
    padding: 10px !important;
}
hr{
    border-bottom:2px solid grey !important;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

          <div class="page-body">
          <div class="container-xl">
            <div class="card">
                <div class="card-header"><h2 class="page-title">
                  Update Product
                </h2></div>
              <div class="card-body">
               <form action="<?php echo e(route('admin.product.update',$product['id'])); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                            <div class="mb-3">
                              <label class="form-label required">Product name</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="product name" value="<?php echo e($product['name']); ?>"/>
                               <input type="hidden" name="position" value="0">
                            </div>
                            <div class="mb-3">
                              <label class="form-label required">Product Description</label>
                              <textarea name="desc" id="desc" class="form-control" id="summernote8"><?php echo e($product['description']); ?></textarea>
                            </div>
                              <div class="form-group"  id="viewerbox" style="margin-bottom:0%;">
                                <center>
                                    <img style="width: 200px;border: 1px solid #3399db; border-radius: 10px; padding: 11px;" id="viewer"
                                         <?php if(isset($product)): ?>
                                        src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($product['image']); ?>"
                                        <?php else: ?>
                                        src="<?php echo e(asset('assets/theme_assets/img')); ?>/upload1.png"
                                        <?php endif; ?>
                                        alt="image"/>
                                </center>
                             </div>
                            
                            <div class="mb-3">
                            <div class="form-label">Image <small style="color: red">* (ratio=>1:1)</small></div>
                            <input type="file"  name="image" id="customFileEg1" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"/>
                                <label class="custom-file-label" for="customFileEg1"></label>
                             </div>
                             <h3 align="center"> Add Prices</h3>
                             <div class="row">
                             <div class="container">
                                <?php $j=0; ?>
                             <?php if(count($product->product_prices)>0): ?>
                                	<?php $__currentLoopData = $product->product_prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                    <label class="form-label required" for="validationCustom01">Site name</label>
                                    <input type="text" id="validationCustom01" class="form-control" name="morefields[<?php echo e($j); ?>][site_name]" placeholder="site name" value="<?php echo e($fields['site_name']); ?>"/>
                                   
                                    </div>

                                    <div class="col-md-6">
                                    <div class="form-label" for="validationCustom01">Site Icon <small style="color: red">* (ratio=>1:1)</small></div>
                               <input type="file"  name="morefields[<?php echo e($j); ?>][site_image]" id="validationCustom01" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"/>
                                <label class="custom-file-label" for="validationCustom01"></label>
                                    </div>

                                    <div class="col-md-4">
                                    <label class="form-label required" for="validationCustom01">Product MRP</label>
                                    <input type="number" class="form-control" name="morefields[<?php echo e($j); ?>][mrp]" id="validationCustom01" placeholder="product mrp"  value="<?php echo e($fields['mrp']); ?>"/>
                                   
                                    </div>


                                    <div class="col-md-4">
                                    <label class="form-label required" for="validationCustom01">Product price</label>
                                    <input type="number" class="form-control" name="morefields[<?php echo e($j); ?>][price]" id="validationCustom01" placeholder="product price"  value="<?php echo e($fields['price']); ?>"/>
                                   
                                    </div>


                                    <div class="col-md-4">
                                    <label class="form-label required" for="validationCustom01">Product Url</label>
                                    <input type="text" class="form-control" name="morefields[<?php echo e($j); ?>][url]" id="validationCustom01"  placeholder="product url"  value="<?php echo e($fields['url']); ?>"/>
                                   
                                    </div>

                               </div>
                               <?php $j++; ?>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               <?php endif; ?>
                               <hr>
                               <div id="dynamicquestadd"></div>
                               <div class="col-12" align="right">
                                             
                                <label for="validationCustom01" class="form-label"></label><br>
                            <button type="button" name="add" id="add-questbtn" class="btn btn-primary">Add More</button>
                            <br>
                                </div>

                                </div>

                               
                            </div></div>
                             <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                         </form>
                            
                      </div></div></div></div>
                  

        <!-- Page body -->
         <!-- jQuery UI 1.11.4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>




<script type="text/javascript">
var j = <?php echo e($j); ?>-1;
var l=1;

$("#add-questbtn").click(function(){
++j;
++l;
$("#dynamicquestadd").append('<div class="row"><div class="col-md-6"><label class="form-label required" for="validationCustom01">Site name</label><input id="validationCustom01" type="text" class="form-control" name="morefields['+j+'][site_name]" placeholder="site name"/></div><div class="col-md-6"><div class="form-label" for="validationCustom01">Site Icon <small style="color: red">* (ratio=>1:1)</small></div><input type="file"  name="morefields['+j+'][site_image]" id="validationCustom01" class="form-control"accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required /><label class="custom-file-label" for="validationCustom01"></label></div><div class="col-md-4"><label class="form-label required" for="validationCustom01">Product MRP</label><input type="number" class="form-control" name="morefields['+j+'][mrp]" id="validationCustom01" placeholder="product mrp"/></div><div class="col-md-4"><label class="form-label required" for="validationCustom01">Product price</label><input type="number" class="form-control" name="morefields['+j+'][price]" id="validationCustom01" placeholder="product price"/></div><div class="col-md-4"><label class="form-label required" for="validationCustom01">Product Url</label><input type="text" class="form-control" name="morefields['+j+'][url]" id="validationCustom01" placeholder="product url"/></div></div><hr>');
});

$(document).on('click', '.remove-tr', function(){  
$(this).parents('div').remove();
});  

var a=0;
var b=1;
$("#add-optionbtn").click(function(){
++a;
++b;
$("#dynamicoptionadd").append('<div class="mt-2 mb-2 col-md-12" style="float:left"><input type="text" name="chatmorefields['+j+'][type]['+a+'][option]" class="form-control" placeholder="option-'+b+'"></div>');
});
</script>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('script_2'); ?>

<script type="text/javascript">
        $('#summernote8').summernote({
            height: 400
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
					document.getElementById("viewerbox").style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

         $("#customFileEg1").change(function () {
            readURL(this);
        });
    </script>
    
  
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admitad_cashfuse\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>