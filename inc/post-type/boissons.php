<?php
/**
 * Name File : Boissons
 * Description : File about the creation of post-type "boissons"
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

if(!function_exists(cpt_boissons)){
    function cpt_boissons(){

        /**
         * définir les options du label
         * @var array
         */
        $labels = array(
            'name'                => __('Boissons', 'TableBouddha'),
            'singular_name'       => __('Boisson', 'TableBouddha'),
            'menu_name'           => __('Boissons', 'TableBouddha'),
            'name_admin_bar'      => __('Boisson', 'TableBouddha'),
            'all_items'           => __('Toutes les boissons', 'TableBouddha'),
            'add_new'             => __('Ajouter', 'TableBouddha'),
            'add_new_item'        => __('Ajouter une boisson', 'TableBouddha'),
            'new_item'            => __('Nouvelle boisson', 'TableBouddha'),
            'edit_item'           => __('Modifier une boisson', 'TableBouddha'),
            'view_item'           => __('Voir la boisson', 'TableBouddha'),
            'view_items'          => __('Voir les boissons', 'TableBouddha'),
            'search_items'        => __('Rechercher parmi les boissons', 'TableBouddha'),
            'not_found'           => __('Aucune boisson trouvée', 'TableBouddha'),
            'not_fount_in_trash'  => __('Aucune boisson trouvée dans la corbeille', 'TableBouddha'),
            'filter_items_list'   => __('Filtrer la liste des boissons', 'TableBouddha'),
            'attributes'          => __('Attributs de la boisson', 'TableBouddha')
        );

        /**
         * définir les option de rewrite
         * @var array
         */
        $rewrite = array(
            'slug'          => 'boissons',
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
            //'thumbnail',       // image à la une
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
            'hierarchical'        => false,             // Si PARENT / CHILD  passer en  TRUE
            'has_archive'         => true,              // TRUE archive-{$post-type}  | FALSE page-{$post-type}
            'show_in_rest'        => true,              //  TRUE = afficher editeur Gutemberg | FALSE = pas d'editeur Gutemberg
            'show_in_menu'        => true,
            'query_var'           => true,
            'show_in_nav_menus'   => false,
            'capability_type'     => 'post',
            'menu_position'       => 6,
            'menu_icon'           => 'dashicons-tickets-alt',
        );

        register_post_type('boissons', $args);
    }
}
add_action('init', 'cpt_boissons');
