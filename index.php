<?php
/**
 * Template de base
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();
?>

<section class="contenu row">

	<div id="content" class="clearfix row">

		<div id="articles-list" class="col-xs-12  articles " itemscope itemtype="https://schema.org/ItemList">

			<?php
			// Start the loop.
			if ( have_posts() ) :
				?>
				<header>
					<h1 itemprop="name"><?php echo esc_html_x( 'Quoi de neuf?', 'index', 'platform-shell-theme' ); ?></h1>
				</header>

	<?php
	while ( have_posts() ) :
		the_post();
?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<p class="credtPost">
							<?php
								printf(
									/* translators: %1$s : Date, %2$s : Auteur */
									_x(
										'%1$s par %2$s',
										'author-line',
										'platform-shell-theme'
									),
									get_the_time( 'j F Y' ),
									get_the_author_posts_link()
								);
							?>
						</p>

						<!-- Display the Post's excerpt in a div box. -->
						<div class="entry">
							<?php the_excerpt(); ?>
						</div>

					</article>

					<?php
					// End the loop.
				endwhile;
				?>
				<div class="pagination row">
					<div class="container">
						<div class="nav-previous alignleft"><?php next_posts_link( esc_html_x( 'Plus anciens', 'index', 'platform-shell-theme' ) ); ?></div>
						<div class="nav-next alignright"><?php previous_posts_link( esc_html_x( 'Plus récents', 'index', 'platform-shell-theme' ) ); ?></div>
					</div>
				</div>
				<?php

				// If no content, include the "No posts found" template.
			else :
				get_template_part( 'content', 'none' );
			endif;
			?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
