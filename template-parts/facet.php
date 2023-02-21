<?php
//this file is responsible for the shop page and its sorting and general format
// //allow access to the query
// global $wp_query;

// //get all product categories based off menu order
// $taxonomy     = 'product_cat';
// $orderby      = 'menu_order';  
// $show_count   = 0;      // 1 for yes, 0 for no
// $pad_counts   = 0;      // 1 for yes, 0 for no
// $hierarchical = 1;      // 1 for yes, 0 for no  
// $title        = '';  
// $empty        = 0;

// $args = array(
//   'taxonomy'     => $taxonomy,
//   'orderby'      => $orderby,
//   'show_count'   => $show_count,
//   'pad_counts'   => $pad_counts,
//   'hierarchical' => $hierarchical,
//   'title_li'     => $title,
//   'hide_empty'   => $empty
// );

// $getCatName = function($category) {
// return $category->name;
// };

// //sort categories by menu order
// $all_categories = array_map( $getCatName, get_categories( $args ));
// $orderIdKeys  = array_flip($all_categories);
// $orderIdKeys['Noncategorized'] = array_shift($orderIdKeys);
// //$orderIdKeys['Tile'] = array_shift($orderIdKeys);

// //dont include samples
// unset($orderIdKeys['Sample']);

// $counter = 0;
// foreach ($orderIdKeys as $key => $field) {
//   $orderIdKeys[$key] = $counter;
//   $counter++;
// }

// //sort products by category array
// usort($wp_query->posts, function ($a, $b)  use ($orderIdKeys) {
//   $categories_a = get_the_terms( $a->ID, 'product_cat' );
//   $categories_b = get_the_terms( $b->ID, 'product_cat' );
//   $uncategorized = get_term_by('name', 'Noncategorized');
//   $term_a ='';
//   $term_b ='';

//   //ternary doesnt work consistently -- WHY?? Had to use if elses

//   if(!empty(yoast_get_primary_term_id('product_cat', $a->ID))) {
//     $term_a = yoast_get_primary_term_id('product_cat', $a->ID);
//   } else {
//     $term_a = !empty($categories_a) ? $categories_a[0] : $uncategorized;
//   }
//   if(!empty(yoast_get_primary_term_id('product_cat', $b->ID))) {
//     $term_b = yoast_get_primary_term_id('product_cat', $b->ID);
//   } else {
//     $term_b = !empty($categories_b) ? $categories_b[0] : $uncategorized;
//   }
//   //$term_a = !empty(yoast_get_primary_term_id('product_cat', $a->ID)) ? yoast_get_primary_term_id('product_cat', $a->ID) : !empty($categories_a) ? $categories_a[0] : $uncategorized;
//   //$term_b = !empty(yoast_get_primary_term_id('product_cat', $b->ID)) ? yoast_get_primary_term_id('product_cat', $b->ID) : !empty($categories_b) ? $categories_b[0] : $uncategorized;

//   $postProductTerm_a = get_term( $term_a )->name;
//   $postProductTerm_b = get_term( $term_b )->name;

//   // if(get_the_title($a->ID) == 'Guy la Fleur') {
//   //   var_dump($term_a);
//   // }
//   // compare the keys of the ids in the $order array
//   return $orderIdKeys[$postProductTerm_a] >= $orderIdKeys[$postProductTerm_b] ?  1 : -1;
// });


// //remove samples
// foreach ($wp_query->posts as $key => $productItem) {
//   if ( has_term( array('sample', 'samples', 'Sample', 'Samples'), 'product_cat', $productItem ) ) {
//     unset($wp_query->posts[$key]);
//   }
// }

$queriedObj = get_queried_object();
//if category page, override category images with this one.
$overrideCatID = $queriedObj->term_id;

//tiles may belong to multiple categories -- should only get the primary category which is usually collection
//if primary category is not defined, default to first -- if no category is defined, skip 

//Store last category to detect when there is a category change (assuming products have been sorted)
$lastCat = '';
$counter = 0;
//threshold determines how many products after the initial category change (inclusive) the client wants the category page to appear ie 2 place aftr the first card.
$threshold = 2;
$image = '';
$allPosts = $wp_query->posts;
$categoryCardIndex = null;
$featured = get_field('general', 'option'); 
$prod = wc_get_product($featured['product']);

