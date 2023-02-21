<?php
/**
 * Template Name: General Template
 *
 * @package geontile
 */

get_header();

$id = get_the_ID();
global $wpdb;

$fields = get_fields();
$acf_fields = get_field_objects();

usort($acf_fields, function($a, $b) {
    return $a['menu_order'] - $b['menu_order'];
});
?>
<main class="">
<?php
  foreach ($acf_fields as $field_name => $field) {
    //label == $field['label'];
    $componentType = $field['component_type'];
    $value = $field['value'];
  ?>
    <?php if($componentType == 'hero') { ?>
        <section class="tw-mx-auto">
            <?php includeWithVariables((get_template_directory() . '/components/home-hero-2.php'),
                array(
                'heading' => $value['heading'],
                'content' => $value['content'],
                'image' => esc_url($value['image']),
                'byline' => $value['byline'],
                'buttonUrl' => $value['Link']['url'],
                'buttonText' => $value['Link']['title'],
                'buttonUrl2' => $value['link_2']['url'],
                'buttonText2' => $value['link_2']['title'],
                    'overlayColor' => $value['overlay_color'],
                    'bylineColor' => $value['byline_color'],
                    'headingColor' => $value['heading_color'],
                    'linkColor' => $value['link_color'],
                )
            )?>
        </section>
    <?php } elseif($componentType == 'hero_w_image_left') { ?>
      <section class="tw-mt-16">
            <?php includeWithVariables((get_template_directory() . '/components/left-image-hero.php'),
                array(
                'title' => $value['heading'],
                'byline' => $value['byline'],
                'content' => $value['content'],
                'image' => $value['image'],
                )
            )?>
      </section>
    <?php } elseif($componentType == 'tabs') { ?>
      <section class="tw-mt-16">  
        <?php includeWithVariables((get_template_directory() . '/components/tabs.php'),
            array(
              'heading' => $value['heading'],
              'tabs' => $value['tab'],
            )
          )?>
      </section>
    <?php } elseif($componentType == 'banner') { ?>
      <section class="tw-mt-16">
        <?php includeWithVariables((get_template_directory() . '/components/banner.php'),
            array(
              'heading' => $value['heading'],
              'content' => $value['content'],
              'links' => $value['links'],
              'image' => $value['image'],
            )
          )?>
      </section>
    <?php } elseif($componentType == 'slider') { ?>
      <section class="tw-mt-20 tw-overflow-hidden"> 
        <?php includeWithVariables((get_template_directory() . '/components/slider.php'),
            array(
              'heading' => $value['heading'],
              'content' => $value['content'],
              'slides' => $value['images'],
              'id' => $field['ID'],
            )
          )?>
      </section>
    <?php } elseif($componentType == 'alternating_left') { ?>
        <section class="tw-mx-auto">
            <div class="red-circle-bg"></div>
            <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-left.php'),
                array(
                'title' => $value['heading'],
                'content' => $valueal['content'],
                'image' => esc_url($value['image']),
                'buttonUrl' => $value['link']['url'],
                'buttonText' => $value['link']['title'],
                )
            )?>
        </section>
    <?php } elseif($componentType == 'quote') { ?>
        <?php includeWithVariables((get_template_directory() . '/components/quote.php'),
          array(
            'accreditation' => $value['accreditation'],
            'content' => $value['content'],
          )
        )?>
    <?php } elseif($componentType == 'alternating_right') { ?>
        <?php includeWithVariables((get_template_directory() . '/components/alternating-w-image-right.php'),
            array(
            'title' => $value['heading'],
            'content' => $value['content'],
            'image' => $value['image'],
            )
        )?>
    <?php } elseif($componentType == 'cta') { ?>
        <?php
            includeWithVariables((get_template_directory() . '/components/subscribe-cta.php'),
                array(
                    'title' => $value['heading'],
                    'content' => $value['content'],
                )
            )
        ?>
    <?php } elseif($componentType == 'footer_form') { ?>
        <?php
          includeWithVariables((get_template_directory() . '/components/footerForm.php'),
            array(
              'heading' => $value['heading'],
              'content' => $value['content'],
            )
          )?>
    <?php }?>
  <?php } //ends foreach?>

</main>
  <?php
    get_footer();
  ?>