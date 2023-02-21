<?php
/* Template Name:Geon Projects
*/
get_header();

// Define custom query parameters
  $custom_query_args = array( 
    'post_type'     => 'projects',
    'post_status'   => 'publish',
    'posts_per_page'=> 3,
   );

  // Get current page and append to custom query parameters array
  $custom_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
  
  // Instantiate custom query
  $loop = new WP_Query( $custom_query_args );
  
  // Pagination fix
  $temp_query = $wp_query;
  $wp_query   = NULL;
  $wp_query   = $loop;

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
<section class="tw-mt-16">
      <?php $cta = get_field('cta'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/subscribe-cta.php'),
          array(
            'title' => $cta['heading'],
            'content' => $cta['content'],
          )
        )?>
</section>
<div class="tw-relative tw-bg-gray-50 tw-pt-16 tw-pb-20 tw-px-4 sm:tw-px-6 lg:tw-pt-24 lg:tw-pb-28 lg:tw-px-8">
  <div class="tw-absolute tw-inset-0">
    <div class="tw-bg-white tw-h-1/3 sm:tw-h-2/3"></div>
  </div>
  <div class="tw-relative tw-max-w-7xl tw-mx-auto">
    <div class="tw-text-center">
      <h2 class="tw-text-3xl tw-tracking-tight tw-font-extrabold tw-text-gray-900">
        From the blog
      </h2>
      <p class="tw-mt-3 tw-max-w-2xl tw-mx-auto tw-text-xl tw-text-gray-500 sm:tw-mt-4">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa libero labore natus atque, ducimus sed.
      </p>
    </div>
    <div class="tw-mt-12 tw-max-w-lg tw-mx-auto tw-grid tw-gap-5 lg:tw-grid-cols-3 lg:tw-max-w-none">
    <?php 
      while ( $loop->have_posts() ): $loop->the_post()?>
        <div class="tw-flex tw-flex-col tw-rounded-lg tw-shadow-lg tw-overflow-hidden">
          <div class="tw-flex-shrink-0">
            <a href="<?php echo get_permalink(); ?>" class="tw-h-auto">
              <img class="tw-h-48 tw-w-full tw-object-cover" alt="" src="<?php echo get_field('image') ?>">
            </a>
          </div>
          <div class="tw-flex-1 tw-bg-white tw-p-6 tw-flex tw-flex-col tw-justify-between" href="#">
            <div class="tw-flex-1">
              <p class="tw-text-sm tw-font-medium tw-text-primaryRed-300">
                  <?php echo get_field('type') ?>
              </p>
              <a href="<?php echo get_permalink();?>" class="tw-block tw-mt-2 md:tw-h-full md:tw-max-h-28 tw-h-auto">
                <p class="tw-text-xl tw-font-semibold tw-text-gray-900">
                  <?php echo get_field('title') ?>
                </p>
                <p class="tw-mt-3 tw-text-base tw-text-gray-500">
                  <?php echo get_field('featured_text') ?>
                </p>
                </a>
              </a>
              <div class="tw-mt-6 tw-flex tw-items-center">
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
            </div>
          </div>
        </div>
    <?php
      endwhile;
      wp_reset_postdata();
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
    // Reset main query object
    $wp_query = NULL;
    $wp_query = $temp_query;
  ?>
  </div>
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
    document.querySelector(".container-signup").classList.remove('tw-opacity-0')
  });
</script>