<?php
/**
 * Requried functions for theme backend.
 *
 * @package pixxy
 * @subpackage Template
 */

// cs framework missing
if ( ! function_exists( 'cs_get_option' ) ) {
	function cs_get_option() {
		return '';
	}

	function cs_get_customize_option() {
		return '';
	}
}

if ( ! function_exists( 'pixxy_add_default_cs_websafe_fonts' ) ) {
	function pixxy_add_default_cs_websafe_fonts( $params ) {
		return array_merge( array( '' ), $params );
	}
}
add_filter( 'cs_websafe_fonts', 'pixxy_add_default_cs_websafe_fonts' );

/**
 * Сustom pixxy menu.
 */
if ( ! function_exists( 'pixxy_custom_menu' ) ) {
	function pixxy_custom_menu() {

		$walker         = new pixxy_Menu_Walker();
		$args           = array( 'container' => '', 'walker' => $walker );
		$meta_data      = get_post_meta( get_the_ID(), '_custom_page_options', true );
		$portfolio_data = get_post_meta( get_the_ID(), 'pixxy_portfolio_options', true );
		$events_data    = get_post_meta( get_the_ID(), 'pixxy_events_options', true );

		if ( isset( $meta_data['page_menu'] ) && $meta_data['page_menu'] !== 'none' ) {
			$args['menu'] = $meta_data['page_menu'];
			wp_nav_menu( $args );
		} elseif ( isset( $portfolio_data['page_menu'] ) && $portfolio_data['page_menu'] !== 'none' ) {
			$args['menu'] = $portfolio_data['page_menu'];
			wp_nav_menu( $args );
		} elseif ( isset( $events_data['page_menu'] ) && $events_data['page_menu'] !== 'none' ) {
			$args['menu'] = $events_data['page_menu'];
			wp_nav_menu( $args );
		} else {
			if ( has_nav_menu( 'primary-menu' ) ) {
				$args['theme_location'] = 'primary-menu';
				wp_nav_menu( $args );
			} else {
				echo '<span class="no-menu">' . esc_html__( 'Please register Top Navigation from', 'pixxy' ) . ' <a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Appearance &gt; Menus', 'pixxy' ) . '</a></span>';
			}
		}

	}
}

/**
 * Сustom pixxy menu list.
 */
if ( ! function_exists( 'pixxy_get_menus' ) ) {
	function pixxy_get_menus() {
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$array = array( 'none' => 'None' );
		foreach ( $menus as $menu ) {
			$array[ $menu->slug ] = $menu->name;
		}

		return $array;
	}
}


/**
 *
 * Get first "url" from post content or string
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'pixxy_get_first_url_from_string' ) ) {
	function pixxy_get_first_url_from_string( $string ) {
		$pattern = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		preg_match( $pattern, $string, $link );

		return ( ! empty( $link[0] ) ) ? $link[0] : false;
	}
}

/**
 *
 * Custom Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'pixxy_get_shortcode_regex' ) ) {
	function pixxy_get_shortcode_regex( $tagregexp = '' ) {
		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
			'\\['                                // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			. '(?:'
			. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')*?'
			. ')'
			. '(?:'
			. '(\\/)'                        // 4: Self closing tag ...
			. '\\]'                          // ... and closing bracket
			. '|'
			. '\\]'                          // Closing bracket
			. '(?:'
			. '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			. '[^\\[]*+'             // Not an opening bracket
			. '(?:'
			. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			. '[^\\[]*+'         // Not an opening bracket
			. ')*+'
			. ')'
			. '\\[\\/\\2\\]'             // Closing shortcode tag
			. ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
}

/**
 *
 * Tag Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'pixxy_tagregexp' ) ) {
	function pixxy_tagregexp() {
		return apply_filters( 'pixxy_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|cs_media' );
	}
}

/**
 *
 * POST FORMAT: VIDEO & AUDIO
 *
 */
if ( ! function_exists( 'pixxy_post_media' ) ) {
	function pixxy_post_media( $content ) {
		$result = strpos( $content, 'iframe' );
		if ( $result === false ) {
			$media = pixxy_get_first_url_from_string( $content );
			if ( ! empty( $media ) ) {
				global $wp_embed;
				$content = do_shortcode( $wp_embed->run_shortcode( '[embed]' . $media . '[/embed]' ) );
			} else {
				$pattern = pixxy_get_shortcode_regex( pixxy_tagregexp() );
				preg_match( '/' . $pattern . '/s', $content, $media );
				if ( ! empty( $media[2] ) ) {
					if ( $media[2] == 'embed' ) {
						global $wp_embed;
						$content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
					} else {
						$content = do_shortcode( $media[0] );
					}
				}
			}
			if ( ! empty( $media ) ) {
				$output = $content;

				return $output;
			}

			return false;
		} else {
			return $content;
		}
	}
}

/**
 *
 * Create custom html structure for comments
 *
 */
if ( ! function_exists( 'pixxy_comment' ) ) {
	function pixxy_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ):
			case 'pingback':
			case 'trackback': ?>
                <p>
					<?php esc_html_e( 'Pingback:', 'pixxy' ); ?><?php comment_author_link(); ?>
					<?php edit_comment_link( esc_html__( '(Edit)', 'pixxy' ), '<span class="edit-link">', '</span>' ); ?>
                </p>
				<?php
				break;
			default:
				// generate comments
				?>
                <li <?php comment_class( 'ct-part' ); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>">
                    <div class="content">
                        <div class="person-img">
							<?php echo get_avatar( $comment, '70', '', '', array( 'class' => 'img-person' ) ); ?>
                        </div>
                        <div class="comment-content">
                            <div class="person">
                                <div class="author-wrap">
                                    <a href="#" class="author">
										<?php comment_author(); ?>
                                    </a>
                                    <span class="comment-date">
                            <?php comment_date( get_option( 'date_format' ) ); ?>
                          </span>
                                </div>
                            </div>
							<?php
							comment_reply_link(
								array_merge( $args,
									array(
										'reply_text' => esc_html__( 'Reply', 'pixxy' ),
										'after'      => '',
										'depth'      => $depth,
										'max_depth'  => $args['max_depth']
									)
								)
							);
							?>
                            <div class="text">
								<?php comment_text(); ?>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
				break;
		endswitch;
	}
}

/*
 * Site logo function.
 */
if ( ! function_exists( 'pixxy_site_logo' ) ) {
	function pixxy_site_logo() {
		?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">

			<?php

			$logoScroll = cs_get_option( 'image_logo_scroll' );

			if ( is_404() && cs_get_option( 'error_logo' ) ) {
				if ( apply_filters( 'pixxy_type_logo', cs_get_option( 'error_site_logo' ) ) == 'txtlogo' ) {
					echo ' <span> ' . esc_html( cs_get_option( 'error_text_logo' ) ) . '</span>';
				} else {
					$logo = '';
					if ( cs_get_option( 'error_image_logo' ) ) {
						$logo = cs_get_option( 'error_image_logo' );
					}

					// logo for page
					?>
                    <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo get_option( 'blogname' ); ?>"
                         class="main-logo">

					<?php if ( $logoScroll ) { ?>
                        <img src="<?php echo esc_url( $logoScroll ); ?>" alt="<?php echo get_option( 'blogname' ); ?>" class="logo-hover">
					<?php } else { ?>
                        <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo get_option( 'blogname' ); ?>"
                             class="logo-hover">
					<?php } ?>
                    <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo get_option( 'blogname' ); ?>" class="main-logo logo-mobile">
                    <?php
				}
			}
			else {

				$meta_data           = get_post_meta( get_the_ID(), '_custom_page_options', true );
				$meta_data_portfolio = get_post_meta( get_the_ID(), 'pixxy_portfolio_options', true );
				$meta_data_events    = get_post_meta( get_the_ID(), 'pixxy_events_options', true );
				$img_logo = false;
                    if(isset( $meta_data['image_page_logo'] ) && !empty( $meta_data['image_page_logo'] )){
	                    $img_logo = true;
                    }elseif(isset($meta_data_portfolio['image_page_logo']) && !empty( $meta_data_portfolio['image_page_logo'] )){
					    $img_logo = true;
                    }elseif(isset($meta_data_events['image_page_logo']) && !empty( $meta_data_events['image_page_logo'] )){
					    $img_logo = true;
                    }

				if ( cs_get_option( 'site_logo' ) == 'imglogo' || $img_logo) {

					$logo = '';
					if ( cs_get_option( 'menu_style' ) == 'classic' ) {
                        $logo = cs_get_option( 'image_logo' );
					} elseif ( cs_get_option( 'menu_style' ) == 'modern' ) {
						$logo = cs_get_option( 'image_logo2' );
					} elseif ( cs_get_option( 'menu_style' ) == 'aside' ) {
						$logo = cs_get_option( 'image_logo3' );
					} elseif ( cs_get_option( 'menu_style' ) == 'static_aside' ) {
						$logo = cs_get_option( 'image_logo4' );
					} elseif ( cs_get_option( 'menu_style' ) == 'only_logo' ) {
						$logo = cs_get_option( 'image_logo8' );
					}

                    $logo = (isset($meta_data['menu_light_text']) && ! empty( $meta_data['menu_light_text'])) ? cs_get_option( 'image_logo_light' ) : $logo;
                    $logo = (isset($meta_data_portfolio['menu_light_text']) && ! empty( $meta_data_portfolio['menu_light_text'])) ? cs_get_option( 'image_logo_light' ) : $logo;
                    $logo = (isset($meta_data_events['menu_light_text']) && ! empty( $meta_data_events['menu_light_text'])) ? cs_get_option( 'image_logo_light' ) : $logo;

                    // logo for page

					$logo              = !empty( $meta_data['image_page_logo'] ) ? $meta_data['image_page_logo'] : $logo;
					$logo              = isset( $meta_data_portfolio['image_page_logo'] ) && ! empty( $meta_data_portfolio['image_page_logo'] ) ? $meta_data_portfolio['image_page_logo'] : $logo;
					$logo              = isset( $meta_data_events['image_page_logo'] ) && ! empty( $meta_data_events['image_page_logo'] ) ? $meta_data_events['image_page_logo'] : $logo;
					$logoScroll        = isset( $meta_data['image_logo_scroll'] ) && ! empty( $meta_data['image_logo_scroll'] ) ? $meta_data['image_logo_scroll'] : $logoScroll;
					$logoScroll        = isset( $meta_data_portfolio['image_logo_scroll'] ) && ! empty( $meta_data_portfolio['image_logo_scroll'] ) ? $meta_data_portfolio['image_logo_scroll'] : $logoScroll;
					$logoScroll        = isset( $meta_data_events['image_logo_scroll'] ) && ! empty( $meta_data_events['image_logo_scroll'] ) ? $meta_data_events['image_logo_scroll'] : $logoScroll;
					$image_logo        = apply_filters( 'pixxy_header_logo', $logo );

					$img_src           = ! empty( $image_logo ) ? $image_logo : PIXXY_T_URI . '/assets/images/logo.png';
					$image_logo_mobile = isset( $meta_data['image_logo_mobile'] ) && ! empty( $meta_data['image_logo_mobile'] ) ? $meta_data['image_logo_mobile'] : $img_src;
					$image_logo_mobile = isset( $meta_data_portfolio['image_logo_mobile'] ) && ! empty( $meta_data_portfolio['image_logo_mobile'] ) ? $meta_data_portfolio['image_logo_mobile'] : $image_logo_mobile;
					$image_logo_mobile = isset( $meta_data_events['image_logo_mobile'] ) && ! empty( $meta_data_events['image_logo_mobile'] ) ? $meta_data_events['image_logo_mobile'] : $image_logo_mobile;
					?>
                    <img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo get_option( 'blogname' ); ?>"
                         class="main-logo">

					<?php if ( $logoScroll ) { ?>
                        <img src="<?php echo esc_url( $logoScroll ); ?>" alt="<?php echo get_option( 'blogname' ); ?>" class="logo-hover">
					<?php } else { ?>
                        <img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo get_option( 'blogname' ); ?>"
                             class="logo-hover">
					<?php } ?>
                    <img src="<?php echo esc_url( $image_logo_mobile ); ?>" alt="<?php echo get_option( 'blogname' ); ?>" class="main-logo logo-mobile">
					<?php

				} elseif ( ! function_exists( 'cs_framework_init' ) ) {
					echo '<span>' . get_option( 'blogname' ) . '</span>';
				} else {
					echo '<span>' . esc_html( cs_get_option( 'text_logo' ) ) . '</span>';
				}
			} ?>
        </a>
	<?php }
}

/*
 * Blog item header.
 */
