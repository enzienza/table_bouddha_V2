<?php
/**
 * Template Name: evenements
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
<?php get_template_part('template-parts/page/evenement/hero'); ?>

<!-- section title -->
<?php get_template_part('template-parts/page/evenement/intro'); ?>

<!-- Section content -->
Il n'y a pas de événement actuellement

<?php if(checked(1, get_option('show_on_evenpage'), false)) : ?>
    <!--  Section Reservation  -->
    <?php get_template_part('template-parts/action/reservation'); ?>
<?php endif; ?>

<?php get_footer(); ?>
