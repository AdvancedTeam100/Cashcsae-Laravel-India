<h1>Email Verification Mail</h1>

Please verify your email with bellow link:
<a href="<?php echo e(route('email.verify', $data['token'])); ?>">Verify Email</a>
<h4>Password :  <?php echo e($data['user_password']); ?> </h4><?php /**PATH C:\xampp\htdocs\Codefuse\admitad_cashfuse\resources\views/email/emailVerificationEmail.blade.php ENDPATH**/ ?>