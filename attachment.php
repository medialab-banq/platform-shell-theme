<?php
/**
 * Attachment Template file
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header(); ?>

			<div id="content" class="clearfix row">

				<div id="main" class="col col-lg-8 clearfix" role="main">

					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="https://schema.org/BlogPosting">

						<header>

							<div class="page-header"><h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1></div>

							<p class="meta"><?php esc_html_e( 'Envoyé', 'platform-shell-theme' ); ?> <time datetime="<?php echo the_time( 'Y-m-j' ); ?>" pubdate><?php the_time(); ?></time> <?php esc_html_e( 'par', 'platform-shell-theme' ); ?> <?php the_author_posts_link(); ?> <span class="amp">&amp;</span> <?php esc_html_e( 'Classé sous : ', 'platform-shell-theme' ); ?> <?php the_category( ', ' ); ?>.</p>

						</header> <!-- end article header -->

						<section class="post_content clearfix" itemprop="articleBody">

							<?php the_content(); ?>

						</section> <!-- end article section -->

						<footer>

							<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Mots-clés', 'platform-shell-theme' ) . ':</span> ', ' ', '</p>' ); ?>

						</footer> <!-- end article footer -->

					</article> <!-- end article -->

					<?php comments_template(); ?>

					<?php endwhile; ?>

					<?php else : ?>

					<article id="post-not-found">
						<header>
							<h1><?php esc_html_e( 'Introuvable.', 'platform-shell-theme' ); ?></h1>
						</header>
						<section class="post_content">
							<p><?php esc_html_e( 'La ressource demandée est introuvable sur le site.', 'platform-shell-theme' ); ?></p>
						</section>
						<footer>
						</footer>
					</article>

					<?php endif; ?>

				</div> <!-- end #main -->

				<?php get_sidebar(); // sidebar 1. ?>

			</div> <!-- end #content -->

<?php
	get_footer();
