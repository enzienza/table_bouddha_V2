<?php
/**
 * Name File : takeawaypage
 * Description :File about gestion of dispay of page 'custom-takeawaypage'
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

/* ---------------------------------------------------------
>>>  TABLE OF CONTENTS:
------------------------------------------------------------
  1 - DEFINIR LES ELEMENTS (repeter)
  2 - DEFINIR LES HOOKS ACTIONS
  3 - CONSTRUCTION DE LA PAGE
  4 - TEMPLATE DES PAGES
  5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
  6 - DEFINIR LES SECTIONS DE LA PAGE
  7 - DEFINIR LE TELECHARGEMENT DES FICHIER
  8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
  9 - AJOUT STYLE & SCRIPT
----------------------------------------------------------*/

class tablebouddha_custom_takeawaypage{
    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     */
    const PERMITION   = 'manage_options';
    const SUB_GROUP  = 'custom_takeawaypage';
    const NONCE       = '_custom_takeawaypage';

    // definit les section
    // definit les section
    const SECTION_HERO    = 'section_hero_takeawaypage';
    const SECTION_INFO    = 'section_info_takeawaypage';
    const SECTION_LOOP = 'section_loop_takeawaypage';



    /**
     * 2 - DEFINIR LES HOOKS ACTIONS
     */
    public static function register(){
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
        //add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    /**
     * 3 - CONSTRUCTION DE LA PAGE
     */
    public static function addMenu(){
        add_submenu_page(
            tablebouddha_customtheme::GROUP,     // slug parent
            __('Page emportés', 'TableBouddha'),                    // page_title
            __('Page emportés', 'TableBouddha'),                     // menu_title
            self::PERMITION,                     // capability
            self::SUB_GROUP,                    // slug_menu
            [self::class, 'render']              // CALLBACK
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e('Gestion de la page des emportés', 'TableBouddha'); ?></h1>
            <p class="description">
                <?php _e("Sur cette page vous pouvez gérer l'affichage général de la page des emportés", 'TableBouddha') ?>
            </p>
            <?php settings_errors(); ?>
        </div>

        <div class="action">
            <input id="reset_form_general" type="reset" value="<?php _e('Effacer le formulaire', 'TableBouddha'); ?>" class="btn-clear" />
            <small><?php _e('Attention action définitive (suppression de la base de données)', 'TableBouddha'); ?></small>
            <script>
              jQuery( function( $ ) {
                $( '#reset_form_general' ).on( 'click', function( e ) {
                  e.preventDefault();
                  $( 'input[type="text"], textarea' ).val( '' ); // Clear input values
                  $( 'input[type="radio"],input[type="checkbox"]' ).prop( 'checked', false ); // Uncheck radio, checkbox
                } );
              } );
            </script>
        </div>

        <form class="myoptions" action="options.php" method="post" enctype="multipart/form-data">
            <?php
            wp_nonce_field(self::NONCE, self::NONCE);
            settings_fields(self::SUB_GROUP);
            do_settings_sections(self::SUB_GROUP);
            ?>
            <?php submit_button(); ?>
        </form>
        <?php
    }

    /**
     * 5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
     */
    public static function registerSettings(){
        /**
         * SECTION 1 : SECTION_HERO =======================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_HERO,                      // SLUG_SECTION
            __('Section Hero'),                          //, 'TableBouddha' TITLE
            [self::class, 'display_section_hero'],   // CALLBACK
            self::SUB_GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_takeawaypage',                             // SLUG_FIELD
            __('Image d\'arrière plan', 'TableBouddha'),                      // LABEL
            [self::class,'field_hero_takeawaypage'],         // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_HERO
        );
        add_settings_field(
            'element_takeawaypage',                          // SLUG_FIELD
            __('Ce qui doit être présent', 'TableBouddha'),                   // LABEL
            [self::class,'field_element_takeawaypage'],      // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_HERO
        );
        add_settings_field(
            'message_hero_takeawaypage',                     // SLUG_FIELD
            __('Gestion d\'un message', 'TableBouddha'),                   // LABEL
            [self::class,'field_message_hero_takeawaypage'], // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_HERO
        );

        // 3. Sauvegarder les champs
        /* hero section */
        register_setting(self::SUB_GROUP, 'yes_hero_takeawaypage');
        register_setting(self::SUB_GROUP,'add_hero_takeawaypage',[self::class, 'handle_file_hero_takeawaypage']);
        /* element view on hero */
        register_setting(self::SUB_GROUP, 'view_logo_takeawaypage');
        register_setting(self::SUB_GROUP, 'view_namesite_takeawaypage');
        register_setting(self::SUB_GROUP, 'yex_message_takeawaypage');
        register_setting(self::SUB_GROUP, 'text_hero_takeawaypage');


        /**
         * SECTION 2 : SECTION_INFO =======================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_INFO,                           // SLUG_SECTION
            __('Section info', 'TableBouddha'),                               // TITLE
            [self::class, 'display_section_description'], // CALLBACK
            self::SUB_GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hidden_info_takeawaypage',                      // SLUG_FIELD
            __('Cacher la section', 'TableBouddha'),                          // LABEL
            [self::class,'field_hidden_info_takeawaypage'],  // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );
        add_settings_field(
            'title_takeawaypage',                            // SLUG_FIELD
            __('Ajouter un titre', 'TableBouddha'),                           // LABEL
            [self::class,'field_title_takeawaypage'],        // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );
        add_settings_field(
            'description_takeawaypage',                      // SLUG_FIELD
            __('Ajouter une description', 'TableBouddha'),                    // LABEL
            [self::class,'field_description_takeawaypage'],  // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );
        add_settings_field(
            'image_takeawaypage',                            // SLUG_FIELD
            __('Ajouter une image', 'TableBouddha'),                          // LABEL
            [self::class,'field_image_takeawaypage'],        // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'hidden_info_takeawaypage');
        register_setting(self::SUB_GROUP, 'title_info_takeawaypage');
        register_setting(self::SUB_GROUP, 'text_info_takeawaypage');
        register_setting( self::SUB_GROUP, 'image_info_takeawaypage', [self::class, 'handle_file_info_takeawaypage'] );


        /**
         * SECTION 3 : SECTION_LOOP =======================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_LOOP,                      // SLUG_SECTION
            __('Message', 'TableBouddha'),                      // TITLE
            [self::class, 'display_section_loop'],   // CALLBACK
            self::SUB_GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'msg_loop_takeawaypage',                     // SLUG_FIELD
            __('Gestion du message', 'TableBouddha'),                            // LABEL
            [self::class,'field_msg_loop_takeawaypage'], // CALLBACK
            self::SUB_GROUP ,                              // SLUG_PAGE
            self::SECTION_LOOP
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'msg_loop_takeawaypage');
    }


    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_HERO =======================================
    public static function display_section_hero(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie est dédié à la gestion de la bannière de la page", 'TableBouddha'); ?>
        </p>
        <?php
    }

    // SECTION 2 : SECTION_INFO =======================================
    public static function display_section_description(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie est dédié à la gestion du titre ainsi qu'une description de la page ", 'TableBouddha'); ?>
        </p>
        <?php
    }

    // SECTION 3 : SECTION_LOOP =======================================
    public static function display_section_loop(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie est dédié à la gestion du message au lancement du tableau", 'TableBouddha'); ?>
        </p>
        <?php
    }


    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     */
    // SECTION 1 : SECTION_HERO =======================================
    public static function handle_file_hero_takeawaypage($options){
        if(!empty($_FILES['add_hero_takeawaypage']['tmp_name'])){
            $urls = wp_handle_upload($_FILES['add_hero_takeawaypage'], array('test_form' => FALSE));
            $temp = $urls['url'];
            return $temp;
        } // end -> if(!empty($_FILES['add_hero_takeawaypage']['tmp_name']))

        //no upload. old file url is the new value.
        return get_option('add_hero_takeawaypage');
    }

    // SECTION 2 : SECTION_INFO =======================================
    public static function handle_file_info_takeawaypage($options){
        if(!empty($_FILES['image_info_takeawaypage']['tmp_name'])){
            $urls = wp_handle_upload($_FILES['image_info_takeawaypage'], array('test_form' => FALSE));
            $temp = $urls['url'];
            return $temp;
        } // end -> if(!empty($_FILES['image_info_takeawaypage']['tmp_name']))

        //no upload. old file url is the new value.
        return get_option('image_info_takeawaypage');
    }


    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_HERO =======================================
    public static function field_hero_takeawaypage(){
        $yes_hero_takeawaypage = esc_attr(get_option('yes_hero_takeawaypage'));
        ?>
        <div>
            <p class="description"><?php _e("Remarque : Si vous n'ajoutez pas image, il prendra le font d'écran par défaut", 'TableBouddha'); ?></p>
            <input type="hidden" name="yes_hero_takeawaypage" value="0" />
            <input type="checkbox" id="yes_hero_takeawaypage" name="yes_hero_takeawaypage" value="1" <?php checked(1, $yes_hero_takeawaypage, true) ?> />
            <label for="" class="info"><?php _e("Ajouter l'image comme d'arrière plan", 'TableBouddha')?></label>
        </div>
        <div class="height-space">
            <input type="file" id="add_hero_takeawaypage" name="add_hero_takeawaypage" value="<?php echo get_option('add_hero_takeawaypage'); ?>" />
        </div>
        <div>
            <img src="<?php echo get_option('add_hero_takeawaypage'); ?>"class="img-hero"alt=""/>
        </div>
        <?php
    }

    public static function field_element_takeawaypage(){
        $view_logo_takeawaypage     = esc_attr(get_option('view_logo_takeawaypage'));
        $view_namesite_takeawaypage = esc_attr(get_option('view_namesite_takeawaypage'));
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent sur l'image (par-dessus)", 'TableBouddha')?></p>
        <p>
            <input type="hidden" name="view_logo_takeawaypage" value="0" />
            <input type="checkbox" id="view_logo_takeawaypage" name="view_logo_takeawaypage" value="1" <?php checked(1, $view_logo_takeawaypage, true) ?> />
            <label for=""><?php _e("Ajouter le logo", 'TableBouddha') ?></label>span>Ajouter le logo</span>
        </p>
        <p>
            <input type="hidden" name="view_namesite_takeawaypage" value="0" />
            <input type="checkbox" id="view_namesite_takeawaypage" name="view_namesite_takeawaypage" value="1" <?php checked(1, $view_namesite_takeawaypage, true) ?> />
            <label for=""><?php _e('Ajouter le nom du site', 'TableBouddha')?></label>
        </p>
        <?php
    }

    public static function field_message_hero_takeawaypage(){
        $yex_message_takeawaypage = esc_attr(get_option('yex_message_takeawaypage'));
        $text_hero_takeawaypage = esc_attr(get_option('text_hero_takeawaypage'));
        ?>
        <p class="description"><?php _e("Ajouter un message par-dessus l'image d'arrière plan ", 'TableBouddha')?></p>
        <div class="height-space">
            <input type="hidden" name="yex_message_takeawaypage" value="0" />
            <input type="checkbox" id="yex_message_takeawaypage" name="yex_message_takeawaypage" value="1" <?php checked(1, $yex_message_takeawaypage, true) ?> />
            <label for=""><?php _e('Afficher le texte souhaiter', 'TableBouddha')?></label>
            <textarea name="text_hero_takeawaypage" id="text_hero_takeawaypage" class="large-text code"><?php echo $text_hero_takeawaypage ?></textarea>
        </div>
        <?php
    }

    // SECTION 2 : SECTION_INFO =======================================
    public static function field_hidden_info_takeawaypage(){
        $hidden_info_takeawaypage = esc_attr(get_option('hidden_info_takeawaypage'));
        ?>
        <input type="hidden" name="hidden_info_takeawaypage" value="0" />
        <input type="checkbox" id="hidden_info_takeawaypage" name="hidden_info_takeawaypage" value="1" <?php checked(1, $hidden_info_takeawaypage, true); ?> />
        <label for=""><?php _e("Masquer cette section de la page dédier aux cartes", 'TableBouddha') ?></label>
        <p class="description"><?php _e("Remarque : Seule le titre sera affiché dans la section", 'TableBouddha'); ?></p>
        <?php
    }

    public static function field_title_takeawaypage(){
        $title_info_takeawaypage = esc_attr(get_option('title_info_takeawaypage'));
        ?>
        <input type="text"
               id="title_info_takeawaypage"
               name="title_info_takeawaypage"
               value="<?php echo $title_info_takeawaypage ?>"
               class="large-text"
        />
        <p class="description"><?php _e("Remarque : Ceci est le titre de la section et sera affiché même si la section est masquée", 'TableBouddha'); ?></p>
        <?php
    }

    public static function field_description_takeawaypage(){
        $text_info_takeawaypage = esc_attr(get_option('text_info_takeawaypage'));
        ?>
        <textarea name="text_info_takeawaypage" id="text_info_takeawaypage" class="large-text code"><?php echo $text_info_takeawaypage ?></textarea>
        <?php
    }

    public static function field_image_takeawaypage(){
        ?>
        <p>
            <input type="file" id="image_info_takeawaypage" name="image_info_takeawaypage" value="<?php echo get_option('image_info_takeawaypage') ?>" />
        </p>
        <p>
            <img src="<?php echo get_option('image_info_takeawaypage'); ?>" class="img-hero" alt="" />
        </p>
        <?php
    }


    // SECTION 3 : SECTION_LOOP =======================================
    public static function field_msg_loop_takeawaypage(){
        $msg_loop_takeawaypage = esc_attr(get_option('msg_loop_takeawaypage'));
        ?>
        <p class="description"><?php _e("Ajouter un message pour inciter la clientèle cliquer sur le menu", 'TableBouddha') ?></p>
        <input type="text" name="msg_loop_takeawaypage" id="msg_loop_takeawaypage" class="large-text" value="<?php echo $msg_loop_takeawaypage ?>" />
        <?php
    }

}

if(class_exists('tablebouddha_custom_takeawaypage')){
    tablebouddha_custom_takeawaypage::register();
}