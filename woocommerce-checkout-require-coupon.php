<?php
/**
 * Plugin name: WooCommerce Checkout Require Coupon
 * Description: Plugin that forces to use a coupon in order to place an order of an specific item.
 * Version: 1.0.0
 * Author: Pablo Fernández López
 * Author URI: https://github.com/Pablofl01/
 **/

$targeted_ids = array(2429); // The targeted product ids (in this array)
$valid_coupons = array('p3r1c0', 'p4r2c1');

add_action( 'woocommerce_check_cart_items', 'mandatory_coupon_for_specific_items', 1 );
function mandatory_coupon_for_specific_items() {
	global $targeted_ids, $valid_coupons;

    $file_contents = file_get_contents('./codes.txt', true);
    //$valid_coupons = explode("\n", $file_contents);
    
    // Loop through cart items
    foreach(WC()->cart->get_cart() as $cart_item ) {
        // Check cart item for defined product Ids and applied coupon
        if( in_array( $cart_item['product_id'], $targeted_ids ) ) {
            $applied_coupons = WC()->cart->get_applied_coupons();
			if (count($applied_coupons) > 0) {
				foreach( $applied_coupons as $applied_coupon ) {
					if( in_array($applied_coupon, $valid_coupons) )  {
						wc_clear_notices();
						wc_add_notice( sprintf( 'El cupón es válido.'), 'info' );
						return;
					}
            	}
			}
			wc_clear_notices(); // Clear all other notices
			// Avoid checkout displaying an error notice
			wc_add_notice( sprintf( 'El producto "%s" requiere un cupón para su compra.', $cart_item['data']->get_name() ), 'error' );
        }
    }
}


add_filter( 'woocommerce_get_shop_coupon_data', 'mp_create_coupon', 10, 2  );
function mp_create_coupon( $data, $code ) {
	global $valid_coupons;
	
	if(in_array($code, $valid_coupons)) return $code;
    
}
?>