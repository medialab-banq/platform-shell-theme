<?php
/**
 * Template Name: Homepage
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();
?>
<section class="section">
	<div class="container">
		<div id="content" class="clearfix row">
			<main  id="main" class=" clearfix" role="main">

				<?php
					get_template_part( 'templates/view-default' );
				?>

			</main>	<!-- end #main -->
		</div> <!-- end #content -->
	</div>
</section>
<?php get_footer(); ?>
