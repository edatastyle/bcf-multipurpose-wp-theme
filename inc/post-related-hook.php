<?php
/**
 * Functions hooked to post page.
 *
 * @package Business_Consultant_Finder
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 if ( ! function_exists( 'business_consultant_finder_posts_formats_thumbnail' ) ) :

	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function business_consultant_finder_posts_formats_thumbnail() {
		$formats = ( get_post_format(get_the_ID()) != "" ) ? get_post_format(get_the_ID()) : 'image' ;
		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		
	?>
		<?php 
        if ( has_post_thumbnail() ) : ?>
            <div class="thumb"> 
            
			<?php if( is_single() ){ $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id ); ?>
            	<a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup"><?php the_post_thumbnail('full');?></a>
            <?php }else{ ?>
            	<a href="<?php echo esc_url( get_permalink() );?>" class="image-link entry-cover"><?php the_post_thumbnail('full');?><i class="fas fa-plus"></i></a>
            <?php } ?>
                
            <div class="post-formate"> <i class="fas fa-image"></i> </div>
            </div>
        	
        <?php endif;?>  
	<?php
	}

endif;
add_action( 'business_consultant_finder_posts_formats_thumbnail', 'business_consultant_finder_posts_formats_thumbnail' );


if ( ! function_exists( 'business_consultant_finder_posts_formats_video' ) ) :

	/**
	 * Post Formats Video.
	 *
	 * @since 1.0.0
	 */
	function business_consultant_finder_posts_formats_video() {
	
		$content = apply_filters( 'the_content', get_the_content(get_the_ID()) );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		
		
			// If not a single post, highlight the video file.
			if ( ! empty( $video ) ) :
			
				if( isset( $video[0] ) ) :
					echo '<div class="thumb"><div class="entry-video embed-responsive embed-responsive-16by9">';
						echo wp_kses( $video[0], business_consultant_finder_alowed_tags() );
					echo '</div></div>';
					
				endif;
				
			else: 
				do_action('business_consultant_finder_posts_formats_thumbnail');	
			endif;
		
		
	 }

endif;
add_action( 'business_consultant_finder_posts_formats_video', 'business_consultant_finder_posts_formats_video' ); 


if ( ! function_exists( 'business_consultant_finder_posts_formats_audio' ) ) :

	/**
	 * Post Formats audio.
	 *
	 * @since 1.0.0
	 */
	function business_consultant_finder_posts_formats_audio() {
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
	
		
		
	
		// If not a single post, highlight the audio file.
		if ( ! empty( $audio ) ) :
		
			foreach ( $audio as $audio_html ) {
				if ( has_post_thumbnail() ) :
				
				echo '<div class="article-img thumb post-top-image formats-video">';
					$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
					$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
					echo '<div class="blog-audio-bg img-wrp" style="background: url(\''.esc_url( $post_thumbnail_url ).'\') no-repeat center center; background-size:cover; -webkit-background-size:cover; -moz-background-size:cover;">';
						echo '<span class="position-vertical-center">'. wp_kses( $audio_html, business_consultant_finder_alowed_tags() ).'</span>';
					echo '</div>';
					
					
				echo '<div class="post-formate"> <i class="fas fa-image"></i> </div></div>';
				else:
					echo '<div class="blog-media img-wrp">';
					echo  wp_kses( $audio_html, business_consultant_finder_alowed_tags() );
					echo '</div>';	
				endif;
				
				
			}
		else: 
			do_action('business_consultant_finder_posts_formats_video');	
		endif;
	
		
	 }

endif;
add_action( 'business_consultant_finder_posts_formats_audio', 'business_consultant_finder_posts_formats_audio' ); 

add_filter( 'use_default_gallery_style', '__return_false' );


