<?php
/**
 * Template pour le footer
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
</main>
<footer class="container">

	<?php if ( platform_shell_get_option_show_coordinate_and_opening_hours_box() ) : ?>
	<div id="footLocal" class="row" style="<?php echo esc_attr( get_platform_shell_footer_location_background_forced_element_style() ); ?>">
		<div>
			<div>
				<h2><?php echo esc_html_x( 'Coordonnées', 'footer', 'platform-shell-theme' ); ?></h2>
				<p>
					<?php echo wp_kses_post( platform_shell_get_option_contact_adress() ); ?>
					<?php platform_shell_render_itinerary_link(); ?>
				</p>
				<p><?php echo wp_kses_post( platform_shell_get_option_contact_phone_numer() ); ?></p>
				<p><a href="mailto:<?php echo esc_attr( platform_shell_get_option_contact_general_email() ); ?>"><?php echo wp_kses_post( platform_shell_get_option_contact_general_email() ); ?></a></p>
			</div>
			<div>
				<h2> <?php echo esc_html_x( 'Heures d’ouverture', 'footer', 'platform-shell-theme' ); ?></h2>
				<p> <?php echo wp_kses_post( platform_shell_get_option_opening_hours() ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php
	if ( get_platform_shell_show_contributors_footer() ) {
		platform_shell_render_partners_footer();
	}
	?>

	<div id="footLiens" class="row">
		<?php

			platform_shell_theme_primary_footer_links();

			// todo_refactoring  : Mise en widget = augmentation complexité inutilement (2 manière de sortir le contenu alors que seul le look est différent).
		if ( is_active_sidebar( 'footer1' ) ) {
			dynamic_sidebar( 'footer1' ); /* Afficher pied de page secondaire. */
		}
			platform_shell_theme_social_media_footer_links();
		?>
	</div>
</footer>

<?php
wp_footer(); // JS scripts are inserted using this function.
?>

</body>

</html>
