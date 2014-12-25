<?php
/**
 @ In the name Of Allah
 * The base configurations of the SAMAC.
 * This file has the configurations of MySQL settings and useful core settings
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database */
define("db_name", 'ermile');

/** MySQL database username */
define("db_user", 'ermile');

/** MySQL database password */
define("db_pass", 'ermile@#$567');

/**
 * For developers: debugging mode.
 * Default: False
 * 
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use DEBUG
 * in their development environments.
 */
define('DEBUG', true);

/**
 * For developers: Show comming soon page.
 * Default: false
 * 
 * If you are developing this site enable option to redirect all request to /static/page/coming/
 * for see and work with site you can set with this address: YourSite.com?dev=yes
 * if your site is now ready for show to visitors, turn this option off
 */
define('CommingSoon', true);

/**
 * Multilanguage
 * Default: false
 * 
 * If your site support multi language enable with this option.
 * For see and work with site you can set with this address: YourSite.com?dev=yes
 * If your site is now ready for show to visitors, turn this option off.
 * You can use T_() function to translate via dll and if not exist with php gettext. also you can use __() and _() functions.
 * With locale_emulation() you can get locale method is emulate(use php) or not(use gettext extention).
 */
define('MultiLanguage', true);
?>