
( function ( $ ) {

    function init_menu_scripts() {

	$( ".userOn > a" ).click( function () {
	    $( this ).parent().toggleClass( "userOuvert" );
	    $( "li.shareOn" ).addClass( "shareOff" );
	    $( "li.shareOn" ).removeClass( "shareOn" );
	    $( "li" ).removeClass( "menuOuvert" );
	    $( "li" ).removeClass( "rechercheOuvert" );
	    $( ".shareDetail" ).removeClass( "shareDetailOuvert" );
	} );

	$( ".shareOff > a" ).click( function () {
	    $( this ).parent().toggleClass( "shareOn" );
	    $( "li" ).removeClass( "userOuvert" );
	    $( "li" ).removeClass( "menuOuvert" );
	    $( "li" ).removeClass( "rechercheOuvert" );
	    $( ".shareDetail" ).removeClass( "shareDetailOuvert" );
	} );

	$( ".sousMenu > a" ).click( function () {
	    $( this ).parent().toggleClass( "menuOuvert" );
	    $( "li" ).removeClass( "rechercheOuvert" );
	    $( "li" ).removeClass( "userOuvert" );
	    $( "li.shareOn" ).addClass( "shareOff" );
	    $( "li.shareOn" ).removeClass( "shareOn" );
	    $( ".shareDetail" ).removeClass( "shareDetailOuvert" );
	} );

	$( ".menuRecherche > a" ).click( function () {
	    $( "li.menuRecherche2" ).toggleClass( "rechercheOuvert" );
	    $( "li" ).removeClass( "userOuvert" );
	    $( "li" ).removeClass( "menuOuvert" );
	    $( "li.shareOn" ).addClass( "shareOff" );
	    $( "li.shareOn" ).removeClass( "shareOn" );
	    $( ".shareDetail" ).removeClass( "shareDetailOuvert" );
	} );

	$( ".shareDetail > a" ).click( function () {
	    $( ".shareDetail" ).toggleClass( "shareDetailOuvert" );
	    $( "li.shareOn" ).addClass( "shareOff" );
	    $( "li.shareOn" ).removeClass( "shareOn" );
	    $( "li" ).removeClass( "menuOuvert" );
	    $( "li" ).removeClass( "rechercheOuvert" );
	} );
    }

    function init_bx_slider_scripts() {
	var bxslider = $( '.bxsliderLG' );

	// Vérifier minimalement si bxslider existe.
	if (bxslider.length > 0) {
	    $( '.bxsliderLG li' ).fitVids();
	    $( '.bxsliderLG' ).bxSlider( {
		mode: 'fade',
		adaptiveHeight: true,
		video: true,
		nextText: WP_platform_shell_common_scripts_string.next,
		prevText: WP_platform_shell_common_scripts_string.previous

	    } );
	}
    }

    function init_other_misc_scripts() {

	if ( navigator.userAgent.indexOf( 'Mac' ) > 0 ) {
	    $( 'body' ).addClass( 'mac-os' );
	}

	// todo_eg : sert à quoi?
	$( "ol.commentlist a.comment-reply-link" ).each( function () {
	    $( this ).addClass( 'btn btn-success btn-mini' );
	    return true;
	} );

	// todo_eg : sert à quoi?
	$( '#cancel-comment-reply-link' ).each( function () {
	    $( this ).addClass( 'btn btn-danger btn-mini' );
	    return true;
	} );

	// Prevent submission of empty form
	// todo_eg : sert à quoi?
	$( '[placeholder]' ).parents( 'form' ).submit( function () {
	    $( this ).find( '[placeholder]' ).each( function () {
		var input = $( this );
		if ( input.val() === input.attr( 'placeholder' ) ) {
		    input.val( '' );
		}
	    } )
	} );
    }

    $( document ).ready( function () {
	init_menu_scripts();
	init_bx_slider_scripts();
	init_other_misc_scripts();
    } );

}( jQuery ) );