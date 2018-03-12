<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section class="section white-section full-section ">
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<?php get_template_part( 'content', 'none' ); ?>
		</div>
	</div> <!-- eof row -->
</div>
</section>

<?php
get_footer();
