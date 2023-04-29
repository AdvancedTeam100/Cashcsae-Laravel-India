<?php $__env->startSection('title','Cuelinks Campaigns List'); ?>

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

    h5 {
        width: 100% !important;
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
                    Cuelink Campaign List

                </h2>
                <div class="flex">
                    <form id="dataSearch">
                        <?php echo csrf_field(); ?>
                        <!-- Search -->
                        <div class="d-flex fluid">
                            <input type="search" name="search" class="form-control" placeholder="search campaigns"
                                aria-label="search advertisers">
                            &nbsp;<button type="submit" class="btn btn-success">Search</button>
                        </div>
                        <!-- End Search -->
                    </form>
                </div>&nbsp;
                <a align="right" style="float:right !important;" href="<?php echo e(route('admin.cuelinkscampaigns.export-all')); ?>"
                    class="btn btn-danger  float-right">Export All </a>&nbsp;
            </div>
            <div class="card-body">
                <div class="table" style="width:100%">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th><button class="table-sort" data-sort="sort-s">#</button></th>
                                <th><button class="table-sort" data-sort="sort-image"> Name</button></th>
                                <th><button class="table-sort" data-sort="sort-image">Image</button></th>
                                <th><button class="table-sort" data-sort="sort-image">Description</button></th>
                                <th><button class="table-sort" data-sort="sort-name">Advertiser</button></th>
                                <th><button class="table-sort" data-sort="sort-image">Category</button></th>
                                <th><button class="table-sort" data-sort="sort-name">Status</button></th>
                                <th><button class="table-sort" data-sort="sort-name">Added On</button></th>
                                <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            <?php $__currentLoopData = $em; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td scope="row"><?php echo e($k+$em->firstItem()); ?></td>
                                <td class="sort-name"> <?php echo e($e['name']); ?></td>
                                <td class="sort-name"> <?php if($e['image']!=NULL): ?><img
                                        src="<?php echo e(asset('storage/app/public/offer')); ?>/<?php echo e($e['image']); ?>" alt="no image"
                                        style="width:80px"><br><br>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#exampleModal<?php echo e($e->id); ?>">
                                        Change Image</button>
                                </td>

                                <td class="sort-name"> <?php if($e['description']==NULL): ?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampl2eModal<?php echo e($e->id); ?>">Add Description</button>
                                    <?php else: ?>
                                    <p><?php echo e($e['description']); ?></p>
                                    <?php endif; ?>
                                </td>


                                <td class="sort-name"> <?php echo e($e['domain']); ?></td>
                                <td class="sort-name"><?php echo e($e['category']); ?> </td>
                                <td class="sort-role" align="center">

                                       <label class="form-check form-check-single form-switch" for="stocksCheckbox<?php echo e($e->id); ?>">
                                           <input type="checkbox" class="form-check-input"
                                               onclick="myFunction<?php echo e($e->id+1); ?>()" id="stocksCheckbox<?php echo e($e->id); ?>"
                                               <?php echo e($e->status?'checked':''); ?>>
                                       </label>
                                   
                                    <script>
                                        function myFunction<?php echo e($e->id+1); ?>() {
                                      if (window.confirm('Do you want to change the Status ?'))
                                    {
                                        window.location.href = "<?php echo e(route('admin.cuelinkscampaigns.campagns_status',[$e->id,$e->status?0:1])); ?>"
                                    }
                                    }
                                    </script>  
                                </td>
                                <?php  $date=date_format($e['created_at'],"d-M-Y"); ?>
                                <td class="sort-name"> <?php echo e($date); ?></td>
                                <td class="sort-type">
                                    <a href="<?php echo e(route('admin.cuelinkscampaigns.delete',$e['id'])); ?>"
                                        class="btn btn-danger" onclick="return confirm('Are you sure?');"
                                        title="delete campaign">Delete
                                    </a>

                                </td>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer" align="right">
                <div class="pull-right mb-1" style="float: right;">
                    <?php echo e($em->render("pagination::bootstrap-4")); ?>

                </div>


            </div>
        </div>
    </div>
</div>

<?php $__currentLoopData = $em; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="exampleModal<?php echo e($e->id); ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel<?php echo e($e->id); ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo e(route('admin.cuelinkscampaigns.update_cam_img',$e->id)); ?>" method="post"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel<?php echo e($e->id); ?>" align="left">Add Banner Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" align="right">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="viewerbox" style="display:none;margin-bottom:0%;">
                        <center>
                            <img style="width: 200px;border: 1px solid #3399db; border-radius: 10px; max-height:200px; padding: 11px;"
                                id="viewer" src="<?php echo e(asset('storage/app/public/offer')); ?>/<?php echo e($e['image']); ?>"
                                alt="offer banner" />
                        </center>
                    </div>

                    <div class="mb-3">
                        <div class="form-label">Campaigns Banner <small style="color: red">* (ratio=> 1:1)</small></div>
                        <input type="file" name="image" id="customFileEg1" class="form-control"
                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" />
                        <label class="custom-file-label" for="customFileEg1"></label>
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
<!-- Description -->
<div class="modal fade" id="exampl2eModal<?php echo e($e->id); ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel<?php echo e($e->id); ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo e(route('admin.cuelinkscampaigns.update_desc',$e->id)); ?>" method="post"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example2ModalLabel<?php echo e($e->id); ?>" align="left">Add Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" align="right">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">Description</label>
                        <textarea class="form-control" name="description"
                            id="summernote"><?php echo e($e['description']); ?></textarea>
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
    function getStoreData(route, store_id , id) {
            $.get({
                url: route+store_id,
                dataType: 'json',
                success: function (data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }
        
        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                    document.getElementById("image-viewer-section").style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
            $('#image-viewer-section').show(1000);
        });
</script>


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

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('public/theme_assets/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Codefuse\ecom\cashfuse-new\resources\views/admin/cuelinks/campaigns/list.blade.php ENDPATH**/ ?>