<?php
/* Template Name: Geon Guides
*/
get_header();
//Query
$loop = new WP_Query( array(  
    'post_type'     => 'guide',
    'post_status'   => 'publish',
    'posts_per_page'=> -1,
    'meta_query'	=> array(
		'relation'		=> 'AND',
		array(
			'key'	 	=> 'category',
			'value'	  	=> array('About Cement Tile','Getting Started', 'Install', 'Maintenance'),
			'compare' 	=> 'IN',
		),
    ),
    'meta_key'      => 'category',
    'orderby'       => 'meta_value',
    'order'     => 'ASC'
	//'meta_key'      => 'category',
	//  'orderby' => array( 
      // 'meta_value'      => 'ASC', 
     //  'menu_order' => 'ASC' 
   // ) 
   
));

$featured = get_field('general', 'option'); 
$prod = wc_get_product($featured['product']);


//GET ALT
$dark_cta = get_field('dark_cta');
$feature_section = get_field('feature_section');
$socialMedia = get_field('social_media_cta'); // 'our_services' is your parent group
$fb = $socialMedia['facebook'];
$insta = $socialMedia['instagram'];
$card1 = get_field('feature_tile_1');
$card2 = get_field('feature_tile_2');
$card3 = get_field('feature_tile_3');
?>
<style type="text/css">
    main{
        padding: 0;
    }

    .guide-filters > div .facetwp-facet{
        display:flex;
        flex-wrap:wrap;
        justify-content:center;
        text-align:center;
        width:100%;
    }

    .guide-divider > p {
        margin:auto;
    }

    .guide-filters > div:not(.reset-facets){
        justify-content:space-between;
        margin:auto;
        flex-wrap:wrap;
        position:relative;
    }

    .facetwp-type-checkboxes > div{
        margin:5px;
    }

    .guide-filters{
        padding-top:40px;
        padding-bottom:40px;
        max-width:1174px;
        margin:auto;
        flex-wrap:wrap;
        display: flex;
        flex-direction: row;
    }

    .facetwp-checkbox{
        width:45%;
        text-transform: capitalize;
    }

    [data-value="pdf"]{
        text-transform: uppercase;
    }

    .guides{
        margin-bottom:40px;
    }

    .reset-facets{
        display: flex;
        justify-content: center;
        height: 60px;
        width: 100%;
        text-decoration: none;
        border-radius: 7px;
        font-size: 18px;
        left:0;
        top:0;
    }

    .yellow-anchor:hover{
        cursor:pointer;
        background-color:#F3AD1BB3;
    }

    .yellow-anchor{
        margin:5px;
        padding:15px;
        background-color:#F3AD1B;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 60px;
        border-radius: 7px;
        font-size: 18px;
        padding: 0 30px 0 30px;
        margin-right: 10px;
        color:white;
        width: 45%;
    }
    /* @@@ */
    p {
        max-width:unset;
        margin-bottom:0.5rem;
    }
    .th-display img {
        padding:2rem 0;
        margin:auto;
    }

    .th-display blockquote {
        padding:0.5rem 0;
    }   

    @media only screen and (min-width : 415px) {
        .yellow-anchor{
            width:108.24px;
            box-sizing:border-box;
            text-align:center;
        }
        .guide-filters{
            justify-content:space-between;
        }

        .guide-filters > div:not(.reset-facets){
            margin:0;
        }
        .guide-filters > div{
            display:flex;
            flex-direction:row;
            justify-content: space-between;
        }

        .guide-filters > div .facetwp-facet{
            width:unset;
            justify-content:flex-start;
        }

        .guide-filters div > *{
            justify-content:flex-start;
        }

        .facetwp-checkbox{
            width:unset;
        }
    }

    @media only screen and (min-width : 658px) {

        .guide-filters > div{
            margin-left:0px;
        }

        .guide-filters > div:nth-of-type(1){
            max-width:80%;
        }

        .guide-filters > .reset-facets{
            max-width:20%
        }

    }
    /* @@@ */
    @media only screen and (min-width: 768px) {
        body {
            padding-left:0px;
        }
    }

    @media only screen and (min-width : 1400px) {
        .guide-filters > div:nth-of-type(1){
            max-width:90%;
        }

        .guide-filters > .reset-facets{
            max-width:10%
        }

    }
