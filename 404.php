<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package geontile
 */

get_header();
?>
<div class="tw-min-h-full tw-pt-16 tw-pb-12 tw-flex tw-flex-col tw-bg-white">
  <main  id="primary" class="tw-flex-grow tw-flex tw-flex-col tw-justify-center tw-max-w-7xl tw-w-full tw-mx-auto tw-px-4 sm:tw-px-6 lg:tw-px-8">
    <div class="tw-flex-shrink-0 tw-flex tw-justify-center">
      <a href="/" class="tw-inline-flex">
        <span class="tw-sr-only">Workflow</span>
        <img class="tw-h-48 tw-w-auto" src="<?php echo (get_template_directory_uri() . '/assets/images/404.png'); ?>" alt="">
      </a>
    </div>
    <div class="tw-pb-16">
      <div class="tw-text-center">
        <p class="tw-text-sm tw-font-semibold tw-text-primary-yellow tw-uppercase tw-tracking-wide">404 error</p>
        <h1 class="tw-mt-2 tw-text-4xl tw-font-extrabold tw-text-gray-900 tw-tracking-tight sm:tw-text-5xl">Page not found.</h1>
        <p class="tw-mt-2 tw-text-base tw-text-gray-500">Sorry, we couldn’t find the page you’re looking for.</p>
        <div class="tw-mt-6">
          <a href="/" class="tw-text-base tw-font-medium tw-text-primary-yellow hover:tw-text-primary-yellow-600">Go back home<span aria-hidden="true"> →</span></a>
        </div>
      </div>
    </div>
  </main>
</div>
<?php
get_footer();
