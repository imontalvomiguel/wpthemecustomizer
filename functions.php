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
  $wp_customize->get_control( 'header_textcolor' )->label = __( 'Color del texto en header', 'mytheme' );

  // Personalizando la sección nav
  $wp_customize->get_section( 'nav' )->title = __( 'Opciones de Menu', 'mytheme' );

  // Creando nuestros propios paneles (agrupando secciones)
  $wp_customize->add_panel( 'general_settings', array(
    'priority'       => 10,
    'theme_supports' => '',
    'title'          => __( 'Opciones generales del tema', 'mytheme' ),
    'description'    => __( 'Establece las configuraciones generales para el tema', 'mytheme' )
  ) );

  $wp_customize->add_panel( 'design_settings', array(
    'priority'       => 20,
    'theme_supports' => '',
    'title'          => __( 'Opciones de diseño del tema', 'mytheme' ),
    'description'    => __( 'Establece las configuraciones de diseño para el tema', 'mytheme' )
  ) );

  // Asignando secciones a nuestros paneles personalizados.
  $wp_customize->get_section( 'title_tagline' )->panel = 'general_settings';
  $wp_customize->get_section( 'nav' )->panel = 'general_settings';
  $wp_customize->get_section( 'static_front_page' )->panel = 'general_settings';

  $wp_customize->get_section( 'header_image' )->panel = 'design_settings';
  $wp_customize->get_section( 'colors' )->panel = 'design_settings';
  $wp_customize->get_section( 'background_image' )->panel = 'design_settings';

  // Creando una nueva sección (custom_logo)
  $wp_customize->add_section( 'custom_logo', array(
    'title' => __( 'Cambiar logotipo', 'mytheme' ),
    'panel' => 'design_settings',
    'priority' => 30
  ) );

  // Creando un nuevo setting (mytheme_logo)
  $wp_customize->add_setting( 'mytheme_logo', array(
    'default' => get_template_directory_uri() . '/img/logo.png',
    'transport' => 'postMessage'
  ) );

  // Creando el control (para mytheme_logo)
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mytheme_logo', array(
    'label' => __( 'Cambiar el logo', 'mytheme' ),
    'section' => 'custom_logo',
    'settings' => 'mytheme_logo',
    'context' => 'mytheme_custom_logo'
  ) ) );

  // Creando una nueva sección para custom_footer_text
  $wp_customize->add_section( 'custom_footer_text', array(
    'title' => __( 'Cambiar el texto del footer', 'mytheme' ),
    'panel' => 'general_settings',
    'prioritiy' => 1000
  ) );

  // Agregando el setting text_footer
  $wp_customize->add_setting( 'mytheme_footer_text', array(
    'default' => __( 'Cambiar el texto del footer', 'mytheme' ),
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_text'
  ) );

  // Agregando el control para text_footer
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'mytheme_footer_text', array(
    'label' => __( 'Texto para footer', 'mytheme' ),
    'section' => 'custom_footer_text',
    'settings' => 'mytheme_footer_text',
    'type' => 'text'
  ) ) );

  // Agregando sección para estílos de h1
  $wp_customize->add_section( 'h1_styles', array(
    'title' => __( 'Cambiar estilos de los títulos h1', 'mytheme' ),
    'panel' => 'design_settings',
    'priority' => 100
  ) );

  // Setting para el color de h1
  $wp_customize->add_setting( 'mytheme_h1_color', array(
    'default' => '#2980b9',
    'transport' => 'postMessage'
  ) );

  // Control para el color de setting h1
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mytheme_h1_color', array(
    'label' => __( 'Color para los h1', 'mytheme'),
    'section' => 'h1_styles',
    'settigs' => 'mytheme_h1_color',
  ) ) );

  // Setting para el font-size de h1
  $wp_customize->add_setting( 'mytheme_h1_fontsize', array(
    'default' => '24px',
    'transport' => 'postMessage'
  ) );

  // Control para setting font-size
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'mytheme_h1_fontsize', array(
    'label' => __( 'Tamaño de fuente para los h1', 'mytheme'),
    'section' => 'h1_styles',
    'settings' => 'mytheme_h1_fontsize',
    'type' => 'select',
    'choices' => array(
      '18' => '18px',
      '22' => '22px',
      '24' => '24px',
      '32' => '32px'
    ),
  ) ) );

  // Sección para css personalizados
  $wp_customize->add_section( 'custom_css', array(
    'title' => __( 'Escribe tus propio CSS', 'mytheme'),
    'panel' => 'design_settings',
    'priority' => 2000
  ) );

  // Setting para el css personalizado
  $wp_customize->add_setting( 'mytheme_own_css', array(
    'sanitize_callback' => 'sanitize_text_area'
  ) );

  // Control para css personalizado
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'mytheme_own_css', array(
    'label' => __( 'Aquí escribes tu css personalizado', 'mytheme' ),
    'section' => 'custom_css',
    'settings' => 'mytheme_own_css',
    'type' => 'textarea'
  ) ) );
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
    .site-title, .site-description
    {
      display: none;
    }
    <?php endif; ?>
    h1 a
    {
      color: <?php echo get_theme_mod( 'mytheme_h1_color' ); ?>;
      font-size: <?php echo get_theme_mod( 'mytheme_h1_fontsize' ); ?>px;
    }

    <?php if ( !empty( get_theme_mod( 'mytheme_own_css' ) ) ) : ?>
    <?php echo get_theme_mod( 'mytheme_own_css' ); ?>
    <?php endif; ?>

  </style>
  <?php
}

// Registrando el menu de navegación
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

// Agreando áres de widgets a nuestro tema
function wpt_create_widget( $name, $id, $description ) {

  register_sidebar(array(
    'name' => __( $name ),
    'id' => $id,
    'description' => __( $description ),
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

}
wpt_create_widget( 'Main Widget', 'main_widget', 'For testing purposes' );
wpt_create_widget( 'Secondary Widget', 'secondary_widget', 'Also for testing purposes' );

// Sanitize a string from user input or from the db (solo guardar texto simple no código en la db)
function sanitize_text( $text ) {
  return sanitize_text_field( $text );
}

function sanitize_text_area( $text ) {
  return esc_textarea( $text );
}
