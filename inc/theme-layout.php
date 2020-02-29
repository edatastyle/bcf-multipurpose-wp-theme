<?php
/**
 * Business Consultant Finder Theme Layout Function
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business_Consultant_Finder
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'business_consultant_finder_top_bar' ) ) :
	/**
	* Top bar
	*
	*/
	function business_consultant_finder_top_bar (){
		?>

        <div class="hidden-xs" id="top-bar">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-md-9"> <?php echo esc_html( business_consultant_finder_get_option('dialogue') );?> </div>
              <div class="col-xs-12 col-md-3 col-sm-3 hidden-sm right-holder">
              
              
              	<?php if( business_consultant_finder_get_option('social_topbar') == true ):?> 
                
                <ul class="social">
                  <?php  
				  $array = business_consultant_finder_get_option('business_consultant_finder_social_profile_link');
				  
				  if( !empty( $array ) && is_array( $array ) ):
				  
				  foreach ($array['social'] as $key => $link): 
					if( $link != ""):
				  ?>
                  	<li><a class="fab <?php echo esc_attr($key);?>" href="<?php echo esc_url( $link );?>" target="_blank" rel="nofollow"></a></li>
                  <?php 
				  	endif;
				  endforeach;
				  
				  endif;?>
                  
                </ul>
                <?php endif;?>
                
                
              </div>
            </div>
          </div>
        </div>
<?php
	}
	add_action('business_consultant_finder_header','business_consultant_finder_top_bar',10);
endif;

if ( ! function_exists( 'business_consultant_finder_rd_nav_before' ) ) :
	/**
	* Rd Nav starting HTML
	*
	*/
	function business_consultant_finder_rd_nav_before (){
		?>
        <div class="rd-navbar-wrap">
          <nav data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-sm-stick-up-offset="50px" data-lg-stick-up-offset="150px" class="rd-navbar color">
    <?php
	}
	add_action('business_consultant_finder_header','business_consultant_finder_rd_nav_before',20);
endif;



if ( ! function_exists( 'business_consultant_finder_rd_nav_inner_html' ) ) :
	/**
	* Rd Nav inner HTML retrun
	*
	*/
	function business_consultant_finder_rd_nav_inner_html (){
		?>
            <div class="rd-navbar-inner"> 
              <!-- RD Navbar Panel -->
              <div class="rd-navbar-panel">
                <div class="rd-navbar-panel-canvas"></div>
                <?php if ( has_nav_menu( 'menu-1' ) ) { ?>
                <!-- RD Navbar Toggle -->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                <!-- END RD Navbar Toggle --> 
                <?php }?>
                <!-- RD Navbar Collapse Toggle -->
                
                
				<?php
                if ( is_active_sidebar( 'logo-right' ) ) {	
                ?>
                <div class="col-md-8 col-sm-8 header-widget-container" >
                    <div class="row">
                   		<?php dynamic_sidebar( 'logo-right' ); ?>
                    </div>
                </div>
                <?php
                }?>
                
                    
                  
                
                
                <!-- END RD Navbar Collapse Toggle --> 
                
                <!-- RD Navbar Brand -->
                <div class="rd-navbar-brand col-md-4 col-sm-4 site-branding">
				<?php
                if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                	the_custom_logo();
                }else{
                ?>
                 
                  <?php  if ( display_header_text() == true ){  ?>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title">
                  <?php bloginfo( 'name' ); ?>
                  </a>
                  <?php $description = get_bloginfo( 'description', 'display' );
                                    if ( $description ) : ?>
                  <div class="site-description"><?php echo esc_html($description); ?></div>
                  <?php endif; ?>
                  <?php }?>
                  <?php }?>
                </div>
                <!-- END RD Navbar Brand --> 
              </div>
              <!-- END RD Navbar Panel --> 
            </div>
    <?php
	}
	add_action('business_consultant_finder_header','business_consultant_finder_rd_nav_inner_html',30);
endif;



if ( ! function_exists( 'business_consultant_finder_rd_nav_main_menu' ) ) :
	/**
	* Rd Nav end HTML
	*
	*/
	function business_consultant_finder_rd_nav_main_menu (){
		 if ( has_nav_menu( 'menu-1' ) ) {
	?>
        <div class="rd-navbar-outer">
          <div class="rd-navbar-inner">
            <div class="rd-navbar-subpanel">
              <div class="rd-navbar-nav-wrap">
				<?php
					wp_nav_menu( array(
						'theme_location'    => 'menu-1',
						'depth'             => 3,
						'menu_class'  		=> 'menu rd-navbar-nav',
						'container'			=>'ul',
						'walker' => new business_consultant_finder_navwalker(),
						'fallback_cb'       => 'business_consultant_navwalker::fallback',
					) );
					
					
                ?>
              
              </div>
              
              <!-- END RD Navbar Search Toggle --> 
            </div>
          </div>
        </div>
    <?php
		 }
	}
	add_action('business_consultant_finder_header','business_consultant_finder_rd_nav_main_menu',40);
endif;



if ( ! function_exists( 'business_consultant_finder_rd_nav_after' ) ) :
	/**
	* Rd Nav end HTML
	*
	*/
	function business_consultant_finder_rd_nav_after (){
	?>
      </nav>
    </div>
	<?php
	}
	add_action('business_consultant_finder_header','business_consultant_finder_rd_nav_after',100);
endif;


if ( ! function_exists( 'business_consultant_finder_footer_widgets' ) ) :
	/**
	* Footer copy right container
	*
	*/
	function business_consultant_finder_footer_widgets (){
	if ( is_active_sidebar( 'footer' ) ) {	
	?>
	<div id="footer-widget">
    	<div class="container">
        	<div class="row">
            	<?php dynamic_sidebar( 'footer' ); ?>
            </div>
        </div>
    </div>
	<?php
	}
	}
	add_action('business_consultant_finder_footer','business_consultant_finder_footer_widgets',5);
