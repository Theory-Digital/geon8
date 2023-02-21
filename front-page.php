<?php
/**
 * The template for frontpage
 *
 * @package geontile
 */

get_header();
$fields = get_fields();
?>
<main class="">
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
		      'overlayColor' => $hero['overlay_color'],
		      'bylineColor' => $hero['byline_color'],
		      'headingColor' => $hero['heading_color'],
		      'linkColor' => $hero['link_color'],
          'buttonColor' => $hero['button_color'],
          'buttonTextColor' => $hero['button_text_color'],
        )
      )?>
    </section>
    <?php } elseif($componentType == 'tabs') { ?>
      <section class="tw-mt-16">
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
      <section class="tw-mt-16">
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
              'hidden' => $slider['is_hidden'],
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
    <?php }?>
  <?php } //ends foreach?>

</main>
  <?php
    get_footer();
  ?>