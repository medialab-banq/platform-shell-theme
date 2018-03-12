<?php
/**
 * Template Name: Statique
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

get_header();
?>

<section class="contenu row">

	<article class="col-lg-12">

		<?php
		if ( have_posts() ) :
			the_post();
		?>
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			<div><?php the_content(); ?></div>
		<?php endif; ?>

	</article>
</section>

<?php get_footer(); ?>
