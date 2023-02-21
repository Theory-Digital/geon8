<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
do_action( 'woocommerce_before_add_to_cart_form' );
$dv = getDefaultVariant($product);
?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>
	<?php
		if(isTile($product)) {
			echo '<input type="hidden" id="isTile" name="isTile" value="true">';
		}	else {
			echo '<input type="hidden" id="isTile" name="isTile" value="false">';
		}  
	?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<div class="variations" cellspacing="0">
			<div>
			<?php echo sprintf('<div id="content-area" class="tw-w-full tw-mb-4 tw-prose">%1$s</div>', !empty($dv['variation_description']) ? $dv['variation_description'] : $product->post->post_content); ?>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<div class="tw-flex tw-mt-4 tw-relative tw-flex-col">
					<?php
						if(isTile($product)) {
							$variationsOG = $product->get_available_variations();
							$variations = [];
              
							foreach($variationsOG as $variation) :
                if ( has_term( 'timber-tiles', 'product_cat') ) {
                  //groutless tile
                  if( empty(strip_tags($variation['square_footage'])) ) {
									  //force break the page -- without the above field, logic breaks
									  exit;
								  }
                } else {
                  if( empty($variation['grout']) || empty(strip_tags($variation['square_footage'])) ) {
									  //force break the page -- without the above field, logic breaks
									  exit;
								  }
                }
								
								$out = getVariantImagesSrc($variation);
								$gallery = json_encode($out, JSON_FORCE_OBJECT);
								//get product object for functions
								$vProduct = new WC_Product_Variation($variation['variation_id']);
								//all meta for variant
								echo (sprintf('
									<input 
										type="hidden"
										id="variantMeta%1$s"
										class="variant-meta"
										data-id="%1$s"
										data-grout-name="%2$s"
										data-grout="%3$s"
										data-title="%4$s"
										data-square-footage="%5$s"
										data-grout-qty="%6$s"
										data-grout-parent="%7$s"
										data-gallery=\'%8$s\'
										data-price="%9$s"
										data-unit="%10$s"
										data-currency="%11$s"
										data-byline=\'%12$s\'
										data-badge="%13$s"
									>',
									$variation['variation_id'],
									get_the_title($variation['grout']),
									$variation['grout'],
									strip_tags($variation['variation_title']),
									strip_tags($variation['square_footage']),
									strip_tags($variation['grout_qty']),
									getGroutProduct()->ID,
									$gallery,
									$vProduct->get_price(),
									getUnitOfMeasure($product),
									get_woocommerce_currency_symbol(),
									strip_tags($variation['variation_byline']),
									$vProduct->is_on_sale() ? !empty($variation['badge']) ? $variation['badge'] : 'Sale': $variation['badge'],
								));
							endforeach;
						} else {
							$variationsOG = $product->get_available_variations();
							$variations = [];
							foreach($variationsOG as $variation) :
								//get product object for functions
								$out = getVariantImagesSrc($variation);
								$vProduct = new WC_Product_Variation($variation['variation_id']);
								$gallery = json_encode($out, JSON_FORCE_OBJECT);
								//all meta for variant
								echo (sprintf('
									<input 
										type="hidden"
										id="variantMeta%1$s"
										class="variant-meta"
										data-id="%1$s"
										data-title="%2$s"
										data-price="%3$s"
										data-unit="%4$s"
										data-currency="%5$s"
										data-gallery=\'%6$s\'
										data-badge="%7$s"
									>',
									$variation['variation_id'],
									strip_tags($variation['variation_title']),
									$vProduct->get_price(),
									getUnitOfMeasure($product),
									get_woocommerce_currency_symbol(),
									$gallery,
									$vProduct->is_on_sale() ? !empty($variation['badge']) ? $variation['badge'] : 'Sale': $variation['badge'],
								));
							endforeach;
						};
						if(isTile($product) && $attribute_name == 'pa_color' ) {
							$defaultColor = $dv['attributes']['attribute_pa_color'];
							if (isComplexVariableTile($product)) {
								echo '<div class="">';
									echo '<div id="variant-title" class="tw-left-0 tw-mb-2">Color: '.strip_tags($dv['variation_title']).'</div>';
									echo '<div class="tw-flex th-var-select-bar tw-flex tw-pb-3 tw-min-w-full tw-overflow-scroll">';
									$colorsAlreadyDone = [];
									foreach($variationsOG as $variation) :
										// get gallery
										$style = $variation['attributes']['attribute_pa_color'] == $defaultColor ? 'outline:#8C8F88 solid 1px;' : ';';							
										if(!in_array($variation['attributes']['attribute_pa_color'], $colorsAlreadyDone) ) {
											echo '<div style="min-width:55px; height:55px;" class="variation-wrapper tw-flex tw-justify-center tw-items-center">';
												echo "<div id='".$variation['variation_id']."' style='".$style."' class='color-select tw-border tw-border-white tw-border-solid tw-rounded-full tw-h-12 tw-w-12 tw-overflow-hidden'>";
													echo "<img class='tw-cursor-pointer variation-select' data-color='".$variation['attributes']['attribute_pa_color']."' src='" . $variation['image']['thumb_src'] ."'>";
												echo '</div>';
											echo '</div>';
											array_push($colorsAlreadyDone, $variation['attributes']['attribute_pa_color']);
										}
									endforeach;
									echo '</div>';
								echo '</div>';
							}
						}
						elseif(isTile($product) && $attribute_name == 'pa_size'){
							$sizesAlreadyDone = [];
							$squares = [];
							$rectangles = [];
							$arraysOfShapes = [];
							$lastObjectIndex = null;
							$baseX = 0;
							$baseY = 0;
							$defaultSize = $dv['attributes']['attribute_pa_size']; 
							// sticking to direct call of the DV, in case client requests another loading product that isnt a woo Default variant. $product->get_variation_default_attribute( $attribute_name );

							foreach($variationsOG as $variation) :
								// get sizes
								//arrange by shape
								$xy = explode('X',strtoupper($variation['attributes']['attribute_pa_size']));
								$variation['x'] = $xy[1];
								$variation['y'] = $xy[0];

								if($variation['x'] == $variation['y']) {
									//as the array creates, make sure it is sorted by area
									array_push($squares, $variation);
									$squares = insertion_Sort($squares);
								} else {
									array_push($rectangles, $variation);
									$rectangles = insertion_Sort($rectangles);
								}
							endforeach;

							//determine largest square or rectangle
							if($squares[0]['x']*$squares[0]['y'] > $rectangles[0]['x']*$rectangles[0]['y']) {
								$baseX = $squares[0]['x'];
								$baseY = $squares[0]['y'];
							} else {
								$baseX = $rectangles[0]['x'];
								$baseY = $rectangles[0]['y'];
							}

							array_push($arraysOfShapes, $squares, $rectangles);
							echo '<div class="tw-flex tw-flex-wrap">';
								echo '<div class="tw-pb-2 tw-w-full tw-relative tw-flex tw-items-center">
									<div>Size</div>
									<div
										class="tw-cursor-pointer"
										tooltip="Geon Tile products are stocked in a '.$baseY.'x'.$baseX.' size.  All other sizes are custom cut by hand and are made to order.  Please allow two additional weeks for processing."
										waiver="false"
										class="tw-flex tw-items-center"
									>
										<svg 
											fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="info-circle"
											class="tw-ml-2 tw-text-gray-400 tw-w-4 tw-h-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
										>
											<path fill="currentColor"
												d="M256 40c118.621 0 216 96.075 216 216 0 119.291-96.61 216-216 216-119.244 0-216-96.562-216-216 0-119.203 96.602-216 216-216m0-32C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm-36 344h12V232h-12c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h48c6.627 0 12 5.373 12 12v140h12c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12h-72c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12zm36-240c-17.673 0-32 14.327-32 32s14.327 32 32 32 32-14.327 32-32-14.327-32-32-32z">
											</path>
										</svg>
									</div>
								</div>';
								foreach($arraysOfShapes as $array) {
									$multiplyer = $array[0]['x'] > 12 ? 8 : 12;
									$subLargestX = $array[0]['x'];
									$subLargestY = $array[0]['y'];
									echo sprintf('<div style="width:%1$spx; height:%2$spx;" class="hover:tw-z-10 shape-array tw-relative tw-mr-4 tw-mb-4">', $subLargestX * $multiplyer, $subLargestY * $multiplyer);
										foreach($array as $key=>$variation):
											$multiplyer = $variation['x'] > 12 ? 8 : 12;
											if(!in_array($variation['attributes']['attribute_pa_size'], $sizesAlreadyDone) ) {
												echo(sprintf('
													<div data-size="%5$sx%4$s" %8$s class="%7$s %6$s tw-px-2 size-selector tw-absolute tw-flex tw-items-end tw-cursor-pointer tw-border-r tw-text-gray-700 tw-border-b border-dashed tw-border-gray-300 tw-transition tw-duration-100" style="position:absolute; width:%1$spx; height:%2$spx; z-index:%3$s;">',
													$variation['x']*$multiplyer,
													$variation['y']*$multiplyer,
													$key,
													$variation['x'],
													$variation['y'],
													$key == 0 ? 'tw-border-t tw-border-l' : '',
													$defaultSize == $variation['attributes']['attribute_pa_size'] ? 'size-selected tw-bg-gray-200' : 'tw-opacity-30',
													$variation['x']*1 < $baseX || $variation['y']*1 < $baseY ? 'tooltip="Geon Tile products are stocked in a '.$baseY.'x'.$baseX.' size.  All other sizes are custom cut by hand and are made to order.  Please allow two additional weeks for processing." waiver="false"' : '',
												));
													echo(sprintf('
															%3$sx%4$s
														',
														$variation['x']*$multiplyer,
														$variation['y']*$multiplyer,
														$variation['y'],
														$variation['x'],
														
													));
												echo '</div>';
												array_push($sizesAlreadyDone, $variation['attributes']['attribute_pa_size']);
											}
										endforeach;
									echo '</div>';
								}
							echo '</div>';
						}
					?>
				<div>
					<div class="<?php if(isTile($product) && ($attribute_name == 'pa_color' || $attribute_name == 'pa_size')) { echo 'tw-hidden'; }?>">
						<div class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></div>
						<div class="value">
							<?php
								
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $dv['attributes']['attribute_'.strtolower($attribute_name)];
								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
										'selected' => $selected,
									)
								);
							?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
      </div>
    </div>
		<?php do_action( 'woocommerce_after_variations_table' ); ?>

		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>
<?php
do_action( 'woocommerce_after_add_to_cart_form' );