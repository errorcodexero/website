<?php
/**
 * Customizer - Add Custom Styling
 */
function 1425_customizer_style()
{
	wp_enqueue_style('1425-customizer', get_template_directory_uri() . '/functions/css/customizer.css');
}
add_action('customize_controls_print_styles', '1425_customizer_style');

/**
 * Customizer - Live Preview
 */
function 1425_customizer_live_preview() {
	wp_enqueue_script( 
		'1425-theme-customizer', 
		get_template_directory_uri() . '/js/theme-customizer.js', 
		array( 'customize-preview' ), 
		rand(),  
		true 
	);
}
add_action( 'customize_preview_init', '1425_customizer_live_preview' );

/**
 * Customizer - include script to display pro message
 */
if ( ! function_exists( '1425_customizer_scripts' ) ) :

	function 1425_customizer_scripts() {

		wp_register_script( '1425-customizer-pro', get_template_directory_uri() . '/js/customizer-pro.js', '2.0', 'jquery', true);
		
		// Localize the script with new data
		$translation_array = array(
			'pro_message' 	=> __( 'Check out Pro Version', '1425' ),
		);

		wp_localize_script( '1425-customizer-pro', 'pro_object', $translation_array );

		wp_enqueue_script( '1425-customizer-pro' );

	}

endif;

add_action( 'customize_controls_enqueue_scripts', '1425_customizer_scripts' );

/**
 * Customizer - Panels, Sections, Settings & Controls
 */
