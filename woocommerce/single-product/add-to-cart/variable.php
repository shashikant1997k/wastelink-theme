<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.5
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'pixxy' ); ?></p>
	<?php else : ?>

    <table class="variations" cellspacing="0">
      <tbody>
	  <?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
        <tr>
          <td class="label">
            <label for="<?php echo esc_attr(sanitize_title($name)); ?>"><?php echo do_shortcode(wc_attribute_label($name,$product)); ?></label>
          </td>
        </tr>
        <tr>
        <td class="value">
        <fieldset>
			<?php
			if ( is_array( $options ) ) {
				$select_options = array();
				if ( empty( $_POST ) )
					$selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
				else
					$selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';

				// Get terms if this is a taxonomy - ordered
				if ( taxonomy_exists( sanitize_title( $name ) ) ) {

					$terms = get_terms( sanitize_title($name), array('menu_order' => 'ASC') );
					$counter = 0;

					foreach ( $terms as $term ) {

						if ( ! in_array( $term->slug, $options ) ) continue;
						$select_options[] =  '<option value="' . esc_attr($term->slug) . '" ' . selected( $selected_value, $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
						$counter++;
					}
				} else {

					$counter = 0;
					foreach ( $available_variations as $option ) {
						$select_options[] = '<option value="' . esc_attr($option['attributes']['attribute_size']) . '" ' . selected( $selected_value, $option['attributes']['attribute_size'], false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $option['attributes']['attribute_size'] ) . '</option>';
						$counter++;
					}
				}
			}
			?>
        </fieldset>
        <select id="product-select-<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo esc_attr(sanitize_title($name)); ?>">
			<?php foreach($select_options as $option) print $option; ?>
        </select>
		  <?php
		  if ( sizeof($attributes) == $loop )
			  ?></td>
            </tr>
		  <?php endforeach;?>
      </tbody>
    </table>

	  <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <div class="product_meta">

		<?php do_action( 'woocommerce_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

          <span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'pixxy' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'pixxy' ); ?></span></span>

		<?php endif; ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>

    </div>
    <div class="single_variation_wrap">

    <div class="woocommerce-variation-add-to-cart variations_button">
		<?php if ( ! $product->is_sold_individually() ) : ?>
			<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
		<?php endif; ?>
    </div>
		<?php /**
        * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
        * @since 2.4.0
        * @hooked woocommerce_single_variation - 10 Empty div for variation data.
        * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
        */
		 do_action( 'woocommerce_single_variation' ); ?>



		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>


		<?php
		/**
		 * woocommerce_before_single_variation Hook.
		 */
		do_action( 'woocommerce_before_single_variation' );

		/**
		 * woocommerce_after_single_variation Hook.
		 */
		do_action( 'woocommerce_after_single_variation' );
		?>

    </div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>
<?php if(cs_get_option('enable_socials_share')){ ?>
    <div class="pixxy-shop-info-title pixxy-share-shop">
        <?php esc_html_e('Share:', 'pixxy'); ?>
    </div>
    <div class="single-share">
        <div class="ft-part">
            <ul class="social-list">
                <li>
                    <a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url(the_permalink()); ?>&amp;title=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>"
                       target="_blank" class="linkedin"><i class="fa fa-linkedin-square"></i></a></li>
                <li>
                    <a href="http://twitter.com/home?status=<?php echo esc_attr(urlencode(the_title('', ' ', false))); ?><?php esc_url(the_permalink()); ?>"
                       class="twitter" target="_blank" title="Tweet"><i class="fa fa-twitter"></i></a>
                </li>

                <li>
                    <a href="http://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink()); ?>&amp;t=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>"
                       class="facebook" target="_blank"><i class="fa fa-facebook-square"></i></a></li>

                <li>
                    <a href="http://plus.google.com/share?url=<?php esc_url(the_permalink()); ?>&amp;title=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>"
                       target="_blank" class="gplus"><i class="fa fa-google-plus"></i></a></li>
                <li>
                    <a href="http://pinterest.com/pin/create/link/?url=<?php echo esc_url(urlencode(get_permalink())); ?>&amp;media=<?php echo esc_attr($pinterestimage[0]); ?>&amp;description=<?php esc_attr(the_title()); ?>"
                       class="pinterest" target="_blank" title="Pin This Post"><i
                                class="fa fa-pinterest-square"></i></a></li>
            </ul>
        </div>
    </div>
<?php } ?>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
