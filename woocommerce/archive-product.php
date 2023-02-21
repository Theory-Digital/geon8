<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 *
 * Updated by Elvtn, LLC to include FacetWP markup.
 * https://elvtn.com
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
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
    <div class="tw-flex tw-flex-col tw-max-w-7xl tw-mx-auto md:tw-grid md:tw-gap-6 md:tw-grid-cols-3 lg:tw-grid-cols-4">
      <div class="shop-side-left md:tw-col-span-1 ">

        <?php include (get_template_directory() . '/components/shop-side-bar.php'); ?>
      </div>
      <div id="" class="md:tw-col-span-2 lg:tw-col-span-3">
	  	<div class="tw-top-0 tw-full tw-sticky tw-z-20">
			<div class="tw-flex tw-items-center md:tw-hidden tw-text-2xl tw-font-bold tw-py-2 tw-px-4 sm:tw-px-6 lg:tw-px-8 tw-justify-between tw-bg-gray-50">
				<?php echo woocommerce_page_title(); ?>
				<div class="th-filter-toggle tw-bg-white tw-text-sm tw-flex tw-items-center tw-font-thin tw-py-2 tw-px-4 tw-border tw-border-solid tw-border-gray-300 tw-rounded-full tw-cursor-pointer hover:tw-shadow-sm">
				<div class="tw-pr-1">Filters</div>
				<div class="tw-w-4 tw-text-gray-800">
					<?php include (get_template_directory() . '/assets/svgs/filters.svg'); ?>
				</div>
				</div>
			</div>
			<div class="tw-hidden th-collection-select md:tw-hidden tw-px-4 tw-bg-gray-100 tw-overflow-x-scroll tw-flex tw-items-center tw-py-3 tw-flex-nowrap tw-mb-4">
				<a class="tw-relative tw-flex tw-justify-center tw-text-sm tw-whitespace-nowrap tw-mr-4 <?php if( is_shop() ) { echo 'tw-hidden'; } ?>" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
				Exit Collection
				</a>
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
								echo "<a class='tw-whitespace-nowrap tw-mr-4 tw-font-bold tw-text-sm' href='$link'>$scat->name</a>";
							} else {
								echo "<a class='tw-whitespace-nowrap tw-mr-4 tw-text-sm' href='$link'>$scat->name</a>";
							}
							$l++;
						}
					}
					}
				?>
			</div>
		</div>
        <div class="tw-flex tw-flex-col facetwp-template md:tw-grid tw-gap-2 md:tw-grid-cols-2 lg:tw-grid-cols-3">
          <?php //echo do_shortcode('[facetwp template="products"]'); ?>
          <?php include (get_template_directory() . '/template-parts/facet.php'); ?>
		  	<?php echo do_shortcode(
          		'[facetwp facet="loadmore"]'
        	);?>
        </div>
      </div>
    </div>
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>