
<?php $__env->startSection('title','Update Settings'); ?>

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

element.style {
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
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
          <div class="page-body">
          <div class="container-xl">
            <div class="card">
                <div class="card-header"><h2 class="page-title">
                 Update Info/Settings
                </h2>
               </div>
              <div class="card-body">
               <form action="<?php echo e(route('admin.info-settings.update-setup')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
				   <div class="row">
				    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                        <?php ($name=\App\Models\BusinessSetting::where('key','business_name')->first()->value); ?>
                            <div class="mb-3">

                              <label class="form-label required">App name</label>
                              <input type="text" class="form-control" name="app_name" id="app_name" value="<?php echo e($name); ?>" placeholder="john" />
                            </div>
					   </div>
				    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
				   <?php ($commision=\App\Models\BusinessSetting::where('key','default_commision')->first()->value); ?>
                            <div class="mb-3">

                              <label class="form-label required">Commission share with users (%)</label>
                              <input type="text" class="form-control" name="commision" id="commision" value="<?php echo e($commision); ?>" placeholder="john" />
                            </div>
					     </div>
					   </div>
				  
				    <div class="row">
				    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                               <?php ($logo=\App\Models\BusinessSetting::where('key','logo')->first()->value); ?>
                               <center>
                                    <img style="height: 100px;border: 1px solid #3399db; border-radius: 10px; padding: 11px;" id="viewer"
                                        onerror="this.src='<?php echo e(asset('assets/theme_assets/img')); ?>/upload1.png'"
                                        src="<?php echo e(asset('storage/app/public/info/'.$logo)); ?>" alt="logo image"/>
                                </center>
                            
                             <div class="mb-3">
                            <div class="form-label">Logo <small style="color: red">* (ratio=> 1:1)</small></div>
                            <input type="file"  name="logo" id="customFileEg1" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" />
                                <label class="custom-file-label" for="customFileEg1"></label>
                             </div>
						</div>
						 <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                              <?php ($icon=\App\Models\BusinessSetting::where('key','icon')->first()->value); ?>
                                <center>
                                    <img style="height: 100px;border: 1px solid #3399db; border-radius: 10px; padding: 11px;" id="iconViewer"
                                        onerror="this.src='<?php echo e(asset('assets/theme_assets/img')); ?>/upload1.png'"
                                        src="<?php echo e(asset('storage/app/public/info/'.$icon)); ?>" alt="Fav icon"/>
                                </center>
                            
                             <div class="mb-3">
                            <div class="form-label">Favicon <small style="color: red">* (ratio=> 1:1)</small></div>
                            <input type="file"  name="icon" id="favIconUpload" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" />
                                <label class="custom-file-label" for="favIconUpload"></label>
                             </div></div></div>
				    <div class="row">
				    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                            <?php ($footer=\App\Models\BusinessSetting::where('key','footer_text')->first()->value); ?>
                             <div class="mb-3">
                              <label class="form-label required">Footer text</label>
                              <input type="text" class="form-control" name="footer_text" id="footer_text" value="<?php echo e($footer); ?>" placeholder="footer text"/>
                            </div>
				       </div>
				    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                            <?php ($minimum=\App\Models\BusinessSetting::where('key','minimum_redeem')->first()->value); ?>
                             <div class="mb-3">
                              <label class="form-label required">Minimum Redeem Value</label>
                              <input type="text" class="form-control" name="min_redeem" id="min_redeem" value="<?php echo e($minimum); ?>" placeholder="Minimum Redeem Value"/>
                            </div>
				       </div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                            <?php ($country=\App\Models\BusinessSetting::where('key','country')->first()->value); ?>
                             <div class="mb-3">
                              <label class="form-label required">Select Country</label>
							  <?php ($countrycode=\App\Models\Country::get()); ?>
								<select name="country" class="form-control">
									<?php $__currentLoopData = $countrycode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($coun->country_code); ?>" <?php if($coun->country_code==$country): ?> selected <?php endif; ?>><?php echo e($coun->country_name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								 </select>
                              
                            </div>
				       </div>
				   </div>
				   
                             <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                         </form> 
                            
                      </div></div></div></div>
                  

      



<?php $__env->stopSection(); ?>


<?php $__env->startPush('script_2'); ?>

    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            

            $('#dataSearch').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post({
                    url: '<?php echo e(route('admin.category.search')); ?>',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {
                        $('#table-div').html(data.view);
                        $('#itemCount').html(data.count);
                        $('.page-area').hide();
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                });
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    
     <script>
       function readURL(input, viewer) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+viewer).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this, 'viewer');
        });

        $("#favIconUpload").change(function () {
            readURL(this, 'iconViewer');
        });
    </script>
    
    <!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('public/theme_assets/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/cash.codefuse.org/httpdocs/newcashfuse/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>