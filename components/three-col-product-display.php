<?php if(!empty($products) ){?>
  <div class="tw-mx-auto tw-text-2xl tw-max-w-geon tw-font-extrabold tw-text-gray-900 tw-tracking-tight sm:tw-text-3xl tw-text-center tw-mb-8"><?php echo $heading; ?></div>
  <?php if($cols == 4) { ?>
    <div class="tw-grid md:tw-grid-cols-4 tw-max-w-geon tw-mx-auto tw-gap-x-4">
  <?php } else { ?>
    <div class="tw-grid md:tw-grid-cols-3 tw-max-w-geon tw-mx-auto tw-gap-x-4">
  <?php } ?>
  <?php
    foreach($products as $product) : ?>
      <div class="tw-px-4 tw-flex tw-justify-center md:tw-shadow-2xl">
        <div class="tw-flex tw-flex-col tw-justify-center md:tw-max-w-xs">
          <a href="<?php echo $product['url']; ?>" class="tw-group tw-overflow-hidden">
            <img class="tw-max-w-full group-hover:tw-scale-105 tw-transition-all tw-duration-100" src="<?php echo $product['image_url']; ?>"/>
          </a>
          <div class="tw-flex tw-justify-center tw-py-8">
            <a href="<?php echo $product['url']; ?>" class="tw-w-full tw-text-center tw-justify-center md:tw-inline-flex tw-bg-black tw-py-3 tw-px-6 tw-rounded-md tw-text-white hover:tw-bg-white tw-border-solid tw-border hover:tw-text-black tw-border-black tw-select-none tw-transition-all tw-duration-100 tw-px-5 tw-py-3 tw-text-base tw-font-medium tw-rounded-md"><?php echo $product['title']; ?></a>
          </div>
        </div>
      </div>
  <?php endforeach; ?>
</div>
<?php } else{ ?>
  ??
<?php }; ?>