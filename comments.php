<?php
/**
 * Comment Template file
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

use Platform_Shell\Profile;

// Do not delete these lines.
// La valeur $_SERVER['SCRIPT_FILENAME'] est définie par le système, donc digne de confiance.
if ( isset( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' === basename( sanitize_text_field( wp_unslash( $_SERVER['SCRIPT_FILENAME'] ) ) ) ) { // Input var okay.
	die( esc_html_x( 'Ne pas télécharger cette page directement, merci!', 'comments', 'platform-shell-theme' ) );
}

if ( ! empty( $post->post_password ) ) { // if there's a password
	// Puisque nous fesons uniquement une communication avec la valeur $_COOKIE, nous n'avons pas besoin de la néttoyer.
	if ( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] !== $post->post_password ) {  // and it doesn't match the cookie.
		?>

		<h2><?php echo esc_html_x( 'Protégé par mot de passe', 'comments', 'platform-shell-theme' ); ?></h2>
		<p><?php echo esc_html_x( 'Entrer le mot de passe pour voir les commentaires', 'comments', 'platform-shell-theme' ); ?></p>

		<?php
		return;
	}
}

/* This variable is for alternating comment background */
$oddcomment = 'alt';
?>

<!-- You can start editing here. -->

<div class="cadre_commentaires">
<?php if ( $comments ) : ?>
		<h3 id="comments"><?php comments_number( _x( 'Pas de commentaire', 'comments', 'platform-shell-theme' ), _x( 'Un commentaire', 'comments', 'platform-shell-theme' ), _x( '% commentaires', 'comments', 'platform-shell-theme' ) ); ?> pour &#8220;<?php the_title(); ?>&#8221;</h3>

		<ol class="commentlist">
	<?php foreach ( $comments as $comment ) : ?>

				<li class="<?php echo esc_attr( $oddcomment ); ?>" id="comment-<?php comment_ID(); ?>">
					<div class="commentmetadata">
						<?php echo  get_avatar( $comment->user_id, 30, '', '', array( 'class' => 'img-circle' ) ); ?>
						<strong><a href="<?php echo esc_attr( Profile::get_profile_url( $comment->user_id ) ); ?>"><?php comment_author_link(); ?></a></strong>,
						<?php
						$date = get_comment_date();  // Si nous ne spécifions pas un format de date, le format choisi par l'utilisateur dans la page de configuration dans la console d'administration est utilisée.
						$time = get_comment_time();
						/* translators: %1$s: date, %2$s: heure */
						echo esc_html( sprintf( _x( 'le %1$s &agrave; %2$s', 'comments', 'platform-shell-theme' ), $date, $time ) );
						?>
					<?php if ( '0' === $comment->comment_approved ) : ?>
							<em><?php echo esc_html_x( 'Ton commentaire est en cours de modération.', 'comments', 'platform-shell-theme' ); ?></em>
					<?php endif; ?>
					</div>
				<?php comment_text(); ?>
				</li>

				<?php
				/* Changes every other comment to a different class */
				if ( 'alt' === $oddcomment ) {
					$oddcomment = '';
				} else {
					$oddcomment = 'alt';
				}
				?>

		<?php endforeach; /* end for each comment */ ?>
		</ol>

<?php else : // this is displayed if there are no comments so far. ?>

	<?php if ( 'open' === $post->comment_status ) : ?>
			<!-- If comments are open, but there are no comments. -->
		<?php else : // comments are closed. ?>

			<!-- If comments are closed. -->
			<p class="nocomments"><?php echo esc_html_x( 'La section Commentaires est fermée.', 'comments', 'platform-shell-theme' ); ?></p>

	<?php endif; ?>
<?php endif; ?>
</div>

<?php if ( 'open' === $post->comment_status ) : ?>

	<h3 id="respond"><?php echo esc_html_x( 'Laisser un commentaire', 'comments', 'platform-shell-theme' ); ?></h3>

		<?php if ( get_option( 'comment_registration' ) && ! $user_ID ) : ?>
		<p>
		<?php
			printf(
				/* translators: %1$s: Lien de connexion */
				_x(
					'Tu dois être <a href="%1$s">connecté</a> pour laisser un commentaire.',
					'connected-comments',
					'platform-shell-theme'
				),
				esc_url( platform_shell_get_return_to_current_page_login_url() )
			);
		?>
		</p>

	<?php else : ?>

		<form action="<?php echo esc_url( get_option( 'siteurl' ) ); ?>/wp-comments-post.php" method="post" id="commentform">
			<?php if ( $user_ID ) : ?>

				<p><?php echo esc_html_x( 'Connecté en tant que', 'comments', 'platform-shell-theme' ); ?> <a href="<?php echo esc_url( Profile::get_profile_url( get_current_user_id() ) ); ?>"><?php echo esc_html( $user_identity ); ?></a>.
					<span class="commentDeconnexion"><a href="<?php echo esc_url( wp_logout_url() ); ?>" title="<?php echo esc_attr_x( 'Déconnexion', 'comments', 'platform-shell-theme' ); ?>"><?php echo esc_html_x( 'Déconnexion &raquo;', 'comments', 'platform-shell-theme' ); ?></a></span></p>

		<?php else : ?>

				<p><input type="text" name="author" id="author" value="<?php echo esc_attr( $comment_author ); ?>" size="40" tabindex="1" />
					<label for="author"><small><?php echo esc_html_x( 'Nom', 'comments', 'platform-shell-theme' ); ?>
					<?php
					if ( $req ) {
						echo esc_html_x( '(requis)', 'comments', 'platform-shell-theme' );
					}
					?>
					</small></label></p>

				<p><input type="text" name="email" id="email" value="<?php echo esc_attr( $comment_author_email ); ?>" size="40" tabindex="2" />
					<label for="email"><small><?php echo esc_html_x( 'courriel (ne sera pas publié)', 'comments', 'platform-shell-theme' ); ?>
					<?php
					if ( $req ) {
						echo esc_html_x( '(requis)', 'comments', 'platform-shell-theme' );
					}
					?>
					</small></label></p>

				<p><input type="text" name="url" id="url" value="<?php echo esc_attr( $comment_author_url ); ?>" size="40" tabindex="3" />
					<label for="url"><small><?php echo esc_html_x( 'Site Web', 'comments', 'platform-shell-theme' ); ?></small></label></p>

		<?php endif; ?>

			<p><textarea name="comment" id="comment" cols="60" rows="6" tabindex="4"></textarea></p>

			<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo esc_attr_x( 'Envoyer', 'comments', 'platform-shell-theme' ); ?>" class="btn btn-primary" />
				<input type="hidden" name="comment_post_ID" value="<?php echo esc_attr( $id ); ?>" />
			</p>

		<?php do_action( 'comment_form', $post->ID ); ?>

		</form>

	<?php
	endif; // If registration required and not logged in.

endif; // if you delete this the sky will fall on your head.

