<div class="">
<?php
    $defaultRows = [
      [
        'detail'  => [
          'heading' => 'MEASUREMENTS & PATTERNS',
          'content' => 'Avoid delays and additional costs by ensuring the appropriate number of tiles are ordered. Industry guidelines state that at least 15% overage should be added to each order to account for cuts, possible breakage and contingency for future repairs. We’ve put together a comprehensive guide to help you make certain you have enough tile for your project.',
        ],
      ],
      [
        'detail'  => [
          'heading' => 'MATERIALS & CERTIFICATION',
          'content' => 'There is a great deal that goes into manufacturing encaustic cement tile. They are handmade, one at a time, using materials and techniques that have been around for hundreds of years. Geon Tile is committed to measuring and reporting on the impact these processes have on our people and planet. Find out more about our social and environmental certifications and what goes into making beautiful Geon cement tiles',
        ],
      ],
      [
        'detail'  => [
          'heading' => 'Shipping',
          'content' => 'Encaustic cement tile is heavy and getting it to your doorstep requires special considerations for shipping and delivery. To make sure your expectations are met and that you are properly prepared, we’ve assembled a thorough shipping and delivery guide',
        ],
      ],
      [
        'detail'  => [
          'heading' => 'Warranty',
          'content' => 'What makes encaustic cement tile so appealing and honest is that each piece is individually handmade. As such, each piece cannot be made identical, as if it were from a machine churning out repeatable parts. Natural variations will occur in your tile; colour shade, fine cracks and other small imperfections are all to be expected. These variations contribute to their appeal without compromising the performance and integrity of the tile. We offer all our customers free samples to ensure they are getting exactly what is presented in the online store. If you are at all unsure about the colour, style or shape of a tile, be sure to request a sample prior to ordering. We guarantee that your order will show up matched to the sample sent to you, within the allotted colour variations that come with Geon encaustic cement tiles',
        ],
      ],
    ];
    foreach(!empty($rows) ? $rows : $defaultRows as $key=>$row) {
          $title = $row['detail']['heading'];
          $answer = $row['detail']['content'];
      ?>
        <div class="detail-box details tw-cursor-pointer tw-border-t tw-border-gray-200 tw-border-solid close tw-px-4 tw-py-4 <?php if($key == count($rows) - 1){?>tw-border-b<?php } ?>">
          <div class="tw-flex tw-justify-between tw-max-w-7xl tw-mx-auto">
            <h3 class="tw-select-none tw-block tw-text-sm tw-font-semibold tw-uppercase tw-tracking-wide tw-text-black"><?php echo $title;?></h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-tranform tw-duration-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
          <div class="tw-max-w-7xl tw-mx-auto detail-answer details-content prose tw-prose tw-text-geon-body">
            <p class="tw-select-none tw-mt-4 tw-text-base"><?php echo $answer;?></p>
          </div>
        </div>
<?php }; ?>
</div>