if ( ! function_exists( 'pixxy_blog_item_hedeader' ) ) {

	function pixxy_blog_item_hedeader( $option, $post_id, $video_params = array(), $classButton = '', $classWrap = '' ) {
		$format = get_post_format( $post_id );
		if ( isset( $option[0]['post_preview_style'] ) ) {
			switch ( $option[0]['post_preview_style'] ) {
				case 'image':
					$image     = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
					$blog_type = cs_get_option( 'blog_type' ) ? cs_get_option( 'blog_type' ) : 'masonry';
					$blog_type = apply_filters( 'pixxy_blog_style', $blog_type );
					$imgClass  = $blog_type == 'masonry' ? '' : 's-img-switch';
					$output    = '';
					if ( ! empty( $image ) && ( $format != 'quote' ) ) {
						$image_alt = (!empty($image[0]) && is_numeric($image[0])) ? get_post_meta( $image[0], '_wp_attachment_image_alt', true) : '';
						$output .= '<div class="post-media">';
						$output .= pixxy_the_lazy_load_flter( $image[0], array(
							'class' => $imgClass,
							'alt'   => $image_alt
						) );
						$output .= '</div>';
					}

					break;
				case 'video':
					$output    = '<div class="post-media video-container iframe-video youtube ' . esc_attr( $classWrap ) . '" data-type-start="click">';
					$video_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
					$image_alt = (!empty($video_img[0]) && is_numeric($video_img[0])) ? get_post_meta( $video_img[0], '_wp_attachment_image_alt', true) : '';
					$output    .= pixxy_the_lazy_load_flter( $video_img[0], array(
						'class' => 's-img-switch',
						'alt'   => $image_alt
					) );

					$video_link = $option[0]['post_preview_video'];

					$output .= '<div class="video-content video-content-blog"><a href="' . esc_url( $video_link ) . '" class="play ion-play ' . esc_attr( $classButton ) . '"></a></div>';
					$output .= '<span class="close fa fa-close"></span>';
					$output .= '</div>';
					break;
				case 'slider':
					$output = '<div class="post-media">';
					$output .= '<div class="img-slider">';
					$output .= '<ul class="slides">';
					$images = explode( ',', $option[0]['post_preview_slider'] );
					foreach ( $images as $image ) {
						$url = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
						if ( ! empty( $url ) ) {
							$image_alt = (!empty($image) && is_numeric($image)) ? get_post_meta( $image, '_wp_attachment_image_alt', true) : '';
							$output .= '<li class="post-slider-img">';
							$output .= pixxy_the_lazy_load_flter( $url, array(
								'class' => 's-img-switch',
								'alt'   => $image_alt
							) );
							$output .= '</li>';
						}
					}
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '</div>';

					break;
				case 'text':
					$output = '<i class="ion-quote"></i><blockquote>';
					$output .= wp_kses_post( $option[0]['post_preview_text'] );
					$output .= '</blockquote>';
					if ( isset( $option[0]['post_preview_author'] ) && ! empty( $option[0]['post_preview_author'] ) ) {
						$output .= '<cite>';
						$output .= wp_kses_post( $option[0]['post_preview_author'] );
						$output .= '</cite>';
					}
					break;
				case 'audio':
					$output = '<div class="post-media">';
					$output .= pixxy_post_media( $option[0]['post_preview_audio'] );
					$output .= '</div>';
					break;
				case 'link':
					$output = '<div class="link-wrap"><i class="icon-basic-link"></i><a href="' . esc_url( $option[0]['post_preview_link'] ) . '">';
					$output .= wp_kses_post( $option[0]['post_preview_link'] );
					$output .= '</a></div>';
					break;
			}
		} else {
			$output = '';
			if ( $format == 'quote' ) {
				$output .= '<i class="ion-quote"></i><blockquote>';
				$output .= get_the_excerpt();
				$output .= '</blockquote>';
			} elseif ( $format == 'link' ) {
				$output .= '<div class="link-wrap"><i class="ion-link"></i>';
				$output .= get_the_content();
				$output .= '</div>';
			} else {
				$image     = wp_get_attachment_image_url( get_post_thumbnail_id( $post_id ), 'large' );
				$blog_type = cs_get_option( 'blog_type' ) ? cs_get_option( 'blog_type' ) : 'masonry';
				$blog_type = apply_filters( 'pixxy_blog_style', $blog_type );
				$imgClass  = $blog_type == 'masonry' ? '' : 's-img-switch';
				if ( ! empty( $image ) ) {
					$image_alt = (!empty($image) && is_numeric($image)) ? get_post_meta( $image, '_wp_attachment_image_alt', true) : '';
					$output .= '<div class="post-media">';
					$output .= pixxy_the_lazy_load_flter( $image, array(
						'class' => $imgClass,
						'alt'   => $image_alt
					) );
					$output .= '</div>';
				}

			}
		}
		echo do_shortcode( $output );
	}

}

/*
* Get Page For Navi
*/
if ( ! function_exists( 'pixxy_get_pages_for_navi' ) ) {
	function pixxy_get_pages_for_navi() {
		$posts = get_posts( "post_type=page&post_status=publish&numberposts=99999&orderby=menu_order" );
		$pages = get_page_hierarchy( $posts );
		$pages = array_keys( $pages );

		return $pages;
	}
}



// Custom row styles for onepage site type+-.
if ( ! function_exists( 'pixxy_dynamic_css' ) ) {
	function pixxy_dynamic_css() {
		require_once get_template_directory() . '/assets/css/custom.css.php';
		wp_die();
	}
}
add_action( 'wp_ajax_nopriv_pixxy_dynamic_css', 'pixxy_dynamic_css' );
add_action( 'wp_ajax_pixxy_dynamic_css', 'pixxy_dynamic_css' );

/*
* pixxy Mini Cart for Woocommerce
*/
if ( ! function_exists( 'pixxy_mini_cart' ) ) {
	function pixxy_mini_cart() {

		if ( class_exists( 'WooCommerce' ) ) {

			ob_start();
			?>
            <div class="pixxy_mini_cart">

				<?php do_action( 'woocommerce_before_mini_cart' ); ?>

                <ul class="cart_list product_list_widget">

					<?php if ( ! WC()->cart->is_empty() ) : ?>

						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
								$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
								$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
                                <li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                                    <div class="mini_cart_item_thumbnail">
										<?php if ( ! $_product->is_visible() ) : ?>
											<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
										<?php else : ?>
                                            <a href="<?php echo esc_url( $product_permalink ); ?>">
												<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
                                            </a>
										<?php endif; ?>
                                    </div>

                                    <div class="mini-cart-data">
                                        <a href="<?php echo esc_url( $product_permalink ); ?>"
                                           class="mini_cart_item_name">
											<?php echo wp_kses_post( $product_name ); ?>
                                        </a>

                                        <div class="mini_cart_item_quantity">
											<?php esc_html_e( 'x', 'pixxy' ); ?>
											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . $cart_item['quantity'] . '</span>', $cart_item, $cart_item_key ); ?>
                                        </div>

                                        <div class="mini_cart_item_price">
											<?php if ( ! empty( $product_price ) ) {
												echo wp_kses_post( $product_price );
											} ?>
                                        </div>


                                    </div>
									<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="woocommerce-mini-cart__remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'pixxy' ),
										esc_attr( $product_id ),
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
									?>
                                </li>
								<?php
							}
						}
						?>

					<?php else : ?>

                        <li class="empty"><?php esc_html_e( 'No products in the cart.', 'pixxy' ); ?></li>

					<?php endif; ?>

                </ul><!-- end product list -->

                <div class="pixxy-buttons">
                    <a href="<?php echo wc_get_cart_url(); ?>"><?php esc_html_e( 'Go to cart', 'pixxy' ); ?><i
                                class="fa fa-arrow-right"></i></a>
                    <p class="woocommerce-mini-cart__total total"><?php esc_html_e( 'Total', 'pixxy' ); ?>
                        : <?php echo WC()->cart->get_cart_subtotal(); ?></p>
                </div>

				<?php if ( ! WC()->cart->is_empty() ) : ?>

					<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
                       class="button checkout wc-forward"><?php esc_html_e( 'Checkout', 'pixxy' ); ?></a>

				<?php endif; ?>

				<?php do_action( 'woocommerce_after_mini_cart' ); ?>

            </div>

			<?php
			return ob_get_clean();
		}
	}
}

if ( ! function_exists( 'pixxy_the_share_posts' ) ) {
	function pixxy_the_share_posts( $post, $show_title = '' ) {
		if ( cs_get_option( 'social_portfolio' ) ) {
			ob_start(); ?>
            <div class="row single-share">
                <div class="ft-part margin-lg-15b">
                    <ul class="social-list">
						<?php if ( ! empty( $show_title ) ) { ?>
                            <li><span><?php esc_html_e( 'Share:', 'pixxy' ); ?></span></li>
						<?php } ?>
                        <li>
                            <a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url( the_permalink() ); ?>&amp;title=<?php echo esc_attr( urlencode( the_title( '', '', false ) ) ); ?>"
                               target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li>
                            <a href="http://pinterest.com/pin/create/link/?url=<?php echo esc_url( urlencode( get_permalink() ) ); ?>&amp;media=<?php echo esc_attr( $pinterestimage[0] ); ?>&amp;description=<?php esc_attr( the_title() ); ?>"
                               class="pinterest" target="_blank" title="Pin This Post"><i
                                        class="fa fa-pinterest-p"></i></a></li>
                        <li>
                            <a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() ); ?>&amp;t=<?php echo esc_attr( urlencode( the_title( '', '', false ) ) ); ?>"
                               class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li>
                            <a href="http://twitter.com/home?status=<?php echo esc_url( urlencode( the_title( '', '', false ) ) ); ?><?php esc_url( the_permalink() ); ?>"
                               class="twitter" target="_blank" title="Tweet"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="http://plus.google.com/share?url=<?php esc_url( the_permalink() ); ?>&amp;title=<?php echo esc_attr( urlencode( the_title( '', '', false ) ) ); ?>"
                               target="_blank" class="gplus"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
			<?php
			echo ob_get_clean();
		}
	}
}

if ( ! function_exists( 'pixxy_get_post_shortcode_params' ) ) {
	function pixxy_get_post_shortcode_params( $tag_shortcode, $string = '', $all = false ) {

		if ( empty( $tag_shortcode ) ) {
			return false;
		}

		if ( empty( $string ) ) {
			global $post;
			$string = $post->post_content;
		}

		preg_match_all( "/" . get_shortcode_regex( array( $tag_shortcode ) ) . "/si",
			$string,
			$matchs );
		if ( ! empty( $matchs[0] ) ) {

			if ( $all ) {
				$params = array();
				foreach ( $matchs[0] as $key => $param ) {
					$this_param = str_replace( '"]', '" ]', $matchs[ $key ][0] );
					$atts       = shortcode_parse_atts( $this_param );
					if ( is_array( $atts ) ) {
						$this_param = array_slice( $atts, 1, - 1 );
						$params[]   = $this_param;
					}
				}

				return $params;
			}

			$params = str_replace( '"]', '" ]', $matchs[0][0] );
			$params = array_slice( shortcode_parse_atts( $params ), 1, - 1 );
			if ( is_array( $params ) ) {
				return $params;
			}

			return false;
		}

		return false;

	}
}

if ( ! function_exists( 'pixxy_include_fonts' ) ) {
	function pixxy_include_fonts( $fonts = '' ) {
		if ( empty( $fonts ) ) {
			return '';
		}

		if ( ! is_array( $fonts ) ) {
			$fonts = array( $name_option );
		}

		foreach ( $fonts as $key => $font ) {
			if ( cs_get_option( $font ) ) {

				$font_family = cs_get_option( $font );
				if ( ! empty( $font_family['family'] ) ) {
					wp_enqueue_style( sanitize_title_with_dashes( $font_family['family'] ), '//fonts.googleapis.com/css?family=' . $font_family['family'] . ':' . $font_family['variant'] . '' );
				}
			}
		}

	}
}

// functions max word in string
if ( ! function_exists( 'pixxy_maxsite_str_word' ) ) {
	function pixxy_maxsite_str_word( $text, $counttext = 10, $sep = ' ' ) {
		$words = explode( $sep, $text );
		if ( count( $words ) > $counttext ) {
			$text = join( $sep, array_slice( $words, 0, $counttext ) );
		}

		return $text;
	}
}


if ( ! function_exists( 'pixxy_excerpt_more' ) ) {
	function pixxy_excerpt_more() {
		return ' ...';
	}

	add_filter( 'excerpt_more', 'pixxy_excerpt_more' );
}

/**
 *
 * ION icons array.
 * @since 1.0.0
 * @version 1.0.0
 *
 */

