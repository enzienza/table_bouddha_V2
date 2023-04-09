<?php
/**
 * Name File : Custom-theme
 * Description : This file regroup a link table that allows to manage the display of all pages of theme
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


class tablebouddha_customtheme{
    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     * afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION  = 'manage_options';
    const DASHICON   = 'dashicons-admin-multisite';
    const GROUP      = 'customtheme_tablebouddha';
    const NONCE      = '_customtheme_tablebouddha';


    // definit les section
    // const SECTION_IMG    = 'section_image_tablebouddha';
    // const SECTION_INFO   = 'section_info_tablebouddha';
    // const SECTION_url    = 'section_url_tablebouddha';

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
        add_menu_page(
            __('Custom Theme', 'TableBouddha'),                   // TITLE_PAGE
            __('Custom Theme', 'TableBouddha'),                    // TITLE_MENU
            self::PERMITION,                    // CAPABILITY
            self::GROUP,                        // SLUG_PAGE
            [self::class, 'render'],            // CALLBACK
            self::DASHICON,                     // icon
            3                                   // POSITION
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e('Personnaliser le theme', 'TableBouddha'); ?></h1>
            <p class="description">
                <?php _e("Sur cette page vous pouvez gérer l'affiche du theme", 'TableBouddha'); ?>
            </p>
        </div>


        <table class="widefat importers striped">

            <tr class="importer-item">
                <td class="import-system">
            <span class="importer-title">
              <?php _e("Page d'accueil", 'TableBouddha') ?>
            </span>
                    <span class="importer-action">
              <a href="?page=custom_homepage" class="install-now">
                <?php _e('Gérer la page', 'TableBouddha') ?>
              </a>
            </span>
                </td>
                <td class="desc">
            <span class="importer-desc">
              <?php _e("Lien pour gérer l'affichage de la page d'accueil", 'TableBouddha') ?>
            </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
            <span class="importer-title">
              <?php _e("Page cartes", 'TableBouddha');?>
            </span>
                    <span class="importer-action">
              <a href="?page=custom_cartepage" class="install-now">
                <?php _e("Gérer la page", 'TableBouddha');?>
              </a>
            </span>
                </td>
                <td class="desc">
            <span class="importer-desc">
              <?php _e("Lien pour gérer l'affichage de la page des cartes", 'TableBouddha');?>
            </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
            <span class="importer-title">
              <?php _e("Page boissons", 'TableBouddha'); ?>
            </span>
                    <span class="importer-action">
              <a href="?page=custom_drinkpage" class="install-now">
                <?php _e("Gérer la page", 'TableBouddha'); ?>
              </a>
            </span>
                </td>
                <td class="desc">
            <span class="importer-desc">
              <?php _e("Lien pour gérer l'affichage de la page des boissons", 'TableBouddha'); ?>
            </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
            <span class="importer-title">
              <?php _e("Page emportés", 'TableBouddha'); ?>
            </span>
                    <span class="importer-action">
              <a href="?page=custom_takeawaypage" class="install-now">
                <?php _e("Gérer la page", 'TableBouddha'); ?>
              </a>
            </span>
                </td>
                <td class="desc">
            <span class="importer-desc">
              <?php _e("Lien pour gérer l'affichage de la page des emportés", 'TableBouddha'); ?>
            </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
            <span class="importer-title">
              <?php _e("Page événements", 'TableBouddha'); ?>
            </span>
                    <span class="importer-action">
              <a href="?page=custom_eventpage" class="install-now">
                <?php _e("Gérer la page", 'TableBouddha'); ?>
              </a>
            </span>
                </td>
                <td class="desc">
            <span class="importer-desc">
              Lien pour gérer l'affichage de la page des événements
            </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
            <span class="importer-title">
              <?php _e("Page par défaut", 'TableBouddha'); ?>
            </span>
                    <span class="importer-action">
              <a href="?page=custom_defaultpage" class="install-now">
                <?php _e("Gérer la page", 'TableBouddha'); ?>
              </a>
            </span>
                </td>
                <td class="desc">
            <span class="importer-desc">
              <?php _e("Lien pour gérer l'affichage des page par défaut", 'TableBouddha'); ?>
            </span>
                </td>
            </tr>


            <tr class="importer-item">
                <td class="import-system">
            <span class="importer-title">
              <?php _e("Page erreur", 'TableBouddha'); ?>
            </span>
                    <span class="importer-action">
              <a href="?page=custom_errorpage" class="install-now">
                <?php _e("Gérer la page", 'TableBouddha'); ?>
              </a>
            </span>
                </td>
                <td class="desc">
            <span class="importer-desc">
              <?php _e("Lien pour gérer l'affichage de la page d'erreur", 'TableBouddha'); ?>
            </span>
                </td>
            </tr>

        </table>
        <?php
    }


    /**
     * 5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
     */
    public static function registerSettings(){

    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */


    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */


    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */


}

if(class_exists('tablebouddha_customtheme')){
    tablebouddha_customtheme::register();
}