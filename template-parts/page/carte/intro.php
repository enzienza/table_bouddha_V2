<?php
/**
 * Name file:   intro
 * Description: display the template part intro for page-carte
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<?php if(checked(1, get_option('hidden_info_cartepage'), false)) : ?>
    <section class="info-page title-info container">
        <h1>
            <?php echo get_option('title_info_cartepage'); ?>
        </h1>
        <p class="flip">
            <span class="deg1"></span>
            <span class="deg2"></span>
            <span class="deg3"></span>
        </p>
    </section>
<?php else : ?>
    <section class="info-page container">
        <div class="row box-mobile">
            <div class="col-md-8 col-12">
                <h1>
                    <?php echo get_option('title_info_cartepage'); ?>
                </h1>
                <p class="flip">
                    <span class="deg1"></span>
                    <span class="deg2"></span>
                    <span class="deg3"></span>
                </p>
                <p class="info-text">
                    <?php echo get_option('text_info_cartepage'); ?>
                </p>
            </div>
            <div class="col-md-4 col-12 img-info invible">
                <img src="<?php echo get_option('image_info_cartepage') ?>"
                     class=""
                     alt=""
                />
            </div>
        </div>
    </section>
<?php endif; ?>