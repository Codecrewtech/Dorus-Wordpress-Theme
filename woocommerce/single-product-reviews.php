<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return;
?>
<div class="col-md-12">
    <h4 class="text-left">
        <?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'tomato' ), $count, get_the_title() );
			else
				_e( 'Reviews', 'tomato' );
		?>
    </h4>
    <br />
    <?php if ( have_comments() ) : ?>

		<ul class="comment-list">
			<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			echo '<nav class="pagination pagination-lg pull-right woocommerce-pagination">';
			paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
				'type'      => 'list',
			) ) );
			echo '</nav>';
		endif; ?>

    <?php else : ?>

        <p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'tomato' ); ?></p>

    <?php endif; ?>
    <br />
	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
	<div class="review-form">	
		<?php
			$commenter = wp_get_current_commenter();

			$comment_form = array(
				'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'tomato' ) : esc_html__( 'Be the first to review', 'tomato' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
				'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'tomato' ),
				'comment_notes_before' => '',
				'comment_notes_after'  => '',
				'fields'               => array(
					'author' => '<div class="row"><div class="col-md-6"><input class="input-md form-control" data-msg-required="Please enter your name." id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" aria-required="true" /></div>',
					'email'  => '<div class="col-md-6"><input data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." class="input-md form-control" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>',
				),
				'label_submit'  => esc_html__( 'Submit Review', 'tomato' ),
				'logged_in_as'  => '',
				'comment_field' => ''
			);

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
				$comment_form['comment_field'] = '<span>Your Ratings</span><select name="rating" id="rating">
					<option value="">' . esc_html__( 'Rate&hellip;', 'tomato' ) . '</option>
					<option value="5">' . esc_html__( 'Perfect', 'tomato' ) . '</option>
					<option value="4">' . esc_html__( 'Good', 'tomato' ) . '</option>
					<option value="3">' . esc_html__( 'Average', 'tomato' ) . '</option>
					<option value="2">' . esc_html__( 'Not that bad', 'tomato' ) . '</option>
					<option value="1">' . esc_html__( 'Very Poor', 'tomato' ) . '</option>
				</select>';
			}

			$comment_form['comment_field'] .= '<textarea data-msg-required="Please enter your message." maxlength="5000" id="comment" name="comment"  cols="30" rows="5"  class="input-md form-control clearfix space20" aria-required="true"></textarea>';

			ob_start();
            comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
            $comment_form = ob_get_clean();
            $comment_form = str_replace( '<p', '<div', $comment_form );
            $comment_form = str_replace( '</p', '</div', $comment_form );
            echo ''.$comment_form = str_replace( 'class="submit"', 'class="btn btn-default"', $comment_form );
            
		?>

	<?php else : ?>

		<div class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'tomato' ); ?></div>

	<?php endif; ?>
    </div>
</div><div class="clearfix"></div>