<?php
/**
 * geontile functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package geontile
 */

//Includes
//-- facetcolor overwrite
require_once( get_template_directory() . '/components/functions/sidebar-colors.php');
require_once( get_template_directory() . '/assets/woohooks/variant-js.php');
require_once( get_template_directory() . '/assets/functions/pdp.php');
require_once( get_template_directory() . '/assets/functions/global.php');
require_once( get_template_directory() . '/assets/functions/grout.php');
require_once( get_template_directory() . '/assets/functions/accounts.php');

if ( ! defined( 'GEONTILE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'GEONTILE_VERSION', '1.0.4' );
}

if ( ! function_exists( 'geontile_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function geontile_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on geontile, use a find and replace
		 * to change 'geontile' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'geontile', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'geontile' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'geontile_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Add responsive embeds and block editor styles.
		 */
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style-editor.css' );
	}
endif;
add_action( 'after_setup_theme', 'geontile_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function geontile_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'geontile_content_width', 640 );
}
add_action( 'after_setup_theme', 'geontile_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function geontile_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'geontile' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'geontile' ),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'geontile_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function geontile_scripts() {
	wp_enqueue_style( 'geontile-style', get_stylesheet_uri(), array(), GEONTILE_VERSION );
  wp_enqueue_style( 'pdp-style', get_template_directory_uri().'/assets/stylesheets/pdp.css',array(), 1.14 );
  wp_enqueue_style( 'global-style', get_template_directory_uri().'/assets/stylesheets/global.css',array(), 1.21 );
	wp_enqueue_style( 'account-style', get_template_directory_uri().'/assets/stylesheets/account.css',array(), 1.0 );
  wp_enqueue_style( 'slider-style', get_template_directory_uri().'/assets/stylesheets/flickity.min.css',array(), 1.0 );
  wp_enqueue_script( 'slider-script', get_template_directory_uri().'/assets/scripts/flickity.min.js', array(), 1.0 );

  wp_enqueue_script( 'global-script', get_template_directory_uri().'/assets/scripts/global.js', array(), 1.2 );

  if(is_page_template('geonCement.php')) {
    wp_enqueue_style( 'cement-style', get_template_directory_uri().'/assets/stylesheets/cement.css',array(), 1.0 );
  }

  if (!is_checkout()) {
    wp_enqueue_script( 'mini-cart-script', get_template_directory_uri().'/assets/scripts/mini-cart.js', array(), 1.1 );
  }
  if ( is_product() ){
    wp_enqueue_style( 'magnifier-style', get_template_directory_uri().'/assets/stylesheets/magnifier.css',array(), 1.0 );
    wp_enqueue_style( 'lightbox-style', get_template_directory_uri().'/lightgallery/dist/css/lightgallery.css',array(), 1.0 );
    wp_enqueue_script( 'lightbox-script', get_template_directory_uri().'/lightgallery/dist/js/lightgallery.min.js', array(), 1.0 );
    wp_enqueue_script( 'pdp-script', get_template_directory_uri().'/assets/scripts/pdp.js', array(), 1.78 );
    wp_enqueue_script( 'magnifier-script', get_template_directory_uri().'/assets/scripts/magnifier.js', array(), 1.0 );
    wp_enqueue_script( 'event-script', get_template_directory_uri().'/assets/scripts/event.js', array(), 1.0 );
  }
  if( is_shop() || is_product_category() ) {
    wp_enqueue_script( 'shop-script', get_template_directory_uri().'/assets/scripts/shop.js', array(), 1.2 );
    wp_enqueue_style( 'shop-style', get_template_directory_uri().'/assets/stylesheets/shop.css',array(), 1.1 );
  }
  if(is_front_page()){
    wp_enqueue_style( 'front-style', get_template_directory_uri().'/assets/stylesheets/frontpage.css',array(), 1.0 );
  }
  if ( basename(get_page_template()) == 'faqQuestions.php' ) {
    wp_enqueue_script( 'faq', get_template_directory_uri().'/assets/scripts/faq.js', array(), 1.1 );
    //wp_enqueue_script( 'test-script', get_template_directory_uri().'/assets/scripts/shop.js', array(), 1.0 );
  }
  add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
}
add_action( 'wp_enqueue_scripts', 'geontile_scripts' );

/** 
 * Remove woo styles
*/
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );

  function jk_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
    unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
    unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
    return $enqueue_styles;
  }

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// Enable override of woo
add_theme_support('woocommerce');

//enable global options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();	
}