if ( ! function_exists( 'pixxy_simple_line_icons' ) ) {
	function pixxy_simple_line_icons() {
		return array(
            array('icon-basic-accelerator' => 'icon-basic-accelerator'),
            array('icon-basic-alarm' => 'icon-basic-alarm'),
            array('icon-basic-anchor' => 'icon-basic-anchor'),
            array('icon-basic-anticlockwise' => 'icon-basic-anticlockwise'),
            array('icon-basic-archive' => 'icon-basic-archive'),
            array('icon-basic-archive-full' => 'icon-basic-archive-full'),
            array('icon-basic-ban' => 'icon-basic-ban'),
            array('icon-basic-battery-charge' => 'icon-basic-battery-charge'),
            array('icon-basic-battery-empty' => 'icon-basic-battery-empty'),
            array('icon-basic-battery-full' => 'icon-basic-battery-full'),
            array('icon-basic-battery-half' => 'icon-basic-battery-half'),
            array('icon-basic-bolt' => 'icon-basic-bolt'),
            array('icon-basic-book' => 'icon-basic-book'),
            array('icon-basic-book-pen' => 'icon-basic-book-pen'),
            array('icon-basic-book-pencil' => 'icon-basic-book-pencil'),
            array('icon-basic-bookmark' => 'icon-basic-bookmark'),
            array('icon-basic-calculator' => 'icon-basic-calculator'),
            array('icon-basic-calendar' => 'icon-basic-calendar'),
            array('icon-basic-cards-diamonds' => 'icon-basic-cards-diamonds'),
            array('icon-basic-cards-hearts' => 'icon-basic-cards-hearts'),
            array('icon-basic-case' => 'icon-basic-case'),
            array('icon-basic-chronometer' => 'icon-basic-chronometer'),
            array('icon-basic-clessidre' => 'icon-basic-clessidre'),
            array('icon-basic-clock' => 'icon-basic-clock'),
            array('icon-basic-clockwise' => 'icon-basic-clockwise'),
            array('icon-basic-cloud' => 'icon-basic-cloud'),
            array('icon-basic-clubs' => 'icon-basic-clubs'),
            array('icon-basic-compass' => 'icon-basic-compass'),
            array('icon-basic-cup' => 'icon-basic-cup'),
            array('icon-basic-diamonds' => 'icon-basic-diamonds'),
            array('icon-basic-display' => 'icon-basic-display'),
            array('icon-basic-download' => 'icon-basic-download'),
            array('icon-basic-exclamation' => 'icon-basic-exclamation'),
            array('icon-basic-eye' => 'icon-basic-eye'),
            array('icon-basic-eye-closed' => 'icon-basic-eye-closed'),
            array('icon-basic-female' => 'icon-basic-female'),
            array('icon-basic-flag1' => 'icon-basic-flag1'),
            array('icon-basic-flag2' => 'icon-basic-flag2'),
            array('icon-basic-floppydisk' => 'icon-basic-floppydisk'),
            array('icon-basic-folder' => 'icon-basic-folder'),
            array('icon-basic-folder-multiple' => 'icon-basic-folder-multiple'),
            array('icon-basic-gear' => 'icon-basic-gear'),
            array('icon-basic-geolocalize-01' => 'icon-basic-geolocalize-01'),
            array('icon-basic-geolocalize-05' => 'icon-basic-geolocalize-05'),
            array('icon-basic-globe' => 'icon-basic-globe'),
            array('icon-basic-gunsight' => 'icon-basic-gunsight'),
            array('icon-basic-hammer' => 'icon-basic-hammer'),
            array('icon-basic-headset' => 'icon-basic-headset'),
            array('icon-basic-heart' => 'icon-basic-heart'),
            array('icon-basic-heart-broken' => 'icon-basic-heart-broken'),
            array('icon-basic-helm' => 'icon-basic-helm'),
            array('icon-basic-home' => 'icon-basic-home'),
            array('icon-basic-info' => 'icon-basic-info'),
            array('icon-basic-ipod' => 'icon-basic-ipod'),
            array('icon-basic-joypad' => 'icon-basic-joypad'),
            array('icon-basic-key' => 'icon-basic-key'),
            array('icon-basic-keyboard' => 'icon-basic-keyboard'),
            array('icon-basic-laptop' => 'icon-basic-laptop'),
            array('icon-basic-life-buoy' => 'icon-basic-life-buoy'),
            array('icon-basic-lightbulb' => 'icon-basic-lightbulb'),
            array('icon-basic-link' => 'icon-basic-link'),
            array('icon-basic-lock' => 'icon-basic-lock'),
            array('icon-basic-lock-open' => 'icon-basic-lock-open'),
            array('icon-basic-magic-mouse' => 'icon-basic-magic-mouse'),
            array('icon-basic-magnifier' => 'icon-basic-magnifier'),
            array('icon-basic-magnifier-minus' => 'icon-basic-magnifier-minus'),
            array('icon-basic-magnifier-plus' => 'icon-basic-magnifier-plus'),
            array('icon-basic-mail' => 'icon-basic-mail'),
            array('icon-basic-mail-multiple' => 'icon-basic-mail-multiple'),
            array('icon-basic-mail-open' => 'icon-basic-mail-open'),
            array('icon-basic-mail-open-text' => 'icon-basic-mail-open-text'),
            array('icon-basic-male' => 'icon-basic-male'),
            array('icon-basic-map' => 'icon-basic-map'),
            array('icon-basic-message' => 'icon-basic-message'),
            array('icon-basic-message-multiple' => 'icon-basic-message-multiple'),
            array('icon-basic-message-txt' => 'icon-basic-message-txt'),
            array('icon-basic-mixer2' => 'icon-basic-mixer2'),
            array('icon-basic-mouse' => 'icon-basic-mouse'),
            array('icon-basic-notebook' => 'icon-basic-notebook'),
            array('icon-basic-notebook-pen' => 'icon-basic-notebook-pen'),
            array('icon-basic-notebook-pencil' => 'icon-basic-notebook-pencil'),
            array('icon-basic-paperplane' => 'icon-basic-paperplane'),
            array('icon-basic-pencil-ruler' => 'icon-basic-pencil-ruler'),
            array('icon-basic-pencil-ruler-pen' => 'icon-basic-pencil-ruler-pen'),
            array('icon-basic-photo' => 'icon-basic-photo'),
            array('icon-basic-picture' => 'icon-basic-picture'),
            array('icon-basic-picture-multiple' => 'icon-basic-picture-multiple'),
            array('icon-basic-pin1' => 'icon-basic-pin1'),
            array('icon-basic-pin2' => 'icon-basic-pin2'),
            array('icon-basic-postcard' => 'icon-basic-postcard'),
            array('icon-basic-postcard-multiple' => 'icon-basic-postcard-multiple'),
            array('icon-basic-printer' => 'icon-basic-printer'),
            array('icon-basic-question' => 'icon-basic-question'),
            array('icon-basic-rss' => 'icon-basic-rss'),
            array('icon-basic-server' => 'icon-basic-server'),
            array('icon-basic-server2' => 'icon-basic-server2'),
            array('icon-basic-server-cloud' => 'icon-basic-server-cloud'),
            array('icon-basic-server-download' => 'icon-basic-server-download'),
            array('icon-basic-server-upload' => 'icon-basic-server-upload'),
            array('icon-basic-settings' => 'icon-basic-settings'),
            array('icon-basic-share' => 'icon-basic-share'),
            array('icon-basic-sheet' => 'icon-basic-sheet'),
            array('icon-basic-sheet-multiple' => 'icon-basic-sheet-multiple'),
            array('icon-basic-sheet-pen' => 'icon-basic-sheet-pen'),
            array('icon-basic-sheet-pencil' => 'icon-basic-sheet-pencil'),
            array('icon-basic-sheet-txt' => 'icon-basic-sheet-txt'),
            array('icon-basic-signs' => 'icon-basic-signs'),
            array('icon-basic-smartphone' => 'icon-basic-smartphone'),
            array('icon-basic-spades' => 'icon-basic-spades'),
            array('icon-basic-spread' => 'icon-basic-spread'),
            array('icon-basic-spread-bookmark' => 'icon-basic-spread-bookmark'),
            array('icon-basic-spread-text' => 'icon-basic-spread-text'),
            array('icon-basic-spread-text-bookmark' => 'icon-basic-spread-bookmark'),
            array('icon-basic-star' => 'icon-basic-star'),
            array('icon-basic-tablet' => 'icon-basic-tablet'),
            array('icon-basic-target' => 'icon-basic-target'),
            array('icon-basic-todo' => 'icon-basic-todo'),
            array('icon-basic-todo-pen' => 'icon-basic-todo-pen'),
            array('icon-basic-todo-pencil' => 'icon-basic-todo-pencil'),
            array('icon-basic-todo-txt' => 'icon-basic-todo-txt'),
            array('icon-basic-todolist-pen' => 'icon-basic-todolist-pen'),
            array('icon-basic-todolist-pencil' => 'icon-basic-todolist-pencil'),
            array('icon-basic-trashcan' => 'icon-basic-trashcan'),
            array('icon-basic-trashcan-full' => 'icon-basic-trashcan-full'),
            array('icon-basic-trashcan-refresh' => 'icon-basic-trashcan-refresh'),
            array('icon-basic-trashcan-remove' => 'icon-basic-trashcan-remove'),
            array('icon-basic-upload' => 'icon-basic-upload'),
            array('icon-basic-usb' => 'icon-basic-usb'),
            array('icon-basic-video' => 'icon-basic-video'),
            array('icon-basic-watch' => 'icon-basic-watch'),
            array('icon-basic-webpage' => 'icon-basic-webpage'),
            array('icon-basic-webpage-img-txt' => 'icon-basic-webpage-img-txt'),
            array('icon-basic-webpage-multiple' => 'icon-basic-webpage-multiple'),
            array('icon-basic-webpage-txt' => 'icon-basic-webpage-txt'),
            array('icon-basic-world' => 'icon-basic-world'),
		);
	}
}

