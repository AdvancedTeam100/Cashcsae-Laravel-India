<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Login</title>
    <!-- CSS files -->
    <link href="<?php echo e(url('assets/theme_assets/css/tabler.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(url('assets/theme_assets/css/tabler-flags.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(url('assets/theme_assets/css/tabler-payments.min.css')); ?>" rel="stylesheet"/>
    <link href=".<?php echo e(url('assets/theme_assets/css/tabler-vendors.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(url('assets/theme_assets/css/demo.min.css')); ?>" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <script src="<?php echo e(url('assets/theme_assets/js/demo-theme.min.js')); ?>"></script>
    <div class="page page-center">
      <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
          <?php if($check): ?>
          <div class="col-lg">
            <div class="container-tight">
              <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
              </div>
              <div class="card card-md">
                <div class="card-body">
                  <h2 class="h2 text-center mb-4">Login to your account</h2>
                  <form action="<?php echo e(route('admin.auth.logincheck')); ?>"  method="post" autocomplete="on">
                     <?php echo csrf_field(); ?>
                    <div class="mb-3">
                      <label class="form-label">Email address</label>
                      <input type="email" name="email" class="form-control" placeholder="your@email.com" autocomplete="on" required>
                    </div>
                    <div class="mb-2">
                      <label class="form-label">
                        Password
                       <!--  <span class="form-label-description">
                          <a href="./forgot-password.html">I forgot password</a>
                        </span> -->
                      </label>
                      <div class="input-group input-group-flat">
                        <input type="password" class="form-control"  name="password" placeholder="Your password"  autocomplete="off" required>
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                          </a>
                        </span>
                      </div>
                    </div>
                    <div class="mb-2">
                      <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember"/>
                        <span class="form-check-label">Remember me</span>
                      </label>
                    </div>
                    <div class="form-footer">
                      <button type="submit" class="btn btn-primary w-100">Sign in</button>
                    </div>
                  </form>
                </div>
                
              </div>
             
            </div>
          </div>
          <?php else: ?>
          <div class="col-lg">
            <div class="container-tight">
              <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
              </div>
              <div class="card card-md">
                <div class="card-body">
                  <h2 class="h2 text-center mb-4">Create your account</h2>
                  <form action="<?php echo e(route('system_settings')); ?>"  method="post" autocomplete="on">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                      <label class="form-label">App Name</label>
                      <input type="text" name="business_name" class="form-control" placeholder="app name" autocomplete="on" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">First Name</label>
                      <input type="text" name="business_name" class="form-control" placeholder="admin" autocomplete="on" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Last Name</label>
                      <input type="text" name="business_name" class="form-control" placeholder="panel" autocomplete="on" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Admin Phone</label>
                      <input type="phone" name="phone" class="form-control" placeholder="9999999999" autocomplete="on" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Email address</label>
                      <input type="email" name="email" class="form-control" placeholder="your@email.com" autocomplete="on" required>
                    </div>
                    <div class="mb-2">
                     
                      <div class="input-group input-group-flat">
                        <input type="password" class="form-control"  name="password" placeholder="Your password"  autocomplete="off" required>
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                          </a>
                        </span>
                      </div>
                    </div>
                   
                    <div class="form-footer">
                      <button type="submit" class="btn btn-primary w-100">Create Admin Account</button>
                    </div>
                  </form>
                </div>
                
              </div>
             
            </div>
          </div>
          <?php endif; ?>
          <div class="col-lg d-none d-lg-block">
            <img src="<?php echo e(url('assets/theme_assets/static/undraw_secure_login_pdn4.svg')); ?>" height="300" class="d-block mx-auto" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo e(url('assets/theme_assets/js/tabler.min.js')); ?>" defer></script>
    <script src="<?php echo e(url('assets/theme_assets/js/demo.min.js')); ?>" defer></script>
    <script>
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
</html><?php /**PATH E:\Xampp2\htdocs\Backend-codes\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>