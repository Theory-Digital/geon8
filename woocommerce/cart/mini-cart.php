<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>
<div class="tw-z-30 th-grayout tw-w-full tw-h-full tw-fixed tw-bg-black tw-opacity-50 tw-top-0 tw-left-0 tw-transition tw-duration-75 tw-hidden"></div>
<div class="tw-fixed slide-out tw-transition-all tw-duration-300 tw-z-50 tw-bg-white tw-right-0 th-mini-cart tw-h-full tw-top-0 tw-bottom-0 tw-w-full sm:tw-w-108-75 tw-translate-x-full">
  <div class="inner-cart tw-min-h-full tw-h-full tw-overflow-scroll tw-pb-12">
    <div class="tw-blur-sm tw-hidden tw-cursor-not-allowed">Tailwind import</div>
    <div class="tw-w-full tw-bg-primary-blue tw-h-12 tw-flex tw-items-center tw-text-white tw-px-8 tw-justify-between">
      <div>
        Your Cart
      </div>
      <div class="tw-w-3 tw-h-3 tw-mb-1 th-close-cart tw-cursor-pointer">
        <?php include (get_template_directory() . '/assets/svgs/cross.svg'); ?>
      </div>
    </div>
    <div class="tw-px-8">
      <?php if ( ! WC()->cart->is_empty() ) : ?>

        <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
          <?php
          do_action( 'woocommerce_before_mini_cart_contents' );

          foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            $colors = [];
            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
              //Not optimal
              $prod = wc_get_product($product_id);
              $ogVars = [];
              $variationTitle = '';
              $prodParent = '';
              if ($prod->is_type( 'variable' )) {
                $ogVars = $prod->get_available_variations();
                foreach( $ogVars as $variation) {
                  if($variation['variation_id'] == $cart_item['variation_id'])
                    //$variationTitle = $variation['variation_title'];
                    $prodParent = get_the_title( wp_get_post_parent_id($variation['variation_id']));
                }
              }
              $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
              $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'cart-thumb' ), $cart_item, $cart_item_key );
              $product_price     = $_product->get_price();
              $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
              ?>
              <li
                class="tw-pb-3 tw-text-gray-700 tw-mt-4 tw-border-solid tw-border-gray-500 tw-border-b tw-flex tw-flex-col woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>"
                data-product-id="<?php echo $product_id;?>"
                data-variation-id="<?php echo $cart_item['variation_id'];?>"
              >
                <div class="tw-flex">
                  <?php if ( empty( $product_permalink ) ) : ?>
                    <a class="tw-flex tw-items-center" href="<?php echo esc_url( $product_permalink ); ?>">
                      <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </a>
                  <?php else : ?>
                    <a class="tw-flex tw-items-center" href="<?php echo esc_url( $product_permalink ); ?>">
                      <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </a>
                  <?php endif; ?>
                  <div class="tw-w-full tw-pl-3 tw-flex tw-justify-between tw-flex-wrap">
                    <div class="tw-w-full tw-flex tw-justify-between">
                      <div class="tw-flex tw-flex-col">
                      <div><?php echo ($prod->is_type( 'variable' )) ? str_replace("Protected: ", '',  $prodParent ) : str_replace("Protected: ", '',  $product_name ); ?></div>
                        <div class="tw-text-sm"><?php echo $product_name; ?></div>
                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                      </div>
                      <div>
                        <div class="tw-flex tw-items-center tw-justify-end">
                          <span data-key="<?php echo esc_attr( $cart_item_key ) ?>" data-product-id="<?php echo $product_id; ?>" data-variation-id="<?php echo $cart_item['variation_id']; ?>" class="tw-text-gray-500 decrement-cart-item tw-cursor-pointer tw-transition-colors tw-duration-150 tw-w-6 tw-h-6" >
                            <?php include (get_template_directory() . '/assets/svgs/minus.svg'); ?>
                          </span>
                          <div class="tw-flex tw-py-1 tw-rounded-md tw-mx-2 tw-items-center" >
                            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity mini-cart-i">' . sprintf($cart_item['quantity']) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            <?php getUnitOfMeasure($prod, $cart_item['quantity'], 'tw-ml-2') ?>
                          </div>
                          <span data-key="<?php echo esc_attr( $cart_item_key ) ?>" data-product-id="<?php echo $product_id; ?>" data-variation-id="<?php echo $cart_item['variation_id']; ?>" class="tw-text-gray-500 increment-cart-item tw-cursor-pointer tw-transition-colors tw-duration-150 tw-w-6 tw-h-6" >
                            <?php include (get_template_directory() . '/assets/svgs/plus.svg'); ?>
                          </span>
                        </div>
                        <?php
                          echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                              '<div class="tw-cursor-pointer hover:tw-text-gray-700 tw-text-sm tw-text-right tw-text-gray-400 remove-cart-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">Remove Items</div>',
                            //esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                              esc_attr__( 'Remove this item', 'woocommerce' ),
                              esc_attr( $product_id ),
                              esc_attr( $cart_item_key ),
                              esc_attr( $_product->get_sku() )
                            ),
                            $cart_item_key
                          );
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tw-w-full tw-justify-between tw-flex tw-mt-2">
                  <div>Item Total</div>
                  <div>
                    <?php
                      $linePrice = $product_price * $cart_item['quantity'];
                      echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="th-price">' . get_woocommerce_currency_symbol() . number_format((float)$linePrice, 2, '.', '') . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>
                  </div>
                </div>
              </li>
              <?php
            }
          }

          do_action( 'woocommerce_mini_cart_contents' );
          ?>
        </ul>

        <p class="woocommerce-mini-cart__total total tw-mt-4">
          <?php
          /**
           * Hook: woocommerce_widget_shopping_cart_total.
           *
           * @hooked woocommerce_widget_shopping_cart_subtotal - 10
           */
          do_action( 'woocommerce_widget_shopping_cart_total' );
          ?>
        </p>

        <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

        <p class="woocommerce-mini-cart__buttons buttons tw-mt-8"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

        <?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

      <?php else : ?>
        <div class="tw-mt-8 tw-flex tw-justify-center tw-flex-col tw-text-center">
          <p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>
          <p class="tw-mt-2">But we would love to help you get it filled. Select a tile collection that suits you. </p>
          <div class="tw-flex tw-flex-col tw-items-center">
            <?php
              // $cat = get_term_by('slug', 'collection', 'product_cat');
              // if($cat->parent==0) {
              //   $arg=[[],[]];
              //   getcatsubs($cat,$arg);
              //   if ($arg[0]) {
              //       $l=0;
              //       foreach ($arg[0] as $scat) {
              //           $i=$arg[1][$l];
              //           $link = get_category_link($scat->cat_ID);
              //           $pageID = get_queried_object()->term_id;
              //           if($scat->cat_ID === $pageID) {
              //             echo "<a class='tw-w-full tw-mt-6 tw-text-center tw-flex tw-bg-white tw-w-full tw-text-black tw-min-h-60p tw-justify-center tw-items-center tw-px-4 tw-rounded-md hover:tw-bg-black tw-border-solid tw-border hover:tw-text-white tw-border-black tw-select-none' href='$link'>$scat->name</a>";
              //           } else {
              //             echo "<a class='tw-w-full tw-mt-6 tw-text-center tw-flex tw-bg-white tw-w-full tw-text-black tw-min-h-60p tw-justify-center tw-items-center tw-px-4 tw-rounded-md hover:tw-bg-black tw-border-solid tw-border hover:tw-text-white tw-border-black tw-select-none' href='$link'>$scat->name</a>";
              //           }
              //           $l++;
              //       }
              //   }
              // }
              $types = getAllProductGroups();
              if(!empty($types)) {
                foreach ($types as $type) {
                    //var_dump($type);
                    // $i=$arg[1][$l];
                    $link = get_term_link($type->term_id);
                    $pageID = get_queried_object()->term_id;
                    if($type->term_id === $pageID) {
                      echo "<a class='tw-w-full tw-mt-6 tw-text-center tw-flex tw-bg-white tw-w-full tw-text-black tw-min-h-60p tw-justify-center tw-items-center tw-px-4 tw-rounded-md hover:tw-bg-black tw-border-solid tw-border hover:tw-text-white tw-border-black tw-select-none' href='$link'>$type->name</a>";
                    } else {
                      echo "<a class='tw-w-full tw-mt-6 tw-text-center tw-flex tw-bg-white tw-w-full tw-text-black tw-min-h-60p tw-justify-center tw-items-center tw-px-4 tw-rounded-md hover:tw-bg-black tw-border-solid tw-border hover:tw-text-white tw-border-black tw-select-none' href='$link'>$type->name</a>";
                    }
                }
              }
            ?>
            <?php
              $cat = get_term_by('slug', 'tile', 'product_cat');
              if($cat->parent==0) {
                $arg=[[],[]];
                getcatsubs($cat,$arg);
                if ($arg[0]) {
                    $l=0;
                    foreach ($arg[0] as $scat) {
                        $i=$arg[1][$l];
                        $link = get_category_link($scat->cat_ID);
                        $pageID = get_queried_object()->term_id;
                        echo "<a class='tw-w-full tw-mt-6 tw-text-center tw-flex tw-bg-white tw-w-full tw-text-black tw-min-h-60p tw-justify-center tw-items-center tw-px-4 tw-rounded-md hover:tw-bg-black tw-border-solid tw-border hover:tw-text-white tw-border-black tw-select-none' href='$link'>$scat->name</a>";
                        $l++;
                    }
                }
              }
            ?>
          </div>
        </div>

      <?php endif; ?>

      <?php do_action( 'woocommerce_after_mini_cart' ); ?>
    </div>
  </div>
</div>
