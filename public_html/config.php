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
 * It is strongly recommended that in developement condition use DEBUG in the development environments.
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
 * You can use T_() function to translate via dll and if not exist with php gettext.
 * also you can use __() and _() functions.
 * With locale_emulation() you can get locale method is emulate(use php) or not(use gettext extention).
 */
define('MultiLanguage', true);

/**
 * Defaultlanguage
 * Default: 'en_US'
 *
 * If your site support multi language then you can fix default language for visitors
 */
define('DefaultLanguage', 'en_US');

/**
 * SaveAsCookie
 * Default: true
 *
 * Convert all GET request set as Cookie for having clear address
 * If this option is set to true then this event occur automatically for all pages
 * you can disable this event for specefic page with set parameter in controller of that pages
 */
define('SaveAsCookie', true);

/**
 * LogVisitors
 * Default: false
 *
 * if table exist add to it, else create a table and add a visitor details to it
 */
define('LogVisitors', true);


/**
 * ControlPanel
 * Default: false
 *
 * add saloos control panel to this project
 */
define('ControlPanel', true);

/**
 * Account
 * Default: false
 *
 * add saloos Account manager to this project
 * if you want use ermile main account set it as 'ermile'
 */
define('Account', 'ermile');

/**
 * LangList
 * Default serialize (['fa_IR' => 'فارسی', 'en_US' => 'English'])
 *
 * List of Site languages
 */
define('LangList', serialize (['fa_IR' => 'فارسی', 'en_US' => 'English']));

?>