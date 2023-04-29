<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
	 <meta name="verify-admitad" content="bdd7d6bf72" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- CSS files -->
    <link href="<?php echo e(asset('assets/theme_assets/css/tabler.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/theme_assets/css/tabler-flags.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/theme_assets/css/tabler-payments.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/theme_assets/css/tabler-vendors.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/theme_assets/css/demo.min.css')); ?>" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

<!-- include summernote css/js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
 

     <?php echo $__env->yieldPushContent('css_or_js'); ?>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
		.modal-title {
            width: 88% !important;
		}
		th, td {
			padding: 4px;
		}
		
		.notification {
			background-color: #6383a8;
			color: white;
			border-radius: 6px;
			font-weight: bold;
			border: none;
			padding: 9px;
			font-family: sans-serif;
      }
		.notification:hover {
			background-color: #6383a8d1;
			border-radius: 6px;
			color: white;
			padding: 9px;
			font-weight: bold;
			border: none;
			font-family: sans-serif;
      }
		button.dt-button.buttons-html5 {
			background-color: #6383a8;
			color: white;
			border-radius: 6px;
			font-weight: bold;
			border: none;
			font-family: sans-serif;
      }
		button.dt-button.buttons-html5:hover {
			background-color: #6383a8d1;
			border-radius: 6px;
			font-weight: bold;
			border: none;
			font-family: sans-serif;
      }
		body{
			background-color:#f1f5f9;
		}
		.navbar {
         margin-bottom: 0px !important;
	     margin-left: -10px !important;
         margin-right: -8px !important;
       }
       :after{
           display:none !important;
       }
    </style>
  </head>
  <body >
    <div class="page">
      <!-- Navbar -->
      <?php echo $__env->make('admin.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('admin.layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
      <div class="page-wrapper">
        <!-- Page header -->
         <?php echo $__env->yieldContent('content'); ?>
        </div>
      <?php echo $__env->make('admin.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      
    </div>
  <?php echo $__env->yieldPushContent('script'); ?>
    <!-- Libs JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('assets/theme_assets/libs/apexcharts/dist/apexcharts.min.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/theme_assets/js/demo-theme.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/theme_assets/libs/jsvectormap/dist/js/jsvectormap.min.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/theme_assets/libs/jsvectormap/dist/maps/world.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/theme_assets/libs/jsvectormap/dist/maps/world-merc.js')); ?>" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- Tabler Core -->
    <script src="<?php echo e(asset('assets/theme_assets/js/tabler.min.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/theme_assets/js/demo.min.js')); ?>" defer></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
	  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
	   <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	   <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	   <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
	  <script>
		$(document).ready(function() {
    var table = $('#example').DataTable( {
		"dom": 'Bfrtip',
        "buttons": [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ordering":false,
		"paging": false,
        "searching":false,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
   			 } );
			} );
		
	  </script>
	  <script>
		$(document).ready(function() {
    var table = $('#example2').DataTable( {
		"dom": 'Bfrtip',
        "buttons": [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ordering":false,
		"paging": false,
        "searching":false,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
   			 } );
			} );
		
	  </script>
	  <script>
		$(document).ready(function() {
    var table = $('#example3').DataTable( {
		"dom": 'Bfrtip',
        "buttons": [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ordering":false,
		"paging": false,
        "searching":false,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
   			 } );
			} );
		
	  </script>
	  <script>
		$(document).ready(function() {
    var table = $('#example4').DataTable( {
		"dom": 'Bfrtip',
        "buttons": [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ordering":false,
		"paging": false,
        "searching":false,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
   			 } );
			} );
		
	  </script>
	  <script>
		$(document).ready(function() {
    var table = $('#example5').DataTable( {
		"dom": 'Bfrtip',
        "buttons": [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ordering":false,
		"paging": false,
        "searching":false,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
   			 } );
			} );
		
	  </script>
    <script>
function myFunctionn() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("mySearch");
  filter = input.value.toUpperCase();
  ul = document.getElementById("myMenu");
  li = ul.getElementsByTagName("li");
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 400
        });
    </script>
    <script type="text/javascript">
        $('#summernote1').summernote({
            height: 400
        });
    </script>
    <script type="text/javascript">
        $('#summernote2').summernote({
            height: 400
        });
    </script>
<?php echo $__env->yieldPushContent('script_2'); ?>
   
   
    

    
   
   
   
   
   <script>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.error("<?php echo e($error); ?>");
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

  <?php if(Session::has('success')): ?>
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.success("<?php echo e(session('success')); ?>");
  <?php endif; ?>

  <?php if(Session::has('error')): ?>
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.error("<?php echo e(session('error')); ?>");
  <?php endif; ?>

  <?php if(Session::has('info')): ?>
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.info("<?php echo e(session('info')); ?>");
  <?php endif; ?>

  <?php if(Session::has('warning')): ?>
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.warning("<?php echo e(session('warning')); ?>");
  <?php endif; ?>
</script>
  </body>
</html><?php /**PATH C:\xampp\htdocs\Codefuse\ecom\cashfuse-new\resources\views/admin/layout/app.blade.php ENDPATH**/ ?>