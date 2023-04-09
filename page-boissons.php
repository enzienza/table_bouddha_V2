<?php
/**
 * Template Name: boissons
 *
 * The template for displaying for post-type boissons
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<?php get_header(); ?>

<!-- section banniere -->
<?php get_template_part('template-parts/page/boissons/hero'); ?>

<!-- section title -->
<?php get_template_part('template-parts/page/boissons/intro'); ?>

<!-- Section content -->
Il n'y a pas de Boissons actuellement

<?php if(checked(1, get_option('show_on_drinkpage'), false)) : ?>
    <!--  Section Reservation  -->
    <?php get_template_part('template-parts/action/reservation'); ?>
<?php endif; ?>

<?php get_footer(); ?>
