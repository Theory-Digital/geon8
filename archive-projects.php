<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Geon_Tile
 */

	get_header();

  //Estimated Time to Read function
  function estimatedTime($content) {
    $word = str_word_count(strip_tags($content));
    $m = floor($word / 200);
    if( $m < 1){
      return '1 min read';
    }
    $est = $m . ' min read';

    return $est;
  };
?>
<div class="th-page tw-opacity-0 tw-duration-500">
<div class="tw-relative tw-bg-gray-50 tw-pt-16 tw-pb-20 tw-px-4 sm:tw-px-6 lg:tw-pt-24 lg:tw-pb-28 lg:tw-px-8">
  <div class="tw-absolute tw-inset-0">
    <div class="tw-bg-white tw-h-1/3 sm:tw-h-2/3"></div>
  </div>
  <div class="tw-relative tw-max-w-7xl tw-mx-auto">
    <div id="articles" class="tw-text-center">
      <h2 class="tw-text-3xl tw-tracking-tight tw-font-extrabold tw-text-gray-900">
        From the blog
      </h2>
      <p class="tw-mt-3 tw-max-w-2xl tw-mx-auto tw-text-xl tw-text-gray-500 sm:tw-mt-4">
        Check out our latest content on tiles.
      </p>
    </div>
    <div class="tw-max-w-2xl tw-mx-auto tw-flex tw-justify-center tw-mt-4">
      <div class="tw-inline-flex tw-items-center tw-mx-1 tw-px-2 tw-py-1 tw-rounded-md tw-text-sm tw-font-medium tw-bg-primary-red-300 tw-text-white">
        <div class="tw-text-lg tw-h-auto tw-w-full tw-h-full tw-select-none">Projects</div>
      </div>
      <?php foreach(get_terms('projects') as $term){  ?>
        <div class="tw-inline-flex tw-items-center tw-px-2 tw-mx-1 tw-py-1 tw-rounded-md tw-text-sm tw-font-medium tw-bg-gray-100 tw-text-gray-800 hover:tw-bg-gray-300">
          <a class="tw-cursor-pointer tw-h-auto tw-w-full tw-h-full" href="<?php echo get_term_link($term->slug,'projects'); ?>#articles"><?php echo $term->name; ?>s</a>
        </div>
        <?php } ?>
    </div>
    <div class="tw-mt-12 tw-max-w-lg tw-mx-auto tw-grid tw-gap-5 lg:tw-grid-cols-3 lg:tw-max-w-none">
    <?php 
      while ( have_posts() ) : the_post(); ?>
        <div class="tw-flex tw-flex-col tw-rounded-lg tw-shadow-lg tw-overflow-hidden">
          <div class="tw-flex-shrink-0">
            <a href="<?php echo get_permalink(); ?>" class="tw-cursor-pointer tw-h-auto">
              <img class="tw-h-48 tw-w-full tw-object-cover" alt="" src="<?php echo get_field('image') ?>">
            </a>
          </div>
          <div class="tw-flex-1 tw-bg-white tw-p-6 tw-flex tw-flex-col tw-justify-between" href="#">
            <div class="tw-flex-1">
                <p class="tw-text-sm tw-font-medium tw-text-primary-red-300 tw-my-0">
                  <?php foreach(wp_get_post_terms(get_the_ID(), 'projects') as $itm){ ?>
                    <a class="tw-cursor-pointer tw-mr-4 tw-h-auto tw-text-left tw-text-sm tw-w-auto tw-inline hover:tw-underline" href="<?php echo get_term_link($itm->slug,'projects'); ?>"><?php echo $itm->name; ?></a>
                  <?php } ?>
                </p>
              <a href="<?php echo get_permalink();?>" class="tw-cursor-pointer tw-block tw-mt-2 md:tw-h-full md:tw-max-h-28 tw-h-auto tw-pb-32 tw-relative">
                <p class="tw-text-xl tw-font-semibold tw-text-gray-900">
                  <?php echo get_field('title') ?>
                </p>
                <p class="tw-mt-3 tw-text-base tw-text-gray-500">
                  <?php echo get_field('featured_text') ?>
                </p>
                <div class="tw-mt-6 tw-flex tw-items-center tw-absolute tw-bottom">
                  <div class="tw-flex-shrink-0">
                    <div>
                      <span class="tw-sr-only"><?php echo get_field('author') ?></span>
                      <img class="tw-h-10 tw-w-10 tw-rounded-full" src="<?php echo get_field('author_portrait') ?>" alt="<?php get_field('author') ?>">
                    </div>
                  </div>
                  <div class="tw-ml-3">
                      <div class="tw-h-auto tw-w-auto tw-block tw-mb-1">
                        <?php echo get_field('author') ?>
                      </div>
                    <div class="tw-flex tw-space-x-1 tw-text-sm tw-text-gray-500">
                      <time datetime="<?php echo get_the_date(); ?>">
                        <?php echo get_the_date(); ?>
                      </time>
                      <span aria-hidden="true">
                        &middot;
                      </span>
                      <span>
                        <?php echo estimatedTime(get_the_content()); ?>
                      </span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
    <?php
      endwhile;
      
    ?>
    </div>
  </div>
</div>
<div class="tw-flex pagination tw-justify-center tw-text-lg tw-bg-white tw-mt-4">
  <?php 
      echo paginate_links( array(
          'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
          'total'        => $wp_query->max_num_pages,
          'current'      => max( 1, get_query_var( 'paged' ) ),
          'format'       => '?paged=%#%',
          'show_all'     => false,
          'type'         => 'plain',
          'end_size'     => 3,
          'mid_size'     => 1,
          'prev_next'    => false,
          'add_args'     => false,
          'add_fragment' => '',
      ) );
  ?>
  </div>
  <section>
    <?php includeWithVariables((get_template_directory() . '/components/subscribe-cta.php'),
        array(
          'title' => "We're always up to something at Geon. Stay in the loop.",
          'content' => 'The latest news, articles, and resources, sent to your inbox.',
          'image' => 'https://tailwindui.com/img/features/feature-example-2.png',
        )
      )?>
  </section>
  <?php get_footer(); ?>
<style>
  .pagination a:link, .pagination span{
    width:auto;
    height:auto;
    padding:1rem;
  }

  .pagination span {
    border-top:solid 1px;
    border-color:#5CA4B5;
    color:#FF5600;
  }

  .gform_wrapper form.gf_simple_horizontal div.gform_body ul.top_label li.gfield{
    padding-right: 0px;
  }
  @media only screen and (min-width: 768px){
    #input_4_1 {
      border-radius: 3px 0px 0px 3px
    }

    #gform_submit_button_4{
      border-radius: 0px 3px 3px 0px;
    }
  }
</style>
<script>
  // prevent flash of unstyles CSS on
  document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector(".th-page").classList.remove('tw-opacity-0')
  });
</script>