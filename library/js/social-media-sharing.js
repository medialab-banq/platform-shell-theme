( function ( jQuery ) {

    // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/encodeURIComponent
    function fixedEncodeURIComponent( str ) {
	return encodeURIComponent( str ).replace( /[!'()*]/g, function ( c ) {
	    return '%' + c.charCodeAt( 0 ).toString( 16 );
	} );
    }

    jQuery( document ).ready( function () {
	
	jQuery( "a#detailFacebook" ).click( function () {
	    // Attention la vérification de l'objet facebook ne doit pas se faire avant l'enregistrement du click (problème de timing).
	    // autrement il faudrait ajouter du code pour attendre que l'objet facebook soit disponible...
	    if (typeof(FB) !== 'undefined' && FB !== null) {
		var picture = WP_platform_shell_social_media_sharing_script_settings.current_post_thumbnail;
		var caption = WP_platform_shell_social_media_sharing_script_settings.site_name;
		var link = WP_platform_shell_social_media_sharing_script_settings.current_post_permalink;
		var title =  WP_platform_shell_social_media_sharing_script_settings.current_post_title;
		var description_template = WP_platform_shell_social_media_sharing_script_settings.facebook_description_template;
		var description = description_template.replace("%post_title%", title); /* todo_eg : devrait plutôt être post description? */

		FB.ui( {
		    method: 'feed',
		    name: title,
		    link: link ,
		    picture: picture,
		    caption: caption,
		    description: description
		} );
	    }
	} );
	
	function get_twitter_share_url() {
	    var title =  WP_platform_shell_social_media_sharing_script_settings.current_post_title;
	    var link = WP_platform_shell_social_media_sharing_script_settings.current_post_permalink;
	    var message_template = WP_platform_shell_social_media_sharing_script_settings.twitter_message_template + " " /* Espace obligatoire avant url. */;
	    var message;

	    message = message_template.replace("%post_title%", title);
	    
	    var char_max_budget = 140; /* Limite twitter sans considérer l'ajout de nouvelle limite. */
	    var url_short_link_cost = 23; /* Tout url, indépendament de la longueur compte pour 23 char (utilisation de short url). */
	    var remaining_char = char_max_budget - url_short_link_cost;
	    
	    if (message.length > remaining_char) {
		var offset = message.length - remaining_char;
		var ellipsis = '...';
		title = title.substring(0, title.length - (offset + ellipsis.length)); /* todo : amélioration troncature. */
		title = title + ellipsis;
		// Réassigner le messsage avec le titre plus court.
		message = message_template.replace("%post_title%", title);
	    }
	    
	    var twitter_share_url = "https://twitter.com/intent/tweet?url=" + link + "&text=" +  encodeURIComponent(message);
	    return twitter_share_url
	}
	
	// Assigner le lien pour permettre ouverture dans nouvelle fenêtre sans erreurs de sécurité.
	jQuery( "a#detailTwitter" ).attr("href", get_twitter_share_url());
	
	// Comportement clic bouton Courriel
	jQuery( "a#detailCourriel" ).click( function () {
	    var email_message_title = WP_platform_shell_social_media_sharing_script_settings.email_message_title;
	    var email_message_template = WP_platform_shell_social_media_sharing_script_settings.email_message_template;
	    
	    var email_message = email_message_template.replace("%post_title%", WP_platform_shell_social_media_sharing_script_settings.current_post_title)
		.replace("%post_url%", WP_platform_shell_social_media_sharing_script_settings.current_post_permalink);

	    var mailto_subject = fixedEncodeURIComponent( email_message_title ); // miss conf.
	    var mailto_template = fixedEncodeURIComponent(email_message_template);

	    var mailto_body_full = fixedEncodeURIComponent(email_message);

	    var mailto_url = "mailto:?subject=" + mailto_subject + "&body=" + mailto_body_full;

	    window.location.href = mailto_url;
	} );
	
    } );
}( jQuery ));