<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Consultant_Finder
 */

get_header();

	$layout = business_consultant_finder_get_option('page_layout');
 	/**
    * Hook - business_consultant_finder_container_before 		- 5
    * Hook - business_consultant_finder_content_column_start 	- 99.
    *
    * @hooked business_consultant_finder_container_before
    */
    do_action( 'business_consultant_finder_container_before', esc_attr( $layout ) );
    ?> 
	

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	<?php
    /**
    * Hook - business_consultant_finder_content_column_end - 5
    * Hook - business_consultant_finder_sidebar - 10
    * Hook - business_consultant_finder_container_after - 999
    *
    * @hooked business_consultant_finder_container_after
    */
    do_action( 'business_consultant_finder_container_after', esc_attr( $layout )  );

get_footer();
