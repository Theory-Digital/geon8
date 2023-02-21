<div class="tw-overflow-hidden">
  <div class="tw-relative tw-mx-auto tw-px-4 sm:tw-px-6 md:tw-px-8 md:tw-max-w-7xl tw-max-w-xl">
    <div class="tw-relative md:tw-grid md:tw-grid-cols-2 md:tw-items-center">
      <div class="tw-relative md:tw-pr-32-5">
        <h3 class="tw-text-2xl tw-font-extrabold tw-text-gray-900 tw-tracking-tight sm:tw-text-3xl"><?php echo !empty($title) ? $title : 'Made in Vietnam'; ?></h3>
        <p class="tw-mt-3 tw-text-lg tw-text-geon-body"><?php echo !empty($content) ? $content : 'When the decision was made to launch Geon Tile, we searched and researched the top manufacturing regions of cement encaustic tile. What we brought home from our travels was an understanding that the Vietnam held a level of expertise unparalleled by others. We have established a manufacturing supply chain in a region with a history of making tile, allowing Geon Tile to deliver the best possible value to our customers.'; ?></p>
        <?php if(!empty($buttonUrl) && !empty($buttonText)) :?>
            <div class="tw-mt-8">
              <a href="<?php echo $buttonUrl; ?>" class="tw-inline-flex tw-items-center tw-justify-center tw-px-5 tw-py-3 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-md tw-bg-black tw-px-10 tw-text-white hover:tw-opacity-90 tw-select-none"><?php echo $buttonText;?></a>
            </div>
          <?php endif; ?>
      </div>

      <div class="tw-mt-10 tw-relative md:tw-mt-0" aria-hidden="true">
        <img class="tw-relative tw-mr-auto tw-w-full" src="<?php echo $image; ?>" alt="">
      </div>
    </div>
  </div>
</div>