//custom multiselect field
// New Multi Checkbox field for woocommerce backend
function woocommerce_wp_multi_checkbox( $field, $variation ) {
  $field['value'] = get_post_meta( $variation->ID, $field['id'], true );

  //$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
  $field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
  $field['style']         = isset( $field['style'] ) ? $field['style'] : '';
  $field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
  $field['value']         = isset( $field['value'] ) ? $field['value'] : array();
  $field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
  $field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;

  echo '<fieldset class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '">
  <legend>' . wp_kses_post( $field['label'] ) . '</legend>';

  if ( ! empty( $field['description'] ) && false !== $field['desc_tip'] ) {
      echo wc_help_tip( $field['description'] );
  }

  echo '<ul class="wc-radios">';

  foreach ( $field['options'] as $key => $value ) {

      echo '<li><label><input
              name="' . esc_attr( $field['name'] ) . '"
              value="' . esc_attr( $key ) . '"
              type="checkbox"
              class="' . esc_attr( $field['class'] ) . '"
              style="' . esc_attr( $field['style'] ) . '"
              ' . ( is_array( $field['value'] ) && in_array( $key, $field['value'] ) ? 'checked="checked"' : '' ) . ' /> ' . esc_html( $value ) . '</label>
      </li>';
  }
  echo '</ul>';

  if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
      echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
  }

  echo '</fieldset>';
}

// Add Deserialization Functionality to Facet

add_filter( 'facetwp_index_row', 'fwp_index_serialized_field', 10, 2 );
function fwp_index_serialized_field( $params, $class ) {
  $val = gettype($params['facet_value']);
  
  if($val == "Array"  || $val == "array") {
      $cf = (array) $params['facet_value']; // already unserialized
      foreach ( $cf as $row ) {
        $params['facet_value'] = $row;
        $params['facet_display_value'] = $row;
        $class->insert( $params );
      }
      
      return false;
  }
  return $params;
}

// 1. Add custom field input @ Product Data > Variations > Single Variation

add_action( 'woocommerce_variation_options_pricing', 'add_custom_settings_fields', 10, 3 );
function add_custom_settings_fields($loop, $variation_data, $variation) {
    $terms = get_terms( array('taxonomy' => 'pa_filter-colours', 'fields' => 'names', 'hide_empty' => false ));
    $options = [];

    foreach ($terms as $value) {
      $options[$value] = __( $value, 'woocommerce' );
    }
    echo '<div class="options_group">'; // Hidding in variable products

    woocommerce_wp_multi_checkbox( array(
        'id'    => '_filter_colours',
        'name'  => '_filter_colours[]',
        'desc_tip'    => true,
        'description' => __( 'Save changes after you update ONE variant. Will not work if you edit this field across multiple variants and then save changes all at once.', 'woocommerce' ),
        'label' => __('Colours', 'woocommerce'),
        'options' => $options
        ), $variation );

    echo '</div>';
}

add_action( 'woocommerce_variation_options_pricing', 'colour_add_custom_field_to_variations', 10, 3 );
function colour_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
  $terms = get_terms( array('taxonomy' => 'pa_filter-colours', 'fields' => 'names', 'hide_empty' => false ));
  $options = [];
  $options[''] = __( 'Select Colours', 'woocommerce' );

  foreach ($terms as $value) {
    $options[$value] = __( $value, 'woocommerce' );
  }

  woocommerce_wp_select( array(
    'id'          => 'filter_colours[' . $loop . ']',
    'label'       => __( 'Filter Colours', 'woocommerce' ),
    'description' => __( 'Select Filter Colours', 'woocommerce' ),
    'desc_tip'    => true,
    'value'       => get_post_meta( $variation->ID, 'filter_colours', true ),
    'options'     => $options
  ));
}

