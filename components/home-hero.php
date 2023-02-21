<div class="tw-relative tw-bg-white tw-overflow-hidden">
  <div class="table-circle"></div>
  <div class="tw-relative tw-pt-6 tw-pb-16 sm:tw-pb-24 lg:tw-pb-32">
    <main class="tw-mx-auto tw-px-4 sm:tw-px-6 lg:tw-px-8">
      <div class="lg:tw-grid lg:tw-grid-cols-12 lg:tw-gap-8">
        <div class="sm:tw-text-center md:tw-mx-auto lg:tw-col-span-6 lg:tw-text-left tw-flex tw-flex-col tw-justify-center tw-z-1">
          <h1>
            <span class="tw-block tw-text-sm tw-font-semibold tw-uppercase tw-tracking-wide tw-text-geon-body sm:tw-text-base lg:tw-text-sm xl:tw-text-base"><?php echo $byline; ?></span>
            <span class="tw-mt-1 tw-block tw-text-4xl tw-tracking-tight tw-font-extrabold sm:tw-text-5xl">
              <span class="tw-block tw-text-gray-900"><?php echo $title; ?></span>
            </span>
          </h1>
          <p class="tw-mt-3 tw-text-base tw-text-geon-body sm:tw-mt-5 sm:tw-text-xl lg:tw-text-lg xl:tw-text-xl"><?php echo $content; ?></p>
          <?php if(!empty($buttonUrl) && !empty($buttonText)) :?>
            <div class="tw-mt-12">
              <a href="<?php echo $buttonUrl; ?>" class="tw-max-w-lg tw-mx-auto tw-w-full tw-flex tw-items-center tw-justify-center tw-px-8 tw-py-3 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-md tw-text-white tw-bg-primary-yellow hover:tw-bg-primary-yellow-700 tw-select-none"><?php echo $buttonText;?></a>
            </div>
          <?php endif; ?>
        </div>
        <div class="tw-mt-12 tw-relative sm:tw-max-w-lg sm:tw-mx-auto lg:tw-mt-0 lg:tw-max-w-none lg:tw-mx-0 lg:tw-col-span-6 lg:tw-flex lg:tw-items-center">
          <div class="big-yellow-circ circle-fv yellow-circ tw-absolute"></div>
          <div class="tw-relative tw-mx-auto tw-w-full tw-rounded-lg tw-shadow-lg">
            <img class="tw-w-full" src="<?php echo $image; ?>" alt="">
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
