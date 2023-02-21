<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout tw-flex" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
		
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php //do_action( 'woocommerce_checkout_order_review' ); ?>
    <div class="cart" style="height:100%;">
        <h2>Your Cart</h2>
        <ul id="cartContents">
            <?php
            $userCartItems = WC()->cart->get_cart();
            if(!empty($userCartItems)):
                foreach($userCartItems as $cartItemKey=>$cartItem):
                    $product = apply_filters( 'woocommerce_cart_item_product', $cartItem['data'], $cartItem, $cartItemKey );
                    $productName = apply_filters( 'woocommerce_cart_item_name', $product->get_name(), $cartItem, $cartItemKey );
                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image(), $cartItem, $cartItemKey );
                    $quantity = $cartItem['quantity'];
                    $price = esc_attr($cartItem['quantity'])*esc_attr($cartItem['data']->get_price());
                    $hyphenIndex = strpos($productName,'-');
                    if($hyphenIndex){
                        $productVariant = substr($productName,$hyphenIndex+1);
                        $productName = substr($productName,0,$hyphenIndex);
                    }
                    ?>
                    <li>
                        <div>
                            <a href="<?php echo $product->get_permalink();?>">
                                <?php echo $thumbnail?>
                            </a>
                        </div>
                        <div>
                            <span><?php echo $productName;?></span>
                            <?php if(isset($productVariant)):?>
                                <span><?php echo trim($productVariant);?></span>
                            <?php endif;?>
                            <span>Qty <?php echo $cart_item["quantity"]; ?></span>
                            <span><?php echo '<span class="woocommerce-Price-amount amount">'.$price.'</span>'?></span>
                            
                            <?php unset($productVariant);?>
                            <p>
                                <button class="removeItem" isCheckout="1" key="<?php echo esc_attr($cartItem['key']);?>">Remove Item</button>
                            </p>
                        </div>
                    </li>
                <?php
                endforeach;
            endif;
            ?>
        </ul>
        <!-- insert there -->
    </div>
    
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
