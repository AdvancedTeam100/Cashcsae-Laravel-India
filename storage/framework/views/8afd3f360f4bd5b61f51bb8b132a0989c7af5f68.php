<?php $__env->startSection('title','Update Cuelinks Settings'); ?>

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
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
          <div class="page-body">
          <div class="container-xl">
			  <div class="row">
			    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
            <div class="card">
                <div class="card-header"><h2 class="page-title">
                 Update Cuelinks Settings
                </h2>
               </div>
              <div class="card-body">
				 
                   <form action="<?php echo e(route('admin.cuelinks.update')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
				   
				  
				   <div class="mb-3">

                             <select name="status" class="form-control">
								 <option value="1" <?php if($cuelink->status==1): ?> selected <?php endif; ?>>Active</option>
								  <option value="0" <?php if($cuelink->status==0): ?> selected <?php endif; ?>>Deactive</option>
					        </select>
                            </div>
							 <div class="mb-3">

                              <label class="form-label required">Cuelink Channel ID</label>
                              <input type="text" class="form-control" name="channel" id="channel" value="<?php echo e($cuelink->channel_id); ?>" placeholder="234233" />
                            </div>
                            <div class="mb-3">

                              <label class="form-label required">Cuelink API Key</label>
                              <input type="text" class="form-control" name="apikey" id="apikey" value="<?php echo e($cuelink->apikey); ?>" placeholder="john" />
                            </div>
				  
				   
				  
                             <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
								 <?php if($cuelink): ?>
								 <?php if($cuelink->verified == 0): ?>
								  <a href="<?php echo e(route('admin.cuelinks.check')); ?>" onclick="return confirm('Are you sure?')" class="btn btn-success">Check Api Key</a>
								 <?php elseif($cuelink->verified == 1): ?>
								 <p style="color:green"  class="btn">verified</p>
								 <?php else: ?>
								 <p style="color:red"  class="btn">Unverified</p>
								 <?php endif; ?>
								 <?php endif; ?>
								 
                            </div>
				  
                         </form>
</div>
                      </div></div>
			  <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
				   <div class="card">
                <div class="card-header"><h2 class="page-title">
                 Fetch Data From Cuelinks
                </h2>
               </div>
              <div class="card-body">
				  <div class="row">
				   <div class="col-lg-6">
				   <a href="<?php echo e(route('admin.getcampaigns')); ?>" onclick="return confirm('Are you sure?')" class="btn btn-success">Import Campaigns</a>
				 
				   <a href="<?php echo e(route('admin.getoffers')); ?>" onclick="return confirm('Are you sure?')" class="btn btn-success">Import Offers</a>
						   </div><br>
					  <hr>
					<b><p style="color:red">Note:If any campaign or offer does not have the category defined, then the system will assign or create it automatically.</p></b>
					    <?php ($logo2=\App\Models\CuelinkOffer::where('affiliate_partner','cuelinks')->orderBy('id','desc')->first()
					  ); ?>
					   <?php if($logo2): ?>
					   <p style="color:grey;font-size: 15px;">Offers Last Updated on : <?php echo e(date('F jS, Y', strtotime($logo2->created_at))); ?></p>
					  <?php endif; ?>
					   <?php ($logod=\App\Models\CuelinkCampaign::where('affiliate_partner','cuelinks')->orderBy('id','desc')->first()); ?>  
					  
					  <?php if($logod): ?>
					   <p style="color:grey;font-size: 15px;">Campaigns Last Updated on : <?php echo e(date('F jS, Y', strtotime($logod->created_at))); ?></p>
					  <?php endif; ?>

 
					  
					  
					
						  <div class="progress" id="loader">
                              <div class="progress-bar progress-bar-indeterminate bg-green" id="loader"></div>
                            </div>
					  </div>
			 </div></div>
			  </div></div>
			  </div>
                  

      



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
			  <script>
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                  "body").style.visibility = "hidden";
                document.querySelector(
                  "#loader").style.visibility = "visible";
            } else {
                document.querySelector(
                  "#loader").style.display = "none";
                document.querySelector(
                  "body").style.visibility = "visible";
            }
        };
    </script>
    
    <!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('public/theme_assets/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/cash.codefuse.org/httpdocs/newcashfuse/resources/views/admin/cuelinks/settings.blade.php ENDPATH**/ ?>