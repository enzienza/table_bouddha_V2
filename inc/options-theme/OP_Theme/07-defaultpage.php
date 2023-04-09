<?php
/**
 * Name Files : defaultpage
 * Description : File about gestion of display page default
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

class tablebouddha_custom_defaultpage{
    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     */
    const PERMITION    = 'manage_options';
    const SUB_GROUP   = 'custom_defaultpage';
    const NONCE        = '_custom_defaultpage';

    // definit les section
    const SECTION_HERO    = 'section_hero_defaultpage';
    const SECTION_INFO    = 'section_info_defaultpage';

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
            __('Page par défaut', 'TableBouddha'),                    // page_title
            __('Page par défaut', 'TableBouddha'),                     // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e('Gestion de la page par défaut', 'TableBouddha'); ?></h1>
            <p class="description">
                <?php _e("Sur cette page vous pouvez gérer l'affichage général de la page par défaut", 'TableBouddha'); ?>
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
            __('Section bannière', 'TableBouddha'),                          // TITLE
            [self::class, 'display_section_hero'],   // CALLBACK
            self::SUB_GROUP
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_defaultpage',                             // SLUG_FIELD
            __('Image d\'arrière plan', 'TableBouddha'),                      // LABEL
            [self::class,'field_hero_defaultpage'],         // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_HERO
        );
        add_settings_field(
            'element_defaultpage',                          // SLUG_FIELD
            __('Ce qui doit être présent', 'TableBouddha'),                   // LABEL
            [self::class,'field_element_defaultpage'],      // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_HERO
        );
        add_settings_field(
            'message_hero_defaultpage',                     // SLUG_FIELD
            __('Gestion d\'un message', 'TableBouddha'),                   // LABEL
            [self::class,'field_message_hero_defaultpage'], // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_HERO
        );
        // 3. Sauvegarder les champs
        /* hero section */
        register_setting(self::SUB_GROUP, 'yes_hero_defaultpage');
        register_setting(self::SUB_GROUP, 'add_hero_defaultpage', [self::class, 'handle_file_hero_defaultpage']);
        /* element view on hero */
        register_setting(self::SUB_GROUP, 'view_logo_defaultpage');
        register_setting(self::SUB_GROUP, 'view_namesite_defaultpage');
        register_setting(self::SUB_GROUP, 'yex_message_defaultpage');
        register_setting(self::SUB_GROUP, 'text_hero_defaultpage');

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
            __('Section titre [info]', 'TableBouddha'),                               // TITLE
            [self::class, 'display_section_description'], // CALLBACK
            self::SUB_GROUP
        );
        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hidden_info_defaultpage',                      // SLUG_FIELD
            __('Cacher la section', 'TableBouddha'),                          // LABEL
            [self::class,'field_hidden_info_defaultpage'],  // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );
        add_settings_field(
            'title_defaultpage',                            // SLUG_FIELD
            __('Ajouter un titre', 'TableBouddha'),                           // LABEL
            [self::class,'field_title_defaultpage'],        // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );
        add_settings_field(
            'description_defaultpage',                      // SLUG_FIELD
            __('Ajouter une description', 'TableBouddha'),                    // LABEL
            [self::class,'field_description_defaultpage'],  // CALLBACK
            self::SUB_GROUP ,                            // SLUG_PAGE
            self::SECTION_INFO
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'hidden_info_defaultpage');
        register_setting(self::SUB_GROUP, 'title_info_defaultpage');
        register_setting(self::SUB_GROUP, 'text_info_defaultpage');



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

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     */
    // SECTION 1 : SECTION_HERO =======================================
    public static function handle_file_hero_defaultpage($options){
        if(!empty($_FILES['add_hero_defaultpage']['tmp_name'])){
            $urls = wp_handle_upload($_FILES['add_hero_defaultpage'], array('test_form' => FALSE));
            $temp = $urls['url'];
            return $temp;
        } // end -> if(!empty($_FILES['add_hero_defaultpage']['tmp_name']))

        //no upload. old file url is the new value.
        return get_option('add_hero_defaultpage');
    }

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_HERO =======================================
    public static function field_hero_defaultpage(){
        $yes_hero_defaultpage = esc_attr(get_option('yes_hero_defaultpage'));
        ?>
        <div>
            <p class="description"><?php _e("Remarque : Si vous n'ajoutez pas image, il prendra le font d'écran par défaut", 'TableBouddha'); ?></p>
            <input type="hidden" name="yes_hero_defaultpage" value="0" />
            <input type="checkbox" id="yes_hero_defaultpage" name="yes_hero_defaultpage" value="1" <?php checked(1, $yes_hero_defaultpage, true) ?> />
            <label for="" class="info"><?php _e("Ajouter l'image comme d'arrière plan", 'TableBouddha')?></label>
        </div>
        <div class="height-space">
            <input type="file" id="add_hero_defaultpage" name="add_hero_defaultpage" value="<?php echo get_option('add_hero_defaultpage'); ?>"/>
        </div>
        <div>
            <img src="<?php echo get_option('add_hero_defaultpage'); ?>" class="img-hero" alt=""/>
        </div>
        <?php
    }
    public static function field_element_defaultpage(){
        $view_logo_defaultpage     = esc_attr(get_option('view_logo_defaultpage'));
        $view_namesite_defaultpage = esc_attr(get_option('view_namesite_defaultpage'));
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent sur l'image (par-dessus)", 'TableBouddha')?></p>
        <p>
            <input type="hidden" name="view_logo_defaultpage" value="0" />
            <input type="checkbox" id="view_logo_defaultpage" name="view_logo_defaultpage" value="1" <?php checked(1, $view_logo_defaultpage, true) ?>  />
            <label for=""><?php _e("Ajouter le logo", 'TableBouddha') ?></label>
        </p>
        <p>
            <input type="hidden" name="view_namesite_defaultpage" value="0" />
            <input type="checkbox" id="view_namesite_defaultpage" name="view_namesite_defaultpage" value="1" <?php checked(1, $view_namesite_defaultpage, true) ?>/>
            <label for=""><?php _e('Ajouter le nom du site', 'TableBouddha')?></label>
        </p>
        <?php
    }
    public static function field_message_hero_defaultpage(){
        $yex_message_defaultpage = esc_attr(get_option('yex_message_defaultpage'));
        $text_hero_defaultpage = esc_attr(get_option('text_hero_defaultpage'));
        ?>
        <p class="description"><?php _e("Ajouter un message par-dessus l'image d'arrière plan ", 'TableBouddha')?></p>
        <div class="height-space">
            <input type="hidden" name="yex_message_defaultpage" value="0" />
            <input type="checkbox" id="yex_message_defaultpage" name="yex_message_defaultpage" value="1" <?php checked(1, $yex_message_defaultpage, true) ?> />
            <label for=""><?php _e('Afficher le texte souhaiter', 'TableBouddha')?></label>
            <textarea name="text_hero_defaultpage" id="text_hero_defaultpage" class="large-text code"><?php echo $text_hero_defaultpage ?></textarea>
        </div>
        <?php
    }

    // SECTION 2 : SECTION_INFO =======================================
    public static function field_hidden_info_defaultpage(){
        $hidden_info_defaultpage = esc_attr(get_option('hidden_info_defaultpage'));
        ?>
        <input type="hidden" name="hidden_info_defaultpage" value="0" />
        <input type="checkbox" id="hidden_info_defaultpage" name="hidden_info_defaultpage" value="1" <?php checked(1, $hidden_info_defaultpage, true); ?> />
        <label for=""><?php _e("Masquer cette section de la page dédier aux cartes", 'TableBouddha') ?></label>
        <p class="description"><?php _e("Remarque : Seule le titre sera affiché dans la section", 'TableBouddha'); ?></p>
        <?php
    }
    public static function field_title_defaultpage(){
        $title_info_defaultpage = esc_attr(get_option('title_info_defaultpage'));
        ?>
        <input type="text"
               id="title_info_defaultpage"
               name="title_info_defaultpage"
               value="<?php echo $title_info_defaultpage ?>"
               class="large-text"
        />
        <p class="description"><?php _e("Remarque : Ceci est le titre de la section et sera affiché même si la section est masquée", 'TableBouddha'); ?></p>
        <?php
    }
    public static function field_description_defaultpage(){
        $text_info_defaultpage = esc_attr(get_option('text_info_defaultpage'));
        ?>
        <textarea name="text_info_defaultpage" id="text_info_defaultpage" class="large-text code"><?php echo $text_info_defaultpage ?></textarea>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('tablebouddha_custom_defaultpage')){
    tablebouddha_custom_defaultpage::register();
}