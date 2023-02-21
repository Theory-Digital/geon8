<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
  <div class="tw-mb-32">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
  </div>
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
  <section>
    <?php
      $fp = get_field('featured_products');
      $products = getProdsByID($fp['products']);
      $cols = 4;
      if(empty($products)) {
        $products = getTopSellingProducts(4);
      }
      if(!empty($products)) {
        if($products % 3 == 0 && $products % 4 != 0) {
          $cols = 3;
        }
      }
    ?> 
    <?php includeWithVariables((get_template_directory() . '/components/three-col-product-display.php'),
        array(
          'products' => $products,
          'cols' => $cols,
          'heading' => !empty($fp['heading']) ? $fp['heading'] : 'You Might Also Like' ,
        )
      )?>
  </section>
  <section class="tw-mx-auto tw-mt-24 tw-max-w-7xl">
      <?php
        $al = get_field('alternating_left');
        $alG = get_field('product_components','options');
        if(!empty($alG['alternating_left_heading'])) {
          $al['heading'] = $alG['alternating_left_heading'];
        }
        if(!empty($alG['alternating_left_default'])) {
          $al['content'] = $alG['alternating_left_default'];
        }
        if(!empty($alG['alternating_left_image'])) {
          $al['image'] = $alG['alternating_left_image'];
        }
      ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-left.php'),
        array(
          'title' => $al['heading'],
          'content' => $al['content'],
          'image' => esc_url($al['image']),
          'buttonUrl' => $al['link']['url'],
          'buttonText' => $al['link']['title'],
        )
      )?>
  </section>
  <section class="tw-max-w-7xl tw-mx-auto tw-mt-24">
      <?php
        $ar = get_field('alternating_right');
        $arG = get_field('product_components','options');
        if(!empty($arG['alternating_right_heading'])) {
          $ar['heading'] = $arG['alternating_right_heading'];
        }
        if(!empty($arG['alternating_right_default'])) {
          $ar['content'] = $arG['alternating_right_default'];
        }
        if(!empty($arG['alternating_right_image'])) {
          $ar['image'] = $arG['alternating_right_image'];
        }
      ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-right.php'),
        array(
          'title' => $ar['heading'],
          'content' => $ar['content'],
          'image' => esc_url($ar['image']),
          'buttonUrl' => $ar['link']['url'],
          'buttonText' => $ar['link']['title'],
        )
      )?>
  </section>
  <section>
    <?php $feed = get_field('general_feed', 'option'); ?>
    <?php includeWithVariables((get_template_directory() . '/components/instagram-feed.php'),
          array(
            'heading' => $feed['heading'],
            'content' => $feed['content'],
          )
        )?>
  </section>
  <section class="tw-mt-16">
    <?php $cta = get_field('cta'); ?>
    <?php includeWithVariables((get_template_directory() . '/components/subscribe-cta.php'),
          array(
            'title' => $cta['heading'],
            'content' => $cta['content'],
          )
        )?>
  </section>

<?php
get_footer( 'shop' );