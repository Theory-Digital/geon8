<?php
  /**
   * @prod is a WooCommerce Product Object
   * @squareFootageOverride is an INT that determines how many square feet per box this product fills -- right now, just determines of using sq ft or not
   * 
   * returns a string of what unit of measure the product uses
   * 
  */
  function getUnitOfMeasure($prod, $quantity = 1, $classes = null, $squareFootageOverride = null) {
    //check if unit of mesure override is set
    $unit = $prod->get_meta('_unit');
    $unitPlural = $prod->get_meta('_unit_plural');

    if(!empty($unit) && !empty($unitPlural)) {
      if($quantity == 1) {
        return $unit;
      } 
      return $unitPlural;
    } else {
      if(isTile($prod)){
        if(isSample($prod)) {
          if($squareFootageOverride) {
            return 'sq.ft';
          }
          elseif($quantity == 1) {
            return 'Tile';
          } else {
            return 'Tiles';
          }
        } else {
          //if prod is array based
          if($quantity == 1) {
            return 'Box';
          } else {
            return 'Boxes';
          }
        }
      } else {
        if($quantity == 1) {
          return 'Item';
        } else {
          return 'Items';
        }
      }
    }
  }

  //category and subcategory
  function getcatsubs($items,&$arg,$level=0) {
    $taxonomy     = 'product_cat';
    $orderby      = 'menu_order';
    $show_count   = 0;
    $pad_counts   = 0;
    $hierarchical = 1;
    $title        = '';
    $empty        = 0;

    if($items) {
        $category_id = $items->term_id;
        $args = array(
            'taxonomy' => $taxonomy,
            'child_of' => 0,
            'parent' => $category_id,
            'orderby' => $orderby,
            'show_count' => $show_count,
            'pad_counts' => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li' => $title,
            'hide_empty' => $empty
        );
        $sub_cats = get_categories($args);
        if($sub_cats)
        {
            foreach ($sub_cats as $sub)
            {
                $category_id = $sub->term_id;
                $args2 = array(
                    'taxonomy' => $taxonomy,
                    'child_of' => 0,
                    'parent' => $category_id,
                    'orderby' => $orderby,
                    'show_count' => $show_count,
                    'pad_counts' => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li' => $title,
                    'hide_empty' => $empty
                );
                array_push($arg[0],$sub);
                array_push($arg[1],$level);
                getcatsubs($sub,$arg,$level+1);
            }
        }
        else
        {
            return;
        }
    }
    else
    {
        return;
    }
  }

  //get tile collection
  function getFirstCollectionItem($product) {
    $terms_html = array();
    $taxonomy = 'product_cat';
    
    // Get the product category (parent) WP_Term object
    $parent = get_term_by( 'slug', 'collection', $taxonomy );

    // Get an array of the subcategories IDs (children IDs)
    $children_ids = get_term_children( $parent->term_id, $taxonomy );

    $term_ids = array();
    $terms = get_the_terms( $product->ID, "product_cat" );
    if(!is_wp_error( $terms )){
        foreach ( $terms as $term ) {
          $term_ids[] = $term->term_id;
        }
    }

    //loop through collections, and return the collection
    foreach($children_ids as $children_id){
      foreach($term_ids as $pTerm) {
        if($pTerm == $children_id) {
          $term = get_term( $children_id, $taxonomy );    // WP_Term object
          $term_link = get_term_link( $term, $taxonomy ); // The term link
          if ( is_wp_error( $term_link ) ) $term_link = '';
          // Set in an array the html formated subcategory name/link
          $terms_html[] = '<a href="' . esc_url( $term_link ) . '" rel="tag" class="' . $term->slug . '">' . $term->name . '</a>';
          return $term->name;
        }
      }
    }// end outter foreach
    return '';
  }

  //get tile type
  function getFirstProductGroup($product) {
    $taxonomy = 'group';
    if( taxonomy_exists( $taxonomy ) ) {
      $names = wp_get_post_terms( $product->get_id(), $taxonomy, array('fields' => 'names') );
      if ( ! empty($names[0]) ) {
        return $names[0];
      }
    }
    return '';
  }

  //get tile type
  function getFirstProductGroupID($product) {
    $taxonomy = 'group';
    if( taxonomy_exists( $taxonomy ) ) {
      $term_ids = wp_get_post_terms( $product->get_id(), $taxonomy, array('fields' => 'ids') );
      if ( ! empty($term_ids[0]) ) {
        return $term_ids[0];
      }
    }
    return '';
  }

  function getAllProductsGroups($product) {
    $taxonomy = 'group';
    if( taxonomy_exists( $taxonomy ) ) {
      return $term_ids = wp_get_post_terms( $product->get_id(), $taxonomy, array('fields' => 'ids') );
    }
    return '';
  }

  function getAllProductGroups() {
    $taxonomy = 'group';
    if( taxonomy_exists( $taxonomy ) ) {
      $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
      ]);

      return $terms;
    }
    return null;
  }

  //get category
  function getFirstCategory($product) {
    if(!$primary_cat_ID) {
      $taxonomy = 'product_cat';
      if( taxonomy_exists( $taxonomy ) ) {
        $term_ids = wp_get_post_terms( $product->get_id(), $taxonomy, array('fields' => 'ids') );
        if ( ! empty($term_ids[0]) ) {
          return $term_ids[0];
        }
      }
    }
  }

  //Takes in a product or ID and checks if it belongs to the tile category
  //note, tile variations arent technically categorized, so it will return false, even though the parent is product is categorized as tile
  function isTile($paramProduct) {
    $product = $paramProduct;

    $terms = wp_get_post_terms( is_int($product) ? $product : $product->get_id(), 'product_cat' );
    foreach ( $terms as $term ) $categories[] = $term->slug;
    if ( in_array( 'variable-product', $categories ) ) {
      return true;
    } else {
      return false;
    }
  }

  function isSample($product) {
    $terms = wp_get_post_terms( $product->get_id(), 'product_cat' );
    foreach ( $terms as $term ) $categories[] = $term->slug;
    if ( in_array( 'sample', $categories ) ) {
      return true;
    } else {
      return false;
    }
  }

  function isComplexVariableTile($product) {
    if(isTile($product)) {
      $variationsOG = $product->get_available_variations();
      if (count($variationsOG) > 0) {
        $colors = [];
        foreach($variationsOG as $variation) :
          $attributes = $variation['attributes'];
            if(array_key_exists( 'attribute_pa_color', $attributes)){
              if(!in_array($variation['attributes']['attribute_pa_color'], $colors) ) {
                array_push($colors, $variation['attributes']['attribute_pa_color']);
              }
            }
          endforeach;
      }
      if(count($colors) > 1) {
        return true;
      }
    }
    return false;
  }

  function isSimpleVariableTile($product) {
    if(isTile($product)) {
      $variationsOG = $product->get_available_variations();
      if (count($variationsOG) > 0) {
        $colors = [];
        foreach($variationsOG as $variation) :
          $attributes = $variation['attributes'];
            if(array_key_exists( 'attribute_pa_color', $attributes)){
              if(!in_array($variation['attributes']['attribute_pa_color'], $colors) ) {
                array_push($colors, $variation['attributes']['attribute_pa_color']);
              }
            }
          endforeach;
      }
      if(count($colors) == 1) {
        return true;
      }
    }
    return false;
  }

  function getTopSellingProducts($quantity = 3) {
    $products = [];  
    $sampleCategoryID = getSampleCategory();
    $queryResults =  wc_get_products( array(
      'meta_key' => 'total_sales', // our custom query meta_key
      'orderby'  => array( 'meta_value_num' => 'DESC', 'title' => 'ASC' ), // order from highest to lowest of top sellers
      'numberposts' => $quantity,
      'status' => 'publish',
      'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    =>  array( $sampleCategoryID ),
            'operator' => 'NOT IN',
        ),
      ),
    ));

      foreach($queryResults as $product) {
        $obj = [
          'image_url' => wp_get_attachment_image_url( $product->image_id, 'full' ),
          "id" => $product->id,
          "title" => $product->get_title(),
          "url" => $product->get_permalink(),
        ];
        
        array_push($products, $obj);
      }

    return $products; 
  }

  function getProdsByID($productIDs) {
    $products = [];
    foreach($productIDs as $productID) {
      $product = wc_get_product( $productID );
      if(!empty($product)) {
        $obj = [
          'image_url' => wp_get_attachment_image_url( $product->image_id, 'full' ),
          "id" => $product->id,
          "title" => $product->get_title(),
          "url" => $product->get_permalink(),
        ];
        array_push($products, $obj);
      }
    }
    return $products;
  }

  function getFeaturedProducts() {
    $products = [];

    $queryResults = wc_get_products( array(
      'featured' => true,
      'numberposts' => 3,
    ));

    foreach($queryResults as $product) {
      $obj = [
        "id" => $product->id,
        "title" => $product->get_title(),
        "image-url" => $product->get_permalink(),
      ];
      array_push($products, $obj);
    }

    return $products;
  }

  function insertion_Sort($my_array)
  {
    for($i=0;$i<count($my_array);$i++){
      $item = $my_array[$i];
      $val = $item['x']*$item['y'];
      $j = $i-1;
      while($j>=0 && $my_array[$j]['x']*$my_array[$j]['y'] < $val){
        $my_array[$j+1] = $my_array[$j];
        $j--;
      }
      $my_array[$j+1] = $item;
    }
    return $my_array;
  }

  function getSampleCategory() {
    return 78;
  }

  function getDefaultVariant() {
    global $product;
    //override DV if url params have color
    $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    $color = is_product() ? $params['attribute_pa_color'] : '';
    $prod = '';
  
    if( $product->is_type('variable')){
      //var_dump($product->get_available_variations());
      //var_dump(is_a( $product, 'WC_Product_Variable' ));
      //var_dump($product->get_variation_default_attributes());
      $prod_array = $product->get_available_variations();
      foreach($product->get_available_variations() as $pav){
        if(empty($prod)) {
          $prod = $pav;
        }
        //matches dv to special product arrays

        //if color param passed to URL, the loading product is no longer the DV but the what the arguments requests
        if(!empty($color)) {
          if($pav['attributes']['attribute_pa_color'] == $color){
            $prod = $pav;     
          }
        //else match/get the DV
        } else {
          //var_dump($defval);
          foreach($product->get_variation_default_attributes() as $defkey=>$defval){
            
            //this function needs help -- only works for 1 dimensional attributed products
            if($pav['attributes']['attribute_'.$defkey] == $defval){
              //do nothing
              //$prod = $pav;
            } else {
              if (($key = array_search( $pav, $prod_array)) !== false) {
                unset($prod_array[$key]);
              }
            }
          }
          $prod = reset($prod_array);
        }
        if(empty($prod)) {
          //grab first prod if empty
          $prod = reset($product->get_available_variations());
        }
      }
      return $prod;
    } else {
      return '';
    }
  }