<?php
/**
 * Template pour le contenu des posts
 *
 * The template used for displaying post content in post.php
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<div class="post-inner-content">
		<header class="entry-header page-header">
			<h1 class="entry-title " itemprop="name headline"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content" itemprop="articleBody">
<?php the_content(); ?>
			<?php
			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . _x( 'Pages :', 'content-post', 'platform-shell-theme' ),
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '%',
					'echo'        => 1,
				)
			);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">

<?php if ( has_tag() ) : ?>
				<!-- tags -->
				<div class="tagcloud">

	<?php
	$tags = get_the_tags( get_the_ID() );
	foreach ( $tags as $tag ) {
		echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a> ';
	}
	?>

				</div>
				<!-- end tags -->
<?php endif; ?>

		</footer><!-- .entry-meta -->
	</div>
	<div class="post-inner-content secondary-content-box">
		<!-- author bio -->
		<div class="author-bio content-box-inner">

			<!-- avatar -->
			<div class="avatar">
<?php echo get_avatar( get_the_author_meta( 'ID' ), '30', '', '', array( 'class' => 'img-circle' ) ); ?>
			</div>
			<!-- end avatar -->

			<!-- user bio -->
			<div class="author-bio-content">

				<h4 class="author-name" itemprop="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a></h4>
				<p class="author-description">
					<?php echo esc_html( get_the_author_meta( 'description' ) ); ?>
				</p>

			</div>
			<!-- end author bio -->

		</div>
		<!-- end author bio -->
	</div>
</article><!-- #post-## -->
