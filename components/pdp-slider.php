<div id="carousel<?php echo $id ?>" class="main-carousel tw-max-w-7xl tw-mx-auto tw-overflow-visible tw-mt-6">
    <?php foreach($slides as $key=>$slide): ?>
        <div class="carousel-cell tw-mr-6 tw-w-80 tw-group tw-overflow-hidden tw-drop-shadow-2xl tw-bg-white">
            <div>
                <div class="tw-h-80 tw-w-80 tw-overflow-hidden">
                    <img class="tw-h-80 tw-w-80 tw-object-cover group-hover:tw-scale-105 tw-duration-300" data-spai-excluded  src="<?php echo $slide['image']?>">
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<script>
    // element argument can be a selector string
    //   for an individual element
    var flkty = new Flickity( '#carousel<?php echo $id ?>', {
        selectedAttraction: 0.2,
        friction: 0.8,
        dragThreshold: 25,
        pageDots: false,
        prevNextButtons: false,
    });
</script>