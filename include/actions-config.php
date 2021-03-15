<?php
/**
 * The template for requried actions hooks.
 *
 * @package pixxy
 * @since 1.0
 */

add_action( 'wp_enqueue_scripts', 'pixxy_enqueue_scripts' );
add_action( 'wp_footer', 'pixxy_enqueue_main_style' );
add_action( 'widgets_init', 'pixxy_register_widgets' );
add_action( 'tgmpa_register', 'pixxy_include_required_plugins' );

define( 'CS_ACTIVE_FRAMEWORK', true );
define( 'CS_ACTIVE_METABOX', true );
define( 'CS_ACTIVE_TAXONOMY', true );
define( 'CS_ACTIVE_SHORTCODE', false );
define( 'CS_ACTIVE_CUSTOMIZE', false );


/*
 * Register sidebar.
 */
if ( ! function_exists( 'pixxy_register_widgets' ) ) {
	function pixxy_register_widgets() {
		// register sidebars
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_attr__( 'Sidebar', 'pixxy' ),
				'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5>',
				'after_title'   => '</h5>',
				'description'   => esc_attr__( 'Drag the widgets for sidebars.', 'pixxy' )
			)
		);

		register_sidebar(
			array(
				'id'            => 'shop_sidebar',
				'name'          => esc_attr__( 'Shop Sidebar', 'pixxy' ),
				'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5>',
				'after_title'   => '</h5>',
				'description'   => esc_attr__( 'Drag the widgets for sidebars.', 'pixxy' )
			)
		);

		if ( function_exists( 'cs_framework_init' ) ) {
			register_sidebar(
				array(
					'id'            => 'footer_sidebar',
					'name'          => esc_attr__( 'Footer Simple Sidebar', 'pixxy' ),
					'before_widget' => '<div id="%1$s" class="sidebar-item col-xs-6 col-sm-4 col-md-4 %2$s"><div class="item-wrap">',
					'after_widget'  => '</div></div>',
					'before_title'  => '<h5>',
					'after_title'   => '</h5>',
					'description'   => esc_attr__( 'Drag the widgets for sidebars.', 'pixxy' )
				)
			);

			register_sidebar(
				array(
					'id'            => 'footer_simple_sidebar',
					'name'          => esc_attr__( 'Footer Modern Sidebar', 'pixxy' ),
					'before_widget' => '<div id="%1$s" class="sidebar-item col-xs-6 col-sm-4 col-md-4 %2$s"><div class="item-wrap">',
					'after_widget'  => '</div></div>',
					'before_title'  => '<h5>',
					'after_title'   => '</h5>',
					'description'   => esc_attr__( 'Drag the widgets for sidebars.', 'pixxy' )
				)
			);

		}

	}
}

function pixxy_enqueue_main_style() {
	global $post;

	if ( is_page() || is_home() ) {
		$post_id = get_queried_object_id();
	} else {
		$post_id = get_the_ID();
	}

	wp_enqueue_style( 'pixxy_dynamic-css', admin_url( 'admin-ajax.php' ) . '?action=pixxy_dynamic_css&post=' . $post_id, array( 'pixxy-theme-css' ) );
}

/*
Register Fonts
*/
if ( ! function_exists( 'pixxy_fonts_url' ) ) {
	function pixxy_fonts_url() {
		$font_url = '';

		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'pixxy' ) ) {
			$fonts = array(
				'Nunito Sans:300,300i,400,400i,600,600i,700,700i,800,800i,900',
				'Poppins:600',
			);

			$font_url = add_query_arg( 'family',
				urlencode( implode( '|', $fonts ) . "&subset=latin,latin-ext" ), "//fonts.googleapis.com/css" );
		}

		return $font_url;
	}
}
/*
Enqueue scripts and styles.
*/
if ( ! function_exists( 'pixxy_font_scripts' ) ) {
	function pixxy_font_scripts() {
		wp_enqueue_style( 'pixxy-fonts', pixxy_fonts_url(), array(), '1.0.0' );
	}
}

/**
 * @ return null
 * @ param none
 * @ loads all the js and css script to frontend
 **/
