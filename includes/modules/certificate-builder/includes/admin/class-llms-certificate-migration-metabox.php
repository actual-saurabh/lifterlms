<?php
/**
 * Certificate Migration Metabox.
 *
 * @package LifterLMS/Modules/Certificate_Builder/
 *
 * @since   [version]
 * @version [version]
 */

/**
 * Conditionally loads migration/rollback editor metabox.
 *
 * @since [version]
 */
class LLMS_Certificate_Migration_Metabox extends LLMS_Admin_Metabox {

	/**
	 * Configure the metabox settings
	 *
	 * @return  void
	 * @since  [version]
	 */
	public function configure() {

		$this->id       = 'lifterlms-certificate-rollback-migration';
		$this->title    = __( 'Migrate/ Rollback ', 'lifterlms' );
		$this->screens  = array(
			'llms_certificate',
		);
		$this->context  = 'side';
		$this->priority = 'high';

	}

	/**
	 * Registers the metabox with LifterLMS Metabox API.
	 *
	 * @since [version]
	 */
	public function register() {

		global $post;

		// if the certificate has a legacy (is migrated from one).
		$has_legacy = ! empty (LLMS_Certificate_Migrator::has_legacy( $post->ID ) );

		// if the certificate is a legacy.
		$is_legacy = LLMS_Certificate_Migrator::is_legacy( $post->ID );

		// if the certificate is a legacy of a migrated modern one.
		$is_legacy_of_modern = ! empty( LLMS_Certificate_Migrator::is_legacy_of_modern( $post->ID ) );

		// no need to display on freshly created certificates or ones already migrated.
		if ( ( ! $has_legacy && ! $is_legacy ) || $is_legacy_of_modern ) {
			return;
		}

		// otherwise, register the metabox
		parent::register();

	}

	/**
	 * Returns fields for the metabox
	 *
	 * @since  [version]
	 *
	 * @return array
	 */
	public function get_fields() {

		// Return empty because our metabox doesn't use the standard fields api
		return array();
	}

	/**
	 * Function to field WP::output() method call
	 * Passes output instruction to parent
	 *
	 * @since [version]
	 */
	public function output() {

		global $post;

		$legacy = LLMS_Certificate_Migrator::has_legacy( $post->ID );

		$has_legacy = ! empty( $legacy );

		$is_legacy = LLMS_Certificate_Migrator::is_legacy( $post->ID );

		if ( $has_legacy ) {
			?>
			<input class="button-secondary" type="submit" name="llms_certificate_rollback" value="Rollback to Legacy Version"/>
			<a class="legacy-delete" href="<?php echo get_delete_post_link( $legacy->ID ); ?>">Trash Legacy Version</a>
			<?php
		}

		if ( $is_legacy ) {
			?>

			<input class="button-primary" type="submit" name="llms_certificate_migrate" value="Migrate to new Builder"/>
			<a>Migrate all certificates to new Builder</a>
			<?php
		}

		wp_nonce_field( 'lifterlms_save_data', 'lifterlms_meta_nonce' );

	}

	/**
	 * Save action, update order status
	 *
	 * @since 3.0.0
	 * @since 3.19.0 Unknown.
	 * @since 3.35.0 Verify nonces and sanitize `$_POST` data.
	 *
	 * @param int $post_id  WP Post ID of the Order
	 * @return null
	 */
	public function save( $post_id ) {

		if ( ! llms_verify_nonce( 'lifterlms_meta_nonce', 'lifterlms_save_data' ) ) {
			return;
		}

		if ( llms_filter_input( INPUT_POST, 'llms_certificate_migrate' ) ) {
			$this->migrate( $post_id );
		}

		if ( llms_filter_input( INPUT_POST, 'llms_certificate_rollback' ) ) {
			$this->rollback( $post_id );
		}

	}

	/**
	 * Migrates a given legacy certificate.
	 *
	 * @param int $post_id Post ID of legacy certificate
	 *
	 * @since [version]
	 */
	public function migrate( $post_id ){

		$new_certificate = LLMS_Certificate_Migrator::migrate( $post_id );

		// set an empty context, otherwise the `&` will be returned as `&amp;` breaking the redirection.
		$edit_link = get_edit_post_link( $new_certificate, '' );

		$redirect_url = add_query_arg(
			array(
				'llms-certificate-migrate' => true, // special query parameter to trigger content migration.
			),
			$edit_link
		);

		// redirect to new certificate's editor.
		if ( wp_redirect( $redirect_url ) ) {
			exit();
		}
	}

	/**
	 * Rollback a given modern certificate to legacy.
	 *
	 * @param int $post_id Post ID of legacy certificate
	 *
	 * @since [version]
	 */
	public function rollback(){

		$legacy_certificate = LLMS_Certificate_Migrator::rollback( $post_id );

		// set an empty context, otherwise the `&` will be returned as `&amp;` breaking the redirection.
		$edit_link = get_edit_post_link( $legacy_certificate, '' );


		$redirect_url = add_query_arg(
			array(
				'llms-certificate-rollback' => true, // special query parameter to trigger content migration.
			),
			$edit_link
		);

		// redirect to new certificate's editor.
		if ( wp_redirect( $redirect_url ) ) {
			exit();
		}
	}

}

return new LLMS_Certificate_Migration_Metabox();

/*
 * Wheel turns on its own,
 * Change always sits at the throne,
 * Better versions known.
 */