if ( ! function_exists( 'pixxy_ionicons_icons' ) ) {
	function pixxy_ionicons_icons() {
		return array(
			array( 'ion-alert' => 'ion-alert' ),
			array( 'ion-alert-circled' => 'ion-alert-circled' ),
			array( 'ion-android-add' => 'ion-android-add' ),
			array( 'ion-android-add-circle' => 'ion-android-add-circle' ),
			array( 'ion-android-alarm-clock' => 'ion-android-alarm-clock' ),
			array( 'ion-android-alert' => 'ion-android-alert' ),
			array( 'ion-android-apps' => 'ion-android-apps' ),
			array( 'ion-android-archive' => 'ion-android-archive' ),
			array( 'ion-android-arrow-back' => 'ion-android-arrow-back' ),
			array( 'ion-android-arrow-down' => 'ion-android-arrow-down' ),
			array( 'ion-android-arrow-dropdown' => 'ion-android-arrow-dropdown' ),
			array( 'ion-android-arrow-dropdown-circle' => 'ion-android-arrow-dropdown-circle' ),
			array( 'ion-android-arrow-dropleft' => 'ion-android-arrow-dropleft' ),
			array( 'ion-android-arrow-dropleft-circle' => 'ion-android-arrow-dropleft-circle' ),
			array( 'ion-android-arrow-dropright' => 'ion-android-arrow-dropright' ),
			array( 'ion-android-arrow-dropright-circle' => 'ion-android-arrow-dropright-circle' ),
			array( 'ion-android-arrow-dropup' => 'ion-android-arrow-dropup' ),
			array( 'ion-android-arrow-dropup-circle' => 'ion-android-arrow-dropup-circle' ),
			array( 'ion-android-arrow-forward' => 'ion-android-arrow-forward' ),
			array( 'ion-android-arrow-up' => 'ion-android-arrow-up' ),
			array( 'ion-android-attach' => 'ion-android-attach' ),
			array( 'ion-android-bar' => 'ion-android-bar' ),
			array( 'ion-android-bicycle' => 'ion-android-bicycle' ),
			array( 'ion-android-boat' => 'ion-android-boat' ),
			array( 'ion-android-bookmark' => 'ion-android-bookmark' ),
			array( 'ion-android-bulb' => 'ion-android-bulb' ),
			array( 'ion-android-bus' => 'ion-android-bus' ),
			array( 'ion-android-calendar' => 'ion-android-calendar' ),
			array( 'ion-android-call' => 'ion-android-call' ),
			array( 'ion-android-camera' => 'ion-android-camera' ),
			array( 'ion-android-cancel' => 'ion-android-cancel' ),
			array( 'ion-android-car' => 'ion-android-car' ),
			array( 'ion-android-cart' => 'ion-android-cart' ),
			array( 'ion-android-chat' => 'ion-android-chat' ),
			array( 'ion-android-checkbox' => 'ion-android-checkbox' ),
			array( 'ion-android-checkbox-blank' => 'ion-android-checkbox-blank' ),
			array( 'ion-android-checkbox-outline' => 'ion-android-checkbox-outline' ),
			array( 'ion-android-checkbox-outline-blank' => 'ion-android-checkbox-outline-blank' ),
			array( 'ion-android-checkmark-circle' => 'ion-android-checkmark-circle' ),
			array( 'ion-android-clipboard' => 'ion-android-clipboard' ),
			array( 'ion-android-close' => 'ion-android-close' ),
			array( 'ion-android-cloud' => 'ion-android-cloud' ),
			array( 'ion-android-cloud-circle' => 'ion-android-cloud-circle' ),
			array( 'ion-android-cloud-done' => 'ion-android-cloud-done' ),
			array( 'ion-android-cloud-outline' => 'ion-android-cloud-outline' ),
			array( 'ion-android-color-palette' => 'ion-android-color-palette' ),
			array( 'ion-android-compass' => 'ion-android-compass' ),
			array( 'ion-android-contact' => 'ion-android-contact' ),
			array( 'ion-android-contacts' => 'ion-android-contacts' ),
			array( 'ion-android-contract' => 'ion-android-contract' ),
			array( 'ion-android-create' => 'ion-android-create' ),
			array( 'ion-android-delete' => 'ion-android-delete' ),
			array( 'ion-android-desktop' => 'ion-android-desktop' ),
			array( 'ion-android-document' => 'ion-android-document' ),
			array( 'ion-android-done' => 'ion-android-done' ),
			array( 'ion-android-done-all' => 'ion-android-done-all' ),
			array( 'ion-android-download' => 'ion-android-download' ),
			array( 'ion-android-drafts' => 'ion-android-drafts' ),
			array( 'ion-android-exit' => 'ion-android-exit' ),
			array( 'ion-android-expand' => 'ion-android-expand' ),
			array( 'ion-android-favorite' => 'ion-android-favorite' ),
			array( 'ion-android-favorite-outline' => 'ion-android-favorite-outline' ),
			array( 'ion-android-film' => 'ion-android-film' ),
			array( 'ion-android-folder' => 'ion-android-folder' ),
			array( 'ion-android-folder-open' => 'ion-android-folder-open' ),
			array( 'ion-android-funnel' => 'ion-android-funnel' ),
			array( 'ion-android-globe' => 'ion-android-globe' ),
			array( 'ion-android-hand' => 'ion-android-hand' ),
			array( 'ion-android-hangout' => 'ion-android-hangout' ),
			array( 'ion-android-happy' => 'ion-android-happy' ),
			array( 'ion-android-home' => 'ion-android-home' ),
			array( 'ion-android-image' => 'ion-android-image' ),
			array( 'ion-android-laptop' => 'ion-android-laptop' ),
			array( 'ion-android-list' => 'ion-android-list' ),
			array( 'ion-android-locate' => 'ion-android-locate' ),
			array( 'ion-android-lock' => 'ion-android-lock' ),
			array( 'ion-android-mail' => 'ion-android-mail' ),
			array( 'ion-android-map' => 'ion-android-map' ),
			array( 'ion-android-menu' => 'ion-android-menu' ),
			array( 'ion-android-microphone' => 'ion-android-microphone' ),
			array( 'ion-android-microphone-off' => 'ion-android-microphone-off' ),
			array( 'ion-android-more-horizontal' => 'ion-android-more-horizontal' ),
			array( 'ion-android-more-vertical' => 'ion-android-more-vertical' ),
			array( 'ion-android-navigate' => 'ion-android-navigate' ),
			array( 'ion-android-notifications' => 'ion-android-notifications' ),
			array( 'ion-android-notifications-none' => 'ion-android-notifications-none' ),
			array( 'ion-android-notifications-off' => 'ion-android-notifications-off' ),
			array( 'ion-android-open' => 'ion-android-open' ),
			array( 'ion-android-options' => 'ion-android-options' ),
			array( 'ion-android-people' => 'ion-android-people' ),
			array( 'ion-android-person' => 'ion-android-person' ),
			array( 'ion-android-person-add' => 'ion-android-person-add' ),
			array( 'ion-android-phone-landscape' => 'ion-android-phone-landscape' ),
			array( 'ion-android-phone-portrait' => 'ion-android-phone-portrait' ),
			array( 'ion-android-pin' => 'ion-android-pin' ),
			array( 'ion-android-plane' => 'ion-android-plane' ),
			array( 'ion-android-playstore' => 'ion-android-playstore' ),
			array( 'ion-android-print' => 'ion-android-print' ),
			array( 'ion-android-radio-button-off' => 'ion-android-radio-button-off' ),
			array( 'ion-android-radio-button-on' => 'ion-android-radio-button-on' ),
			array( 'ion-android-refresh' => 'ion-android-refresh' ),
			array( 'ion-android-remove' => 'ion-android-remove' ),
			array( 'ion-android-remove-circle' => 'ion-android-remove-circle' ),
			array( 'ion-android-restaurant' => 'ion-android-restaurant' ),
			array( 'ion-android-sad' => 'ion-android-sad' ),
			array( 'ion-android-search' => 'ion-android-search' ),
			array( 'ion-android-send' => 'ion-android-send' ),
			array( 'ion-android-settings' => 'ion-android-settings' ),
			array( 'ion-android-share' => 'ion-android-share' ),
			array( 'ion-android-share-alt' => 'ion-android-share-alt' ),
			array( 'ion-android-star' => 'ion-android-star' ),
			array( 'ion-android-star-half' => 'ion-android-star-half' ),
			array( 'ion-android-star-outline' => 'ion-android-star-outline' ),
			array( 'ion-android-stopwatch' => 'ion-android-stopwatch' ),
			array( 'ion-android-subway' => 'ion-android-subway' ),
			array( 'ion-android-sunny' => 'ion-android-sunny' ),
			array( 'ion-android-sync' => 'ion-android-sync' ),
			array( 'ion-android-textsms' => 'ion-android-textsms' ),
			array( 'ion-android-time' => 'ion-android-time' ),
			array( 'ion-android-train' => 'ion-android-train' ),
			array( 'ion-android-unlock' => 'ion-android-unlock' ),
			array( 'ion-android-upload' => 'ion-android-upload' ),
			array( 'ion-android-volume-down' => 'ion-android-volume-down' ),
			array( 'ion-android-volume-mute' => 'ion-android-volume-mute' ),
			array( 'ion-android-volume-off' => 'ion-android-volume-off' ),
			array( 'ion-android-volume-up' => 'ion-android-volume-up' ),
			array( 'ion-android-walk' => 'ion-android-walk' ),
			array( 'ion-android-warning' => 'ion-android-warning' ),
			array( 'ion-android-watch' => 'ion-android-watch' ),
			array( 'ion-android-wifi' => 'ion-android-wifi' ),
			array( 'ion-aperture' => 'ion-aperture' ),
			array( 'ion-archive' => 'ion-archive' ),
			array( 'ion-arrow-down-a' => 'ion-arrow-down-a' ),
			array( 'ion-arrow-down-b' => 'ion-arrow-down-b' ),
			array( 'ion-arrow-down-c' => 'ion-arrow-down-c' ),
			array( 'ion-arrow-expand' => 'ion-arrow-expand' ),
			array( 'ion-arrow-graph-down-left' => 'ion-arrow-graph-down-left' ),
			array( 'ion-arrow-graph-down-right' => 'ion-arrow-graph-down-right' ),
			array( 'ion-arrow-graph-up-left' => 'ion-arrow-graph-up-left' ),
			array( 'ion-arrow-graph-up-right' => 'ion-arrow-graph-up-right' ),
			array( 'ion-arrow-left-a' => 'ion-arrow-left-a' ),
			array( 'ion-arrow-left-b' => 'ion-arrow-left-b' ),
			array( 'ion-arrow-left-c' => 'ion-arrow-left-c' ),
			array( 'ion-arrow-move' => 'ion-arrow-move' ),
			array( 'ion-arrow-resize' => 'ion-arrow-resize' ),
			array( 'ion-arrow-return-left' => 'ion-arrow-return-left' ),
			array( 'ion-arrow-return-right' => 'ion-arrow-return-right' ),
			array( 'ion-arrow-right-a' => 'ion-arrow-right-a' ),
			array( 'ion-arrow-right-b' => 'ion-arrow-right-b' ),
			array( 'ion-arrow-right-c' => 'ion-arrow-right-c' ),
			array( 'ion-arrow-shrink' => 'ion-arrow-shrink' ),
			array( 'ion-arrow-swap' => 'ion-arrow-swap' ),
			array( 'ion-arrow-up-a' => 'ion-arrow-up-a' ),
			array( 'ion-arrow-up-b' => 'ion-arrow-up-b' ),
			array( 'ion-arrow-up-c' => 'ion-arrow-up-c' ),
			array( 'ion-asterisk' => 'ion-asterisk' ),
			array( 'ion-at' => 'ion-at' ),
			array( 'ion-backspace' => 'ion-backspace' ),
			array( 'ion-backspace-outline' => 'ion-backspace-outline' ),
			array( 'ion-bag' => 'ion-bag' ),
			array( 'ion-battery-charging' => 'ion-battery-charging' ),
			array( 'ion-battery-empty' => 'ion-battery-empty' ),
			array( 'ion-battery-full' => 'ion-battery-full' ),
			array( 'ion-battery-half' => 'ion-battery-half' ),
			array( 'ion-battery-low' => 'ion-battery-low' ),
			array( 'ion-beaker' => 'ion-beaker' ),
			array( 'ion-beer' => 'ion-beer' ),
			array( 'ion-bluetooth' => 'ion-bluetooth' ),
			array( 'ion-bonfire' => 'ion-bonfire' ),
			array( 'ion-bookmark' => 'ion-bookmark' ),
			array( 'ion-bowtie' => 'ion-bowtie' ),
			array( 'ion-briefcase' => 'ion-briefcase' ),
			array( 'ion-bug' => 'ion-bug' ),
			array( 'ion-calculator' => 'ion-calculator' ),
			array( 'ion-calendar' => 'ion-calendar' ),
			array( 'ion-camera' => 'ion-camera' ),
			array( 'ion-card' => 'ion-card' ),
			array( 'ion-cash' => 'ion-cash' ),
			array( 'ion-chatbox' => 'ion-chatbox' ),
			array( 'ion-chatbox-working' => 'ion-chatbox-working' ),
			array( 'ion-chatboxes' => 'ion-chatboxes' ),
			array( 'ion-chatbubble' => 'ion-chatbubble' ),
			array( 'ion-chatbubble-working' => 'ion-chatbubble-working' ),
			array( 'ion-chatbubbles' => 'ion-chatbubbles' ),
			array( 'ion-checkmark' => 'ion-checkmark' ),
			array( 'ion-checkmark-circled' => 'ion-checkmark-circled' ),
			array( 'ion-checkmark-round' => 'ion-checkmark-round' ),
			array( 'ion-chevron-down' => 'ion-chevron-down' ),
			array( 'ion-chevron-left' => 'ion-chevron-left' ),
			array( 'ion-chevron-right' => 'ion-chevron-right' ),
			array( 'ion-chevron-up' => 'ion-chevron-up' ),
			array( 'ion-clipboard' => 'ion-clipboard' ),
			array( 'ion-clock' => 'ion-clock' ),
			array( 'ion-close' => 'ion-close' ),
			array( 'ion-close-circled' => 'ion-close-circled' ),
			array( 'ion-close-round' => 'ion-close-round' ),
			array( 'ion-closed-captioning' => 'ion-closed-captioning' ),
			array( 'ion-cloud' => 'ion-cloud' ),
			array( 'ion-code' => 'ion-code' ),
			array( 'ion-code-download' => 'ion-code-download' ),
			array( 'ion-code-working' => 'ion-code-working' ),
			array( 'ion-coffee' => 'ion-coffee' ),
			array( 'ion-compass' => 'ion-compass' ),
			array( 'ion-compose' => 'ion-compose' ),
			array( 'ion-connection-bars' => 'ion-connection-bars' ),
			array( 'ion-contrast' => 'ion-contrast' ),
			array( 'ion-crop' => 'ion-crop' ),
			array( 'ion-cube' => 'ion-cube' ),
			array( 'ion-disc' => 'ion-disc' ),
			array( 'ion-document' => 'ion-document' ),
			array( 'ion-document-text' => 'ion-document-text' ),
			array( 'ion-drag' => 'ion-drag' ),
			array( 'ion-earth' => 'ion-earth' ),
			array( 'ion-easel' => 'ion-easel' ),
			array( 'ion-edit' => 'ion-edit' ),
			array( 'ion-egg' => 'ion-egg' ),
			array( 'ion-eject' => 'ion-eject' ),
			array( 'ion-email' => 'ion-email' ),
			array( 'ion-email-unread' => 'ion-email-unread' ),
			array( 'ion-erlenmeyer-flask' => 'ion-erlenmeyer-flask' ),
			array( 'ion-erlenmeyer-flask-bubbles' => 'ion-erlenmeyer-flask-bubbles' ),
			array( 'ion-eye' => 'ion-eye' ),
			array( 'ion-eye-disabled' => 'ion-eye-disabled' ),
			array( 'ion-female' => 'ion-female' ),
			array( 'ion-filing' => 'ion-filing' ),
			array( 'ion-film-marker' => 'ion-film-marker' ),
			array( 'ion-fireball' => 'ion-fireball' ),
			array( 'ion-flag' => 'ion-flag' ),
			array( 'ion-flame' => 'ion-flame' ),
			array( 'ion-flash' => 'ion-flash' ),
			array( 'ion-flash-off' => 'ion-flash-off' ),
			array( 'ion-folder' => 'ion-folder' ),
			array( 'ion-fork' => 'ion-fork' ),
			array( 'ion-fork-repo' => 'ion-fork-repo' ),
			array( 'ion-forward' => 'ion-forward' ),
			array( 'ion-funnel' => 'ion-funnel' ),
			array( 'ion-gear-a' => 'ion-gear-a' ),
			array( 'ion-gear-b' => 'ion-gear-b' ),
			array( 'ion-grid' => 'ion-grid' ),
			array( 'ion-hammer' => 'ion-hammer' ),
			array( 'ion-happy' => 'ion-happy' ),
			array( 'ion-happy-outline' => 'ion-happy-outline' ),
			array( 'ion-headphone' => 'ion-headphone' ),
			array( 'ion-heart' => 'ion-heart' ),
			array( 'ion-heart-broken' => 'ion-heart-broken' ),
			array( 'ion-help' => 'ion-help' ),
			array( 'ion-help-buoy' => 'ion-help-buoy' ),
			array( 'ion-help-circled' => 'ion-help-circled' ),
			array( 'ion-home' => 'ion-home' ),
			array( 'ion-icecream' => 'ion-icecream' ),
			array( 'ion-image' => 'ion-image' ),
			array( 'ion-images' => 'ion-images' ),
			array( 'ion-information' => 'ion-information' ),
			array( 'ion-information-circled' => 'ion-information-circled' ),
			array( 'ion-ionic' => 'ion-ionic' ),
			array( 'ion-ios-alarm' => 'ion-ios-alarm' ),
			array( 'ion-ios-alarm-outline' => 'ion-ios-alarm-outline' ),
			array( 'ion-ios-albums' => 'ion-ios-albums' ),
			array( 'ion-ios-albums-outline' => 'ion-ios-albums-outline' ),
			array( 'ion-ios-americanfootball' => 'ion-ios-americanfootball' ),
			array( 'ion-ios-americanfootball-outline' => 'ion-ios-americanfootball-outline' ),
			array( 'ion-ios-analytics' => 'ion-ios-analytics' ),
			array( 'ion-ios-analytics-outline' => 'ion-ios-analytics-outline' ),
			array( 'ion-ios-arrow-back' => 'ion-ios-arrow-back' ),
			array( 'ion-ios-arrow-down' => 'ion-ios-arrow-down' ),
			array( 'ion-ios-arrow-forward' => 'ion-ios-arrow-forward' ),
			array( 'ion-ios-arrow-left' => 'ion-ios-arrow-left' ),
			array( 'ion-ios-arrow-right' => 'ion-ios-arrow-right' ),
			array( 'ion-ios-arrow-thin-down' => 'ion-ios-arrow-thin-down' ),
			array( 'ion-ios-arrow-thin-left' => 'ion-ios-arrow-thin-left' ),
			array( 'ion-ios-arrow-thin-right' => 'ion-ios-arrow-thin-right' ),
			array( 'ion-ios-arrow-thin-up' => 'ion-ios-arrow-thin-up' ),
			array( 'ion-ios-arrow-up' => 'ion-ios-arrow-up' ),
			array( 'ion-ios-at' => 'ion-ios-at' ),
			array( 'ion-ios-at-outline' => 'ion-ios-at-outline' ),
			array( 'ion-ios-barcode' => 'ion-ios-barcode' ),
			array( 'ion-ios-barcode-outline' => 'ion-ios-barcode-outline' ),
			array( 'ion-ios-baseball' => 'ion-ios-baseball' ),
			array( 'ion-ios-baseball-outline' => 'ion-ios-baseball-outline' ),
			array( 'ion-ios-basketball' => 'ion-ios-basketball' ),
			array( 'ion-ios-basketball-outline' => 'ion-ios-basketball-outline' ),
			array( 'ion-ios-bell' => 'ion-ios-bell' ),
			array( 'ion-ios-bell-outline' => 'ion-ios-bell-outline' ),
			array( 'ion-ios-body' => 'ion-ios-body' ),
			array( 'ion-ios-body-outline' => 'ion-ios-body-outline' ),
			array( 'ion-ios-bolt' => 'ion-ios-bolt' ),
			array( 'ion-ios-bolt-outline' => 'ion-ios-bolt-outline' ),
			array( 'ion-ios-book' => 'ion-ios-book' ),
			array( 'ion-ios-book-outline' => 'ion-ios-book-outline' ),
			array( 'ion-ios-bookmarks' => 'ion-ios-bookmarks' ),
			array( 'ion-ios-bookmarks-outline' => 'ion-ios-bookmarks-outline' ),
			array( 'ion-ios-box' => 'ion-ios-box' ),
			array( 'ion-ios-box-outline' => 'ion-ios-box-outline' ),
			array( 'ion-ios-briefcase' => 'ion-ios-briefcase' ),
			array( 'ion-ios-briefcase-outline' => 'ion-ios-briefcase-outline' ),
			array( 'ion-ios-browsers' => 'ion-ios-browsers' ),
			array( 'ion-ios-browsers-outline' => 'ion-ios-browsers-outline' ),
			array( 'ion-ios-calculator' => 'ion-ios-calculator' ),
			array( 'ion-ios-calculator-outline' => 'ion-ios-calculator-outline' ),
			array( 'ion-ios-calendar' => 'ion-ios-calendar' ),
			array( 'ion-ios-calendar-outline' => 'ion-ios-calendar-outline' ),
			array( 'ion-ios-camera' => 'ion-ios-camera' ),
			array( 'ion-ios-camera-outline' => 'ion-ios-camera-outline' ),
			array( 'ion-ios-cart' => 'ion-ios-cart' ),
			array( 'ion-ios-cart-outline' => 'ion-ios-cart-outline' ),
			array( 'ion-ios-chatboxes' => 'ion-ios-chatboxes' ),
			array( 'ion-ios-chatboxes-outline' => 'ion-ios-chatboxes-outline' ),
			array( 'ion-ios-chatbubble' => 'ion-ios-chatbubble' ),
			array( 'ion-ios-chatbubble-outline' => 'ion-ios-chatbubble-outline' ),
			array( 'ion-ios-checkmark' => 'ion-ios-checkmark' ),
			array( 'ion-ios-checkmark-empty' => 'ion-ios-checkmark-empty' ),
			array( 'ion-ios-checkmark-outline' => 'ion-ios-checkmark-outline' ),
			array( 'ion-ios-circle-filled' => 'ion-ios-circle-filled' ),
			array( 'ion-ios-circle-outline' => 'ion-ios-circle-outline' ),
			array( 'ion-ios-clock' => 'ion-ios-clock' ),
			array( 'ion-ios-clock-outline' => 'ion-ios-clock-outline' ),
			array( 'ion-ios-close' => 'ion-ios-close' ),
			array( 'ion-ios-close-empty' => 'ion-ios-close-empty' ),
			array( 'ion-ios-close-outline' => 'ion-ios-close-outline' ),
			array( 'ion-ios-cloud' => 'ion-ios-cloud' ),
			array( 'ion-ios-cloud-download' => 'ion-ios-cloud-download' ),
			array( 'ion-ios-cloud-download-outline' => 'ion-ios-cloud-download-outline' ),
			array( 'ion-ios-cloud-outline' => 'ion-ios-cloud-outline' ),
			array( 'ion-ios-cloud-upload' => 'ion-ios-cloud-upload' ),
			array( 'ion-ios-cloud-upload-outline' => 'ion-ios-cloud-upload-outline' ),
			array( 'ion-ios-cloudy' => 'ion-ios-cloudy' ),
			array( 'ion-ios-cloudy-night' => 'ion-ios-cloudy-night' ),
			array( 'ion-ios-cloudy-night-outline' => 'ion-ios-cloudy-night-outline' ),
			array( 'ion-ios-cloudy-outline' => 'ion-ios-cloudy-outline' ),
			array( 'ion-ios-cog' => 'ion-ios-cog' ),
			array( 'ion-ios-cog-outline' => 'ion-ios-cog-outline' ),
			array( 'ion-ios-color-filter' => 'ion-ios-color-filter' ),
			array( 'ion-ios-color-filter-outline' => 'ion-ios-color-filter-outline' ),
			array( 'ion-ios-color-wand' => 'ion-ios-color-wand' ),
			array( 'ion-ios-color-wand-outline' => 'ion-ios-color-wand-outline' ),
			array( 'ion-ios-compose' => 'ion-ios-compose' ),
			array( 'ion-ios-compose-outline' => 'ion-ios-compose-outline' ),
			array( 'ion-ios-contact' => 'ion-ios-contact' ),
			array( 'ion-ios-contact-outline' => 'ion-ios-contact-outline' ),
			array( 'ion-ios-copy' => 'ion-ios-copy' ),
			array( 'ion-ios-copy-outline' => 'ion-ios-copy-outline' ),
			array( 'ion-ios-crop' => 'ion-ios-crop' ),
			array( 'ion-ios-crop-strong' => 'ion-ios-crop-strong' ),
			array( 'ion-ios-download' => 'ion-ios-download' ),
			array( 'ion-ios-download-outline' => 'ion-ios-download-outline' ),
			array( 'ion-ios-drag' => 'ion-ios-drag' ),
			array( 'ion-ios-email' => 'ion-ios-email' ),
			array( 'ion-ios-email-outline' => 'ion-ios-email-outline' ),
			array( 'ion-ios-eye' => 'ion-ios-eye' ),
			array( 'ion-ios-eye-outline' => 'ion-ios-eye-outline' ),
			array( 'ion-ios-fastforward' => 'ion-ios-fastforward' ),
			array( 'ion-ios-fastforward-outline' => 'ion-ios-fastforward-outline' ),
			array( 'ion-ios-filing' => 'ion-ios-filing' ),
			array( 'ion-ios-filing-outline' => 'ion-ios-filing-outline' ),
			array( 'ion-ios-film' => 'ion-ios-film' ),
			array( 'ion-ios-film-outline' => 'ion-ios-film-outline' ),
			array( 'ion-ios-flag' => 'ion-ios-flag' ),
			array( 'ion-ios-flag-outline' => 'ion-ios-flag-outline' ),
			array( 'ion-ios-flame' => 'ion-ios-flame' ),
			array( 'ion-ios-flame-outline' => 'ion-ios-flame-outline' ),
			array( 'ion-ios-flask' => 'ion-ios-flask' ),
			array( 'ion-ios-flask-outline' => 'ion-ios-flask-outline' ),
			array( 'ion-ios-flower' => 'ion-ios-flower' ),
			array( 'ion-ios-flower-outline' => 'ion-ios-flower-outline' ),
			array( 'ion-ios-folder' => 'ion-ios-folder' ),
			array( 'ion-ios-folder-outline' => 'ion-ios-folder-outline' ),
			array( 'ion-ios-football' => 'ion-ios-football' ),
			array( 'ion-ios-football-outline' => 'ion-ios-football-outline' ),
			array( 'ion-ios-game-controller-a' => 'ion-ios-game-controller-a' ),
			array( 'ion-ios-game-controller-a-outline' => 'ion-ios-game-controller-a-outline' ),
			array( 'ion-ios-game-controller-b' => 'ion-ios-game-controller-b' ),
			array( 'ion-ios-game-controller-b-outline' => 'ion-ios-game-controller-b-outline' ),
			array( 'ion-ios-gear' => 'ion-ios-gear' ),
			array( 'ion-ios-gear-outline' => 'ion-ios-gear-outline' ),
			array( 'ion-ios-glasses' => 'ion-ios-glasses' ),
			array( 'ion-ios-glasses-outline' => 'ion-ios-glasses-outline' ),
			array( 'ion-ios-grid-view' => 'ion-ios-grid-view' ),
			array( 'ion-ios-grid-view-outline' => 'ion-ios-grid-view-outline' ),
			array( 'ion-ios-heart' => 'ion-ios-heart' ),
			array( 'ion-ios-heart-outline' => 'ion-ios-heart-outline' ),
			array( 'ion-ios-help' => 'ion-ios-help' ),
			array( 'ion-ios-help-empty' => 'ion-ios-help-empty' ),
			array( 'ion-ios-help-outline' => 'ion-ios-help-outline' ),
			array( 'ion-ios-home' => 'ion-ios-home' ),
			array( 'ion-ios-home-outline' => 'ion-ios-home-outline' ),
			array( 'ion-ios-infinite' => 'ion-ios-infinite' ),
			array( 'ion-ios-infinite-outline' => 'ion-ios-infinite-outline' ),
			array( 'ion-ios-information' => 'ion-ios-information' ),
			array( 'ion-ios-information-empty' => 'ion-ios-information-empty' ),
			array( 'ion-ios-information-outline' => 'ion-ios-information-outline' ),
			array( 'ion-ios-ionic-outline' => 'ion-ios-ionic-outline' ),
			array( 'ion-ios-keypad' => 'ion-ios-keypad' ),
			array( 'ion-ios-keypad-outline' => 'ion-ios-keypad-outline' ),
			array( 'ion-ios-lightbulb' => 'ion-ios-lightbulb' ),
			array( 'ion-ios-lightbulb-outline' => 'ion-ios-lightbulb-outline' ),
			array( 'ion-ios-list' => 'ion-ios-list' ),
			array( 'ion-ios-list-outline' => 'ion-ios-list-outline' ),
			array( 'ion-ios-location' => 'ion-ios-location' ),
			array( 'ion-ios-location-outline' => 'ion-ios-location-outline' ),
			array( 'ion-ios-locked' => 'ion-ios-locked' ),
			array( 'ion-ios-locked-outline' => 'ion-ios-locked-outline' ),
			array( 'ion-ios-loop' => 'ion-ios-loop' ),
			array( 'ion-ios-loop-strong' => 'ion-ios-loop-strong' ),
			array( 'ion-ios-medical' => 'ion-ios-medical' ),
			array( 'ion-ios-medical-outline' => 'ion-ios-medical-outline' ),
			array( 'ion-ios-medkit' => 'ion-ios-medkit' ),
			array( 'ion-ios-medkit-outline' => 'ion-ios-medkit-outline' ),
			array( 'ion-ios-mic' => 'ion-ios-mic' ),
			array( 'ion-ios-mic-off' => 'ion-ios-mic-off' ),
			array( 'ion-ios-mic-outline' => 'ion-ios-mic-outline' ),
			array( 'ion-ios-minus' => 'ion-ios-minus' ),
			array( 'ion-ios-minus-empty' => 'ion-ios-minus-empty' ),
			array( 'ion-ios-minus-outline' => 'ion-ios-minus-outline' ),
			array( 'ion-ios-monitor' => 'ion-ios-monitor' ),
			array( 'ion-ios-monitor-outline' => 'ion-ios-monitor-outline' ),
			array( 'ion-ios-moon' => 'ion-ios-moon' ),
			array( 'ion-ios-moon-outline' => 'ion-ios-moon-outline' ),
			array( 'ion-ios-more' => 'ion-ios-more' ),
			array( 'ion-ios-more-outline' => 'ion-ios-more-outline' ),
			array( 'ion-ios-musical-note' => 'ion-ios-musical-note' ),
			array( 'ion-ios-musical-notes' => 'ion-ios-musical-notes' ),
			array( 'ion-ios-navigate' => 'ion-ios-navigate' ),
			array( 'ion-ios-navigate-outline' => 'ion-ios-navigate-outline' ),
			array( 'ion-ios-nutrition' => 'ion-ios-nutrition' ),
			array( 'ion-ios-nutrition-outline' => 'ion-ios-nutrition-outline' ),
			array( 'ion-ios-paper' => 'ion-ios-paper' ),
			array( 'ion-ios-paper-outline' => 'ion-ios-paper-outline' ),
			array( 'ion-ios-paperplane' => 'ion-ios-paperplane' ),
			array( 'ion-ios-paperplane-outline' => 'ion-ios-paperplane-outline' ),
			array( 'ion-ios-partlysunny' => 'ion-ios-partlysunny' ),
			array( 'ion-ios-partlysunny-outline' => 'ion-ios-partlysunny-outline' ),
			array( 'ion-ios-pause' => 'ion-ios-pause' ),
			array( 'ion-ios-pause-outline' => 'ion-ios-pause-outline' ),
			array( 'ion-ios-paw' => 'ion-ios-paw' ),
			array( 'ion-ios-paw-outline' => 'ion-ios-paw-outline' ),
			array( 'ion-ios-people' => 'ion-ios-people' ),
			array( 'ion-ios-people-outline' => 'ion-ios-people-outline' ),
			array( 'ion-ios-person' => 'ion-ios-person' ),
			array( 'ion-ios-person-outline' => 'ion-ios-person-outline' ),
			array( 'ion-ios-personadd' => 'ion-ios-personadd' ),
			array( 'ion-ios-personadd-outline' => 'ion-ios-personadd-outline' ),
			array( 'ion-ios-photos' => 'ion-ios-photos' ),
			array( 'ion-ios-photos-outline' => 'ion-ios-photos-outline' ),
			array( 'ion-ios-pie' => 'ion-ios-pie' ),
			array( 'ion-ios-pie-outline' => 'ion-ios-pie-outline' ),
			array( 'ion-ios-pint' => 'ion-ios-pint' ),
			array( 'ion-ios-pint-outline' => 'ion-ios-pint-outline' ),
			array( 'ion-ios-play' => 'ion-ios-play' ),
			array( 'ion-ios-play-outline' => 'ion-ios-play-outline' ),
			array( 'ion-ios-plus' => 'ion-ios-plus' ),
			array( 'ion-ios-plus-empty' => 'ion-ios-plus-empty' ),
			array( 'ion-ios-plus-outline' => 'ion-ios-plus-outline' ),
			array( 'ion-ios-pricetag' => 'ion-ios-pricetag' ),
			array( 'ion-ios-pricetag-outline' => 'ion-ios-pricetag-outline' ),
			array( 'ion-ios-pricetags' => 'ion-ios-pricetags' ),
			array( 'ion-ios-pricetags-outline' => 'ion-ios-pricetags-outline' ),
			array( 'ion-ios-printer' => 'ion-ios-printer' ),
			array( 'ion-ios-printer-outline' => 'ion-ios-printer-outline' ),
			array( 'ion-ios-pulse' => 'ion-ios-pulse' ),
			array( 'ion-ios-pulse-strong' => 'ion-ios-pulse-strong' ),
			array( 'ion-ios-rainy' => 'ion-ios-rainy' ),
			array( 'ion-ios-rainy-outline' => 'ion-ios-rainy-outline' ),
			array( 'ion-ios-recording' => 'ion-ios-recording' ),
			array( 'ion-ios-recording-outline' => 'ion-ios-recording-outline' ),
			array( 'ion-ios-redo' => 'ion-ios-redo' ),
			array( 'ion-ios-redo-outline' => 'ion-ios-redo-outline' ),
			array( 'ion-ios-refresh' => 'ion-ios-refresh' ),
			array( 'ion-ios-refresh-empty' => 'ion-ios-refresh-empty' ),
			array( 'ion-ios-refresh-outline' => 'ion-ios-refresh-outline' ),
			array( 'ion-ios-reload' => 'ion-ios-reload' ),
			array( 'ion-ios-reverse-camera' => 'ion-ios-reverse-camera' ),
			array( 'ion-ios-reverse-camera-outline' => 'ion-ios-reverse-camera-outline' ),
			array( 'ion-ios-rewind' => 'ion-ios-rewind' ),
			array( 'ion-ios-rewind-outline' => 'ion-ios-rewind-outline' ),
			array( 'ion-ios-rose' => 'ion-ios-rose' ),
			array( 'ion-ios-rose-outline' => 'ion-ios-rose-outline' ),
			array( 'ion-ios-search' => 'ion-ios-search' ),
			array( 'ion-ios-search-strong' => 'ion-ios-search-strong' ),
			array( 'ion-ios-settings' => 'ion-ios-settings' ),
			array( 'ion-ios-settings-strong' => 'ion-ios-settings-strong' ),
			array( 'ion-ios-shuffle' => 'ion-ios-shuffle' ),
			array( 'ion-ios-shuffle-strong' => 'ion-ios-shuffle-strong' ),
			array( 'ion-ios-skipbackward' => 'ion-ios-skipbackward' ),
			array( 'ion-ios-skipbackward-outline' => 'ion-ios-skipbackward-outline' ),
			array( 'ion-ios-skipforward' => 'ion-ios-skipforward' ),
			array( 'ion-ios-skipforward-outline' => 'ion-ios-skipforward-outline' ),
			array( 'ion-ios-snowy' => 'ion-ios-snowy' ),
			array( 'ion-ios-speedometer' => 'ion-ios-speedometer' ),
			array( 'ion-ios-speedometer-outline' => 'ion-ios-speedometer-outline' ),
			array( 'ion-ios-star' => 'ion-ios-star' ),
			array( 'ion-ios-star-half' => 'ion-ios-star-half' ),
			array( 'ion-ios-star-outline' => 'ion-ios-star-outline' ),
			array( 'ion-ios-stopwatch' => 'ion-ios-stopwatch' ),
			array( 'ion-ios-stopwatch-outline' => 'ion-ios-stopwatch-outline' ),
			array( 'ion-ios-sunny' => 'ion-ios-sunny' ),
			array( 'ion-ios-sunny-outline' => 'ion-ios-sunny-outline' ),
			array( 'ion-ios-telephone' => 'ion-ios-telephone' ),
			array( 'ion-ios-telephone-outline' => 'ion-ios-telephone-outline' ),
			array( 'ion-ios-tennisball' => 'ion-ios-tennisball' ),
			array( 'ion-ios-tennisball-outline' => 'ion-ios-tennisball-outline' ),
			array( 'ion-ios-thunderstorm' => 'ion-ios-thunderstorm' ),
			array( 'ion-ios-thunderstorm-outline' => 'ion-ios-thunderstorm-outline' ),
			array( 'ion-ios-time' => 'ion-ios-time' ),
			array( 'ion-ios-time-outline' => 'ion-ios-time-outline' ),
			array( 'ion-ios-timer' => 'ion-ios-timer' ),
			array( 'ion-ios-timer-outline' => 'ion-ios-timer-outline' ),
			array( 'ion-ios-toggle' => 'ion-ios-toggle' ),
			array( 'ion-ios-toggle-outline' => 'ion-ios-toggle-outline' ),
			array( 'ion-ios-trash' => 'ion-ios-trash' ),
			array( 'ion-ios-trash-outline' => 'ion-ios-trash-outline' ),
			array( 'ion-ios-undo' => 'ion-ios-undo' ),
			array( 'ion-ios-undo-outline' => 'ion-ios-undo-outline' ),
			array( 'ion-ios-unlocked' => 'ion-ios-unlocked' ),
			array( 'ion-ios-unlocked-outline' => 'ion-ios-unlocked-outline' ),
			array( 'ion-ios-upload' => 'ion-ios-upload' ),
			array( 'ion-ios-upload-outline' => 'ion-ios-upload-outline' ),
			array( 'ion-ios-videocam' => 'ion-ios-videocam' ),
			array( 'ion-ios-videocam-outline' => 'ion-ios-videocam-outline' ),
			array( 'ion-ios-volume-high' => 'ion-ios-volume-high' ),
			array( 'ion-ios-volume-low' => 'ion-ios-volume-low' ),
			array( 'ion-ios-wineglass' => 'ion-ios-wineglass' ),
			array( 'ion-ios-wineglass-outline' => 'ion-ios-wineglass-outline' ),
			array( 'ion-ios-world' => 'ion-ios-world' ),
			array( 'ion-ios-world-outline' => 'ion-ios-world-outline' ),
			array( 'ion-ipad' => 'ion-ipad' ),
			array( 'ion-iphone' => 'ion-iphone' ),
			array( 'ion-ipod' => 'ion-ipod' ),
			array( 'ion-jet' => 'ion-jet' ),
			array( 'ion-key' => 'ion-key' ),
			array( 'ion-knife' => 'ion-knife' ),
			array( 'ion-laptop' => 'ion-laptop' ),
			array( 'ion-leaf' => 'ion-leaf' ),
			array( 'ion-levels' => 'ion-levels' ),
			array( 'ion-lightbulb' => 'ion-lightbulb' ),
			array( 'ion-link' => 'ion-link' ),
			array( 'ion-load-a' => 'ion-load-a' ),
			array( 'ion-load-b' => 'ion-load-b' ),
			array( 'ion-load-c' => 'ion-load-c' ),
			array( 'ion-load-d' => 'ion-load-d' ),
			array( 'ion-location' => 'ion-location' ),
			array( 'ion-lock-combination' => 'ion-lock-combination' ),
			array( 'ion-locked' => 'ion-locked' ),
			array( 'ion-log-in' => 'ion-log-in' ),
			array( 'ion-log-out' => 'ion-log-out' ),
			array( 'ion-loop' => 'ion-loop' ),
			array( 'ion-magnet' => 'ion-magnet' ),
			array( 'ion-male' => 'ion-male' ),
			array( 'ion-man' => 'ion-man' ),
			array( 'ion-map' => 'ion-map' ),
			array( 'ion-medkit' => 'ion-medkit' ),
			array( 'ion-merge' => 'ion-merge' ),
			array( 'ion-mic-a' => 'ion-mic-a' ),
			array( 'ion-mic-b' => 'ion-mic-b' ),
			array( 'ion-mic-c' => 'ion-mic-c' ),
			array( 'ion-minus' => 'ion-minus' ),
			array( 'ion-minus-circled' => 'ion-minus-circled' ),
			array( 'ion-minus-round' => 'ion-minus-round' ),
			array( 'ion-model-s' => 'ion-model-s' ),
			array( 'ion-monitor' => 'ion-monitor' ),
			array( 'ion-more' => 'ion-more' ),
			array( 'ion-mouse' => 'ion-mouse' ),
			array( 'ion-music-note' => 'ion-music-note' ),
			array( 'ion-navicon' => 'ion-navicon' ),
			array( 'ion-navicon-round' => 'ion-navicon-round' ),
			array( 'ion-navigate' => 'ion-navigate' ),
			array( 'ion-network' => 'ion-network' ),
			array( 'ion-no-smoking' => 'ion-no-smoking' ),
			array( 'ion-nuclear' => 'ion-nuclear' ),
			array( 'ion-outlet' => 'ion-outlet' ),
			array( 'ion-paintbrush' => 'ion-paintbrush' ),
			array( 'ion-paintbucket' => 'ion-paintbucket' ),
			array( 'ion-paper-airplane' => 'ion-paper-airplane' ),
			array( 'ion-paperclip' => 'ion-paperclip' ),
			array( 'ion-pause' => 'ion-pause' ),
			array( 'ion-person' => 'ion-person' ),
			array( 'ion-person-add' => 'ion-person-add' ),
			array( 'ion-person-stalker' => 'ion-person-stalker' ),
			array( 'ion-pie-graph' => 'ion-pie-graph' ),
			array( 'ion-pin' => 'ion-pin' ),
			array( 'ion-pinpoint' => 'ion-pinpoint' ),
			array( 'ion-pizza' => 'ion-pizza' ),
			array( 'ion-plane' => 'ion-plane' ),
			array( 'ion-planet' => 'ion-planet' ),
			array( 'ion-play' => 'ion-play' ),
			array( 'ion-playstation' => 'ion-playstation' ),
			array( 'ion-plus' => 'ion-plus' ),
			array( 'ion-plus-circled' => 'ion-plus-circled' ),
			array( 'ion-plus-round' => 'ion-plus-round' ),
			array( 'ion-podium' => 'ion-podium' ),
			array( 'ion-pound' => 'ion-pound' ),
			array( 'ion-power' => 'ion-power' ),
			array( 'ion-pricetag' => 'ion-pricetag' ),
			array( 'ion-pricetags' => 'ion-pricetags' ),
			array( 'ion-printer' => 'ion-printer' ),
			array( 'ion-pull-request' => 'ion-pull-request' ),
			array( 'ion-qr-scanner' => 'ion-qr-scanner' ),
			array( 'ion-quote' => 'ion-quote' ),
			array( 'ion-radio-waves' => 'ion-radio-waves' ),
			array( 'ion-record' => 'ion-record' ),
			array( 'ion-refresh' => 'ion-refresh' ),
			array( 'ion-reply' => 'ion-reply' ),
			array( 'ion-reply-all' => 'ion-reply-all' ),
			array( 'ion-ribbon-a' => 'ion-ribbon-a' ),
			array( 'ion-ribbon-b' => 'ion-ribbon-b' ),
			array( 'ion-sad' => 'ion-sad' ),
			array( 'ion-sad-outline' => 'ion-sad-outline' ),
			array( 'ion-scissors' => 'ion-scissors' ),
			array( 'ion-search' => 'ion-search' ),
			array( 'ion-settings' => 'ion-settings' ),
			array( 'ion-share' => 'ion-share' ),
			array( 'ion-shuffle' => 'ion-shuffle' ),
			array( 'ion-skip-backward' => 'ion-skip-backward' ),
			array( 'ion-skip-forward' => 'ion-skip-forward' ),
			array( 'ion-social-android' => 'ion-social-android' ),
			array( 'ion-social-android-outline' => 'ion-social-android-outline' ),
			array( 'ion-social-angular' => 'ion-social-angular' ),
			array( 'ion-social-angular-outline' => 'ion-social-angular-outline' ),
			array( 'ion-social-apple' => 'ion-social-apple' ),
			array( 'ion-social-apple-outline' => 'ion-social-apple-outline' ),
			array( 'ion-social-bitcoin' => 'ion-social-bitcoin' ),
			array( 'ion-social-bitcoin-outline' => 'ion-social-bitcoin-outline' ),
			array( 'ion-social-buffer' => 'ion-social-buffer' ),
			array( 'ion-social-buffer-outline' => 'ion-social-buffer-outline' ),
			array( 'ion-social-chrome' => 'ion-social-chrome' ),
			array( 'ion-social-chrome-outline' => 'ion-social-chrome-outline' ),
			array( 'ion-social-codepen' => 'ion-social-codepen' ),
			array( 'ion-social-codepen-outline' => 'ion-social-codepen-outline' ),
			array( 'ion-social-css3' => 'ion-social-css3' ),
			array( 'ion-social-css3-outline' => 'ion-social-css3-outline' ),
			array( 'ion-social-designernews' => 'ion-social-designernews' ),
			array( 'ion-social-designernews-outline' => 'ion-social-designernews-outline' ),
			array( 'ion-social-dribbble' => 'ion-social-dribbble' ),
			array( 'ion-social-dribbble-outline' => 'ion-social-dribbble-outline' ),
			array( 'ion-social-dropbox' => 'ion-social-dropbox' ),
			array( 'ion-social-dropbox-outline' => 'ion-social-dropbox-outline' ),
			array( 'ion-social-euro' => 'ion-social-euro' ),
			array( 'ion-social-euro-outline' => 'ion-social-euro-outline' ),
			array( 'ion-social-facebook' => 'ion-social-facebook' ),
			array( 'ion-social-facebook-outline' => 'ion-social-facebook-outline' ),
			array( 'ion-social-foursquare' => 'ion-social-foursquare' ),
			array( 'ion-social-foursquare-outline' => 'ion-social-foursquare-outline' ),
			array( 'ion-social-freebsd-devil' => 'ion-social-freebsd-devil' ),
			array( 'ion-social-github' => 'ion-social-github' ),
			array( 'ion-social-github-outline' => 'ion-social-github-outline' ),
			array( 'ion-social-google' => 'ion-social-google' ),
			array( 'ion-social-google-outline' => 'ion-social-google-outline' ),
			array( 'ion-social-googleplus' => 'ion-social-googleplus' ),
			array( 'ion-social-googleplus-outline' => 'ion-social-googleplus-outline' ),
			array( 'ion-social-hackernews' => 'ion-social-hackernews' ),
			array( 'ion-social-hackernews-outline' => 'ion-social-hackernews-outline' ),
			array( 'ion-social-html5' => 'ion-social-html5' ),
			array( 'ion-social-html5-outline' => 'ion-social-html5-outline' ),
			array( 'ion-social-instagram' => 'ion-social-instagram' ),
			array( 'ion-social-instagram-outline' => 'ion-social-instagram-outline' ),
			array( 'ion-social-javascript' => 'ion-social-javascript' ),
			array( 'ion-social-javascript-outline' => 'ion-social-javascript-outline' ),
			array( 'ion-social-linkedin' => 'ion-social-linkedin' ),
			array( 'ion-social-linkedin-outline' => 'ion-social-linkedin-outline' ),
			array( 'ion-social-markdown' => 'ion-social-markdown' ),
			array( 'ion-social-nodejs' => 'ion-social-nodejs' ),
			array( 'ion-social-octocat' => 'ion-social-octocat' ),
			array( 'ion-social-pinterest' => 'ion-social-pinterest' ),
			array( 'ion-social-pinterest-outline' => 'ion-social-pinterest-outline' ),
			array( 'ion-social-python' => 'ion-social-python' ),
			array( 'ion-social-reddit' => 'ion-social-reddit' ),
			array( 'ion-social-reddit-outline' => 'ion-social-reddit-outline' ),
			array( 'ion-social-rss' => 'ion-social-rss' ),
			array( 'ion-social-rss-outline' => 'ion-social-rss-outline' ),
			array( 'ion-social-sass' => 'ion-social-sass' ),
			array( 'ion-social-skype' => 'ion-social-skype' ),
			array( 'ion-social-skype-outline' => 'ion-social-skype-outline' ),
			array( 'ion-social-snapchat' => 'ion-social-snapchat' ),
			array( 'ion-social-snapchat-outline' => 'ion-social-snapchat-outline' ),
			array( 'ion-social-tumblr' => 'ion-social-tumblr' ),
			array( 'ion-social-tumblr-outline' => 'ion-social-tumblr-outline' ),
			array( 'ion-social-tux' => 'ion-social-tux' ),
			array( 'ion-social-twitch' => 'ion-social-twitch' ),
			array( 'ion-social-twitch-outline' => 'ion-social-twitch-outline' ),
			array( 'ion-social-twitter' => 'ion-social-twitter' ),
			array( 'ion-social-twitter-outline' => 'ion-social-twitter-outline' ),
			array( 'ion-social-usd' => 'ion-social-usd' ),
			array( 'ion-social-usd-outline' => 'ion-social-usd-outline' ),
			array( 'ion-social-vimeo' => 'ion-social-vimeo' ),
			array( 'ion-social-vimeo-outline' => 'ion-social-vimeo-outline' ),
			array( 'ion-social-whatsapp' => 'ion-social-whatsapp' ),
			array( 'ion-social-whatsapp-outline' => 'ion-social-whatsapp-outline' ),
			array( 'ion-social-windows' => 'ion-social-windows' ),
			array( 'ion-social-windows-outline' => 'ion-social-windows-outline' ),
			array( 'ion-social-wordpress' => 'ion-social-wordpress' ),
			array( 'ion-social-wordpress-outline' => 'ion-social-wordpress-outline' ),
			array( 'ion-social-yahoo' => 'ion-social-yahoo' ),
			array( 'ion-social-yahoo-outline' => 'ion-social-yahoo-outline' ),
			array( 'ion-social-yen' => 'ion-social-yen' ),
			array( 'ion-social-yen-outline' => 'ion-social-yen-outline' ),
			array( 'ion-social-youtube' => 'ion-social-youtube' ),
			array( 'ion-social-youtube-outline' => 'ion-social-youtube-outline' ),
			array( 'ion-soup-can' => 'ion-soup-can' ),
			array( 'ion-soup-can-outline' => 'ion-soup-can-outline' ),
			array( 'ion-speakerphone' => 'ion-speakerphone' ),
			array( 'ion-speedometer' => 'ion-speedometer' ),
			array( 'ion-spoon' => 'ion-spoon' ),
			array( 'ion-star' => 'ion-star' ),
			array( 'ion-stats-bars' => 'ion-stats-bars' ),
			array( 'ion-steam' => 'ion-steam' ),
			array( 'ion-stop' => 'ion-stop' ),
			array( 'ion-thermometer' => 'ion-thermometer' ),
			array( 'ion-thumbsdown' => 'ion-thumbsdown' ),
			array( 'ion-thumbsup' => 'ion-thumbsup' ),
			array( 'ion-toggle' => 'ion-toggle' ),
			array( 'ion-toggle-filled' => 'ion-toggle-filled' ),
			array( 'ion-transgender' => 'ion-transgender' ),
			array( 'ion-trash-a' => 'ion-trash-a' ),
			array( 'ion-trash-b' => 'ion-trash-b' ),
			array( 'ion-trophy' => 'ion-trophy' ),
			array( 'ion-tshirt' => 'ion-tshirt' ),
			array( 'ion-tshirt-outline' => 'ion-tshirt-outline' ),
			array( 'ion-umbrella' => 'ion-umbrella' ),
			array( 'ion-university' => 'ion-university' ),
			array( 'ion-unlocked' => 'ion-unlocked' ),
			array( 'ion-upload' => 'ion-upload' ),
			array( 'ion-usb' => 'ion-usb' ),
			array( 'ion-videocamera' => 'ion-videocamera' ),
			array( 'ion-volume-high' => 'ion-volume-high' ),
			array( 'ion-volume-low' => 'ion-volume-low' ),
			array( 'ion-volume-medium' => 'ion-volume-medium' ),
			array( 'ion-volume-mute' => 'ion-volume-mute' ),
			array( 'ion-wand' => 'ion-wand' ),
			array( 'ion-waterdrop' => 'ion-waterdrop' ),
			array( 'ion-wifi' => 'ion-wifi' ),
			array( 'ion-wineglass' => 'ion-wineglass' ),
			array( 'ion-woman' => 'ion-woman' ),
			array( 'ion-wrench' => 'ion-wrench' ),
			array( 'ion-xbox' => 'ion-xbox' ),
		);
	}
}

