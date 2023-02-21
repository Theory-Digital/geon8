<?php
/**
* Template Name: Our Story Template
*
* @package WordPress
*/

get_header();
?>

	<main id="primary">
    <section class="tw-mx-auto geon-guides-section tw-mt-10 md:tw-mt-16 tw-relative">
        <div class="tw-mx-auto tw-relative tw-max-w-7xl">
          <div class="blue-circ-story-bg"></div>
          <?php $hero = get_field('hero'); ?>
          <?php includeWithVariables((get_template_directory() . '/components/left-image-hero.php'),
            array(
              'title' => $hero['heading'],
              'byline' => $hero['byline'],
              'content' => $hero['content'],
              'image' => $hero['image'],
            )
          )?>
        </div>
    </section>
    <section class="tw-mt-8">
      <?php $quote = get_field('quote'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/quote.php'),
          array(
            'accreditation' => $quote['accreditation'],
            'content' => $quote['content'],
          )
        )?>
    </section>
    <section class="tw-mx-auto tw-max-w-7xl">
      <?php $alternatingLeft = get_field('alternating_left'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-left.php'),
        array(
          'title' => $alternatingLeft['heading'],
          'content' => $alternatingLeft['content'],
          'image' => $alternatingLeft['image'],
        )
      )?>
    </section>
    <section class="tw-max-w-7xl tw-mx-auto tw-mt-20">
      <?php $alternatingRight = get_field('alternating_right'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-right.php'),
        array(
          'title' => $alternatingRight['heading'],
          'content' => $alternatingRight['content'],
          'image' => $alternatingRight['image'],
          'additional' => 'Designed in Canada',
        )
      )?>
    </section>
    <section class="tw-mx-auto tw-max-w-7xl tw-mt-20">
      <?php $alternatingLeft2 = get_field('alternating_left2'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-left.php'),
        array(
          'title' => $alternatingLeft2['heading'],
          'content' => $alternatingLeft2['content'],
          'image' => $alternatingLeft2['image'],
        )
      )?>
    </section>
    <section class="tw-mt-20">
      <?php $cta = get_field('cta'); ?>
      <?php includeWithVariables((get_template_directory() . '/components/subscribe-cta.php'),
          array(
            'title' => $cta['heading'],
            'content' => $cta['content'],
          )
        )?>
    </section>
	</main><!-- #main -->

<?php
get_footer();
