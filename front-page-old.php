<?php
/**
 * The template for frontpage
 *
 * @package geontile
 */

get_header();
?>

  <?php $hero = get_field('hero'); ?>
  <section class="home-banner tw-mt-10 tw-mx-auto">
    <?php includeWithVariables((get_template_directory() . '/components/home-hero.php'),
      array(
        'title' => $hero['heading'],
        'content' => $hero['content'],
        'image' => esc_url($hero['image']),
        'byline' => $hero['byline'],
        'buttonUrl' => $hero['Link']['url'],
        'buttonText' => $hero['Link']['title'],
      )
    )?>
  </section>
  <section>
    <?php
      $fp = get_field('featured_products');
      $products = getProdsByID($fp);
    ?>   
    <?php includeWithVariables((get_template_directory() . '/components/three-col-product-display.php'),
        array(
          'products' => $products,
        )
      )?>
  </section>
  <section class="tw-mt-24">
    <?php $flexRow = get_field('flex_row'); ?>
    <?php includeWithVariables((get_template_directory() . '/components/icon-row.php'),
        array(
          'title' => $flexRow['heading'],
          'content1' => $flexRow['content1'],
          'content2' => $flexRow['content2'],
          'content3' => $flexRow['content3'],
          'content4' => $flexRow['content4'],
          'content5' => $flexRow['content5'],
          'buttonUrl' => $flexRow['link']['url'],
          'buttonText' => $flexRow['link']['title'],
        )
      )?>
  </section>
  <section class="tw-mx-auto geon-guides-section tw-mt-24">
      <div class="red-circle-bg"></div>
      <?php
        $al = get_field('alternating_left');
      ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-left.php'),
        array(
          'title' => $al['heading'],
          'content' => $al['content'],
          'image' => esc_url($al['image']),
          'buttonUrl' => $al['link']['url'],
          'buttonText' => $al['link']['title'],
        )
      )?>
  </section>
  <section class="tw-mx-auto designed-in-canada tw-mt-16 md:tw-mt-12">
      <div class="blue-square-bg"></div>
      <?php
        $ar = get_field('alternating_right');
      ?>
      <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-right.php'),
        array(
          'title' => $ar['heading'],
          'content' => $ar['content'],
          'image' => esc_url($ar['image']),
          'buttonUrl' => $ar['link']['url'],
          'buttonText' => $ar['link']['title'],
        )
      )?>
  </section>
  <section class="tw-mt-12">
    <?php
      $fcta = get_field('footer_cta');
    ?>
    <?php includeWithVariables((get_template_directory() . '/components/home-side-by-side.php'),
      array(
        'title' => $fcta['heading_left'],
        'image' => $fcta['image_left'],
        'buttonUrl' => $fcta['link_left']['url'],
        'buttonText' => $fcta['link_left']['title'],
        'title_2' => $fcta['heading_right'],
        'image_2' => $fcta['image_right'],
        'buttonUrl_2' => $fcta['link_right']['url'],
        'buttonText_2' => $fcta['link_right']['title'],
      )
    )?>
  </section>
  <?php
    get_footer();
  ?>