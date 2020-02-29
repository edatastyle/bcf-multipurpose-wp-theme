<?php
/**
 * Futurio admin notify
 *
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'BusinessConsultantFinder_Notify_Admin' ) ) :

	/**
	 * The Futurio admin notify
	 */
	class BusinessConsultantFinder_Notify_Admin {
		
		/**
		* The single instance of the class
		*
		* @var ATA_WC_Variation_Swatches_Admin
		*/
		protected $theme_name;	
		/**
		* The single instance of the class
		*
		* @var ATA_WC_Variation_Swatches_Admin
		*/
		protected $pro_url;	
		/**
		 * Setup class.
		 *
		 */
		public function __construct() {
			$this->theme_name =  apply_filters( 'bcf_theme_name', 'Business Consultant Finder');
			$this->pro_url =  apply_filters( 'bcf_pro_url', 'https://athemeart.com/downloads/business-consultant-finder/');
			
			add_action( 'admin_menu', array( $this, 'admin_menu',5 ) );
			
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			
			add_action( 'admin_notices', array( $this, 'admin_notices' ), 99 );
			
			add_action( 'wp_ajax_business_consultant_finder_dismiss_notice', array( $this, 'dismiss_nux' ) );
			
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action('after_switch_theme', array( $this, 'business_consultant_finder_setup_options' ) );
		}
		public function business_consultant_finder_setup_options(){
			
			update_option( 'business_consultant_finder_admin_notice_dismissed', false );
		}
		/**
		 * Enqueue scripts.
		 *
		 */
		public function enqueue_scripts() {
			global $wp_customize;

			if ( isset( $wp_customize ) ) {
				return;
			}
			
			
			
			wp_enqueue_style( 'business-consultant-finder-admin', get_template_directory_uri() . '/assets/admin/admin.css', '', '1' );

			wp_enqueue_script( 'business-consultant-finder-admin', get_template_directory_uri() . '/assets/admin/admin.js', array( 'jquery', 'updates' ), '1', 'all' );

			$business_consultant_finder_notify = array(
				'nonce' => wp_create_nonce( 'business_consultant_finder_notice_dismiss' )
			);

			wp_localize_script( 'business-consultant-finder-admin', 'businessconsultantfinderNUX', $business_consultant_finder_notify );
		}

		/**
		 * Output admin notices.
		 *
		 */
		public function admin_notices() {
			global $pagenow;
			
			
			if ( ( 'themes.php' != $pagenow ) || get_option( 'business_consultant_finder_admin_notice_dismissed' ) ) {
				return;
			}
			?>

			<div class="notice notice-info sf-notice-nux is-dismissible">
				
				<?php if (current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) : ?>
				<div class="notice-content">
					
                    <h4><?php printf( /* translators: %s: plugin name. */  esc_html__( 'Thank you for choosing Business Consultant Finder( BCF ) Theme! To take full advantage of all the features this theme has to offer number of plugins, please install and activate all plugins.', 'business-consultant-finder' ), '<a href="' . esc_url( admin_url( 'themes.php?page=edsbootstrap-welcome' ) ) . '">', '</a>' ); ?></h4>
                    
                    <p class="submit">
                    <a href="<?php echo esc_url( admin_url( 'themes.php?page=welcome' ) ); ?>" class="button button-primary" style="text-decoration: none;">
                    <?php esc_html_e( 'Get started', 'business-consultant-finder' ); ?>
                    
                    </a>
                    <a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>"><?php esc_html_e( 'Begin installing plugins', 'business-consultant-finder' ); ?></a>
                    </p>
                    <br />

                       
				</div>
                
                <?php endif; ?>
			</div>
			<?php
		}

		/**
		 * AJAX dismiss notice.
		 *
		 * @since 2.2.0
		 */
		public function dismiss_nux() {
			$nonce = !empty( $_POST[ 'nonce' ] ) ? sanitize_text_field( wp_unslash( $_POST[ 'nonce' ] ) ) : false;

			if ( !$nonce || !wp_verify_nonce( $nonce, 'business_consultant_finder_notice_dismiss' ) || !current_user_can( 'manage_options' ) ) {
				die();
			}
			if ( isset( $_POST['action'] ) &&  $_POST['action'] != 'business_consultant_finder_dismiss_notice' ) {
				die();
			}
			update_option( 'business_consultant_finder_admin_notice_dismissed', true );
		}
		
		
		
		
	
		
	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		
		$page = add_theme_page( esc_attr__( 'Business Consultant Finder', 'business-consultant-finder' ) , 
		esc_attr__( 'Business Consultant Finder', 'business-consultant-finder' ), 
		'activate_plugins', 
		'welcome', array( $this, 'welcome_screen' ) );
		
	}
	
	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
	?>
    <div class="bcf-header">
        <h1><?php echo esc_html( $this->theme_name );?></h1>
        <a class="bcf-upgrade" target="_blank" href="<?php echo esc_url( $this->pro_url );?>">
        	<?php esc_html_e( ' Upgrade Now ', 'business-consultant-finder' );?>
        </a>
        <div class="clearfix"></div>
    </div>
    <div class="bcf-row-container">
    	<div class="bcf-row">
        	<div class="bcf-col-3">
                <div class="bcf-box">
                	<div class="bcf-box-top"><?php echo esc_html__('Theme Customizer', 'business-consultant-finder');?></div>
                   
                    <div class="bcf-box-content">
                    	<p><?php echo esc_html__('All Theme Options are available via Customize screen.', 'business-consultant-finder');?></p>
                         <p> <a href="<?php echo esc_url( admin_url( 'customize.php' ) );?>" class="button action-btn"> <?php echo  esc_html__( 'Customize', 'business-consultant-finder' );?> </a> </p>
                    </div>
                </div>
            </div>
            <div class="bcf-col-3">
                <div class="bcf-box">
                	<div class="bcf-box-top"><?php echo esc_html__('Ready to import sites', 'business-consultant-finder');?></div>
                
                    <div class="bcf-box-content">
                    
                    	<p><?php echo esc_html__('Import your favorite site with one click and start your project in style!', 'business-consultant-finder');?></p>
                        
                        
                        <?php if ( is_plugin_active( 'athemeart-theme-helper/athemeart-theme-helper.php' ) ) : ?>
                        
                         <p> <a href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import') );?>" class="button action-btn"> <?php echo  esc_html__( 'See Library', 'business-consultant-finder' );?> </a> </p>
                         
                        <?php else : ?>
                        
                        
                        <a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) );?>" class="button action-btn"> <?php echo  esc_html__( 'Begin installing plugins', 'business-consultant-finder' );?> </a> 
                        
                        <?php endif;?>
                        
                        
                    </div>
                </div>
            </div>
            
                        
            <div class="bcf-col-3">
                <div class="bcf-box">
                	<div class="bcf-box-top"><?php echo esc_html__('Recommend Plugins', 'business-consultant-finder');?></div>
                   
                    <div class="bcf-box-content">
                         
                       <?php if ( !is_plugin_active( 'athemeart-theme-helper/athemeart-theme-helper.php' ) ) : ?>
                         <p><?php echo esc_html__('To take full advantage of all the features this theme has to offer number of plugins, please install and activate all plugins.', 'business-consultant-finder');?></p>
                         <p> 
                         <a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) );?>" class="button action-btn"> <?php echo  esc_html__( 'Begin installing plugins', 'business-consultant-finder' );?> </a> 
                         </p>
                         <?php else: ?>
                         <p><?php echo esc_html__('Thanks your for installed theme recommended plugins', 'business-consultant-finder');?></p>
                         <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
       
        <div class="bcf-row">
        
       		<div class="bcf-col-3" style="width:62%;">
                <div class="bcf-box">
                	<div class="bcf-box-top"><?php echo esc_html__( 'Changelog', 'business-consultant-finder' );?></div>
                  
                    <div class="bcf-box-content">
                          <code class="cd-box-content cd-modules">
                          <?php
                          global $wp_filesystem;
                          $changelog_file = apply_filters( 'athemeart_changelog_file', get_template_directory() . '/readme.txt' );
                            if ( $changelog_file && is_readable( $changelog_file ) ) {
                                    WP_Filesystem();
                                    $changelog = $wp_filesystem->get_contents( $changelog_file );
                                    $changelog_list = $this->parse_changelog( $changelog );
                
                                    echo wp_kses_post( $changelog_list );
                                }
                          ?>
                          </code>
                    </div>
                </div>
            </div>
            
            <div class="bcf-col-3">
                <div class="bcf-box">
                	<div class="bcf-box-top"><?php echo esc_html__('Need more features?', 'business-consultant-finder');?></div>
                   
                    <div class="bcf-box-content">
                    	<p><?php echo esc_html__('Get the Pro version for more stunning elements, demos and Theme options.', 'business-consultant-finder');?></p>
                         <p> <a target="_blank" href="<?php echo esc_url( $this->pro_url );?>" class="button action-btn"> <?php echo  esc_html__( 'Upgrade to PRO Version ', 'business-consultant-finder' );?> </a> </p>
                    </div>
                </div>
            </div>
            
            
        <div class="clearfix"></div>
        </div>
        
        
        
    </div>
    <?php
	}
	
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}
	}

	endif;

return new BusinessConsultantFinder_Notify_Admin();



