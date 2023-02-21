<?php

if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'theory_single', 1000, 1000 ); //300 pixels wide (and unlimited height)
}
//requires variation ARRAY
function getVariantImagesSrc($variation)
{
  $variation_images_src = [];
  $attachment_ids = get_post_meta(
    $variation['variation_id'],
    "_wc_additional_variation_images"
  );
  array_push($variation_images_src, $variation['image']['full_src']);

  foreach (explode(",", $attachment_ids[0]) as $attachment_id) {
    $image = wp_get_attachment_image_src($attachment_id, "large");
    if ($image) {
      array_push($variation_images_src, $image[0]);
    }
  }
  return array_values($variation_images_src);
}


function getVariantImagesSrcs($variation)
{
  $variation_images_src = [];
  $attachment_ids = get_post_meta(
    $variation['variation_id'],
    "_wc_additional_variation_images"
  );
  array_push($variation_images_src, array('medium'=>$variation['image']['src'], 'large'=>$variation['image']['src'], 'full'=>$variation['image']['full_src']));

  foreach (explode(",", $attachment_ids[0]) as $attachment_id) {
    $imageM = wp_get_attachment_image_src($attachment_id, "theory_single");
    $image = wp_get_attachment_image_src($attachment_id, "full");
    $imageFull = wp_get_attachment_image_src($attachment_id, "full_src");
    if(!empty($imageM || !empty($image) || !empty($imageFull))) {
      array_push($variation_images_src, array('medium' => $imageM[0] ,'large' => $image[0], 'full' => $imageFull[0]));
    }
  }
  return array_values($variation_images_src);
}