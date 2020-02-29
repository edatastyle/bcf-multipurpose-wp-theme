<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Business_Consultant_Finder
 */

get_header();
 	/**
    * Hook - business_consultant_finder_container_before - 5
    *
    * @hooked business_consultant_finder_container_before
    */
    do_action( 'business_consultant_finder_container_before' );
    ?> 
	
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single');

			do_action('business_consultant_finder_single_post_navigation');

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		

<?php
/**
* Hook - business_consultant_finder_sidebar - 999
* Hook - business_consultant_finder_container_after - 999
*
* @hooked business_consultant_finder_container_after
*/
do_action( 'business_consultant_finder_container_after' );

get_footer();
