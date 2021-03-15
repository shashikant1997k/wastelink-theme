<?php
/**
 *
 * The Header for Pixxy theme
 * @since 1.0.0
 * @version 1.0.0
 *
 */

if ( is_page() || is_home() ) {
	$post_id = get_queried_object_id();
} else {
	$post_id = get_the_ID();
}

global $bodyClass;

// modern preloader options
$preloader_first_text = cs_get_option('first_preloader_text') ? cs_get_option('first_preloader_text') : 'Loading';
$preloader_second_text = cs_get_option('second_preloader_text') ? cs_get_option('second_preloader_text') : 'please wait';

$meta_data           = get_post_meta( $post_id, '_custom_page_options', true );
$meta_data_portfolio = get_post_meta( $post_id, 'pixxy_portfolio_options', true );
$meta_data_events    = get_post_meta( $post_id, 'pixxy_events_options', true );
// page options
$enable_footer_parallax = isset( $meta_data['enable_parallax_footer_page'] ) ? $meta_data['enable_parallax_footer_page'] : cs_get_option( 'enable_parallax_footer' );
if ( isset( $meta_data_portfolio['enable_parallax_footer_page'] ) ) {
    $enable_footer_parallax = $meta_data_portfolio['enable_parallax_footer_page'];
} elseif ( isset( $meta_data_events['enable_parallax_footer_page'] ) ) {
    $enable_footer_parallax = $meta_data_events['enable_parallax_footer_page'];
}
$enable_footer_parallax = apply_filters( 'pixxy_blog_footer_style', $enable_footer_parallax );
$class_main_wrapper = $enable_footer_parallax ? ' footer-parallax' : '';

$preloader_text   = cs_get_option( 'preloader_text' ) ? cs_get_option( 'preloader_text' ) : 'i';


$unitClass              = ! function_exists( 'cs_framework_init' ) ? ' unit ' : '';

$class_desc_padd = ! empty( $meta_data['padding_desktop'] ) ? ' padding-desc ' : '';
$class_mob_padd  = ! empty( $meta_data['padding_mobile'] ) ? ' padding-mob ' : '';

$mobile      = cs_get_option( 'mobile_menu' );
$bodyClass   = isset( $mobile ) && $mobile ? ' mob-main-menu' : '';
$mobileWidth = isset( $mobile ) && $mobile ? '1024' : '992'; ?>

<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- MAIN_WRAPPER -->
<?php
$class_animsition = 'animsition' . $unitClass;
if ( cs_get_option( 'pixxy_disable_preloader' ) || cs_get_option( 'preloader_type' ) == 'spinner'|| cs_get_option( 'preloader_type' ) == 'modern_text' ) {
	$class_animsition = '';
}

$class_main_wrapper .= $class_animsition . ' ' . $class_desc_padd . $class_mob_padd;

//spinner preloader
if ( ! cs_get_option( 'pixxy_disable_preloader' ) && cs_get_option( 'preloader_type' ) == 'spinner' ) { ?>
    <div class="spinner-preloader-wrap">
        <div class="cssload-container">
            <div class="cssload-item cssload-moon"></div>
        </div>
    </div>
<?php }

// linear preloader
 if ( !cs_get_option ('pixxy_disable_preloader') && cs_get_option('preloader_type') == 'modern_text') { ?>
    <div class="preloader-modern">
        <div class="preloader-wrap">
            <div class="loader-title"><?php echo esc_html($preloader_first_text); ?></div>
            <div class="loader-subtitle"><?php echo esc_html($preloader_second_text); ?></div>
        </div>
    </div>
<?php }?>

<div class="main-wrapper <?php echo esc_attr( $class_main_wrapper ); ?>"
     data-sound="<?php echo esc_url( get_template_directory_uri() . '/assets/audio/' ); ?>"
     data-top="<?php echo esc_attr( $mobileWidth ); ?>">

	<?php do_action('pixxy_main_header'); ?>

