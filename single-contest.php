<?php
/**
 * Template Name: Single Contest
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
				<p class="label-projet"><a href="../"><i class="fa fa-chevron-left" aria-hidden="true"></i>  <?php echo esc_html_x( 'Concours', 'single-contest', 'platform-shell-theme' ); ?></a></p>
				</div>
			</section>

			<section class="contenu concoursDetail row">

				<div class="col-12-xs">
				<h1><?php the_title(); ?></h1>
				</div>

				<div class="projetInfo concoursInfo">
				<div>
					<?php
					// Affichage de l'icône du type de projet.
					echo wp_kses_post( platform_shell_theme_get_contest_type_icon( get_the_ID() ) );
					?>
					</div>
				</div>

				<p><?php echo esc_html_x( 'Organisateur : ', 'single-contest', 'platform-shell-theme' ); ?></p>
				<p class="concoursCreateur">
					<?php
					$banner = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_sponsor_image', true );
					if ( '' !== isset( $banner ) && $banner ) {
						echo wp_get_attachment_image( $banner, 'full' );
					}
					?>
				</p>

			</div>
			</section>

			<section class="contenu concoursDetail row">
				<div class="col-md-3 col-sm-6 concoursInfo">
					<p class="concoursH3"><?php echo esc_html_x( 'Durée', 'single-contest', 'platform-shell-theme' ); ?></p>
				<?php
				$opening_date               = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_date_open', true );
				$end_date                   = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_date_end', true );
				$winners_date               = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_date_winners_announcement', true );
				?>
				<p>
				<?php
					$formatted_opening_date = platform_shell_get_html_formatted_date( $opening_date );
					$formatted_end_date     = platform_shell_get_html_formatted_date( $end_date );

					/* translators: %1$s: Date d'ouverture,  %2$s: Date de fermeture */
					echo wp_kses_post( sprintf( _x( '<span class="text-nowrap">%1$s</span> au <span class="text-nowrap">%2$s</span>', 'single-contest', 'platform-shell-theme' ), $formatted_opening_date, $formatted_end_date ) );
				?>

				</p>
				</div>
				<div class="col-md-3 col-sm-6 concoursInfo">
				<p class="concoursH3"><?php echo esc_html_x( 'Annonce des gagnants', 'single-contest', 'platform-shell-theme' ); ?></p>
				<p><span class="text-nowrap"><?php echo wp_kses_post( platform_shell_get_html_formatted_date( $winners_date ) ); ?></span></p>
				</div>
				<div class="col-md-3 col-sm-6 concoursInfo">
				<p class="concoursH3"><a href="<?php echo do_shortcode( '[platform_shell_permalink_by_page_id id="platform-shell-page-general-rules"]' ); ?>"><?php echo esc_html_x( 'Admissibilité', 'single-contest', 'platform-shell-theme' ); ?></a></p>
				<p><?php echo wp_kses_post( platform_shell_theme_get_admissibility( get_the_ID() ) ); ?></p>
				</div>
				<div class="col-md-3 col-sm-6 concoursInfo">
				<?php
					$first_prize_image = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_main_prize_image', true );
					$first_prize       = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_main_prize', true );
				?>
				<img src="<?php echo esc_url( wp_get_attachment_url( $first_prize_image ) ); ?>" alt="<?php echo esc_attr( $first_prize ); ?>" class="imgPrix" />
				<div class="textePrix">
					<p class="concoursH3"><?php echo esc_html_x( 'Prix', 'single-contest', 'platform-shell-theme' ); ?></p>
					<p><?php echo wp_kses_post( $first_prize ); ?></p>
				</div>
				</div>
			</section>

			<section class="contenu concoursDetail row">

				<?php
				$slider_custom_post_type_name = 'contest'; // BAD.
				include locate_template( 'partials/slider.php' );
				?>

				<div class="col-xs-12 concoursDescription">
					<?php the_content(); ?>
				</div>

				<div class="col-xs-12 concoursMots">
					<?php platform_shell_the_tags( get_the_ID(), 'platform_shell_tax_contest_tags' ); ?>
				</div>

				<?php
					contest_subscription_button( 'reglements-des-concours' );
				?>
			</section>

			<section class="contenu concoursDetail row">
				<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h2><?php echo esc_html_x( 'Modalités de participation', 'single-contest', 'platform-shell-theme' ); ?></h2>
					<p>
					<?php
						$terms = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_terms', true );
						echo wp_kses_post( $terms );
						?>
						</p>
					</div>
					<div class="col-sm-6 col-xs-12">
						<h2><?php echo esc_html_x( 'Critères d’évaluation', 'single-contest', 'platform-shell-theme' ); ?></h2>
						<p>
						<?php
						$evaluation_criteria = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_evaluation_criteria', true );
						echo wp_kses_post( $evaluation_criteria );
						?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-12 concoursJury">
						<h2><?php echo esc_html_x( 'Jury', 'single-contest', 'platform-shell-theme' ); ?></h2>
						<p>
						<?php
						$judges = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_judges', true );
						echo wp_kses_post( $judges );
						?>
						</p>
					</div>
					<div class="col-sm-6 col-xs-12">
						<h2><?php echo esc_html_x( 'Autres prix', 'single-contest', 'platform-shell-theme' ); ?></h2>
						<p>
						<?php
						$other_prizes = get_post_meta( get_the_ID(), 'platform_shell_meta_contest_prize', true );
						echo wp_kses_post( $other_prizes );
						?>
						</p>
					</div>
				</div>
			</section>

			<section class="contenu concoursDetail row">
				<div class="col-md-12 concoursInscrits">
					<h2><?php echo esc_html_x( 'Projets inscrits', 'single-contest', 'platform-shell-theme' ); ?></h2>
					<?php echo get_projects_x_contest( get_the_ID() ); // phpcs:ignore --The content is generated and escaped by the plugin ?>
				</div>
			</section>

			<section class="contenu concoursDetail row">
				<div class="col-md-12 commentaires">
					<h2><?php echo esc_html_x( 'Commentaires', 'comments', 'platform-shell-theme' ); ?></h2>
					<div><?php wp_kses_post( comments_template() ); ?></div>
				</div>
			</section>

		<?php
	endwhile;
else :
?>
	<section class="contenu concoursDetail row">
		<p><?php echo esc_html_x( 'Problème technique', 'single-contest', 'platform-shell-theme' ); ?></p>
	</section>
<?php endif; ?>

<?php get_footer(); ?>
