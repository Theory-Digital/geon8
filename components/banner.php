<?php 
  $ext = pathinfo($image, PATHINFO_EXTENSION);
?>

<div>
  <?php if($image) { ?>
    <?php if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') { ?>
      <img class="tw-h-96 md:tw-h-135 tw-w-full tw-object-cover" src="<?php echo $image; ?>" />
    <?php } elseif($ext == 'mp4') {?>
      <video autoplay muted loop class="tw-h-96 md:tw-h-135 tw-w-full tw-object-cover">
        <source src="<?php echo $image; ?>" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <?php } ?>
    <?php } ?>
    <div class="tw-bg-white">
    <div class="tw-max-w-2xl tw-mx-auto tw-text-center tw-pt-12 tw-px-4 sm:tw-px-6 lg:tw-px-8">
      <h2 class="tw-text-3xl tw-font-extrabold tw-tracking-tight tw-text-gray-900 sm:tw-text-4xl">
        <span class="tw-block"><?php echo $heading; ?></span>
      <h2>
      <p class="tw-block tw-mt-3 tw-text-lg tw-text-geon-body tw-prose">
        <?php echo $content; ?>
      </p>
      <div class="tw-flex tw-justify-center tw-flex-wrap">
      <?php foreach($links as $key=>$link) { ?>
        <div class="md:tw-mt-8 tw-w-full md:tw-w-auto tw-inline-flex tw-rounded-md tw-shadow <?php if($key > 0) { echo 'md:tw-ml-4 tw-mt-4'; } else { echo 'tw-mt-8'; } ?>">
          <a href="<?php echo $link['link']['url']; ?>" class="tw-w-full tw-inline-flex tw-items-center tw-justify-center tw-px-5 tw-py-3 tw-text-base tw-font-medium tw-rounded-md tw-bg-black tw-px-10 tw-text-white hover:tw-bg-white tw-border-solid tw-border hover:tw-text-black tw-border-black tw-select-none tw-transition-all tw-duration-100" > <?php echo $link['link']['title']; ?> </a>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
</div>
