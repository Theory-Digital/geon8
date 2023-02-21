<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$tileArea = '';
$groutArea = '';
$groutPerBox = '';
$dv = getDefaultVariant();
$temp = wc_get_product( $dv['variation_id'] );
$price = !empty($temp) ? $temp->get_price() : $product->get_price();

if(isTile($product)) {
  $groutPerBox = $product->get_attribute('Grout Per Box');
  // //not using these anymore
  // $tileArea = $product->get_attribute('Area');
  // $groutArea = wc_get_product(getGroutProduct()->ID)->get_attribute('Area');
}

?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php
    do_action( 'woocommerce_before_add_to_cart_button' );
    echo('<input type="hidden" id="basePrice" name="basePrice" value="'.$price.'">');
  ?>
  
  <div class="tw-mt-4">
    <div>Quantity</div>
    <div class="tw-flex tw-items-center">
      <?php if(isTile($product)) { ?>
        <div class="quantity-input tw-relative">
          <label for="squareFootageQuantity" class="tw-text-right tw-absolute tw-top-1 tw-mt-6 tw-text-gray-400 tw-font-extralight tw-left-4">Sq.ft</label>
          <input type="number" name="square-feet" min="1" step="any" id="squareFootageQuantity" class="tw-border-gray-200 tw-border-solid tw-border-2 tw-rounded-sm tw-outline-none tw-py-2 tw-px-3 tw-mt-2 tw-min-h-60p tw-max-w-112p" />
        </div>
        <div class="tw-bg-dGrey tw-text-white tw-inline-flex tw-justify-center tw-items-center tw-h-6 tw-w-6 tw-text-xxs tw-rounded-full tw-px-2 tw-select-none tw-mx-4 tw-mt-4 tw-font-bold tw-bg-darkGrey tw-text-white">OR</div>
        <div class="quantity-input tw-relative">
          <label for="boxQuantity" class="tw-text-right tw-absolute tw-top-1 tw-mt-6 tw-text-gray-400 tw-font-extralight tw-left-4"># of <?php echo getUnitOfMeasure($product, 2) ?></label>
          <input type="number" name="boxes" min="1" step="any" id="boxQuantity" class="tw-border-gray-200 tw-border-solid tw-border-2 tw-rounded-sm tw-outline-none tw-py-2 tw-px-3 tw-mt-2 tw-min-h-60p tw-max-w-125p">
        </div>
      <?php } else { ?>
        <div class="quantity-input tw-relative">
          <label for="boxQuantity" class="tw-text-right tw-absolute tw-top-1 tw-mt-6 tw-text-gray-400 tw-font-extralight tw-left-4">01</label>
          <input type="number" name="boxes" min="1" step="any" id="boxQuantity" class="tw-border-gray-200 tw-border-solid tw-border-2 tw-rounded-sm tw-outline-none tw-py-2 tw-px-3 tw-mt-2 tw-min-h-60p tw-max-w-125p">
        </div>
      <?php } ?>
    </div>
  </div>
  <?php if(isTile($product)) { ?>
    <?php if(!empty($dv['square_footage'])) { ?>
      <div style="max-width:291px" class="tw-text-xs tw-flex tw-justify-end">
        <div class="square-footage-per-box-display">
        *<span class="square-footage-per-box-span"><?php echo strip_tags($dv['square_footage']); ?></span> sq.ft per <?php echo getUnitOfMeasure($product, 1) ?>
        </div>
      </div>
    <?php } ?>
    <div class="tw-flex tw-flex-col tw-my-2">
      <div class="tw-mb-2">Overage</div>
      <div class="tw-flex">
        <input type="hidden" class="" id="overage" name="overage" value="1.15" class="tw-cursor-pointer">
        <input type="hidden" class="" id="overageConfirm" name="overageConfirm" value="true">
        <div data-value="1" tooltip="Industry standard suggests adding at least 15% overage in case of potential breakage, excess tile cuts, or future repairs." waiver="true" class="overage-box tw-select-none tw-border-solid tw-border-gray-200 tw-border tw-w-14 tw-text-gray-300 tw-flex tw-justify-center tw-items-center tw-py-4 tw-mr-2 tw-cursor-pointer hover:tw-border-gray-400 hover:tw-text-gray-800 tw-transition-colors tw-duration-100">
          0%
        </div>
        <div data-value="1.05" class="overage-box tw-select-none tw-border-solid tw-border-gray-200 tw-border tw-w-14 tw-text-gray-300 tw-flex tw-justify-center tw-items-center tw-py-4 tw-mr-2 tw-cursor-pointer hover:tw-border-gray-400 hover:tw-text-gray-800 tw-transition-colors tw-duration-100">
          +5%
        </div>
        <div data-value="1.1" data-value="" class="overage-box tw-select-none tw-border-solid tw-border-gray-200 tw-border tw-w-14 tw-text-gray-300 tw-flex tw-justify-center tw-items-center tw-py-4 tw-mr-2 tw-cursor-pointer hover:tw-border-gray-400 hover:tw-text-gray-800 tw-transition-colors tw-duration-100">
          +10%
        </div>
        <div data-value="1.15" class="overage-select tw-select-none overage-box tw-border-solid tw-border-gray-200 tw-border tw-w-14 tw-text-gray-300 tw-flex tw-justify-center tw-items-center tw-py-4 tw-mr-2 tw-cursor-pointer hover:tw-border-gray-400 hover:tw-text-gray-800 tw-transition-colors tw-duration-100">
          +15%
        </div>
        <div data-value="1.2" class="overage-box tw-select-none tw-border-solid tw-border-gray-200 tw-border tw-w-14 tw-text-gray-300 tw-flex tw-justify-center tw-items-center tw-py-4 tw-mr-2 tw-cursor-pointer hover:tw-border-gray-400 hover:tw-text-gray-800 tw-transition-colors tw-duration-100">
          +20%
        </div>
      </div>
    </div>
    <div class="tw-flex tw-items-center tw-my-2">
      <div>
        <input checked="true" type="checkbox" id="grout" value="<?php echo $dv['grout']; ?>" data-grout-per-box="<?php echo $groutPerBox;?>" data-grout-parent="<?php echo getGroutProduct()->ID ?>" name="overage" class="tw-cursor-pointer">
        <label id="grout-label" for="grout">
          Add <?php echo get_the_title($dv['grout']); ?>
        </label>
      </div>
    </div>
  <?php } ?>
  <div class="tw-hidden">
    <?php
    do_action( 'woocommerce_before_add_to_cart_quantity' );
    
    woocommerce_quantity_input(
      array(
        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
      )
    );

    do_action( 'woocommerce_after_add_to_cart_quantity' );
    ?>
  </div>
  
  <div class="tw-mt-4 md:tw-flex tw-flex-wrap">
    <button type="submit" class="th-min-w-md main-add-to-cart tw-flex tw-justify-center tw-items-center md:tw-mr-6 tw-px-4 tw-text-center md:tw-inline-flex md:tw-w-auto single_add_to_cart_button button alt tw-bg-black tw-min-h-60p tw-text-white tw-rounded-md hover:tw-bg-white tw-border-solid tw-border hover:tw-text-black tw-border-black tw-select-none tw-capitalize"><?php echo (esc_html( $product->single_add_to_cart_text() ).' '.get_woocommerce_currency_symbol().roundToTwoDecimals($price)); ?></button>
    
    <?php 
      $upsells = $product->get_upsells();

      if(isTile($product) && !empty($upsells)):?>
        <input type="hidden" id="sample_product_id" name="sample_product_id" value="<?php echo absint( wp_get_post_parent_id($upsells[0]) ); ?>" />
        <a class="tw-mt-4 tw-text-center md:tw-w-auto add-sample-btn tw-bg-white tw-w-full tw-hidden tw-text-black button alt tw-min-h-60p tw-justify-center tw-items-center tw-px-4 tw-rounded-md hover:tw-bg-black tw-border-solid tw-border hover:tw-text-white tw-border-black tw-select-none"
          <?php
            foreach ($upsells as $sampleID) {
              $sampleAttribute = get_post_meta($sampleID,'attribute_pa_color',true);
              $sampleFinishAttribute = get_post_meta($sampleID,'attribute_pa_finish',true);
              echo 'data-'.$sampleAttribute.'="'.$sampleID.'"';
              echo 'data-'.$sampleFinishAttribute.'="'.$sampleID.'"';
            }
          ?>
        href="/">Add Sample to Cart</a>
      <?php endif; ?>
      <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
  </div>
  <div class="tw-mt-8 tw--mx-4 md:tw-mx-auto">
    <?php
      $featured = get_field('general', 'option');
      $crossSells = $product->get_cross_sells();
      $prod = wc_get_product($featured['product']);
      if(!empty($crossSells) || !empty($featured)) {
        $test = wc_get_product( $crossSells[rand(0, count($crossSells) - 1)]);
        $fp = !empty($prod) ? $prod : $test;
        includeWithVariables((get_template_directory() . '/components/featured-item.php'),
          array(
            'heading' => $featured['heading'],
            'content' => $featured['content'],
            'image' => esc_url($featured['image']),
            'product' => $fp,
          )
        );
      }
    ?>

  </div>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>