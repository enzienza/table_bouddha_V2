<?php
/**
 * Name file: Flaticons
 * Description : file who adds a metabox to use flaticons class
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

/* ---------------------------------------------------------
>>>  TABLE OF CONTENTS:
------------------------------------------------------------

1 - DEFINIR LES VALEURS (repeter)
2 - DEFINIR LES HOOKS ACTIONS
3 - CONSTRUCTION DE LA METABOX
4 - DEFENIR LA METABOX (template & champs)
5 - SAUVEGARDER LES DONNEES DE LA METABOX

----------------------------------------------------------*/

class MB_use_faticons{
    /**
     *1 - DEFINIR LES VALEURS (repeter)
     */
    const META_KEY = 'icon_flaticon';
    const NONCE    = '_icon_flaticon';
    const SCREEN = array('cartes', 'boissons', 'emporters');

    // define('CREEN',['carte']);


    /**
     *2 - DEFINIR LES HOOKS ACTIONS
     */
    public static function register(){
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        add_action('save_post', [self::class, 'save']);
    }

    /**
     *3 - CONSTRUCTION DE LA METABOX
     */
    public static function add($postType, $POST){
        if ( current_user_can('publish_posts', $POST)) {
            add_meta_box(
                self::META_KEY,             // ID_META_BOX
                __('Flaticon', 'TableBouddha'),             // TITLE_META_BOX
                [self::class, 'render'],    // CALLBACK
                self::SCREEN,               // WP_SCREEN
                'side',                     // CONTEXT [ normal | advanced | side ]
                'high'                      // PRIORITY [ high | default | low ]
            );
        }
    }

    /**
     *4 - DEFENIR LA METABOX (template & champs)
     */
    public static function render($POST){
        wp_nonce_field(self::NONCE, self::NONCE);
        $chose_icon = get_post_meta($POST->ID, self::META_KEY, true);
        ?>
        <div class="components-base-control__field">
        <p>
            <a href="<?php echo get_template_directory_uri().'/assets/fonts/flaticon/flaticon.html' ?>"
               target="_blank"
            >
                <?php _e('Voir la liste des icons', 'TableBouddha'); ?>
            </a>
        </p>
        <label for="<?php echo self::META_KEY ?>">
            <?php _e('Ajouter la class','TableBouddha'); ?>
        </label>
        <input class="widefat"
               style="margin:.6em 0;"
               type="text"
               name="<?php echo self::META_KEY ?>"
               value="<?php echo $chose_icon ?>"
               placeholder="flaticon-meat"
        />
        <?php
    }

    /**
     *5 - SAUVEGARDER LES DONNEES DE LA METABOX
     */
    public static function save($POST_ID){
        if(current_user_can('publish_posts', $POST_ID)){
            if(isset($_POST[self::META_KEY])){
                if($_POST[self::META_KEY] === ''){
                    delete_post_meta($POST_ID, self::META_KEY, $_POST[self::META_KEY]);
                } else{
                    update_post_meta($POST_ID, self::META_KEY, $_POST[self::META_KEY]);
                }
            }
        }
    }
}

if(class_exists('MB_use_faticons')){
    MB_use_faticons::register();
}