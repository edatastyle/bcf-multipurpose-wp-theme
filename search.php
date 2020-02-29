<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

		<?php if ( have_posts() ) : ?>

			
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

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
