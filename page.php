<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package geontile
 */

get_header();
?>

	<main id="primary">

		<?php
		while ( have_posts() ) :
			the_post();
    ?>
    <div class="tw-relative tw-py-16 tw-bg-white tw-overflow-hidden">
      <div class="tw-hidden lg:tw-block lg:tw-absolute lg:tw-inset-y-0 lg:tw-h-full lg:tw-w-full">
        <div class="tw-relative tw-h-full tw-text-lg tw-max-w-prose tw-mx-auto" aria-hidden="true">
          <svg class="tw-absolute tw-top-12 tw-left-full tw-transform tw-translate-x-32" width="404" height="384" fill="none" viewBox="0 0 404 384">
            <defs>
              <pattern id="74b3fd99-0a6f-4271-bef2-e80eeafdf357" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <rect x="0" y="0" width="4" height="4" class="tw-text-gray-200" fill="currentColor"></rect>
              </pattern>
            </defs>
            <rect width="404" height="384" fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)"></rect>
          </svg>
          <svg class="tw-absolute tw-top-1/2 tw-right-full tw-transform tw--translate-y-1/2 tw--translate-x-32" width="404" height="384" fill="none" viewBox="0 0 404 384">
            <defs>
              <pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <rect x="0" y="0" width="4" height="4" class="tw-text-gray-200" fill="currentColor"></rect>
              </pattern>
            </defs>
            <rect width="404" height="384" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)"></rect>
          </svg>
          <svg class="th-hide-on-short tw-absolute tw-bottom-12 tw-left-full tw-transform tw-translate-x-32" width="404" height="384" fill="none" viewBox="0 0 404 384">
            <defs>
              <pattern id="d3eb07ae-5182-43e6-857d-35c643af9034" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <rect x="0" y="0" width="4" height="4" class="tw-text-gray-200" fill="currentColor"></rect>
              </pattern>
            </defs>
            <rect width="404" height="384" fill="url(#d3eb07ae-5182-43e6-857d-35c643af9034)"></rect>
          </svg>
        </div>
      </div>
      <div class="tw-relative tw-px-4 sm:tw-px-6 lg:tw-px-8">
        <div class="tw-text-lg tw-max-w-prose tw-mx-auto">
          <h1>
            <!-- <span class="tw-block tw-text-base tw-text-center tw-text-primary-blue tw-font-semibold tw-tracking-wide tw-uppercase">Geon Tile</span> -->
            <span class="tw-mt-2 tw-block tw-text-3xl tw-text-center tw-leading-8 tw-font-extrabold tw-tracking-tight tw-text-gray-900 sm:tw-text-4xl"><?php the_title(); ?></span>
          </h1>
        </div>
        <div class="tw-mt-6 tw-prose tw-prose-indigo tw-prose-lg tw-mx-auto">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
    <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
<?php
get_footer();
