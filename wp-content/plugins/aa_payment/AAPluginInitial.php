<?php

/**
 * Class AAPaymentInitial
 */

class AAPluginInitial {

	public $_plugin_name;

	protected $_page_title;
	protected $_menu_title;
	protected $_capability = 'manage_options';
	protected $_menu_slug;
	protected $_positon;
	protected $_notices_option;
	public    $_plugin_options;

	/**
	 * @param string $name
	 * @param null $pagetitle
	 * @param null $menutitle
	 * @param null $menuslug
	 * @param string $position
	 */
	public function __construct( $name = "AA Plugin", $pagetitle = null, $menutitle = null, $menuslug = null, $position = null )
	{
		$this->_plugin_name    = $name;
		$this->_page_title     = $pagetitle !== null ? $pagetitle : $this->_plugin_name;
		$this->_menu_title     = $menutitle !== null ? $menutitle : $this->_plugin_name;
		$this->_menu_slug      = $menuslug !== null ? $menuslug : str_replace( " ", "_", strtolower( $this->_plugin_name ) );
		$this->_positon        = $position;
		$this->_notices_option = "aa_" . $this->_menu_slug . "_notices_options";
		$this->_plugin_options = "aa_" . $this->_menu_slug . "_plugin_options";

		// Admin Script
		add_action( 'admin_enqueue_scripts', [ $this, 'registerPluginEnqueScript' ] );
		// Front Script
		add_action( 'wp_enqueue_scripts', [ $this, 'registerPluginEnqueScript' ], 11 );
		add_action( 'admin_menu', [ $this, 'createAdminPage' ] );

		// Set plugin notices
		$notices = get_option( $this->_notices_option );
		if ( ! $notices )
			add_option( $this->_notices_option, [ ] );

		$plugin_options = get_option( $this->_plugin_options );
		if ( ! $plugin_options )
			add_option( $this->_plugin_options, [ ] );
	}

	/**
	 * ==================== Get Options ======================
	 * if $option - get particular option elem of array
	 * 20.03.2016
	 */
	public function getOptions( $option = null )
	{
		if ( get_option( $this->_plugin_options ) ) {
			if ( $option !== null ) {
				$plugin_options = get_option( $this->_plugin_options );

				return $plugin_options[ $option ];
			}

			return get_option( $this->_plugin_options );
		}

		return false;
	}

	/**
	 * @param $option_key
	 * @param $option_value
	 * @param null $force
	 *
	 * when force in true option will be updated, otherwise will check options is exists
	 * used for actions
	 */
	public function setOption( $option_key, $option_value, $force = null )
	{
		$option = get_option( $this->_plugin_options );

		if ( get_option( $this->_plugin_options ) !== false ) {
			if ( $force === true ) {
				$option[ $option_key ] = $option_value;
			} else {
				if ( ! array_key_exists( $option_key, $option ) ) {
					$option[ $option_key ] = $option_value;
				}
			}
			update_option( $this->_plugin_options, $option );
		}
	}

	/**
	 * ==================== Get Notices ======================
	 * If $notice - get particular notice
	 * 20.03.2016
	 */
	public function getNotices( $notice = null )
	{
		if ( get_option( $this->_notices_option ) ) {
			if ( $notice !== null ) {
				$plugin_notices_opt = get_option( $this->_notices_option );

				return $plugin_notices_opt[ $notice ];
			}

			return get_option( $this->_notices_option );
		}

		return false;
	}

	/**
	 * Add notices
	 * aa_aa_plugin_notices_options
	 */
	public function setPluginNotice( $notice = 'some_notice', $message = 'Some message', $type = 'updated' )
	{
		$get_noticesinfo = get_option( $this->_notices_option );
		$new_option      = [ ];

		// If notice not exists set it for all users
		if ( ! array_key_exists( $notice, $get_noticesinfo ) ) {
			$new_option[ $notice ] = [
				'message'        => $message,
				'excluded_users' => [ ],
				'type'           => $type
			];

			$get_noticesinfo = array_merge( $get_noticesinfo, $new_option );
			update_option( $this->_notices_option, $get_noticesinfo );
		}

		add_action( 'admin_notices', [ $this, 'renderNotices' ], 2 );
	}

