<?php
/**
 * Template Name: default
 *
 * description: The page template to display all pages
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<?php get_header(); ?>

<!-- section banniere -->
<?php get_template_part('template-parts/page/default/hero'); ?>

<!-- section title -->
<?php get_template_part('template-parts/page/default/intro'); ?>

<!-- Section content -->
<section class="default">
    <div class="container">
        <?php if(have_posts()) : while(have_posts()) : the_post();?>
            <div class="row">
                <div class="col-12"><?php the_content(); ?></div>
            </div><!--//row-->
        <?php endwhile; else: ?>
            <div class="row">
                <div class="col-12">
                    <?php _e("Désolé, il n'y a pas d'articles", 'TableBouddha') ?>
                </div>
            </div><!--//row-->
        <?php endif; ?>
    </div><!--//container-->
</section>

<?php if(checked(1, get_option('show_on_defaultpage'), false)) : ?>
    <!--  Section Reservation  -->
    <?php get_template_part('template-parts/action/reservation'); ?>
<?php endif; ?>


<?php get_footer(); ?>