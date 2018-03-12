<?php
/**
 * Template par défaut
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<!-- feature Clear skin  -->
<section class="section white-section full-section ">
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
				<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
?>
					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>
				<?php endwhile; ?>

				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

		</div>
	</div> <!-- eof row -->
</div>
</section>
<?php if ( get_next_posts_link() || get_previous_posts_link() ) { ?>
<section class="section grey-section section-padding-top-bottom">
			<div class="container">
<?php	page_navi(); ?>
			</div>
</section>
<?php } ?>
