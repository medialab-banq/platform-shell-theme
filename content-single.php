<?php
/**
 * Template pour une page simple
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
		?>
			<section class="contenu qdnDetail row">
				<div class="col-12-xs">
					<?php
					platform_shell_theme_the_social_media_links();
					?>
					<p class="label-projet"><a href="<?php echo esc_attr( do_shortcode( '[platform_shell_permalink_by_page_id id="platform-shell-page-whats-new"]' ) ); ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i><?php echo esc_html_x( '  Quoi de neuf?', 'content-single', 'platform-shell-theme' ); ?></a></p>
				</div>
				<div class="col-12-xs">
					<h1><?php the_title(); ?></h1>
				</div>
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="col-sm-6 activiteImage">
					<img src="<?php the_post_thumbnail_url( 'general-detail-medium' ); ?>" title="<?php the_title(); ?>" />
				</div>
				<div class="col-sm-6 activiteDescription">
				<?php else : ?>
				<div class="col-sm-12 activiteDescription">
				<?php endif; ?>
					<?php the_content(); ?>
				</div>
			</section>
			<footer class="entry-meta">
				<?php if ( has_tag() ) : ?>
					<div class="tagcloud">
						<?php
						$tags = get_the_tags( get_the_ID() );
						foreach ( $tags as $tag ) {
							echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a> ';
						}
						?>
					</div>
		<?php endif; ?>
			</footer>
		</div>
		<?php
		$published_date_message = _x( 'Publié le ', 'content-single', 'platform-shell-theme' ) . platform_shell_get_html_formatted_date( get_the_date( platform_shell_get_metadata_date_save_format() ), false );
		?>
		<div class="post-inner-content secondary-content-box">
			<div class="author-bio content-box-inner">
				<div class="avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), '30', '', '', array( 'class' => 'img-circle' ) ); ?>
				</div>
				<div class="author-bio-content">
					<p class="author-name" itemprop="author">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
							<?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?>
						</a><br />
						<?php echo esc_html( $published_date_message . ' ' . esc_html_x( 'à', 'content-single', 'platform-shell-theme' ) . ' ' . get_the_time() ); ?>
					</p>
					<!-- p class="author-description">
					<?php echo esc_html( get_the_author_meta( 'description' ) ); ?>
					</p-->
				</div>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>
</article><!-- #post-## -->
<?php
