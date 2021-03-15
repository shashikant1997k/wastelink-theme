<?php
/**
 * Single
 *
 * @package pixxy
 * @since 1.0
 *
 */
get_header();

$protected = '';

if ( post_password_required() ) {
	$protected = 'protected-page';
}

$cs_sidebar = cs_get_option( 'sidebar' );
$cs_sidebar_pos = cs_get_option( 'sidebar_position' );

$post_meta = get_post_meta( $post->ID, 'pixxy_post_options' );

$preview = isset( $post_meta[0]['post_preview_style'] ) ? $post_meta[0]['post_preview_style'] : '';

$unitClass = ! function_exists( 'cs_framework_init' ) ? 'unit' : '';

if ( get_post_type( $post->ID ) == 'whizzy_proof_gallery' ) {
	$cs_sidebar = false;
}

$content_size_class  = ( (!function_exists( 'cs_framework_init' ) && is_active_sidebar('sidebar')) || ( $cs_sidebar && in_array( 'post', $cs_sidebar ) ) ) ? 'col-md-9' : 'col-md-12';
$content_size_class .= ( $content_size_class == 'col-md-9' && $cs_sidebar_pos == 'left_sidebar' ) ? ' pull-right' : '';

$blog_type          = cs_get_option( 'blog_single_type' ) ? cs_get_option( 'blog_single_type' ) : 'classic';
$sidebar_class      = (!function_exists( 'cs_framework_init' ) && is_active_sidebar('sidebar')) || $cs_sidebar && in_array( 'blog', $cs_sidebar ) ? ' sidebar-show' : 'sidebar-no';

