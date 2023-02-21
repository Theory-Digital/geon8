<?php
/* Template Name: Geon Cement
*/
get_header();
$fields = get_fields();
?>

<?php
  foreach($fields as $key=>$field) {
    //key == name
    $componentType = get_field_object($key)['component_type'];
  ?>
    <?php if($componentType == 'hero') { ?>
      <?php $hero = get_field($key); ?>
      <section class="tw-mx-auto">
      <?php includeWithVariables((get_template_directory() . '/components/home-hero-2.php'),
        array(
          'heading' => $hero['heading'],
          'content' => $hero['content'],
          'image' => esc_url($hero['image']),
          'byline' => $hero['byline'],
          'buttonUrl' => $hero['Link']['url'],
          'buttonText' => $hero['Link']['title'],
          'buttonUrl2' => $hero['link_2']['url'],
          'buttonText2' => $hero['link_2']['title'],
        )
      )?>
    </section>
    <?php } elseif($componentType == 'tabs') { ?>
      <section class="tw-mt-24">
        <?php
          $tabs = get_field($key);
        ?>   
        <?php includeWithVariables((get_template_directory() . '/components/tabs.php'),
            array(
              'heading' => $tabs['heading'],
              'tabs' => $tabs['tab'],
            )
          )?>
      </section>
    <?php } elseif($componentType == 'banner') { ?>
      <section class="tw-mt-24">
        <?php
          $banner = get_field($key);
        ?>   
        <?php includeWithVariables((get_template_directory() . '/components/banner.php'),
            array(
              'heading' => $banner['heading'],
              'content' => $banner['content'],
              'links' => $banner['links'],
              'image' => $banner['image'],
            )
          )?>
      </section>
    <?php } elseif($componentType == 'slider') { ?>
      <section class="tw-mt-20 tw-overflow-hidden">
        <?php
          $slider = get_field($key);
        ?>   
        <?php includeWithVariables((get_template_directory() . '/components/slider.php'),
            array(
              'heading' => $slider['heading'],
              'content' => $slider['content'],
              'slides' => $slider['images'],
              'id' => get_field_object($key)['ID'],
            )
          )?>
      </section>
    <?php } elseif($componentType == 'footer_form') { ?>
        <?php
          $cta = get_field($key);
          includeWithVariables((get_template_directory() . '/components/footerForm.php'),
            array(
              'heading' => $cta['heading'],
              'content' => $cta['content'],
            )
          )?>
    <?php } elseif($componentType == 'hero_simple') { ?>
    <section class="home-banner tw-mt-10 tw-mx-auto">
        <?php $hero = get_field('hero_simple'); ?>
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
    <?php } elseif($componentType == 'featured_products') { ?>
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
    <?php } elseif($componentType == 'flex_row') { ?>
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
    <?php } elseif($componentType == 'alternating_left') { ?>
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
    <?php } elseif($componentType == 'alternating_right') { ?>
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
    <?php } elseif($componentType == 'footer_cta') { ?>
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
    <?php } ?>
  <?php } //ends foreach?>



<?php get_footer(); ?>