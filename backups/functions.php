<?php
/**
 * 1425 functions and definitions
 *
 * @package 1425
 * @since 1425 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since 1425 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 654; /* pixels */

if ( ! function_exists( '1425_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since 1425 1.0
 */
function 1425_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on 1425, use a find and replace
	 * to change '1425' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '1425', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', '1425' ),
	) );
	
	/**
	 * Add support for post thumbnails
	 */
	add_theme_support('post-thumbnails');
	add_image_size( 'featured', 650, 300, true );
	add_image_size( 100, 300, true);
	add_image_size( 'frontpage-thumbnail', 460, 160, true);

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );

	// Add support for a custom header image
	add_theme_support( 'custom-header' );

	// Display Title in theme
	add_theme_support( 'title-tag' );

	// link a custom stylesheet file to the TinyMCE visual editor
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans' );
	add_editor_style( array('style.css', 'css/editor-style.css', $font_url) );
}
endif; // 1425_setup
add_action( 'after_setup_theme', '1425_setup' );


/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 * @since 1425 1.0
 */
function 1425_register_custom_background() {
	$args = array(
		'default-color' => 'EEE',
	);

	$args = apply_filters( '1425_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_theme_support( 'custom-background', $args );
	}
}
add_action( 'after_setup_theme', '1425_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since 1425 1.0
 */
function 1425_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', '1425' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', '1425' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Left Sidebar', '1425' ),
		'id' => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar(array(
			'name' => 'Left Footer Column',
			'id'   => 'left_column',
			'description'   => 'Widget area for footer left column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Center  Footer Column',
			'id'   => 'center_column',
			'description'   => 'Widget area for footer center column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Right Footer Column',
			'id'   => 'right_column',
			'description'   => 'Widget area for footer right column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

}
add_action( 'widgets_init', '1425_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function 1425_scripts() {

	wp_enqueue_style( '1425-style', get_stylesheet_uri() );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', '', '2.0');

	wp_enqueue_style( 'jquery-flexslider', get_template_directory_uri() . '/css/flexslider.css', '', '2.0');


	
	wp_enqueue_script( 'jquery-small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '2.0', true );

	wp_enqueue_script( 'jquery-smoothup', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '2.0',  true );
	
	wp_enqueue_script( 'jquery-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '2.0', true );

 	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() .'/js/jquery.flexslider-min.js', array('jquery'), '2.0', true);
    
    wp_enqueue_script( 'jquery-flexslider-init', get_template_directory_uri() .'/js/flexslider-init.js', array('jquery-flexslider'), '2.0', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

}
add_action( 'wp_enqueue_scripts', '1425_scripts' );




/**
 * Implement excerpt for homepage slider
 */
function 1425_get_slider_excerpt(){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 150);
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;
}

// Theme Options
include('functions/customizer_controller.php');
include('functions/customizer_settings.php');
include('functions/customizer_styles.php');




/**
 * Implement excerpt for homepage thumbnails
 */
function 1425_content( $limit ) {

  $content = explode(' ', get_the_content(), $limit);

  if ( count( $content )>=$limit ) {
    array_pop($content);
    $content = implode( " ", $content ).'...';
  } else {
    $content = implode( " ", $content );
  }	

  $content = preg_replace( '/\[.+\]/','', $content );
  $content = apply_filters( 'the_content', $content ); 
  $content = str_replace( ']]>', ']]&gt;', $content );

  return $content;

}


/**
 * Social Media Links on Contributors template
 */
function author_social_media( $socialmedialinks ) {

	$socialmedialinks['alternate_image']	= __('Alternate Profile Image Url', '1425');
    $socialmedialinks['google_profile'] 	= 'Google+ URL';
    $socialmedialinks['twitter_profile'] 	= 'Twitter URL';
    $socialmedialinks['facebook_profile'] 	= 'Facebook URL';
    $socialmedialinks['linkedin_profile'] 	= 'Linkedin URL';

 	return $socialmedialinks;

}
add_filter( 'user_contactmethods', 'author_social_media', 10, 1);


/**
 * Implement the Custom Header feature
 */
function 1425_custom_header_setup() {

	$args = array(
			'default-image'          => '',
			'default-text-color'     => 'FFF',
			'width'                  => 1400,
			'height'                 => 500,
			'flex-height'            => true,
			'wp-head-callback'       => '1425_header_style',
			'admin-head-callback'    => '1425_admin_header_style',
			'admin-preview-callback' => '1425_admin_header_image',
		);

		$args = apply_filters( '1425_custom_header_args', $args );

		if ( function_exists( 'wp_get_theme' ) ) {
			add_theme_support( 'custom-header', $args );
	}

}
add_action( 'after_setup_theme', '1425_custom_header_setup' );



if ( ! function_exists( '1425_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see 1425_custom_header_setup().
 *
 * @since 1425 1.0
 */
function 1425_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Do we have a custom header image?
		if ( '' != get_header_image() ) :
	?>
		.site-header img {
			display: block;
			margin: 0.5em auto 0;
		}
	<?php endif;

		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		.site-header hgroup {
			background: none;
			padding: 0;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // 1425_header_style

if ( ! function_exists( '1425_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see 1425_custom_header_setup().
 *
 * @since 1425 1.0
 */
function 1425_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background: #000;
		border: none;
		min-height: 200px;
	}
	#headimg h1 {
		font-size: 20px;
		font-family: 'open_sansbold', sans-serif;
		font-weight: normal;
		padding: 0.8em 0.5em 0;
	}
	#desc {
		padding: 0 2em 2em;
	}
	#headimg h1 a,
	#desc {
		color: #FFF;
		text-decoration: none;
	}
	#headimg img {
	}
	</style>
<?php
}
endif; // 1425_admin_header_style

if ( ! function_exists( '1425_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see 1425_custom_header_setup().
 *
 * @since 1425 1.0
 */
function 1425_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // 1425_admin_header_image
