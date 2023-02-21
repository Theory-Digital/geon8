<div class="th-side-bar tw-fixed tw-bottom-0 tw-z-30 tw-pl-6 tw-pt-12 md:tw-pt-0 md:tw-flex tw-flex-col md:tw-sticky tw-h-full md:tw-h-auto md:tw-bottom-auto md:tw-top-4 tw-bottom-0 tw-bg-white tw-fixed tw-pr-4 md:tw-z-0 tw-shadow-lg md:tw-shadow-none tw-right-0 tw-transition-all tw-duration-300 tw-translate-x-full md:tw-translate-x-0">
  <div class="tw-font-bold tw-text-lg tw-mb-4">
    <div class="tw-text-xs tw-text-gray-400">
      <?php if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); 
      } else {
        woocommerce_breadcrumb();
      }?>
    </div> 
    <div class="tw-hidden md:tw-flex">
      <?php echo woocommerce_page_title(); ?>
    </div>
    <div class="md:tw-hidden tw-w-8 tw-pt-4 tw-cursor-pointer th-filter-toggle">
      <?php include (get_template_directory() . '/assets/svgs/right-arrow.svg'); ?>
    </div>
  </div>
  <div class="tw-mb-4 tw-flex tw-flex-col">
    <?php if(is_product_category()): ?>
      <a class="tw-relative tw-mb-4 hover:tw-shadow-lg tw-outline-none tw-shadow-sm tw-flex tw-justify-center tw-w-full tw-border tw-border-solid tw-border-gray-200 tw-py-3 tw-rounded-md tw-text-sm tw-transition-all tw-duration-75" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
        <div class="tw-absolute tw-left-4 tw-w-4 tw-h-full tw-text-gray-400">
          <?php include (get_template_directory() . '/assets/svgs/left-arrow.svg'); ?>
        </div>
        Back to All Products
      </a>
    <?php endif; ?>
  </div>
  <div>
  <div class="tw-font-bold">
    <div>Filtered By:</div>
    <div id="resetFilters">
      <button onclick="FWP.reset()">Reset</button>
    </div>
  </div>

  <div class="">
    <div class="tw-border-t tw-border-solid tw-border-gray-200 tw-mt-2 tw-pt-4">
      <h3 class="tw-uppercase tw-text-sm tw-font-black tw-mb-2">Type</h3>
      <?php
        echo do_shortcode(
          '[facetwp facet="type"]'
        );
      ?>
    </div>
    <div class="tw-border-t tw-border-solid tw-border-gray-200 tw-mt-2 tw-pt-4">
      <h3 class="tw-uppercase tw-text-sm tw-font-black tw-mb-2">Shape</h3>
      <?php
        echo do_shortcode(
          '[facetwp facet="shape"]'
        );
      ?>
    </div>
    <!-- <div class="tw-hidden md:tw-flex tw-flex-col tw-border-t tw-border-solid tw-border-gray-200 tw-mt-2 tw-pt-4 facetwp-facet">
      <h3 class="tw-uppercase tw-text-sm tw-font-black tw-mb-2">Collections</h3>
      <?php
        $cat = get_term_by('slug', 'collection', 'product_cat');
        if($cat->parent==0) {
          $arg=[[],[]];
          getcatsubs($cat,$arg);
          if ($arg[0]) {
              $l=0;
              foreach ($arg[0] as $scat) {
                  $i=$arg[1][$l];
                  $link = get_category_link($scat->cat_ID);
                  $pageID = get_queried_object()->term_id;
                  if($scat->cat_ID === $pageID) {
                    echo "<a class='tw-whitespace-nowrap tw-font-bold tw-text-md' href='$link'>$scat->name</a>";
                  } else {
                    echo "<a class='hover:tw-font-bold tw-whitespace-nowrap tw-text-md' href='$link'>$scat->name</a>";
                  }
                  $l++;
              }
          }
        }
      ?>
    </div> -->
    <div class="tw-border-t tw-border-solid tw-border-gray-200 tw-mt-2 tw-pt-4">
      <h3 class="tw-uppercase tw-text-sm tw-font-black tw-mb-2">Hue</h3>
      <?php
        echo do_shortcode(
          '[facetwp facet="tile_color"]'
        );
      ?>
    </div>
  </div>

  </div>
</div>
<div class="tw-z-21 md:tw-z-0 th-grayout-filters tw-w-full tw-h-full tw-fixed tw-bg-black tw-opacity-50 tw-top-0 tw-left-0 tw-transition tw-duration-75 tw-hidden"></div>