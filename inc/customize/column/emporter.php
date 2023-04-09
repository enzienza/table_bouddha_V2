<?php
/**
 * Name file: emporter
 * Description: File for customize the administration | columns of Custom Post-Types
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

/* Etape 1 : ajouter les colonnes */
add_filter(
    'manage_emporters_posts_columns',
    function($columns){
        // var_dump($columns);
        return[
            'cb'    => '<input type="checkbox" />',
            'icon'  => 'Icône',
            'title' => $columns['title'],
            'date'  => $columns['date']
        ];
    }
);

/* Etape 2 : afficher le contenu souhaiter */
add_filter(
    'manage_emporters_posts_custom_column',
    function($column, $postId){
        if ($column === 'icon'){
            if(!empty(get_post_meta($postId, MB_use_faticons::META_KEY, true))){
                ?>
                <p>
                    <i class="icon <?php echo get_post_meta(get_the_ID(), MB_use_faticons::META_KEY, true); ?>">
                    </i>
                </p>
                <?php
            } else {
                echo "";
            }
        }
    },
    10,
    2
);