add_action( 'woocommerce_variation_options_pricing', 'bbloomer_add_custom_field_to_variations', 10, 3 );
function bbloomer_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
    'id' => 'variation_title[' . $loop . ']',
    'class' => 'short',
    'label' => __( 'Variation Title', 'woocommerce' ),
    'value' => get_post_meta( $variation->ID, 'variation_title', true )
   ) );
}

add_action( 'woocommerce_variation_options_pricing', 'byline_add_custom_field_to_variations', 10, 3 );
function byline_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
    'id' => 'variation_byline[' . $loop . ']',
    'class' => 'short',
    'label' => __( 'Variation Byline', 'woocommerce' ),
    'value' => get_post_meta( $variation->ID, 'variation_byline', true )
   ) );
}

add_action( 'woocommerce_variation_options_pricing', 'squareFootagePerBox_add_custom_field_to_variations', 10, 3 );
function squareFootagePerBox_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
    'id' => 'square_footage[' . $loop . ']',
    'class' => 'short',
    'label' => __( 'Square Footage Per Box', 'woocommerce' ),
    'value' => get_post_meta( $variation->ID, 'square_footage', true )
   ) );
}

add_action( 'woocommerce_variation_options_pricing', 'groutPerBox_add_custom_field_to_variations', 10, 3 );
function groutPerBox_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
    'id' => 'grout_qty[' . $loop . ']',
    'class' => 'short',
    'label' => __( 'Grout Per Box', 'woocommerce' ),
    'value' => get_post_meta( $variation->ID, 'grout_qty', true )
   ) );
}

add_action( 'woocommerce_variation_options_pricing', 'grout_add_custom_field_to_variations', 10, 3 );
function grout_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
  $grout = getGroutProduct();
  $handle=new WC_Product_Variable($grout->ID);
  $variations1=$handle->get_children();
  $options = [];
  $options[''] = __( 'Select Grout', 'woocommerce' );

  foreach ($variations1 as $value) {
    $single_variation=new WC_Product_Variation($value);
    $vName = $single_variation->get_variation_attributes()['attribute_grout-color'];
    $options[$value] = __( $vName, 'woocommerce' );
  }
  
  woocommerce_wp_select( array(
    'id'          => 'grout[' . $loop . ']',
    'label'       => __( 'Grout', 'woocommerce' ),
    'description' => __( 'Select Grout', 'woocommerce' ),
    'desc_tip'    => true,
    'value'       => get_post_meta( $variation->ID, 'grout', true ),
    'options'     => $options
  ));
}

add_action( 'woocommerce_variation_options_pricing', 'badge_add_custom_field_to_variations', 10, 3 );
function badge_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
    'id' => 'badge[' . $loop . ']',
    'class' => 'short',
    'label' => __( 'Badge', 'woocommerce' ),
    'value' => get_post_meta( $variation->ID, 'badge', true )
   ) );
}

// -----------------------------------------
// 2. Save custom field on product variation save

// Save custom multi-checkbox fields to database when submitted in Backend (for all other product types)
add_action( 'woocommerce_save_product_variation', 'save_product_options_custom_fields', 10, 2 );
function save_product_options_custom_fields( $variation_id, $i ){
    if( isset( $_POST['_filter_colours'] ) ){
        $post_data = $_POST['_filter_colours'];
        // Data sanitization
        $sanitize_data = array();
        if( is_array($post_data) && sizeof($post_data) > 0 ){
            foreach( $post_data as $value ){
                $sanitize_data[] = esc_attr( $value );
            }   
        }
        update_post_meta($variation_id, '_filter_colours', $sanitize_data );
    } else {
      delete_post_meta($variation_id, '_filter_colours');
    }
}

add_action( 'woocommerce_save_product_variation', 'filter_colours_save_custom_field_variations', 10, 2 );
function filter_colours_save_custom_field_variations( $variation_id, $i ) {
   $colours = $_POST['filter_colours'][$i];
   if ( isset( $colours ) ) update_post_meta( $variation_id, 'filter_colours', esc_attr( $colours ) );
}
 
