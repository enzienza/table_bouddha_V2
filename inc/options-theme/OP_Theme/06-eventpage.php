<?php
/**
 * Name File : eventpage
 * Description : File about gestion of dispay of page 'custom-eventpage'
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

class tablebouddha_custom_eventpage{
    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     */
    const SUB5_TITLE   = 'Page événements';
    const SUB_MENU    = '';
    const PERMITION    = 'manage_options';
    const SUB_GROUP   = 'custom_eventpage';
    const NONCE        = '_custom_eventpage';

    // definit les section
    // definit les section
    const SECTION_HERO    = 'section_hero_eventpage';
    const SECTION_INFO    = 'section_info_eventpage';
    const SECTION_IMPORT  = 'section_import_eventpage';




    /**
     * 2 - DEFINIR LES HOOKS ACTIONS
     */
    public static function register(){
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
    }

    /**
     * 3 - CONSTRUCTION DE LA PAGE
     */
    public static function addMenu(){
        add_submenu_page(
            tablebouddha_customtheme::GROUP,     // slug parent
            __('Page événements', 'TableBouddha'),                    // page_title
            __('Page événements', 'TableBouddha'),                     // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e("Gestion de la page des évènements", 'TableBouddha'); ?></h1>
            <p class="description">
                <?php _e("Sur cette page vous pouvez gérer l'affichage général de la page des événements", 'TableBouddha'); ?>
                <?php _e("Sur cette page vous pouvez gérer l'affichage de la page d'accueil", 'TableBouddha'); ?>
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
         * SECTION 1 : SECTION_HERO ========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_HERO,                      // SLUG_SECTION
            __('Section bannière', 'TableBouddha'),                          // TITLE
            [self::class, 'display_section_hero'],   // CALLBACK
            self::SUB_GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_eventpage',                             // SLUG_FIELD
            __('Image d\'arrière plan', 'TableBouddha'),                      // LABEL
            [self::class,'field_hero_eventpage'],         // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_HERO
        );
        add_settings_field(
            'element_eventpage',                          // SLUG_FIELD
            __('Ce qui doit être présent', 'TableBouddha'),                   // LABEL
            [self::class,'field_element_eventpage'],      // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_HERO
        );
        add_settings_field(
            'message_hero_eventpage',                     // SLUG_FIELD
            __('Gestion d\'un message', 'TableBouddha'),                   // LABEL
            [self::class,'field_message_hero_eventpage'], // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_HERO
        );

        // 3. Sauvegarder les champs
        /* hero section */
        register_setting(self::SUB_GROUP, 'yes_hero_eventpage');
        register_setting(self::SUB_GROUP,'add_hero_eventpage', [self::class, 'handle_file_hero_eventpage']);
        /* element view on hero */
        register_setting(self::SUB_GROUP, 'view_logo_eventpage');
        register_setting(self::SUB_GROUP, 'view_namesite_eventpage');
        register_setting(self::SUB_GROUP, 'yex_message_eventpage');
        register_setting(self::SUB_GROUP, 'text_hero_eventpage');


        /**
         * SECTION 2 : SECTION_INFO ==========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_INFO,                           // SLUG_SECTION
            __('Section titre [info]', 'TableBouddha'),                               // TITLE
            [self::class, 'display_section_description'], // CALLBACK
            self::SUB_GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hidden_info_eventpage',                      // SLUG_FIELD
            __('Cacher la section', 'TableBouddha'),                          // LABEL
            [self::class,'field_hidden_info_eventpage'],  // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );
        add_settings_field(
            'title_eventpage',                            // SLUG_FIELD
            __('Ajouter un titre', 'TableBouddha'),                           // LABEL
            [self::class,'field_title_eventpage'],        // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );
        add_settings_field(
            'description_eventpage',                      // SLUG_FIELD
            __('Ajouter une description', 'TableBouddha'),                    // LABEL
            [self::class,'field_description_eventpage'],  // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );
        add_settings_field(
            'image_eventpage',                            // SLUG_FIELD
            __('Ajouter une image', 'TableBouddha'),                          // LABEL
            [self::class,'field_image_eventpage'],        // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'hidden_info_eventpage');
        register_setting(self::SUB_GROUP, 'title_info_eventpage');
        register_setting(self::SUB_GROUP, 'text_info_eventpage');
        register_setting( self::SUB_GROUP, 'image_info_eventpage', [self::class, 'handle_file_info_eventpage'] );

        /**
         * SECTION 2 : SECTION_IMPORT ========================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_IMPORT,                           // SLUG_SECTION
            __('Important', 'TableBouddha'),                               // TITLE
            [self::class, 'display_section_important'], // CALLBACK
            self::SUB_GROUP
        );

        // 2. Ajouter les éléments du formulaire
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

    // SECTION 3 : SECTION_IMPORT =======================================
    public static function display_section_important(){
        ?>
        <p>
            <?php _e("Pour une question de référencement Google, il est recommandé de ne pas afficher la page événement si elle est vide", 'TableBouddha'); ?>
        </p>
        <?php
    }



    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     */
    // SECTION 1 : SECTION_HERO =======================================
    public static function handle_file_hero_eventpage($options){
        if(!empty($_FILES['add_hero_eventpage']['tmp_name'])){
            $urls = wp_handle_upload($_FILES['add_hero_eventpage'], array('test_form' => FALSE));
            $temp = $urls['url'];
            return $temp;
        } // end -> if(!empty($_FILES['add_hero_eventpage']['tmp_name']))

        //no upload. old file url is the new value.
        return get_option('add_hero_eventpage');
    }

    // SECTION 2 : SECTION_INFO =======================================
    public static function handle_file_info_eventpage($options){
        if(!empty($_FILES['image_info_eventpage']['tmp_name'])){
            $urls = wp_handle_upload($_FILES['image_info_eventpage'], array('test_form' => FALSE));
            $temp = $urls['url'];
            return $temp;
        } // end -> if(!empty($_FILES['image_info_eventpage']['tmp_name']))

        //no upload. old file url is the new value.
        return get_option('image_info_eventpage');
    }


    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_HERO =======================================
    public static function field_hero_eventpage(){
        $yes_hero_eventpage = esc_attr(get_option('yes_hero_eventpage'));
        ?>
        <div>
            <p class="description"><?php _e("Remarque : Si vous n'ajoutez pas image, il prendra le font d'écran par défaut", 'TableBouddha'); ?></p>
            <input type="hidden" name="yes_hero_eventpage" value="0" />
            <input type="checkbox" id="yes_hero_eventpage" name="yes_hero_eventpage" value="1" <?php checked(1, $yes_hero_eventpage, true) ?> />
            <label for=""><?php _e("Ajouter le logo", 'TableBouddha') ?></label>
        </div>
        <div class="height-space">
            <input type="file" id="add_hero_eventpage" name="add_hero_eventpage" value="<?php echo get_option('add_hero_eventpage'); ?>" />
        </div>
        <div>
            <img src="<?php echo get_option('add_hero_eventpage'); ?>" class="img-hero" alt="" />
        </div>
        <?php
    }

    public static function field_element_eventpage(){
        $view_logo_eventpage     = esc_attr(get_option('view_logo_eventpage'));
        $view_namesite_eventpage = esc_attr(get_option('view_namesite_eventpage'));
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent sur l'image (par-dessus)", 'TableBouddha')?></p>
        <div>
            <input type="hidden" name="view_logo_eventpage" value="0" />
            <input type="checkbox" id="view_logo_eventpage" name="view_logo_eventpage" value="1" <?php checked(1, $view_logo_eventpage, true) ?> />
            <label for=""><?php _e("Ajouter le logo", 'TableBouddha') ?></label>
        </div>
        <div>
            <input type="hidden" name="view_namesite_eventpage" value="0" />
            <input type="checkbox" id="view_namesite_eventpage" name="view_namesite_eventpage" value="1" <?php checked(1, $view_namesite_eventpage, true) ?> />
            <label for=""><?php _e('Ajouter le nom du site', 'TableBouddha')?></label>
        </div>
        <?php
    }

    public static function field_message_hero_eventpage(){
        $yex_message_eventpage = esc_attr(get_option('yex_message_eventpage'));
        $text_hero_eventpage = esc_attr(get_option('text_hero_eventpage'));
        ?>
        <p class="description"><?php _e("Ajouter un message par-dessus l'image d'arrière plan ", 'TableBouddha')?></p>
        <div class="height-space">
            <input type="hidden" name="yex_message_eventpage" value="0" />
            <input type="checkbox" id="yex_message_eventpage" name="yex_message_eventpage" value="1" <?php checked(1, $yex_message_eventpage, true) ?> />
            <label for=""><?php _e('Afficher le texte souhaiter', 'TableBouddha')?></label>
            <textarea name="text_hero_eventpage" id="text_hero_eventpage" class="large-text code"><?php echo $text_hero_eventpage ?></textarea>
        </div>
        <?php
    }

    // SECTION 2 : SECTION_INFO =======================================
    public static function field_hidden_info_eventpage(){
        $hidden_info_eventpage = esc_attr(get_option('hidden_info_eventpage'));
        ?>
        <input type="hidden" name="hidden_info_eventpage" value="0" />
        <input type="checkbox" id="hidden_info_eventpage" name="hidden_info_eventpage" value="1" <?php checked(1, $hidden_info_eventpage, true); ?> />
        <label for=""><?php _e("Masquer cette section de la page dédier aux évènements", 'TableBouddha') ?></label>
        <p class="description"><?php _e("Remarque : Seule le titre sera affiché dans la section", 'TableBouddha'); ?></p>
        <?php
    }

    public static function field_title_eventpage(){
        $title_info_eventpage = esc_attr(get_option('title_info_eventpage'));
        ?>
        <input type="text"
               id="title_info_eventpage"
               name="title_info_eventpage"
               value="<?php echo $title_info_eventpage ?>"
               class="large-text"
        />
        <p class="description"><?php _e("Remarque : Ceci est le titre de la section et sera affiché même si la section est masquée", 'TableBouddha'); ?></p>
        <?php
    }

    public static function field_description_eventpage(){
        $text_info_eventpage = esc_attr(get_option('text_info_eventpage'));
        ?>
        <textarea name="text_info_eventpage" id="text_info_eventpage" class="large-text code"><?php echo $text_info_eventpage ?></textarea>
        <?php
    }

    public static function field_image_eventpage(){
        ?>
        <div>
            <input type="file" id="image_info_eventpage" name="image_info_eventpage" value="<?php echo get_option('image_info_eventpage') ?>" />
        </div>
        <div>
            <img src="<?php echo get_option('image_info_eventpage'); ?>" class="img-hero" alt="" />
        </div>
        <?php
    }


    /* ----- SECTION 3 : BOOKING ----- */
    public static function field_hidden_booking_eventpage(){
        $hidden_booking_eventpage = esc_attr(get_option('hidden_booking_eventpage'));
        ?>
        <input type="checkbox"
               id="hidden_booking_eventpage"
               name="hidden_booking_eventpage"
               value="1"
            <?php checked(1, $hidden_booking_eventpage, true); ?>
        />
        <span>
      Masquer cette section de la page dédier aux cartes
    </span>
        <?php
    }

    public static function field_element_booking_eventpage(){
        $view_icon_eventpage = esc_attr(get_option('view_icon_eventpage'));
        $view_phone_eventpage = esc_attr(get_option('view_phone_eventpage'));
        ?>
        <p class="description">
            Cocher ce qui doit être présent dans la section
        </p>
        <p class="height-space">
            <input type="checkbox"
                   id="view_icon_eventpage"
                   name="view_icon_eventpage"
                   value="1"
                <?php checked(1, $view_icon_eventpage, true); ?>
            />
            <span>Afficher l'icone</span>
        </p>
        <p class="height-space">
            <input type="checkbox"
                   id="view_phone_eventpage"
                   name="view_phone_eventpage"
                   value="1"
                <?php checked(1, $view_phone_eventpage, true); ?>
            />
            <span>Afficher le numéro de téléphone</span>
        </p>
        <?php
    }

    public static function field_texte_booking_eventpage(){
        $texte_booking_eventpage = esc_attr(get_option('texte_booking_eventpage'));
        ?>
        <p class="description">
            Définir le texte à afficher
        </p>
        <p class="height-space">
            <input type="text"
                   id="texte_booking_eventpage"
                   name="texte_booking_eventpage"
                   value="<?php echo $texte_booking_eventpage ?>"
                   class="large-text"
            />
        </p>
        <?php
    }
}

if(class_exists('tablebouddha_custom_eventpage')){
    tablebouddha_custom_eventpage::register();
}