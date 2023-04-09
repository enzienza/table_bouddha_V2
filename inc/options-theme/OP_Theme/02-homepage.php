<?php
/**
 * Name File : homepage
 * Description : File about gestion of dispay of page 'homepage'
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


class tablebouddha_custom_homepage{
    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     */
    const PERMITION    = 'manage_options';
    const SUB1_GROUP   = 'custom_homepage';
    const NONCE        = '_custom_homepage';

    // definit les section
    const SECTION_BG_VIDEO  = 'section_bg_video_homepage';
    const SECTION_BG_IMG    = 'section_bg_img_homepage';



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
            __('Homepage', 'TableBouddha'),                    // page_title
            __('Homepage', 'TableBouddha'),                     // menu_title
            self::PERMITION,                     // capability
            self::SUB1_GROUP,                    // slug_menu
            [self::class, 'render']              // CALLBACK
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e("Gestion de la page d'accueil", 'TableBouddha'); ?></h1>
            <p class="description">
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
            settings_fields(self::SUB1_GROUP);
            do_settings_sections(self::SUB1_GROUP);
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
         * SECTION 1 : SECTION_BG_VIDEO =====================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_BG_VIDEO,                   // SLUG_SECTION
            __('Vidéo', 'TableBouddha'),                                  // TITLE
            [self::class, 'display_section_video'],   // CALLBACK
            self::SUB1_GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'video_homepage',                         // SLUG_FIELD
            __('Vidéo d\'arrière plan', 'TableBouddha'),                  // LABEL
            [self::class,'field_video_homepage'],     // CALLBACK
            self::SUB1_GROUP ,                        // SLUG_PAGE
            self::SECTION_BG_VIDEO
        );
        add_settings_field(
            'video_element_homepage',                        // SLUG_FIELD
            __('Ce qui doit être présent', 'TableBouddha'),                      // LABEL
            [self::class,'field_video_element_homepage'],    // CALLBACK
            self::SUB1_GROUP ,                               // SLUG_PAGE
            self::SECTION_BG_VIDEO
        );
        add_settings_field(
            'video_message_homepage',                        // SLUG_FIELD
            __('Gestion d\'un message', 'TableBouddha'),                         // LABEL
            [self::class,'field_video_message_homepage'],    // CALLBACK
            self::SUB1_GROUP ,                               // SLUG_PAGE
            self::SECTION_BG_VIDEO
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB1_GROUP, 'yes_video');
        register_setting(self::SUB1_GROUP, 'add_video', [self::class, 'handle_file_bg_video']);
        register_setting(self::SUB1_GROUP, 'sound_video');
        /* view element on bd_video */
        register_setting(self::SUB1_GROUP, 'view_logo_video');
        register_setting(self::SUB1_GROUP, 'view_namesite_video');
        register_setting(self::SUB1_GROUP, 'view_address_video');
        register_setting(self::SUB1_GROUP, 'view_phone_video');
        register_setting(self::SUB1_GROUP, 'yes_message_video');
        register_setting(self::SUB1_GROUP, 'message_video');

        /**
         * SECTION 2 : SECTION_BG_IMG =======================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_BG_IMG,                     // SLUG_SECTION
            __('Image', 'TableBouddha'),                                  // TITLE
            [self::class, 'display_section_image'],   // CALLBACK
            self::SUB1_GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'image_homepage',                                // SLUG_FIELD
            __('Image d\'arrière plan', 'TableBouddha'),                         // LABEL
            [self::class,'field_image_homepage'],            // CALLBACK
            self::SUB1_GROUP ,                               // SLUG_PAGE
            self::SECTION_BG_IMG
        );
        add_settings_field(
            'image_element_homepage',                        // SLUG_FIELD
            __('Ce qui doit être présent', 'TableBouddha'),                      // LABEL
            [self::class,'field_image_element_homepage'],    // CALLBACK
            self::SUB1_GROUP ,                               // SLUG_PAGE
            self::SECTION_BG_IMG
        );
        add_settings_field(
            'image_message_homepage',                        // SLUG_FIELD
            __('Gestion d\'un message', 'TableBouddha'),                         // LABEL
            [self::class,'field_image_message_homepage'],    // CALLBACK
            self::SUB1_GROUP ,                               // SLUG_PAGE
            self::SECTION_BG_IMG
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB1_GROUP, 'yes_image');
        register_setting(self::SUB1_GROUP, 'add_image', [self::class, 'handle_file_bg_image']);
        /* view element on bg_image */
        register_setting(self::SUB1_GROUP, 'view_logo_image');
        register_setting(self::SUB1_GROUP, 'view_namesite_image');
        register_setting(self::SUB1_GROUP, 'view_address_image');
        register_setting(self::SUB1_GROUP, 'view_phone_image');
        register_setting(self::SUB1_GROUP, 'yes_message_image');
        register_setting(self::SUB1_GROUP, 'message_image');
    }


    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_BG_VIDEO =====================================
    public static function display_section_video(){
        ?>
        <p class="description">
            <?php _e("Section dédier à l'affichage d'une vidéo sur la page d'accueil", 'TableBouddha');?>
        </p>
        <?php
    }
    // SECTION 2 : SECTION_BG_IMG =======================================
    public static function display_section_image(){
        ?>
        <p class="description">
            <?php _e("Section dédier à l'affichage d'une image sur la page d'accueil", 'TableBouddha');?>
        </p>
        <?php
    }



    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     */
    // SECTION 1 : SECTION_BG_VIDEO =====================================
    public static function handle_file_bg_video($options){
        if(!empty($_FILES['add_video']['tmp_name'])){
            $urls = wp_handle_upload($_FILES['add_video'], array('test_form' => FALSE));
            $temp = $urls['url'];
            return $temp;
        } // end -> if(!empty($_FILES['add_video']['tmp_name']))

        //no upload. old file url is the new value.
        return get_option('add_video');
    }

    // SECTION 2 : SECTION_BG_IMG =======================================
    public static function handle_file_bg_image($options){
        if(!empty($_FILES['add_image']['tmp_name'])){
            $urls = wp_handle_upload($_FILES['add_image'], array('test_form' => FALSE));
            $temp = $urls['url'];
            return $temp;
        } // end -> if(!empty($_FILES['add_image']['tmp_name']))

        //no upload. old file url is the new value.
        return get_option('add_image');
    }


    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    //SECTION 1 : SECTION_BG_VIDEO =====================================
    public static function field_video_homepage(){
        $yes_video   = esc_attr(get_option('yes_video'));
        $sound_video = esc_attr(get_option('sound_video'));
        ?>
        <p>
            <input type="hidden" name="yes_video" value="0" />
            <input type="checkbox" id="yes_video" name="yes_video" value="1" <?php checked(1, $yes_video, true); ?> />
            <label for="" class="info"><?php _e("Ajouter la vidéo comme d'arrière plan", 'TableBouddha') ;?></label>
        </p>
        <p>
            <input type="hidden" name="sound_video" value="0" />
            <input type="checkbox" id="sound_video" name="sound_video" value="1"<?php checked(1, $sound_video, true); ?>/>
            <label for="" class="info"><?php _e("Ajouter le son à la vidéo", 'TableBouddha') ?></label>
        </p>
        <p class="height-space">
            <input type="file" id="add_video" name="add_video" value="<?php echo get_option('add_video'); ?>"/>
        </p>
        <video controls class="img-hero">
            <source src="<?php echo get_option('add_video'); ?>" type="video/mp4">
            <source src="<?php echo get_option('add_video'); ?>" type="video/ogg">
        </video>
        <?php
    }

    public static function field_video_element_homepage(){
        $view_logo_video     = esc_attr(get_option('view_logo_video'));
        $view_namesite_video = esc_attr(get_option('view_namesite_video'));
        $view_address_video  = esc_attr(get_option('view_address_video'));
        $view_phone_video    = esc_attr(get_option('view_phone_video'));
        ?>
        <p class="description">
            <?php _e("Cocher ce qui doit être présent sur la vidéo (par-dessus)", 'TableBouddha'); ?>
        </p>
        <p>
            <input type="hidden" name="view_logo_video" value="0"/>
            <input type="checkbox" id="view_logo_video" name="view_logo_video" value="1" <?php checked(1, $view_logo_video, true); ?>/>
            <label for=""><?php _e('Ajouter le logo', 'TableBouddha') ?></label>
        </p>
        <p>
            <input type="hidden" name="view_namesite_video" value="0"/>
            <input type="checkbox" id="view_namesite_video" name="view_namesite_video" value="1" <?php checked(1, $view_namesite_video, true); ?> />
            <label for=""><?php _e("Ajouter le nom du site", 'TableBouddha'); ?></label>
        </p>
        <p>
            <input type="hidden" name="view_address_video" value="0"/>
            <input type="checkbox" id="view_address_video" name="view_address_video" value="1" <?php checked(1, $view_address_video, true); ?> />
            <label for=""><?php _e("Ajouter l'adresse", 'TableBouddha'); ?></label>
        </p>
        <p>
            <input type="hidden" name="view_phone_video" value="0"/>
            <input type="checkbox" id="view_phone_video" name="view_phone_video" value="1" <?php checked(1, $view_phone_video, true); ?> />
            <label for=""><?php _e("Ajouter le numéro de téléphone", 'TableBouddha'); ?></label>
        </p>
        <?php
    }

    //SECTION 2 : SECTION_BG_IMG =======================================
    public static function field_video_message_homepage(){
        $yes_message_video = esc_attr(get_option('yes_message_video'));
        $message_video = esc_attr(get_option('message_video'));
        ?>
        <p class="description">
            <?php _e("C'est ici que vous allez définir s'il faut ajouter un message sur l'accueil. Par exemple indiquer les vacances annuelles", 'TableBouddha'); ?>
        </p>
        <p class="height-space">
            <input type="hidden" name="yes_message_video" value="0"/>
            <input type="checkbox" id="yes_message_video" name="yes_message_video" value="1" <?php checked(1, $yes_message_video, true); ?>/>
            <label for=""><?php _e("Afficher le texte", 'TableBouddha')?></label>
        </p>
        <p>
            <textarea name="message_video" id="message_video" class="large-text code"><?php echo $message_video ?></textarea>
        </p>
        <?php
    }


    // image
    public static function field_image_homepage(){
        $yes_image = esc_attr(get_option('yes_image'));
        ?>
        <p>
            <input type="hidden" name="yes_image" value="0" />
            <input type="checkbox" id="yes_image" name="yes_image" value="1"<?php checked(1, $yes_image, true); ?>/>
            <label for="" class="info"><?php _e("Ajouter l'image comme d'arrière plan", 'TableBouddha') ?></label>
        </p>
        <p class="height-space">
            <input type="file" id="add_image" name="add_image" value="<?php echo get_option('add_image'); ?>"/>
        </p>
        <p>
            <img src="<?php echo get_option('add_image'); ?>" class="img-hero" alt=""/>
        </p>
        <?php
    }

    public static function field_image_element_homepage(){
        $view_logo_image = esc_attr(get_option('view_logo_image'));
        $view_namesite_image = esc_attr(get_option('view_namesite_image'));
        $view_address_image = esc_attr(get_option('view_address_image'));
        $view_phone_image = esc_attr(get_option('view_phone_image'));
        ?>
        <p class="description">
            <?php _e("Cocher ce qui doit être présent sur la vidéo (par-dessus)", 'TableBouddha')?>
        </p>
        <p>
            <input type="hidden" name="view_logo_image" value="0" />
            <input type="checkbox" id="view_logo_image" name="view_logo_image" value="1" <?php checked(1, $view_logo_image, true); ?> />
            <label for=""><?php _e("Ajouter le logo", 'TableBouddha'); ?></label>
        </p>
        <p>
            <input type="hidden" name="view_namesite_image" value="0" />
            <input type="checkbox" id="view_namesite_image" name="view_namesite_image" value="1" <?php checked(1, $view_namesite_image, true); ?> />
            <label for=""><?php _e("Ajouter le nom du site", 'TableBouddha'); ?></label>
        </p>
        <p>
            <input type="hidden" name="view_address_image" value="0" />
            <input type="checkbox" id="view_address_image" name="view_address_image" value="1" <?php checked(1, $view_address_image, true); ?> />
            <label for=""><?php _e("Ajouter l'adresse", 'TableBouddha'); ?></label>
        </p>
        <p>
            <input type="hidden" name="view_phone_image" value="0" />
            <input type="checkbox" id="view_phone_image" name="view_phone_image" value="1" <?php checked(1, $view_phone_image, true); ?> />
            <label for=""><?php _e("Ajouter le numéro de téléphone", 'TableBouddha'); ?></label>
        </p>
        <?php
    }

    public static function field_image_message_homepage(){
        $yes_message_image = esc_attr(get_option('yes_message_image'));
        $message_image = esc_attr(get_option('message_image '));
        ?>
        <p class="description">
            <?php _e("C'est ici que vous allez définir s'il faut ajouter un message sur l'accueil. Par exemple indiquer les vacances annuelles", 'TableBouddha') ?>
        </p>
        <p class="height-space">
            <input type="checkbox" id="yes_message_image" name="yes_message_image" value="1" <?php checked(1, $yes_message_image, true); ?>  />
            <label for=""><?php _e("Afficher le texte", 'TableBouddha')?></label>
        </p>
        <p>
            <textarea name="message_image" id="message_image"  class="large-text code"><?php echo $message_image ?></textarea>
        </p>
        <?php
    }

}

if(class_exists('tablebouddha_custom_homepage')){
    tablebouddha_custom_homepage::register();
}