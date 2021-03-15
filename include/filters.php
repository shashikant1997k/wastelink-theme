<?php
/**
 * Filters for lazy load (etc)
 *
 * @package eventine
 * @since 1.0.0
 *
 */

 
if (!function_exists('is_cart')) {
	function is_cart($value='')
	{
		return false;
	}
}

add_filter( 'wp_get_attachment_image_attributes', 'pixxy_lazy_load' );
if ( ! function_exists( 'pixxy_lazy_load' ) ) {
	function pixxy_lazy_load( $data ) {
		if ( is_page() || is_home() ) {
			$post_id = get_queried_object_id();
		} else {
			$post_id = get_the_ID();
		}

		// pixxy options
		$page_options = get_post_meta( $post_id, '_custom_page_options', true );
		$disable_lazy_load = isset($page_options['disable_lazy_load']) && !empty($page_options['disable_lazy_load']) ? $page_options['disable_lazy_load'] : 'no';
			if (
				cs_get_option( 'enable_lazy_load' ) && $disable_lazy_load == 'no' &&
				!is_admin() && (!is_cart() || !is_woocommerce() )
			) {
				$uri_img = PIXXY_T_URI . '/assets/images/lazy.png';
				$data['data-lazy-src'] = esc_url( $data['src'] );
				unset( $data['srcset'] );
				unset( $data['sizes'] );
				$data['src'] = $uri_img;

		}


		return apply_filters( 'pixxy_lazy_load', $data );
	}
}

if ( ! function_exists( 'pixxy_the_lazy_load_flter' ) ) {
	function pixxy_the_lazy_load_flter( $id, $attr = array(), $state = true, $size = 'full', $uri_img = '') {

		if ( is_page() || is_home() ) {
			$post_id = get_queried_object_id();
		} else {
			$post_id = get_the_ID();
		}

		// pixxy options
		$page_options = get_post_meta( $post_id, '_custom_page_options', true );
		$disable_lazy_load = isset($page_options['disable_lazy_load']) && !empty($page_options['disable_lazy_load']) ? $page_options['disable_lazy_load'] : 'no';

		if (!isset($id)) {
			return "";
		}

		if ( empty($uri_img) ) {
			$uri_img = PIXXY_T_URI . '/assets/images/lazy.png';
		}

		if (is_numeric($id)) {
			$id = wp_get_attachment_image_src($id, $size );
		} else {
			$id = array($id,'','');
		}

		if (!cs_get_option( 'enable_lazy_load') || !$disable_lazy_load == 'no'){
			$state = false;
		}
			$default_attr = array(
			'data-lazy-src' => esc_url($id[0]),
			'src'     => $uri_img,
			'class'   => 's-img-switch',
		);

		$attr = wp_parse_args( $attr, $default_attr );

		if ( !$state ) {
			unset($attr['data-lazy-src']);
			$attr['src'] = esc_url($id[0]);
		}

		$attr = apply_filters('prefix_image_lazy_load',$attr );

		$attr = array_map( 'esc_attr', $attr );
		$html = '<img';

		foreach ( $attr as $name => $value ) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';

		return $html;
	}
}