add_action( 'woocommerce_save_product_variation', 'groutPerBox_save_custom_field_variations', 10, 2 );
function groutPerBox_save_custom_field_variations( $variation_id, $i ) {
   $grout_qty = $_POST['grout_qty'][$i];
   if ( isset( $grout_qty ) ) update_post_meta( $variation_id, 'grout_qty', esc_attr( $grout_qty ) );
}

add_action( 'woocommerce_save_product_variation', 'byline_save_custom_field_variations', 10, 2 );
function byline_save_custom_field_variations( $variation_id, $i ) {
   $byline = $_POST['variation_byline'][$i];
   if ( isset( $byline ) ) update_post_meta( $variation_id, 'variation_byline', esc_attr( $byline ) );
}

add_action( 'woocommerce_save_product_variation', 'squareFootagePerBox_save_custom_field_variations', 10, 2 );
function squareFootagePerBox_save_custom_field_variations( $variation_id, $i ) {
   $square_footage = $_POST['square_footage'][$i];
   if ( isset( $square_footage ) ) update_post_meta( $variation_id, 'square_footage', esc_attr( $square_footage ) );
}

add_action( 'woocommerce_save_product_variation', 'bbloomer_save_custom_field_variations', 10, 2 );
function bbloomer_save_custom_field_variations( $variation_id, $i ) {
   $variation_title = $_POST['variation_title'][$i];
   if ( isset( $variation_title ) ) update_post_meta( $variation_id, 'variation_title', esc_attr( $variation_title ) );
}

add_action( 'woocommerce_save_product_variation', 'grout_save_custom_field_variations', 10, 2 );
function grout_save_custom_field_variations( $variation_id, $i ) {
   $grout = $_POST['grout'][$i];
   if ( isset( $grout ) ) update_post_meta( $variation_id, 'grout', esc_attr( $grout ) );
}

add_action( 'woocommerce_save_product_variation', 'badge_save_custom_field_variations', 10, 2 );
function badge_save_custom_field_variations( $variation_id, $i ) {
   $badge = $_POST['badge'][$i];
   if ( isset( $badge ) ) update_post_meta( $variation_id, 'badge', esc_attr( $badge ) );
}

// -----------------------------------------
// 3. Store custom field value into variation data
 
add_filter( 'woocommerce_available_variation', 'groutPerBox_add_custom_field_variation_data' );
function groutPerBox_add_custom_field_variation_data( $variations ) {
   $variations['grout_qty'] = get_post_meta( $variations[ 'variation_id' ], 'grout_qty', true );
   return $variations;
}

add_filter( 'woocommerce_available_variation', 'byline_add_custom_field_variation_data' );
function byline_add_custom_field_variation_data( $variations ) {
   $variations['variation_byline'] = get_post_meta( $variations[ 'variation_id' ], 'variation_byline', true );
   return $variations;
}

add_filter( 'woocommerce_available_variation', 'squareFootagePerBox_add_custom_field_variation_data' );
function squareFootagePerBox_add_custom_field_variation_data( $variations ) {
   $variations['square_footage'] = get_post_meta( $variations[ 'variation_id' ], 'square_footage', true );
   return $variations;
}

add_filter( 'woocommerce_available_variation', 'bbloomer_add_custom_field_variation_data' );
function bbloomer_add_custom_field_variation_data( $variations ) {
   $variations['variation_title'] = get_post_meta( $variations[ 'variation_id' ], 'variation_title', true );
   return $variations;
}

add_filter( 'woocommerce_available_variation', 'grout_add_custom_field_variation_data' );
function grout_add_custom_field_variation_data( $variations ) {
   $variations['grout'] = get_post_meta( $variations[ 'variation_id' ], 'grout', true );
   return $variations;
}

add_filter( 'woocommerce_available_variation', 'variation_filter_add_custom_field_variation_data' );
function variation_filter_add_custom_field_variation_data( $variations ) {
   $variations['filter_colours'] = get_post_meta( $variations[ 'variation_id' ], 'filter_colours', true );
   return $variations;
}

