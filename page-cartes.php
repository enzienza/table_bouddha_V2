<?php
/**
 * Template Name: cartes
 *
 * The template for displaying for post-type cartes
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>


<?php get_header(); ?>

<!-- section banniere -->
<?php get_template_part('template-parts/page/carte/hero'); ?>

<!-- section title -->
<?php get_template_part('template-parts/page/carte/intro'); ?>

<!-- Section content -->
Il n'y a pas de carte actuellement

<?php if(checked(1, get_option('show_on_cartepage'), false)) : ?>
    <!--  Section Reservation  -->
    <?php get_template_part('template-parts/action/reservation'); ?>
<?php endif; ?>

<?php get_footer(); ?>
