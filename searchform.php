<?php
/**
 * Template Name: Search Form
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<form id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="form-inline">
	<fieldset>
		<div class="input-group">
			<input type="text" name="s" id="search" placeholder="<?php esc_html_e( 'Recherche', 'platform-shell-theme' ); ?>" value="<?php the_search_query(); ?>" class="form-control" />
			<span class="input-group-btn">
				<button type="submit" class="btn btn-default"><?php esc_html_e( 'Recherche', 'platform-shell-theme' ); ?></button>
			</span>
		</div>
	</fieldset>
</form>
