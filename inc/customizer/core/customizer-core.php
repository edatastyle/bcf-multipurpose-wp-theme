<?php 
/**
 * Core functions.
 *
 * @package business-consultant-finder
 */

if ( ! function_exists( 'business_consultant_finder_get_option' ) ) :

	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function business_consultant_finder_get_option( $key ) {

		if ( empty( $key ) ) {
			return;
		}

		$value = '';

		$default = business_consultant_finder_get_default_theme_options();
		$default_value = null;

		if ( is_array( $default ) && isset( $default[ $key ] ) ) {
			$default_value = $default[ $key ];
		}

		if ( null !== $default_value ) {
			$value = get_theme_mod( $key, $default_value );
		}
		else {
			$value = get_theme_mod( $key );
		}

		return $value;
	}

endif;