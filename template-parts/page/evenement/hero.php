<?php
/**
 * Name file:   hero
 * Description: display the template part hero for page-event
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<?php if(checked(1, get_option('yes_hero_eventpage'), false)) : ?>
    <section class="hero" style="background-image: url(<?php echo get_option('add_hero_eventpage') ?>)">
        <div class="filter">
            <?php if(checked(1, get_option('yex_message_eventpage'), false)){ ?>
                <div class="jumb-message container">
                    <h1 class="msg-title">
                        <?php echo get_option('title_hero_eventpage'); ?>
                    </h1>
                    <p class="msg-text">
                        <?php echo get_option('text_hero_eventpage'); ?>
                    </p>
                </div>
            <?php } else { ?>
                <?php
                if(
                    (checked(1, get_option('view_logo_eventpage'), false)) &&
                    (checked(1, get_option('view_namesite_eventpage'), false))
                ){
                    ?>
                    <div class="jumb-hero">
                        <img src="<?php echo get_option('img_logo') ?>"
                             class="logo"
                             alt="<?php bloginfo('title'); ?>"
                        />
                        <h1>
                            <?php bloginfo('title'); ?>
                        </h1>
                    </div>
                <?php } elseif(checked(1, get_option('view_logo_eventpage'), false)){ ?>
                    <div class="jumb-hero">
                        <img src="<?php echo get_option('img_logo') ?>"
                             class="logo logo-center"
                             alt="<?php bloginfo('title'); ?>"
                        />
                    </div>
                <?php } elseif(checked(1, get_option('view_namesite_eventpage'), false)){ ?>
                    <div class="jumb-hero">
                        <h1>
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
