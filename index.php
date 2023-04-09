<?php
/**
 * Name file : Index
 * Description : The main template file
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */


?>


<?php get_header(); ?>



<div class="hero" style="background-image: url(<?php echo get_option('img_hero') ?>)">
  <div class="jumbtitle">
    <img src="<?php echo get_option('img_logo') ?>" class="logo" alt="">
    <h1><?php bloginfo('title'); ?></h1>
  </div>
</div>


<?php get_footer(); ?>
