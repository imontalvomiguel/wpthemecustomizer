/**
 * Este archivo hace los cambios en sin recargar la página de Theme customizer
 * para llamarlo, establece el transport de los settings a 'postMessage'.
 * Tu código de javascript debería tomar los controles de tus settings y
 * hacer los cambios necesarios utilizando jQuery.
 */
(function( $ ) {

  wp.customize( 'blogname', function( value ) {
    value.bind( function( to ) {
      $( '.site-title a' ).text( to );
    } );
  } );

  wp.customize( 'blogdescription', function( value ) {
    value.bind( function( to ) {
      $( '.site-description' ).text( to );
    } );
  } );

  wp.customize( 'header_textcolor', function( value ) {
    value.bind( function( to ) {
      if (to === 'blank') {
        $( '.site-title, .site-description' ).css( {
          'display': 'none'
        } );
      } else {
        $( '.site-title, .site-description' ).css( {
          'display': 'block'
        } );

        $( '.site-title a' ).css( {
          'color': to
        } );
      }
    } );
  } );

  wp.customize( 'mytheme_logo', function( value ) {
    value.bind( function( to ) {
      if( to == '') {
        $( '#logo' ).hide();
      } else {
        $( '#logo' ).show();
        $( '#logo' ).attr( 'src', to );
      }
    } );
  } );

  wp.customize( 'mytheme_footer_text', function( value ) {
    value.bind( function( to ) {
      if ( to ) {
        $( '#footer-text' ).text( to ).show();
      } else {
        $( '#footer-text' ).hide();
      }
    } );
  } );

})( jQuery );
