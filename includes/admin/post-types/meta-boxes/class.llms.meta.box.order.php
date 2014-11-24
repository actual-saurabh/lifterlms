<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Meta Box Video
*
* diplays text input for oembed video
*
* @version 1.0
* @author codeBOX
* @project lifterLMS
*/
class LLMS_Meta_Box_Order {

	/**
	 * Set up video input
	 *
	 * @return string
	 * @param string $post
	 */
	public static function output( $post ) {
		global $post;
		wp_nonce_field( 'lifterlms_save_data', 'lifterlms_meta_nonce' );

		$user_id = get_post_meta( $post->ID, '_llms_user_id', true );
		$payment_method = get_post_meta( $post->ID, '_llms_payment_method', true );
		$product_title = get_post_meta( $post->ID, '_llms_product_title', true );
		$order_total = get_post_meta( $post->ID, '_llms_order_total', true );
		$order_type = get_post_meta( $post->ID, '_llms_order_type', true );
		$order_date = get_post_meta( $post->ID, '_llms_order_date', true );
		$order_type = get_post_meta( $post->ID, '_llms_order_type', true );
		

		$rec_payment = get_post_meta( $post->ID, '_llms_order_recurring_price', true );
		$rec_first_payment = get_post_meta( $post->ID, '_llms_order_first_payment', true );
		$rec_billing_period = get_post_meta( $post->ID, '_llms_order_billing_period', true );
		$rec_billing_freq = get_post_meta( $post->ID, '_llms_order_billing_freq', true );
		$rec_billing_start_date = get_post_meta( $post->ID, '_llms_order_billing_start_date', true );

		$payment_type = get_post_meta( $post->ID, '_llms_payment_type', true );

		
		if (!empty($payment_type) && $payment_type == 'creditcard') {
			$cc_type = get_post_meta( $post->ID, '_llms_order_cc_type', true );
			$cc_number = get_post_meta( $post->ID, '_llms_order_cc_number', true );
			$cc_exp_month = get_post_meta( $post->ID, '_llms_order_cc_exp_month', true );
			$cc_exp_year = get_post_meta( $post->ID, '_llms_order_exp_year', true );
		}

		$coupon_id = get_post_meta( $post->ID, '_llms_order_coupon_id', true );
		if (!empty($coupon_id)) {
			$coupon_type = get_post_meta($post->ID, '_llms_order_coupon_type', true );
			$coupon_amount = get_post_meta($post->ID, '_llms_order_coupon_amount', true );
			$coupon_limit = get_post_meta($post->ID, '_llms_order_coupon_limit', true );
			$coupon_title = get_the_title( $coupon_id );
			$coupon_code = get_post_meta($post->ID, '_llms_order_coupon_code', true );
			

			if ( $coupon_type == 'percent' ) {
				$coupon_amount_html = $coupon_amount . '%';
			}
			elseif ( $coupon_type == 'dollar' ) {
				$coupon_amount_html = '$' . $coupon_amount;
			}

		}

		$usermeta = get_user_meta($user_id);
		$user = get_user_by('id', $user_id);

		if ($usermeta['first_name'][0] != '') {
			$user_name = $usermeta['first_name'][0] . ' ' . $usermeta['last_name'][0];
		}
		else {
			$user_name = $user->user_nicename;
		}
		$user_email = $user->user_email;
		
		do_action( 'lifterlms_before_order_meta_box' ); ?>

		<table class="form-table">
		<tbody>
			<tr>
				<th>
					<?php
					$label  = '';
					$label .= '<label>' . __( 'General Details', 'lifterlms' ) . '</label> ';
					echo $label;
					?>
				</th>
				<td>
					<table class="form-table">
			
						<tr>
							<td><label><?php _e('Order Date', 'lifterlms') ?></label></td>
							<td><?php echo $order_date ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Payment Method', 'lifterlms') ?></label></td>
							<td><?php echo $payment_method; ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Product Title', 'lifterlms') ?></label></td>
							<td><?php echo $product_title; ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Purchase Total', 'lifterlms') ?></label></td>
							<td><?php echo get_lifterlms_currency_symbol() . $order_total; ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Buyer Name', 'lifterlms') ?></label></td>
							<td><?php echo $user_name; ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Buyer Email', 'lifterlms') ?></label></td>
							<td><a href="mailto:<?php echo $user_email ?>"><?php echo $user_email; ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Payment Type', 'lifterlms') ?></label></td>
							<td><?php echo $order_type; ?></td>
						</tr>

						<?php if ($order_type == 'recurring' ) { ?>

						<tr>
							<td><label><?php _e('First Payment (paid)', 'lifterlms') ?></label></td>
							<td><?php echo $rec_first_payment; ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Billing Amount', 'lifterlms') ?></label></td>
							<td><?php echo $rec_payment; ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Billing Period', 'lifterlms') ?></label></td>
							<td><?php echo $rec_billing_period; ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Billing Frequency', 'lifterlms') ?></label></td>
							<td><?php echo $rec_billing_freq; ?></td>
						</tr>
						<tr>
							<td><label><?php _e('Billing Start Date', 'lifterlms') ?></label></td>
							<td><?php echo $rec_billing_start_date; ?></td>
						</tr>

						<!-- Display Credit Card Information -->
						<?php if (!empty($payment_type) && $payment_type == 'creditcard') : ?>
							<tr>
								<td><label><?php _e('CC Type', 'lifterlms') ?></label></td>
								<td><?php echo $cc_type; ?></td>
							</tr>
							<tr>
								<td><label><?php _e('CC Number', 'lifterlms') ?></label></td>
								<td><?php echo $cc_number; ?></td>
							</tr>
							<tr>
								<td><label><?php _e('CC Exp Date', 'lifterlms') ?></label></td>
								<td><?php echo $cc_exp_month; ?></td>
							</tr>
							<tr>
								<td><label><?php _e('CC Exp Year', 'lifterlms') ?></label></td>
								<td><?php echo $cc_exp_year; ?></td>
							</tr>
						<?php endif; ?>

						<!-- Display Coupon Information -->
						<?php if (!empty($coupon_id) ) : ?>
							<tr>
								<td><label><?php _e('Coupon Used?', 'lifterlms') ?></label></td>
								<td><?php echo _e('Yes'); ?></td>
							</tr>
							<tr>
								<td><label><?php _e('Coupon Name', 'lifterlms') ?></label></td>
								<td><?php echo $coupon_title; ?></td>
							</tr>
							<tr>
								<td><label><?php _e('Coupon Code', 'lifterlms') ?></label></td>
								<td><?php echo $coupon_code; ?></td>
							</tr>
							<tr>
								<td><label><?php _e('Coupon Amount', 'lifterlms') ?></label></td>
								<td><?php echo $coupon_amount_html; ?></td>
							</tr>
							<tr>
								<td><label><?php _e('Remaining coupon uses', 'lifterlms') ?></label></td>
								<td><?php echo $coupon_limit; ?></td>
							</tr>
						<?php else : ?>
							<tr>
								<td><label><?php _e('Coupon Used?', 'lifterlms') ?></label></td>
								<td><?php echo _e('No'); ?></td>
							</tr>
						<?php endif; ?>


		


						<?php } ?>
	
					</table>
				</td>
			</tr>

		</tbody>
		</table>
		<?php do_action( 'lifterlms_after_order_meta_box' );
	}

	public static function save( $post_id, $post ) {
		global $wpdb;

		if ( isset( $_POST['_video_embed'] ) ) {
			$video = ( llms_clean( $_POST['_video_embed']  ) );
			update_post_meta( $post_id, '_video_embed', ( $video === '' ) ? '' : $video );		
		}
		if ( isset( $_POST['_audio_embed'] ) ) {
			$audio = ( llms_clean( $_POST['_audio_embed']  ) );
			update_post_meta( $post_id, '_audio_embed', ( $audio === '' ) ? '' : $audio );		
		}
	}

}