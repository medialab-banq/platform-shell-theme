<?php
/**
 * Template pour le header
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

?>
<!doctype html>
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js no-skrollr"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no maximum-scale=1">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<!-- end of WordPress head -->
		<?php
			platform_shell_render_head_tags();
		?>
	</head>

	<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

		<?php platform_shell_render_google_tag_manager_no_script(); ?>

		<div id="preEnteteBarre">
			<div class="container">
				<div class="row Entete_barreMenu">
					<ul class="barreMenuDroite">
<?php if ( ! is_user_logged_in() ) : ?>
							<li class="userOff">
								<a href="<?php echo esc_url( wp_login_url( home_url() ) ); ?>" ><i class="fa fa-user" aria-hidden="true" title="<?php esc_attr( _x( 'Utilisateur non authentifié.', 'header', 'platform-shell-theme' ) ); ?>"></i>
									<span class="sr-only"><?php echo esc_html_x( 'Utilisateur non authentifié.', 'header', 'platform-shell-theme' ); ?></span></a>
							</li>
<?php endif; ?>

		<?php if ( is_user_logged_in() ) : ?>
		<li class="userOn">
			<a href="javascript:void(0);"><?php echo get_avatar( get_the_author_meta( 'ID' ), '38' ); ?><span class="sr-only"><?php esc_attr( _x( 'Utilisateur authentifié', 'header', 'platform-shell-theme' ) ); ?></span></a>

			<ul>
				<?php platform_shell_theme_render_login_header_links(); ?>

				<li><a href="<?php echo esc_url( platform_shell_get_profile_url() ); ?> "> <?php echo esc_html_x( 'Mon profil', 'header', 'platform-shell-theme' ); ?><i class="fa fa-user" aria-hidden="true"></i></a></li>

				<li class="deconnexion"><a href="<?php echo esc_url( wp_logout_url() ); ?>"><?php echo esc_html_x( 'Déconnexion', 'header', 'platform-shell-theme' ); ?><i class="fa fa-user-times" aria-hidden="true"></i></a></li>
			</ul>
		</li>
		<?php endif; ?>
					</ul>
					<a href="<?php echo esc_url( platform_shell_get_option_parent_organisation_link() ); ?>" class="preenteteLogo"><img src="<?php echo esc_url( platform_shell_get_option_parent_organisation_logo() ); ?>" alt="<?php echo esc_attr( platform_shell_get_option_parent_organisation_alt() ); ?>" /></a>
				</div>
			</div>
		</div>

		<header id="headerPrincipal" class="container" role="banner" itemscope itemtype="https://schema.org/WPHeader" style="background:  url('<?php echo esc_url( platform_shell_get_banner() ); ?>') no-repeat; ">
			<div class="row">
				<?php if ( is_front_page() && platform_shell_get_option_home_page_show_header_box() ) : /* Ne pas afficher ce bloc en tout temps, sinon provoque plusieurs h1 dans pages de contenu! */ ?>
					<div id="enteteEncadre">
						<h1><?php echo esc_html( platform_shell_get_option_header_box_title() ); ?></h1>
						<a href="<?php echo do_shortcode( '[platform_shell_permalink_by_page_id id="platform-shell-page-about"]' ); ?>"><?php echo esc_html_x( 'En savoir plus', 'header', 'platform-shell-theme' ); ?></a>
					</div>
				<?php endif; ?>

				<?php
				if ( is_front_page() ) {
					platform_shell_render_site_logo();
				} else {
					platform_shell_render_other_pages_site_logo();
				}
				?>

				<nav class="Entete_barreMenu">
					<ul class="barreMenuDroite">
						<li class="visible-xs-block menuRecherche">
							<a href="javascript:void(0)"><i class="fa fa-search" aria-hidden="true" title="<?php esc_attr( _x( 'Ouvrir la recherche.', 'header', 'platform-shell-theme' ) ); ?>"></i>
								<span class="sr-only"><?php echo esc_html_x( 'Ouvrir la recherche', 'header', 'platform-shell-theme' ); ?></span></a>
						</li>
						<li class="hidden-xs menuRecherche2">
							<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<label for="s" class="sr-only"> <?php echo esc_html_x( 'Entrez votre recherche', 'header', 'platform-shell-theme' ); ?></label>
								<input name="s" id="s" type="text" autocomplete="off" data-provide="typeahead" data-items="4" data-source='' title="<?php esc_attr( _x( 'Entrez ici le(s) terme(s) de votre recherche. Touche d’accès clavier=4.', 'header', 'platform-shell-theme' ) ); ?>" accesskey="4">
								<button type="submit">
									<i class="fa fa-search hidden-xs" aria-hidden="true" title="Lancer la recherche."></i>
									<span class="visible-xs-inline-block"> <?php echo esc_html_x( 'Chercher', 'header', 'platform-shell-theme' ); ?></span>
								</button>
							</form>
						</li>

					</ul>
					<ul class="barreMenuGauche">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" accesskey="1" title="<?php esc_attr( _x( 'Retour à  l’accueil. Touche d’accès clavier=1.', 'header', 'platform-shell-theme' ) ); ?>"><i class="fa fa-home" aria-hidden="true"></i>
								<span class="sr-only"><?php echo esc_html_x( 'Retour à  l’accueil.', 'header', 'platform-shell-theme' ); ?>"></span></a>
						</li>
						<li class="sousMenu"><a href="javascript:void(0)"> <i class="fa fa-bars" aria-hidden="true"></i><span class="sr-only"><?php echo esc_html_x( 'Menu.', 'header', 'platform-shell-theme' ); ?></span></a>
							<?php platform_shell_main_nav(); ?>
						</li>
						<?php if ( platform_shell_get_option_show_social_menu() ) : ?>
						<li class="shareOff"><a href="javascript:void(0)"><i class="fa fa-share" aria-hidden="true" title="Partager."></i>
								<span class="sr-only"><?php echo esc_html_x( 'Partager', 'header', 'platform-shell-theme' ); ?></span></a>
							<ul>
								<?php platform_shell_render_header_social_menu(); ?>
							</ul>
						</li>
						<?php endif; ?>
					</ul>
				</nav>
			</div>
		</header>
		<main id="main-body" role="main" itemscope itemprop="mainContentOfPage" class="container">
