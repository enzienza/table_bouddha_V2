<?php
/**
 * Name File : header
 * Description : The template for displaying the header
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
  <meta <?php bloginfo('charset'); ?>>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="author" content="Enza LOMBARDO">

  <title><?php bloginfo('title'); ?></title>
  <?php wp_head(); ?>
</head>
<body>
  <div class="header" role="banner">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
      <div class="container">

        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <!-- Table Bouddha -->
          <?php bloginfo('title') ?>
          <!-- <img src="" alt=""> -->
        </a>

        <!-- Brand and toggle get grouped for better mobile display -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-example" aria-controls="navbar-example" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse justify-content-center" id="navbar-example">
          <?php
            /**
             * [navigation principal]
             */
            wp_nav_menu(array(
              'theme_location' => 'header',
              'depth' => 2,
              'container' => false,
              'menu_class'     => 'navbar-nav'
            ));
          ?>
        </div>
      </div>
    </nav>
  </div><!-- /.header -->
