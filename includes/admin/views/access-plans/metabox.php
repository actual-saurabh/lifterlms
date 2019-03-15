<?php
/**
 * Product Options Admin Metabox HTML
 *
 * @package  LifterLMS/Admin/Views
 * @since    3.0.0
 * @version  3.29.0
 *
 * @var obj $course LLMS_Course.
 * @var obj $product LLMS_Product.
 */

defined( 'ABSPATH' ) || exit;
?>

<?php
// prepare product type string
$product_type = ( ! $course ) ? __( 'Membership', 'lifterlms' ) : __( 'Course', 'lifterlms' );

// get available checkout redirection types.
$checkout_redirection_types = llms_get_checkout_redirection_types( $product_type );

?>
<div class="llms-metabox" id="llms-product-options-access-plans">

	<section class="llms-collapsible-group llms-access-plans" id="llms-access-plans">
		<div class="llms-no-plans-msg">
			<p><?php printf( __( 'Access plans define the payment options and access time-periods available for this %s.', 'lifterlms' ), strtolower( $product->get_post_type_label( 'singular_name' ) ) ); ?></h3>
			<p><?php printf( __( 'No access plans exist for your %s, click "Add New" to get started.', 'lifterlms' ), strtolower( $product->get_post_type_label( 'singular_name' ) ) ); ?></p>
		</div>
		<?php foreach ( $product->get_access_plans( false, false ) as $plan ) : ?>
			<?php include 'access-plan.php'; ?>
		<?php endforeach; ?>
	</section>

	<div class="llms-metabox-section d-all d-right">
		<button class="llms-button-secondary" id="llms-new-access-plan" type="button"><?php _e( 'Add New', 'lifterlms' ); ?></button>
		<button class="llms-button-primary" id="llms-save-access-plans" type="button"><?php _e( 'Save', 'lifterlms' ); ?></button>
	</div>

	<?php
		// unset $plan so it's not used for the model.
		unset( $plan );
		// model of an access plan we'll clone when clicking the "add" button.
		include 'access-plan.php';
	?>

</div>
