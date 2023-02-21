<div class="tw-relative tw-bg-white tw-overflow-hidden">
  <div class="tw-relative tw-pt-6">
    <div class="tw-flex tw-flex-wrap">
      <div class="tw-w-full tw-border-white sm:tw-w-1/2 tw-border-b-4 tw-border-r-2 tw-border-solid tw-bg-primary-pink tw-p-12 tw-pr-0">
        <div class="tw-max-w-side lg:tw-grid lg:tw-grid-cols-12 lg:tw-gap-8 tw-ml-auto">
          <div class="sm:tw-text-center md:tw-mx-auto lg:tw-col-span-6 lg:tw-text-left tw-flex tw-flex-col tw-justify-center tw-z-1">
            <h2>
              <span class="tw-mt-1 tw-block tw-text-4xl">
                <span class="tw-block tw-text-white tw-leading-10"><?php echo $title; ?></span>
              </span>
            </h2>
            <?php if(!empty($buttonUrl) && !empty($buttonText)) :?>
              <div class="tw-mt-12">
                <a href="<?php echo $buttonUrl; ?>" class="tw-mx-auto tw-w-full tw-p-4 tw-px-8 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-md tw-text-black tw-bg-gray-100 hover:tw-bg-white hover:tw-text-black tw-select-none"><?php echo $buttonText;?></a>
              </div>
            <?php endif; ?>
          </div>
          <div class="tw-mt-12 tw-relative sm:tw-max-w-lg sm:tw-mx-auto lg:tw-mt-0 lg:tw-max-w-none lg:tw-mx-0 lg:tw-col-span-6 lg:tw-flex lg:tw-items-center">
            <div class="tw-relative tw-mx-auto tw-w-full tw-flex tw-justify-start sm:tw-justify-end">
              <img class="tw-shadow-xl tw-max-h-48" src="<?php echo $image; ?>" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="tw-w-full tw-border-white sm:tw-w-1/2 tw-border-b-4 tw-border-l-2 tw-border-solid tw-bg-primary-green tw-p-12 tw-pr-0">
        <div class="lg:tw-grid lg:tw-grid-cols-12 lg:tw-gap-8 tw-mr-auto">  
          <div class="sm:tw-text-center md:tw-mx-auto lg:tw-col-span-6 lg:tw-text-left tw-flex tw-flex-col tw-justify-center tw-z-1">
            <h2>
              <span class="tw-mt-1 tw-block tw-text-4xl">
              <span class="tw-block tw-text-white tw-leading-10"><?php echo $title_2; ?></span>
              </span>
            </h2>
            <?php if(!empty($buttonUrl_2) && !empty($buttonText_2)) :?>
              <div class="tw-mt-12">
                <a href="<?php echo $buttonUrl_2; ?>" class="tw-mx-auto tw-w-full tw-p-4 tw-px-8 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-md tw-text-black tw-bg-gray-100 hover:tw-bg-white hover:tw-text-black tw-select-none"><?php echo $buttonText_2;?></a>
              </div>
            <?php endif; ?>
          </div>
          <div class="tw-mt-12 tw-relative sm:tw-max-w-lg sm:tw-mx-auto lg:tw-mt-0 lg:tw-max-w-none lg:tw-mx-0 lg:tw-col-span-6 lg:tw-flex lg:tw-items-center">
            <div class="tw-relative tw-mx-auto tw-w-full tw-flex tw-justify-start sm:tw-justify-end">
              <img class="tw-shadow-xl tw-max-h-48" src="<?php echo $image_2; ?>" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
