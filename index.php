<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Consultant_Finder
 */

get_header();

	$layout = business_consultant_finder_get_option('blog_layout');
 	/**
    * Hook - business_consultant_finder_container_before 		- 5
    * Hook - business_consultant_finder_content_column_start 	- 99.
    *
    * @hooked business_consultant_finder_container_before
    */
    do_action( 'business_consultant_finder_container_before', esc_attr( $layout ) );
    ?> 

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			//the_posts_navigation();
			do_action('business_consultant_finder_loop_navigation');

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
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