</style>
<div class="tw-relative">
    <button style="z-index:101;" class="guide-toggle md:tw-hidden tw-fixed tw-ml-1 tw-flex tw-items-center tw-justify-center tw-h-16 tw-w-16 tw-rounded-full tw-bg-primary-blue tw-right-0 tw-bottom-0 tw-mb-20 tw-mr-10">
        <span class="tw-sr-only">toggle sidebar</span>
        <!-- Heroicon name: outline/x -->
        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-6 tw-w-6 tw-text-white" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
        </svg>
    </button>
    <section class="side-layout tw-border-b">
        <div class="tw-flex tw-overflow-hidden">
            <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
            <div style="z-index:100; opacity:0;" class="guide-menu tw-fixed tw-flex md:tw-hidden tw-transition-all tw-duration-200" aria-modal="true">
                <div class="guide-gray-bg tw-fixed tw-bg-gray-600 tw-hidden" aria-hidden="true"></div>
                    <div class="guide-bg tw-relative tw-flex-1 tw-flex tw-flex-col tw-max-w-xs tw-w-full tw-pt-5 tw-pb-4 tw-bg-white">
                        <a class="tw-flex-shrink-0 tw-flex tw-items-center tw-px-4 tw-h-auto tw-justify-start" href="https://geontile.com/geon-guides/">
                            <img class="tw-h-8 tw-w-auto" src="<?php echo (get_template_directory_uri() . '/assets/images/GeonLogoWText.png'); ?>" alt="Workflow">
                        </a>
                        <div class="tw-mt-5 tw-flex-1 tw-h-0 tw-overflow-y-scroll th-scroll-y-fix">
                            <nav class="tw-px-2">
                            <?php
                                $categoryCheck = '';
                                while ( $loop->have_posts() ): $loop->the_post()?>
                                    <?php 
                                        if($categoryCheck != get_field('category')): 
                                    ?>
                                        <div class="tw-px-3 tw-my-3 lg:tw-my-3 tw-mt-5 lg:tw-mt-5 tw-uppercase tw-tracking-wide tw-font-semibold tw-text-sm lg:tw-text-xs tw-text-gray-900">
                                            <?php echo get_field('category'); ?>
                                        </div>
                                    <?php 
                                        $categoryCheck = get_field('category');
                                        endif;
                                    ?>
                                    <a 
                                        class="tw-px-3 tw-py-1 tw-transition-colors tw-duration-200 tw-relative tw-block hover:tw-text-gray-900 tw-text-gray-500 tw-h-auto tw-m-0 tw-text-sm" href='<?php echo get_permalink() ?>' >
                                        <?php echo get_field('title') ?>
                                    </a>
                                    <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    ?>
                                </nav>
                        </div>
                    </div>
                </div>

            <!-- Static sidebar for desktop -->
            <div class="tw-hidden md:tw-flex md:tw-flex-shrink-0">
                <div class="tw-flex tw-flex-col tw-w-64">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="tw-flex tw-flex-col tw-flex-grow tw-border-r tw-border-gray-200 tw-pt-5 tw-pb-4 tw-bg-white">
                    <div class="tw-px-5 tw-text-lg tw-flex">
                        <a class="tw-justify-start tw-h-auto tw-bg-opacity-50 hover:tw-bg-opacity-75 tw-transition-colors tw-duration-200 th-rando" href="https://geontile.com/geon-guides/">
                            <?php echo the_title(); ?>
                        </a>
                    </div>
                    <div class="tw-mt-3 tw-flex-grow tw-flex tw-flex-col tw-h-full">
                    <nav class="tw-flex-1 tw-px-2 tw-bg-white tw-h-full">
                        <?php 
                            $categoryCheck = '';
                            while ( $loop->have_posts() ): $loop->the_post()?>
                                <?php 
                                    if($categoryCheck != get_field('category')): 
                                ?>
                                    <div class="tw-px-3 tw-my-3 tw-uppercase tw-tracking-wide tw-font-semibold tw-text-sm lg:tw-text-xs tw-text-gray-900">
                                        <?php echo get_field('category'); ?>
                                    </div>
                                <?php 
                                    $categoryCheck = get_field('category');
                                    endif;
                                ?>
                                <a 
                                    class="tw-px-3 tw-py-1 tw-transition-colors tw-duration-200 tw-relative tw-block hover:tw-text-gray-900 tw-text-gray-500 tw-h-auto tw-m-0 tw-text-sm" href='<?php echo get_permalink() ?>' >
                                    <?php echo get_field('title') ?>
                                </a>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        ?>
                    </nav>
                    </div>
                </div>
                </div>
            </div>
            <div class="tw-flex tw-flex-col tw-w-0 tw-flex-1">
                <main class="tw-th-display tw-flex-1 tw-relative focus:tw-outline-none">
                    <div class="tw-h-full">
                        <div class="tw-max-w-7xl tw-mx-auto">
                        <!-- Replace with your content -->
                            <section class="">
                                <div class="tw-px-8 tw-relative">
                                    <div class="tw-pt-8">
                                        <h1 class="tw-text-5xl tw-leading-none tw-font-extrabold tw-text-gray-900 tw-tracking-tight tw-mb-4 th-rando"><?php echo the_title(); ?></h1>
                                        <p class="text-2xl tracking-tight mb-10"><?php the_field('page_byline')?></p>
                                        <div class="tw-pt-8">
                                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6 xl:tw-gap-8">
                                                <div class="tw-w-full tw-relative tw-text-white tw-overflow-hidden tw-flex tw-shadow-lg">
                                                    <div class="tw-w-full tw-flex md:tw-flex-col tw-bg-gradient-to-br tw-from-primary-red-400 tw-to-primary-red-500">
                                                        <div class="th-min-w-half tw-w-full sm:tw-max-w-sm sm:tw-flex-none md:tw-w-auto md:tw-flex-auto tw-flex tw-flex-col tw-items-start tw-relative tw-z-1 tw-p-6 xl:tw-p-8">
                                                            <h2 class="tw-text-xl tw-font-semibold tw-mb-2 tw-text-shadow"><?php echo $card1['heading']?></h2>
                                                            <p class="tw-font-medium tw-text-primary-red-100 tw-text-shadow tw-mb-4"><?php echo $card1['byline']?></p>
                                                            <a class="tw-mt-auto tw-bg-primary-red-800 tw-bg-opacity-50 hover:tw-bg-opacity-75 tw-transition-colors tw-duration-200 tw-font-semibold tw-py-2 tw-px-4 tw-inline-flex tw-w-auto" href="<?php echo $card1['link']['url']?>"><?php echo $card1['link']['title']?></a>
                                                        </div>
                                                        <div class="th-min-w-half tw-relative tw-h-full tw-flex tw-items-end md:tw-w-full tw-justify-end">
                                                            <img class="tw-w-full tw-h-full th-guide-img tw-object-cover" src="<?php echo $card1['image']?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="tw-absolute tw-bottom-0 tw-left-0 tw-right-0 tw-h-20 tw-hidden md:tw-flex" style="background:linear-gradient(to top, rgb(0, 0, 0), rgba(255, 221, 204, 0))"></div>
                                                </div>
                                                
                                                <div class="tw-w-full tw-relative tw-text-white tw-overflow-hidden tw-flex tw-shadow-lg">
                                                    <div class="tw-w-full tw-flex md:tw-flex-col tw-bg-gradient-to-br tw-from-primary-blue-400 tw-to-primary-blue-500">
                                                        <div class="th-min-w-half tw-w-full sm:tw-max-w-sm sm:tw-flex-none md:tw-w-automd:tw-flex-auto tw-flex tw-flex-col tw-items-start tw-relative tw-z-1 tw-p-6 xl:tw-p-8">
                                                            <h2 class="tw-text-xl tw-font-semibold tw-mb-2 tw-text-shadow"><?php echo $card2['heading']?></h2>
                                                            <p class="tw-font-medium tw-text-primary-blue-100 tw-text-shadow tw-mb-4"><?php echo $card2['byline']?></p>
                                                            <a class="hover:tw-bg-opacity-75 tw-mt-auto tw-bg-primary-blue-800 tw-bg-opacity-50 tw-transition-colors tw-duration-200 tw-font-semibold tw-py-2 tw-px-4 tw-inline-flex tw-w-auto" href="<?php echo $card2['link']['url']?>" ><?php echo $card2['link']['title']?></a>
                                                        </div>
                                                        <div class="th-min-w-half tw-relative tw-h-full tw-flex tw-items-end md:tw-w-full tw-justify-end">
                                                            <img class="tw-w-full tw-h-full th-guide-img tw-object-cover" src="<?php echo $card2['image']?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="tw-absolute tw-bottom-0 tw-left-0 tw-right-0 tw-h-20 tw-hidden md:tw-flex" style="background:linear-gradient(to top, rgb(0, 0, 0), rgba(232, 242, 245, 0))"></div>
                                                </div>

                                                <div class="tw-w-full tw-relative tw-text-white tw-overflow-hidden tw-flex tw-shadow-lg">
                                                    <div class="tw-w-full tw-flex md:tw-flex-col tw-bg-gradient-to-br tw-from-primary-yellow-400 tw-to-primary-yellow-500">
                                                        <div class="th-min-w-half tw-w-full sm:tw-max-w-sm sm:tw-flex-none md:tw-w-automd:tw-flex-auto tw-flex tw-flex-col tw-items-start tw-relative tw-z-1 tw-p-6 xl:tw-p-8">
                                                            <h2 class="tw-text-xl tw-font-semibold tw-mb-2 tw-text-shadow"><?php echo $card3['heading']?></h2>
                                                            <p class="tw-font-medium tw-text-primary-yellow-100 tw-text-shadow tw-mb-4"><?php echo $card3['byline']?></p>
                                                            <a class="tw-mt-auto tw-bg-primary-yellow-800 tw-bg-opacity-50 hover:tw-bg-opacity-75 tw-transition-colors tw-duration-200 tw-font-semibold tw-py-2 tw-px-4 tw-inline-flex tw-w-auto" href="<?php echo $card3['link']['url']?>"><?php echo $card3['link']['title']?></a>
                                                        </div>
                                                        <div class="th-min-w-half tw-relative tw-h-full tw-flex tw-items-end md:tw-w-full tw-justify-end">
                                                            <img class="tw-w-full tw-h-full th-guide-img tw-object-cover" src="<?php echo $card3['image']?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="tw-absolute tw-bottom-0 tw-left-0 tw-right-0 tw-h-20 tw-hidden md:tw-flex" style="background:linear-gradient(to top, rgb(0, 0, 0), rgba(253, 243, 221, 0))"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="dk-blue-circle"></div> -->

                                </div>
                            </section>
                            <section class="tw-p-8 tw-relative">
                            <?php
                              includeWithVariables((get_template_directory() . '/components/featured-item.php'),
                                array(
                                  'heading' => $featured['heading'],
                                  'content' => $featured['content'],
                                  'image' => esc_url($featured['image']),
                                  'product' => $prod,
                                )
                              )?>
                            </section>
                            <section class="tw-px-8 tw-pb-8 tw-relative">
                                <h2 class="tw-text-3xl tw-tracking-tight tw-font-extrabold tw-text-gray-900 tw-mt-16 tw-mb-8"><?php echo $socialMedia['heading'] ?></h2>
                                <ul class="tw-grid sm:tw-grid-cols-2 tw-gap-6 xl:tw-gap-8">
                                    <li>
                                        <a href="<?php echo $fb['link']['url']?>" class="tw-flex tw-items-start tw-space-x-4 tw-h-auto">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-square" fill="currentColor" class="tw-flex-none tw-text-gray-900 tw-w-12 tw-h-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"></path></svg>
                                            <div class="tw-flex-auto">
                                                <h3 class="tw-font-bold tw-text-gray-900"><?php echo $fb['heading']?></h3>
                                                <p><?php echo $fb['byline']?></p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $insta['link']['url']?>" class="tw-flex tw-items-start tw-space-x-4 tw-h-auto">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" fill="currentColor" class="tw-flex-none tw-text-gray-900 tw-w-12 tw-h-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
                                            <div class="tw-flex-auto">
                                                <h3 class="tw-font-bold tw-text-gray-900"><?php echo $insta['heading']?></h3>
                                                <p><?php echo $insta['byline']?></p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </section>
                        <!-- /End replace -->
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
    <section class="tw-bg-white">
        <div>
            <div class="tw-max-w-7xl tw-mx-auto tw-pt-16 tw-px-4 sm:tw-px-6 lg:tw-px-8 tw-max-w-screen-lg">
                <div class="lg:tw-grid lg:tw-grid-cols-2 lg:tw-gap-4">
                <div class="tw-flex tw-items-center tw-pt-10 tw-pb-12 tw-px-6 sm:tw-pt-32 sm:tw-px-16 lg:tw-py-16 lg:tw-pr-0 xl:tw-py-20 xl:tw-px-20">
                    <div>
                      <h2 class="tw-text-3xl tw-font-extrabold tw-text-primary-blue">
                          <span class="tw-block"><?php echo $feature_section['heading']; ?></span>
                      </h2>
                      <p class="tw-mt-4 tw-text-lg tw-leading-6 tw-text-gray-700"><?php echo $feature_section['content']; ?></p>
                      <?php if($feature_section['link']) { ?>
                        <a class="tw-w-auto hover:tw-opacity-90 tw-inline-flex tw-items-center tw-mt-6 tw-bg-primary-blue-500 tw-text-white tw-p-4 tw-rounded-md" target="<?php echo $feature_section['link']['target']?>" href="<?php echo $feature_section['link']['url']; ?>">         
                          <?php echo $feature_section['link']['title']; ?>
                        </a>
                      <?php } ?>
                    </div>
                </div>
                <div class="tw--mt-6 tw-mb-8 tw-aspect-w-5 tw-aspect-h-3 md:tw-aspect-w-2 md:tw-aspect-h-1 tw-flex tw-items-center">
                    <div class="tw-w-full tw-relative tw-py-3 sm:tw-max-w-xl sm:tw-mx-auto tw-max-w-screen-sm tw-mx-auto md:tw-mr-8">
                        <div class="tw-absolute tw-inset-0 tw-bg-gradient-to-r tw-from-primary-blue-400 tw-to-primary-blue-600 tw-shadow-lg tw-transform tw--skew-y-6 sm:tw-skew-y-0 sm:tw--rotate-6 sm:tw-rounded-3xl"></div>
                        <div class="tw-relative tw-bg-white tw-shadow-lg tw-rounded-3xl">
                            <img class="tw-max-h-80 tw-object-cover tw-max-w-md tw-mx-auto tw-w-full sm:tw-rounded-3xl" src="<?php echo $feature_section['image']; ?>"/>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>

<script>
jQuery( document ).ready(function() { 
    document.querySelector(".guide-toggle").addEventListener("click", doCoolStuff);

    function doCoolStuff() {
        document.querySelector(".guide-gray-bg").classList.toggle("tw-hidden")
        document.querySelector(".guide-menu").classList.toggle("th-active-side-menu")
        if(document.querySelector(".th-active-side-menu")) {
            document.querySelector(".guide-menu").style.left = '0';
            document.querySelector(".guide-menu").style.opacity = '100%';
            document.querySelector(".guide-gray-bg").style.opacity = '.45';
        } else {
            document.querySelector(".guide-menu").style.left = '-100%';
            document.querySelector(".guide-menu").style.opacity = '0';
            document.querySelector(".guide-gray-bg").style.opacity = '0';
        }
    }
});
</script>
<style>
    .guide-menu{
        left:-100%;
        top: 0px;
        right: 0px;
        bottom: 0px;
        width:100%;
    }

    .guide-gray-bg{
        opacity: 0;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: -100%;
    }
</style>