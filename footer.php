<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Consultant_Finder
 */

?>

<?php
    /**
    * Hook - business_consultant_finder_footer_widgets 		- 10
	* Hook - business_consultant_finder_footer 	- 100.
    *
    * @hooked business_consultant_finder_header
    */
    do_action( 'business_consultant_finder_footer' );
    ?>   


<?php wp_footer(); ?>

</body>
</html>