	/**
	 * Render notices
	 */
	public function renderNotices()
	{
		$notices      = get_option( $this->_notices_option );
		$current_user = get_current_user_id();

		foreach ( $notices as $notice_key => $notice_val ) {
			if ( array_search( $current_user, $notice_val[ 'excluded_users' ] ) === false ) {
				$attributes = "data-current-user='{$current_user}' id='{$notice_key}' data-plugin-notice={$this->_notices_option}";
				$class      = "{$notice_val[ 'type' ]} {$this->_notices_option}-notice notice is-dismissible aa-plugin-notice-container";
				?>
				<div <?php echo $attributes ?> class="<?php echo $class ?>">
					<p><?php echo $notice_val[ 'message' ] ?></p>
				</div>
				<?php
			}
		}
	}

	public function reactivateNotice( $notice )
	{
		//@Template Todo: reactivate notice for current user
	}

	/**
	 * Register style and script files
	 */
	public function registerPluginEnqueScript()
	{
		$plugindir = plugin_dir_url( __DIR__ ) . basename( __DIR__ );
		wp_enqueue_style( 'AAPluginStyle' . $this->_menu_slug, $plugindir . '/style/style.css' );
		wp_enqueue_script( 'AAPluginScript' . $this->_menu_slug, $plugindir . '/js/script.js', [ 'jquery' ], false, true );

		$data = [
			'site_url'     => get_site_url(),
			'ajax_url'     => admin_url( 'admin-ajax.php' ),
			'template_uri' => get_template_directory_uri(),
		];
		wp_localize_script( 'AAPluginScript' . $this->_menu_slug, 'aa_ajax_var', $data );
	}

	/**
	 * Initialize admin page
	 */
	public function createAdminPage()
	{
		add_menu_page(
			$this->_page_title,
			$this->_menu_title,
			$this->_capability,
			$this->_menu_slug, // file in views should be same
			[ $this, 'renderListing' ], 'dashicons-randomize', $this->_positon
		);
		do_action( 'do_the_creation_page' );
	}

	/**
	 * ==================== Sub Page ======================
	 * 20.03.2016
	 */
	public function addSubpage( $page_title )
	{
		$values = [
			'slug'       => $this->_menu_slug,
			'tittle'     => $page_title,
			'capability' => $this->_capability,
			'menu_slug'  => str_replace( " ", "_", strtolower( $page_title ) ), // file in views should be same
			'action'     => [ $this, 'renderListing' ]
		];

		add_action( 'admin_menu', function () use ( &$values ) {
			add_submenu_page(
				$values[ 'slug' ],
				$values[ 'tittle' ],
				$values[ 'tittle' ],
				$values[ 'capability' ],
				$values[ 'menu_slug' ],
				$values[ 'action' ]
			);
		} );

	}

	/**
	 * ==================== All Views ======================
	 * 20.03.2016
	 */
	public function renderListing()
	{
		$path = "views/{$_GET['page']}.php";
		include( $path );
	}

	/**
	 * Getting table info for generate fields
	 *
	 * @param $table_name
	 *
	 * @return mixed
	 */
	public static function describe( $table_name )
	{
		global $wpdb;
		$table = $wpdb->prefix . $table_name;

		return $wpdb->get_results( "DESCRIBE $table", ARRAY_A );
	}

	/**
	 * Get saved data from table
	 * @return bool|mixed
	 */
	public static function tableData( $table_name )
	{
		global $wpdb;
		$table  = $wpdb->prefix . $table_name;
		$result = $wpdb->get_results( "SELECT * from $table", ARRAY_A );
		if ( ! empty( $result ) ) {
			return $result;
		}

		return false;
	}

	/**
	 * Generator tables
	 *
	 * @param $table_name
	 * @param $args
	 * @param null $primary
	 */
	public static function createTable( $table_name, $args, $primary = null )
	{
		global $wpdb;
		$table_name         = $wpdb->prefix . $table_name;
		$combine_query      = "";
		$primary_key_exists = $primary ? "id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, " : null;

		foreach ( $args as $field ) {
			$var_val = strpos( $field[ 1 ], 'varchar' ) > - 1 ? '(255)' : '';
			$combine_query .= $field[ 0 ] . " " . strtoupper( $field[ 1 ] ) . $var_val . " NOT NULL, ";
		}

		$q = "CREATE TABLE IF NOT EXISTS $table_name ( " . $primary_key_exists . substr( $combine_query, 0, - 2 ) . ")
			ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $q );
	}

	public static function isLocalhost()
	{
		return ( $_SERVER[ 'REMOTE_ADDR' ] === '127.0.0.1' || $_SERVER[ 'REMOTE_ADDR' ] === 'localhost' ) ? 1 : 0;
	}

	/**
	 * returns images plugin dir
	 * @return string
	 */
	public function get_images_dir_url()
	{
		$plugindir = plugin_dir_url( __DIR__ ) . basename( __DIR__ );
		return $plugindir."/img/";
	}

}