if ( ! function_exists( 'pixxy_dripicons_icons' ) ) {
    function pixxy_dripicons_icons() {
        return array(
            array('dripicons-alarm' => 'dripicons-alarm'),
            array('dripicons-align-center' => 'dripicons-align-center'),
            array('dripicons-align-justify' => 'dripicons-align-justify'),
            array('dripicons-align-left' => 'dripicons-align-left'),
            array('dripicons-align-right' => 'dripicons-align-right'),
            array('dripicons-anchor' => 'dripicons-anchor'),
            array('dripicons-archive' => 'dripicons-archive'),
            array('dripicons-arrow-down' => 'dripicons-arrow-down'),
            array('dripicons-arrow-left' => 'dripicons-arrow-left'),
            array('dripicons-arrow-right' => 'dripicons-arrow-right'),
            array('dripicons-arrow-thin-down' => 'dripicons-arrow-thin-down'),
            array('dripicons-arrow-thin-left' => 'dripicons-arrow-thin-left'),
            array('dripicons-arrow-thin-right' => 'dripicons-arrow-thin-right'),
            array('dripicons-arrow-thin-up' => 'dripicons-arrow-thin-up'),
            array('dripicons-arrow-up' => 'dripicons-arrow-up'),
            array('dripicons-article' => 'dripicons-article'),
            array('dripicons-backspace' => 'dripicons-backspace'),
            array('dripicons-basket' => 'dripicons-basket'),
            array('dripicons-basketball' => 'dripicons-basketball'),
            array('dripicons-battery-empty' => 'dripicons-battery-empty'),
            array('dripicons-battery-full' => 'dripicons-battery-full'),
            array('dripicons-battery-low' => 'dripicons-battery-low'),
            array('dripicons-battery-medium' => 'dripicons-battery-medium'),
            array('dripicons-bell' => 'dripicons-bell'),
            array('dripicons-blog' => 'dripicons-blog'),
            array('dripicons-bluetooth' => 'dripicons-bluetooth'),
            array('dripicons-bold' => 'dripicons-bold'),
            array('dripicons-bookmark' => 'dripicons-bookmark'),
            array('dripicons-bookmarks' => 'dripicons-bookmarks'),
            array('dripicons-box' => 'dripicons-box'),
            array('dripicons-briefcase' => 'dripicons-briefcase'),
            array('dripicons-brightness-low' => 'dripicons-brightness-low'),
            array('dripicons-brightness-max' => 'dripicons-brightness-max'),
            array('dripicons-brightness-medium' => 'dripicons-brightness-medium'),
            array('dripicons-broadcast' => 'dripicons-broadcast'),
            array('dripicons-browser' => 'dripicons-browser'),
            array('dripicons-browser-upload' => 'dripicons-browser-upload'),
            array('dripicons-brush' => 'dripicons-brush'),
            array('dripicons-calendar' => 'dripicons-calendar'),
            array('dripicons-camcorder' => 'dripicons-camcorder'),
            array('dripicons-camera' => 'dripicons-camera'),
            array('dripicons-card' => 'dripicons-card'),
            array('dripicons-cart' => 'dripicons-cart'),
            array('dripicons-checklist' => 'dripicons-checklist'),
            array('dripicons-checkmark' => 'dripicons-checkmark'),
            array('dripicons-chevron-down' => 'dripicons-chevron-down'),
            array('dripicons-chevron-left' => 'dripicons-chevron-left'),
            array('dripicons-chevron-right' => 'dripicons-chevron-right'),
            array('dripicons-chevron-up' => 'dripicons-chevron-up'),
            array('dripicons-clipboard' => 'dripicons-clipboard'),
            array('dripicons-clock' => 'dripicons-clock'),
            array('dripicons-clockwise' => 'dripicons-clockwise'),
            array('dripicons-cloud' => 'dripicons-cloud'),
            array('dripicons-cloud-download' => 'dripicons-cloud-download'),
            array('dripicons-cloud-upload' => 'dripicons-cloud-upload'),
            array('dripicons-code' => 'dripicons-code'),
            array('dripicons-contract' => 'dripicons-contract'),
            array('dripicons-contract-2' => 'dripicons-contract-2'),
            array('dripicons-conversation' => 'dripicons-conversation'),
            array('dripicons-copy' => 'dripicons-copy'),
            array('dripicons-crop' => 'dripicons-crop'),
            array('dripicons-cross' => 'dripicons-cross'),
            array('dripicons-crosshair' => 'dripicons-crosshair'),
            array('dripicons-cutlery' => 'dripicons-cutlery'),
            array('dripicons-device-desktop' => 'dripicons-device-desktop'),
            array('dripicons-device-mobile' => 'dripicons-device-mobile'),
            array('dripicons-device-tablet' => 'dripicons-device-tablet'),
            array('dripicons-direction' => 'dripicons-direction'),
            array('dripicons-disc' => 'dripicons-disc'),
            array('dripicons-document' => 'dripicons-document'),
            array('dripicons-document-delete' => 'dripicons-document-delete'),
            array('dripicons-document-edit' => 'dripicons-document-edit'),
            array('dripicons-document-new' => 'dripicons-document-new'),
            array('dripicons-document-remove' => 'dripicons-document-remove'),
            array('dripicons-dot' => 'dripicons-dot'),
            array('dripicons-dots-2' => 'dripicons-dots-2'),
            array('dripicons-dots-3' => 'dripicons-dots-3'),
            array('dripicons-download' => 'dripicons-download'),
            array('dripicons-duplicate' => 'dripicons-duplicate'),
            array('dripicons-enter' => 'dripicons-enter'),
            array('dripicons-exit' => 'dripicons-exit'),
            array('dripicons-expand' => 'dripicons-expand'),
            array('dripicons-expand-2' => 'dripicons-expand-2'),
            array('dripicons-experiment' => 'dripicons-experiment'),
            array('dripicons-export' => 'dripicons-export'),
            array('dripicons-feed' => 'dripicons-feed'),
            array('dripicons-flag' => 'dripicons-flag'),
            array('dripicons-flashlight' => 'dripicons-flashlight'),
            array('dripicons-folder' => 'dripicons-folder'),
            array('dripicons-folder-open' => 'dripicons-folder-open'),
            array('dripicons-forward' => 'dripicons-forward'),
            array('dripicons-gaming' => 'dripicons-gaming'),
            array('dripicons-gear' => 'dripicons-gear'),
            array('dripicons-graduation' => 'dripicons-graduation'),
            array('dripicons-graph-bar' => 'dripicons-graph-bar'),
            array('dripicons-graph-line' => 'dripicons-graph-line'),
            array('dripicons-graph-pie' => 'dripicons-graph-pie'),
            array('dripicons-headset' => 'dripicons-headset'),
            array('dripicons-heart' => 'dripicons-heart'),
            array('dripicons-help' => 'dripicons-help'),
            array('dripicons-home' => 'dripicons-home'),
            array('dripicons-hourglass' => 'dripicons-hourglass'),
            array('dripicons-inbox' => 'dripicons-inbox'),
            array('dripicons-information' => 'dripicons-information'),
            array('dripicons-italic' => 'dripicons-italic'),
            array('dripicons-jewel' => 'dripicons-jewel'),
            array('dripicons-lifting' => 'dripicons-lifting'),
            array('dripicons-lightbulb' => 'dripicons-lightbulb'),
            array('dripicons-link' => 'dripicons-link'),
            array('dripicons-link-broken' => 'dripicons-link-broken'),
            array('dripicons-list' => 'dripicons-list'),
            array('dripicons-loading' => 'dripicons-loading'),
            array('dripicons-location' => 'dripicons-location'),
            array('dripicons-lock' => 'dripicons-lock'),
            array('dripicons-lock-open' => 'dripicons-lock-open'),
            array('dripicons-mail' => 'dripicons-mail'),
            array('dripicons-map' => 'dripicons-map'),
            array('dripicons-media-loop' => 'dripicons-media-loop'),
            array('dripicons-media-next' => 'dripicons-media-next'),
            array('dripicons-media-pause' => 'dripicons-media-pause'),
            array('dripicons-media-play' => 'dripicons-media-play'),
            array('dripicons-media-previous' => 'dripicons-media-previous'),
            array('dripicons-media-record' => 'dripicons-media-record'),
            array('dripicons-media-shuffle' => 'dripicons-media-shuffle'),
            array('dripicons-media-stop' => 'dripicons-media-stop'),
            array('dripicons-medical' => 'dripicons-medical'),
            array('dripicons-menu' => 'dripicons-menu'),
            array('dripicons-message' => 'dripicons-message'),
            array('dripicons-meter' => 'dripicons-meter'),
            array('dripicons-microphone' => 'dripicons-microphone'),
            array('dripicons-minus' => 'dripicons-minus'),
            array('dripicons-monitor' => 'dripicons-monitor'),
            array('dripicons-move' => 'dripicons-move'),
            array('dripicons-music' => 'dripicons-music'),
            array('dripicons-network-1' => 'dripicons-network-1'),
            array('dripicons-network-2' => 'dripicons-network-2'),
            array('dripicons-network-3' => 'dripicons-network-3'),
            array('dripicons-network-4' => 'dripicons-network-4'),
            array('dripicons-network-5' => 'dripicons-network-5'),
            array('dripicons-pamphlet' => 'dripicons-pamphlet'),
            array('dripicons-paperclip' => 'dripicons-paperclip'),
            array('dripicons-pencil' => 'dripicons-pencil'),
            array('dripicons-phone' => 'dripicons-phone'),
            array('dripicons-photo' => 'dripicons-photo'),
            array('dripicons-photo-group' => 'dripicons-photo-group'),
            array('dripicons-pill' => 'dripicons-pill'),
            array('dripicons-pin' => 'dripicons-pin'),
            array('dripicons-plus' => 'dripicons-plus'),
            array('dripicons-power' => 'dripicons-power'),
            array('dripicons-preview' => 'dripicons-preview'),
            array('dripicons-print' => 'dripicons-print'),
            array('dripicons-pulse' => 'dripicons-pulse'),
            array('dripicons-question' => 'dripicons-question'),
            array('dripicons-reply' => 'dripicons-reply'),
            array('dripicons-reply-all' => 'dripicons-reply-all'),
            array('dripicons-return' => 'dripicons-return'),
            array('dripicons-retweet' => 'dripicons-retweet'),
            array('dripicons-rocket' => 'dripicons-rocket'),
            array('dripicons-scale' => 'dripicons-scale'),
            array('dripicons-search' => 'dripicons-search'),
            array('dripicons-shopping-bag' => 'dripicons-shopping-bag'),
            array('dripicons-skip' => 'dripicons-skip'),
            array('dripicons-stack' => 'dripicons-stack'),
            array('dripicons-star' => 'dripicons-star'),
            array('dripicons-stopwatch' => 'dripicons-stopwatch'),
            array('dripicons-store' => 'dripicons-store'),
            array('dripicons-suitcase' => 'dripicons-suitcase'),
            array('dripicons-swap' => 'dripicons-swap'),
            array('dripicons-tag' => 'dripicons-tag'),
            array('dripicons-tag-delete' => 'dripicons-tag-delete'),
            array('dripicons-tags' => 'dripicons-tags'),
            array('dripicons-thumbs-down' => 'dripicons-thumbs-down'),
            array('dripicons-thumbs-up' => 'dripicons-thumbs-up'),
            array('dripicons-ticket' => 'dripicons-ticket'),
            array('dripicons-time-reverse' => 'dripicons-time-reverse'),
            array('dripicons-to-do' => 'dripicons-to-do'),
            array('dripicons-toggles' => 'dripicons-toggles'),
            array('dripicons-trash' => 'dripicons-trash'),
            array('dripicons-trophy' => 'dripicons-trophy'),
            array('dripicons-upload' => 'dripicons-upload'),
            array('dripicons-user' => 'dripicons-user'),
            array('dripicons-user-group' => 'dripicons-user-group'),
            array('dripicons-user-id' => 'dripicons-user-id'),
            array('dripicons-vibrate' => 'dripicons-vibrate'),
            array('dripicons-view-apps' => 'dripicons-view-apps'),
            array('dripicons-view-list' => 'dripicons-view-list'),
            array('dripicons-view-list-large' => 'dripicons-view-list-large'),
            array('dripicons-view-thumb' => 'dripicons-view-thumb'),
            array('dripicons-volume-full' => 'dripicons-volume-full'),
            array('dripicons-volume-low' => 'dripicons-volume-low'),
            array('dripicons-volume-medium' => 'dripicons-volume-medium'),
            array('dripicons-volume-off' => 'dripicons-volume-off'),
            array('dripicons-wallet' => 'dripicons-wallet'),
            array('dripicons-warning' => 'dripicons-warning'),
            array('dripicons-web' => 'dripicons-web'),
            array('dripicons-weight' => 'dripicons-weight'),
            array('dripicons-wifi' => 'dripicons-wifi'),
            array('dripicons-wrong' => 'dripicons-wrong'),
            array('dripicons-zoom-in' => 'dripicons-zoom-in'),
            array('dripicons-zoom-out' => 'dripicons-zoom-out')
        );
    }
}


