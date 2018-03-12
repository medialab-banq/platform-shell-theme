<?php
/**
 * Template pour le contenu des pages
 *
 * The template used for displaying page content in page.php
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<!-- content-page.php -->
<div class="post-inner-content">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
		<header class="entry-header page-header">
			<h1 class="entry-title " itemprop="name headline"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content" itemprop="articleBody">
			<?php the_content(); ?>

		</div><!-- .entry-content -->
	</article><!-- #post-## -->
</div>
