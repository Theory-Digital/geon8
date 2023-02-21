elseif($componentType == 'featured_products') { ?>
    <section>
      <?php
        $fp = get_field($key);
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
      <?php $flexRow = get_field($key); ?>
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
  <?php } elseif($componentType == 'alternating-left') { ?>
    <section class="tw-mx-auto geon-guides-section tw-mt-24">
      <div class="red-circle-bg"></div>
      <?php
        $al = get_field($key);
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
  <?php } elseif($componentType == 'alternating-right') { ?>
    <section class="tw-mx-auto designed-in-canada tw-mt-16 md:tw-mt-12">
      <div class="blue-square-bg"></div>
      <?php
        $ar = get_field($key);
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
          $fcta = get_field($key);
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