<div class="tw-bg-primary-pink-500 th-subscribe tw-w-full">
  <div class="tw-max-w-7xl tw-mx-auto tw-py-12 tw-px-4 sm:tw-px-6 lg:tw-py-20 lg:tw-px-8 lg:tw-flex lg:tw-items-center lg:tw-justify-between">
    <h2 class="tw-text-3xl tw-font-extrabold tw-tracking-tight tw-text-gray-900 md:tw-pr-8">
      <span class="tw-block tw-text-white"><?php echo $title; ?></span>
    </h2>
    <div class="tw-mt-8 tw-flex lg:tw-mt-0 lg:tw-flex-shrink-0 md:tw-w-1/2">
      <div class="xl:tw-mt-0 tw-w-full">
        <p class="tw-text-base tw-text-gray-100"><?php echo $content; ?></p>
        <div class="gform">
        <?php echo do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]'); ?>
        </div>
        <!-- <form class="tw-mt-4 sm:tw-flex sm:tw-max-w-md">
          <label for="email-address" class="tw-sr-only">Email address</label>
          <input type="email" name="email-address" id="email-address" autocomplete="email" required="" class="tw-appearance-none tw-min-w-0 tw-w-full tw-bg-white tw-border tw-border-transparent tw-rounded-md tw-py-2 tw-px-4 tw-text-base tw-text-gray-900 tw-placeholder-geon-body focus:tw-outline-none tw-h-16" placeholder="Enter your email">
          <div class="tw-mt-3 tw-rounded-md sm:tw-mt-0 sm:tw-ml-3 sm:tw-flex-shrink-0">
            <button type="submit" class="tw-w-full tw-bg-black tw-border tw-border-transparent tw-rounded-md tw-py-2 tw-px-4 tw-flex tw-items-center tw-justify-center tw-text-base tw-font-medium tw-text-white hover:tw-bg-white hover:tw-text-gray-800 focus:tw-outline-none tw-h-16">Subscribe</button>
          </div>
        </form> -->
      </div>
    </div>
  </div>
</div>
