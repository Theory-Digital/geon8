<?php
  /**
  * Template Name: Commitment Template
  *
  * @package WordPress
  */
  get_header();
?>
	<main id="primary">
    <section class="tw-mt-8">
    <?php $quote = get_field('quote'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/quote.php'),
          array(
            'accreditation' => $quote['accreditation'],
            'content' => $quote['content'],
          )
        )?>
    </section>
    <section class="tw-max-w-7xl tw-mx-auto tw-relative">
      <div class="tw-hidden lg:tw-block quarter-circle-yellow tw-absolute lg:tw-top-full tw-left-full tw-transform tw--translate-x-3/4 tw--translate-y-1/4 lg:tw--translate-y-3/4"></div>
        <?php $alternatingRight = get_field('alternating_right_commit'); ?>
        <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-right.php'),
          array(
            'title' => $alternatingRight['heading'],
            'content' => $alternatingRight['content'],
            'image' => $alternatingRight['image'],
            'additional' => 'Designed in Canada',
          )
        )?>
    </section>
    <section id="social-responsibility" class="tw-mx-auto tw-max-w-7xl tw-relative tw-mt-24">
      <div class="tw-hidden lg:tw-block quarter-circle-blue tw-absolute lg:tw-top-full tw-right-full tw-transform tw-translate-x-1/3 tw--translate-y-1/4 lg:tw-translate-x-1/2 lg:tw--translate-y-3/4"></div>
      <?php $alternatingLeft = get_field('alternating_left_commit'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-left.php'),
        array(
          'title' => $alternatingLeft['heading'],
          'content' => $alternatingLeft['content'],
          'image' => $alternatingLeft['image'],
        )
      )?>
    </section>
    <section id="" class="tw-max-w-7xl tw-mx-auto tw-mt-24">
      <?php $alternatingRight = get_field('alternating_right_commit_2'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-right.php'),
        array(
          'title' => $alternatingRight['heading'],
          'content' => $alternatingRight['content'],
          'image' => $alternatingRight['image'],
        )
      )?>
    </section>
    <section id="environment" class="tw-mx-auto tw-max-w-7xl tw-relative tw-mt-24">
      <?php $alternatingLeft = get_field('alternating_left_commit_2'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-left.php'),
        array(
          'title' => $alternatingLeft['heading'],
          'content' => $alternatingLeft['content'],
          'image' => $alternatingLeft['image'],
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
	</main>

<?php
get_footer();
