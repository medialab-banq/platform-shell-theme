<?php
/**
 * Template pour la page d'accueil
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();
?>

<section class="accueilSection row">
	<article id="accueilProjets" class="col-lg-9 col-sm-8 col-xs-12 grosseImg" >
		<?php

		$create_project_link = esc_url( do_shortcode( '[platform_shell_permalink_by_page_id id="platform-shell-page-project-create-page"]' ) );
		/* translators: %1$s: Lien pour la page de création de projet */
		$project_creation_invite_message = '<p>' . sprintf( _x( 'Tu peux créer un projet en <a href="%1$s" >cliquant ici.</a> ', 'shortcode-add-project', 'platform-shell-theme' ), $create_project_link ) . '</p></div>';

		$params_array = array(
			'title'                   => _x( 'Projets à découvrir', 'home', 'platform-shell-theme' ),
			'allItems'                => _x( 'Tous les projets', 'home', 'platform-shell-theme' ),
			'noItems'                 => _x( 'Aucun projet n’a été inscrit.', 'home', 'platform-shell-theme' ) . $project_creation_invite_message,
			'get_query_function_name' => 'platform_shell_theme_get_projects_list_query',
			'the_tile_function_name'  => 'platform_shell_theme_the_project_tile',
			'itemsListUrl'            => get_post_type_archive_link( 'project' ),
			'displayContext'          => 'home',
		);

		platform_shell_theme_the_tile_container( $params_array );
		?>
	</article>

	<aside  class="col-lg-3 col-sm-4 col-xs-12">
		<div class="row">
			<article id="accueilConcours" class="col-sm-12">
				<?php
				if ( is_active_sidebar( 'homepage-contest' ) ) {
					echo '<h2 class="hidden-title">' . esc_html_x( 'Concours', 'home', 'platform-shell-theme' ) . '</h2>';
					dynamic_sidebar( 'homepage-contest' );
				} else {
					$params_array = array(
						'title'                   => _x( 'Concours', 'home', 'platform-shell-theme' ),
						'allItems'                => _x( 'Tous les concours', 'home', 'platform-shell-theme' ),
						'noItems'                 => _x( 'Aucun concours', 'home', 'platform-shell-theme' ),
						'get_query_function_name' => 'platform_shell_theme_get_contests_list_query',
						'the_tile_function_name'  => null, /* Pas d'affichage de preview. */
						'itemsListUrl'            => get_post_type_archive_link( 'contest' ),
						'displayContext'          => 'home',
					);

					platform_shell_theme_the_tile_container( $params_array );
				}
				?>
			</article>

			<article id="accueilActivites" class="col-sm-12">
				<?php
				$params_array = array(
					'title'                   => _x( 'Activités', 'home', 'platform-shell-theme' ),
					'allItems'                => _x( 'Toutes les activités', 'home', 'platform-shell-theme' ),
					'noItems'                 => _x( 'Aucune activité n’est prévue.', 'home', 'platform-shell-theme' ),
					'get_query_function_name' => 'platform_shell_theme_get_activities_list_query',
					'the_tile_function_name'  => 'platform_shell_theme_the_activity_tile',
					'itemsListUrl'            => get_post_type_archive_link( 'activity' ),
					'displayContext'          => 'home',
				);

				platform_shell_theme_the_tile_container( $params_array );
				?>
			</article>
		</div>
	</aside>
</div>
</section>

<section class="accueilSection row">
	<article id="accueilEquipement" class="col-sm-6 col-xs-12">
		<?php
		$params_array = array(
			'title'                   => _x( 'Équipements disponibles', 'home', 'platform-shell-theme' ),
			'allItems'                => _x( 'Tous les équipements', 'home', 'platform-shell-theme' ),
			'noItems'                 => _x( 'Aucun équipement disponible', 'home', 'platform-shell-theme' ),
			'get_query_function_name' => 'platform_shell_theme_get_equipments_list_query',
			'the_tile_function_name'  => 'platform_shell_theme_the_equipment_tile',
			'itemsListUrl'            => get_post_type_archive_link( 'equipment' ),
			'displayContext'          => 'home',
		);

		platform_shell_theme_the_tile_container( $params_array );
		?>
	</article>
	<article id="accueilEquipement" class="col-sm-6 col-xs-12">
		<?php
		$params_array = array(
			'title'                   => _x( 'Outils numériques', 'home', 'platform-shell-theme' ),
			'allItems'                => _x( 'Tous les outils', 'home', 'platform-shell-theme' ),
			'noItems'                 => _x( 'Aucun outil numérique disponible', 'home', 'platform-shell-theme' ),
			'get_query_function_name' => 'platform_shell_theme_get_tools_list_query',
			'the_tile_function_name'  => 'platform_shell_theme_the_tool_tile',
			'itemsListUrl'            => get_post_type_archive_link( 'tool' ),
			'displayContext'          => 'home',
		);

		platform_shell_theme_the_tile_container( $params_array );
		?>
	</article>
</section>

<section class="accueilSection row">
	<article id="accueilQdN"  class="col-xs-12">
		<?php
		$params_array = array(
			'title'                   => _x( 'Quoi de neuf&#8239;?', 'home', 'platform-shell-theme' ),
			'allItems'                => _x( 'Tous les articles', 'home', 'platform-shell-theme' ),
			'noItems'                 => _x( 'Il n’y a aucun article.', 'home', 'platform-shell-theme' ),
			'get_query_function_name' => 'platform_shell_theme_get_articles_home_list_query',
			'the_tile_function_name'  => 'platform_shell_theme_the_article_tile',
			'itemsListUrl'            => do_shortcode( '[platform_shell_permalink_by_page_id id="platform-shell-page-whats-new"]' ),
			'displayContext'          => 'home',
		);

		platform_shell_theme_the_tile_container( $params_array );
		?>
	</article>
</section>

<?php get_footer(); ?>
