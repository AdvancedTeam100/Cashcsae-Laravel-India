
<?php $__env->startSection('title','Impact Ads List'); ?>

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
                    Ads List
                </h2>
                <div class="flex">
                    <form id="dataSearch">
                        <?php echo csrf_field(); ?>
                        <!-- Search -->
                        <div class="d-flex fluid">
                            <input type="search" name="search" class="form-control" placeholder="search ads"
                                aria-label="search ads">
                            &nbsp;<button type="submit" class="btn btn-success">Search</button>
                        </div>
                        <!-- End Search -->
                    </form>
                </div>&nbsp;<a align="right" style="float:right !important;"
                    href="<?php echo e(route('admin.impactads.export-all')); ?>" class="btn btn-danger  float-right">Export All
                </a>&nbsp;
            </div>
            <div class="card-body">
                <div class="table" style="width:100%">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th><button class="table-sort" data-sort="sort-s">#</button></th>
                                <th><button class="table-sort" data-sort="sort-image">Ad Name</button></th>
                                <th><button class="table-sort" data-sort="sort-image">Image</button></th>
                                <th><button class="table-sort" data-sort="sort-name">Description</button></th>
                                <th><button class="table-sort" data-sort="sort-image">Category</button></th>
                                <th><button class="table-sort" data-sort="sort-image">Status</button></th>

                                <th><button class="table-sort" data-sort="sort-email">Button</button></th>
                                <th><button class="table-sort" data-sort="sort-phone">Advertiser</button></th>
                                <th><button class="table-sort" data-sort="sort-phone">Added On</button></th>
                                <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            <?php $__currentLoopData = $em; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td id="row"><?php echo e($k+$em->firstItem()); ?></td>
                                <td class="sort-name"> <?php echo e($e['name']); ?></td>
                                <td>

                                    <img src="<?php echo e(asset('storage/app/public/offer')); ?>/<?php echo e($e['image']); ?>" alt="no image"
                                        style="width:80px">

                                </td>

                                <td class="sort-name"> <?php echo e($e['description']); ?></td>
                                <td class="sort-name"> <?php if($e->category_id != NULL): ?>
                                    <?php ($categories=\App\Models\Category::where(['position' => 0])->where('id' ,
                                    $e->category_id)->first()); ?>

                                    <?php echo e($categories['name']); ?>

                                    <?php else: ?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#exampleModal<?php echo e($e->id); ?>">
                                        Add Category</button>
                                    <?php endif; ?>
                                </td>
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
                                     window.location.href = "<?php echo e(route('admin.impactads.status',[$e->id,$e->status?0:1])); ?>"
                                 }
                                 }
                                 </script>  
                             </td>

                                <td class="sort-email"> <?php echo e($e['button_text']); ?><br>
                                </td>
                                <td class="sort-phone"> <?php echo e($e->partner['name']); ?></td>
                                <?php  $date=date_format($e['created_at'],"d-M-Y"); ?>
                                <td class="sort-name"> <?php echo e($date); ?></td>
                                <td class="sort-type">
                                    <span class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle align-text-top"
                                            data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="<?php echo e(route('admin.impactads.edit',[$e['id']])); ?>"
                                                title="edit category">Edit
                                            </a>
                                            <a href="<?php echo e(route('admin.impactads.delete',[$e['id']])); ?>"
                                                class="dropdown-item" href="javascript:"
                                                onclick="return confirm('Are you sure?');"
                                                title="delete category">Delete
                                            </a>
                                        </div>
                                    </span>
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
        <form action="<?php echo e(route('admin.impactads.update',[$e['id']])); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel<?php echo e($e->id); ?>" align="left">Assign Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" align="right">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="button_text" value="<?php echo e($e['button_text']); ?>">
                    <input type="hidden" name="description" value="<?php echo e($e['description']); ?>">
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlSelect1<?php echo e($e->id); ?>">Category<span
                                    class="input-label-secondary">*</span></label>
                            <?php ($categories=\App\Models\Category::where(['position' => 0])->get()); ?>
                            <select name="category_id" class="form-control js-select2-custom">
                                <option value="">---Select---</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
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
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Codefuse\ecom\cashfuse-new\resources\views/admin/impact/offer/list.blade.php ENDPATH**/ ?>