while ( have_posts() ): the_post();
  global $product;

  $terms = get_the_terms( $product->get_id(), 'product_cat' );
  $collection_desc = '';
  $primary = '';
  $primary_cat_ID = '';
  $primary_term = '';

  //if category page, override
  if(!empty($overrideCatID)) {
    $primary_cat_ID = $overrideCatID;
    $primary_term = get_term( $overrideCatID );
  } else {
    $primary_cat_ID = yoast_get_primary_term_id('product_cat', $product->ID);
    $primary_term = get_term( $primary_cat_ID );
  }
  
  if (!empty($terms)):
    //global $post;
    //get_term( $term_a )->name;
    if(!is_wp_error($primary_term)) {
      $primary = $primary_term->name;
    } else {
      //$primary =  getFirstCategory($product);
        $primary = $terms[0]->name;
        $primary_cat_ID = $terms[0]->term_id;
        $primary_term = get_term( $primary_cat_ID );
    }

    //prepare category picture whenever there is a new category
    $isNewCategory = $lastCat != $primary;
    if($isNewCategory) {
      $thumbnail_id = get_term_meta( $primary_cat_ID, 'thumbnail_id', true ); 
      $image = wp_get_attachment_url( $thumbnail_id );
      //determine where the category card index should be
      for($i = $counter; $i < $counter+$threshold; $i++) {
        $terms_pseudo = get_the_terms( $allPosts[$i]->ID, 'product_cat' );
        $primary_cat_ID_prod = !empty(yoast_get_primary_term_id('product_cat', $allPosts[$i]->ID)) ? yoast_get_primary_term_id('product_cat', $allPosts[$i]->ID) : $terms_pseudo[0]->term_id;
        if(!empty($overrideCatID)) {
          $primary_cat_ID_prod = $overrideCatID;
        }
        if($primary_cat_ID_prod == $primary_cat_ID) {
          $categoryCardIndex = $i;
        }
      }
    }
  ?>
  <?php if($counter % 15 == 0 && $counter > 0):  ?>
  <div class="tw-col-span-2 tw-mb-8 tw--mt-8 md:tw-hidden">
    <?php
      includeWithVariables((get_template_directory() . '/components/featured-item.php'),
        array(
          'heading' => $featured['heading'],
          'content' => $featured['content'],
          'image' => esc_url($featured['image']),
          'product' => $prod,
        )
      )?>
  </div>
  <?php endif; ?>
  <div <?php if($isNewCategory): ?>style="grid-column-start: 1;"<?php endif;?> class="">
    <div <?php wc_product_class( '', $product ); ?>>
      <div class="tw-flex th-prod-itm tw-flex-wrap tw-pb-12">
        <div class="tw-w-full tw-pl-4">
          <strong class="tw-text-xl md:tw-text-2xl tw-text-bold">
            <?php echo $product->get_title(); ?>
          </strong>
          <div>
            <?php echo get_field('product_excerpt', $product->get_id()); ?>
          </div>
        </div>
        <div class="tw-max-w-full tw-flex tw-w-full">
          <div class="tw-w-full tw-p-4 md:tw-p-0">
            <div class="tw-shadow-xl md:tw-shadow-none tw-w-full tw-inline-flex tw-flex-col auto-cols-fr tw-border-solid tw-border tw-border-white hover:tw-shadow-xl th-group-img-scale hover:tw-border-solid hover:tw-border hover:tw-border-gray-100 tw-transition-all tw-duration-100 tw-overflow-hidden tw-bg-white">
              <?php wc_get_template_part( 'content', 'product' ); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if ($categoryCardIndex == $counter) : ?>
    <div class="tw-hidden md:tw-flex tw-group tw-overflow-hidden tw-relative tw-m-4">
      <div aria-hidden="true" class="tw-bg-gradient-to-b tw-from-transparent tw-to-black tw-opacity-50 sm:tw-absolute sm:tw-inset-0"></div>
        <img class="tw-h-full tw-object-cover" src="
          <?php
            if(!empty($image)) {
              echo $image;
            } else {
              echo get_template_directory_uri().'/assets/images/image-place-holder.jpg';
            }
          ?>
        "/>
      <div class="tw-absolute tw-text-white tw-text-lg tw-font-bold tw-bottom-4 tw-left-0 tw-px-4">
        <div>
          <?php 
            echo $primary_term->name;
          ?>
        </div>
        <div class="tw-text-sm tw-font-thin">
          <?php 
            echo $primary_term->description;
          ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <?php
    $lastCat =  $primary;
  endif;
  $counter = $counter + 1;
endwhile; ?>