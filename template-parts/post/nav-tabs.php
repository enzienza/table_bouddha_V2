<?php
/**
 * Name File : Nav-Tabs
 * Description Loads 'nav-tabs' template-parts on pages
 * Included : page-cartes | page-boissons | page-emporters
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>


<li class="nav-item">
    <a
        class="nav-link"
        id="tab-<?php $title = sanitize_title(get_the_title()); echo $title;?>"
        data-toggle="tab"
        href="#<?php $title = sanitize_title(get_the_title()); echo $title;?>"
        role="tab"
        aria-controls="<?php $title = sanitize_title(get_the_title()); echo $title;?>"
        aria-selected="true"
    >
        <p class="item-icon">
            <i class="icons <?php echo get_post_meta(get_the_ID(), MB_use_faticons::META_KEY, true); ?>"></i>
        </p>
        <p class="item-name">
            <?php the_title(); ?>
        </p>
    </a>
</li>
