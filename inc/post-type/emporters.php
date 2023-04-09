<?php
/**
 * File about the creation of post-type "emporters"
 *
 * @package WordPress
 * @subpackage tablebouddha
 * @since 2.0
 */

function cpt_emporters(){

    /**
     * définir les options du label
     * @var array
     */
    $labels = array(
        'name'                => __('Emporters', 'emporters'),
        'singular_name'       => __('Emporter', 'emporters'),
        'menu_name'           => __('Emporter', 'emporters'),
        'name_admin_bar'      => __('Emporter', 'emporters'),
        'add_new'             => __('Ajouter', 'emporters'),
        'add_new_item'        => __('Ajouter une emporter', 'emporters'),
        'new_item'            => __('Nouveau emporter', 'emporters'),
        'edit_item'           => __('Editer une emporter', 'emporters'),
        'view_item'           => __('Voir la emporter', 'emporters'),
        'all_items'           => __('Toutes les emporters', 'emporters'),
        'search_items'        => __('Rechercher parmi les emporters', 'emporters'),
        'not_found'           => __('Pas de emporter trouvées', 'emporters'),
        'not_fount_in_trash'  => __('Pas de emporter dans la corbeille', 'emporters')
    );

    /**
     * définir les option de rewrite
     * @var array
     */
    $rewrite = array(
        'slug'          => 'emporters',
        // 'with_front'    => true,
        // 'hierarchical'  => false,
    );

    /**
     * définir les option de supports
     * @var array
     */
    $supports = array(
        'title',           // titre
        'editor',          // editeur
        // 'thumbnail',       // image à la une
        // 'author',       // auteur du post
        // 'excerpt',      // extrait
        // 'comments'      // commentaires autorisé
    );

    /**
     * définir les arguments du custom post type
     * @var array
     */
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'hierarchical'        => false,
        'has_archive'         => true,
        'show_in_rest'        => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-products',
        'capability_type'     => 'post',
        'rewrite'             => $rewrite,
        'supports'            => $supports,
    );

    register_post_type('emporters', $args);
}
add_action('init', 'cpt_emporters');
