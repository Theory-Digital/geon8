<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package geontile
 */
  $favicon_url = get_stylesheet_directory_uri() . '/favicon.ico';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

  <link rel="shortcut icon" href="<?php echo $favicon_url;?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php woocommerce_mini_cart(); ?>
<?php wp_body_open(); ?>
<?php
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

  $blogArgs = array(
    'post_type'           => 'blogs',
    'post_status'         => 'publish',
    'posts_per_page'      => 1,
    'orderby' => 'rand'
  );

  $nav_blog = null;
  
  $blog_query = new WP_Query( $blogArgs );
  if ($blog_query->have_posts()) {
      while ($blog_query->have_posts()) : 
          
          $blog_query->the_post();
          $nav_blog = $blog_query->post;
      ?>
      <?php     
      endwhile;
  }
  wp_reset_query();

  $featured_query = new WP_Query( $args );

  if ($featured_query->have_posts()) {
    while ($featured_query->have_posts()) : 
        
        $featured_query->the_post();
        $nav_product = get_product( $featured_query->post->ID );
        $shape = $nav_product->get_attributes()["shape"]["options"];
        $link = get_permalink($featured_query->ID);
        $featureVar_s = wp_get_attachment_image_src(
            $nav_product->get_image_id(),
            "medium"
            )[0];
        $featureVar = "";
        $featureVar = wp_get_attachment_image_src($nav_product->get_image_id(), [
            400,
            400,
            ])[0];
        $featureVar = wp_get_attachment_url($nav_product->get_image_id());
    ?>
    <?php
    endwhile;
  }

  wp_reset_query();
?>
<div id="page">
  <?php
      $announcement = get_field('announcement', 'option'); 
      if($announcement['enable']) {
        includeWithVariables((get_template_directory() . '/components/announcement.php'), array(
          'content' => $announcement['content'],
          'mobile' => $announcement['mobile_content'],
          'barColor' => $announcement['bar_color'],
          'textColor' => $announcement['text_color'],
        )
      );
    }
  ?>
	<header class="tw-flex tw-z-21 tw-sticky tw-transition-all tw-duration-200">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="tw-w-full tw-z-21 th-border-thin">
      <div class="tw-z-21 tw-bg-white">
        <div class="th-header-shadow tw-max-w-7xl tw-mx-auto tw-flex tw-py-6 tw-px-4 sm:tw-px-6 lg:tw-px-8 tw-justify-between">
          <div class="th-left-menu tw-flex tw-items-center tw-flex-initial">
            <div class="tw-hidden md:tw-flex tw-parent tw-items-center tw-h-full">
              <div class="th-nav-item tw-pt-1 tw-mr-8">
                  <button type="button" class="th-open-menu tw-text-black tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium tw-border-b tw-border-solid tw-border-white hover:tw-border-gray-900 tw-outline-none" aria-expanded="false">
                    <span>Shop</span>
                  </button>
                  <div style="opacity:0; top:-50px;" class="tw-absolute tw-z-21 tw-inset-x-0 tw-transform tw-max-h-auto tw-max-h-0 tw-overflow-hidden tw-transition-all tw-duration-300 th-mega-menu th-header-menu">
                    <div class="tw-absolute tw-inset-0 tw-flex" aria-hidden="true">
                      <div class="tw-bg-white tw-w-1/2"></div>
                      <div class="tw-bg-white tw-w-1/2"></div>
                    </div>
                    <div class="tw-relative tw-max-w-7xl tw-mx-auto tw-grid tw-grid-cols-1 lg:tw-grid-cols-2">
                      <nav class="tw-grid tw-gap-y-10 tw-px-4 tw-py-8 tw-bg-white sm:tw-grid-cols-2 sm:tw-gap-x-8 sm:tw-py-12 sm:tw-px-6 md:tw-grid-cols-3 lg:tw-px-8 xl:tw-pr-12" aria-labelledby="solutions-heading">
                        <h2 id="solutions-heading" class="tw-sr-only">Shop</h2>
                        <div>
                          <h3 class="tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase">Type</h3>
                          <ul role="list" class="tw-mt-7 tw-space-y-6">
                            <li class="tw-flow-root">
                              <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=terrazzo'?>" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Terrazzo Tile</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=zellige'?>" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Zellige</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=cement-tile'?>" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Cement Tile</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=penny-rounds'?>" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Penny Rounds</span>
                              </a>
                            </li>
							  <li class="tw-flow-root">
                              <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=oceanside-glass'?>" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Oceanside Glass</span>
                              </a>
                            </li>
							  <li class="tw-flow-root">
                              <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=timber-tiles'?>" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Timber Tiles</span>
                              </a>
                            </li>

                          </ul>
                        </div>
                        <div>
                          <h3 class="tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase">Accessories</h3>
                          <ul role="list" class="tw-mt-7 tw-space-y-6">
                            <li class="tw-flow-root">
                              <a href="/accessory/nanoseal-gt/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Sealer</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="/accessory/neutraclean-gt/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Cleaner</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="/accessory/tile-hero-kit/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Tile Hero</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="tw-flex tw-items-end tw-col-span-full tw-text-gray-500">
