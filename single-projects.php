<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Geon_Tile
 */

get_header();
$previous = get_previous_post();
$next = get_next_post();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="tw-text-lg tw-max-w-xl tw-mx-auto tw-text-center tw-pt-8 tw-pb-6 prose lg:prose-lg">
                <time datetime="<?php echo get_the_date();?>" class="tw-text-base tw-leading-6 tw-font-medium tw-text-gray-500 tw-uppercase">
                  <?php echo get_the_date(); ?>
                </time>
                <h1 class="tw-my-0 tw-text-4xl tw-pt-4 tw-pb-6">
                    <?php the_title() ?>
                </h1>
            </div>
            <section class="tw-flex tw-flex-col-reverse tw-border-gray-200 tw-border-t md:tw-grid md:tw-grid-cols-4 xl:tw-col-gap-6 tw-max-w-3xl tw-mx-auto tw-px-4 md:tw-px-0 xl:tw-max-w-5xl xl:tw-px-0">
                <div class="md:tw-flex tw-w-full tw-pt-6 tw-col-span-1">
                    <div class="tw-w-full tw-my-0">
                        <div class="tw-sticky">
                            <dt class="tw-sr-only">Authors</dt>
                            <dd class="tw-ml-0 md:tw-pl-4 tw-pb-4">
                                <ul class="tw-flex tw-justify-center xl:tw-blocktw-space-x-8 sm:tw-space-x-12 xl:tw-space-x-0 xl:tw-space-y-8">
                                    <li class="tw-flex tw-items-center tw-space-x-2 tw-w-full">
                                        <img src="<?php echo get_field('author_portrait') ?>" alt="<?php get_field('author') ?>" class="tw-w-10 tw-h-10 tw-rounded-full">
                                        <dl class="tw-text-sm tw-font-medium tw-leading-5 tw-whitespace-no-wrap">
                                            <dt class="tw-sr-only">Name</dt>
                                            <dd class="tw-text-gray-900 tw-mx-0"><?php echo get_field('author') ?></dd>
                                            <dt class="tw-sr-only">Instagram</dt>
                                            <dd class="tw-mx-0"><a href="https://instagram.com/geontile" class="tw-text-primaryBlue-500 tw-h-auto">@geontile</a></dd>
                                        </dl>
                                    </li>
                                </ul>
                            </dd>
                              <dt class="tw-sr-only">Post Navigation</dt>
                              <dd style="border-top:solid 1px rgb(229,231,235);" class="tw-ml-0 tw-border-gray-200  md:tw-pl-4 ">
                                  <div class="tw-flex tw-flex-wrap tw-justify-between md:tw-block">
                                  <?php if($previous || $next): ?>
                                      <?php if($previous): ?>
                                      <div class="tw-py-2">
                                          <div class="tw-text-xs tw-tracking-wide tw-uppercase tw-text-gray-500">
                                              Previous Article
                                          </div>
                                          <div class="tw-text-teal-500 hover:tw-text-teal-600">
                                              <a rel="prefetch" href="<?php echo get_permalink($previous); ?>" class="tw-w-full tw-block tw-text-primaryBlue-500 hover:tw-text-primaryBlue-600 tw-h-auto">
                                                  <?php echo get_the_title($previous) ?>
                                              </a>
                                          </div>
                                      </div>
                                      <?php endif ?>
                                      <?php if($next): ?>
                                          <div class="tw-py-2">
                                              <div class="tw-text-xs tw-tracking-wide tw-uppercase tw-text-gray-500">
                                                  Next Article
                                              </div>
                                              <div class="tw-text-teal-500 hover:tw-text-teal-600">
                                                  <a rel="prefetch" class="tw-w-full tw-block tw-text-primaryBlue-500 hover:tw-text-primaryBlue-600 tw-h-auto" href="<?php echo get_permalink($next); ?>">
                                                      <?php echo get_the_title($next) ?>
                                                  </a>
                                              </div>
                                          </div>
                                      <?php endif ?>
                                    <?php endif; ?>
                                      <div class="tw-border-gray-200 tw-pt-4 tw-w-full tw-pb-4" >
                                          <div class="tw-text-teal-500 hover:tw-text-teal-600">
                                              <a class="tw-w-full tw-block tw-text-primaryBlue-500 hover:tw-text-primaryBlue-600 tw-h-auto" href="<?php echo get_post_type_archive_link(get_post_type()); ?>">← Back to blog</a>
                                          </div>
                                      </div>
                                  </div>
                              </dd>
                        </div>
                    </div>
                </div>
                <article class="tw-border-gray-200 tw-border-l-0 md:tw-border-l tw-relative tw-bg-white tw-overflow-hidden tw-col-span-3 prose lg:prose-xl">
                    <div class="tw-hidden lg:tw-block lg:tw-absolute lg:tw-inset-y-0 lg:tw-h-full lg:tw-w-full">
                        <div class="tw-relative tw-h-full tw-text-lg tw-max-w-xl tw-mx-auto" aria-hidden="true">
                            <svg class="tw-absolute tw-top-12 tw-left-full tw-transform tw-translate-x-32" viewBox="0 0 404 384">
                                <defs>
                                <pattern id="74b3fd99-0a6f-4271-bef2-e80eeafdf357" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="tw-text-gray-200" />
                                </pattern>
                                </defs>
                                <rect width="404" height="384" fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)" />
                            </svg>
                            <svg class="tw-absolute tw-top-1/2 tw-right-full tw-transform tw--translate-y-1/2 tw--translate-x-32" viewBox="0 0 404 384">
                                <defs>
                                <pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="tw-text-gray-200" />
                                </pattern>
                                </defs>
                                <rect width="404" height="384" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)" />
                            </svg>
                            <svg class="tw-absolute tw-bottom-12 tw-left-full tw-transform tw-translate-x-32" viewBox="0 0 404 384">
                                <defs>
                                <pattern id="d3eb07ae-5182-43e6-857d-35c643af9034" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="tw-text-gray-200" />
                                </pattern>
                                </defs>
                                <rect width="404" height="384" fill="url(#d3eb07ae-5182-43e6-857d-35c643af9034)" />
                            </svg>
                        </div>
                    </div>
                    <div class="tw-relative tw-px-4 sm:tw-px-6 lg:tw-px-8">
                        <div class="th-content tw-mt-6 tw-text-gray-500">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </article>
            </section>
            <section class="tw-flex tw-flex-col-reverse tw-border-gray-200 tw-border-t md:tw-grid md:tw-grid-cols-4 xl:tw-col-gap-6 tw-pb-16 xl:tw-pb-20 tw-max-w-3xl tw-mx-auto tw-px-4 md:tw-px-0 xl:tw-max-w-5xl xl:tw-px-0">
                <div class="tw-pt-6 tw-flex tw-col-span-3 tw-col-start-2 tw-flex-wrap">
                    <p>Want to apply what you learned?</p>
                    <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="tw-pt-4 md:tw-pt-0 md:tw-pl-4 tw-h-auto tw-w-auto tw-font-medium tw-text-primaryBlue-500 hover:tw-text-primaryBlue-600">
                      Check out our products →
                    </a>
                </div>
            </section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
?>
<style>
    .th-content p a {
        display: inline;
        font-weight: bold;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .th-content p {
        margin-bottom: 2rem;
        max-width: unset;
        width: 100%;
    }

    main {
        overflow:unset;
    }

    .tw-sticky {
        top:125px;
    }
</style>
