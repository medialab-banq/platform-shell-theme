<?php
/**
 * Template Name: Single Tool
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
?>

			<section class="contenu concoursDetail row">
			<div class="col-12-xs">
				<?php
				platform_shell_theme_the_social_media_links();
				?>
				<p class="label-projet"><a href="../"><i class="fa fa-chevron-left" aria-hidden="true"></i>  <?php echo esc_html_x( 'Outils numériques', 'single-tools', 'platform-shell-theme' ); ?></a></p>

				</div>

				<div class="col-12-xs">
				<h1><?php the_title(); ?></h1>

				</div>
			</section>

			<section class="contenu concoursDetail row">

				<?php if ( has_post_thumbnail() ) : ?>
				<div class="col-sm-6 activiteImage">
					<img src="<?php the_post_thumbnail_url( 'general-detail-medium' ); ?>" title="<?php the_title(); ?>" />
				</div>
				<div class="col-sm-6 activiteDescription">
				<?php else : ?>
				<div class="col-sm-12 activiteDescription">
				<?php endif; ?>
				<?php the_content(); ?>
				</div>

			</section>

			<section class="contenu concoursDetail row">
				<div class="col-md-12 commentaires">
				<h2><?php echo esc_html_x( 'Commentaires', 'comments', 'platform-shell-theme' ); ?></h2>
			<?php comments_template(); ?>
				</div>
			</section>

		<?php
	endwhile;
else :
?>

	<section class="contenu concoursDetail row">
		<p><?php echo esc_html_x( 'Problème technique', 'single-tools', 'platform-shell-theme' ); ?></p>
	</section>

<?php endif; ?>

<?php get_footer(); ?>
