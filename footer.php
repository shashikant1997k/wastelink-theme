<?php
/**
 *
 * Footer
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( is_page() || is_home() ) {
	$post_id = get_queried_object_id();
} else {
	$post_id = get_the_ID();
}
// page options
$meta_data           = get_post_meta( $post_id, '_custom_page_options', true );
$meta_data_portfolio = get_post_meta( $post_id, 'pixxy_portfolio_options', true );
$meta_data_events    = get_post_meta( $post_id, 'pixxy_events_options', true );
$class_footer        = ! empty( $meta_data['fixed_transparent_footer'] ) || is_404() || ( ! empty( $meta_data_portfolio['fixed_transparent_footer'] ) || ! empty( $meta_data_events['fixed_transparent_footer'] ) ) ? ' fix-bottom' : '';
// FOOTER STYLE
$pixxy_footer_style = cs_get_option( 'pixxy_footer_style' ) ? cs_get_option( 'pixxy_footer_style' ) : 'classic';
if ( isset( $meta_data_portfolio['pixxy_footer_style'] ) && ( $meta_data_portfolio['pixxy_footer_style'] != 'default' ) ) {
	$pixxy_footer_style = $meta_data_portfolio['pixxy_footer_style'];
} elseif ( isset( $meta_data['pixxy_footer_style'] ) && ( $meta_data['pixxy_footer_style'] != 'default' )  ) {
	$pixxy_footer_style = $meta_data['pixxy_footer_style'];
}

if (function_exists( 'cs_framework_init' )  && class_exists( 'WooCommerce' ) && (is_woocommerce() || is_cart() || is_checkout())) {
	$pixxy_footer_style = cs_get_option( 'ecommerce_footer_style' );
}
function is_blog () {
	return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

if (function_exists( 'cs_framework_init' )  && is_blog()) {
    $pixxy_footer_style = cs_get_option( 'blog_footer_style' ) ? cs_get_option( 'blog_footer_style' ) : 'classic';
}
// FOOTER PARALLAX
$enable_footer_parallax = isset( $meta_data['enable_parallax_footer_page'] ) ? $meta_data['enable_parallax_footer_page'] : cs_get_option( 'enable_parallax_footer' );
if ( isset( $meta_data_portfolio['enable_parallax_footer_page'] ) ) {
	$enable_footer_parallax = $meta_data_portfolio['enable_parallax_footer_page'];
} elseif ( isset( $meta_data_events['enable_parallax_footer_page'] ) ) {
	$enable_footer_parallax = $meta_data_events['enable_parallax_footer_page'];
}
$enable_footer_parallax = apply_filters( 'pixxy_blog_footer_style', $enable_footer_parallax );
if ( $enable_footer_parallax ) {
	$class_footer .= ' footer-parallax';
}
// FOOTER TOP SECTION ENABLE/DISABLE
if ($pixxy_footer_style == 'simple' || $pixxy_footer_style == 'modern') {
	$enable_footer_top = isset( $meta_data['enable_footer_top'] ) ? $meta_data['enable_footer_top'] : true;
	if ( isset( $meta_data_portfolio['enable_footer_top'] ) ) {
		$enable_footer_top = $meta_data_portfolio['enable_footer_top'];
	} elseif ( isset( $meta_data_events['enable_footer_top'] ) ) {
		$enable_footer_top = $meta_data_events['enable_footer_top'];
	}
} else {
	$enable_footer_top = true;
}
// FOOTER COPYRIGHT ENABLE/DISABLE
if ($pixxy_footer_style == 'simple') {
	$enable_footer_copy_page = isset( $meta_data['enable_footer_copy_page'] ) ? $meta_data['enable_footer_copy_page'] : true;
	if ( isset( $meta_data_portfolio['enable_footer_copy_page'] ) ) {
		$enable_footer_copy_page = $meta_data_portfolio['enable_footer_copy_page'];
	} elseif ( isset( $meta_data_events['enable_footer_copy_page'] ) ) {
		$enable_footer_copy_page = $meta_data_events['enable_footer_copy_page'];
	}
} else {
	$enable_footer_copy_page = true;
}
// FOOTER INSTAGRAM ENABLE/DISABLE
if ($pixxy_footer_style == 'simple') {
	$enable_footer_instagram = isset( $meta_data['enable_footer_instagram'] ) ? $meta_data['enable_footer_instagram'] : true;
	if ( isset( $meta_data_portfolio['enable_footer_instagram'] ) ) {
		$enable_footer_instagram = $meta_data_portfolio['enable_footer_instagram'];
	} elseif ( isset( $meta_data_events['enable_footer_instagram'] ) ) {
		$enable_footer_instagram = $meta_data_events['enable_footer_instagram'];
	}
} else {
	$enable_footer_instagram = true;
}
// FOOTER SOCIAL ENABLE/DISABLE
if ( cs_get_option( 'footer_social' ) ) {
	if ($pixxy_footer_style == 'simple') {
		$enable_footer_social = isset( $meta_data['enable_footer_social'] ) ? $meta_data['enable_footer_social'] : true;
		if ( isset( $meta_data_portfolio['enable_footer_social'] ) ) {
			$enable_footer_social = $meta_data_portfolio['enable_footer_social'];
		} elseif ( isset( $meta_data_events['enable_footer_social'] ) ) {
			$enable_footer_social = $meta_data_events['enable_footer_social'];
		}
	} else {
		$enable_footer_social = true;
	}
} else {
	$enable_footer_social = false;
}
// FOOTER LOGO
$footer_logo_radio = cs_get_option( 'footer_logo_radio' );
if ($footer_logo_radio == 'imglogo') {
	$footer_logo = cs_get_option( 'footer_logo' );
	$footer_logo_modern = cs_get_option( 'footer_logo_modern' );
} else {
	$footer_logo = cs_get_option( 'footer_logo_text' );
	$footer_logo_modern = cs_get_option( 'footer_logo_text' );
}
// FOOTER SOCIAL LINKS
$footer_social = isset( $meta_data['footer_social'] ) ? $meta_data['footer_social'] : cs_get_option( 'footer_social' );
if ( isset( $meta_data_portfolio['footer_social'] ) ) {
	$footer_social = $meta_data_portfolio['footer_social'];
} elseif ( isset( $meta_data_events['footer_social'] ) ) {
	$footer_social = $meta_data_events['footer_social'];
}
$twitter_url = cs_get_option( 'twitter_url' );
$facebook_url = cs_get_option( 'facebook_url' );
$instagram_url = cs_get_option( 'instagram_url' );
$google_plus_url = cs_get_option( 'google_plus_url' );
$bahance_url = cs_get_option( 'bahance_url' );
$linkedin_url = cs_get_option( 'linkedin_url' );
$dribble_url = cs_get_option( 'dribble_url' );
$pinterest_url = cs_get_option( 'pinterest_url' );
// FOOTER OTHER PARAMS
$footer_info = cs_get_option( 'footer_info' );
$footer_text = cs_get_option( 'footer_text' ) ? cs_get_option( 'footer_text' ) : get_option( 'blogname' ) . ' &copy; 2018. Developed with love by Foxthemes.';
$footer_inst = cs_get_option( 'footer_inst' );
$class_footer .= ' ' . $pixxy_footer_style;
if ($pixxy_footer_style == 'classic') {
	$bottom_container = 'container-fluid';
} else {
	$bottom_container = 'container';
}
?>
</div>
<?php if ( (! is_404() || !function_exists( 'cs_framework_init' )) && $pixxy_footer_style != 'none' ) { ?>
    <footer id="footer" class="<?php echo esc_attr( $class_footer ); ?>">
		<?php if ( function_exists( 'cs_framework_init' ) && ($pixxy_footer_style == 'simple' || $pixxy_footer_style == 'modern') ) {
			$sidebarWidg = wp_get_sidebars_widgets();
			if ($enable_footer_top && function_exists( 'cs_framework_init' )) { ?>
                <div class="container">
                    <div class="row">
						<?php if ($pixxy_footer_style == 'modern') { ?>
                            <div class="col-sm-3">
                                <div class="footer-info">
									<?php if ($footer_logo_modern && $footer_logo_radio == 'imglogo') { ?>
                                        <div class="footer-logo"><img src="<?php echo esc_url( $footer_logo_modern ) ?>" alt="<?php bloginfo( 'name' ); ?>"></div>
									<?php } else { ?>
                                        <div class="footer-logo"><?php echo esc_html( $footer_logo ) ?></div>
									<?php } ?>
									<?php if ($footer_info) { ?>
                                        <div class="footer-info-text">
											<?php echo wpautop($footer_info) ?>
                                        </div>
									<?php } ?>
                                </div>
                            </div>
						<?php } else { ?>
                            <div class="col-lg-6 col-sm-5">
                                <div class="footer-info">
									<?php if ($footer_logo && $footer_logo_radio == 'imglogo') { ?>
                                        <div class="footer-logo"><img src="<?php echo esc_url( $footer_logo ) ?>" alt="<?php bloginfo( 'name' ); ?>"></div>
									<?php } else { ?>
                                        <div class="footer-logo"><?php echo esc_html( $footer_logo ) ?></div>
									<?php } ?>
									<?php if ($footer_info) { ?>
                                        <div class="footer-info-text">
											<?php echo wpautop($footer_info) ?>
                                        </div>
									<?php } ?>
                                </div>
                            </div>
						<?php } ?>
						<?php if ($pixxy_footer_style == 'modern') { ?>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="widg clearfix">
										<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'footer_simple_sidebar' ) ) {
											;
										} ?>
                                    </div>
                                </div>
                            </div>
						<?php } else { ?>
                            <div class="col-lg-6 col-sm-7">
                                <div class="row">
                                    <div class="widg clearfix">
										<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'footer_sidebar' ) ) {
											;
										} ?>
                                    </div>
                                </div>
                            </div>
						<?php } ?>
                    </div>
                </div>
			<?php } ?>
		<?php }  ?>
        <div class="footer-bottom-wrap">
			<?php if (function_exists( 'cs_framework_init')) { ?>
                <div class="<?php echo esc_attr($bottom_container); ?>">
                    <div class="footer-bottom-container">
						<?php if ($enable_footer_instagram) { ?>
                            <div class="footer-bottom-col">
								<?php if ($pixxy_footer_style == 'simple') { ?>
									<?php if  (function_exists('pixxy_get_imstagram') && !empty($footer_inst) && $enable_footer_instagram) {
										$instagram_images = pixxy_get_imstagram(  $footer_inst, 3 ); ?>
                                        <div class="footer-instagram">
                                            <div class="footer-instagram-images">
												<?php if ( ! empty( $instagram_images ) ) {
													foreach ( $instagram_images['items'] as $image ) { ?>
                                                        <a href="<?php echo esc_url( $image['link'] ); ?>" target="_blank" class="insta-images"><img src="<?php echo esc_url( $image['image-url'] ); ?>" class="s-img-switch img" alt="<?php echo esc_attr( $footer_inst ); ?>"></a>
													<?php }
												} ?>
                                            </div>
                                            <div class="instagram-text">Instagram <a href="https://www.instagram.com/<?php echo esc_attr( $footer_inst ); ?>" target="_blank">@<?php echo esc_html( $footer_inst ); ?></a></div>
                                        </div>
									<?php } ?>
								<?php } elseif ($pixxy_footer_style == 'modern') { ?>
									<?php if (!empty($footer_text)): ?>
                                        <div class="copyright">
											<?php echo wp_kses_post( $footer_text); ?>
                                        </div>
									<?php endif ?>
								<?php } else { ?>
									<?php if ( has_nav_menu( 'footermenu' ) ) { ?>
                                        <div class="footer-menu">
											<?php $args_menu = array(
												'theme_location'  => 'footermenu',
												'container'       => '',
												'container_class' => 'footer-menu',
												'menu_class'      => 'anchor-navigation',
												'depth'           => 1,
												'walker'          => new Pixxy_Menu_Walker()
											);
											wp_nav_menu( $args_menu ); ?>
                                        </div>
									<?php } ?>
								<?php } ?>
                            </div>
						<?php } ?>
						<?php if ($pixxy_footer_style == 'classic') { ?>
                            <div class="footer-bottom-col">
								<?php if ($footer_logo && $footer_logo_radio == 'imglogo') { ?>
                                    <div class="footer-logo"><img src="<?php echo esc_url( $footer_logo ) ?>" alt="<?php bloginfo( 'name' ); ?>"></div>
								<?php } else { ?>
                                    <div class="footer-logo"><?php echo esc_html( $footer_logo ) ?></div>
								<?php } ?>
                            </div>
						<?php } ?>
						<?php if ($enable_footer_social || $enable_footer_copy_page) { ?>
                            <div class="footer-bottom-col">
								<?php if (!empty($footer_social) && $enable_footer_social): ?>
                                    <div class="socials">
										<?php if (!empty($twitter_url)): ?>
                                            <a href="<?php echo esc_url( $twitter_url ); ?>" class="fa fa-twitter"></a>
										<?php endif ?>
										<?php if (!empty($facebook_url)): ?>
                                            <a href="<?php echo esc_url( $facebook_url ); ?>" class="fa fa-facebook-square"></a>
										<?php endif ?>
										<?php if (!empty($instagram_url)): ?>
                                            <a href="<?php echo esc_url( $instagram_url ); ?>" class="fa fa-instagram"></a>
										<?php endif ?>
										<?php if (!empty($google_plus_url)): ?>
                                            <a href="<?php echo esc_url( $google_plus_url ); ?>" class="fa fa-google-plus"></a>
										<?php endif ?>
										<?php if (!empty($bahance_url)): ?>
                                            <a href="<?php echo esc_url( $bahance_url ); ?>" class="fa fa-behance"></a>
										<?php endif ?>
										<?php if (!empty($linkedin_url)): ?>
                                            <a href="<?php echo esc_url( $linkedin_url ); ?>" class="fa fa-linkedin"></a>
										<?php endif ?>
										<?php if (!empty($dribble_url)): ?>
                                            <a href="<?php echo esc_url( $dribble_url ); ?>" class="fa fa-dribbble"></a>
										<?php endif ?>
										<?php if (!empty($pinterest_url)): ?>
                                            <a href="<?php echo esc_url( $pinterest_url ); ?>" class="fa fa-pinterest"></a>
										<?php endif ?>
                                    </div>
								<?php endif ?>
								<?php if ($pixxy_footer_style == 'simple') { ?>
									<?php if (!empty($footer_text) && $enable_footer_copy_page): ?>
                                        <div class="copyright">
											<?php echo wp_kses_post( $footer_text); ?>
                                        </div>
									<?php endif ?>
								<?php } ?>
                            </div>
						<?php } ?>
                    </div>
                </div>
			<?php } ?>
			<?php if ($pixxy_footer_style == 'classic' && !empty($footer_text)) { ?>
                <div class="<?php echo esc_attr($bottom_container); ?>">
                    <div class="footer-bottom-container">
                        <div class="footer-bottom-col">
                            <div class="copyright">
								<?php echo wp_kses_post( $footer_text); ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php } ?>
        </div>
    </footer>
<?php }
$classCopy = cs_get_option( 'enable_copyright' ) && ! cs_get_option( 'text_copyright' ) ? '' : 'copy';
if ( cs_get_option( 'enable_copyright' ) ): ?>
    <div class="pixxy_copyright_overlay <?php echo esc_attr( $classCopy ); ?>">
        <div class="pixxy_copyright_overlay-active">
			<?php if ( cs_get_option( 'text_copyright' ) ) : ?>
                <div class="pixxy_copyright_overlay_text">
					<?php echo wp_kses_post( cs_get_option( 'text_copyright' ) ); ?>
                </div>
			<?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<div class="fullview">
    <div class="fullview__close"></div>
</div>
<?php wp_footer(); ?>
</body>
</html>