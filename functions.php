<?php

/**
 * Implement the theme Core feature.
 */
require get_template_directory() . '/inc/theme-core.php';

/**
 * Load customizer.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * All Posts Meta .
 */
require get_template_directory() . '/inc/partials/post_meta.php';

/**
 * Here Section  Render
 */
require get_template_directory() . '/inc/partials/hero_section.php';

/**
 * Theme Layout Loader
 */
require get_template_directory() . '/inc/theme-layout.php';

/**
 * All Posts load
 */
require get_template_directory() . '/inc/post-related-hook.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
* Custom widgets.
*/
if(!class_exists('Predic_Widget') ){
 require get_template_directory() . '/vendors/predic-widget/predic-widget.php';
}
 require get_template_directory() . '/inc/partials/header-widget.php';
 
/**
* Custom widgets.
*/
if( is_admin() ){
	
	require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
	require get_template_directory() . '/inc/tgm/plugins.php';
	require get_template_directory() . '/inc/admin/admin.php';
}



