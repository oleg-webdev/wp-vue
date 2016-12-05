<?php

namespace AlicelfMaterial\Helpers;

class AmDb {

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

}