<?php

function wpt_register_theme_customizer( $wp_customize ) {
// Todos nuestros sections, settings, y controls se agregarán aquí
  //var_dump( $wp_customize->settings() );

  // Titulos personalizados para los settings por default de WordPress (title_tagline)
  $wp_customize->get_section( 'title_tagline' )->title = __( 'Nombre del Sitio y Descripción', 'mytheme' );
  $wp_customize->get_control( 'blogname' )->label = __( 'Nombre del Sitio', 'mytheme' );
  $wp_customize->get_control( 'blogdescription' )->label = __( 'Descripción del Sitio', 'mytheme' );
  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

  // Personalizando títulos para configuración de página inicial (static_front_page)
  $wp_customize->get_section( 'static_front_page' )->title = __( 'Preferencias de Página Inicial', 'mytheme' );
  $wp_customize->get_section( 'static_front_page' )->priority = 20;
  $wp_customize->get_control( 'show_on_front' )->label = __( 'Establece las preferencias de la página de inicio', 'mytheme' );
  $wp_customize->get_control( 'page_on_front' )->label = __( 'Página inicial', 'mytheme' );
  $wp_customize->get_control( 'page_for_posts' )->label = __( 'Página para listado de posts', 'mytheme' );

  // Personalizando los títulos para la sección de background de WordPress (background_image)
  // WordPress sabe que esto debe ser aplicado a tu body, entonces sabe como hacerlo con javascript y usa transport=>'postMessage'
  $wp_customize->get_section( 'background_image' )->title = __( 'Fondo del tema' );
  $wp_customize->get_control( 'background_color' )->section = 'background_image';

  // Personalizando la sección custom-header (transport postMessage para header_textcolor)
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  // Personalizando la sección nav
  $wp_customize->get_section( 'nav' )->title = __( 'Opciones de Menu', 'mytheme' );

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

// Habilitar las configuraciones de background para un tema (secciones por default pero tenemos que habilitarlas)
$defaults = array(
  'default-color' => '#ecf0f1',
  'default-image' => get_template_directory_uri() . '/img/background.png'
);
add_theme_support( 'custom-background', $defaults );

// Habilitar la sección de header_image
$args = array(
  'default-image' => get_template_directory_uri() .'/img/header.png',
  'default-text-color' => '2c3e50',
  'header-text' => true,
  'uploads' => true,
  'wp-head-callback' => 'mytheme_style_header'
);
add_theme_support( 'custom-header', $args );

// Callback para actualizar los estilos del header
function mytheme_style_header() {
  $text_color = get_header_textcolor();
  ?>
  <style>
    #header .site-title a
    {
      color: #<?php echo esc_attr( $text_color ); ?>;
    }
    <?php if( display_header_text() != true ) : ?>
    .site-title
    {
      display: none;
    }
    <?php endif; ?>
  </style>
  <?php
}

// Registrando el menu de navegación
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );
