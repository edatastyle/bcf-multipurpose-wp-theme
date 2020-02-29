<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Consultant_Finder
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area col-md-12" >

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
        <div class="details-page-inner-box comment-meta mt-70" data-aos="fade-up">
		<h4 class="comments-title">
			<?php
			$Business_Consultant_Finder_comment_count = get_comments_number();
			if ( '1' === $Business_Consultant_Finder_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'business-consultant-finder' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $Business_Consultant_Finder_comment_count, 'comments title', 'business-consultant-finder' ) ),
					number_format_i18n( $Business_Consultant_Finder_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h4><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'short_ping' => true,
				'callback' => 'Business_Consultant_Finder_walker_comment',
			) );
			?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'business-consultant-finder' ); ?></p>
			<?php
		endif;
	?>
    </div>
    
    
    <?php
	endif; // Check for have_comments().
	?>
     <?php 
		$commenter = wp_get_current_commenter();
		$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

	$args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author' =>'<div class="col-xl-4 col-lg-6 col-md-4 col-12">' . '<input id="author" placeholder="' . esc_attr__( 'Your Name', 'business-consultant-finder'  ) . '" name="author" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30" />'.
				( $req ? '<span class="required">*</span>' : '' )  .
				'</div>'
				,
			'email'  => '<div class="col-xl-4 col-lg-6 col-md-4 col-12">' . '<input id="email" placeholder="' . esc_attr__( 'Your Email', 'business-consultant-finder'  ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" />'  .
				( $req ? '<span class="required">*</span>' : '' ) 
				 .
				'</div>',
			'url'    => '<div class="col-xl-4 col-lg-6 col-md-4 col-12">' .
			 '<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'business-consultant-finder' ) . '" type="text" value="' . esc_url( $commenter['comment_author_url'] ) . '" size="30" /> ' .
			
	           '</div>',
			'cookies'    =>  '<p class="comment-form-cookies-consent col-12"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="fas fa-check" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">'.esc_html__( 'Save my name, email, and website in this browser for the next time I comment.','business-consultant-finder' ) .'</label></p>',
			   
			   
		)
	),
		'comment_field' =>  '<div class="col-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  placeholder="' . esc_attr__( 'Comment', 'business-consultant-finder' ) . '">' .
		'</textarea></div>',
		
		
		'class_form'      => 'row',
		'submit_button' => '<button type="submit" class="theme-btn" id="submit-new"><span>'. esc_html__( 'Post Comment', 'business-consultant-finder' ) .'</span></button>',
		'title_reply_before'   => ' <h4 class="custom-title">',
		'title_reply_after'    => '</h4>',
		'comment_notes_before' => '<p class="comment-notes col-12">' . esc_html__( 'Your email address will not be published. Required fields are marked *.','business-consultant-finder' ) . '</p>',
		'comment_notes_after'  => '<div class="form-allowed-tags col-12"><div class="text-wrp">' ./* translators: 1: title. */ sprintf( esc_html__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'business-consultant-finder' ), ' <code>' . allowed_tags() . '</code>' ) . '</div></div>',
		
);
	?>
    <div class="details-page-inner-box comment-form mt-70" data-aos="fade-up">
    
    <?php comment_form($args);?>
  
    </div>

</div><!-- #comments -->
