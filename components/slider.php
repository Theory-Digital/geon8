<div class="<?php if($hidden){ echo 'tw-hidden'; }?>">
    <div class="tw-max-w-7xl tw-mx-auto tw-px-4">
        <h2 class="tw-text-center xl:tw-text-left tw-text-3xl tw-font-extrabold tw-tracking-tight tw-text-gray-900 sm:tw-text-4xl"><?php echo $heading; ?></h2>
    </div>
    <div id="carousel<?php echo $id ?>" class="main-carousel tw-max-w-7xl tw-mx-auto tw-overflow-visible tw-mt-6 th-general-slider">
    <?php foreach($slides as $key=>$slide): ?>
        <div class="carousel-cell tw-mr-6 tw-w-80 tw-group tw-overflow-hidden tw-drop-shadow-2xl tw-bg-white">
            <a href="<?php echo $slide['link']['url'] ? $slide['link']['url'] : '#'?>">
                <div class="tw-h-96 tw-w-80 tw-overflow-hidden">
                    <img class="tw-h-96 tw-w-80 tw-object-cover group-hover:tw-scale-105 tw-duration-300" src="<?php echo $slide['image']?>">
                </div>
                <div class="tw-mt-4 tw-px-4 ">
                    <div class="tw-relative tw-mb-4">
                        <h3 class="tw-text-2xl tw-font-extrabold tw-text-gray-900 tw-tracking-tight sm:tw-text-3xl tw-border-b tw-border-gray-200 tw-mb-4 tw-pb-4"><?php echo $slide['heading']?></h3>
                        <p class="tw-mt-1 tw-text-geon-body tw-flex th-svg-sml tw-items-center tw-text-base"> <?php echo $slide['content']?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<script>
    // element argument can be a selector string
    //   for an individual element
    var flkty = new Flickity( '#carousel<?php echo $id ?>', {
        selectedAttraction: 0.2,
        friction: 0.8,
        dragThreshold: 25,
        pageDots: false,
    });
</script>