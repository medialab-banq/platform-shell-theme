<?php
/**
 * Template Name: Single Activity
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
				<?php platform_shell_theme_the_social_media_links(); ?>
				<p class="label-projet"><a href="../"><i class="fa fa-chevron-left" aria-hidden="true"></i>  <?php echo esc_html_x( 'Activités', 'single-activity', 'platform-shell-theme' ); ?></a></p>

			</div>
			</section>

			<section class="contenu concoursDetail row">
			<div class="col-12-xs">
				<h1><?php the_title(); ?></h1>
			</div>
			</section>

			<?php
			$date          = get_post_meta( get_the_ID(), 'platform_shell_meta_activity_date', true );
			$hour          = get_post_meta( get_the_ID(), 'platform_shell_meta_activity_hour', true );
			$admissibility = get_post_meta( get_the_ID(), 'platform_shell_meta_activity_admissibility', true );
			?>
			<section class="contenu concoursDetail row">
			<div class="col-md-3 col-sm-4 col-xs-6 concoursInfo">
				<p class="concoursH3"><?php echo esc_html_x( 'Date', 'single-activity', 'platform-shell-theme' ); ?></p>
				<p><span class="text-nowrap">
					<?php
					echo platform_shell_get_html_formatted_date( $date ); // phpcs:ignore WordPress --Les données sont obtenues des méthodes systèmes.
					?>
				</span></p>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-6 concoursInfo">
				<p class="concoursH3"><?php echo esc_html_x( 'Heure', 'single-activity', 'platform-shell-theme' ); ?></p>
				<p><span class="text-nowrap"><?php echo esc_html( $hour ); ?></span></p>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-6 concoursInfo">
				<p class="concoursH3"><?php echo esc_html_x( 'Public', 'single-activity', 'platform-shell-theme' ); ?></p>
				<p><?php echo wp_kses_post( $admissibility ); ?></p>
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
				<div><?php comments_template(); ?></div>
			</div>
		</section>

		<?php
	endwhile;
else :
	?>
	<section class="contenu concoursDetail row">
		<p><?php echo esc_html_x( 'Problème technique', 'single-activity', 'platform-shell-theme' ); ?></p>
	</section>
<?php endif; ?>

<?php get_footer(); ?>
