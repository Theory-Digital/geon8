<?php
  $sampleCategoryID = getSampleCategory();
  $link = '';
  if(empty($product)) {
    $sampleCategoryID = getSampleCategory();
    $args = array(
      'post_type'           => 'product',
      'post_status'         => 'publish',
      'posts_per_page'      => 1,
      'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    =>  array( $sampleCategoryID ),
            'operator' => 'NOT IN',
        ),
      ),
      'orderby' => 'rand'
    );
    
    $featured_query = new WP_Query( $args );
    if ($featured_query->have_posts()) {
      while ($featured_query->have_posts()) : 
          $featured_query->the_post();
          $product = get_product( $featured_query->post->ID );
      ?>
      <?php
      endwhile;
    }

    wp_reset_query();
  }
  if(empty($heading)) {
    $heading = 'Tiles and accessories';
  }
  if(empty($content)) {
    $content = 'Shop '.$product->get_name();
  }
  if(empty($image)) {
    $image = wp_get_attachment_image_src(
      $product->get_image_id(),
      "small"
      )[0];
  }
  $ext = pathinfo($image, PATHINFO_EXTENSION);
  $prod_id = $product->get_id();
  $variable_id = null;
  $parent = null;
  $price = $product->get_price();
  if ( $product->is_type( 'variable' ) ) {
    $parent = $product->get_parent_id();
    if(!empty($parent)) {
      $variable_id = $product->get_id();
      $prod_id = $parent;
    }
  }
  
    $link = get_permalink($prod_id);
  
?>

<div class="tw-relative tw-bg-black tw-group tw-w-full">
  <?php if(is_product()) { ?>
    <div class="group-hover:tw-opacity-90 tw-uppercase tw-opacity-0 tw-duration-200 tw-transition-opacity tw-z-10 tw-pointer-events-none tw-absolute tw-w-full tw-h-full tw-bg-black tw-flex tw-justify-center tw-items-center tw-text-white">
      Add To Cart <?php echo get_woocommerce_currency_symbol().roundToTwoDecimals($price); ?>
      <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-6 tw-w-6 tw-ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
  <?php } ?>
  <a class="th-fp-link" data-pid="<?php echo $prod_id; ?>" data-link="" data-vid="<?php echo $variable_id; ?>" href="<?php echo $link; ?>">
    <div class="tw-bg-primary-blue-500 tw-w-3/12 tw-absolute tw-left-0 tw-h-full">
      <?php if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') { ?>
        <img class="tw-w-full tw-h-full tw-object-cover" src="<?php echo $image; ?>" alt="">
      <?php } elseif($ext == 'mp4') {?>
        <video autoplay muted loop class="tw-w-full tw-h-full tw-object-cover">
          <source src="<?php echo $image; ?>" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      <?php } ?>
    </div>
    <div class="tw-relative tw-mx-auto tw-px-4 tw-py-4">
      <div class="tw-ml-auto tw-pl-4 tw-w-9/12 tw:tw-pl-10">
        <h2 class="tw-text-base tw-font-semibold tw-uppercase tw-tracking-wider tw-text-white"><?php echo $heading?></h2>
        <p class="md:tw-mt-3 tw-text-base tw-text-gray-300"><?php echo $content; ?></p>
      </div>
    </div>
  </a>
</div>
