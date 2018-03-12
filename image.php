<?php
/**
 * Template pour les images
 *
 * The WordPress template hierarchy first checks for any
 * MIME-types and then looks for the attachment.php file.
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 * @link codex.wordpress.org/Template_Hierarchy#Attachment_display
 */

get_header();
?>

<div id="content" class="clearfix row">

	<div id="main" class="col-sm-8 clearfix" role="main">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="https://schema.org/BlogPosting">

					<header>

						<div class="page-header"><h1 class="single-title" itemprop="headline"><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rev="attachment"><?php echo get_the_title( $post->post_parent ); ?></a> &raquo; <?php the_title(); ?></h1></div>

						<p class="meta"><?php echo esc_html_x( 'Envoyé', 'platform-shell-theme' ); ?> <time datetime="<?php echo the_time( 'Y-m-j' ); ?>" pubdate><?php the_time(); ?></time> <?php echo esc_html_x( 'par', 'platform-shell-theme' ); ?> <?php the_author_posts_link(); ?>.</p>

					</header> <!-- end article header -->

					<section class="post_content clearfix" itemprop="articleBody">

						<!-- To display current image in the photo gallery -->
						<div class="attachment-img">
							<a href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>">

								<?php
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );

								if ( $image ) :
									?>
									<img src="<?php echo esc_url( $image[0] ); ?>" alt="" />
		<?php endif; ?>

										</a>
									</div>

									<!-- To display thumbnail of previous and next image in the photo gallery -->
									<ul id="gallery-nav" class="clearfix">
										<li class="next pull-left"><?php next_image_link(); ?></li>
										<li class="previous pull-right"><?php previous_image_link(); ?></li>
									</ul>

								</section> <!-- end article section -->

								<footer>

					<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Mots-clés', 'platform-shell-theme' ) . ':</span> ', ' ', '</p>' ); ?>

								</footer> <!-- end article footer -->

							</article> <!-- end article -->

							<?php comments_template(); ?>

						<?php endwhile; ?>

<?php else : ?>

			<article id="post-not-found">
				<header>
					<h1><?php echo esc_html_x( 'Introuvable', 'platform-shell-theme' ); ?></h1>
				</header>
				<section class="post_content">
					<p><?php echo esc_html_x( 'La ressource demandée est introuvable sur le site.', 'platform-shell-theme' ); ?></p>
				</section>
				<footer>
				</footer>
			</article>

<?php endif; ?>

	</div> <!-- end #main -->
</div> <!-- end #content -->

<?php get_footer(); ?>
