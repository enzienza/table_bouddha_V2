<?php
/**
 * Name file:   hero
 * Description: display the template part hero for page-boisson
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<?php if(checked(1, get_option('yes_hero_drinkpage'), false)): ?>
    <section class="hero" style="background-image: url(<?php echo get_option('add_hero_drinkpage') ?>)">
        <div class="filter">
            <?php if(checked(1, get_option('yex_message_drinkpage'), false)){ ?>
                <div class="jumb-message container">
                    <h1 class="msg-title">
                        <?php echo get_option('title_hero_drinkpage'); ?>
                    </h1>
                    <p class="msg-text">
                        <?php echo get_option('text_hero_drinkpage'); ?>
                    </p>
                </div>
            <?php } else { ?>
                <?php
                if(
                    (checked(1, get_option('view_logo_drinkpage'), false)) &&
                    (checked(1, get_option('view_namesite_drinkpage'), false))
                ){
                    ?>
                    <div class="jumb-hero">
                        <img src="<?php echo get_option('img_logo') ?>"
                             class="logo"
                             alt="<?php bloginfo('title') ?>"
                        />
                        <h1>
                            <?php bloginfo('title'); ?>
                        </h1>
                    </div>
                <?php } elseif(checked(1, get_option('view_logo_drinkpage'), false)){ ?>
                    <div class="jumb-hero">
                        <img src="<?php echo get_option('img_logo') ?>"
                             class="logo logo-center"
                             alt="<?php bloginfo('title') ?>"
                        />
                    </div>
                <?php } elseif(checked(1, get_option('view_namesite_drinkpage'), false)){ ?>
                    <div class="jumb-hero">
                        <h1 class="title-center">
                            <?php bloginfo('title'); ?>
                        </h1>
                    </div>
                <?php } ?>



            <?php } ?>
        </div>
    </section>

<?php else : ?>
    <section class="hero" style="background-image: url()">
        <div class="filter">
            <div class="jumb-hero">
                <img src="<?php echo get_option('img_logo') ?>"
                     class="logo"
                     alt="<?php bloginfo('title'); ?>"
                />
                <h1>
                    <?php bloginfo('title'); ?>
                </h1>
            </div>
        </div>
    </section>
<?php endif; ?>