if ( ! function_exists( 'business_consultant_finder_posts_formats_gallery' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function business_consultant_finder_posts_formats_gallery() {
		global $post;
		$post_thumbnail_url = '';
		if( has_block('gallery', $post->post_content) ): 
		
			$post_blocks = parse_blocks( $post->post_content );
			
			if( !empty( $post_blocks ) ):
				
				echo '<div class="gallery-media wp-block-gallery thumb formats-gallery">';
				foreach ( $post_blocks as $row  ):
					if( $row['blockName']=='core/gallery' )
					echo $row['innerHTML'];
				endforeach;
				echo '<div class="post-formate"> <i class="fas fa-image"></i> </div>';
				echo '</div>';
			endif;
		
		elseif( get_post_gallery( get_the_ID() ) ) :
	
		
		echo '<div class="thumb formats-gallery">';
		
			echo '<div class="bcf-own-carousel owlGallery img-wrp">';
				echo  wp_kses( get_post_gallery(), business_consultant_finder_alowed_tags() );
			echo '<div class="clearfix"></div></div>';
			
			
				echo '<div class="post-formate"> <i class="fas fa-image"></i> </div></div>';
		else: 
		
			do_action('business_consultant_finder_posts_formats_thumbnail');	
		endif;	
	
	 }

endif;
add_action( 'business_consultant_finder_posts_formats_gallery', 'business_consultant_finder_posts_formats_gallery' ); 




if ( ! function_exists( 'business_consultant_finder_posts_formats_header' ) ) :

	/**
	 * Post business_consultant_finder_posts_blog_media
	 *
	 * @since 1.0.0
	 */
	function business_consultant_finder_posts_blog_media() {
		if( business_consultant_finder_get_option('index_hide_thumb') == true ) return false;
		$formats = get_post_format(get_the_ID()) ;
		
			switch ( $formats ) {
				default:
					do_action('business_consultant_finder_posts_formats_thumbnail');
				break;
				case 'gallery':
					do_action('business_consultant_finder_posts_formats_gallery');
				break;
				case 'audio':
					do_action('business_consultant_finder_posts_formats_audio');
				break;
				case 'video':
					do_action('business_consultant_finder_posts_formats_video');
				break;
			} 
		
		
	 }

endif;

          
add_action( 'business_consultant_finder_posts_blog_media', 'business_consultant_finder_posts_blog_media' ); 






if ( ! function_exists( 'business_consultant_finder_loop_navigation' ) ) :

	/**
	 * Post Posts Loop Navigation
	 *
	 * @since 1.0.0
	 */
	function business_consultant_finder_loop_navigation() {
		
		 $type = get_theme_mod( 'loop_navigation_type', 'default' );
		echo '<div class="col-md-12">';
		if( $type == 'default' ):
		
			the_posts_navigation(
				array(
					'prev_text' => '<span class="btn-content">'.esc_html__('Previous page', 'business-consultant-finder').'</span><span class="icon"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>',
					'next_text' => '<span class="btn-content">'.esc_html__('Next page', 'business-consultant-finder').'</span><span class="icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>',
					'screen_reader_text' => __('Posts navigation', 'business-consultant-finder')
				)
		   );
		echo '<div class="clearfix"></div>';
		else:
		
			echo '<div class="pagination-custom">';
			the_posts_pagination( array(
				'format' => '/page/%#%',
				'type' => 'list',
				'mid_size' => 2,
				'prev_text' => esc_html__( 'Previous', 'business-consultant-finder' ),
				'next_text' => esc_html__( 'Next', 'business-consultant-finder' ),
				'screen_reader_text' => esc_html__( '&nbsp;', 'business-consultant-finder' ),
			) );
		echo '</div>';
		endif;
		echo '</div>';
	}

endif;
add_action( 'business_consultant_finder_loop_navigation', 'business_consultant_finder_loop_navigation', 11 ); 




if ( ! function_exists( 'business_consultant_finder_single_post_navigation' ) ) :

	/**
	 * Post Single Posts Navigation 
	 *
	 * @since 1.0.0
	 */
	function business_consultant_finder_single_post_navigation( ) {
		
		
			$prevPost = get_previous_post(true);
			$nextPost = get_next_post(true);
			if( $prevPost || $nextPost) :
			echo '<div class="col-md-12"><div class="single-prev-next"><div class="row">';
			
			echo '<div class="col-md-6 col-sm-6"><div class="row">';
			if( $prevPost ) :
				
					$prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(40,40) );
					echo '<div class="col-sm-3 order-1  justify-content-center align-self-center">';
					previous_post_link('%link',$prevthumbnail , TRUE); 
					echo '</div>';
					
					echo '<div class="text col-sm-9 order-2 "><h6>'.esc_html__('Previous Article','business-consultant-finder').'</h6>';
						previous_post_link('%link',"<span>%title</span>", TRUE); 
					echo '</div>';
					
				
			endif;
			echo '</div></div>';
			
			
			echo '<div class="col-md-6 col-sm-6"><div class="row">';
			if( $nextPost ) : 
			
					$nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(40,40) );
					echo '<div class="text col-sm-9 order-1 text-right"><h6>'.esc_html__('Next Article','business-consultant-finder').'</h6>';
						next_post_link('%link',"<span>%title</span>", TRUE);
					echo '</div>';
					
					echo '<div class="col-sm-3 text-right order-2 justify-content-center align-self-center">';
						next_post_link('%link',$nextthumbnail, TRUE);
					echo '</div>';
					
				
			endif;
			echo '</div></div>';
			
			
			echo '</div></div></div>';
			
			endif;
			
			
		
	} 

endif;
add_action( 'business_consultant_finder_single_post_navigation', 'business_consultant_finder_single_post_navigation', 10 ); 




