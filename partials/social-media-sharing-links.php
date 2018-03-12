<?php
/**
 * Partiel pour les liens pour les média sociaux
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

platform_shell_render_facebook_sharing_script_tag();
?>
<div class="lienEntete">
	<ul>
		<li class="shareDetail"><a href="#"><i class="fa fa-share-alt"></i><span class="visible-md-inline visible-lg-inline"><?php echo esc_html_x( 'Partager', 'social-media-links', 'platform-shell-theme' ); ?></span></a>
			<ul>
				<li><a href="javascript:void(0);" id="detailFacebook">
						<i class="fa fa-facebook-official" aria-hidden="true"></i>
						<span class="visible-md-inline visible-lg-inline"><?php echo esc_html_x( 'Facebook', 'social-media-links', 'platform-shell-theme' ); ?></span>
					</a></li>
				<li><a href="javascript:void(0);" target="_blank" id="detailTwitter">
						<i class="fa fa-twitter" aria-hidden="true"></i>
						<span class="visible-md-inline visible-lg-inline"><?php echo esc_html_x( 'Twitter', 'social-media-links', 'platform-shell-theme' ); ?></span>
					</a></li>
				<li><a  href="javascript:void(0);" id="detailCourriel">
						<i class="fa fa-envelope" aria-hidden="true"></i>
						<span class="visible-md-inline visible-lg-inline"><?php echo esc_html_x( 'Courriel', 'social-media-links', 'platform-shell-theme' ); ?></span></a>
				</li>
			</ul>
		</li>
	</ul>

	<!-- signalement todo_eg. revoir reporting dans social media link.... -->
	<?php echo do_shortcode( '[platform_shell_reporting]' ); ?>
</div>
