<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

global $wp_query;

$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$index = 1 + ( ( $paged - 1 ) * $wp_query->query_vars['posts_per_page'] );
?>
<?php if ( have_posts() ): ?>
	<div class="content-inner">
		<?php get_search_form() ?>

		<div class="search-results">
			<?php while ( have_posts() ): the_post(); ?>
			<article <?php post_class() ?> id="post-<?php echo esc_attr( get_the_ID() ) ?>">
				<span class="counter">
					<?php echo (int) $index++ ?>
				</span>

				<h2 class="entry-title">
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				</h2>
				<div class="entry-date"><?php echo esc_html( get_the_date() ) ?></div>

				<?php if ( has_excerpt() ): ?>
					<div class="entry-excerpt"><?php the_excerpt() ?></div>
				<?php endif ?>
			</article>
			<?php endwhile ?>
		</div>
	</div>
	
	<?php get_template_part( 'templates/blocks/pagination' ) ?>
<?php else: ?>
	<div class="content-inner">
		<?php get_search_form() ?>

		<h3><?php esc_html_e( 'Nothing Found', 'fusion' ) ?></h3>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria. Please try another search', 'fusion' ) ?></p>
		
		<p><?php esc_html_e( 'You might want to consider some of our suggestions to get better results:', 'fusion' ) ?></p>
		<ul>
			<li><?php esc_html_e( 'Check your spelling.', 'fusion' ) ?></li>
			<li><?php esc_html_e( 'Try a similar keyword, for example: tablet instead of laptop.', 'fusion' ) ?></li>
			<li><?php esc_html_e( 'Try using more than one keyword.', 'fusion' ) ?></li>
		</ul>
	</div>
<?php endif ?>
