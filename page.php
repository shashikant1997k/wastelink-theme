<?php
/**
 * Custom Page Template
 *
 * @package pixxy
 * @since 1.0
 *
 */

get_header();
$page_meta = get_post_meta( $post->ID, '_custom_page_options' );

if ( cs_get_option( 'page_navigation' ) == true ) {

	$pages = pixxy_get_pages_for_navi();

	$current = array_search( $post->ID, $pages );

	$prevID = ( ! empty( $pages[ $current - 1 ] ) ) ? $pages[ $current - 1 ] : $pages[ count( $pages ) - 1 ];

	$nextID = ( ! empty( $pages[ $current + 1 ] ) ) ? $pages[ $current + 1 ] : '';


	if ( ! empty( $prevID ) ) {
		$prev_post_title = get_the_title( $prevID );
		$prev_title      = implode( ' ', preg_split( '//u', $prev_post_title, - 1, PREG_SPLIT_NO_EMPTY ) );
		$prev_title      = str_replace( "   ", " &nbsp; ", $prev_title ); ?>
		<a class="side-link left animsition-link" href="<?php echo esc_url( get_page_link( $prevID ) ); ?>"
		   data-animsition-out="fade-out-right-sm">
			<div class="side-arrow"></div>
			<div class="side-title"><?php echo esc_html( $prev_title ); ?></div>
		</a>
	<?php }

	if ( ! empty( $nextID ) ) {
		$next_post_title = get_the_title( $nextID );
		$next_title      = implode( ' ', preg_split( '//u', $next_post_title, - 1, PREG_SPLIT_NO_EMPTY ) );
		$next_title      = str_replace( "   ", " &nbsp; ", $next_title );
		?>
		<a class="side-link right animsition-link" href="<?php echo esc_url( get_page_link( $nextID ) ); ?>"
		   data-animsition-out="fade-out-left-sm">
			<div class="side-arrow"></div>
			<div class="side-title"><?php echo esc_html( $next_title ); ?></div>
		</a>
		<?php
	}
}

$protected = '';

if ( post_password_required() ) {
	$protected = 'protected-page';
}


while ( have_posts() ) : the_post();

	$content = get_the_content();
	if ( ! strpos( $content, 'vc_' ) ) { ?>
		<div class="single-post">

                 <?php
                 if(function_exists('is_woocommerce') && !is_cart() && !is_checkout()){ ?>
                        <div class="post-little-banner">
                            <h3 class="page-title-blog"><?php the_title(); ?></h3>
                        </div>
                        <div class="post-paper padding-both no-vc">
                <?php }elseif(!function_exists('is_woocommerce')){ ?>
                       <div class="post-little-banner">
                            <h3 class="page-title-blog"><?php the_title(); ?></h3>
                        </div>
                        <div class="post-paper padding-both no-vc">
                 <?php }

                $equal = function_exists('is_woocommerce') && !is_woocommerce() && !is_cart() && !is_checkout() ? 'equal-height' : ''; ?>
				<div class="container <?php echo esc_attr( $equal ); ?> no-padd <?php echo esc_attr( $protected ); ?>">
					<div class="row">
						<div class="col-xs-12">
							<?php if ( function_exists('is_checkout') && get_the_title() && (!function_exists('is_cart') || !is_cart() && !is_checkout() ) ) { ?>
								<?php if ( post_password_required() ) {
								    the_title( '<h3 class="title protected-title">', '</h3>' );
								}
							}
							the_content();
							wp_link_pages( 'link_before=<span class="pages">&link_after=</span>&before=<div class="post-nav"> <span>' . esc_html__( "Page:", 'pixxy' ) . ' </span> &after=</div>' ); ?>


						</div>
					</div>
				</div>
			<?php
			if ( comments_open() ) { ?>
				<div class="comments container no-padd-md">
					<?php comments_template( '', true ); ?>
				</div>
			<?php } ?>

            <?php if(!function_exists( 'cs_framework_init' )){ ?>
                </div>
            <?php } ?>
		</div>
	<?php } else { ?>
		<?php

        if( is_page() || is_home()) {
            $post_id = get_queried_object_id();
        } else {
            $post_id = get_the_ID();
        }

        $meta_data = get_post_meta( $post_id, '_custom_page_options', true );
        $menu_main_style = cs_get_option( 'menu_style' );

        if(isset($meta_data['change_menu']) && $meta_data['change_menu'] && isset($meta_data['menu_style'])){
            $menu_main_style = $meta_data['menu_style'];
        }
        $class_container = $menu_main_style == 'static_aside' ? '-fluid' : '';

        $class_container .= !empty($page_meta[0]['disable_container_padding']) ? ' no-padd' : '';  ?>

		<div class="container<?php echo esc_attr( $class_container ); ?>">
			<div class="hero">
				<?php the_content(); ?>
			</div>
		</div>

	<?php }
endwhile;
get_footer();
