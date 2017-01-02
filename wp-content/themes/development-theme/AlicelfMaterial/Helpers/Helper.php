<?php

namespace AlicelfMaterial\Helpers;

use WP_Http;

class Helper {

	/**
	 * @return bool
	 */
	public static function isLocalhost()
	{
		return ( $_SERVER[ 'REMOTE_ADDR' ] === '127.0.0.1'
		         || $_SERVER[ 'REMOTE_ADDR' ] === 'localhost' )
		       || $_SERVER[ 'REMOTE_ADDR' ] === "::1"
			? true : false;
	}

	/**
	 * @param $string
	 * @param null $num_start
	 * @param null $num_end
	 *
	 * @return null|string
	 */
	public static function contentCutter( $string, $num_start = null, $num_end = null )
	{
		settype( $string, "string" );
		if ( is_int( $num_start ) && is_int( $num_end ) ) {
			$array_of_strings = explode( " ", $string );
			$sliced           = array_slice( $array_of_strings, $num_start, $num_end );
			$new_string       = implode( " ", $sliced );

			return $new_string;
		}

		return null;
	}

	/**
	 * Fetch Url
	 *
	 * @param $url
	 * @param int $timeout
	 *
	 * @param bool $type
	 *
	 * @return mixed|string
	 */
	public static function fetchCurl( $url, $timeout, $type = false )
	{
		if ( is_callable( 'curl_init' ) ) {
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );

//		set headers if need
			if ( $type ) {
				//@TODO: swith type
				curl_setopt( $ch, CURLOPT_HTTPHEADER, [
					'Content-type: text/xml'
				] );
			}

			$feedData = curl_exec( $ch );
			curl_close( $ch );
			//If not then use file_get_contents
		} elseif ( ini_get( 'allow_url_fopen' ) == 1 || ini_get( 'allow_url_fopen' ) === true ) {
			$feedData = file_get_contents( $url );
			//Or else use the WP HTTP AP
		} else {
			if ( ! class_exists( 'WP_Http' ) )
				include_once( ABSPATH . WPINC . '/class-http.php' );
			$request  = new WP_Http;
			$result   = $request->request( $url );
			$feedData = $result[ 'body' ];
		}

		return $feedData;
	}

	/**
	 * @param $data
	 */
	public static function dumpAndDie( $data )
	{
		echo "<pre>";
		var_dump( $data );
		echo "</pre>";
		die;
	}

	/**
	 * @return string
	 */
	public static function browser()
	{
		if ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'MSIE' ) !== false
		     || strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Trident' ) !== false
		) {
			$browser = 'edge-iexplorer';

		} elseif ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Chrome' ) !== false ) {
			$browser = 'google-chrome';

		} elseif ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Firefox' ) !== false ) {
			$browser = 'mozilla-firefox';

		} elseif ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Opera' ) !== false ) {
			$browser = 'opera';

		} elseif ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Safari' ) !== false ) {
			$browser = 'apple-safari';

		} else {
			$browser = 'unknown-browser';
		}

		return $browser;
	}

	/**
	 * Remove all cookies
	 */
	public static function flushCookies()
	{
		if ( isset( $_SERVER[ 'HTTP_COOKIE' ] ) ) {
			$cookies = explode( ';', $_SERVER[ 'HTTP_COOKIE' ] );
			foreach ( $cookies as $cookie ) {
				$parts = explode( '=', $cookie );
				$name  = trim( $parts[ 0 ] );
				setcookie( $name, '', time() - 1000 );
				setcookie( $name, '', time() - 1000, '/' );
			}
		}
	}

	/**
	 * @param $attachment_id
	 *
	 * @return bool
	 */
	public static function deleteAttachment( $attachment_id )
	{
		if ( ! $attachment_id && ! is_numeric( $attachment_id ) )
			return false;

		if ( wp_get_attachment_image_src( $attachment_id ) ) {
			unlink( get_attached_file( $attachment_id ) );

			$attachment_meta = wp_get_attachment_metadata( $attachment_id );
			foreach ( $attachment_meta[ 'sizes' ] as $ik => $iv ) {
				$image = wp_get_attachment_image_src( $attachment_id, $ik )[ 0 ];
				unlink( str_replace( get_site_url() . '/', ABSPATH, $image ) );
			}

			wp_delete_attachment( $attachment_id );

			return true;
		}

		return false;

	}

	/**
	 * ==================== Current Request Is ajax ? ======================
	 */
	public static function is_ajax()
	{
		return is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX;
	}

}