<?php
/**
 * Should handle post meta display.
 *
 * @package Business_Consultant_Finder
 */

class Business_Consultant_Finder_Post_Meta {
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'business_consultant_finder_post_meta_archive', array( $this, 'render_meta_list' ), 10, 2 );
		add_action( 'business_consultant_finder_post_meta_single', array( $this, 'render_meta_list' ) );
		add_action( 'business_consultant_finder_do_tags', array( $this, 'render_tags_list' ) );
		
	
	}

	/**
	 * Render meta list.
	 *
	 * @param array $order the order array. Passed through the action parameter.
	 */
	public function render_meta_list( $order, $wrp_class = '' ) {
		if ( ! is_array( $order ) || empty( $order ) ) {
			return;
		}
		$order  = $this->sanitize_order_array( $order );
		$markup = '';

		$markup .= '<ul class="bcf-meta-list '.esc_attr( $wrp_class ).'">';
		foreach ( $order as $meta ) {
			switch ( $meta ) {
				case 'author':
					
					$markup .= '<li><div class="post-by">';
					
					$markup .= ' <span>'.esc_html__( 'By -','business-consultant-finder' ).'</span>';
					$markup .= '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';
					$markup .= '</div></li>';
					break;
				case 'date':
					$markup .= '<li class="meta date posted-on">';
					$markup .= esc_html__( 'Posted on ','business-consultant-finder' );
					$markup .= $this->get_time_tags();
					$markup .= '</li>';
					break;
				case 'category':
					$markup .= '<li class="meta category">';
					$markup .= esc_html__( 'Posted in ','business-consultant-finder' );
					$markup .= get_the_category_list( ', ', get_the_ID() );
					$markup .= '</li>';
					break;
				case 'comments':
					$comments = $this->get_comments();
					if ( empty( $comments ) ) {
						break;
					}
					$markup .= '<li class="meta comments">';
					$markup .= $comments;
					$markup .= '</li>';
					break;
					
				case 'default':
					break;
				default:
					break;
			}
		}
		$markup .= '</ul>';

		echo wp_kses( $markup, business_consultant_finder_alowed_tags() );
	}

	/**
	 * Get the comments with a link.
	 *
	 * @return string
	 */
	private function get_comments() {
		$comments_number = get_comments_number();
		if ( ! comments_open() ) {
			return '';
		}
		if ( $comments_number == 0 ) {
			return '';
		} else {
			/* translators: %s: number of comments */
			$comments = sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'business-consultant-finder' ), $comments_number );
		}

		return '<a href="' . esc_url( get_comments_link() ) . '">' . esc_html( $comments ) . '</a>';
	}

	/**
	 * Makes sure there's a valid meta order array.
	 *
	 * @param array $order meta order array.
	 *
	 * @return mixed
	 */
	private function sanitize_order_array( $order ) {
		$allowed_order_values = array(
			'author',
			'date',
			'category',
			'comments',
		);
		foreach ( $order as $index => $value ) {
			if ( ! in_array( $value, $allowed_order_values ) ) {
				unset( $order[ $index ] );
			}
		}

		return $order;
	}

	/**
	 * Render the tags list.
	 */
	public function render_tags_list() {
		$tags = get_the_tags();
		if ( ! is_array( $tags ) ) {
			return;
		}
		$html  = '<div class="bcf-tags-list">';
		$html .= '<span>' . esc_html__( 'Tags', 'business-consultant-finder' ) . ':</span>';
		foreach ( $tags as $tag ) {
			$tag_link = get_tag_link( $tag->term_id );
			$html    .= '<a href=' . esc_url( $tag_link ) . ' title="' . esc_attr( $tag->name ) . '" class=' . esc_attr( $tag->slug ) . ' rel="tag">';
			$html    .= esc_html( $tag->name ) . '</a>';
		}
		$html .= ' </div> ';
		echo wp_kses_post( $html );
	}

	/**
	 * Get <time> tags.
	 *
	 * @return string
	 */
	private function get_time_tags() {
		$time = '<time class="entry-date published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" content="' . esc_attr( get_the_date( 'Y-m-d' ) ) . '">' . esc_html( get_the_date() ) . '</time>';
		if ( get_the_time( 'U' ) === get_the_modified_time( 'U' ) ) {
			return $time;
		}
	//	$time .= '<time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time>';

		return $time;
	}
}

new Business_Consultant_Finder_Post_Meta();