if ( ! function_exists( 'pixxy_search_popup' ) ) {
	function pixxy_search_popup() { ?>
        <div class="site-search" id="search-box">
            <div class="close-search">
                <span class="line"></span>
                <span class="line"></span>
            </div>
            <div class="form-container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ) ?>">
                                <div class="input-group">
                                    <input type="search" value="<?php echo get_search_query() ?>" name="s"
                                           class="search-field"
                                           placeholder="<?php esc_attr_e( 'Search...', 'pixxy' ); ?>"
                                           required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php }
}

add_action( 'pixxy_after_footer', 'pixxy_search_popup', 10 );


/**
 *
 * Like post ajax function.
 *
 **/
if ( ! function_exists( 'pixxy_like_post' ) ) {
	function pixxy_like_post() {
		if ( empty( $_POST ) ) {
			esc_html_e( 'Ajax error', 'pixxy' );
		} else {

			$post_id     = sanitize_text_field( $_POST['post_id'] );
			$count_likes = get_post_meta( $post_id, 'count_likes', true );

			if ( isset( $_COOKIE['post_likes'] ) && ! empty( $_COOKIE['post_likes'] ) ) {
				$ids = explode( ',', $_COOKIE['post_likes'] );
				if ( ( $key = array_search( $post_id, $ids ) ) !== false ) {
					$count_likes = ( $count_likes - 1 >= 0 ) ? ( $count_likes - 1 ) : '0';
					unset( $ids[ $key ] );
				} else {
					$count_likes ++;
					$ids[] = $post_id;
				}

				update_post_meta( $post_id, 'count_likes', $count_likes );
				$ids_list = implode( ',', $ids );
				setcookie( 'post_likes', $ids_list, ( time() + 3600 * 730 ), '/' );
				echo esc_html( $count_likes );
			} else {

				$count_likes ++;
				update_post_meta( $post_id, 'count_likes', $count_likes );
				setcookie( 'post_likes', $post_id, ( time() + 3600 * 730 ), '/' );
				echo esc_html( $count_likes );
			}

		}
		exit;
	}
}

