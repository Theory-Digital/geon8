<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
  $attachment_ids = $product->get_gallery_image_ids();
  $imgSrcs = [];
  $dv = null;
  if ( $product->is_type( 'variable' ) ) {
    $dv = getDefaultVariant();
    $imgSrcs = getVariantImagesSrcs($dv);
  }

  function prepareSlides($i) {
    return array(
      'image' => $i['medium'],
      'imageFull' => $i['full']
    );
  }

  //$models = get_the_terms( $product->get_ID(), 'pa_model' );
  //echo '<pre>'; print_r( $models ); echo '</pre>';

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
  <div class="tw-w-full tw-max-w-7xl tw-px-4 md:tw-flex tw-mx-auto tw-overflow-hidden md:tw-overflow-visible">
    <div class="md:tw-w-3/5 md:tw-mr-12 tw-mt-8 md:tw-mt-0">
      <?php
        //moved up here becasue anything in th-gallery is zoomable
        echo sprintf('<div class="md:tw-hidden tw-col-span-full tw-slider">',$product->is_type('variable') && ((count($attachment_ids) <= 1 || count($imgSrcs) <= 1)) ? 'tw-hidden' : '' );         
            includeWithVariables((get_template_directory() . '/components/pdp-slider.php'),
            array(
              'id' => $product->ID,
              'slides' => array_map("prepareSlides", $imgSrcs),
            ));
        echo '</div>';
      ?>
      <div class="<?php echo (count($attachment_ids) > 1 || count($imgSrcs) > 1 ? 'th-gallery-multi' : 'th-single') ;?> th-gallery tw-inline-flex tw-w-full children-w-full">
        <?php
          //image handling

          if( $product->is_type('variable') ){
            //on variation change handled by pdp.js
            foreach($imgSrcs as $i) {
              if(!empty($i['large']) || !empty($i['full'])) {
                echo sprintf('
                  <div class="%3$s th-gallery-itm md:tw-flex tw-hidden" data-spai-excluded data-src="%2$s">
                    <img class="tw-w-full" src="%1$s"/>
                    <div class="th-circle-plus"></div>
                  </div>
                ', $i['large'], $i['full'], (count($attachment_ids) > 1 || count($imgSrcs) > 1) ? 'tw-hidden' : '');
              }
            }
          } else {
            $fullImage = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' )[0];
            $imageGallery = [];
            array_push($imageGallery, $fullImage);
            foreach( $attachment_ids as $attachment_id ) {
              // Display the image URL
              array_push($imageGallery, wp_get_attachment_image_src($attachment_id, 'full')[0]);
            }
          ?>
              <?php foreach( $imageGallery as $image): ?>
                <div class="magnifier-thumb-wrapper th-gallery-itm" data-src="<?php echo $image; ?>">
                    <div class="th-circle-plus"></div>
                    <img id="thumb" style="width:100%;" src="<?php echo $image; ?>" data-magnify="<?php echo $image; ?>">
                </div>
              <?php endforeach;?>
          <?php
            // do_action( 'woocommerce_before_single_product_summary' );
          }
        ?>
      </div>
    </div>
    <div class="summary entry-summary md:tw-w-2/5 md:tw-inline tw-mt-16 md:tw-mt-0">
        <div class="tw-flex tw-justify-between">
          <div>
            <?php
              if(isTile($product)) {
                echo '<div class="tw-text-lg">';
                  echo getFirstProductGroup($product);
                echo '</div>';
              }
            ?>
            <div class="tw-text-xs tw-text-gray-400">
              <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); 
              } else {
                woocommerce_breadcrumb();
              }?>
            </div>
            </div>
            <div class="badge-wrapper">
              <?php
                $badgeText = '';
                //find loaded product

                if(!empty($dv)) {
                  if(!empty($dv['badge'])){
                    $badgeText = $dv['badge'];
                  }
                } else {
                  //non variant prod
                  $product_badge = $product->get_meta('_pbadge');
                  if(!empty($product_badge)) {
                    $badgeText =  $product_badge;
                  }
                }
                
                includeWithVariables((get_template_directory() . '/components/badge.php'),
                  array(
                    'badge_text' => $badgeText,
                    'is_empty' => empty($badgeText)
                  )
                );
                
              ?>
            </div>
        </div>
        <div class="md:tw-flex tw-flex-wrap md:tw-justify-between tw-w-full tw-max-w-md">
          <?php
            echo '<div class="tw-text-40p">';
              woocommerce_template_single_title();
            echo '</div>';
            //-----
          ?>
          <?php
            if(isTile($product)) {
              $dimensions = $product->get_dimensions();
              $sizes = ($product->get_attribute( 'pa_size' ));
              if ( $dimensions != 'N/A' && empty($sizes) ) {
                  //quick fix here --- hide this data of the complex products that have sizes
                  echo '<div class="tw-flex tw-my-4 tw-items-center th-byline">';
                    echo $dv['variation_byline'];
                  echo '</div>';        
              }
            }
            if( $product->is_type('simple') ) {
              $teaser = $product->get_meta('_tease');
              if (!empty($teaser)) {
                echo sprintf('<div class="tw-flex tw-w-full">%s</div>', $teaser);
              }
            }
          ?>
          <div class="tw-text-gray-500 tw-flex tw-items-center tw-pt-4 tw-pb-2 tw-w-full">
            <?php
              $price = '';
              if( ! $product->is_type('variable') ){
                  $price .= $product->get_price();
              }
              // For variable products    
              else {
                  //dv -- dv price
                  //only for tiles atm
                  $dv = getDefaultVariant();
                  $price_per_sf = '';
                  if(!empty($dv) && isTile($product)) {
                    $price = number_format((float)strip_tags($dv['display_price']), 2, '.', '');
                    $price_per_sf = '';
                    if (!empty($dv['display_price']) && !empty($dv['square_footage'])) {
                      $price_per_sf = roundToTwoDecimals($dv['display_price'] / $dv["square_footage"],2);  
                    }
                  } else {
                    //non dv -- all prices
                    $min_price = $product->get_variation_price( 'min' );
                    $max_price = $product->get_variation_price( 'max' );
                    if($min_price == $max_price) {
                      $price = $min_price;
                    } else {
                      $price = $min_price.' - '.esc_attr(get_woocommerce_currency_symbol()).''.$max_price;
                    }
                  }
              }
            ?>
            <div class="tw-flex tw-text-md tw-items-center">
              <div class="wrap-price md:tw-mb-0 tw-font-bold tw-text-black">
                <div class="amount">
                  <?php echo sprintf('%1$s%2$s %3$s', get_woocommerce_currency_symbol(), $price, !empty(getUnitOfMeasure($product)) ? '/ '.getUnitOfMeasure($product) : ''); ?>
                </div>
              </div>
              <?php
                if (isTile($product) && !empty($price_per_sf)) {
              ?>
                <div class="tw-bg-dGrey tw-inline-flex tw-justify-center tw-items-center tw-h-6 tw-w-6 tw-text-xxs tw-rounded-full tw-px-2 tw-select-none tw-mx-4 tw-font-bold tw-bg-darkGrey tw-text-white"> <div><p>OR</p></div> </div>
                <div id="price-per-sf" class="tw-whitespace-nowrap tw-font-bold tw-text-black"><?php echo get_woocommerce_currency_symbol().$price_per_sf; ?> / sq.ft</div>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php
        //------
        do_action( 'woocommerce_single_product_summary' );
        
      /**
       * Hook: woocommerce_single_product_summary.
       *
       * @hooked woocommerce_template_single_title - 5
       * @hooked woocommerce_template_single_rating - 10
       * @hooked woocommerce_template_single_price - 10
       * @hooked woocommerce_template_single_excerpt - 20
       * @hooked woocommerce_template_single_add_to_cart - 30
       * @hooked woocommerce_template_single_meta - 40
       * @hooked woocommerce_template_single_sharing - 50
       * @hooked WC_Structured_Data::generate_product_data() - 60
       */
        //woocommerce_template_single_add_to_cart();
      ?>
      <?php
        $accordian = get_field('accordion');
        if(empty($accordian)) {
          $typeIDs = getAllProductsGroups($product);
          $accordians = get_field('accordion', 'option');
          $allTypes = getAllProductGroups();
          foreach ($accordians as $acc) {
            if($acc['product_type'] == reset($typeIDs)) {
              $accordian = $acc["accordion_rows"];
            }
          }
        }
        echo('<div class="tw-mt-8">');
        includeWithVariables((get_template_directory() . '/components/accordian.php'),
          array(
            'rows' => $accordian,
          )
        );
        echo('<div>')
      ?>  
    </div>
  </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>