<!--                           <a class="tw-inline hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent hover:tw-text-black tw-transition-all tw-duration-200" href="/shop/"> --><a class="tw-inline tw-flex tw-items-center tw-justify-center tw-px-8 tw-py-3 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-md tw-text-white tw-bg-primary-yellow hover:tw-bg-primary-yellow-700 md:tw-py-4 md:tw-text-lg md:tw-px-10" href="https://geontile.com/collections/2022-vip-sale/">
                            SHOP VIP SALE
                          </a>
                        </div>
                      </nav>
                      <div class="tw-bg-white tw-px-4 tw-py-8 sm:tw-py-12 sm:tw-px-6lg:tw-px-8xl:tw-pl-12 tw-pb-8">
                        <div>
                          <h3 class="tw-mb-6 tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase"><?php the_field('right_menu_title', 'option'); ?></h3>
                          <ul role="list" class="tw-grid lg:tw-block tw-grid-cols-2 tw-gap-x-4">
                          <?php if($nav_product != null): ?>
                            <li class="tw-group tw-flow-root tw-group tw-max-w-105-5 tw-bg-center tw-h-30-25 tw-relative tw-z-10 tw-bg-cover tw-bg-no-repeat" style="background-image:url('<?php echo $featureVar_s ?>');">
                                <a href="<?php echo $link ?>" class="tw-relative tw-z-1 tw-p-3 tw-h-full tw-w-full tw-flex tw-rounded-lg  tw-transition tw-ease-in-out tw-duration-150 tw-cursor-pointer">
                                    <div class="tw-flex-col tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                      <div class="tw-min-w-0 tw-flex-1 tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                        <h4 class="tw-border-b tw-border-solid tw-border-transparent group-hover:tw-border-white tw-font-bold tw-tracking-wide tw-uppercase tw-text-white tw-truncate">
                                            Shop <?php echo ($shape[0] . ' ' . $nav_product->get_name()) ?>
                                        </h4>
                                        <?php if($shape[0]): ?>
                                          <div class="tw-inline-flex tw-text-white tw-inline-block tw-px-2 tw-top-0 tw-left-0 tw-absolute" style="background-color:#20AB9A;"> <?php echo $shape[0] ?></div>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                </a>
                                <div class="tw-absolute tw-w-full tw-h-full tw-bg-black tw-opacity-50 tw-top-0"></div>
                            </li>
                          <?php endif; ?>
                            
                          <li class="lg:tw-mt-6 tw-group tw-flow-root tw-group tw-max-w-105-5 tw-bg-center tw-h-30-25 tw-relative tw-z-10 tw-bg-cover tw-bg-no-repeat" style="background-image:url('<?php echo get_field('image', $nav_blog->ID); ?>');">
                                <a href="<?php echo get_permalink($nav_blog->ID); ?>" class="tw-relative tw-z-1 tw-p-3 tw-h-full tw-w-full tw-flex tw-rounded-lg  tw-transition tw-ease-in-out tw-duration-150 tw-cursor-pointer">
                                    <div class="tw-flex-col tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                      <div class="tw-min-w-0 tw-flex-1 tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                        <h4 class="tw-border-b tw-border-solid tw-border-transparent group-hover:tw-border-white tw-font-bold tw-tracking-wide tw-uppercase tw-text-white tw-truncate">
                                          <?php echo $nav_blog->post_title; ?>
                                        </h4>
                                      </div>
                                    </div>
                                </a>
                                <div class="tw-absolute tw-w-full tw-h-full tw-bg-black tw-opacity-50 tw-top-0"></div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- <div class="th-nav-item tw-pt-1 tw-mr-8">
                  <button type="button" class="tw-outline-none th-open-menu tw-text-black tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium tw-border-b tw-border-solid tw-border-white hover:tw-border-gray-900" aria-expanded="false">
                    <span>Collections</span>
                  </button>
                  <div style="opacity:0; top:-50px;" class="tw-absolute tw-z-21 tw-inset-x-0 tw-transform tw-shadow-lg tw-max-h-auto tw-max-h-0 tw-overflow-hidden tw-transition-all tw-duration-300 th-mega-menu th-header-menu">
                    <div class="tw-absolute tw-inset-0 tw-flex" aria-hidden="true">
                      <div class="tw-bg-white tw-w-1/2"></div>
                      <div class="tw-bg-white tw-w-1/2"></div>
                    </div>
                    <div class="tw-relative tw-max-w-7xl tw-mx-auto tw-grid tw-grid-cols-1 lg:tw-grid-cols-2">
                      <nav class="tw-grid tw-gap-y-10 tw-px-4 tw-py-8 tw-bg-white sm:tw-grid-cols-2 sm:tw-gap-x-8 sm:tw-py-12 sm:tw-px-6 md:tw-grid-cols-3 lg:tw-px-8 xl:tw-pr-12" aria-labelledby="solutions-heading">
                        <h2 id="solutions-heading" class="tw-sr-only"></h2>
                        <div>
                          <h3 class="tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase">Collections</h3>
                          <ul role="list" class="tw-mt-7 tw-space-y-6">
                            <li class="tw-flow-root">
                              <a href="/collections/on-our-table/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">OnOurTable</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="/collections/tailored-to/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Tailored To</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="/collections/Zebra/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Zebra</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="/collections/spicy/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Spicy</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="/collections/classics/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Classics</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="tw-flex tw-items-end tw-col-span-full tw-text-gray-500">
                          <a class="tw-inline hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent hover:tw-text-black tw-transition-all tw-duration-200" href="/shop/"/>
                            SHOP ALL
                          </a>
                        </div>
                      </nav>
                      <div class="tw-bg-white tw-px-4 tw-py-8 sm:tw-py-12 sm:tw-px-6lg:tw-px-8xl:tw-pl-12 tw-pb-8">
                        <div>
                          <h3 class="tw-mb-6 tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase"><?php the_field('right_menu_title', 'option'); ?></h3>
                          <ul role="list" class="tw-grid lg:tw-block tw-grid-cols-2 tw-gap-x-4">
                          <?php if($nav_product != null): ?>
                            <li class="tw-group tw-flow-root tw-group tw-max-w-105-5 tw-bg-center tw-h-30-25 tw-relative tw-z-10 tw-bg-cover tw-bg-no-repeat" style="background-image:url('<?php echo $featureVar_s ?>');">
                                <a href="<?php echo $link ?>" class="tw-relative tw-z-1 tw-p-3 tw-h-full tw-w-full tw-flex tw-rounded-lg  tw-transition tw-ease-in-out tw-duration-150 tw-cursor-pointer">
                                    <div class="tw-flex-col tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                      <div class="tw-min-w-0 tw-flex-1 tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                        <h4 class="tw-border-b tw-border-solid tw-border-transparent group-hover:tw-border-white tw-font-bold tw-tracking-wide tw-uppercase tw-text-white tw-truncate">
                                            Shop <?php echo ($shape[0] . ' ' . $nav_product->get_name()) ?>
                                        </h4>
                                        <?php if($shape[0]): ?>
                                          <div class="tw-inline-flex tw-text-white tw-inline-block tw-px-2 tw-top-0 tw-left-0 tw-absolute" style="background-color:#20AB9A;"> <?php echo $shape[0] ?></div>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                </a>
                                <div class="tw-absolute tw-w-full tw-h-full tw-bg-black tw-opacity-50 tw-top-0"></div>
                            </li>
                          <?php endif; ?>
                            
                          <li class="lg:tw-mt-6 tw-group tw-flow-root tw-group tw-max-w-105-5 tw-bg-center tw-h-30-25 tw-relative tw-z-10 tw-bg-cover tw-bg-no-repeat" style="background-image:url('<?php echo get_field('image', $nav_blog->ID); ?>');">
                                <a href="<?php echo get_permalink($nav_blog->ID); ?>" class="tw-relative tw-z-1 tw-p-3 tw-h-full tw-w-full tw-flex tw-rounded-lg  tw-transition tw-ease-in-out tw-duration-150 tw-cursor-pointer">
                                    <div class="tw-flex-col tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                      <div class="tw-min-w-0 tw-flex-1 tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                        <h4 class="tw-border-b tw-border-solid tw-border-transparent group-hover:tw-border-white tw-font-bold tw-tracking-wide tw-uppercase tw-text-white tw-truncate">
                                          <?php echo $nav_blog->post_title; ?>
                                        </h4>
                                      </div>
                                    </div>
                                </a>
                                <div class="tw-absolute tw-w-full tw-h-full tw-bg-black tw-opacity-50 tw-top-0"></div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
              </div> -->
              <div class="th-nav-item tw-pt-1 tw-mr-8">
                  <button type="button" class="tw-outline-none th-open-menu tw-text-black tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium tw-border-b tw-border-solid tw-border-white hover:tw-border-gray-900" aria-expanded="false">
                    <span>Design</span>
                  </button>
                  <div style="opacity:0; top:-50px;" class="tw-absolute tw-z-21 tw-inset-x-0 tw-transform tw-shadow-lg tw-max-h-auto tw-max-h-0 tw-overflow-hidden tw-transition-all tw-duration-300 th-mega-menu th-header-menu">
                    <div class="tw-absolute tw-inset-0 tw-flex" aria-hidden="true">
                      <div class="tw-bg-white tw-w-1/2"></div>
                      <div class="tw-bg-white tw-w-1/2"></div>
                    </div>
                    <div class="tw-relative tw-max-w-7xl tw-mx-auto tw-grid tw-grid-cols-1 lg:tw-grid-cols-2">
                      <nav class="tw-grid tw-gap-y-10 tw-px-4 tw-py-8 tw-bg-white sm:tw-grid-cols-2 sm:tw-gap-x-8 sm:tw-py-12 sm:tw-px-6 md:tw-grid-cols-3 lg:tw-px-8 xl:tw-pr-12" aria-labelledby="solutions-heading">
                        <h2 id="solutions-heading" class="tw-sr-only"></h2>
                        <div>
                          <h3 class="tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase">Design</h3>
                          <ul role="list" class="tw-mt-7 tw-space-y-6">
                            <li class="tw-flow-root">
                              <a href="/samples" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Samples</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'geon-tile-design-hero/';?>" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Design Hero</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </nav>
                      <div class="tw-bg-white tw-px-4 tw-py-8 sm:tw-py-12 sm:tw-px-6lg:tw-px-8xl:tw-pl-12 tw-pb-8">
                        <div>
                          <h3 class="tw-mb-6 tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase"><?php the_field('right_menu_title', 'option'); ?></h3>
                          <ul role="list" class="tw-grid lg:tw-block tw-grid-cols-2 tw-gap-x-4">
                          <?php if($nav_product != null): ?>
                            <li class="tw-group tw-flow-root tw-group tw-max-w-105-5 tw-bg-center tw-h-30-25 tw-relative tw-z-10 tw-bg-cover tw-bg-no-repeat" style="background-image:url('<?php echo $featureVar_s ?>');">
                                <a href="<?php echo $link ?>" class="tw-relative tw-z-1 tw-p-3 tw-h-full tw-w-full tw-flex tw-rounded-lg  tw-transition tw-ease-in-out tw-duration-150 tw-cursor-pointer">
                                    <div class="tw-flex-col tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                      <div class="tw-min-w-0 tw-flex-1 tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                        <h4 class="tw-border-b tw-border-solid tw-border-transparent group-hover:tw-border-white tw-font-bold tw-tracking-wide tw-uppercase tw-text-white tw-truncate">
                                            Shop <?php echo ($shape[0] . ' ' . $nav_product->get_name()) ?>
                                        </h4>
                                        <?php if($shape[0]): ?>
                                          <div class="tw-inline-flex tw-text-white tw-inline-block tw-px-2 tw-top-0 tw-left-0 tw-absolute" style="background-color:#20AB9A;"> <?php echo $shape[0] ?></div>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                </a>
                                <div class="tw-absolute tw-w-full tw-h-full tw-bg-black tw-opacity-50 tw-top-0"></div>
                            </li>
                          <?php endif; ?>
                            
                          <li class="lg:tw-mt-6 tw-group tw-flow-root tw-group tw-max-w-105-5 tw-bg-center tw-h-30-25 tw-relative tw-z-10 tw-bg-cover tw-bg-no-repeat" style="background-image:url('<?php echo get_field('image', $nav_blog->ID); ?>');">
                                <a href="<?php echo get_permalink($nav_blog->ID); ?>" class="tw-relative tw-z-1 tw-p-3 tw-h-full tw-w-full tw-flex tw-rounded-lg  tw-transition tw-ease-in-out tw-duration-150 tw-cursor-pointer">
                                    <div class="tw-flex-col tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                      <div class="tw-min-w-0 tw-flex-1 tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                        <h4 class="tw-border-b tw-border-solid tw-border-transparent group-hover:tw-border-white tw-font-bold tw-tracking-wide tw-uppercase tw-text-white tw-truncate">
                                          <?php echo $nav_blog->post_title; ?>
                                        </h4>
                                      </div>
                                    </div>
                                </a>
                                <div class="tw-absolute tw-w-full tw-h-full tw-bg-black tw-opacity-50 tw-top-0"></div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-6 tw-w-6 th-open-mobile tw-cursor-pointer md:tw-hidden tw-transition tw-duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </div>
          <a href="/">
            <img class="tw-h-10 tw-select-none tw-flex-1" src="<?php echo (get_template_directory_uri() . '/assets/images/GeonLogoWText.png'); ?>"></img>
          </a>
          <div class="th-right-menu tw-flex tw-flex-initial tw-items-center">
            <!-- start -->
            <div class="th-nav-item tw-pt-1 tw-mr-8 tw-hidden md:tw-flex">
                  <button type="button" class="tw-outline-none th-open-menu tw-text-black tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium tw-border-b tw-border-solid tw-border-white hover:tw-border-gray-900" aria-expanded="false">
                    <span>Our Commitment</span>
                  </button>
                  <div style="opacity:0; top:-50px;" class="tw-absolute tw-z-21 tw-inset-x-0 tw-transform tw-shadow-lg tw-max-h-auto tw-max-h-0 tw-overflow-hidden tw-transition-all tw-duration-300 th-mega-menu th-header-menu">
                    <div class="tw-absolute tw-inset-0 tw-flex" aria-hidden="true">
                      <div class="tw-bg-white tw-w-1/2"></div>
                      <div class="tw-bg-white tw-w-1/2"></div>
                    </div>
                    <div class="tw-relative tw-max-w-7xl tw-mx-auto tw-grid tw-grid-cols-1 lg:tw-grid-cols-2">
                      <nav class="tw-grid tw-gap-y-10 tw-px-4 tw-py-8 tw-bg-white sm:tw-grid-cols-2 sm:tw-gap-x-8 sm:tw-py-12 sm:tw-px-6 md:tw-grid-cols-3 lg:tw-px-8 xl:tw-pr-12" aria-labelledby="solutions-heading">
                        <h2 id="solutions-heading" class="tw-sr-only"></h2>
                        <div>
                          <h3 class="tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase">Our Commitment</h3>
                          <ul role="list" class="tw-mt-7 tw-space-y-6">
                            <li class="tw-flow-root">
                              <a href="/our-commitment/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Social Responsiblity</span>
                              </a>
                            </li>
                            <li class="tw-flow-root">
                              <a href="/environment/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Environment</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div>
                          <h3 class="tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase">About Us</h3>
                          <ul role="list" class="tw-mt-7 tw-space-y-6">
                            <li class="tw-flow-root">
                              <a href="/our-story/" class="tw--m-3 tw-pb-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 tw-group tw-transition tw-ease-in-out tw-duration-150">
                                <span class="tw-ml-4 group-hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent">Our Story</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="tw-flex tw-items-end tw-col-span-full tw-text-gray-500">
                          <a class="tw-inline hover:tw-border-gray-900 tw-border-b tw-border-solid tw-border-transparent hover:tw-text-black tw-transition-all tw-duration-200" href="/shop/">
							
                            SHOP All
                          </a>
                        </div>
                      </nav>
                      <div class="tw-bg-white tw-px-4 tw-py-8 sm:tw-py-12 sm:tw-px-6lg:tw-px-8xl:tw-pl-12 tw-pb-8">
                        <div>
                          <h3 class="tw-mb-6 tw-text-sm tw-font-bold tw-tracking-wide tw-text-black tw-uppercase"><?php the_field('right_menu_title', 'option'); ?></h3>
                          <ul role="list" class="tw-grid lg:tw-block tw-grid-cols-2 tw-gap-x-4">
                          <?php if($nav_product != null): ?>
                            <li class="tw-group tw-flow-root tw-group tw-max-w-105-5 tw-bg-center tw-h-30-25 tw-relative tw-z-10 tw-bg-cover tw-bg-no-repeat" style="background-image:url('<?php echo $featureVar_s ?>');">
                                <a href="<?php echo $link ?>" class="tw-relative tw-z-1 tw-p-3 tw-h-full tw-w-full tw-flex tw-rounded-lg  tw-transition tw-ease-in-out tw-duration-150 tw-cursor-pointer">
                                    <div class="tw-flex-col tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                      <div class="tw-min-w-0 tw-flex-1 tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                        <h4 class="tw-border-b tw-border-solid tw-border-transparent group-hover:tw-border-white tw-font-bold tw-tracking-wide tw-uppercase tw-text-white tw-truncate">
                                            Shop <?php echo ($shape[0] . ' ' . $nav_product->get_name()) ?>
                                        </h4>
                                        <?php if($shape[0]): ?>
                                          <div class="tw-inline-flex tw-text-white tw-inline-block tw-px-2 tw-top-0 tw-left-0 tw-absolute" style="background-color:#20AB9A;"> <?php echo $shape[0] ?></div>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                </a>
                                <div class="tw-absolute tw-w-full tw-h-full tw-bg-black tw-opacity-50 tw-top-0"></div>
                            </li>
                          <?php endif; ?>
                            
                          <li class="lg:tw-mt-6 tw-group tw-flow-root tw-group tw-max-w-105-5 tw-bg-center tw-h-30-25 tw-relative tw-z-10 tw-bg-cover tw-bg-no-repeat" style="background-image:url('<?php echo get_field('image', $nav_blog->ID); ?>');">
                                <a href="<?php echo get_permalink($nav_blog->ID); ?>" class="tw-relative tw-z-1 tw-p-3 tw-h-full tw-w-full tw-flex tw-rounded-lg  tw-transition tw-ease-in-out tw-duration-150 tw-cursor-pointer">
                                    <div class="tw-flex-col tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                      <div class="tw-min-w-0 tw-flex-1 tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
                                        <h4 class="tw-border-b tw-border-solid tw-border-transparent group-hover:tw-border-white tw-font-bold tw-tracking-wide tw-uppercase tw-text-white tw-truncate">
                                          <?php echo $nav_blog->post_title; ?>
                                        </h4>
                                      </div>
                                    </div>
                                </a>
                                <div class="tw-absolute tw-w-full tw-h-full tw-bg-black tw-opacity-50 tw-top-0"></div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            <!-- end -->
            <!-- start -->
            <div class="tw-hidden md:tw-inline tw-whitespace-nowrap tw-pt-1">
              <a href="https://resources.geontile.com/" class="tw-outline-none tw-text-black tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium tw-hover:text-gray-900 tw-mr-4  tw-border-b tw-border-solid tw-border-white hover:tw-border-gray-900">
                <span class="">Tile Guides</span>
              </a>
            </div><!-- end -->
            <div id="mini-cart-icon" class="tw-relative tw-gray-600 tw-inline-flex tw-p-1 tw-h-8 tw-rounded-md tw-mr-4 tw-cursor-pointer tw-transition-colors tw-duration-150">
              <?php include (get_template_directory() . '/assets/svgs/mini-cart.svg'); ?>
              <div class="tw--right-4 tw-top-2 tw-absolute tw-bg-black tw-text-white tw-h-4 tw-w-4 tw-text-xs tw-inline-flex tw-items-center tw-justify-center tw-rounded-full"><span id="cartQuant"><?php echo sizeof(WC()->cart->get_cart());?></span></div>
            </div>
          </div>
        </div>
        <!-- mobile -->
        <div id="mobileMenu" style="opacity:0; top:calc(100% - 50px);" class="tw-relative tw-max-h-0 tw-transition-all tw-duration-200 md:tw-hidden th-hide-scroll tw-flex tw-flex-col tw-parent tw-h-full tw-overflow-scroll">
          <div class="th-nav-item">
              <button type="button" class="tw-flex tw-justify-between tw-px-4 tw-w-full tw-py-4 th-open-menu tw-text-gray-500 tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium hover:tw-text-gray-900 focus:tw-outline-none " aria-expanded="false">
                <span>Shop</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-6 tw-w-6 tw-transition tw-duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div class="tw-z-21 tw-transform tw-max-h-0 tw-overflow-hidden tw-transition-max-height tw-duration-200 th-mega-menu">
                <div class="tw-absolute tw-inset-0 tw-flex" aria-hidden="true">
                  <div class="tw-bg-white tw-w-1/2"></div>
                  <div class="tw-bg-white tw-w-1/2"></div>
                </div>
                <div class="tw-border-t tw-border-solid  tw-relative tw-max-w-7xl tw-mx-auto tw-grid tw-grid-cols-1 lg:tw-grid-cols-2">
                  <nav class="tw-grid tw-px-4 tw-bg-white sm:tw-grid-cols-2 sm:tw-gap-x-8 sm:tw-py-12 sm:tw-px-6 md:tw-grid-cols-3 lg:tw-px-8 xl:tw-pr-12" aria-labelledby="solutions-heading">
                    <h2 id="solutions-heading" class="tw-sr-only"></h2>
                    <div class="th-sub-item">
                      <div class="th-open-sub tw-flex tw-justify-between tw-items-center tw-border-b tw-py-3 tw--mx-4 tw-px-3 tw-cursor-pointer">
                        <h3 class="tw-w-full tw-flex tw-text-sm tw-font-medium tw-tracking-wide tw-text-gray-500 tw-uppercase tw-user-select-none">Type</h3>
                      </div>
                      <ul role="list" style="opacity:0; top:-50px;" class="th-sub-menu tw-max-h-0 tw-overflow-hidden tw-transition-all tw-duration-300">
                        <li class="tw-flow-root">
                          <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=terrazzo'?>" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Terrazzo Tile</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=zellige'?>" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Zellige</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=cement-tile'?>" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Cement Tile</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=penny-rounds'?>" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Penny Rounds</span>
                          </a>
                        </li>
						      <li class="tw-flow-root">
                          <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=oceanside-glass'?>" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Oceanside Glass</span>
                          </a>
                        </li>
						      <li class="tw-flow-root">
                          <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'?_type=timber-tiles'?>" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Timber Tiles</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="th-sub-item">
                      <div class="th-open-sub tw-flex tw-justify-between tw-items-center tw-border-b tw-py-3 tw--mx-4 tw-px-3 tw-cursor-pointer">
                        <h3 class="tw-w-full tw-flex tw-text-sm tw-font-medium tw-tracking-wide tw-text-gray-500 tw-uppercase tw-user-select-none">Accessories</h3>
                      </div>
                      <ul role="list" style="opacity:0; top:-50px;" class="th-sub-menu tw-max-h-0 tw-overflow-hidden tw-transition-all tw-duration-300">
                        <li class="tw-flow-root">
                          <a href="/accessory/nanoseal-gt/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Sealer</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="/accessory/neutraclean-gt/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Cleaner</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="/accessory/tile-hero-kit/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Tile Hero</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </nav>
                </div>
              </div>
          </div>
          <!-- <div class="th-nav-item">
              <button type="button" class="tw-border-t tw-border-solid tw-flex tw-justify-between tw-px-4 tw-w-full tw-py-4 th-open-menu tw-text-gray-500 tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium hover:tw-text-gray-900 focus:tw-outline-none " aria-expanded="false">
                <span>Collections</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-6 tw-w-6 tw-transition tw-duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div class="tw-z-21 tw-transform tw-max-h-0 tw-overflow-hidden tw-transition-max-height tw-duration-200 th-mega-menu">
                <div class="tw-absolute tw-inset-0 tw-flex" aria-hidden="true">
                  <div class="tw-bg-white tw-w-1/2"></div>
                  <div class="tw-bg-white tw-w-1/2"></div>
                </div>
                <div class="tw-border-t tw-border-solid  tw-relative tw-max-w-7xl tw-mx-auto tw-grid tw-grid-cols-1 lg:tw-grid-cols-2"> -->
                  <!-- <nav class="tw-grid tw-px-4 tw-bg-white sm:tw-grid-cols-2 sm:tw-gap-x-8 sm:tw-py-12 sm:tw-px-6 md:tw-grid-cols-3 lg:tw-px-8 xl:tw-pr-12" aria-labelledby="solutions-heading">
                    <h2 id="solutions-heading" class="tw-sr-only"></h2>
                    <div class="th-sub-item">
                      <div class="th-open-sub tw-flex tw-justify-between tw-items-center tw-border-b tw-py-3 tw--mx-4 tw-px-3 tw-cursor-pointer">
                        <h3 class="tw-w-full tw-flex tw-text-sm tw-font-medium tw-tracking-wide tw-text-gray-500 tw-uppercase tw-user-select-none">Collections</h3>
                      </div>
                      <ul role="list" style="opacity:0; top:-50px;" class="th-sub-menu tw-max-h-0 tw-overflow-hidden tw-transition-all tw-duration-300">
                        <li class="tw-flow-root">
                          <a href="collections/on-our-table/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">OnOurTable</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="collections/tailored-to/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Tailored To</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="collections/zebra/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Zebra</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="collections/spicy/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Spicy</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="collections/classics/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Classics</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </nav> -->
                  <!-- <nav class="tw-grid tw-px-4 tw-bg-white sm:tw-grid-cols-2 sm:tw-gap-x-8 sm:tw-py-12 sm:tw-px-6 md:tw-grid-cols-3 lg:tw-px-8 xl:tw-pr-12" aria-labelledby="solutions-heading">
                   <h2 id="solutions-heading" class="tw-sr-only"></h2>
                    <div class="th-sub-item">
                      <div class="th-open-sub tw-flex tw-justify-between tw-items-center tw--mx-4 tw-px-3 tw-cursor-pointer">
                        <ul role="list" style="" class="tw-w-full tw-transition-all tw-duration-300">
                          <li class="tw-flow-root">
                            <a href="collections/on-our-table/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                              <span class="tw-ml-4">OnOurTable</span>
                            </a>
                          </li>
                          <li class="tw-flow-root">
                            <a href="collections/tailored-to/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                              <span class="tw-ml-4">Tailored To</span>
                            </a>
                          </li>
                          <li class="tw-flow-root">
                            <a href="collections/zebra/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                              <span class="tw-ml-4">Zebra</span>
                            </a>
                          </li>
                          <li class="tw-flow-root">
                            <a href="collections/spicy/" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                              <span class="tw-ml-4">Spicy</span>
                            </a>
                          </li>
                          <li class="tw-flow-root">
                            <a href="collections/classics/" class="sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                              <span class="tw-ml-4">Classics</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </nav>
                </div>
              </div>
          </div> -->
          <div class="th-nav-item">
              <button type="button" class="tw-border-t tw-border-solid tw-flex tw-justify-between tw-px-4 tw-w-full tw-py-4 th-open-menu tw-text-gray-500 tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium hover:tw-text-gray-900 focus:tw-outline-none " aria-expanded="false">
                <span>Design</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-6 tw-w-6 tw-transition tw-duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div class="tw-z-21 tw-transform tw-max-h-0 tw-overflow-hidden tw-transition-max-height tw-duration-200 th-mega-menu">
                <div class="tw-absolute tw-inset-0 tw-flex" aria-hidden="true">
                  <div class="tw-bg-white tw-w-1/2"></div>
                  <div class="tw-bg-white tw-w-1/2"></div>
                </div>
                <div class="tw-border-t tw-border-solid  tw-relative tw-max-w-7xl tw-mx-auto tw-grid tw-grid-cols-1 lg:tw-grid-cols-2">
                  <!-- <nav class="tw-grid tw-px-4 tw-bg-white sm:tw-grid-cols-2 sm:tw-gap-x-8 sm:tw-py-12 sm:tw-px-6 md:tw-grid-cols-3 lg:tw-px-8 xl:tw-pr-12" aria-labelledby="solutions-heading">
                    <h2 id="solutions-heading" class="tw-sr-only"></h2>
                    <div class="th-sub-item">
                      <div class="th-open-sub tw-flex tw-justify-between tw-items-center tw-border-b tw-py-3 tw--mx-4 tw-px-3 tw-cursor-pointer">
                        <h3 class="tw-w-full tw-flex tw-text-sm tw-font-medium tw-tracking-wide tw-text-gray-500 tw-uppercase tw-user-select-none">Design Details</h3>
                      </div>
                      <ul role="list" style="opacity:0; top:-50px;" class="th-sub-menu tw-max-h-0 tw-overflow-hidden tw-transition-all tw-duration-300">
                        <li class="tw-flow-root">
                          <a href="/samples" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Samples</span>
                          </a>
                        </li>
                        <li class="tw-flow-root">
                          <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'geon-tile-design-hero/'?>" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                            <span class="tw-ml-4">Design Hero</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </nav> -->
                  <nav class="tw-grid tw-px-4 tw-bg-white sm:tw-grid-cols-2 sm:tw-gap-x-8 sm:tw-py-12 sm:tw-px-6 md:tw-grid-cols-3 lg:tw-px-8 xl:tw-pr-12" aria-labelledby="solutions-heading">
                   <h2 id="solutions-heading" class="tw-sr-only"></h2>
                    <div class="th-sub-item">
                      <div class="th-open-sub tw-flex tw-justify-between tw-items-center tw--mx-4 tw-px-3 tw-cursor-pointer">
                        <ul role="list" style="" class="tw-w-full tw-transition-all tw-duration-300">
                          <li class="tw-flow-root">
                            <a href="/samples" class="tw-border-b sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                              <span class="tw-ml-4">Samples</span>
                            </a>
                          </li>
                          <li class="tw-flow-root">
                            <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ).'geon-tile-design-hero/'?>" class="sm:tw-border-hidden tw--mx-4 tw-py-3 tw-flex tw-items-center tw-text-base tw-font-medium tw-text-gray-900 hover:tw-bg-gray-50 tw-transition tw-ease-in-out tw-duration-150">
                              <span class="tw-ml-4">Design Hero</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </nav>
                </div>
              </div>
          </div>
          <div class="th-nav-item">
              <a href="/our-story" class="tw-border-t tw-border-b tw-flex tw-justify-between tw-px-4 tw-w-full tw-py-4 th-open-menu tw-text-gray-500 tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium hover:tw-text-gray-900 focus:tw-outline-none " aria-expanded="false">
                <span>About Us</span>
              </a>
          </div>
          <div class="th-nav-item">
              <a href="https://resources.geontile.com/" class="tw-border-b tw-flex tw-justify-between tw-px-4 tw-w-full tw-py-4 th-open-menu tw-text-gray-500 tw-group tw-bg-white tw-inline-flex tw-items-center tw-text-base tw-font-medium hover:tw-text-gray-900 focus:tw-outline-none " aria-expanded="false">
                <span>Tile Guides</span>
              </a>
          </div>
			<a class=" tw-mx-4 tw-mt-4 tw-inline tw-flex tw-items-center tw-justify-center tw-px-8 tw-py-3 tw-border tw-border-transparent tw-text-base tw-font-medium tw-rounded-md tw-text-white tw-bg-primary-yellow hover:tw-bg-primary-yellow-700 md:tw-py-4 md:tw-text-lg md:tw-px-10" href="https://geontile.com/collections/2022-vip-sale/">
                            SHOP VIP SALE
                          </a>
        </div>
		
        <!-- end mobile -->
      </div>
    </div>
    <div class="tw-hidden">
      <nav id="site-navigation" class="tw-flex">
        <button aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'geontile' ); ?></button>
      </nav>
    </div>

	</header>
  <div id="headerOverlay" style="opacity:0;" class="tw-hidden tw-transition-all tw-duration-500 tw-z-10 th-grayout tw-w-full tw-h-full tw-fixed tw-bg-black tw-opacity-50 tw-top-0 tw-left-0 tw-transition tw-duration-75">

  </div>