add_filter( 'woocommerce_available_variation', 'badge_add_custom_field_variation_data' );
function badge_add_custom_field_variation_data( $variations ) {
   $variations['badge'] = get_post_meta( $variations[ 'variation_id' ], 'badge', true );
   return $variations;
}

//-----------------------END variation edits

// AJAX
add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart'); 
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');          
function ql_woocommerce_ajax_add_to_cart() {  
    $product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id); 
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) { 
        do_action('ql_woocommerce_ajax_added_to_cart', $product_id);
            if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) { 
                wc_add_to_cart_message(array($product_id => $quantity), true); 
            } 
            WC_AJAX :: get_refreshed_fragments(); 
            } else { 
                $data = array( 
                    'error' => true,
                    'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
                echo wp_send_json($data);
            }
            wp_die();
        }

//enable scripts to be a module
function add_type_attribute($tag, $handle, $src) {
  // if not your script, do nothing and return original $tag
  if ( 'pdp-script' == $handle || 'global-script' == $handle || 'mini-cart-script' == $handle || 'shop-script' == $handle) {
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
  }
  return $tag;
}


//filter
add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments){
    ob_start();
    ?>
    <div id="mini-cart-count">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </div>
    <?php
        $fragments['#mini-cart-count'] = ob_get_clean();
    return $fragments;
}
//remove
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);


//remove cart button from minicart
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );

//remove bread crumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

function get_nav_menu_items_by_location( $location, $args = [] ) {

  // Get all locations
  $locations = get_nav_menu_locations();

  // Get object id by location
  $object = wp_get_nav_menu_object( $locations[$location] );

  // Get menu items by menu name
  $menu_items = wp_get_nav_menu_items( $object->name, $args );

  // Return menu post objects
  return $menu_items;
}

//remove sort by option
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

//remove result count
add_action( 'after_setup_theme', 'my_remove_product_result_count', 99 );
function my_remove_product_result_count() { 
    remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );
}

/**
* Change number of products that are displayed per page (shop page)
*/

function my_wp_nav_menu_objects_filter($sorted_menu_items) {
  foreach($sorted_menu_items as &$item) {
      $item->_children_count = 0;
      for($i=1, $l=count($sorted_menu_items); $i<=$l; ++$i) {
          if($sorted_menu_items[$i]->menu_item_parent == $item->ID) {
              $item->_children_count++;
          }
      }        
  }
  foreach($sorted_menu_items as &$item) {
      $item->_parent_children_count = 0;
      for($i=1, $l=count($sorted_menu_items); $i<=$l; ++$i) {
          if($item->menu_item_parent == $sorted_menu_items[$i]->ID) {
              $item->_parent_children_count = $sorted_menu_items[$i]->_children_count;
              break;                    
          }
      }
  }
  unset($item);
  return $sorted_menu_items;    
}
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects_filter' );

//add redirect from cart to shop
add_action("template_redirect", 'redirection_function');
function redirection_function(){
    global $woocommerce;
    if( is_cart() ){
        wp_safe_redirect( get_permalink( woocommerce_get_page_id( 'shop' ) ) );
    }
}

//custom size of image for minicart
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'cart-thumb', '100', '100', true );
}

//filter for nested nav -- not complete
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = -1;
  return $cols;
}

add_filter( 'private_title_format', 'bl_remove_private_title' );
function bl_remove_private_title( $title ) {
    // Return only the title portion as defined by %s, not the additional 
    // 'Private: ' as added in core
    return "%s";
}
// class Excerpt_Walker extends Walker_Nav_Menu
// {
//     function start_el(&$output, $item, $depth, $args)
//     {
//         global $wp_query;

//         if($depth == 0) {
//           if($item->_children_count == 0) {
//             $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

//             $class_names = $value = '';

//             $classes = empty( $item->classes ) ? array() : (array) $item->classes;
//             $classes[] = 'menu-item-' . $item->ID;

