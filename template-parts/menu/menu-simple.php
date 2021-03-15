<?php
/**
 * Simple Menu.
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

<div class="header_top_bg <?php echo esc_attr( $fixed_menu_class )  ?>">
    <div class="<?php echo esc_attr( $container ); ?>">
        <div class="row">
            <div class="col-xs-12">
                <header class="right-menu simple full">
                    <!-- LOGO -->
                    <?php pixxy_site_logo(); ?>
                    <!-- /LOGO -->

                    <!-- MOB MENU ICON -->
                    <a href="#" class="mob-nav mob-but-full">
                        <div class="hamburger">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </a>
                    <!-- /MOB MENU ICON -->

                    <!-- NAVIGATION -->
                    <nav id="topmenu-full" class="topmenu-full">
                        <div class="full-menu-wrap">
                            <?php pixxy_custom_menu(); ?>
                        </div>
                    </nav>
                    <!-- NAVIGATION -->
                </header>
            </div>
        </div>
    </div>
</div>

