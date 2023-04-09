<?php
/**
 * Name File : Footer
 * Description : The template for displaying the footer
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>
<div class="footer-info">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-12 block-location">
        <h2><?php _e('Coordonnées', 'TableBouddha')?></h2>
          <?php get_template_part('template-parts/footer/contact-info'); ?>
      </div>

      <div class="col-md-4 col-12 block-link">
        <h2><?php _e('Liens utiles', 'TableBouddha')?></h2>
        <?php
          wp_nav_menu([
            'theme_location' => 'footer',
            'container'      => false,
            'menu_class'     => 'navbar-nav mr-auto'
          ]);
         ?>
      </div>

      <div class="col-md-4 col-12 block-timetable">
        <h2><?php _e('Horaires', 'TableBouddha')?></h2>
        <?php get_template_part('template-parts/footer/horaire'); ?>
      </div>
    </div>
  </div>
</div>


<a href="#" class="scrollTop">
  <span class="icons flaticon-up"></span>
</a><!-- /.scrollTop -->

<footer role="contentinfo">
  <?php bloginfo('name') ?>© 2020 - <?php echo date("Y"); ?> |
   Designed by <a href="http://enzawebdev.be" target="_blank">Enza Lombardo</a>
</footer>


<?php wp_footer(); ?>

</body>
</html>
