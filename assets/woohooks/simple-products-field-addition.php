<?php
 
class TutsPlus_Custom_WooCommerce_Field {
 
    private $textfield_id;
 
    public function __construct() {
        $this->textfield_id = 'tutsplus_text_field';
    }
 
    public function init() {
 
            add_action(
                'woocommerce_product_options_grouping',
                array( $this, 'product_options_grouping' )
            );
            add_action(
                'woocommerce_process_product_meta',
                array( $this, 'add_custom_linked_field_save' )
            );
    }
 
    public function product_options_grouping() {
 
            $description = sanitize_text_field( 'Enter a description that will be displayed for those who are viewing the product.' );
            $placeholder = sanitize_text_field( 'PDP Teaser.' );
 
            $args = array(
                'id'            => $this->textfield_id,
                'label'         => sanitize_text_field( 'PDP Teaser' ),
                'placeholder'   => 'Tease your product with a short description',
                'desc_tip'      => true,
                'description'   => $description,
            );
            woocommerce_wp_text_input( $args );
    }
}

public function add_custom_linked_field_save( $post_id ) {
 
    if ( ! ( isset( $_POST['woocommerce_meta_nonce'], $_POST[ $this->textfield_id ] ) || wp_verify_nonce( sanitize_key( $_POST['woocommerce_meta_nonce'] ), 'woocommerce_save_data' ) ) ) {
    return false;
}

$product_teaser = sanitize_text_field(
    wp_unslash( $_POST[ $this->textfield_id ] )
);

update_post_meta(
    $post_id,
    $this->textfield_id,
    esc_attr( $product_teaser )
);
}