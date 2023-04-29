<?php $__env->startSection('title','Update Admob Settings'); ?>

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

.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.collapsible:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}

</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
          <div class="page-body">
          <div class="container-xl">
			  <div class="row">
			    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
            <div class="card">
                <div class="card-header"><h2 class="page-title">
                 Update Admob Settings
                </h2>
               </div>
              <div class="card-body">
				 <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12"> 
              <button class="collapsible">Banner Ads</button>
                

            <div class="content">
                 <br>
            <div class="table" style="width:100%">
                  <table id="example1" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-id">Ad ID</button></th>
                        <th><button class="table-sort" data-sort="sort-name">Ad Location</button></th>
                         <th><button class="table-sort" data-sort="sort-id">status</button></th>
                        <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody" >
                          <?php $__currentLoopData = $banner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ban): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="sort-id"><?php echo e($ban->ad_id); ?></td>
                                    <td class="sort-name"><?php if($ban->location==1): ?> Top Of the Homepage <?php endif; ?> <?php if($ban->location==2): ?> Middle Of the Homepage <?php endif; ?> <?php if($ban->location==3): ?> Bottom Of the Homepage <?php endif; ?></td>
                                    <td class="sort-id"><?php if($ban->status==1): ?> <b style="color:green !important">Enabled </b><?php else: ?> <b style="color:red !important">Disabled </b><?php endif; ?></td>
                                    <td class="sort-type">
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo e($ban->id); ?>">Edit</button>
                                   
                                    </td>
                                </tr>
                        
                        
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                  </table>
                </div>
 
         </div></div>
			 <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">	  
				  <button class="collapsible">Native Ads</button>
                

            <div class="content">
                 <br>
            <div class="table" style="width:100%">
                  <table id="example1" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-id">Ad ID</button></th>
                        <th><button class="table-sort" data-sort="sort-name">Ad Location</button></th>
                         <th><button class="table-sort" data-sort="sort-id">status</button></th>
                        <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody" >
                          <?php $__currentLoopData = $native; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ban): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="sort-id"><?php echo e($ban->ad_id); ?></td>
                                    <td class="sort-name"><?php if($ban->location==4): ?> Category List <?php endif; ?> <?php if($ban->location==5): ?> Campaign List <?php endif; ?></td>
                                    <td class="sort-id"><?php if($ban->status==1): ?> <b style="color:green !important">Enabled </b><?php else: ?> <b style="color:red !important">Disabled </b><?php endif; ?></td>
                                    <td class="sort-type">
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo e($ban->id); ?>">Edit</button>
                                    </td>
                                </tr>
                        
                        
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                  </table>
                </div>
 
         </div></div>
				  
	<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">	  
				  <button class="collapsible">Interstitial Ad</button>
                

            <div class="content">
                 <br>
				
				 <form action="<?php echo e(route('admin.admob.update',$interstitial->id)); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
					<div class="row">
					   <div class="col-12 col-lg-12 col-md-12">
                                     <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Enable/Disable</label>
                                            
											 <select name="status" class="form-control">
												 <option value="1" <?php if($interstitial->status==1): ?> selected <?php endif; ?>>Enable</option>
												  <option value="0" <?php if($interstitial->status==0): ?> selected <?php endif; ?>>Disable</option>
											</select>
                                         </div>
                                     </div>
						</div>
					  <div class="row">
                                     <div class="col-12 col-lg-6 col-md-6"  style="float:left">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Ad Id</label>
                                            <input type="text" name="ad_id" class="form-control" placeholder="" value="<?php echo e($interstitial->ad_id); ?>" required>
                                         </div>
                                        
                                         </div>
						    <div class="col-12 col-lg-6 col-md-6"  style="float:left">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Show After How Many Clicks</label>
                                            <input type="text" name="clicks" class="form-control"  value="<?php echo e($interstitial->clicks); ?>" required>
                                         </div>
                                        
                                </div>
						  </div>
					  <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
				</form>
        
 
         </div></div>
		  
				 
    </div> </div></div>
 </div></div></div>          
<?php $__currentLoopData = $banner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ban): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="modal fade" id="exampleModal<?php echo e($ban->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo e($ban->id); ?>" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									   <form action="<?php echo e(route('admin.admob.update',$ban->id)); ?>" method="post" enctype="multipart/form-data">
                                         <?php echo csrf_field(); ?>
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel<?php echo e($ban->id); ?>" align="left">Edit Ad</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"  align="right">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										  <div class="col-12 col-lg-12 col-md-12">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Enable/Disable</label>
                                            
											 <select name="status" class="form-control">
												 <option value="1" <?php if($ban->status==1): ?> selected <?php endif; ?>>Enable</option>
												  <option value="0" <?php if($ban->status==0): ?> selected <?php endif; ?>>Disable</option>
											</select>
                                         </div>
                                        
                                         </div>
										  
                                        <div class="col-12 col-lg-12 col-md-12">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Ad Id</label>
                                            <input type="text" name="ad_id" class="form-control"  value="<?php echo e($ban->ad_id); ?>" required>
                                         </div>
                                        
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
      

<?php $__currentLoopData = $native; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ban): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="modal fade" id="exampleModal<?php echo e($ban->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo e($ban->id); ?>" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									   <form action="<?php echo e(route('admin.admob.update',$ban->id)); ?>" method="post" enctype="multipart/form-data">
                                         <?php echo csrf_field(); ?>
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel<?php echo e($ban->id); ?>" align="left">Edit Ad</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"  align="right">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										  <div class="col-12 col-lg-12 col-md-12">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Enable/Disable</label>
                                            
											 <select name="status" class="form-control">
												 <option value="1" <?php if($ban->status==1): ?> selected <?php endif; ?>>Enable</option>
												  <option value="0" <?php if($ban->status==0): ?> selected <?php endif; ?>>Disable</option>
											</select>
                                         </div>
                                        
                                         </div>
										  
                                        <div class="col-12 col-lg-12 col-md-12">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Ad Id</label>
                                            <input type="text" name="ad_id" class="form-control"  value="<?php echo e($ban->ad_id); ?>" required>
                                         </div>
                                        
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
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
    
    
    <!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('public/theme_assets/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/cash.codefuse.org/httpdocs/newcashfuse/resources/views/admin/ad_networks/settings.blade.php ENDPATH**/ ?>