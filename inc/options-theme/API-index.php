<?php
/**
 * Name file: API-index
 * Description: group all API files of the theme here
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

/* ---------------------------------------------------------
>>>  TABLE OF CONTENTS:
------------------------------------------------------------

1 - GENERAL
2 - THEME

----------------------------------------------------------*/

/** ===============================================================
 *  1 - GENERAL
 *      Gérer les options général du theme
 */
require_once ('OP_General/generality.php');
require_once ('OP_General/horaire.php');

/** ===============================================================
 *  2 - THEME
 *      Gérer les options du theme personnalisé
 */
require_once ('OP_Theme/01-customTheme.php');
