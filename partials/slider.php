<?php
/**
 * Slider partial
 *
 * @package     Platform-Shell
 * @author      Bibliothèque et Archives nationales du Québec (BAnQ)
 * @copyright   2018 Bibliothèque et Archives nationales du Québec (BAnQ)
 * @license     GPL-2.0 or (at your option) any later version
 */

if ( ! isset( $slider_custom_post_type_name ) ) {
	return;
}

$post_id = get_the_ID();

$has_post_thumbnail = has_post_thumbnail( $post_id );

// Faire extraction des id d'images s'il y a une liste enregistrée. ex.: "id_img, idi_img, ...".
$images_gallery_data = get_post_meta( $post_id, 'platform_shell_meta_gallery', true );
if ( '' !== $images_gallery_data ) {
	$images_gallery = explode( ',', $images_gallery_data );
}

// Faire extraction des urls de vidéo s'il y a une liste enregistrée. Ex.: "[url youtube], [url vimeo], ...".
$videos_metadata_name = 'platform_shell_meta_video';

$videos      = [];
$videos_data = get_post_meta( $post_id, $videos_metadata_name, true );
if ( '' !== $videos_data ) {
	$videos = explode( ',', $videos_data );
	array_walk(
		$videos, function ( &$item ) {
			$item = trim( $item );
		}
	);
}

$display_slider = $has_post_thumbnail | isset( $gallery ) | ! empty( $videos );
?>

<?php if ( $display_slider ) : ?>
	<div class="col-xs-12">
		<ul class="bxsliderLG">
			<!-- ORDRE: Idéalement, il y aurait un contrôle minimal par l'usager sur l'ordre des éléments dans le carrousel -->
			<!-- Image principale en premier. -->
			<?php
			if ( $has_post_thumbnail ) {
				$url = get_the_post_thumbnail_url( $post_id, 'large' );

				$image_title = get_post( get_post_thumbnail_id() )->post_title;
				$image_alt   = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );

				echo '<li><img src="' . esc_url( $url ) . '" title="' . esc_attr( $image_title ) . '" alt="' . esc_attr( $image_alt ) . '" /></li>';
			}
			?>
			<!-- Gallerie d'images en deuxième. -->
			<?php
			if ( isset( $images_gallery ) ) {
				foreach ( $images_gallery as $image_id ) {
					list($url, $width, $height, $is_intermediate) = wp_get_attachment_image_src( $image_id, 'large' );
					$image_url                                    = $url; /* id d'image. */
					$image_alt                                    = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
					$image_title                                  = get_post( $image_id )->post_title;

					echo '<li><img src="' . esc_url( $url ) . '" title="' . esc_attr( $image_title ) . '" alt="' . esc_attr( $image_alt ) . '" /></li>';
				}
			}
			?>
			<!-- Vidéos en troisième. -->
			<?php
			if ( isset( $videos ) ) {
				foreach ( $videos as $video_url_or_id ) {
					// Note: Un url sans protocole, ex. www.youtube.com/... ne va pas être traité comme oembed et ne va pas fonctionner
					// dans l'autre méthode par id / youtube hardcodé.
					// Il faudrait donc qu'il y ait une vérificatiopn de la présence de protocol lors de l'enregistrement des urls de projet.
					// Il pourrait aussi y avoir une vérification en utilisant le retour de wp_embed_get.
					$is_url = ( strpos( $video_url_or_id, 'http://' ) !== false || strpos( $video_url_or_id, 'https://' ) !== false );

					if ( ! $is_url ) {
						$video_url_or_id = 'https://www.youtube.com/watch?v=' . $video_url_or_id;
					}

					$embed_code = wp_oembed_get( $video_url_or_id );
					if ( false !== $embed_code ) {
						// phpcs:ignore WordPress --We use the embed code obtained by wp_oembed_get()
						echo '<li>' . $embed_code . '</li>';
					}
				}
			}
			?>
		</ul>
	</div>
<?php endif; ?>
