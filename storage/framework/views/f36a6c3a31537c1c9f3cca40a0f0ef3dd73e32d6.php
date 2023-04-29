
<?php $__env->startSection('title','Cuelinks Advertiser List'); ?>

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
            <div class="card">
				<div class="card-header">
					<h2 class="page-title" align="left" style="width: 100%;">
                         Admitad Advertiser List
						
                       </h2>
					<div class="flex">
					<form id="dataSearch">
                    <?php echo csrf_field(); ?>
                    <!-- Search -->
                    <div class="d-flex fluid">
                        <input type="search" name="search" class="form-control" placeholder="search advertisers" aria-label="search advertisers">
                        &nbsp;<button type="submit" class="btn btn-success">Search</button>
                    </div>
                    <!-- End Search -->
						</form></div>&nbsp; <a  align="right" style="float:right !important;" href="<?php echo e(route('admin.admitadadvertisers.export-all-advertiser')); ?>" class="btn btn-danger  float-right">Export All </a>&nbsp;</div>
				
              <div class="card-body">
                 <div class="table" style="width:100%">
                  <table id="example" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
                            <th><button class="table-sort" data-sort="sort-image">Image</button></th>
                         <th><button class="table-sort" data-sort="sort-id">id</button></th>
						   <th><button class="table-sort" data-sort="sort-id">source</button></th>
                        <th><button class="table-sort" data-sort="sort-name">advertiser Name</button></th>
						  <th><button class="table-sort" data-sort="sort-name">Tagline</button></th>
						   <th><button class="table-sort" data-sort="sort-name">User Commission</button></th>
						  <th><button class="table-sort" data-sort="sort-name">Top Cashback</button></th>
						   <th><button class="table-sort" data-sort="sort-name">Added On</button></th>
                        <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody" id="table-div">
                 
                          <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td id="row"><?php echo e($key+$partners->firstItem()); ?></td>
                                    <td>
                                 
                               <img src="<?php echo e(asset('storage/app/public/partner')); ?>/<?php echo e($partner['image']); ?>" alt="no image" style="width:80px">
                              
                                </td>
                                    <td class="sort-id"><?php echo e($partner->id); ?></td>
									<td class="sort-id"><?php echo e($partner->affiliate_partner); ?></td>
                                    <td class="sort-name"> <?php echo e(Str::limit($partner['name'], 20,'...')); ?></td>
									<td class="sort-name"> <?php if($partner['tagline']!=NULL): ?>
										<b>Tagline : </b><p><?php echo e($partner->tagline); ?></p>
									      <?php endif; ?>
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#examplseModal<?php echo e($partner->id); ?>">
Add/Update Tagline</button>
								 </td>
									<td class="sort-name"> 
								   <?php ($name=\App\Models\BusinessSetting::where('key','default_commision')->first()->value); ?>
										<b>commission Percentage : </b> <?php if($partner['comission_percentage']==NULL): ?> <?php echo e($name); ?> % <?php else: ?> <?php echo e($partner['comission_percentage']); ?> % <?php endif; ?> <br>
										<b>commission Type : </b> <?php if($partner['comission_type']==1): ?> Cashback  <?php else: ?> Rewards <?php endif; ?><br>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#examplseModal1<?php echo e($partner->id); ?>">Commission Settings</button>
									 </td>
									 <td class="sort-role"> <center> <label class="form-check form-check-single form-switch" for="stocksCheckbox<?php echo e($partner->id); ?>">
                                          <input type="checkbox" class="form-check-input" onclick="myFunction<?php echo e($partner->id); ?>()" id="stocksCheckbox<?php echo e($partner->id); ?>" <?php echo e($partner->top_cashback?'checked':''); ?>>
                                          </label>
                                        </center>
                                        <script>
                                    function myFunction<?php echo e($partner->id); ?>() {
                                      if (window.confirm('Do you want to change the top cashback status?'))
                                    {
                                        window.location.href = "<?php echo e(route('admin.advertiser.top_cashback',[$partner->id,$partner->top_cashback?0:1])); ?>"
                                    }
                                    }
                                    </script>
                                                                            
                                    </td>
									<?php  $date=date_format($partner['created_at'],"d-M-Y"); ?>
									 <td class="sort-name"> <?php echo e($date); ?></td>
                                    <td class="sort-type">
                                    <div class="dropdown">
                                      <button class="btn btn-primary dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                      <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                                    href="<?php echo e(route('admin.advertiser.edit',[$partner['id']])); ?>" title="edit partner">Edit
                                                </a>
                                                <a  href="<?php echo e(route('admin.advertiser.delete',[$partner['id']])); ?>" class="dropdown-item" href="javascript:"
                                                    onclick="return confirm('Are you sure?');" title="delete partner">Delete
                                                </a>
                                      </div>
                                    </div>
                                    </td>
                                </tr>
						
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                  </table>
                </div>
              </div>
               <div class="card-footer page-area" align="right">
              <div class="pull-right mb-1" style="float: right;">
  <?php echo e($partners->render("pagination::bootstrap-4")); ?>

</div>
            </div>
            </div>
          </div>
        </div>
  <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="modal fade" id="examplseModal<?php echo e($partner->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo e($partner->id); ?>" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									   <form action="<?php echo e(route('admin.advertiser.update_tagline',$partner->id)); ?>" method="post" enctype="multipart/form-data">
                                         <?php echo csrf_field(); ?>
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="example2ModalLabel<?php echo e($partner->id); ?>" align="left">Add Tagline</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										 <div class="mb-3">
                              <label class="form-label required">Tagline</label>
                               <input type="text" name="tagline" class="form-control" value="<?php echo e($partner->tagline); ?>">
                            </div>
										 
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Save changes</button>
									  </div>
									</div>
								</form>
								  </div>
								</div>




<!--comission model-->
<div class="modal fade" id="examplseModal1<?php echo e($partner->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1<?php echo e($partner->id); ?>" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									   <form action="<?php echo e(route('admin.advertiser.update_comission',$partner->id)); ?>" method="post" enctype="multipart/form-data">
                                         <?php echo csrf_field(); ?>
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="example2ModalLabel1<?php echo e($partner->id); ?>" align="left">Commission Settings</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										 <div class="mb-3">
                              <label class="form-label required">Commission Type</label>
                               <select name="com_type" class="form-control" required>
								   <option value="1" <?php if($partner->comission_type==1): ?>selected <?php endif; ?>>Cashback</option>
								   <option value="0" <?php if($partner->comission_type==0): ?>selected <?php endif; ?>>Rewards</option>
								</select>
                            </div>
										  <div class="mb-3">
                              <label class="form-label required">% of user</label>
                               <input type="number" name="com_per" step="0.1" class="form-control" value="<?php echo e($partner->comission_percentage); ?>" required>
                            </div>
										 
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Save changes</button>
									  </div>
									</div>
								</form>
								  </div>
								</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('script_2'); ?>


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

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admitad_cashfuse\resources\views/admin/admitad/partner/index.blade.php ENDPATH**/ ?>