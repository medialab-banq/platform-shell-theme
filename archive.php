<?php
/**
 * Template pour les archives
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<?php get_header(); ?>

<?php
if ( is_post_type_archive( 'project' ) ) {
	get_template_part( 'list', 'projects' );
}

if ( is_post_type_archive( 'contest' ) ) {
	get_template_part( 'list', 'contests' );
}

if ( is_post_type_archive( 'activity' ) ) {
	get_template_part( 'list', 'activities' );
}

if ( is_post_type_archive( 'equipment' ) ) {
	get_template_part( 'list', 'equipments' );
}

if ( is_post_type_archive( 'tool' ) ) {
	get_template_part( 'list', 'tools' );
}

if ( is_tax() ) {
	get_template_part( 'list', 'taxonomies' );
} else {
	?>

	<?php if ( is_category() ) { ?>
		<section class="contenu row">
			<header class="col-xs-12">
				<h1><span><?php echo esc_html_x( 'Catégories :', 'archive', 'platform-shell-theme' ); ?></span> <?php single_cat_title(); ?></h1>
			</header>
		</section>
	<?php } elseif ( is_tag() ) { ?>
		<section class="contenu row">
			<header class="col-xs-12">
				<h1><span><?php echo esc_html_x( 'Mots-clés :', 'archive', 'platform-shell-theme' ); ?></span> <?php single_tag_title(); ?></h1>
			</header>
		</section>
	<?php } elseif ( is_author() ) { ?>
		<section class="contenu row">
			<header class="col-xs-12">
				<h1><span><?php echo esc_html_x( 'Publiés par :', 'archive', 'platform-shell-theme' ); ?></span> <?php get_the_author_meta( 'display_name' ); ?></h1>
			</header>
		</section>
	<?php } elseif ( is_day() ) { ?>
		<section class="contenu row">
			<header class="col-xs-12">
				<h1><span><?php echo esc_html_x( 'Archives quotidiennes :', 'archive', 'platform-shell-theme' ); ?></span> <?php the_time( 'l, F j, Y' ); ?></h1>
			</header>
		</section>
	<?php } elseif ( is_month() ) { ?>
		<section class="contenu row">
			<header class="col-xs-12">
				<h1><span><?php echo esc_html_x( 'Archives mensuelles :', 'archive', 'platform-shell-theme' ); ?>:</span> <?php the_time( 'F Y' ); ?></h1>
			</header>
		</section>
	<?php } elseif ( is_year() ) { ?>
		<section class="contenu row">
			<header class="col-xs-12">
				<h1><span><?php echo esc_html_x( 'Archives annuelles :', 'archive', 'platform-shell-theme' ); ?>:</span> <?php the_time( 'Y' ); ?></h1>
			</header>
		</section>

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
?>
				<section class="contenu row">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix col-xs-12 noPad strechArcticle' ); ?> role="article">
						<header>
							<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							<p class="meta"><?php echo esc_html_x( 'Écrit le ', 'archive', 'platform-shell-theme' ); ?> <?php the_time( 'j F Y' ); ?>
							<!-- <time datetime="<?php echo the_time( 'Y-m-j' ); ?>" pubdate><?php the_time(); ?></time>-->
								<?php echo esc_html_x( 'par', 'archive', 'platform-shell-theme' ); ?> <?php the_author_posts_link(); ?>. <?php echo esc_html_x( 'Classé sous ', 'archive', 'platform-shell-theme' ); ?> <?php the_category( ', ' ); ?>.</p>

						</header> <!-- end article header -->

						<div class="post_content">

							<?php the_excerpt(); ?>

						</div> <!-- end div.post_content -->
					</article>
				</section>

			<?php endwhile; ?>

		<?php endif; ?>

	<?php } ?>
<?php } ?>
<?php get_footer(); ?>
