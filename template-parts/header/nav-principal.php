<?php
/**
 * Name file:   Nav-Principal
 * Description: display the template part for principal Navigation
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<!-- Brand and toggle get grouped for better mobile display -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-example" aria-controls="navbar-example" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse justify-content-center" id="navbar-example">
    <?php
    /**
     * [navigation principal]
     */
    wp_nav_menu(array(
        'theme_location' => 'header',
        'depth' => 2,
        'container' => false,
        'menu_class'     => 'navbar-nav'
    ));
    ?>
</div>
</div>
