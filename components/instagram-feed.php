<div class="tw-mt-16">
    <?php if(!empty($heading) || !empty($content)) { ?>
        <div class="tw-flex tw-flex-col tw-items-center tw-mt-16 tw-mb-4">
            <h2 class="tw-text-2xl tw-font-extrabold tw-text-gray-900 tw-tracking-tight sm:tw-text-3xl"><?php echo $heading; ?></h2>
            <p class="tw-mt-3 tw-text-lg tw-text-geon-body"><?php echo $content; ?></p>
        </div>
    <?php }?>
<?php
 echo do_shortcode('[instagram-feed]');
?>
</div>