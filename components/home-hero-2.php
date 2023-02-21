<!-- This example requires Tailwind CSS v2.0+ -->
<div class="tw-bg-white">
  <main>
    <div>
      <!-- Hero card -->
      <div class="tw-relative">
        <div class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-h-1/2 tw-bg-gray-100"></div>
        <div class="">
          <div class="tw-relative tw-shadow-xl sm:tw-overflow-hidden">
            <div class="tw-absolute tw-inset-0">
              <img class="tw-h-full tw-w-full tw-object-cover" src="<?php echo $image; ?>" alt="Geon Tile Dog">
              <div class="tw-absolute tw-inset-0 tw-mix-blend-multiply" style="background-color:<?php echo $overlayColor; ?>"></div>
            </div>
            <div class="th-hero-h tw-relative tw-px-4 tw-py-16 sm:tw-px-6 lg:tw-px-8 tw-flex tw-justify-center tw-flex-col">
              <h1 class="tw-text-center tw-text-3xl tw-font-extrabold tw-tracking-tight sm:tw-text-5xl lg:tw-text-6xl tw-mt-auto">
                <span class="md:tw-block" style="color:<?php echo $headingColor; ?>"><?php echo $heading; ?></span>
                <span class="tw-block" style="color:<?php echo $bylineColor; ?>"><?php echo $byline;?></span>
              </h1>
              <p class="tw-mt-6 tw-max-w-lg tw-mx-auto tw-text-center tw-text-xl  sm:tw-max-w-3xl" style="color:<?php echo $bylineColor; ?>"><?php echo $content; ?></p>
              <div class="tw-mt-auto tw-max-w-sm tw-mx-auto sm:tw-max-w-none sm:tw-flex sm:tw-justify-center">
                <div class="tw-flex tw-space-x-4 sm:tw-space-y-4 sm:tw-space-y-0 sm:tw-mx-auto sm:tw-inline-grid sm:tw-grid-cols-2 sm:tw-gap-5">
                    <?php if(!empty($buttonUrl) && !empty($buttonText)) :?>
                        <div class="tw-rounded-md tw-shadow tw-bg-black">
                            <a
                              style="
                                <?php echo sprintf(
                                  'background-color: %1$s; color: %2$s;',
                                  $buttonColor,
                                  $buttonTextColor
                                )
                              ?>"
                              href="<?php echo $buttonUrl; ?>"
                              class="tw-w-full tw-flex tw-items-center tw-justify-center tw-px-8 tw-py-3 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-md tw-text-white tw-bg-primary-yellow hover:tw-opacity-90 md:tw-py-4 md:tw-text-lg md:tw-px-10"> <?php echo $buttonText;?></a>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($buttonUrl) && !empty($buttonText)) :?>
                        <div class="tw-rounded-md tw-shadow tw-bg-black">
                            <a
                              style="
                                <?php echo sprintf(
                                  'background-color: %1$s; color: %2$s;',
                                  $buttonColor,
                                  $buttonTextColor
                                )
                              ?>"
                              href="<?php echo $buttonUrl2; ?>" class="tw-w-full tw-flex tw-items-center tw-justify-center tw-px-8 tw-py-3 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-md tw-text-white tw-bg-primary-yellow hover:tw-opacity-90 md:tw-py-4 md:tw-text-lg md:tw-px-10"> <?php echo $buttonText2;?> </a>
                        </div>
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- More main page content here... -->
</div>
