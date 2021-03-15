<?php
/**
 * Classic Menu.
 */

if ( is_page() || is_home() ) {
	$post_id = get_queried_object_id();
} else {
	$post_id = get_the_ID();
}

$fixed_menu_class = pixxy_fixed_header( 'classic', $post_id );

$container = cs_get_option( 'menu_container' );

$meta_data = get_post_meta( $post_id, '_custom_page_options', true );

$container = isset( $meta_data['menu_container'] ) && $meta_data['menu_container'] ?: $container;
$container = $container ? 'container' : 'container-fluid';

$underline = (cs_get_option( 'underline_menu' )) ? 'header_underline' : '';
$underline = isset( $meta_data['underline_menu'] ) && $meta_data['underline_menu'] ? 'header_underline' : $underline;

?>

<div class="header_top_bg <?php echo esc_attr( $fixed_menu_class . ' ' . $underline )  ?>">
    <div class="<?php echo esc_attr( $container ); ?>">
        <div class="row">
            <div class="col-xs-12">
                <header class="right-menu classic">
                    <!-- LOGO -->
					<?php pixxy_site_logo(); ?>
                    <!-- /LOGO -->

                    <!-- MOB MENU ICON -->
                    <a href="#" class="mob-nav">
                        <div class="hamburger">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </a>
                    <!-- /MOB MENU ICON -->

                    <!-- NAVIGATION -->
                    <nav id="topmenu" class="topmenu">
                        <a href="#" class="mob-nav-close">
                            <span><?php esc_html_e( 'close', 'pixxy' ); ?></span>
                            <div class="hamburger">
                                <span class="line"></span>
                                <span class="line"></span>
                            </div>
                        </a>

						<?php pixxy_custom_menu();

						if ( function_exists( 'cs_framework_init' ) ) { ?>
                            <span class="f-right">
                                <span class="search-icon-wrapper">
                                    <i class="ion-android-search open-search"></i>
                                    <?php do_action( 'pixxy_after_footer' ); ?>
                                </span>

                                <?php if ( function_exists( 'WC' ) ) {
                                    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && ( cs_get_option( 'shop_cart_on' ) || ! function_exists( 'cs_framework_init' ) ) ) {
                                        $count = WC()->cart->cart_contents_count; ?>

                                        <div class="mini-cart-wrapper">
                                            <a class="pixxy-shop-icon ion-bag"
                                               href="<?php echo wc_get_cart_url(); ?>"
                                               title="<?php esc_attr_e( 'view your shopping cart', 'pixxy' ); ?>"></a>
                                            <span class="cart-contents">
                                                <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
                                            </span>
                                            <?php echo pixxy_mini_cart(); ?>
                                          </div>
                                    <?php }
                                } ?>
                            </span>
						<?php } ?>
                    </nav>
                    <!-- NAVIGATION -->
                </header>
            </div>
        </div>
    </div>
</div>

