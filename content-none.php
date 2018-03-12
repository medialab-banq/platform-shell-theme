<?php
/**
 * Template pour les pages vides
 *
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Appel dans index.php
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<!-- content-none.php -->
<section class="contenu row">
	<header class="col-xs-12">
		<h1 class="page-title"><?php echo esc_html_x( 'Page inexistante ou déplacée', 'template-content-none', 'platform-shell-theme' ); ?></h1>
	</header>
	<div class="page-content col-xs-12">
		<p><?php echo esc_html_x( 'La page que vous tentez d’atteindre n’existe pas ou a été déplacée.', 'template-content-none', 'platform-shell-theme' ); ?></p>
		<p><?php echo esc_html_x( 'Vous êtes invité :', 'none', 'platform-shell-theme' ); ?></p>
		<ul>
			<li><?php echo esc_html_x( 'à revenir à la ', 'template-content-none', 'platform-shell-theme' ); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_top"><?php echo esc_html_x( 'page d’accueil', 'template-content-none', 'platform-shell-theme' ); ?></a>;</li>
			<li><?php echo esc_html_x( 'à consulter le ', 'template-content-none', 'platform-shell-theme' ); ?><a href="<?php echo do_shortcode( '[platform_shell_permalink_by_page_id id="platform-shell-page-site-plan"]' ); ?>" target="_top"><?php echo esc_html_x( 'plan du site', 'template-content-none', 'platform-shell-theme' ); ?></a>;</li>
			<li><?php echo esc_html_x( 'à utiliser la fonction de recherche, en haut à droite de cette page;', 'content-template-none', 'platform-shell-theme' ); ?></li>
			<li><?php echo esc_html_x( 'à revenir à la ', 'template-content-none', 'platform-shell-theme' ); ?><a href="#" target="_top" onclick="window.history.go( -1 );"><?php echo esc_html_x( 'page précédente', 'template-content-none', 'platform-shell-theme' ); ?></a>.</li>
		</ul>
	</div><!-- .page-content -->
</section><!-- .no-results -->
