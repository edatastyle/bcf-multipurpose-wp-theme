<?php
/**
 * Should handle post meta display.
 *
 * @package Business_Consultant_Finder
 */

class Business_Consultant_Finder_Hero_Section {
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'business_consultant_finder_header', array( $this, 'render_static_header_banner' ), 999 );
		
	
	}
	/**
	 * Create banner for all page.
	 *
	 * @return string
	 */
	public function render_static_header_banner(){
		
		if (is_front_page() && is_active_sidebar( 'front_page_sidebar' ) ) {
			dynamic_sidebar( 'front_page_sidebar' );
		}else{
				
			
	?>
	<div id="static_header_banner" style=" <?php echo esc_attr( $this->get_header_image() );?> ">
    	<div class="content-text skrollr" data-0="opacity:1; transform:translateY(0px);" data-300="opacity:0; transform:translateY(230px);">
            <div class="container">
                <h1><?php echo esc_html( wp_strip_all_tags( $this->hero_title() ) );?></h1>
            </div>
        </div>
    </div>
	<?php
		}
	}
	/**
	 * Get Header image.
	 *
	 * @return string
	 */
	public function get_header_image() {
		
		$src  	= get_header_image();
		$src 	= apply_filters('business_consultant_finder_static_header_src', esc_url( $src ) );
		$style 	= '';
		
		if( $src !="" ):
			$style = 'background-image:url('. esc_url( $src ) .'); background-repeat:no-repeat; background-position: center center; background-size:cover';
		endif;
		
		return apply_filters('business_consultant_finder_static_header_inline_css_bg', $style );
		
	}
	/**
	 * Get Page Sub Title.
	 *
	 * @return string
	 */
	public function sub_title() {
		$html = '';
		if ( is_archive() ) {
			$html .= get_the_archive_description();
		}else{
			
			if( function_exists( 'get_the_subtitle' ) ){
				$html .= get_the_subtitle();
			}
			
		}
		
		return  apply_filters('business_consultant_finder_sub_title',$html);
	}
	/**
	 * Get Page Title.
	 *
	 * @return string
	 */
	public function hero_title() {
		$html = '';
		if ( is_home() ) {
			
			$html .= bloginfo( 'name' );
		
		} elseif ( is_singular() ) {
			
			$html .= single_post_title( '', false );
			
		} elseif ( is_archive() ) {
			
			$html .= get_the_archive_title();
	
			
		} elseif ( is_search() ) {
		
			$html .= esc_html__( 'Search Results for:', 'business-consultant-finder' );
			$html .= get_search_query();
			
		} elseif ( is_404() ) {
		
			$html .= esc_html__( '404 Error', 'business-consultant-finder' );
			
		}
		
		return  apply_filters('business_consultant_finder_hero_title',$html);
	}
}

new Business_Consultant_Finder_Hero_Section();