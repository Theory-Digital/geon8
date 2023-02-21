<?php
/* Template Name: Geon-Guides
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
));
?>
<style type="text/css">
    main{
        overflow:unset;
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
    @media only screen and (min-width: 1024px) {
        .th-panel{
            min-width:375px;
            max-width:425px;
        }
    }

    @media only screen and (min-width : 1440px) {
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
    <div class="tw-flex">
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
                        Geon Guides
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
            <section class="tw-th-display tw-flex tw-flex-col lg:tw-flex-row tw-relative focus:tw-outline-none tw-flex tw-mt-12 tw-h-full">
                <div class="tw-pb-6 tw-h-full lg:tw-w-3/5">
                    <div class="tw-max-w-7xl tw-mx-auto tw-px-4 sm:tw-px-6 md:tw-pl-12">
                    <!-- Replace with your content -->
                        <div
                            class="g-content flex"
                        >
                            <h1 class="tw-text-5xl tw-leading-none tw-font-extrabold tw-text-gray-900 tw-tracking-tight tw-mb-4"><?php the_field('title');?></h1>
                            <div>
                                <div class="tw-flex tw-flex-col tw-py-4">
                                    <?php if(get_field('guide_type')=='post'): ?>
                                        <?php echo get_field('content') ?>
                                    <?php elseif(get_field('guide_type')=='pdf'):?>
                                        <?php echo get_field('content') ?>
                                    <?php else:?>
                                        <?php 
                                            preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", get_field('video'), $matches);
                                        ?>
                                        <div class="tw-flex tw-flex-col tw-w-full">
                                            <iframe id="ytplayer" type="text/html" class="tw-w-full tw-h-64 md:tw-h-96"
                                                src="https://www.youtube.com/embed/<?php echo $matches[0];?>?autoplay=0"
                                                frameborder="0">
                                            </iframe>
                                            <div class="tw-py-8">
                                                <?php echo get_field('content') ?>
                                            </div>
                                        </div>
                                <?php endif;?>
                                </div>
                            </div>
                        </div>
                    <!-- /End replace -->
                    </div>
                </div>
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div style="top:150px;" class="<?php if(get_field('guide_type')=='pdf'): echo 'lg:tw-h-72'; else: echo 'lg:tw-h-64'; endif;?> th-panel tw-flex tw-flex-col tw-justify-between tw-w-full tw-px-4 tw-py-5 lg:tw-border-gray-200 lg:tw-sticky lg:tw-mb-12 lg:tw-rounded-3xl lg:tw-shadow-lg lg:tw-border lg:tw-mr-4" >
                    <div class="tw-pb-6 ">
                        <h3 class="tw-uppercase tw-text-xs tw-font-bold tw-pb-2"> Resources </h3>
                        <?php if(get_field('guide_type')=='pdf'): ?>
                            <p>Download the PDF of this guide below</p>
                            <a download class="tw-w-auto hover:tw-opacity-90 tw-text-sm tw-inline-flex tw-items-center tw-mt-6 tw-bg-primary-blue-500 tw-text-white tw-p-4 tw-rounded-md" href="<?php echo get_field('pdf'); ?>"> 
                                <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="cloud-download-alt" class="tw-w-6 tw-h-6 tw-mr-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M537.6 226.6A96.11 96.11 0 0 0 448 96a95.51 95.51 0 0 0-53.3 16.2A160 160 0 0 0 96 192c0 2.7.1 5.4.2 8.1A144 144 0 0 0 144 480h368a128 128 0 0 0 25.6-253.4zm-132.9 88.7L299.3 420.7a16.06 16.06 0 0 1-22.6 0L171.3 315.3c-10.1-10.1-2.9-27.3 11.3-27.3H248V176a16 16 0 0 1 16-16h48a16 16 0 0 1 16 16v112h65.4c14.2 0 21.4 17.2 11.3 27.3z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M404.7 315.3L299.3 420.7a16.06 16.06 0 0 1-22.6 0L171.3 315.3c-10.1-10.1-2.9-27.3 11.3-27.3H248V176a16 16 0 0 1 16-16h48a16 16 0 0 1 16 16v112h65.4c14.2 0 21.4 17.2 11.3 27.3z"></path></g></svg>
                                <?php echo get_field('title') ?>
                            </a>
                        <?php else: ?>
                            <p class="tw-pb-4">Having trouble? Shoot us an email with your question.</p>
                        <?php endif;?>
                    </div>
                    <div class="tw-flex tw-border-t tw-pt-4 tw-justify-between">
                        <div>Questions? Get in touch with an expert.</div>
                        <a href="mailto:hello@geontile.com" class="light tw-flex tw-px-1 tw-mx-2">
                            <!-- Heroicon name: solid/mail -->
                            <svg class="tw--ml-1 tw-h-5 tw-w-5 tw-mr-2" aria-hidden="true" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <span>
                            Email
                            </span>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
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