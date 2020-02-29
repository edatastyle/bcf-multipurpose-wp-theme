<?php 

/**
 * Theme Options Panel.
 *
 * @package business-consultant-finder
 */

$default = business_consultant_finder_get_default_theme_options();
global $wp_customize;



// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'business-consultant-finder' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
	)
);

// Global Section Start.*/

		$wp_customize->add_section( 'social_option_section_settings',
			array(
				'title'      => esc_html__( 'Global Options', 'business-consultant-finder' ),
				'priority'   => 10,
				'capability' => 'edit_theme_options',
				'panel'      => 'theme_option_panel',
			)
		);
		
		/*Social Profile*/
		$wp_customize->add_setting( 'dialogue',
			array(
				'default'           => $default['dialogue'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'dialogue',
			array(
				'label'    => esc_html__( 'Topbar dialogue', 'business-consultant-finder' ),
				'section'  => 'social_option_section_settings',
				'type'     => 'text',
				
			)
		);

		/*Social Profile*/
		$wp_customize->add_setting( 'social_topbar',
			array(
				'default'           => $default['social_topbar'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'business_consultant_finder_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'social_topbar',
			array(
				'label'    => esc_html__( 'Social Link Topbar', 'business-consultant-finder' ),
				'section'  => 'social_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		/*Social Profile*/
		$wp_customize->add_setting( 'social_footer',
			array(
				'default'           => $default['social_footer'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'business_consultant_finder_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'social_footer',
			array(
				'label'    => esc_html__( 'Social Link Footer', 'business-consultant-finder' ),
				'section'  => 'social_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		
		
		/*
		Social media
		*/
		$business_consulting_options['social']['fa-facebook']= array(
			'label' => esc_html__('Facebook URL', 'business-consultant-finder')
		);
		$business_consulting_options['social']['fa-twitter']= array(
			'label' => esc_html__('Twitter URL', 'business-consultant-finder')
		);
		$business_consulting_options['social']['fa-pinterest']= array(
			'label' => esc_html__('pinterest URL', 'business-consultant-finder')
		);
		$business_consulting_options['social']['fa-youtube']= array(
			'label' => esc_html__('Youtube URL', 'business-consultant-finder')
		);
		$business_consulting_options['social']['fa-instagram']= array(
			'label' => esc_html__('Instagram URL', 'business-consultant-finder')
		);
		
		foreach( $business_consulting_options as $key => $options ):
			foreach( $options as $k => $val ):
				// SETTINGS
				if ( isset( $key ) && isset( $k ) ){
					$wp_customize->add_setting('business_consultant_finder_social_profile_link['.$key .']['. $k .']',
						array(
							'default'           => esc_url( $default['social_profile_link'] ),
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'esc_url_raw'
						)
					);
					// CONTROLS
					$wp_customize->add_control('business_consultant_finder_social_profile_link['.$key .']['. $k .']', 
						array(
							'label'		 => esc_attr( $val['label'] ), 
							'section'    => 'social_option_section_settings',
							'type'       => 'url',
							
						)
					);
				}
			
			endforeach;
		endforeach;


/*Posts management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Blog Management', 'business-consultant-finder' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Posts Layout*/
		$wp_customize->add_setting( 'blog_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'business_consultant_finder_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_layout',
			array(
				'label'    => esc_html__( 'Blog Layout Options', 'business-consultant-finder' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'business-consultant-finder' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'business-consultant-finder' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'business-consultant-finder' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'business-consultant-finder' ),
					),
				'type'     => 'select',
				
			)
		);
		
		
		
		/*Blog Loop Content*/
		$wp_customize->add_setting( 'blog_loop_content_type',
			array(
				'default'           => $default['blog_loop_content_type'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'business_consultant_finder_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_loop_content_type',
			array(
				'label'    => esc_html__( 'Archive Content Type', 'business-consultant-finder' ),
				'description' => esc_html__( 'Choose Archive, Blog Page Content type as default', 'business-consultant-finder' ),
				'section'  => 'theme_option_section_settings',
				'choices'               => array(
					'excerpt' => __( 'Excerpt', 'business-consultant-finder' ),
					'content' => __( 'Content', 'business-consultant-finder' ),
					),
				'type'     => 'select',
				
			)
		);
		
		/*Social Profile*/
		$wp_customize->add_setting( 'read_more_text',
			array(
				'default'           => $default['read_more_text'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'read_more_text',
			array(
				'label'    => esc_html__( 'Read more text', 'business-consultant-finder' ),
				'description' => esc_html__( 'Leave empty to hide', 'business-consultant-finder' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'text',
				
			)
		);
		
		/*Social Profile*/
		$wp_customize->add_setting( 'index_hide_thumb',
			array(
				'default'           => $default['index_hide_thumb'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'business_consultant_finder_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'index_hide_thumb',
			array(
				'label'    => esc_html__( 'Hide post thumbnail / Media ?', 'business-consultant-finder' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
/*Posts management section start */
$wp_customize->add_section( 'page_option_section_settings',
	array(
		'title'      => esc_html__( 'Page Management', 'business-consultant-finder' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	
		/*Home Page Layout*/
		$wp_customize->add_setting( 'page_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'business_consultant_finder_sanitize_select',
			)
		);
		$wp_customize->add_control( 'page_layout',
			array(
				'label'    => esc_html__( 'Page Layout Options', 'business-consultant-finder' ),
				'section'  => 'page_option_section_settings',
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'business-consultant-finder' ),
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'business-consultant-finder' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'business-consultant-finder' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'business-consultant-finder' ),
					),
				'type'     => 'select',
				'priority' => 170,
			)
		);


		// Footer Section.
		$wp_customize->add_section( 'footer_section',
			array(
			'title'      => esc_html__( 'Copyright', 'business-consultant-finder' ),
			'priority'   => 130,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
			)
		);
		
		// Setting copyright_text.
		$wp_customize->add_setting( 'copyright_text',
			array(
			'default'           => $default['copyright_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'copyright_text',
			array(
			'label'    => esc_html__( 'Footer Copyright Text', 'business-consultant-finder' ),
			'section'  => 'footer_section',
			'type'     => 'text',
			'priority' => 120,
			)
		);
		
		
			// Footer Section.
		$wp_customize->add_section( 'demo_content',
			array(
			'title'      => esc_html__( 'Import demo content', 'business-consultant-finder' ),
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
			)
		);
		
		 $wp_customize->add_setting( 'demo_content_import',
			array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		 );
		
		$wp_customize->add_control( new Business_Consultant_Finder_Demo_Content_Import( $wp_customize, 'textarea_setting', array(
			'description' => esc_html__( 'Import your favorite site with one click and start your project in style!', 'business-consultant-finder' ),
			'section' => 'demo_content',
			'settings'   => 'demo_content_import',
			'img_link'  => esc_url( get_template_directory_uri() . '/assets/images/demo.png' )
		) ) );



		