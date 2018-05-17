<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.12
 */
?>
<form id="yith-wcwl-form" action="<?php echo esc_url( YITH_WCWL()->get_wishlist_url( 'view' . ( $wishlist_meta['is_default'] != 1 ? '/' . $wishlist_meta['wishlist_token'] : '' ) ) ) ?>" method="post" class="woocommerce">

    <?php wp_nonce_field( 'yith-wcwl-form', 'yith_wcwl_form_nonce' ) ?>

    <!-- TITLE -->
    <?php
    do_action( 'yith_wcwl_before_wishlist_title' );

    if( ! empty( $page_title ) ) :
    ?>
        <div class="wishlist-title <?php echo ( $wishlist_meta['is_default'] != 1 && $is_user_owner ) ? 'wishlist-title-with-form' : ''?>">
            <?php echo apply_filters( 'yith_wcwl_wishlist_title', '<h2>' . $page_title . '</h2>' ); ?>
            <?php if( $wishlist_meta['is_default'] != 1 && $is_user_owner ): ?>
                <a class="btn button show-title-form">
                    <?php echo apply_filters( 'yith_wcwl_edit_title_icon', '<i class="fa fa-pencil"></i>' )?>
                    <?php esc_html_e( 'Edit title', 'yith-woocommerce-wishlist' ) ?>
                </a>
            <?php endif; ?>
        </div>
        <?php if( $wishlist_meta['is_default'] != 1 && $is_user_owner ): ?>
            <div class="hidden-title-form">
                <input type="text" value="<?php echo $page_title ?>" name="wishlist_name"/>
                <button>
                    <?php echo apply_filters( 'yith_wcwl_save_wishlist_title_icon', '<i class="fa fa-check"></i>' )?>
                    <?php esc_html_e( 'Save', 'yith-woocommerce-wishlist' )?>
                </button>
                <a class="hide-title-form btn button">
                    <?php echo apply_filters( 'yith_wcwl_cancel_wishlist_title_icon', '<i class="fa fa-remove"></i>' )?>
                    <?php esc_html_e( 'Cancel', 'yith-woocommerce-wishlist' )?>
                </a>
            </div>
        <?php endif; ?>
    <?php
    endif;

     do_action( 'yith_wcwl_before_wishlist' ); ?>

    <!-- WISHLIST TABLE -->
    <table class="shop_table cart wishlist_table" data-pagination="<?php echo esc_attr( $pagination )?>" data-per-page="<?php echo esc_attr( $per_page )?>" data-page="<?php echo esc_attr( $current_page )?>" data-id="<?php echo ( is_user_logged_in() ) ? esc_attr( $wishlist_meta['ID'] ) : '' ?>" data-token="<?php echo ( ! empty( $wishlist_meta['wishlist_token'] ) && is_user_logged_in() ) ? esc_attr( $wishlist_meta['wishlist_token'] ) : '' ?>">

        <thead>
        <tr>	       
            <th class="product-name">
                <span class="nobr"><?php echo apply_filters( 'yith_wcwl_wishlist_view_name_heading', esc_html__( 'Product Name', 'yith-woocommerce-wishlist' ) ) ?></span>
            </th>

            <?php if( $show_price ) : ?>

                <th class="product-price">
                    <span class="nobr">
                        <?php echo apply_filters( 'yith_wcwl_wishlist_view_price_heading', esc_html__( 'Unit Price', 'yith-woocommerce-wishlist' ) ) ?>
                    </span>
                </th>

            <?php
            endif;
            ?>

            <?php if( $show_stock_status ) : ?>

                <th class="product-stock-stauts">
                    <span class="nobr">
                        <?php echo apply_filters( 'yith_wcwl_wishlist_view_stock_heading', esc_html__( 'Stock Status', 'yith-woocommerce-wishlist' ) ) ?>
                    </span>
                </th>

            <?php
            endif;
            ?>
			<?php if( $show_add_to_cart ) : ?>
                <th class="product-add-to-cart"></th>
            <?php endif ?>
			<th class="product-remove"></th>
        </tr>
        </thead>

        <tbody>
        <?php
        if( count( $wishlist_items ) > 0 ) :
            foreach( $wishlist_items as $item ) :
                global $product;
	            if( function_exists( 'wc_get_product' ) ) {
		            $product = wc_get_product( $item['prod_id'] );
	            }
	            else{
		            $product = get_product( $item['prod_id'] );
	            }

                if( $product !== false && $product->exists() ) :
	                $availability = $product->get_availability();
	                $stock_status = $availability['class'];
	                ?>
                    <tr id="yith-wcwl-row-<?php echo $item['prod_id'] ?>" data-row-id="<?php echo $item['prod_id'] ?>">
	                    <td class="product-thumbnail product-name">
							<div class="wd_product_item">
								<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>">
									<?php echo wp_kses_post($product->get_image()); ?>
								</a>
							</div>                                      
							<div class="wd_product_meta">
								<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></a>
								<?php do_action( 'yith_wccl_table_after_product_name', $item ); ?>
							</div>
						</td>
                        <?php if( $show_price ) : ?>
                            <td class="product-price">
                                <?php
                                if( is_a( $product, 'WC_Product_Bundle' ) ){
	                                if( $product->min_price != $product->max_price ){
		                                echo sprintf( '%s - %s', wc_price( $product->min_price ), wc_price( $product->max_price ) );
	                                }
	                                else{
		                                echo wc_price( $product->min_price );
	                                }
                                }
                                elseif( $product->get_price() != '0' ) {
	                                echo $product->get_price_html();
                                }
                                else {
                                    echo apply_filters( 'yith_free_text', esc_html__( 'Free!', 'yith-woocommerce-wishlist' ) );
                                }
                                ?>
                            </td>
                        <?php endif ?>

                        <?php if( $show_stock_status ) : ?>
                            <td class="product-stock-status">
                                <?php
                                if( $stock_status == 'out-of-stock' ) {
                                    $stock_status = "Out";
                                    echo '<span class="wishlist-out-of-stock">' . esc_html__( 'Out of Stock', 'yith-woocommerce-wishlist' ) . '</span>';
                                } else {
                                    $stock_status = "In";
                                    echo '<span class="wishlist-in-stock">' . esc_html__( 'In Stock', 'yith-woocommerce-wishlist' ) . '</span>';
                                }
                                ?>
                            </td>
                        <?php endif ?>

	                    <?php if( $show_add_to_cart ) : ?>
                            <td class="product-add-to-cart">
                                <?php if( isset( $stock_status ) && $stock_status != 'Out' ): ?>
                                    <?php
                                    if( function_exists( 'wc_get_template' ) ) {
                                        wc_get_template( 'loop/add-to-cart.php' );
                                    }
                                    else{
                                        woocommerce_get_template( 'loop/add-to-cart.php' );
                                    }
                                    ?>
                                <?php endif ?>
                            </td>
                        <?php endif ?>
					<?php if( $is_user_owner ): ?>
                        <td class="product-remove">
                            <div>
                                <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" class="remove remove_from_wishlist" title="<?php esc_html_e( 'Remove this product', 'yith-woocommerce-wishlist' ) ?>">&times;</a>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php
                endif;
            endforeach;
        else: ?>
           <tr class="pagination-row">
                <td colspan="6" class="wishlist-empty"><?php esc_html_e( 'No products were added to the wishlist', 'wpnoone' ) ?></td>
            </tr>
        <?php
        endif;

        if( ! empty( $page_links ) ) : ?>
            <tr>
                <td colspan="6"><?php echo esc_html($page_links); ?></td>
            </tr>
        <?php endif ?>
        </tbody>

        <?php if( $is_user_logged_in ): ?>
            <tfoot>
            <tr>
                <?php if ( $is_user_owner && $wishlist_meta['wishlist_privacy'] != 2 && $share_enabled ) : ?>
                    <td colspan="<?php echo ( $is_user_logged_in && $is_user_owner && $show_ask_estimate_button && $count > 0 ) ? 4 : 6 ?>">
                        <?php yith_wcwl_get_template( 'share.php', $share_atts ); ?>
                    </td>
                <?php endif; ?>

                <?php
                if ( $is_user_owner && $show_ask_estimate_button && $count > 0 ): ?>
                    <td colspan="<?php echo ( $is_user_owner && $wishlist_meta['wishlist_privacy'] != 2 && $share_enabled ) ? 2 : 6 ?>">
                        <a href="<?php echo esc_html($ask_estimate_url); ?>" class="btn button ask-an-estimate-button">
                            <?php echo apply_filters( 'yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>' )?>
                            <?php esc_html_e( 'Ask an estimate of costs', 'wpnoone' ) ?>
                        </a>
                    </td>
                <?php
                endif;

                do_action( 'yith_wcwl_after_wishlist_share' );
                ?>
            </tr>
            </tfoot>
        <?php endif; ?>

    </table>

    <?php wp_nonce_field( 'yith_wcwl_edit_wishlist_action', 'yith_wcwl_edit_wishlist' ); ?>

    <?php if( $wishlist_meta['is_default'] != 1 ): ?>
        <input type="hidden" value="<?php echo $wishlist_meta['wishlist_token'] ?>" name="wishlist_id" id="wishlist_id">
    <?php endif; ?>

    <?php do_action( 'yith_wcwl_after_wishlist' ); ?>

</form>