while ( have_posts() ) :
	the_post(); ?>

    <div class="container">
        <div class="row">

          <div class="post-details <?php echo esc_attr( $unitClass . ' ' . $preview  . ' ' . $content_size_class ); ?>">
                <div class="single-content <?php echo esc_attr( $protected ); ?>">
                <div class="single-content-wrapper">

                    <div class="main-top-content">
                            <?php if ( ! function_exists( 'cs_framework_init' ) || cs_get_option( 'pixxy_post_cat' ) ) { ?>
                                <div class="single-categories"><?php the_category( ' ' ); ?></div>
                            <?php }
                            the_title( '<h2 class="title">', '</h2>' ); ?>
                        <div class="title-wrap">
                            <?php if (  ! function_exists( 'cs_framework_init' ) || cs_get_option( 'pixxy_post_author' ) ) { ?>
                                <div class="author"><?php esc_html_e( 'by ', 'pixxy' ); ?>
                                <span><?php the_author_link(); ?></span> </div>
                            <?php } ?>
                            <div class="date-post"><?php the_time( get_option( 'date_format' ) ); ?></div>
                        </div>
                    </div>
				<?php
                if ( $blog_type == 'classic' || !function_exists( 'cs_framework_init' ) ) {
                    if ( ( has_post_thumbnail() || isset( $post_meta[0]['post_preview_style'] ) ) ) { ?>

                <?php if ( isset( $post_meta[0]['post_preview_style'] ) && $post_meta[0]['post_preview_style'] != 'text' && $post_meta[0]['post_preview_style'] != 'image' && ( get_post_format( $post->ID ) != 'quote' ) || ! isset( $post_meta[0]['post_preview_style'] ) && function_exists( 'cs_framework_init' ) ) {
                $video_params = array(
                'enablejsapi'    => 1,
                'loop'           => 1,
                'autoplay'       => 1,
                'controls'       => 0,
                'showinfo'       => 0,
                'modestbranding' => 0,
                'rel'            => 0,
                );
                pixxy_blog_item_hedeader( $post_meta, $post->ID, $video_params, 'start', '' );
                } elseif ( has_post_thumbnail() ) { ?>
                <div class="post-banner">
                    <?php  echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
                </div>
                <?php }
                }
                }
                if ( $blog_type == 'modern' ) { ?>
                    <?php if ( ! has_post_thumbnail() || ! function_exists( 'cs_framework_init' ) ) { ?>

                        <div class="post-little-banner">
                            <div class="main-top-content text-center">
                                <?php the_title( '<h2 class="title">', '</h2>' ); ?>
                                    <div class="date-post"><?php the_time( get_option( 'date_format' ) ); ?></div>
                                    <?php if ( cs_get_option( 'pixxy_post_author' ) ) { ?>
                                    <div class="author">
                                        <?php esc_html_e( 'Written by: ', 'pixxy' );
                                        the_author_link(); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="post-paper <?php echo esc_attr( $sidebar_class . ' ' . $blog_type ); ?>">
                <?php }

                the_content();

				wp_link_pages( 'link_before=<span class="pages">&link_after=</span>&before=<div class="post-nav"> <span>' . esc_html__( "Page:", 'pixxy' ) . ' </span> &after=</div>' ); ?>

                    <?php if(get_post_type($post->ID ) !== 'whizzy_proof_gallery'){ ?>

                    <div class="post-info">
						<?php if ( ! function_exists( 'cs_framework_init' ) || cs_get_option( 'pixxy_post_tags' ) ) { ?>
                            <div class="single-tags"><?php the_tags( '', ' ' ); ?></div>
						<?php } ?>
                         <?php if ( function_exists( 'cs_framework_init' ) && function_exists( 'pixxy_like_counter' ) ) { ?>
                            <div class="likes-wrap">
                                <?php pixxy_like_button();
                                pixxy_like_counter(); ?>
                                <span>
                                    <?php esc_html_e('Like', 'pixxy'); ?>
                                </span>
                            </div>
                        <?php } ?>
                    </div>

                    <?php }

                if(get_post_type($post->ID ) !== 'whizzy_proof_gallery'){
                      $post_author_info = cs_get_option('post_author_info');
                   if ( $post_author_info ) : ?>
                     <div class="user-info-wrap">
                    <?php $author_first_name = get_the_author_meta( 'first_name' );
                    $author_last_name  = get_the_author_meta( 'last_name' );
                    $author_nicename  = get_the_author_meta( 'nicename' );
                    $author_bio        = get_the_author_meta( 'description' );
                    $facebook          = get_the_author_meta( 'facebook' );
                    $twitter           = get_the_author_meta( 'twitter' );
                    $instagram         = get_the_author_meta( 'instagram' );
                    $dribbble         = get_the_author_meta( 'dribbble' ); ?>

                    <section class="post-author">
                        <div class="post-author__avatar">
                            <?php echo get_avatar( get_the_ID(), '155' ); ?>
                        </div>

                        <div class="post-author__content">
                            <div class="post-name-wrap">
                                <?php if ( ! empty( $author_nicename ) ) : ?>
                                    <span class="post-author__nicename"><?php echo esc_html( $author_nicename ); ?></span>
                                <?php endif; ?>
                                <?php if ( ! empty( $author_first_name ) || ! empty( $author_last_name ) ) : ?>
                                    <span class="post-author__title"><?php echo esc_html( $author_first_name . ' ' . $author_last_name ); ?></span>
                                <?php endif; ?>
                            </div>

                            <?php if ( ! empty( $author_bio ) ) : ?>
                                <p><?php echo wp_kses_post( $author_bio ); ?></p>
                            <?php endif; ?>

                            <div class="post-author__social">
                                <?php if ( ! empty( $facebook ) ) : ?>
                                    <a href="<?php echo esc_url( $facebook ); ?>" class="post-author__social-item"><i class="fa fa-facebook"></i></a>
                                <?php endif; ?>

                                <?php if ( ! empty( $twitter ) ) : ?>
                                    <a href="<?php echo esc_url( $twitter ); ?>" class="post-author__social-item"><i class="fa fa-twitter"></i></a>
                                <?php endif; ?>

                                <?php if ( ! empty( $instagram ) ) : ?>
                                    <a href="<?php echo esc_url( $instagram ); ?>" class="post-author__social-item"><i class="fa fa-instagram"></i></a>
                                <?php endif; ?>
                                <?php if ( ! empty( $dribbble ) ) : ?>
                                    <a href="<?php echo esc_url( $dribbble ); ?>" class="post-author__social-item"><i class="fa fa-dribbble"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                          </div>
                    <?php endif;

	            $my_cat = get_query_var( 'cat' );

				$args = array(
					'posts_per_page'      => 2,
					'cat'                 => $my_cat,
					'orderby'             => 'date',
					'order'               => 'DESC',
					'ignore_sticky_posts' => true,
					'post__not_in'        => array( $post->ID )
				);


				$query = new WP_Query( $args );


				if ( $query->have_posts() ) {
                    if ( function_exists( 'cs_framework_init' )){ ?>
                    <div class="recent-post-single clearfix">
                        <div class="row">
                        <div class="recent-title"><?php esc_html_e('Recent posts', 'pixxy'); ?></div>
                        </div>
                        <div class="row">
							<?php while ( $query->have_posts() ) {
								$query->the_post();
								$imagerec = wp_get_attachment_image_url( get_post_thumbnail_id( $query->ID ), 'post-thumbnail' );

								$no_image_recent = ! has_post_thumbnail() ? ' no-image' : ''; ?>

                               <div class="col-sm-6 recent-simple-post <?php echo esc_html( $no_image_recent ); ?>">
                                    <div class="sm-wrap-post">
                                        <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"
                                           class="img s-back-switch">
                                            <div class="back"></div>
											<?php
											echo pixxy_the_lazy_load_flter(
												$imagerec,
												array(
                                                    'class' => 's-img-switch',
                                                    'alt' => ''
												)
											);
											?>
                                        </a>
                                        <div class="content">

                                            <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"
                                               class="title"><?php echo esc_html( $post->post_title ); ?></a>
                                              <div class="excerpt"><?php echo esc_html( $post->post_excerpt ); ?></div>

                                        </div>
                                    </div>
                                </div>
								<?php
							} ?>
                        </div>
                    </div>
				<?php }
				 }
				wp_reset_postdata(); ?>


            <ul class="comments main">
		        <?php if ( comments_open() || '0' != get_comments_number() && wp_count_comments( $post->ID ) ) {
			        comments_template( '', true );
		        } ?>
            </ul>
                <?php } ?>

   </div>
            <?php
				wp_reset_postdata();
				if ( ! function_exists( 'cs_framework_init' ) || (isset( $post_meta[0]['pixxy_navigation_posts'] )&& $post_meta[0]['pixxy_navigation_posts'] ) ) { ?>
                    <div class="single-pagination">
						<?php

						$prev_post = get_previous_post();
						if ( ! empty( $prev_post ) ) : ?>
                            <div class="pag-prev">
                              <span>
	                            <?php esc_html_e( 'Previous post', 'pixxy' ); ?>
                                <a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="content">
	                                <?php echo get_the_title( $prev_post ); ?>
                                </a>
                                </span>
                            </div>
						<?php endif;

						$next_post = get_next_post();
						if ( ! empty( $next_post ) ) :
							?>
                            <div class="pag-next">
                              <span>
	                            <?php esc_html_e( 'Next post', 'pixxy' ); ?>
                                <a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="content">
	                                <?php echo get_the_title( $next_post ); ?>
                                </a>
                                </span>
                            </div>
						<?php endif; ?>
                    </div>
					<?php
				} ?>

            </div>
        </div>
           <?php if ( (!function_exists( 'cs_framework_init' ) && is_active_sidebar('sidebar')) || ( $cs_sidebar && in_array( 'post', $cs_sidebar ) ) ) { ?>
                <div class="col-md-3 pl30md">
                    <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar' ) ) ?>
                </div>
            <?php } ?>
           </div>
	<?php

	if ( $blog_type == 'modern' ) { ?>
        </div>
	<?php }


endwhile;

get_footer();