add_action( 'wp_ajax_pixxy_like_post', 'pixxy_like_post' );
add_action( 'wp_ajax_nopriv_pixxy_like_post', 'pixxy_like_post' );


/**
 * Like counter.
 */
if ( ! function_exists( 'pixxy_like_counter' ) ) {
	function pixxy_like_counter() {
		// Count post likes
		$count_post_likes = get_post_meta( get_the_ID(), 'count_likes', true );
		$count_post_likes = ! empty( $count_post_likes ) ? $count_post_likes : 0;

		if ( $count_post_likes !== 0 ) { ?>
            <div class="likes-wrap">
                <?php if(!is_single()){ ?>
                    <i class="icon-basic-heart"></i>
                <?php } ?>
                <div class="post-counts__count">
                <span>
                    <?php if($count_post_likes > 1 && !is_single()){ ?>
                        <i class="count"><?php echo esc_html( $count_post_likes . esc_html__(' Likes', 'pixxy') ); ?></i>
                    <?php }elseif(!is_single()){ ?>
                        <i class="count"><?php echo esc_html( $count_post_likes . esc_html__(' Like', 'pixxy')); ?></i>
                    <?php }else{ ?>
                        <i class="count"><?php echo esc_html( $count_post_likes ); ?></i>
                    <?php }?>
                </span>
                </div>
            </div>
		<?php }
	}
}

