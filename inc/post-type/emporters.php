<?php
/**
 * Name File : emporters
 * Description : File about the creation of post-type "emporters"
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

if(!function_exists(cpt_emporters)){
    function cpt_emporters(){

        /**
         * définir les options du label
         * @var array
         */
        $labels = array(
            'name'                => __('Emportés', 'TableBouddha'),
            'singular_name'       => __('Emporté', 'TableBouddha'),
            'menu_name'           => __('Emportés', 'TableBouddha'),
            'name_admin_bar'      => __('Emporté', 'TableBouddha'),
            'all_items'           => __('Tous les emportés', 'TableBouddha'),
            'add_new'             => __('Ajouter', 'TableBouddha'),
            'add_new_item'        => __('Ajouter un emporté', 'TableBouddha'),
            'new_item'            => __('Nouvel emporté', 'TableBouddha'),
            'edit_item'           => __('Modifier un emporté', 'TableBouddha'),
            'view_item'           => __('Voir l\'emporté', 'TableBouddha'),
            'view_items'          => __('Voir les emportés', 'TableBouddha'),
            'search_items'        => __('Rechercher parmi les emportés', 'TableBouddha'),
            'not_found'           => __('Ancun emporté trouvé', 'TableBouddha'),
            'not_fount_in_trash'  => __('Ancun emporté trouvé dans la corbeille', 'TableBouddha'),
            'filter_items_list'   => __('Filtrer la liste des emportés', 'TableBouddha'),
            'attributes'          => __('Attributs de l\'emporté', 'TableBouddha')
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
            'rewrite'             => $rewrite,
            'supports'            => $supports,
            'public'              => true,
            'hierarchical'      => false,               // Si PARENT / CHILD  passer en  TRUE
            'has_archive'         => true,              // TRUE archive-{$post-type}  | FALSE page-{$post-type}
            'show_in_rest'        => true,              //  TRUE = afficher editeur Gutemberg | FALSE = pas d'editeur Gutemberg
            'show_in_menu'        => true,
            'show_in_nav_menus' => false,
            'query_var'           => true,
            'capability_type'     => 'post',
            'menu_position'       => 7,
            'menu_icon'           => 'dashicons-products',
        );

        register_post_type('emporters', $args);
    }
}
add_action('init', 'cpt_emporters');
