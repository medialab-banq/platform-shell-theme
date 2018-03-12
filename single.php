<?php
/**
 * Template Name: Single
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();
?>

<section class="contenu row singleContenu">
	<?php
	get_template_part( 'content', 'single' );
	?>
</section>

<section class="contenu row">
	<div class="colxs-12 commentaires">
		<h2><?php echo esc_html_x( 'Commentaires', 'single', 'platform-shell-theme' ); ?></h2>
		<div><?php comments_template(); ?></div>
	</div>
</section>

<?php get_footer(); ?>
