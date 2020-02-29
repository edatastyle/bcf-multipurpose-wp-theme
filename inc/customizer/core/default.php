<?php
/**
 * Default theme options.
 *
 * @package business-consultant-finder
 */

if ( ! function_exists( 'business_consultant_finder_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function business_consultant_finder_get_default_theme_options() {

		$defaults = array();
		
		/*Global Layout*/
		$defaults['social_profile']     			= false;
		$defaults['social_profile_link']     		= esc_url( '#' );
		$defaults['search_icon']     			    = 1;
		
		/*Posts Layout*/
		$defaults['blog_layout']     				= 'content-sidebar';
		$defaults['blog_loop_content_type']     	= 'excerpt';
		/*Posts Layout*/
		$defaults['page_layout']     				= 'content-sidebar';
		
		/*layout*/
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'business-consultant-finder' );
		$defaults['read_more_text']					= esc_html__( 'Read more', 'business-consultant-finder' );
		$defaults['index_hide_thumb']     			= false;
		$defaults['social_topbar']     				= true;
		$defaults['social_footer']     				= true;
		$defaults['dialogue'] 					    = '';
		
	

		// Pass through filter.
		$defaults = apply_filters( 'business_consultant_finder_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
