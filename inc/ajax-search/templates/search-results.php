<?php
/**
 * Search results are contained within a div.searchwp-live-search-results
 * which you can style accordingly as you would any other element on your site
 *
 * Some base styles are output in wp_footer that do nothing but position the
 * results container and apply a default transition, you can disable that by
 * adding the following to your theme's functions.php:
 *
 * add_filter( 'searchwp_live_search_base_styles', '__return_false' );
 *
 * There is a separate stylesheet that is also enqueued that applies the default
 * results theme (the visual styles) but you can disable that too by adding
 * the following to your theme's functions.php:
 *
 * wp_dequeue_style( 'searchwp-live-search' );
 *
 * You can use ~/searchwp-live-search/assets/styles/style.css as a guide to customize
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php $post_type = get_post_type_object( get_post_type() ); ?>
		<div class="searchwp-live-search-result" role="option" id="" aria-selected="false">
			<p><a href="<?php echo esc_url( get_permalink() ); ?>">
				<span class="thum_search">
					<?php
						if(has_post_thumbnail()){
							the_post_thumbnail('daneshyar-60x60');
						}
					 ?>
				</span>
				<?php the_title(); ?> &raquo;
				<?php
				if($post_type->name=='product'): 
					$product = new WC_Product(get_the_ID()); 
				?>
				<span class="searc_price">
					<?php 
						echo $product->get_price_html();
					?>
				</span>
				<?php endif; ?>
			</a></p>
		</div>
	<?php endwhile; ?>
<?php else : ?>
	<p class="searchwp-live-search-no-results" role="option">
		<em><?php esc_html_e( 'No results found.', BIO_PLUGIN_NAME ); ?></em>
	</p>
<?php endif; ?>