if ( ! function_exists( 'pixxy_enqueue_scripts' ) ) {
	function pixxy_enqueue_scripts() {
		global $post;

		if ( is_page() || is_home() ) {
			$post_id = get_queried_object_id();
		} else {
			$post_id = get_the_ID();
		}

		// pixxy options
		$page_options = get_post_meta( $post_id, '_custom_page_options', true );
		$disable_lazy_load = isset($page_options['disable_lazy_load']) && !empty($page_options['disable_lazy_load']) ? $page_options['disable_lazy_load'] : 'no';

		// general settings
		if ( ( is_admin() ) ) {
			return;
		}

		wp_enqueue_style( 'pixxy-fonts', pixxy_fonts_url(), array(), '1.0.0' );
		wp_enqueue_script( 'modernizr', PIXXY_T_URI . '/assets/js/lib/modernizr-2.6.2.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'pixxy_scripts', PIXXY_T_URI . '/assets/js/lib/scripts.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'countdown', PIXXY_T_URI . '/assets/js/jquery.countdown.min.js', '', '', true );
		wp_enqueue_script( 'pixxy_foxlazy', PIXXY_T_URI . '/assets/js/foxlazy.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'easings', PIXXY_T_URI . '/assets/js/jquery.easings.min.js', '', '', true );
		wp_enqueue_script( 'multiscroll', PIXXY_T_URI . '/assets/js/jquery.multiscroll.min.js', '', '', true );
		wp_enqueue_script( 'magnific', PIXXY_T_URI . '/assets/js/magnific.js', '', '', true );
		wp_enqueue_script( 'cloudflare', PIXXY_T_URI . '/assets/js/TweenMax.min.js', '', '', true );
		wp_enqueue_script( 'equalHeightsPlugin', PIXXY_T_URI . '/assets/js/equalHeightsPlugin.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'fancybox', PIXXY_T_URI . '/assets/js/jquery.fancybox.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'fitvids', PIXXY_T_URI . '/assets/js/jquery.fitvids.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'swiper', PIXXY_T_URI . '/assets/js/swiper.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'imagesloaded', PIXXY_T_URI . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'fragment', PIXXY_T_URI . '/assets/js/fragment.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'scrollMonitor', PIXXY_T_URI . '/assets/js/scrollMonitor.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'pixxy_slider_transition_init', PIXXY_T_URI . '/assets/js/slider-transition.js', array( 'jquery' ), '', true );

		if ( ! function_exists( 'cs_framework_init' ) ) {
			wp_enqueue_script( 'mousewheel', PIXXY_T_URI . '/assets/lib/js/jquery.mousewheel.min.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'lightgallery', PIXXY_T_URI . '/assets/lib/js/lightgallery.min.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'justified_gallery', PIXXY_T_URI . '/assets/lib/js/jquery.justifiedGallery.js', array( 'jquery' ), '', true );
		}

		wp_enqueue_script( 'pixxy_slick', PIXXY_T_URI . '/assets/js/slick.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'sliphover', PIXXY_T_URI . '/assets/js/jquery.sliphover.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'thumbnails_popup', PIXXY_T_URI . '/assets/js/lib/thumbnails-popup.js', array(
			'jquery',
			'dgwt-jg-lightgallery'
		), '', true );
		wp_enqueue_script( 'pixxy-pixi', PIXXY_T_URI . '/assets/js/pixi.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'pixxy_main-js', PIXXY_T_URI . '/assets/js/script.js', array( 'jquery', 'pixxy_foxlazy' ), '', true );

		// add TinyMCE style
		add_editor_style();

		// including jQuery plugins
		wp_localize_script( 'jquery', 'get',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'siteurl' => get_template_directory_uri(),
			)
		);

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// register style
		wp_enqueue_style( 'pixxy_base_css', PIXXY_T_URI . '/style.css' );

		wp_enqueue_style( 'magnific-popup', PIXXY_T_URI . '/assets/css/magnific-popup.css' );
		wp_enqueue_style( 'animsition', PIXXY_T_URI . '/assets/css/animsition.min.css' );
		wp_enqueue_style( 'bootstrap', PIXXY_T_URI . '/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'animate_css', PIXXY_T_URI . '/assets/css/animate.css' );
		wp_enqueue_style( 'font-awesome-css', PIXXY_T_URI . '/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'pe-icon-7-stroke', PIXXY_T_URI . '/assets/css/pe-icon-7-stroke.css' );
		wp_enqueue_style( 'fancybox', PIXXY_T_URI . '/assets/css/jquery.fancybox.min.css' );
		wp_enqueue_style( 'swiper', PIXXY_T_URI . '/assets/css/swiper.css' );
		wp_enqueue_style( 'simple-fonts', PIXXY_T_URI . '/assets/css/simple-line-icons.css' );
		wp_enqueue_style( 'ionicons', PIXXY_T_URI . '/assets/css/ionicons.min.css' );
		wp_enqueue_style( 'dripicons', PIXXY_T_URI . '/assets/css/dripicons.css' );
		wp_enqueue_style( 'pixxy_slick-css', PIXXY_T_URI . '/assets/css/slick.css' );
		wp_enqueue_style( 'pixxy-theme-css', PIXXY_T_URI . '/assets/css/pixxy.min.css' );
		wp_enqueue_style( 'pixxy-shop-css', PIXXY_T_URI . '/assets/css/shop.min.css' );
		wp_enqueue_style( 'pixxy-main-css', PIXXY_T_URI . '/assets/css/style.min.css' );
		wp_enqueue_style( 'pixxy-blog-css', PIXXY_T_URI . '/assets/css/blog.min.css' );
		if ( ! function_exists( 'cs_framework_init' ) ) {
			wp_enqueue_style( 'admin_style', PIXXY_T_URI . '/assets/lib/css/admin-style.css' );
			wp_enqueue_style( 'lightgallery', PIXXY_T_URI . '/assets/lib/css/lightgallery.min.css' );
			wp_enqueue_style( 'libs_style', PIXXY_T_URI . '/assets/lib/css/style.css' );
		}

		wp_enqueue_style( 'pixxy-theme-css', PIXXY_T_URI . '/assets/css/pixxy.min.css' );

		/* Add Custom JS */
		if ( cs_get_option( 'custom_js_scripts' ) ) {
			wp_add_inline_script( 'pixxy_main-js', cs_get_option( 'custom_js_scripts' ) );
		}

		if ( cs_get_option( 'enable_lazy_load' ) && $disable_lazy_load == 'no') {

			wp_localize_script( 'pixxy_main-js', 'enable_foxlazy', 'enable' );
		}

		if ( cs_get_option( 'heading' ) ) {
			foreach ( cs_get_option( 'heading' ) as $key => $title ) {
				if ( empty( $title['heading_family'] ) ) {
					continue;
				}
				$font_family = $title['heading_family'];
				if ( ! empty( $font_family['family'] ) ) {
					wp_enqueue_style( sanitize_title_with_dashes( $font_family['family'] ), '//fonts.googleapis.com/css?family=' . $font_family['family'] . ':' . $title['heading_family']['variant'] . '' );
				}
			}
		}

		// include font family
		if ( function_exists( 'pixxy_include_fonts' ) ) {
			pixxy_include_fonts(
				array(
					'menu_item_family',
					'submenu_item_family',
					'gallery_font_family',
					'all_button_font_family',
					'all_button_font_family',
					'footer_font_family',
					'item_gallery_font_family',
				) // all options name
			);
		}

	}
}


function pixxy_regiser_info_icons() {
	wp_enqueue_style( 'pixxy-font-info', PIXXY_T_URI . '/assets/css/simple-line-icons.css' );
    wp_enqueue_style( 'dripicons', PIXXY_T_URI . '/assets/css/dripicons.css' );
    wp_enqueue_style( 'ionicons', PIXXY_T_URI . '/assets/css/ionicons.min.css' );
	wp_enqueue_style( 'pixxy-fonts', pixxy_fonts_url(), array(), '1.0.0' );
    wp_enqueue_style( 'blog-admin', PIXXY_T_URI . '/assets/css/blog-admin.min.css' );
}

add_action( 'vc_base_register_admin_css', 'pixxy_regiser_info_icons' );

/**
 * Filter the page title.
 */
if ( ! function_exists( 'pixxy_wp_title' ) ) {
	function pixxy_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'pixxy' ), max( $paged, $page ) );
		}

		return $title;
	}
}
add_filter( 'wp_title', 'pixxy_wp_title', 10, 2 );

