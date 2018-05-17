<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.5
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}
?>
<div id="reviews"><?php

	echo '<div id="comments">';
	
	if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ){

			$average = $product->get_average_rating();

			echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

			echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'wpnoone' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'wpnoone' ).'</span></div>';

			echo '<h2>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'wpnoone'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h2>';

			echo '</div>';

	} else {

		echo '<h2>'.__( 'Reviews', 'wpnoone' ).'</h2>';

	}

	$title_reply = '';

	if ( have_comments() ) :

		echo '<ol class="commentlist">';

			wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) );

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<?php
				echo '<nav class="woocommerce-pagination">';
					paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
						'prev_text' 	=> '&larr;',
						'next_text' 	=> '&rarr;',
						'type'			=> 'list',
					) ) );
				echo '</nav>';
			?>	
			<!--<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'wpnoone' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'wpnoone' ) ); ?></div>
			</div>-->
		<?php endif;


	endif;

	

	echo '</div>';
	
	if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : 
		
		$commenter = wp_get_current_commenter();
		?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$comment_form = array(
						'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'wpnoone' ) : esc_html__( 'Be the first to review', 'wpnoone' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'wpnoone' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'wpnoone' ) . ' <span class="required">*</span></label> ' .
							            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
							'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'wpnoone' ) . ' <span class="required">*</span></label> ' .
							            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
						),
						'label_submit'  => __( 'Submit Review', 'wpnoone' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);
					
					if ( get_option('woocommerce_enable_review_rating') === 'yes' ) {
						$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Rating', 'wpnoone' ) .'</label><select name="rating" id="rating">
							<option value="">'.esc_html__( 'Rate&hellip;', 'wpnoone' ).'</option>
							<option value="5">'.esc_html__( 'Perfect', 'wpnoone' ).'</option>
							<option value="4">'.esc_html__( 'Good', 'wpnoone' ).'</option>
							<option value="3">'.esc_html__( 'Average', 'wpnoone' ).'</option>
							<option value="2">'.esc_html__( 'Not that bad', 'wpnoone' ).'</option>
							<option value="1">'.esc_html__( 'Very Poor', 'wpnoone' ).'</option>
						</select></p>';

					}
					
					$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your Review', 'wpnoone' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' . wp_nonce_field( 'woocommerce-comment_rating', '_wpnonce', true, false ) . '</p>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>	
			</div>
		</div>
	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'wpnoone' ); ?></p>
	
	<?php endif; 
?>
</div>
<div class="clear"></div>