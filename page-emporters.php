<?php
/**
 * Template Name: emporters
 *
 * The template for displaying for post-type emporters
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>


<?php get_header(); ?>


<!-- section banniere -->
<?php get_template_part('template-parts/page/emportes/hero'); ?>

<!-- section title -->
<?php get_template_part('template-parts/page/emportes/intro'); ?>

<!-- Section content -->
Il n'y a pas de Boissons actuellement

<?php if(checked(1, get_option('show_on_takeawaypage'), false)) : ?>
    <!--  Section Reservation  -->
    <?php get_template_part('template-parts/action/reservation'); ?>
<?php endif; ?>

<?php get_footer(); ?>
