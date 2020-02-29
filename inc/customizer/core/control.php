<?php
/**
 * Custom Customizer Controls.
 *
 * @package business-consultant-finder
 */

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Business_Consultant_Finder_Customize_Section_Upsell extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */

class Business_Consultant_Finder_Demo_Content_Import extends WP_Customize_Control {
	/**
	* The type of customize section being rendered.
	*
	* @since  1.0.0
	* @access public
	* @var    string
	*/
	public $type = 'demo-content';
	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $img_link = '';
	
	
	/**
	 * Render the control's content.
	 *
	 * @since 3.4.0
	 */
	public function render_content() {
		do_action( 'athemeart_theme_helper' );
		if ( is_plugin_active( 'athemeart-theme-helper/athemeart-theme-helper.php' )) :
	  ?>
      	<div>
      	<?php if( $this->img_link != "" ) :?><br/>
        	<img src="<?php echo esc_url( $this->img_link );?>" />
        <?php endif;?>
        <p><?php echo esc_html( $this->description ); ?></p>
        <a class="demo-now button-secondary button change-theme" href="<?php echo esc_url_raw( self_admin_url( 'themes.php?page=pt-one-click-demo-import' ) ); ?>">
            <?php esc_html_e( 'See Library', 'business-consultant-finder' ); ?>
        </a>
        </div>
        <?php
		else:
		?>
         <p><?php echo esc_html__('To take full advantage of all the features this theme has to offer number of plugins, please install and activate all plugins.', 'business-consultant-finder');?></p>
                        
                        <a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) );?>" class="button action-btn"> <?php echo  esc_html__( 'Begin installing plugins', 'business-consultant-finder' );?> </a> 
        <?php
		endif;
		
	}
}


