<section class="th-footer-form tw-mt-24">
    <div class="tw-bg-primary-pink-500">
      <div class="tw-max-w-2xl tw-mx-auto tw-text-center tw-py-16 tw-px-4 sm:tw-py-20 sm:tw-px-6 lg:tw-px-8">
        <h2 class="tw-text-3xl tw-font-extrabold tw-text-white sm:tw-text-4xl tw-flex tw-justify-center">
          <span class="tw-inline"><?php echo $heading; ?></span>
        </h2>
        <p class="tw-mt-4 tw-text-lg tw-leading-6 tw-text-primary-pink-200"><?php echo $content; ?></p>
        <div class="gform">
          <?php echo do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]'); ?>
        </div>
      </div>
    </div>
  </section>