/**
 * Like button.
 */
if ( ! function_exists( 'pixxy_like_button' ) ) {
	function pixxy_like_button() { ?>
        <div class="post__likes" data-id="<?php echo get_the_ID(); ?>"></div>
		<?php
	}
}


/**
 *
 * Add new fields to user profile.
 *
 */
if ( ! function_exists( 'pixxy_show_extra_profile_fields' ) ) {
	function pixxy_show_extra_profile_fields( $user ) { ?>

        <h3><?php esc_html_e( 'Extra profile information', 'pixxy' ); ?></h3>

        <table class="form-table">

            <tr>
                <th><label for="twitter"><?php esc_html_e( 'Twitter', 'pixxy' ); ?></label></th>

                <td>
                    <input type="text" name="twitter" id="twitter"
                           value="<?php echo esc_url( get_user_meta( $user->ID, 'twitter', true ) ); ?>"
                           class="regular-text"/><br/>
                    <span class="description"><?php esc_html_e( 'Please enter your Twitter profile link.', 'pixxy' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="facebook"><?php esc_html_e( 'Facebook', 'pixxy' ); ?></label></th>

                <td>
                    <input type="text" name="facebook" id="facebook"
                           value="<?php echo esc_attr( get_user_meta( $user->ID, 'facebook', true ) ); ?>"
                           class="regular-text"/><br/>
                    <span class="description"><?php esc_html_e( 'Please enter your Facebook profile link.', 'pixxy' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="instagram"><?php esc_html_e( 'Instagram', 'pixxy' ); ?></label></th>

                <td>
                    <input type="text" name="instagram" id="instagram"
                           value="<?php echo esc_attr( get_user_meta( $user->ID, 'instagram', true ) ); ?>"
                           class="regular-text"/><br/>
                    <span class="description"><?php esc_html_e( 'Please enter your Instagram profile link.', 'pixxy' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="dribbble"><?php esc_html_e( 'Dribbble', 'pixxy' ); ?></label></th>

                <td>
                    <input type="text" name="dribbble" id="dribbble"
                           value="<?php echo esc_attr( get_user_meta( $user->ID, 'dribbble', true ) ); ?>"
                           class="regular-text"/><br/>
                    <span class="description"><?php esc_html_e( 'Please enter your Dribbble profile link.', 'pixxy' ); ?></span>
                </td>
            </tr>

        </table>
	<?php }
}
add_action( 'show_user_profile', 'pixxy_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'pixxy_show_extra_profile_fields' );

/**
 *
 * Save and update new fields in user profile.
 *
 */
if ( ! function_exists( 'pixxy_save_extra_profile_fields' ) ) {
	function pixxy_save_extra_profile_fields( $user_id ) {

		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}
		update_user_meta( $user_id, 'facebook', esc_url( $_POST['facebook'] ) );
		update_user_meta( $user_id, 'twitter', esc_url( $_POST['twitter'] ) );
		update_user_meta( $user_id, 'instagram', esc_url( $_POST['instagram'] ) );
		update_user_meta( $user_id, 'dribbble', esc_url( $_POST['dribbble'] ) );
	}
}
add_action( 'personal_options_update', 'pixxy_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'pixxy_save_extra_profile_fields' );


/**
 *
 * Menu style
 *
 */


if ( ! function_exists( 'pixxy_fixed_header' ) ) {
	function pixxy_fixed_header( $menu_main_style, $post_id ) {

		$meta_data           = get_post_meta( $post_id, '_custom_page_options', true );
		$meta_data_portfolio = get_post_meta( $post_id, 'pixxy_portfolio_options', true );
		$meta_data_events    = get_post_meta( $post_id, 'pixxy_events_options', true );

		$blog_type        = cs_get_option( 'blog_single_type' ) ? cs_get_option( 'blog_single_type' ) : 'modern';
		$fixed_menu_class = ( is_404() ) ? ' enable_fixed' : '';

        if ( is_404() || ( cs_get_option( 'fixed_transparent_menu_blog' ) && is_single() && get_post_type() == 'post' ) ) {
            $fixed_menu_class .= ' header_trans-fixed';
        } elseif ( isset( $meta_data['style_header'] ) ) {
            if ( $meta_data['style_header'] === 'transparent' ) {
                $fixed_menu_class .= ' header_trans-fixed';
            } elseif ( $meta_data['style_header'] === 'fixed' ) {
                $fixed_menu_class .= ' fixed-header';
            } elseif ( $meta_data['style_header'] === 'none' ) {
                $fixed_menu_class .= ' header_trans-fixed none';
            } elseif ( cs_get_option( 'fixed_menu' ) && cs_get_option( 'transparent_menu' ) && $meta_data['style_header'] === 'empty' ) {
                $fixed_menu_class .= ' header_trans-fixed';
            }

        } elseif ( isset( $meta_data_portfolio['style_header'] ) ) {
            if ( cs_get_option( 'fixed_menu' ) && cs_get_option( 'transparent_menu' ) && $meta_data_portfolio['style_header'] === 'empty' ) {
                $fixed_menu_class .= ' header_trans-fixed';
            } elseif ( $meta_data_portfolio['style_header'] === 'fixed' ) {
                $fixed_menu_class .= ' fixed-header';
            } elseif ( $meta_data_portfolio['style_header'] === 'none' ) {
                $fixed_menu_class .= ' header_trans-fixed none';
            } elseif ( $meta_data_portfolio['style_header'] === 'transparent' ) {
                $fixed_menu_class .= ' header_trans-fixed';
            }
        }elseif(isset($meta_data_events['style_header'] ) ){
            if ( cs_get_option( 'fixed_menu' ) && cs_get_option( 'transparent_menu' ) && $meta_data_events['style_header'] === 'empty' ) {
                $fixed_menu_class .= ' header_trans-fixed';
            } elseif ( $meta_data_events['style_header'] === 'fixed' ) {
                $fixed_menu_class .= ' fixed-header';
            } elseif ( $meta_data_events['style_header'] === 'none' ) {
                $fixed_menu_class .= ' header_trans-fixed none';
            } elseif ( $meta_data_events['style_header'] === 'transparent' ) {
                $fixed_menu_class .= ' header_trans-fixed';
            }
        }

		$fixed_menu_class = ! function_exists( 'cs_framework_init' ) && is_404() ? '' : $fixed_menu_class;
		$fixed_menu_class = is_single() && get_post_type() == 'post' && $blog_type == 'modern' && ! has_post_thumbnail() && ! ( isset( $post_meta[0]['post_preview_style'] ) && ( $post_meta[0]['post_preview_style'] != 'audio' || $post_meta[0]['post_preview_style'] != 'slider' || $post_meta[0]['post_preview_style'] != 'video' ) ) ? '' : $fixed_menu_class;
		$fixed_menu_class = apply_filters( 'pixxy_blog_menu_style', $fixed_menu_class );

        if ( isset( $meta_data['menu_light_text'] ) && $meta_data['menu_light_text'] ) {
            if ( $meta_data['style_header'] == 'transparent' ) {
                $fixed_menu_class .= ' menu_light_text';
            }
        } elseif ( isset( $meta_data_portfolio['menu_light_text'] ) && $meta_data_portfolio['menu_light_text'] ) {
            $fixed_menu_class .= ' menu_light_text';
        }elseif( isset($meta_data_events['menu_light_text'] ) && $meta_data_events['menu_light_text']){
            $fixed_menu_class .= ' menu_light_text';
        }


        if ( isset( $meta_data['scroll_bg_menu'] ) && $meta_data['scroll_bg_menu'] ) {
            if ( $meta_data['scroll_bg_menu']) {
                $fixed_menu_class .= ' fixed-dark';
            }
        } elseif ( isset( $meta_data_portfolio['scroll_bg_menu'] ) && $meta_data_portfolio['scroll_bg_menu'] ) {
            $fixed_menu_class .= ' fixed-dark';
        }elseif( isset($meta_data_events['scroll_bg_menu'] ) && $meta_data_events['scroll_bg_menu']){
            $fixed_menu_class .= ' fixed-dark';
        }

		if ( isset( $meta_data['full_width_menu'] ) && $meta_data['full_width_menu'] ) {
			$fixed_menu_class .= isset( $meta_data['full_width_menu'] ) && $meta_data['full_width_menu'] ? ' full-width-menu' : '';
		}

		$fixed_menu_class = is_tax( 'portfolio-client' ) || is_search() || is_tax( 'portfolio-category' ) ? '' : $fixed_menu_class;

		return $fixed_menu_class;

	}
}

if ( ! function_exists( 'pixxy_main_header_html' ) ) {
	function pixxy_main_header_html() {

		if ( is_page() || is_home() ) {
			$post_id = get_queried_object_id();
		} else {
			$post_id = get_the_ID();
		}

		$meta_data           = get_post_meta( $post_id, '_custom_page_options', true );
		$meta_data_portfolio = get_post_meta( $post_id, 'pixxy_portfolio_options', true );
		$meta_data_events    = get_post_meta( $post_id, 'pixxy_events_options', true );
		$menu_main_style     = cs_get_option( 'menu_style' ) ? cs_get_option( 'menu_style' ) : 'classic';
		$menu_main_style     = is_404() ? 'only_logo' : $menu_main_style;
		$menu_main_style     = ! empty( $menu_main_style ) || ! function_exists( 'cs_framework_init' ) ? $menu_main_style : 'left';

		if ( isset( $meta_data['change_menu'] ) && $meta_data['change_menu'] && isset( $meta_data['menu_style'] ) ) {
			$menu_main_style = $meta_data['menu_style'];
		}

		if ( isset( $meta_data_portfolio['change_menu'] ) && $meta_data_portfolio['change_menu'] && isset( $meta_data_portfolio['menu_style'] ) ) {
			$menu_main_style = $meta_data_portfolio['menu_style'];
		}

		if ( isset( $meta_data_events['change_menu'] ) && $meta_data_events['change_menu'] && isset( $meta_data_events['menu_style'] ) ) {
			$menu_main_style = $meta_data_events['menu_style'];
		}

		get_template_part( 'template-parts/menu/menu', $menu_main_style );

	}
}


add_action( 'pixxy_main_header', 'pixxy_main_header_html' );
