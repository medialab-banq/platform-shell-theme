<?php
/**
 * Template Name: Page
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();
?>
<!-- page.php -->
<section class="contenu row">
	<div id="content" class="clearfix row">

		<?php
		get_template_part( 'templates/view-default' );
		?>
	</div> <!-- end #content -->
</section>

<?php get_footer(); ?>
