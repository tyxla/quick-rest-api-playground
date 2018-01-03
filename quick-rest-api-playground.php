<?php
/*
 * Plugin Name: Quick REST API Playground
 * Description: A very very basic REST API console that runs in the wp-admin.
 * Version: 0.1
 * License: GPL2+
 */

class WPA_Quick_REST_API_Playground {
	/**
	 * Constructor.
	 *
	 * Initialize the playground.
	 *
	 * @access public
	 */
	public function __construct() {
		// register admin page
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 30 );

		// enqueue admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Name of the admin page.
	 *
	 * @access public
	 * @static
	 *
	 * @return string $name The name of the options page.
	 */
	public static function get_page_name() {
		return 'wpa-quick-rest-api-playground';
	}

	/**
	 * Title of the admin page.
	 *
	 * @access public
	 * @static
	 *
	 * @return string $title The title of the options page.
	 */
	public static function get_page_title() {
		return __( 'REST API Playground' );
	}

	/**
	 * Register the admin page.
	 *
	 * @access public
	 */
	public function admin_menu() {
		// register admin page
		add_management_page(
			self::get_page_title(),
			self::get_page_title(),
			'manage_options',
			self::get_page_name(),
			array( $this, 'admin_page' )
		);
	}

	/**
	 * Enqueue scripts.
	 *
	 * @access public
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_script( 'wpa-quick-rest-api-playground-main', plugins_url( '/', __FILE__ ) . 'assets/js/main.js', array( 'jquery' ) );
	}

	/**
	 * Content of the admin page.
	 *
	 * @access public
	 */
	public function admin_page() {
		?>
		<div class="wrap">
			<h2><?php echo esc_html( self::get_page_title() ); ?></h2>

			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><?php _e('Request type'); ?></th>
						<td>
							<select class="wpa-playground-request-type">
								<option value="GET">GET</option>
								<option value="POST">POST</option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Endpoint path'); ?></th>
						<td>
							<input class="wpa-playground-endpoint-path regular-text" value="/wp/v2" />
						</td>
					</tr>
					<tr class="request-body-wrapper" style="display: none;">
						<th scope="row"><?php _e('Request body (in JSON format)'); ?></th>
						<td>
							<textarea class="wpa-playground-request-body regular-text" rows="15"></textarea>
						</td>
					</tr>
				</tbody>
			</table>

			<p class="submit">
				<input type="submit" id="submit" class="button button-primary" value="<?php esc_attr_e('Send request'); ?>" />
			</p>

			<pre id="response" style="display: block;">
				
			</pre>
		</div>
		<?php
	}
}

global $wpa_quick_rest_api_playground;
$wpa_quick_rest_api_playground = new WPA_Quick_REST_API_Playground();
