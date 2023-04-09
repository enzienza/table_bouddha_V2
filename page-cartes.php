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

<section class="container main-cartepage my-5">
    <ul class="nav nav-tabs">
        <?php
            wp_reset_postdata();

            $args = array(
                'post_type'      => 'cartes',
                'posts_per_page' => -1,
                'orderby'        => 'id',
                'order'          => 'ASC'
            );
            $my_query = new WP_query($args);
            if($my_query->have_posts()) : while($my_query->have_posts()) : $my_query->the_post();
        ?>
            <?php get_template_part('template-parts/post/nav-tabs'); ?>
        <?php endwhile; endif;  wp_reset_postdata(); ?>
    </ul><!--/.nav.nav-tabs-->

    <div class="tab-content">
        <div class="tab-pane fade show active">
            <p class="else-display">
                <?php echo get_option('msg_loop_cartepage') ?>
            </p>
        </div>
        <?php
        wp_reset_postdata();

        $args = array(
            'post_type'      => 'cartes',
            'posts_per_page' => -1,
            'orderby'        => 'id',
            'order'          => 'ASC'
        );
        $my_query = new WP_query($args);
        if($my_query->have_posts()) : while($my_query->have_posts()) : $my_query->the_post();
            ?>
            <?php get_template_part('template-parts/post/tab-content'); ?>
        <?php endwhile; endif;  wp_reset_postdata(); ?>

    </div><!--/.tab-content-->

</section><!--/.main-cartepage-->

<?php if(checked(1, get_option('show_on_cartepage'), false)) : ?>
    <!--  Section Reservation  -->
    <?php get_template_part('template-parts/action/reservation'); ?>
<?php endif; ?>

<?php get_footer(); ?>
