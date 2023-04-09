<?php
/**
 * Name file:   Contact-info
 * Description: display the template part for informations general
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<div class="row block-logo">
    <div class="col-2">

        <img class="logo"
             src="<?php echo get_template_directory_uri().'/assets/img/logo-grey.png' ?>"
             alt=""
        />

    </div>
    <div class="col blog-address">
        <p class="title">
            <?php bloginfo('title'); ?>
        </p>
        <p class="address">
            <?php echo get_option('adresse') ?>
        </p>
        <p>
            <a  href="tel:<?php echo get_option('phone') ?>"><?php echo get_option('phone') ?></a>
        </p>

        <?php if(checked(1, get_option('yes_facebook'), false)) : ?>
            <a href="<?php echo(get_option('url_facebook')); ?>" target="_blank">
                <span class="icons flaticon-facebook"></span>
            </a>
        <?php endif ?>

        <?php if(checked(1, get_option('yes_instagram'), false)) : ?>
            <a href="<?php echo(get_option('url_instagram')); ?>" target="_blank">
                <span class="icons flaticon-instagram"></span>
            </a>
        <?php endif ?>

        <?php if(checked(1, get_option('yes_twitter'), false)) : ?>
            <a href="<?php echo(get_option('url_twitter')); ?>" target="_blank">
                <span class="icons flaticon-twitter"></span>
            </a>
        <?php endif ?>


    </div>
</div>