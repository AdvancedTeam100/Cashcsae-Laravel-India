  <?php ($footer=\App\Models\BusinessSetting::where('key','footer_text')->first()->value); ?>
        <footer class="footer footer-transparent d-print-none fixed footer-fixed">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
             
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    <?php echo e($footer); ?>

                  </li>
    
                </ul>
              </div>
            </div>
          </div>
        </footer><?php /**PATH C:\xampp\htdocs\admitad_cashfuse\resources\views/admin/layout/footer.blade.php ENDPATH**/ ?>