<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Example widget using class
 * business-consultant-finder
 * DEMO: Include this file in your theme functions.php file or plugin
 */
class BusinessConsultantFinderHeaderWidget {
    
    /**
     * Unique widget id used for custom inline css
     * @var string
     */
    private $widget_id;
    
	/**
	 * Constructor
	 */
    public function __construct() {
        
        /**
         * Add widget via builder
         */
        $this->map_and_init();
    }
    
    /**
     * Render widget frontend view
     * 
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance The settings for the particular instance of the widget.
     * @param array $form_fields Widget admin form fields configuration array
     * @param string $this->id Widget generated unique id by instance number. 
     *                        Can be used to target this widget instance only
	 * @param string $widget_id Widget generated unique id by instance number. 
	 *                        Can be used to target this widget instance only
     */
    public function render_view( $args, $instance, $form_fields, $widget_id ) {
		
		/**
		 * Please note: 
		 * $instance will hold all admin form fields values
		 */
		
		// Unique widget id used for custom inline css
        $this->widget_id = $widget_id;
        
		// Set widget title
		$widget_title = isset( $instance['title'] ) ? $instance['title'] : '';
		$description = isset( $instance['description'] ) ? $instance['description'] : '';
		$fa_icon = isset( $instance['fa_iconpicker_field_name'] ) ? $instance['fa_iconpicker_field_name'] : '';
			  
        
        // before and after widget arguments are defined by themes
       
		echo wp_kses( $args['before_widget'], business_consultant_finder_alowed_tags() );
		if ( ! empty( $fa_icon ) ) {
            echo '<i class="fas fa-headphones '.esc_attr( $fa_icon ).'"></i>';
        }
        echo '<div class="pull-right">';
        if ( ! empty( $widget_title ) ) {
            echo  wp_kses( $args['before_title'], business_consultant_finder_alowed_tags() ). esc_html( $widget_title ) . wp_kses( $args['after_title'], business_consultant_finder_alowed_tags() ) ;
        }
		if ( ! empty( $description ) ) {
            echo '<h6 class="k2d">'. esc_html( $description ) . '</h6>';
        }
      
		
		/**
		 * Widget html output start
		 */
		echo '</div>';
		// before and after widget arguments are defined by themes
       
        echo wp_kses( $args['after_widget'], business_consultant_finder_alowed_tags() );
     
    }
    
   
    
    /**
     * Map and init blog posts widget widget
     */
    public function map_and_init() {

        $config = array(

            // Core configuration
			
			/**
             * Unique widget id
             * @var string (required)
             */
            'base_id' => 'business-consultant-finder-header-widget',
			
			/**
             * Widget name
             * @var string (required)
             */
            'name' => esc_html__('+ Header Right Icon / Text', 'business-consultant-finder'),
			
			/**
             * Widger callback function to render frontend html
             * 
             * If use class callback, the class instance must be used
             * If you use array('MyClassName', 'method') than __autoload will not fire properly when
             * a not-yet-loaded class was invoked through a PHP command
			 * 
             * @var string|array String if function name is passed, if using class method than it will be array (required)
             */
            'callback' => array( $this, 'render_view' ),
			
			/**
             * Widget Options
             * Option array passed to wp_register_sidebar_widget() using $options.
             * @see https://codex.wordpress.org/Function_Reference/wp_register_sidebar_widget
             * @var array|string (optional)
             */
            'widget_ops' => array(
                'classname' => 'business-consultant-finder-header-widget-class',
                'description' => esc_html__( 'Your Logo right Side Text', 'business-consultant-finder' ),
                'customize_selective_refresh' => false,
            ),
			
			/**
             * Width and height of the widget
             * Option array passed to wp_register_widget_control() using $options.
             * @see https://codex.wordpress.org/Function_Reference/wp_register_widget_control
             * @var array|string (optional)
             */
            'control_ops' => array( 
                'width' => 400, 
                'height' => 350 
            ),

			/**
             * Field arguments
             * @see field reference for supported field types
             */
            'form_fields' => array(
				
				/**
				 * Please note:
				 * 
				 * array key is required. It should be unique string for widget admin form. 
				 * String may contain only lowercase letters and underlines
				 * It will be used as name and id.
				 * Also you will get values on frontend using this key
				 */
				
				'title' => array(
					'type' => 'text', // Required  // Input type: text, password, search, tel, button
					'label' => esc_html__( 'Title:', 'business-consultant-finder' ), // Optional
					'placeholder' => esc_html__( 'Get in Touch', 'business-consultant-finder' ), // Optional
				),
				
				/**
				 * When echo textarea content use this fucntion to preserve new lines (convert them to <br />)
				 * wp_kses_post( nl2br( $description ) )
				 */
				'description' => array(
					'type' => 'textarea', // Required
					'label' => esc_html__( 'Description', 'business-consultant-finder' ), // Optional
					'placeholder' => esc_html__( 'Enter description here', 'business-consultant-finder' ), // Optional
					'default' => esc_html__( '+(012) 345 6789', 'business-consultant-finder' ) // Optional
				),
				
	            /**
	             * FontAwesome iconpicker field
	             *
	             * Iconpicker type can be used to insert your own icons.
	             * You need to add styles to widgets admin screen, than use filter "predic_widget_fa_iconpicker_icons_array" to add your icons.
	             * Last step is to use the "holder" argument to define your icon html element. This is default value "<i class="fa %s" aria-hidden="true"></i>",
	             * please note that %s stands for your icon class name that will be inserted automatically
	             */
				'fa_iconpicker_field_name' => array(
					'type' => 'fa-iconpicker', // Required
					'label' => esc_html__( 'Iconpicker FontAwesome', 'business-consultant-finder' ), // Optional
					'default' => 'fa-map-marker', // Optional
					'holder' => '', // Optional
					
				)
				
            )

        );
        
		// Init widget
        if ( function_exists( 'predic_widget' ) ) {
            predic_widget()->add_widget( $config );
        }
    }
}
new BusinessConsultantFinderHeaderWidget();