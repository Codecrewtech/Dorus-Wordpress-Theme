<?php
/**
 * Order tracking form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;
?>
<div class="box">
    <form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

    	<p><?php _e( 'To track your order please enter your Order ID in the box below and press return. This was given to you on your receipt and in the confirmation email you should have received.', 'tomato' ); ?></p>
    
    	<div class="form-row form-row-first form-group"><label for="orderid"><?php _e( 'Order ID', 'tomato' ); ?></label> <input class="input-text form-control" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Found in your order confirmation email.', 'tomato' ); ?>" /></div>
    	<div class="form-row form-row-last form-group"><label for="order_email"><?php _e( 'Billing Email', 'tomato' ); ?></label> <input class="input-text form-control" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Email you used during checkout.', 'tomato' ); ?>" /></div>
    	<div class="clear"></div>
    
    	<input type="submit" class="btn btn-primary btn-inline" name="track" value="<?php _e( 'Track', 'tomato' ); ?>" />
    	<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>

    </form>
</div>
