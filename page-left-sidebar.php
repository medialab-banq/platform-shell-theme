<?php
/**
 * Template Name: Left Sidebar Page
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>

<?php get_header(); ?>


<section class="section">
	<div class="container">

		<div id="content" class="clearfix container">
			<div class="col-xs-12 col-sm-4">
				<?php get_sidebar(); // sidebar 1. ?>
			</div>

			<main id="main" class="col-lg-8 clearfix" role="main">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

					<header>

						<div class="page-header"><h1><?php the_title(); ?></h1></div>

					</header> <!-- end article header -->

					<section class="post_content">
						<?php the_content(); ?>

					</section> <!-- end article section -->

				<?php endwhile; ?>

			<?php else : ?>

				<article id="post-not-found">
					<header>
						<h1><?php esc_html_e( 'Introuvable', 'platform-shell-theme' ); ?></h1>
					</header>
					<section class="post_content">
						<p><?php esc_html_e( 'La ressource demandée est introuvable sur le site.', 'platform-shell-theme' ); ?></p>
					</section>
					<footer>
					</footer>
				</article>

			<?php endif; ?>

			</main> <!-- end #main -->

		</div> <!-- end #content -->
	</div>
</section>

<?php get_footer(); ?>
