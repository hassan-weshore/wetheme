<?php

/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'theme');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '.C%@K7-3!4;g^y02~Cx&H2Aw{q-N,KA Ka_CktLc>V{mci3e^x*twLp)4nz03S@G');
define('SECURE_AUTH_KEY',  '3[funmMe+()sDFUotP`3%??:Gj~NCQ}W)a;v>}=li_G>G@tk:e=Y_`Y#SslK7s[I');
define('LOGGED_IN_KEY',    '-D(+`y*zfuE/TVNKHBwiFViiW_>`0wg[ZZ$f6iq^2GQP0}/Kj>V(hEEtgxs]$t4]');
define('NONCE_KEY',        'Z%X{cV~8Z=gsUj+e/Ra%75 #%XcX_2Wbc8NRj!fhvdQvr$cA!SgJE)l`7g<|PY{G');
define('AUTH_SALT',        '/t7!MTcDvXY$LY)%J-cd.=ZY947>J~%7@MZ)YCN$:r-^J$4GU.Bw5!eN=Yj&yZkh');
define('SECURE_AUTH_SALT', '$,|C.Vy-%CAdtl=I>b6DO[R_Z>`jI>>vL0+8s;*]%H]:j]8Y9+$wdmVILl /J0Rn');
define('LOGGED_IN_SALT',   '&Cj@$<J/-6<2uGYSd4IYC8s?d}fFspc]xVS`lBkQMCu(D{#z8~+QsvB,}[{T^lm8');
define('NONCE_SALT',       '5KAnx*Y.3w0*F_Lz+_Sf|-!( P!Mx0O/!HHNoB?g/+!jaJ{C&~ZH&:7b28FRf.CS');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'theme_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */


// Enable WP_DEBUG mode
define('WP_DEBUG', false);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', false);

// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', false);
//@ini_set( 'display_errors', 0 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if (!defined('ABSPATH'))
  define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
