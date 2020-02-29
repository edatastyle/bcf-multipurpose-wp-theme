<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Consultant_Finder
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content">
<?php echo esc_html__( 'Skip to content', 'business-consultant-finder' ); ?>
</a>

<header class="site-header" data-type="anchor" id="masthead">
	<?php
    /**
    * Hook - business_consultant_finder_top_bar 		- 10
    * Hook - business_consultant_finder_rd_nav_before 	- 20.
    * Hook - business_consultant_finder_rd_nav_inner_html 	- 30.
	* Hook - business_consultant_finder_rd_nav_main_menu 	- 30.
	* Hook - business_consultant_finder_rd_nav_after 	- 30.
    *
    * @hooked business_consultant_finder_header
    */
    do_action( 'business_consultant_finder_header' );
	
    ?>   
</header>