endif;

if ( ! function_exists( 'business_consultant_finder_footer' ) ) :
	/**
	* Footer copy right container
	*
	*/
	function business_consultant_finder_footer (){
	?>
	<div class="bottom-bar">
  	<?php
        if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
        	the_custom_logo();
        }
     ?>
 	 <div class="copyright">
     <?php
	 	if( business_consultant_finder_get_option('copyright_text') != '' ) {
			echo esc_html(  business_consultant_finder_get_option('copyright_text') );
		}else{
          /* translators: 1: Current Year, 2: Blog Name  */
          sprintf( esc_html__( 'Copyright &copy; %1$s %2$s All Right Reserved.', 'business-consultant-finder' ), esc_attr( date( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) );
		}
        ?>
      </div>
      <div class="site-info">
    	<?php
                /* translators: 1: Theme Developer 2: WordPress. */
                printf( esc_html__( 'Theme %3$s By %1$s - Proudly powered by %2$s .', 'business-consultant-finder' ), '<a href="https://athemeart.com/" target="_blank" rel="nofollow">aThemeArt</a>', '<a href="https://wordpress.org" target="_blank">WordPress</a>','<a href="https://athemeart.com/downloads/business-consultant-finder/" target="_blank" rel="nofollow">BCF</a>' );
                ?>
      </div>
      
		<?php if( business_consultant_finder_get_option('social_topbar') == true ):?> 
        
        <ul class="social-inline">
          <?php  
          $array = business_consultant_finder_get_option('business_consultant_finder_social_profile_link');
          
          if( !empty( $array ) && is_array( $array ) ):
          
          foreach ($array['social'] as $key => $link): 
            if( $link != ""):
          ?>
            <li><a class="fab <?php echo esc_attr($key);?>" href="<?php echo esc_url( $link );?>" target="_blank" rel="nofollow"></a></li>
          <?php 
            endif;
          endforeach;
          
          endif;?>
          
        </ul>
        <?php endif;?>
      
    </div>
	<?php
	}
	add_action('business_consultant_finder_footer','business_consultant_finder_footer',100);
endif;

if ( ! function_exists( 'business_consultant_finder_footer_helper' ) ) :
	/**
	* Web site helper content load
	*
	*/
	function business_consultant_finder_footer_helper (){
	?>
	<a href="javascript:void(0)" id="ui-to-top" class="ui-to-top active"><?php echo esc_html__( 'BACK TO TOP', 'business-consultant-finder' );?><i class="fas fa-angle-double-up"></i></a>
	<?php
	}
	add_action('business_consultant_finder_footer','business_consultant_finder_footer_helper',999);
endif;



if ( ! function_exists( 'business_consultant_finder_container_before' ) ) :
	/**
	* Main container before html 
	*
	*/
	function business_consultant_finder_container_before (){
	?>
    <div id="content" class="site-content container">
      <div class="row">
    <?php
	}
	add_action('business_consultant_finder_container_before','business_consultant_finder_container_before',5);
endif;

if ( ! function_exists( 'business_consultant_finder_content_column_start' ) ) :
	/**
	* Main container before html 
	*
	*/
	function business_consultant_finder_content_column_start ( $layout = NULL ){
		
		switch ( $layout ) {
			case 'sidebar-content':
				$layout = 'col-md-8 order-2 bcf-main-content';
				break;
			case 'no-sidebar':
				$layout = 'col-md-12 bcf-main-content';
				break;
			default:
				$layout = 'col-md-8 order-1 bcf-main-content';
		} 
		 	
	$column = apply_filters( 'business_consultant_finder_content_column',  esc_attr( $layout ) );
	?>
    <div class="<?php echo esc_attr( $column );?>">
      <div id="primary" class="content-area blog-loop-wrp">
        <main id="main" class="site-main row">
    <?php
	}
	add_action('business_consultant_finder_container_before','business_consultant_finder_content_column_start',999);
endif;

if ( ! function_exists( 'business_consultant_finder_content_column_end' ) ) :
	/**
	* Main container before html 
	*
	*/
	function business_consultant_finder_content_column_end (){
		
	?>
        </main>
        <!-- #main --> 
      </div>
      <!-- #primary --> 
    </div>
    <?php
	}
	add_action( 'business_consultant_finder_container_after','business_consultant_finder_content_column_end',5 );
endif;



if ( ! function_exists( 'business_consultant_finder_sidebar' ) ) :
	/**
	* retrun sidebar 
	*
	*/
	function business_consultant_finder_sidebar ( $layout = NULL ){
		switch ( $layout ) {
			case 'sidebar-content':
				$layout = 'col-md-4 order-1 bcf-sidebar';
				break;
			case 'no-sidebar':
				return false;
				break;
			default:
				$layout = 'col-md-4 order-2 bcf-sidebar';
		}
		$column = apply_filters( 'business_consultant_finder_sidebar_before',  esc_attr( $layout ) );	
		
	?>
    <div class="<?php echo esc_attr( $column );?>">
      <?php get_sidebar(); ?>
    </div>
    <?php
	}
	add_action( 'business_consultant_finder_container_after','business_consultant_finder_sidebar',10 );
endif;

if ( ! function_exists( 'business_consultant_finder_container_after' ) ) :
	/**
	* Main container before html 
	*
	*/
	function business_consultant_finder_container_after (){
	?>
      </div>
    </div>
	<?php
	}
	add_action('business_consultant_finder_container_after','business_consultant_finder_container_after',999);
endif;
