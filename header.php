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

        <?php get_template_part('template-parts/header/nav-principal'); ?>
    </nav>
  </div><!-- /.header -->
