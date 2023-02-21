<div class="tw-overflow-hidden">
  <div class="tw-relative tw-max-w-xl tw-mx-auto tw-px-4 sm:tw-px-6 md:tw-px-8 md:tw-max-w-7xl">
    <div class="tw-relative">
      <div class="md:tw-grid md:tw-grid-flow-row-dense md:tw-grid-cols-2 md:tw-items-center">
        <div class="md:tw-col-start-2 md:tw-pl-32-5">
          <h3 class="tw-text-2xl tw-font-extrabold tw-text-gray-900 tw-tracking-tight sm:tw-text-3xl"><?php echo !empty($title) ? $title : 'Designed Locally'; ?></h3>
          <p class="tw-mt-3 tw-text-lg tw-text-geon-body"><?php echo !empty($content) ? $content : 'Geon Tile is proudly designed right here in Canada. Our design team draws on inspiration from the natural world, classic styles and various epochs. Staying true to our core design principles ensures we create attractive tiles and patterns that don’t bow to trends and endure as timeless works of art.'; ?></p>
          <?php if(!empty($buttonUrl) && !empty($buttonText)) :?>
            <div class="tw-mt-8">
              <a href="<?php echo $buttonUrl; ?>" class="tw-inline-flex tw-items-center tw-justify-center tw-px-5 tw-py-3 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-md tw-bg-black tw-px-10 tw-text-white hover:tw-opacity-90 tw-select-none"><?php echo $buttonText;?></a>
            </div>
          <?php endif; ?>
        </div>

        <div class="tw-mt-10 tw-relative md:tw-mt-0 md:tw-col-start-1">
          <img class="tw-relative tw-mr-auto tw-w-full" src="<?php echo $image; ?>" alt="">
        </div>
      </div>
    </div>
  </div>
</div>