/**
 * Include plugins
 **/
if ( ! function_exists( 'pixxy_include_required_plugins' ) ) {
	function pixxy_include_required_plugins() {

		$plugins = array(
			array(
				'name'               => esc_html__( 'Pixxy Plugins', 'pixxy' ),
				// The plugin name
				'slug'               => 'pixxy-plugins',
				// The plugin slug (typically the folder name)
				'source'             => esc_url( 'http://download-plugins.viewdemo.co/pixxy/pixxy-plugins.zip' ),
				// The plugin source
				'required'           => true,
				// If false, the plugin is only 'recommended' instead of required
				'force_activation'   => false,
				// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'version'            => '',
				'force_deactivation' => false,
				// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '',
				// If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => esc_html__( 'Visual Composer', 'pixxy' ),
				// The plugin name
				'slug'               => 'js_composer',
				// The plugin slug (typically the folder name)
				'source'             => esc_url( 'http://download-plugins.viewdemo.co/premium-plugins/js_composer.zip' ),
				// The plugin source
				'required'           => true,
				// If false, the plugin is only 'recommended' instead of required
				'version'            => '',
				// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false,
				// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false,
				// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '',
				// If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => esc_html__( 'The Grid', 'pixxy' ),
				// The plugin name
				'slug'               => 'the_grid',
				// The plugin slug (typically the folder name)
				'source'             => esc_url( 'http://download-plugins.viewdemo.co/premium-plugins/the_grid.zip' ),
				// The plugin source
				'required'           => true,
				// If false, the plugin is only 'recommended' instead of required
				'version'            => '',
				// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false,
				// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false,
				// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '',
				// If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => esc_html__( 'Contact Form 7', 'pixxy' ),
				// The plugin name
				'slug'               => 'contact-form-7',
				// The plugin slug (typically the folder name)
				'required'           => false,
				// If false, the plugin is only 'recommended' instead of required
				'version'            => '',
				// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false,
				// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false,
				// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '',
				// If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => esc_html__('Gutenberg Blocks Collection', 'pixxy'),
				// The plugin name
				'slug'               => 'qodeblock',
				// The plugin slug (typically the folder name)
				'required'           => true,
				// If false, the plugin is only 'recommended' instead of required
				'version'            => '',
				// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false,
				// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false,
				// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '',
				// If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => esc_html__( 'UpQode Google Maps', 'pixxy' ),
				// The plugin name
				'slug'               => 'upqode-google-maps',
				// The plugin slug (typically the folder name)
				'required'           => false,
				// If false, the plugin is only 'recommended' instead of required
				'version'            => '',
				// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false,
				// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false,
				// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '',
				// If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => esc_html__( 'Woocommerce', 'pixxy' ),
				// The plugin name
				'slug'               => 'woocommerce',
				// The plugin slug (typically the folder name)
				'required'           => false,
				// If false, the plugin is only 'recommended' instead of required
				'version'            => '',
				// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false,
				// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false,
				// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '',
				// If set, overrides default API URL and points to an external URL
			),
		);

		// Change this to your theme text domain, used for internationalising strings

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       => 'pixxy',                    // Text domain - likely want to be the same as your theme.
			'default_path' => '',                            // Default absolute path to pre-packaged plugins
			'menu'         => 'tgmpa-install-plugins',    // Menu slug
			'has_notices'  => true,                        // Show admin notices or not
			'is_automatic' => true,                        // Automatically activate plugins after installation or not
			'message'      => '',                            // Message to output right before the plugins table
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'pixxy' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'pixxy' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'pixxy' ),
				// %1$s = plugin name
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'pixxy' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'pixxy' ),
				// %1$s = plugin name(s)
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'pixxy' ),
				// %1$s = plugin name(s)
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'pixxy' ),
				// %1$s = plugin name(s)
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'pixxy' ),
				// %1$s = plugin name(s)
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'pixxy' ),
				// %1$s = plugin name(s)
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'pixxy' ),
				// %1$s = plugin name(s)
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'pixxy' ),
				// %1$s = plugin name(s)
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'pixxy' ),
				// %1$s = plugin name(s)
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'pixxy' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'pixxy' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'pixxy' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'pixxy' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'pixxy' ),
				// %1$s = dashboard link
				'nag_type'                        => 'updated'
				// Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa( $plugins, $config );
	}
}

