<?php
/**
 * Template Name: Project Detail
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

use Platform_Shell\Profile;
use Platform_Shell\Admin\Admin_Notices;

get_header();
?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
?>
			<section class="contenu concoursDetail row">
			<div class="col-12-xs">
				<?php
				platform_shell_theme_the_social_media_links();
				?>
				<p class="label-projet">
					<?php
					// Lien retour liste de projet (retourner à la liste de projets ou profil usager (avec liste de projets usager).
					// en tant compte de l'affichage initial (user_id est défini si on arrive dans le détail via profil user).
					$profile_user_id = get_query_var( 'user_id', null );
					if ( isset( $profile_user_id ) ) {
						$target_url = Profile::get_profile_url( $profile_user_id );
					} else {
						$target_url = '../';
					}
						?>
						<a href='<?php echo esc_attr( $target_url ); ?>'><i class="fa fa-chevron-left" aria-hidden="true"></i>  <?php echo esc_html_x( 'Projets', 'single-projects', 'platform-shell-theme' ); ?></a>
					</p>
				</div>
			</section>

			<section class="contenu concoursDetail row">

				<?php
				$admin_notices = new Admin_Notices( 'POST', get_the_ID() );
				$admin_notices->show_frontend_notices();
				?>
				<div class="col-xs-12">

				<h1><?php the_title(); ?></h1>
			</div>
			<div class="col-sm-6 col-lg-8">
				<p><?php echo esc_html_x( 'Créé par', 'single-projects', 'platform-shell-theme' ); ?></p>
				<div class="row platform_shell_creators">
					<?php

					$creators    = platform_shell_plugin_get_creators( get_post() );
					$div_classes = ( 1 === sizeof( $creators ) ) ? 'col-xs-12 platform_shell_creator' : 'col-xs-12 col-sm-6 col-md-4 col-lg-3 platform_shell_creator';

					foreach ( $creators as $creator ) :
					?>
					<div class="<?php echo $div_classes; ?>">
					<?php
						echo wp_kses_post( platform_shell_theme_get_avatar( $creator, 30, 'avatar_platform_shell' ) );
					?>
					</div>
					<?php
					endforeach;
					?>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 project_modify_button" style="text-align: right;">
				<?php
				if ( function_exists( 'project_modify_button' ) ) {
					project_modify_button();
				}
				?>
				</div>
			</section>

			<section class="contenu concoursDetail row">
				<div class="col-sm-3 col-xs-6 concoursInfo">
				<p class="concoursH3"><?php echo esc_html_x( 'Publié le', 'single-projects', 'platform-shell-theme' ); ?></p>
				<p><span class="text-nowrap"><?php echo get_the_date(); ?></span></p>
				</div>
				<div class="col-sm-3 col-xs-6 concoursInfo">
				<p class="concoursH3"><?php echo esc_html_x( 'Modifié le', 'single-projects', 'platform-shell-theme' ); ?></p>
				<p><span class="text-nowrap"><?php the_modified_date( '', '', '', true ); ?></span></p>
				</div>
				<div class="col-sm-6 col-xs-12 projetInfo">
				<div>
					<?php
					/* Affichage des icônes informatifs */
					echo do_shortcode( '[platform_shell_project_info_icons project_id="' . get_the_ID() . '"]' );
					?>
					</div>
				</div>
			</section>

			<section class="contenu concoursDetail row">

				<?php
				$slider_custom_post_type_name = 'project'; // BAD.
				include locate_template( 'partials/slider.php' );
				?>

				<div class="col-xs-12 concoursDescription">
				<?php the_content(); ?>
			</div>

			<?php
			$creative_process = get_post_meta( get_the_ID(), 'platform_shell_meta_project_creative_process', true );
			?>
			<div class="col-xs-12">
				<?php if ( isset( $creative_process ) && '' !== $creative_process ) : ?>
					<h2><?php echo esc_html_x( 'Processus de création', 'single-projects', 'platform-shell-theme' ); ?></h2>
				<?php endif; ?>
				<?php
				$creative_process = get_post_meta( get_the_ID(), 'platform_shell_meta_project_creative_process', true );
				platform_shell_filter_and_display_wysiwyg( $creative_process );
				?>
				</div>

				<div class="col-xs-12 concoursMots">
			<?php platform_shell_the_tags( get_the_ID(), 'platform_shell_tax_proj_tags' ); ?>
				</div>
			</section>

			<section class="contenu concoursDetail row">
				<div class="col-md-12 concoursInscrits">
				<h2><?php echo esc_html_x( 'Inscription', 'single-projects', 'platform-shell-theme' ); ?></h2>
			<?php echo get_contests_x_project( get_the_ID() ); // phpcs:ignore --The content is generated and escaped by the plugin ?>
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
		<p>
		<?php echo esc_html_x( 'Problème technique', 'single-projects', 'platform-shell-theme' ); ?>
		</p>
	</section>
<?php endif; ?>

<?php get_footer(); ?>
