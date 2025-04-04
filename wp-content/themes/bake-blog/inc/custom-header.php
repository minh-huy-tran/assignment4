<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package bake-blog
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses bake_blog_header_style()
 */
function bake_blog_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'bake_blog_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1400,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'bake_blog_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'bake_blog_custom_header_setup' );

function bake_blog_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	// Has the text been hidden?
	if ( ! display_header_text() ) :
		$additional_css = ".site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				} ";
	// If the user has set a custom color for the text use that. 
	else :
		$additional_css = "#site-identity .site-title a,
		#site-identity p.site-description {
			color: #" . esc_attr( $header_text_color ) . "}";
	endif;

	wp_add_inline_style( 'bake-blog-style', $additional_css );
}
add_action( 'wp_enqueue_scripts', 'bake_blog_header_style' );