function 1425_register_theme_customizer( $wp_customize ) {

	//  List Arrays
	$list_social_channels = array( // 1
		'twitter'			=> __( 'Twitter url', '1425' ),
		'facebook'			=> __( 'Facebook url', '1425' ),
		'googleplus'		=> __( 'Google + url', '1425' ),
		'linkedin'			=> __( 'LinkedIn url', '1425' ),
		'flickr'			=> __( 'Flickr url', '1425' ),
		'pinterest'			=> __( 'Pinterest url', '1425' ),
	);

	$list_contact_options = array(
		'telnumber'			=> __( 'Telephone Number', '1425'),
		'address'			=> __( 'Address', '1425'),
	);

	$list_featured_text_boxes = array(
		array('one', __('One', '1425'), __('Service Box One', '1425')),
		array('two', __('Two', '1425'), __('Service Box Two', '1425')),
		array('three', __('Three', '1425'), __('Service Box Three', '1425')),
	);

	/*
	* //////////////////// Panels ////////////////////////////
	*/

	$priority = 10;

	if(method_exists('WP_Customize_Manager', 'add_panel')){
		
		$wp_customize->add_panel('1425_header_panel', array(
			'title'		=> __('Site Settings', '1425'),
			'priority'	=> $priority++,
		));

		$wp_customize->add_panel('1425_homepage_panel', array(
			'title'		=> __('Homepage Settings', '1425'),
			'priority'	=> $priority++,
		));

	}
		

	/*
	* //////////////////// Sections ////////////////////////////
	*/

	$priority = 2;

	$wp_customize->add_section( '1425_logo_section' , array(
		'title'       		=> __( 'Site Logo', '1425' ),
		'description' 		=> __( 'Upload a logo to replace the default site name and description in the header', '1425' ),
		'panel'				=> '1425_header_panel',
		'priority'			=> $priority++,
	) );

	$wp_customize->add_section( '1425_favicons' , array(
		'title'     		=> __('Favicon & App Icons', '1425'),
		'panel'		 		=> '1425_header_panel',
		'priority'			=> $priority++,
	) );

	$wp_customize->add_section( 'telnumber_section_one', array(
		'title'       		=> __( 'Header Contact Details', '1425' ),
		'description' 		=> __( 'Add contact details that will appear in the header of your site.', '1425' ),
		'panel'				=> '1425_header_panel',
		'priority'			=> $priority++,
    ));

	$wp_customize->add_section( '1425_social_section', array(
		'title'				=> __('Social Media Accounts', '1425'),
		'description' 		=> __( 'Setup your social media accounts here.', '1425' ),
		'panel'				=> '1425_header_panel',
		'priority'			=> $priority++,
	));

	$wp_customize->add_section( 'footer_settings', array(
	    'title'       		=> __( 'Footer Settings', '1425' ),
	    'description' 		=> __( "Change/hide content in the footer.", '1425' ),
	    'panel'				=> '1425_header_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( '1425_color_scheme_settings', array(
		'title'       		=> __( 'Color Scheme', '1425' ),
		'description' 		=> __( 'Click on a color for a preview of a color scheme', '1425' ),
		'panel'				=> '1425_header_panel',
		'priority'			=> $priority++,
	) );

	$wp_customize->add_section( 'homepage_slider', array(
	    'title'       		=> __( 'Homepage Slider', '1425' ),
	    'description' 		=> __( 'Control the homepage slider', '1425' ),
	    'panel'				=> '1425_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'featured_section_top', array(
	    'title'       		=> __( 'Featured Promo Bar', '1425' ),
	    'description' 		=> __( 'Create a eye catching "call to action"', '1425' ),
	    'panel'				=> '1425_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'service_section_settings', array(
	    'title'       		=> __( 'Service Section Settings', '1425' ),
	    'description' 		=> __( 'Change the title and control the display.', '1425' ),
	    'panel'				=> '1425_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$arraycount = count($list_featured_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {
		$wp_customize->add_section( 'featured_section_' . $list_featured_text_boxes[$row][0], array(
			    'title' 			=> $list_featured_text_boxes[$row][2],
			    'description' 		=> __( 'This is a settings section to change the custom homepage services box.', '1425' ),
			    'panel'				=> '1425_homepage_panel',
			    'priority' 			=> $priority++,
	        )
	    );	
	}

	$wp_customize->add_section( 'recent_posts_section_settings', array(
	    'title'       		=> __( 'Recent Posts Section Settings', '1425' ),
	    'description' 		=> __( 'Change the title and control the display.', '1425' ),
	    'panel'				=> '1425_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'authors_template_settings', array(
	    'title'       		=> __( 'Authors Template Settings', '1425' ),
	    'description' 		=> __( "Paste user Id's seperated by commas to display user profiles.", '1425' ),
	    'priority'			=> $priority++,
    ));




	/*
	* //////////////////// Settings ////////////////////////////
	*/

	$wp_customize->add_setting('1425_global_favicon', array(
		'sanitize_callback'	=> '1425_sanitize_url',
	));

	$wp_customize->add_setting('1425_global_apple_icon', array(
		'sanitize_callback'	=> '1425_sanitize_url',
	));


	$wp_customize->add_setting('1425_show_topbar', array(
		'sanitize_callback'	=> '1425_sanitize_checkbox',
	));

	foreach ($list_contact_options as $key => $value){

		$wp_customize->add_setting( $key . '_textbox_header_one', array(
				'sanitize_callback' => '1425_sanitize_text',
			)
		);

	}

	foreach ($list_social_channels as $key => $value) {

		$wp_customize->add_setting( $key, array(
			'sanitize_callback' => '1425_sanitize_url',
		));

	}

	$wp_customize->add_setting( '1425_logo', array(
			'sanitize_callback' => '1425_sanitize_url',
		)
	);

	$wp_customize->add_setting( '1425_color_scheme', array(
			'default'        	=> 'Default',
			'sanitize_callback' => '1425_sanitize_text',
		) 
	);

	$wp_customize->add_setting( 'homepage_slider_hide', array(
			'default' 			=> false,
			'sanitize_callback' => '1425_sanitize_checkbox',
		)
	);
	
	$wp_customize->add_setting( 'homepage_slider_cat', array(
			'default'			=> 'featured',
			'sanitize_callback'	=> '1425_sanitize_text',
		)
	);

	$wp_customize->add_setting( 'homepage_slider_slide_no', array(
	        'default'     		=> '3',
			'sanitize_callback'	=> '1425_sanitize_integer',
    	)
	); 

	$wp_customize->add_setting( 'homepage_promotional_bool', array(
			'default' 			=> false,
			'sanitize_callback' => '1425_sanitize_checkbox',
		)
	);

	$wp_customize->add_setting( 'featured_textbox', array(
			'default' 			=> __( 'Default Featured Text', '1425' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => '1425_sanitize_text',
		)
	);

	$wp_customize->add_setting( 'featured_button_txt', array(
			'sanitize_callback' => '1425_sanitize_text',
			'transport'			=> 'postMessage',
			'default'			=> 'Find Out More',
		)
	);

	$wp_customize->add_setting( 'header_one_url', array(
			'sanitize_callback' => '1425_sanitize_url',
		)
	);

	$wp_customize->add_setting('homepage_service_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> '1425_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'homepage_service_title', array(
			'default'			=> __( 'Services', '1425' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => '1425_sanitize_text',
		)
	);

	$wp_customize->add_setting('homepage_service_title_bool', array(
		'default' 			=> false,
		'sanitize_callback'	=> '1425_sanitize_checkbox',
	));

	$arraycount = count($list_featured_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {

		$wp_customize->add_setting( 'header-' . $list_featured_text_boxes[$row][0] . '-file-upload', array(
				'sanitize_callback' => '1425_sanitize_url',
			)
		);

		$wp_customize->add_setting( 'featured_textbox_header_' . $list_featured_text_boxes[$row][0], array(
	        	'transport'			=> 'postMessage',
				'sanitize_callback' => '1425_sanitize_text',
	    	)
		);

		$wp_customize->add_setting( 'header_' . $list_featured_text_boxes[$row][0] . '_url', array(
	        	'default' 			=> __( 'http://', '1425' ),
				'sanitize_callback' => '1425_sanitize_url',
	    	) 
		);

		$wp_customize->add_setting( 'featured_textbox_text_' . $list_featured_text_boxes[$row][0], array(
				'transport'			=> 'postMessage',
				'sanitize_callback' => '1425_sanitize_text',
			)
		);

	}

	$wp_customize->add_setting('homepage_recent_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> '1425_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'homepage_recent_title', array(
			'default'			=> __( 'Recent Posts', '1425' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => '1425_sanitize_text',
		)
	);

	$wp_customize->add_setting( 'homepage_recent_cat', array(
			'sanitize_callback' => '1425_sanitize_text',
	));
	
	$wp_customize->add_setting( 'copyright_text', array(
			'transport'			=> 'postMessage',
			'sanitize_callback' => '1425_sanitize_text',
		)
	);

	$wp_customize->add_setting('hide_copyright', array(
			'default' 			=> false,
			'sanitize_callback'	=> '1425_sanitize_checkbox',
	));

	$wp_customize->add_setting('hide_footer_widgets', array(
			'default' 			=> false,
			'sanitize_callback'	=> '1425_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'authors_ids', array(
			'sanitize_callback' => '1425_sanitize_text',
		)
	);

	$wp_customize->add_setting('authors_hide_content', array(
			'default' 			=> false,
			'sanitize_callback'	=> '1425_sanitize_checkbox',
	));

	$wp_customize->add_setting('authors_content_below', array(
			'default' 			=> false,
			'sanitize_callback'	=> '1425_sanitize_checkbox',
	));
 
	/* 
	* //////////////////// Controls ////////////////////////////
	*/

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'1425_global_favicon',
			array(
				'label'      	=> __('Upload Favicon', '1425'),
				'section'    	=> '1425_favicons',
				'settings'   	=> '1425_global_favicon',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'1425_global_apple_icon',
			array(
				'label'      	=> __('Upload Apple App Icon', '1425'),
				'section'    	=> '1425_favicons',
				'settings'   	=> '1425_global_apple_icon',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'1425_show_topbar_bool',
			array(
				'label'      	=> __('Show Topbar if your using it', '1425'),
				'section'    	=> 'telnumber_section_one',
				'settings'   	=> '1425_show_topbar',
				'priority'	 	=> $priority++,
				'type'		 	=> 'checkbox',
			)
		)
	);

	foreach ($list_contact_options as $key => $value){

		$wp_customize->add_control( $key . '_textbox_header_one', array(
				'label'			=> $value,
				'section' 		=> 'telnumber_section_one',
				'priority'	 	=> $priority++,
			)
		);

	}

	foreach ($list_social_channels as $key => $value) {
		
		$wp_customize->add_control( $key, array(
			'label'   => $value,
			'section' => '1425_social_section',
			'type'    => 'url',
		) );

	}

	$wp_customize->add_control( new WP_Customize_Image_Control( 
		$wp_customize, '1425_logo', array(
				'label'    => __( 'Logo', '1425' ),
				'section'  => '1425_logo_section',
				'settings' => '1425_logo',
			) 
		) 
	);

	$wp_customize->add_control( '1425_color_scheme', array(
		'label'   		=> __( 'Choose a color scheme', '1425' ),
		'section' 		=> '1425_color_scheme_settings',
		'settings'		=> '1425_color_scheme',
		'type'       	=> 'radio',
		'choices'    	=> array(
			__( 'Default', '1425' ) 	=> 'none',
			__( 'Black', '1425' ) 	=> 'black',
			__( 'Red', '1425' ) 		=> 'red',
			__( 'Pink', '1425' ) 		=> 'pink',
		),
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'homepage_slider_hide_control',
			array(
				'label'      => __('Hide Homepage Slider', '1425'),
				'section'    => 'homepage_slider',
				'settings'   => 'homepage_slider_hide',
				'type'		 => 'checkbox',
				'priority'	 => $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Category_Control(
			$wp_customize,
			'homepage_slider_cat_control',
			array(
				'label'    		=> __('Select Featured Category', '1425'),
				'section'  		=> 'homepage_slider',
				'settings'		=> 'homepage_slider_cat',
				'priority'	 	=> $priority++,
			)
		)
	);	

	$wp_customize->add_control(
		new Customize_Number_Control(
			$wp_customize,
			'homepage_slider_slide_no_control',
			array(
				'label'      => __('Amount of slides to display', '1425'),
				'section'    => 'homepage_slider',
				'settings'   => 'homepage_slider_slide_no',
				'type'		 => 'number',
				'priority'	 => $priority++,
			)
		)
	);



	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'featured_hide_bar',
			array(
				'label'      	=> __('Hide Promotional Bar', '1425'),
				'section'    	=> 'featured_section_top',
				'settings'   	=> 'homepage_promotional_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'featured_textbox', array(
		    'label'    		=> __( 'Title', '1425' ),
		    'section' 		=> 'featured_section_top',
		    'settings'  	=> 'featured_textbox',
		    'priority'	 	=> $priority++,
	    )
	);

	$wp_customize->add_control( 'featured_button_txt_control', array(
		    'label'    		=> __( 'Link text', '1425' ),
		    'section' 		=> 'featured_section_top',
		    'settings'		=> 'featured_button_txt',
		    'priority'	 	=> $priority++,
	    )
	);

	$wp_customize->add_control( 'header_one_url_control', array(
			'label'    		=> __( 'Link URL', '1425' ),
			'section' 		=> 'featured_section_top',
			'settings'		=> 'header_one_url',
			'priority'	 	=> $priority++,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_services_section_control',
			array(
				'label'      	=> __('Hide Services Section', '1425'),
				'section'    	=> 'service_section_settings',
				'settings'   	=> 'homepage_service_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'service_section_title_control', array(
        'label'   		=> __('Change Title', '1425'),
        'section' 		=> 'service_section_settings',
        'settings'   	=> 'homepage_service_title',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_services_title_control',
			array(
				'label'      	=> __('Hide Title', '1425'),
				'section'    	=> 'service_section_settings',
				'settings'   	=> 'homepage_service_title_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$arraycount = count($list_featured_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {

		$wp_customize->add_control( 
			new WP_Customize_Upload_Control(
		        $wp_customize,
		        'header-' . $list_featured_text_boxes[$row][0] . '-file-upload',
		        array(
		            'label' 	=> __( 'Header Image File Upload', '1425' ),
		            'section' 	=> 'featured_section_' . $list_featured_text_boxes[$row][0],
		            'settings' 	=> 'header-' . $list_featured_text_boxes[$row][0] . '-file-upload'
		        )
		    )
		);

		$wp_customize->add_control( 'featured_textbox_header_' . $list_featured_text_boxes[$row][0], array(
				'label' 	=> __( 'Header Text', '1425' ),
				'section' 	=> 'featured_section_' . $list_featured_text_boxes[$row][0],
				'settings'	=> 'featured_textbox_header_' . $list_featured_text_boxes[$row][0],
			)
		);

		$wp_customize->add_control( 'header_' . $list_featured_text_boxes[$row][0] . '_url', array(
				'label'    	=> __( 'Link URL', '1425' ),
				'section' 	=> 'featured_section_' . $list_featured_text_boxes[$row][0],
				'settings'	=> 'header_' . $list_featured_text_boxes[$row][0] . '_url',
			)
		);
		
		$wp_customize->add_control( 'featured_textbox_text_' . $list_featured_text_boxes[$row][0], array(
				'label' 	=> __( 'Link text', '1425' ),
				'section' 	=> 'featured_section_' . $list_featured_text_boxes[$row][0],
				'settings' 	=> 'featured_textbox_text_' . $list_featured_text_boxes[$row][0]
			)
		);

	}

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_recent_section_control',
			array(
				'label'      	=> __('Hide Recent Posts Section', '1425'),
				'section'    	=> 'recent_posts_section_settings',
				'settings'   	=> 'homepage_recent_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'recent_section_title_control', array(
        'label'   		=> __('Change Title', '1425'),
        'section' 		=> 'recent_posts_section_settings',
        'settings'   	=> 'homepage_recent_title',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );


	$wp_customize->add_control(
		new WP_Customize_Category_Control(
			$wp_customize,
			'homepage_recent_cat_control',
			array(
				'label'    		=> __('Select category to display posts from', '1425'),
				'section'  		=> 'recent_posts_section_settings',
				'settings'		=> 'homepage_recent_cat',
				'priority'	 	=> $priority++,
			)
		)
	);	

	$wp_customize->add_control( 'copyright_text_control', array(
        'label'   		=> __( "Change Copyright Text", '1425'),
        'section' 		=> 'footer_settings',
        'settings'   	=> 'copyright_text',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hide_copyright_control',
			array(
				'label'      	=> __('Hide Copyright Bar', '1425'),
				'section'    	=> 'footer_settings',
				'settings'   	=> 'hide_copyright',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hide_footer_widgets_control',
			array(
				'label'      	=> __('Hide Footer Widgets', '1425'),
				'section'    	=> 'footer_settings',
				'settings'   	=> 'hide_footer_widgets',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'authors_ids_control', array(
        'label'   		=> __( "Add User Id's", '1425'),
        'section' 		=> 'authors_template_settings',
        'settings'   	=> 'authors_ids',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'authors_hide_content_control',
			array(
				'label'      	=> __('Hide Page Content', '1425'),
				'section'    	=> 'authors_template_settings',
				'settings'   	=> 'authors_hide_content',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'authors_content_below_control',
			array(
				'label'      	=> __('Display Content below User Profiles', '1425'),
				'section'    	=> 'authors_template_settings',
				'settings'   	=> 'authors_content_below',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);


	/* 
	* //////////////////// Overrides ////////////////////////////
	*/

	$wp_customize->get_section( 'title_tagline' )->panel 			= '1425_header_panel';
	$wp_customize->get_section( 'title_tagline' )->priority 		= 1;
	$wp_customize->get_section( 'header_image' )->panel 			= '1425_header_panel';
	$wp_customize->get_section( 'header_image' )->priority 			= 4;
	$wp_customize->get_section( 'colors' )->panel 					= '1425_header_panel';
	$wp_customize->get_section( 'colors' )->priority 				= 99;
	$wp_customize->get_section('background_image')->panel 			= '1425_header_panel';
	$wp_customize->get_section( 'background_image' )->priority 		= 4;

	// Show instant changes for site title and description in the Theme Customizer.
	$wp_customize->get_setting( 'blogname' )->transport        		= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport 		= 'postMessage';

	$wp_customize->get_setting( 'header_textcolor' )->transport 	= 'postMessage';
	$wp_customize->get_setting( 'background_color' )->default 		= '#fff';

}
add_action( 'customize_register', '1425_register_theme_customizer' );


/**
 *  ////////////// SANITIZATION //////////////////////
 */

// Sanitize Text
function 1425_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
// Sanitize Textarea
function 1425_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags);
	return $output;
}
// Sanitize Checkbox
function 1425_sanitize_checkbox( $input ) {
	if( $input ):
		$output = '1';
	else:
		$output = false;
	endif;
	return $output;
}
// Sanitize Numbers
function 1425_sanitize_integer( $input ) {
	$value = (int) $input; // Force the value into integer type.
    return ( 0 < $input ) ? $input : null;
}
function 1425_sanitize_float( $input ) {
	return floatval( $input );
}

// Sanitize Uploads
function 1425_sanitize_url($input){
	return esc_url_raw($input);	
}

// Sanitize Colors
function 1425_sanitize_color($input){
	return maybe_hash_hex_color($input);
}