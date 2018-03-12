<?php
/**
 * Template pour la liste des projets avec filtre taxonomie (catégorie).
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

?>
<section class="contenu row">

	<header class="col-lg-9 col-sm-8 col-xs-12">
		<h1><?php echo esc_html_x( 'Projets', 'list-taxonomy', 'platform-shell-theme' ); ?></h1>
		<h3>
		<?php
			echo do_shortcode( '[platform_shell_project_type_term_label name="' . $term->name . '"]' );
		?>
		</h3>
	</header>

	<div class="col-lg-3 col-sm-4 col-xs-12 boutonListeProjet">
		<a href="<?php echo do_shortcode( '[platform_shell_permalink_by_page_id id="platform-shell-page-project-create-page"]' ); ?>" class="btn btn-primary"><?php echo esc_html_x( 'Créer un projet', 'list-projects', 'platform-shell-theme' ); ?></a>
	</div>

	<article id="accueilProjets" class="col-lg-9 col-sm-8 col-xs-12 listeProjets" >

		<?php
		$params_array = array(
			'title'                   => null,
			'allItems'                => null,
			'noItems'                 => _x( ' Aucun projet n’a été inscrit.', 'list-projects', 'platform-shell-theme' ),
			'get_query_function_name' => 'platform_shell_theme_get_published_active_taxonomy_filtered_query',
			'the_tile_function_name'  => 'platform_shell_theme_the_project_tile',
			'itemsListUrl'            => null,
		);

		platform_shell_theme_the_tile_container( $params_array );
		?>

		<?php if ( function_exists( 'page_navi' ) ) { // if experimental feature is active. ?>
			<div class="text-center wrapper">
				<?php page_navi(); // use the page navi function. ?>
			</div>
		<?php } ?>
	</article>

	<aside class="col-lg-3 col-sm-4 col-xs-12 facette">
		<?php if ( is_active_sidebar( 'sidebar-project' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-project' ); ?>
		<?php endif; ?>

	</aside>
</section>