if ( ! function_exists( 'business_consultant_finder_posts_blog_heading_title' ) ) :

	/**
	 * Post Posts Loop meta info
	 *
	 * @since 1.0.0
	 */
	function business_consultant_finder_posts_blog_heading_title() {
		
		if ( is_singular() ) :
			the_title( '<h2 class="blog-title entry-heading">', '</h2>' );
		else :
			the_title( '<h2 class="blog-title entry-heading"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
	}

endif;
add_action( 'business_consultant_finder_posts_heading', 'business_consultant_finder_posts_blog_heading_title', 10 ); 
add_action( 'business_consultant_finder_blog_single_content', 'business_consultant_finder_posts_blog_heading_title', 10 ); 


if( ! function_exists( 'business_consultant_finder_blog_loop_content_type' ) && ! is_admin() ) :

    /**
     * @since  1.0.0
     *
     * @param $type
     * @return html
     */
    function business_consultant_finder_blog_loop_content_type( $type = '' ){
		
		
		
      	$type = apply_filters( 'business_consultant_finder_blog_loop_content_type', business_consultant_finder_get_option('blog_loop_content_type') );
		
  		if( ! is_single() && !is_page()):
		
			if ( $type == 'content' ) {
				
				the_content();
				
			}else{
				
				echo wp_kses_post( get_the_excerpt() );
			}
			
		else:
		
			the_content();
			
			
		endif;
      

    }

endif; 
add_action( 'business_consultant_finder_blog_loop_content', 'business_consultant_finder_blog_loop_content_type', 40 ); 

add_action( 'business_consultant_finder_blog_single_content', 'business_consultant_finder_blog_loop_content_type', 20 ); 



if( ! function_exists( 'business_consultant_finder_blog_loop_content_bottom' ) ) :

    /**
     * @since  1.0.0
     *
     * @return html
     */
    function business_consultant_finder_blog_loop_content_bottom( ){
		
		
		$read_more_text = business_consultant_finder_get_option('read_more_text');	
		if ( $read_more_text != "" && 'post' === get_post_type()  && ! is_single() ) {
			printf( '<div class="bottom-info">
			<a href="%1$s" class="theme-btn"><span>%2$s</span><i class="fas fa-angle-double-right"></i>
			</a> </div>
			', 
			esc_url( get_permalink( get_the_ID() ) ),
			esc_html( $read_more_text )
			);
		}
		
		
		 if ( get_edit_post_link() && is_single() ) : 
		
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'business-consultant-finder' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			
		 endif; 
		
    }
	
	add_filter( 'the_content_more_link', '__return_empty_string' ); 
	add_filter( 'excerpt_more', '__return_empty_string' ); 
	add_action( 'business_consultant_finder_blog_loop_content', 'business_consultant_finder_blog_loop_content_bottom', 50 ); 
endif; 



if ( ! function_exists( 'business_consultant_finder_walker_comment' ) ) : 
	/**
	 * Implement Custom Comment template.
	 *
	 * @since 1.0.0
	 *
	 * @param $comment, $args, $depth
	 * @return $html
	 */
	  
	function business_consultant_finder_walker_comment($comment, $args, $depth) {
		
		?>
		<li <?php comment_class( empty( $args['has_children'] ) ? 'comment shift ellipse-left' : 'comment ellipse-left' ) ?> id="comment-<?php comment_ID() ?>">
        
            <div class="single-comment clearfix">
				 <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 80,'','', array('class' => 'float-left') ); ?>
                <div class="comment float-left">
                    <h6><?php echo get_comment_author_link();?></h6>
                    <div class="date"> 
                        <?php
                            /* translators: 1: date, 2: time */
                            printf( esc_html__('%1$s at %2$s', 'business-consultant-finder' ), get_comment_date(),  get_comment_time() ); 
                        ?>
                    </div>
                    
                    <div class="reply"> <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
                            
                   
                    <div class="comment-text"><?php comment_text(); ?></div>
                </div>
            </div>
    
			<div class="clearfix"></div>
	   </li>
       <?php
	}
	
	
endif;

if ( ! function_exists( 'business_consultant_finder_move_comment_field_to_bottom' ) ) : 
	/**
	 * @since 1.0.0
	 *
	 */
	function business_consultant_finder_move_comment_field_to_bottom( $fields ) {
		
		$comment_field = $fields['comment'];
		$cookies_field = $fields['cookies'];
		
		unset( $fields['comment'] );
		unset( $fields['cookies'] );
		
		$fields['comment'] = $comment_field;
		$fields['cookies'] = $cookies_field;
		
		return $fields;
	}
	 
	add_filter( 'comment_form_fields', 'business_consultant_finder_move_comment_field_to_bottom' );

endif;



 