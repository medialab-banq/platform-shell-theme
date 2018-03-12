<?php
/**
 * Template Name: Search
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();
?>

<section class="contenu row">

	<header class="col-xs-12">
		<h1><?php echo esc_html_x( 'Résultats', 'results', 'platform-shell-theme' ); ?></h1>
		<h2><span><?php echo esc_html_x( 'Recherche', 'search', 'platform-shell-theme' ); ?>:</span> <?php echo esc_attr( get_search_query() ); ?></h2>
	</header>

	<article id="listeActivite" class="col-xs-12 col-md-10 listeResultats" >
		<ul>
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
?>
					<li id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" class="col-xs-12">

						<a href="<?php the_permalink(); ?>"  class="imgActivite">
						<?php if ( get_post_thumbnail_id() !== '' ) : ?>
							<?php the_post_thumbnail( 'search-result-small', [ 'alt' => get_the_title() ] ); ?>
						<?php else : ?>
							<div class="listActivite-label-container"><div class="listActivite-label"><?php echo wp_kses_post( platform_shell_theme_get_search_result_item_label_for_post_type( get_post_type() ) ); ?></div></div>
								<div class="img-placeholder">
							</div>
						<?php endif; ?>
						</a>
						<div class="contenuListeActivite post_content">
							<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<?php the_excerpt( '<span class="read-more">' . _x( 'Pour en savoir plus sur ', 'search', 'platform-shell-theme' ) . ' "' . the_title( '', '', false ) . '" &raquo;</span>' ); ?>
						</div>
					</li> <!-- end item résultat -->
				<?php endwhile; ?>
			</ul>

			<?php if ( function_exists( 'page_navi' ) ) { // if expirimental feature is active. ?>
				<div class="text-center">
					<?php page_navi(); // use the page navi function. ?>
				</div>

			<?php } else { // if it is disabled, display regular wp prev & next links. ?>
				<nav class="wp-prev-next">
					<ul class="clearfix">
						<li class="prev-link"><?php next_posts_link( esc_html_x( '&laquo; Plus ancien', 'search', 'platform-shell-theme' ) ); ?></li>
						<li class="next-link"><?php previous_posts_link( esc_html_x( 'Plus récent &raquo;', 'search', 'platform-shell-theme' ) ); ?></li>
					</ul>
				</nav>
			<?php } ?>

		<?php else : ?>
			<!-- this area shows up if there are no results -->

			<article id="post-not-found">
				<!--header>
					<h1><?php echo esc_html_x( 'Aucun résultat', 'search', 'platform-shell-theme' ); ?></h1>
				</header-->
				<section class="post_content">
					<p><?php echo esc_html_x( 'Aucun résultat ne correspond à ta recherche.', 'search', 'platform-shell-theme' ); ?></p>
				</section>
				<footer>
				</footer>
			</article>
		<?php endif; ?>
	</article>
</section> <!-- end .container -->

<?php get_footer(); ?>
