<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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


// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$pid = $product->get_id();
$dv = getDefaultVariant();
?>
<div class="tw-flex tw-w-full tw-p-4">
  <a class="p-url tw-w-full" href="<?php echo get_permalink( $product->ID );?>">
    <div class="tw-mb-2 shop-img-wrapper tw-relative tw-overflow-hidden">
      <?php
        $badge = get_field('product_badge_heading');
        $badgeColor = get_field('product_badge_color');
        if(!empty($badge)) {
          echo sprintf('<div style="background: %2$s;" class="tw-select-none tw-text-lg tw-text-white tw-py-4 tw-px-6 tw-absolute tw-inline-flex tw-rounded-r-sm tw-top-4 tw-z-10">%1$s</div>', $badge, $badgeColor);
        }

        //woocommerce_show_product_loop_sale_flash();
      ?>
      <?php
        if(!empty($dv)) {
          echo sprintf('<img loading="lazy" src="%1$s" srcset="%2$s" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"></img>', $dv['image']['src'], $dv['image']['srcset']);
        } else {
          woocommerce_template_loop_product_thumbnail(); 
        }
      ?>
    </div>
  </a>
</div>
<div class="tw-pb-3">
  <div class="tw-relative tw-var-wrapper tw-px-4">
    <div class="tw-text-xl">
        <div class="tw-flex tw-justify-between">
			<?php
        $dims  = $product->get_dimensions();
        $byline = $dv['variation_byline'];
        if(empty($byline)) {
          $byline = $product->get_meta('_byline');
        }
        $decs = array("0.625", "0.75"," in");
        $fracs = array("5/8", "3/4");
        $dims_adj = str_replace($decs, $fracs, $dims);?>
          <div class="tw-block tw-text-md th-variation-byline"><?php echo(!empty($byline) ?  $byline : $dims_adj) ;?></div>
          <div class="tw-block tw-text-md th-variation-price">
            <?php
              //woocommerce_template_loop_price();
              $price = $product->get_price();
              $dimensions = $product->get_dimensions();
              if($product->has_child()) {
                $price = $product->get_variation_regular_price('min'); // 
              }
              if(isTile($product)){
                $dv = getDefaultVariant();
                $price = $dv['display_price'];
                $squareFootage = $dv['square_footage'];
                if($squareFootage > 0) {
                  $price = roundToTwoDecimals($price / $squareFootage);
                  echo get_woocommerce_currency_symbol();
                  echo $price;
                  echo '/sq.ft';
                } else {
                  echo get_woocommerce_currency_symbol();
                  echo $price;
                  echo '/per box';
                }
              } else {
                echo get_woocommerce_currency_symbol();
                echo $price;
                echo '/per item';
              }
            ?>
          </div>
        </div>
        <?php
          $excerpt = $product->post->post_excerpt;
          if ($excerpt) {
            echo sprintf('<div class="tw-mb-4 tw-text-sm tw-opacity-50">%1$s</div>', $excerpt);
          } else {
            if(!empty($dv)) {
              echo sprintf('<div class="th-prod-title yrdy tw-mb-4 tw-text-sm tw-opacity-50">%1$s</div>', strip_tags($dv['variation_title']));
            }
          }
         ?>
        
    </div>
    <div class="th-var-select-bar tw-flex tw-justify-between tw-pb-3 tw-min-w-full tw-overflow-scroll">
      <div class="tw-min-w-full">
        <?php          
          if(isTile($product)) {
            $variationsOG = $product->get_available_variations();
			      $dimensions = $product->get_dimensions();
            $variations = [];
            $currency = get_woocommerce_currency_symbol();
            $id = $product->ID;
            $showOnlyOneProductVariant = get_field('show_only_one_variant_on_shop_archive_page', $product->post->id);

            echo '<input type="hidden" data-id="'.$id.'" name="isTile" value="true">';
            if (count($variationsOG) > 0) {
              echo '<div class="tw-flex">';
                //if the tile has size, display only the largest or regular tiles' images
                $colorsAlreadyDone = [];
                  foreach($variationsOG as $variation) :
                    $attributes = $variation['attributes'];
                    $colorArrays = get_post_meta($variation['variation_id'], '_filter_colours');
					$colors = implode(',', $colorArrays[0]);
				
                    //display variants of each color type
                    if(sizeof($colorArrays[0]) > 0){

                      $vTitle = strip_tags($variation['variation_title']);
                      echo '<div class="variation-wrapper test c">';
                        echo '<div id="'.$variation['variation_id'].'" class="tw-border tw-border-solid  variation-select tw-mr-2 tw-h-16 tw-w-16 tw-overflow-hidden tw-flex tw-items-center tw-justify-center">';
                          echo '<img class="tw-cursor-pointer" data-price="'.$currency.($variation['square_footage'] > 0 ? roundToTwoDecimals($variation['display_price']/$variation['square_footage']).'/sq.ft' : $variation['display_price'].'/per box').'" data-byline=\''.$variation['variation_byline'].'\' data-url="'.get_permalink( $product->ID ).'?attribute_pa_color='.$variation['attributes']['attribute_pa_color'].'" data-title="'.$vTitle.'" data-pid="'.$pid.'" data-color="'.$colors.'" src="' . $variation['image']['src'] .'" srcset="'.$variation['image']['srcset'].'">';
                        echo '</div>';
                      echo '</div>';
                    // color gets precedence over finish
                    } elseif(array_key_exists('attribute_pa_finish', $attributes)) {
                      $vTitle = strip_tags($variation['variation_title']);
                      echo '<div class="variation-wrapper">';
                        echo '<div id="'.$variation['variation_id'].'" class="tw-border tw-border-solid  variation-select tw-mr-2 tw-h-16 tw-w-16 tw-overflow-hidden tw-flex tw-items-center tw-justify-center">';
                          echo '<img class="tw-cursor-pointer" data-price="'.$currency.($variation['square_footage'] > 0 ? roundToTwoDecimals($variation['display_price']/$variation['square_footage']).'/sq.ft' : $variation['display_price'].'/per box').'" data-byline=\''.$variation['variation_byline'].'\' data-url="'.get_permalink( $product->ID ).'?attribute_pa_color='.$variation['attributes']['attribute_pa_finish'].'" data-title="'.$vTitle.'" data-pid="'.$pid.'" data-color="'.$variation['attributes']['attribute_pa_finish'].'" src="' . $variation['image']['src'] .'" srcset="'.$variation['image']['srcset'].'">';
                        echo '</div>';
                      echo '</div>';
                    }
                    if($showOnlyOneProductVariant) {
                      break;
                    }
                  endforeach;            
              echo '</div>';
            }
          }
          else{
            //do_action( 'woocommerce_shop_loop_item_title' );
          }
        ?>
      </div>
    </div>
  </div>
</div>