if ( ! function_exists( 'pixxy_password_form' ) ) {
	function pixxy_password_form() {
		global $post;
		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$o     = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
  ' . esc_html__( 'ENTER PASSWORD BELOW:', 'pixxy' ) . '
  <label for="' . esc_attr( $label ) . '"></label><input placeholder="' . esc_attr__( "Password:", 'pixxy' ) . '" name="post_password" id="' . esc_attr( $label ) . '" type="password" size="20" maxlength="20" /><input type="submit" name="' . esc_attr__( 'Submit', 'pixxy' ) . '" value="' . esc_attr__( 'ACCEPT', 'pixxy' ) . '" />
  </form>
  ';
		return $o;
	}
}
add_filter( 'the_password_form', 'pixxy_password_form' );

/* For Woocommerce */
if ( ! function_exists( 'pixxy_add_to_cart_fragment' ) ) {
	function pixxy_add_to_cart_fragment( $fragments ) {

		ob_start();
		$count = WC()->cart->cart_contents_count;
		?>
        <a class="pixxy-shop-icon ion-bag" href="<?php echo WC()->cart->get_cart_url(); ?>"
           title="<?php esc_attr_e( 'View your shopping cart', 'pixxy' ); ?>">
			<?php if ( $count > 0 ) { ?>
                <div class="cart-contents">
                    <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
                </div>
			<?php } ?>
        </a>
		<?php $fragments['a.pixxy-shop-icon'] = ob_get_clean();

		$fragments['div.pixxy_mini_cart'] = pixxy_mini_cart();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'pixxy_add_to_cart_fragment' );

if ( ! function_exists( 'pixxy_redirect_coming_soon' ) ) {
	function pixxy_redirect_coming_soon() {
		if ( cs_get_option( 'pixxy_enable_coming_soon' ) && cs_get_option( 'pixxy_page_coming_soon' ) && ! is_admin_bar_showing() ) {

			$redirect_permalink = get_permalink( cs_get_option( 'pixxy_page_coming_soon' ) );
			if ( get_permalink() != $redirect_permalink ) {
				wp_redirect( get_permalink( cs_get_option( 'pixxy_page_coming_soon' ) ) );
				exit();
			}
		}
	}
}
add_action( 'template_redirect', 'pixxy_redirect_coming_soon' );


/*
 * Check need minimal requirements (PHP and WordPress version)
 */
if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) || version_compare( PHP_VERSION, '5.3', '<' ) ) {
	if ( ! function_exists( 'pixxy_requirements_notice' ) ) {
		function pixxy_requirements_notice() {
			$message = sprintf( esc_html__( 'Pixxy theme needs minimal WordPress version 4.3 and PHP 5.3<br>You are running version WordPress - %s, PHP - %s.<br>Please upgrade need module and try again.', 'pixxy' ), $GLOBALS['wp_version'], PHP_VERSION );
			printf( '<div class="notice-warning notice"><p><strong>%s</strong></p></div>', $message );
		}
	}
	add_action( 'admin_notices', 'pixxy_requirements_notice' );
}


/*
 * Check need minimal requirements (PHP and WordPress version)
 */
if ( ! function_exists( 'pixxy_coming_soon_notice' ) ) {
	function pixxy_coming_soon_notice() {
		if ( cs_get_option( 'pixxy_enable_coming_soon' ) ) {
			?>
            <div class="notice-warning notice">
                <p><strong>
						<?php echo esc_html__( 'Your "Coming Soon" option is enabled now.', 'pixxy' );
						?></strong></p></div>
			<?php
		}
	}
}
add_action( 'admin_notices', 'pixxy_coming_soon_notice' );
