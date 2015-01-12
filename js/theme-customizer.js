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

})( jQuery );