//             $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
//             $class_names = ' class="'. esc_attr( $class_names ) . '"';

//             $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
//             $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

//             $output .= $indent . '<li' . $id . $value . $class_names .'>';

//             $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
//             $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
//             $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
//             $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

//             $item_output = $args->before;
//             $item_output .= '<a'. $attributes .'>';

//             $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

//             $item_output .= '</a>';
//             $item_output .= $args->after;

//             $p = apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        
//             $output .= sprintf('<button type="button" class="th-open-menu tw-text-gray-500 tw-group tw-bg-white tw-rounded-md tw-inline-flex tw-items-center tw-text-base tw-font-medium tw-hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false">
//             <span>%1$s</span>
//             </button>', $p);
//             //-----------------------------------------
//           } else {
//             //-----------------------------------------
//               $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

//             $class_names = $value = '';

//             $classes = empty( $item->classes ) ? array() : (array) $item->classes;
//             $classes[] = 'menu-item-' . $item->ID;

//             $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
//             $class_names = ' class="'. esc_attr( $class_names ) . '"';

//             $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
//             $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

//             $output .= $indent . '<li' . $id . $value . $class_names .'>';

//             $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
//             $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
//             $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
//             $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

//             $item_output = $args->before;
//             $item_output .= '<a'. $attributes .'>';

//             $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

//             $item_output .= '</a>';
//             $item_output .= $args->after;

//             $p = apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        
//             $output .= sprintf('
//             <button type="button" class="th-open-menu tw-text-gray-500 tw-group tw-bg-white tw-rounded-md tw-inline-flex tw-items-center tw-text-base tw-font-medium tw-hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false">
//               <span>%1$s</span>
//             </button>
//             <div class="tw-absolute tw-z-10 tw-inset-x-0 tw-transform tw-shadow-lg tw-border-t tw-border-solid tw-max-h-auto tw-max-h-0 tw-overflow-hidden tw-transition-max-height tw-duration-75 th-mega-menu tw-top-20">
//               <div class="tw-absolute tw-inset-0 tw-flex" aria-hidden="true">
//                 <div class="tw-bg-white tw-w-1/2"></div>
//                 <div class="tw-bg-gray-50 tw-w-1/2"></div>
//               </div>
//             delete this div </div>', $p);


//           }
//         //-------------------------  end depth 0
//         } elseif($depth == 1) {
          
//         }
//     }
// }

register_taxonomy('blogs', array('blogs'), array('hierarchical' => true, 'label' => 'Blog Category','show_admin_column' => true, 'singular_label' => 'Blog Category', 'rewrite' => true));

function add_archive_to_blogs( $args, $post_type ) {
  if ( 'blogs' !== $post_type ) {
		return $args;
	}
	
	$blogs_args = array(
		'has_archive' => true,
		'supports'    => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
	);
	// Merge args together.
	return array_merge( $args, $blogs_args );
}
add_filter( 'register_post_type_args', 'add_archive_to_blogs', 10, 2 );

function get_taxonomy_archive_link( $taxonomy ) {
  $tax = get_taxonomy( $taxonomy ) ;
  return get_bloginfo( 'url' ) . '/' . $tax->rewrite['slug'];
}

function wc_diff_rate_for_user($tax_class, $product)
{
  // Getting the current user
  $current_user = wp_get_current_user();
  $current_user_data = get_userdata($current_user->ID);

  if (
    in_array("administrator", $current_user_data->roles) ||
    in_array("retailer", $current_user_data->roles)
  ) {
    $tax_class = "Wholesale rate";
  }

  return $tax_class;
}
add_filter("woocommerce_product_get_tax_class", "wc_diff_rate_for_user", 10, 2);
add_filter(
  "woocommerce_product_variation_get_tax_class",
  "wc_diff_rate_for_user",
  10,
  2
);

//remove the option to have no  default variant selected
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'filter_dropdown_option_html', 12, 2 );
function filter_dropdown_option_html( $html, $args ) {
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
    $show_option_none_html = '<option value="">' . esc_html( $show_option_none_text ) . '</option>';

    $html = str_replace($show_option_none_html, '', $html);

    return $html;
}


