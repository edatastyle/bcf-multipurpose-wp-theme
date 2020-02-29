<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Consultant_Finder
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col-md-12','single-item' ) ); ?>>
  <div class="item">
		<?php
	   
        /**
        * Hook - business_consultant_finder_posts_blog_media.
        *
        * @hooked business_consultant_finder_posts_blog_media - 10
        */
        do_action( 'business_consultant_finder_posts_blog_media' );
	   
        ?>
    
    <div class="content">
    
    	<?php
		/**
        * Hook - business_consultant_finder_post_meta_archive.
        *
        * @hooked render_meta_list - 10
        */
		do_action('business_consultant_finder_post_meta_archive', array('author'), 'top_autor_meta' );
		/**
        * Hook - business_consultant_finder_posts_heading.
        *
		* @hooked business_consultant_finder_posts_blog_heading_title - 10
        */
		 do_action( 'business_consultant_finder_posts_heading' );
		/**
        * Hook - business_consultant_finder_post_meta_archive.
        *
        * @hooked render_meta_list - 10
        */
		do_action('business_consultant_finder_post_meta_archive', array('date','category','comments','edit') );
		
        /**
        * Hook - business_consultant_finder_blog_loop_content.
        *
		* @hooked business_consultant_finder_blog_loop_content_type - 40
        */
        do_action( 'business_consultant_finder_blog_loop_content' );
        ?>
    
    </div>
  </div>
</article>

<!-- #post-<?php the_ID(); ?> -->
