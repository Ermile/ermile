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