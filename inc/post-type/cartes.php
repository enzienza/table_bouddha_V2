<?php
/**
 * Name File : Carte
 * Decription : File about the creation of post-type "cartes"
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

if(!function_exists('cpt_cartes')){
    function cpt_cartes(){

        /**
         * définir les options du label
         * @var array
         */
        $labels = array(
            'name'                => __('Cartes', 'TableBouddha'),
            'singular_name'       => __('Carte', 'TableBouddha'),
            'menu_name'           => __('Cartes', 'TableBouddha'),
            'name_admin_bar'      => __('Carte', 'TableBouddha'),
            'all_items'           => __('Toutes les cartes', 'TableBouddha'),
            'add_new'             => __('Ajouter', 'TableBouddha'),
            'add_new_item'        => __('Ajouter une carte', 'TableBouddha'),
            'new_item'            => __('Nouvelle carte', 'TableBouddha'),
            'edit_item'           => __('Modifier une carte', 'TableBouddha'),
            'view_item'           => __('Voir la carte', 'TableBouddha'),
            'view_items'          => __('Voir les cartes', 'TableBouddha'),
            'search_items'        => __('Rechercher parmi les cartes', 'TableBouddha'),
            'not_found'           => __('Aucune carte trouvée', 'TableBouddha'),
            'not_fount_in_trash'  => __('Aucune carte trouvée dans la corbeille', 'TableBouddha'),
            'filter_items_list'   => __('Filtrer la liste des cartes', 'TableBouddha'),
            'attributes'          => __('Attributs de la carte', 'TableBouddha')
        );

        /**
         * définir les option de rewrite
         * @var array
         */
        $rewrite = array(
            'slug'          => 'cartes',
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
            //'thumbnail',        // image à la une
            // 'author',          // auteur du post
            // 'excerpt',         // extrait
            // 'comments'         // commentaires autorisé
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
            'hierarchical'        => false,             // Si PARENT / CHILD  passer en  TRUE
            'has_archive'         => true,              // TRUE archive-{$post-type}  | FALSE page-{$post-type}
            'show_in_rest'        => true,              //  TRUE = afficher editeur Gutemberg | FALSE = pas d'editeur Gutemberg
            'show_in_menu'        => true,
            'query_var'           => true,
            'show_in_nav_menus'   => false,
            'capability_type'     => 'post',
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-images-alt',
        );

        register_post_type('cartes', $args);
    }
}
add_action('init', 'cpt_cartes');
