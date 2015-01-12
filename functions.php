<?php

function wpt_register_theme_customizer( $wp_customize ) {
// Todos nuestros sections, settings, y controls se agregarán aquí
  //var_dump( $wp_customize );

  // Titulos personalizados para los settings por default de WordPress
  $wp_customize->get_section( 'title_tagline' )->title = __( 'Nombre del Sitio y Descripción', 'mytheme' );
  $wp_customize->get_control( 'blogname' )->label = __( 'Nombre del Sitio', 'mytheme' );
  $wp_customize->get_control( 'blogdescription' )->label = __( 'Descripción del Sitio', 'mytheme' );
  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

  // Personalizando títulos para configuración de página inicial
  $wp_customize->get_section( 'static_front_page' )->title = __( 'Preferencias de Página Inicial', 'mytheme' );
  $wp_customize->get_section( 'static_front_page' )->priority = 20;
  $wp_customize->get_control( 'show_on_front' )->label = __( 'Establece las preferencias de la página de inicio', 'mytheme' );
  $wp_customize->get_control( 'page_on_front' )->label = __( 'Página inicial', 'mytheme' );
  $wp_customize->get_control( 'page_for_posts' )->label = __( 'Página para listado de posts', 'mytheme' );

}
add_action( 'customize_register', 'wpt_register_theme_customizer' );

/**
 * Esto carga el archivo de javascript necesario para previsualzar los cambios sin regargar la página
 * Esto no es necesario hasta que los settings estén usando 'transport'=>'postMessage'
 * en lugar de 'transport'=>'refresh', la configuración por default.
 *
 * Used by hook: 'customize_preview_init'
 */
function mytheme_customizer_live_preview() {
  wp_enqueue_script(
    'my-theme-customizer', //Un id para el script
    get_template_directory_uri() . '/js/theme-customizer.js', //Ruta del archivo
    array( 'jquery', 'customize-preview' ), //Define dependencies
    '', //Define una version (opcional)
    true //Poner los scripts en el footer?
  );
}
add_action( 'customize_preview_init', 'mytheme_customizer_live_preview' );

// Cargar los estilos del tema
function wpt_theme_styles() {

  wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'wpt_theme_styles' );


