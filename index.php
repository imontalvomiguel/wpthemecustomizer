<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div class="container">

    <div id="header">
      <?php if ( !empty( get_theme_mod( 'mytheme_logo' ) ) ) : ?>
      <img id="logo" src="<?php echo get_theme_mod( 'mytheme_logo' ); ?>" alt="image-logo">
      <?php endif; ?>

      <p class="site-title">
        <a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'title' ); ?></a>
      </p>

      <p class="site-description"><?php bloginfo( 'description' ); ?></p>

      <?php if ( !empty( get_header_image() ) ) : ?>
        <div id="banner">
          <img src="<?php header_image(); ?>" alt="Header Image">
        </div>
      <?php endif; ?>

      <?php wp_nav_menu( array( 'theme-location' => 'header-menu' ) ); ?>
    </div>

    <div id="maincontent">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <p><?php the_content(); ?></p>
      <?php endwhile; endif; ?>
    </div>

    <aside>
      <?php dynamic_sidebar( 'main_widget' ); ?>
      <?php dynamic_sidebar( 'secondary_widget' ); ?>
    </aside>

    <div id="footer">
    <?php if ( !empty( get_theme_mod( 'mytheme_footer_text' ) ) ) : ?>
      <p id="footer-text"><?php echo get_theme_mod( 'mytheme_footer_text' ); ?></p>
    <?php endif; ?>
    </div>

  </div>

  <?php wp_footer(); ?>
</body>
</html>
