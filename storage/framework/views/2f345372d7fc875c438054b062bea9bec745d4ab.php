
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Cashfuse - Installer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <style type="text/css">
    body, html {
    background: #F7F7F7;
    }
    </style>
  </head>
  <body>
        <div class="container main_body"> <div class="section" >
      <div class="column is-6 is-offset-3">
        <center><h1 class="title" style="padding-top: 20px">
        Cashfuse Installer
        </h1><br></center>
        <div class="box">
                    <div class="tabs is-fullwidth">
            <ul>
              <li class="is-active">
                <a>
                  <span><b>Requirements</b></span>
                </a>
              </li>
              <li>
                <a>
                  <span>Verify</span>
                </a>
              </li>
              <li>
                <a>
                  <span>Database</span>
                </a>
              </li>
              <li>
                <a>
                  <span>Finish</span>
                </a>
              </li>
            </ul>
          </div>
          
          <?php if(phpversion() < "8.1.0"): ?>
              <div class='notification is-danger' style='padding:12px;'><i class='fa fa-times'></i> Current PHP version is <?php echo e(phpversion()); ?>! minimum PHP 8.1.0 or higher required.</div>";
          <?php else: ?>
              <div class='notification is-success' style='padding:12px;'><i class='fa fa-check'></i> You are running PHP version <?php echo e(phpversion()); ?></div>
          <?php endif; ?>
          <?php if(!extension_loaded('mysqli')): ?>
              <div class='notification is-danger' style='padding:12px;'><i class='fa fa-times'></i> MySQLi PHP extension missing!</div>
          <?php else: ?>
              <div class='notification is-success' style='padding:12px;'><i class='fa fa-check'></i> MySQLi PHP extension available</div>
          <?php endif; ?> 

          <?php if(phpversion() >= "8.1.0" || extension_loaded('mysqli')): ?>
             <a href="verify" class="button is-link gen-env">Next</a>
          <?php else: ?>
             <a href="#" class="button is-link" disabled>Next</a>
          <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="content has-text-centered">
    <p>
       Made with ❤️ in India . All Rights Reserved. Powered by <a target="_blank" rel="noopener noreferrer" href="https://codefuse.org/" >Codefuse</a>.
    </p>
    <br>
  </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\Codefuse\admitad_cashfuse\resources\views/installer/requirement.blade.php ENDPATH**/ ?>