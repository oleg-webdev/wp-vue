<?php
/**
 * ==================== Array operations ======================
 * 25.03.2016
 */

namespace AlicelfMaterial\Helpers;


class Arr {

	/**
	 * Divide an array into two arrays. One with keys and the other with values.
	 *
	 * @param  array $array
	 *
	 * @return array
	 */
	public static function divide( $array )
	{
		return [ array_keys( $array ), array_values( $array ) ];
	}

	/**
	 * Forget item in array
	 *
	 * @param $maybe_array
	 * @param $param
	 * @param bool $key - if key, will search key in array instead value
	 * @param bool $numeric_array - means [0]=>val, [2]=>val
	 *
	 * @return mixed
	 */
	public static function forget( $maybe_array, $param, $key = false, $numeric_array = false )
	{
		if ( ! is_array( $maybe_array ) )
			$maybe_array = unserialize( $maybe_array );

		if ( is_array( $maybe_array ) ) {
			if ( $key === true )
				$position = array_search( $param, array_keys( $maybe_array ) );
			else
				$position = array_search( $param, $maybe_array );

			if ( $position !== false ) {
				if ( $numeric_array === true )
					unset( $maybe_array[ $position ] );
				else
					unset( $maybe_array[ $param ] );
			}

			return $maybe_array; // can be false
		}

		return false;
	}

}