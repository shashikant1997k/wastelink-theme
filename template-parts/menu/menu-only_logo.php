<?php
/**
 * Only logo menu.
 */

if ( is_page() || is_home() ) {
	$post_id = get_queried_object_id();
} else {
	$post_id = get_the_ID();
}

$fixed_menu_class = pixxy_fixed_header( 'only_logo', $post_id ); ?>

<div class="header_top_bg only_logo <?php echo esc_attr( $fixed_menu_class ) ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header class="top-menu">
                    <!-- LOGO -->
					<?php pixxy_site_logo(); ?>
                    <!-- /LOGO -->
                </header>
            </div>
        </div>
    </div>
</div>