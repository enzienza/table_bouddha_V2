<?php
/**
 * Name File : 404
 * Description : The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<?php get_header(); ?>

<?php // template erreur 1 ----------------------- ?>
<?php if(checked(1, get_option('chose_theme1'), false)) : ?>
  <div class="my-5 container error">
    <div class="error-code">
      404
    </div>
    <h1 class="text-hightlight">
      <?php echo get_option('maintext_theme1'); ?>
    </h1>

    <div class="error-desc">
      <p>
        <?php echo get_option('message_theme1'); ?>
      </p>
      <div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php _e("Retour à la page d'accueil", 'TableBouddha'); ?>
        </a>
      </div>
    </div>
  </div>
<?php endif; ?>



<?php // template erreur 2 ----------------------- ?>
<?php if(checked(1, get_option('chose_theme2'), false)): ?>
  <div class="my-5 container error">
    <div class="jumbotron text-center">
      <div class="error-emoji">&#128549;</div>
      <h1 class="txt-large">
        404 <?php echo get_option('maintext_theme2'); ?>
      </h1>
      <p class="txt-small">
        <?php echo get_option('subtext_theme2'); ?>
      </p>
      <p class="txt-normal">
        <?php echo get_option('message_theme2'); ?>
      </p>
      <p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php _e("Retour à page l'accueil", 'TableBouddha'); ?>
        </a>
      </p>
    </div>
  </div>
<?php endif; ?>

<?php get_footer(); ?>
