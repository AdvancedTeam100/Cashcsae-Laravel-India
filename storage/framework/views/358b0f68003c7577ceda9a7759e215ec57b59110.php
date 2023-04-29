
<?php $__env->startSection('title','All in One Search'); ?>

<?php $__env->startPush('css_or_js'); ?>
<link href="<?php echo e(url('assets/select/styles/multiselect.css')); ?>" rel="stylesheet" />
<script src="<?php echo e(url('assets/select/scripts/multiselect.min.js')); ?>"></script>
<style>
    /* example of setting the width for multiselect */
    #testSelect1_multiSelect {
        width: 100%;
    }

    .multiselect-wrapper .multiselect-list {
        padding: 5px;
        min-width: 91%;
        position: inherit !important;
    }

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
<div class="page-header d-print-none">
    <div class="page-body">
        <div class="container-xl">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="page-title">Add Website/Brand for All in One Search</h2>
                    </div>
                    <div class="card-body"> 
                        <input class="brand3" type="radio" name="brand"  value="admited"><strong class="m-2">Admited</strong> 
                        <input class="brand2" type="radio" name="brand"  value="cuelink" checked><strong class="m-2" >Cuelink</strong> 
                        <input class="brand1" type="radio" name="brand"  value="impact"><strong class="m-2">Impact</strong>
                    </div>
                    <div class="card-body">
                        <form id="admited" action="<?php echo e(route('admin.allin.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="mb-3" >
                                    <label class="form-label required">Select Website/Brand</label>
                                    <select id='testSelect1' name="adm_id[]" class="form-control">
                                        <?php $__currentLoopData = $admited; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($admi->id); ?>"><?php echo e($admi->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <form id="cuelink" action="<?php echo e(route('admin.allin.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="mb-3" >
                                    <label class="form-label required">Select Website/Brand</label>
                                    <select id='testSelect1' name="cam_id[]" class="form-control">
                                        <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($partner->id); ?>"><?php echo e($partner->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <form id="impact" action="<?php echo e(route('admin.allin.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label required">Select Website/Brand</label>
                                    <select id='testSelect1' name="imp_id[]" class="form-control">
                                        <?php $__currentLoopData = $impacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $impact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($impact->id); ?>"><?php echo e($impact->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="page-title" align="left" style="width: 100%;">
                            Website/Brand list for All in One Search

                        </h2>
                    </div>
                    <div class="card-body">
                        <div id="table-default" class="table-bordered table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><button class="table-sort" data-sort="sort-s">#</button></th>
                                        <th><button class="table-sort" data-sort="sort-name">Website/Brand Name</button></th>
                                        <th><button class="table-sort" data-sort="sort-s">Brand</button></th>
                                        <th><button class="table-sort" data-sort="sort-name">Tab color/Search Url</button></th>
                                        <th><button class="table-sort" data-sort="sort-type">Remove</button></th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">
                                    <tr>
                                        <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$homead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td id="row"><?php echo e($key+1); ?></td>
                                        <?php if($homead->campaign_id): ?>
                                            <td class="sort-name"><?php echo e($homead->cuelinkcampaigns->name); ?></td>
                                            <td>Cuelink</td>
                                            <td class="sort-name"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampl2eModal<?php echo e($homead->id); ?>">
                                                    Add/Update</button></td>
                                            <td class="sort-type">
                                                <a href="<?php echo e(route('admin.allin.delete',[$homead['id']])); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');" title="delete heading">Delete
                                                </a>    
                                            </td>
                                       <?php elseif($homead->admited_id): ?>
                                       <td class="sort-name"><?php echo e($homead->admited->name); ?></td>
                                       <td>Admited</td>
                                       <td class="sort-name"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampl2eModal<?php echo e($homead->id); ?>">
                                               Add/Update</button></td>
                                       <td class="sort-type">
                                           <a href="<?php echo e(route('admin.allin.delete',[$homead['id']])); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');" title="delete heading">Delete
                                           </a>    
                                       </td>
                                       <?php elseif($homead->impact_id): ?>
                                       <td class="sort-name"><?php echo e($homead->impact->name); ?></td>
                                       <td>Impact</td>
                                       <td class="sort-name"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampl2eModal<?php echo e($homead->id); ?>">
                                               Add/Update</button></td>
                                       <td class="sort-type">
                                           <a href="<?php echo e(route('admin.allin.delete',[$homead['id']])); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');" title="delete heading">Delete
                                           </a>    
                                       </td>
                                       <?php endif; ?>
                                         
                                    </tr>

                                    <div class="modal fade" id="exampl2eModal<?php echo e($homead->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo e($homead->id); ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="<?php echo e(route('admin.allin.update',$homead->id)); ?>" method="post" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="example2ModalLabel<?php echo e($homead->id); ?>" align="left">Add Tab Color/search url</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" align="right">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label required">Search Url</label>
                                                            <input type="text" name="search_url" value="<?php echo e($homead->search_url); ?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label required">Tab Color</label>
                                                            <input type="color" name="color" value="<?php echo e($homead->tab_color); ?>" class="form-control">
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>


    <?php $__env->startPush('script_2'); ?>
    <script>
        document.multiselect('#testSelect1')
            .setCheckBoxClick("checkboxAll", function(target, args) {
                console.log("Checkbox 'Select All' was clicked and got value ", args.checked);
            })
            .setCheckBoxClick("1", function(target, args) {
                console.log("Checkbox for item with value '1' was clicked and got value ", args.checked);
            });

        function enable() {
            document.multiselect('#testSelect1').setIsEnabled(true);
        }

        function disable() {
            document.multiselect('#testSelect1').setIsEnabled(false);
        }

    </script>
    <script>
    $(document).ready(function () {
            $('#admited').hide();
            $('#impact').hide();
        $(".brand1").click(function(){
            $('#impact').show();
            $('#cuelink').hide(); 
            $('#admited').hide();
        });
            $(".brand2").click(function(){
            $('#impact').hide();
            $('#cuelink').show(); 
            $('#admited').hide();
        });
            $(".brand3").click(function(){
            $('#impact').hide();
            $('#cuelink').hide(); 
            $('#admited').show();
        });
    });
      </script>
    <script>
        $(document).on('ready', function() {
            // INITIALIZATION OF DATATABLES
            // =======================================================
         
            $('#dataSearch').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post({
                    url: '<?php echo e(route('admin.category.search')); ?>'
                    , data: formData,
                     cache: false,
                     contentType: false,
                     processData: false,
                     beforeSend: function() {
                        $('#loading').show();
                    }
                    , success: function(data) {
                       
                        $('#table-div').html(data.view);
                        $('#itemCount').html(data.count);
                        $('.page-area').hide();
                    }
                    , complete: function() {
                        $('#loading').hide();
                    }
                , });
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                    document.getElementById("viewerbox").style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this);
        });

    </script>

  

    <?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Codefuse\ecom\cashfuse-new\resources\views/admin/allin/index.blade.php ENDPATH**/ ?>