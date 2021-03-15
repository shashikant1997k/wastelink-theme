<?php
/**
 * 404 Page
 *
 * @package pixxy
 * @since 1.0
 *
 */

$btntext = cs_get_option( 'error_btn_text' ) ? cs_get_option( 'error_btn_text' ) : esc_html__('Go home', 'pixxy');
$title =  cs_get_option( 'error_title' ) ? cs_get_option( 'error_title' ) : esc_html__('Page not found', 'pixxy');
$subtitle =  cs_get_option( 'error_subtitle' ) ? cs_get_option( 'error_subtitle' ) : esc_html__("we can't find the page your are looking for", "pixxy");
$btn_style =  cs_get_option( 'btn_style' ) ? cs_get_option( 'btn_style' ) : 'a-btn-4';
$light_text = cs_get_option( 'error_light_text' ) ? 'light' : '';

get_header();
?>
	<div class="container-fluid no-padd error-height">
		<div class="hero-inner bg-cover full-height-window ">

			<?php if ( cs_get_option( 'image_404' ) ):
				echo pixxy_the_lazy_load_flter( cs_get_option( 'image_404' ), array(
				  'class' => 's-img-switch',
				  'alt'   => esc_attr__( '404 image', 'pixxy' )
				) );
            endif; ?>
			<div class="fullheight text-center <?php echo esc_attr($light_text); ?>">
				<div class="vertical-align">
					<h1 class="bigtext"><?php esc_html_e( '404', 'pixxy' ); ?></h1>
                    <?php if(!empty($title)){ ?>
                        <h3 class="title bold font-1"><?php echo esc_html($title ); ?></h3>
                    <?php } ?>
                    <?php if(!empty($subtitle)){ ?>
                        <h6 class="subtitle"><?php echo esc_html($subtitle); ?></h6>
                    <?php } ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class=" <?php echo esc_attr($btn_style); ?>"><?php echo esc_html( $btntext ); ?></a>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();