//hide in stock message from pdp
function my_wc_hide_in_stock_message( $html, $text, $product ) {
	$availability = $product->get_availability();
	if ( isset( $availability['class'] ) && 'in-stock' === $availability['class'] ) {
		return '';
	}
	return $html;
}
add_filter( 'woocommerce_stock_html', 'my_wc_hide_in_stock_message', 10, 3 );

add_action('acf/render_field_settings', 'my_admin_only_render_field_settings');

function my_admin_only_render_field_settings( $field ) {
	
	acf_render_field_setting( $field, array(
		'label'			=> __('Component Type'),
		'instructions'	=> '',
		'name'			=> 'component_type',
		'type'			=> 'text',
		'ui'			=> 1,
	), true);
	
}


add_action('woocommerce_product_options_general_product_data', function() {
	woocommerce_wp_text_input([
		'id' => '_tease',
		'label' => __('PDP Teaser', 'txtdomain'),
		'wrapper_class' => 'show_if_simple'
	]);
});

add_action('woocommerce_product_options_general_product_data', function() {
	woocommerce_wp_text_input([
		'id' => '_pbadge',
		'label' => __('Badge', 'txtdomain'),
		'wrapper_class' => 'show_if_simple'
	]);
});

add_action('woocommerce_product_options_general_product_data', function() {
	woocommerce_wp_text_input([
		'id' => '_unit',
		'label' => __('Unit of Measure', 'txtdomain'),
	]);
});

add_action('woocommerce_product_options_general_product_data', function() {
	woocommerce_wp_text_input([
		'id' => '_unit_plural',
		'label' => __('Unit of Measure Plural', 'txtdomain'),
	]);
});

add_action('woocommerce_product_options_general_product_data', function() {
	woocommerce_wp_text_input([
		'id' => '_byline',
		'label' => __('Byline', 'txtdomain'),
		'wrapper_class' => 'show_if_simple'
	]);
});

add_action('woocommerce_process_product_meta', function($post_id) {
	$product = wc_get_product($post_id);
	$string_package = isset($_POST['_tease']) ? $_POST['_tease'] : '';
	$product->update_meta_data('_tease', sanitize_text_field($string_package));
	$product->save();
});

add_action('woocommerce_process_product_meta', function($post_id) {
	$product = wc_get_product($post_id);
	$string_package = isset($_POST['_pbadge']) ? $_POST['_pbadge'] : '';
	$product->update_meta_data('_pbadge', sanitize_text_field($string_package));
	$product->save();
});

add_action('woocommerce_process_product_meta', function($post_id) {
	$product = wc_get_product($post_id);
	$string_package = isset($_POST['_unit']) ? $_POST['_unit'] : '';
	$product->update_meta_data('_unit', sanitize_text_field($string_package));
	$product->save();
});

add_action('woocommerce_process_product_meta', function($post_id) {
	$product = wc_get_product($post_id);
	$string_package = isset($_POST['_unit_plural']) ? $_POST['_unit_plural'] : '';
	$product->update_meta_data('_unit_plural', sanitize_text_field($string_package));
	$product->save();
});

add_action('woocommerce_process_product_meta', function($post_id) {
	$product = wc_get_product($post_id);
	$string_package = isset($_POST['_byline']) ? $_POST['_byline'] : '';
	$product->update_meta_data('_byline', sanitize_text_field($string_package));
	$product->save();
});

add_filter("query_vars", function($query_vars) {
  $query_vars[] = "category__not_in";
  return $query_vars;
});


add_filter( 'woocommerce_package_rates' , 'sort_shipping_option_at_checkout', 10, 2 );
   
function sort_shipping_option_at_checkout( $rates, $package ) {
    
    if ( empty( $rates ) ) return;
   
    if ( ! is_array( $rates ) ) return;
    
    uasort( $rates, function ( $a, $b ) { 
        if ( $a == $b ) return 0;
        return ( $a->cost < $b->cost ) ? -1 : 1; 
    } );
    
    return $rates;
   
    // NOTE: BEFORE TESTING EMPTY YOUR CART
       
}
//@@@
add_filter( 'facetwp_query_args', function( $query_args, $class ) {
  
  // Get and sort all products
  $products = get_posts(array(
    'posts_per_page' => -1,
    'post_type'      => array('product'),
    'post_status'    => 'publish',
    'has_password'   => false,
    'category__not_in' => 78,
    'facetwp'        => false,
  ));

  //remove samples
  foreach ($products as $key => $productItem) {
    if ( has_term( array('sample', 'samples', 'Sample', 'Samples'), 'product_cat', $productItem ) ) {
      unset($products[$key]);
    }
  }

  //get all product categories based off menu order
  $taxonomy     = 'product_cat';
  $orderby      = 'menu_order';  
  $show_count   = 0;      // 1 for yes, 0 for no
  $pad_counts   = 0;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no  
  $title        = '';  
  $empty        = 0;

  $args = array(
    'taxonomy'     => $taxonomy,
    'orderby'      => $orderby,
    'show_count'   => $show_count,
    'pad_counts'   => $pad_counts,
    'hierarchical' => $hierarchical,
    'title_li'     => $title,
    'hide_empty'   => $empty
  );

  $getCatName = function($category) {
    return $category->name;
  };

  //sort categories by menu order
  $all_categories = array_map( $getCatName, get_categories( $args ));
  $orderIdKeys  = array_flip($all_categories);
  $orderIdKeys['Noncategorized'] = array_shift($orderIdKeys);
  //$orderIdKeys['Tile'] = array_shift($orderIdKeys);

  //dont include samples
  unset($orderIdKeys['Sample']);

  $counter = 0;
  foreach ($orderIdKeys as $key => $field) {
    $orderIdKeys[$key] = $counter;
    $counter++;
  }

  //sort products by category array
  usort($products, function ($a, $b)  use ($orderIdKeys) {
    $categories_a = get_the_terms( $a->ID, 'product_cat' );
    $categories_b = get_the_terms( $b->ID, 'product_cat' );
    $uncategorized = get_term_by('name', 'Noncategorized');
    $term_a ='';
    $term_b ='';

    //ternary doesnt work consistently -- WHY?? Had to use if elses

    if(!empty(yoast_get_primary_term_id('product_cat', $a->ID))) {
      $term_a = yoast_get_primary_term_id('product_cat', $a->ID);
    } else {
      $term_a = !empty($categories_a) ? $categories_a[0] : $uncategorized;
    }
    if(!empty(yoast_get_primary_term_id('product_cat', $b->ID))) {
      $term_b = yoast_get_primary_term_id('product_cat', $b->ID);
    } else {
      $term_b = !empty($categories_b) ? $categories_b[0] : $uncategorized;
    }
    //$term_a = !empty(yoast_get_primary_term_id('product_cat', $a->ID)) ? yoast_get_primary_term_id('product_cat', $a->ID) : !empty($categories_a) ? $categories_a[0] : $uncategorized;
    //$term_b = !empty(yoast_get_primary_term_id('product_cat', $b->ID)) ? yoast_get_primary_term_id('product_cat', $b->ID) : !empty($categories_b) ? $categories_b[0] : $uncategorized;

    $postProductTerm_a = get_term( $term_a )->name;
    $postProductTerm_b = get_term( $term_b )->name;

    // if(get_the_title($a->ID) == 'Guy la Fleur') {
    //   var_dump($term_a);
    // }
    // compare the keys of the ids in the $order array
    return $orderIdKeys[$postProductTerm_a] >= $orderIdKeys[$postProductTerm_b] ?  1 : -1;
  });

  foreach ($products as $asset) {
    $posts_id[] = $asset->ID;
  }

  $query_args['category__not_in'] = 78;
  $query_args['post__in'] = $posts_id;
  $query_args['orderby'] = 'post__in';
  //$query_args['posts_per_page'] = 11;
  //$query_args['paged'] = ( get_query_var('paged') ? get_query_var('paged') : 1 );
  return $query_args;
}, 10, 2 );