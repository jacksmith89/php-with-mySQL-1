<?php
ob_start();
// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
// Jul 12, 2022 09:54:17 Adding notes because I forget: PRIVATE_PATH returns the path from the root all the way this file, initialize, which means it will "/globe_bank/private".
define("PRIVATE_PATH", dirname(__FILE__));
// PROJECT_PATH finds the parent directory of PRIVATE_PATH, which in this case is "/globe_bank"
define("PROJECT_PATH", dirname(PRIVATE_PATH));
// PUBLIC_PATH adds "/public" to PROJECT_PATH, so it returns "/globe_bank/public"
define("PUBLIC_PATH", PROJECT_PATH . "/public");
// SHARED_PATH adds "/shared" to PRIVATE_PATH, so it returns "/globe_bank/private/shared"
define("SHARED_PATH", PRIVATE_PATH . "/shared");

// Assign the root URL to a PHP constant
// * We don't need to include the domain name
// * We want to use the same document root as the webserver
// * We can set a hard-coded value:
// define("WWW_ROOT", "/~php-with-mysql-1/globe_bank/public);
// *We can set it to be "the root" on a production machine (I don't feel like I really know what this means)
// define("WWW_ROOT"), "");
// * We can dynamically find everything in the URL up to "/public"
// Jul 10, 2022 09:09:51 First, we'll define a variable to find the end of the path
// Jul 10, 2022 09:18:04 WHY DOES THIS WORK??
// Jul 10, 2022 09:27:50 So, "_SERVER" is a super global variable that can work with several elements to do various things. One of those things is ["SCRIPT_NAME"]. $_SERVER[SCRIPT_NAME] returns the path of the current script as a string.
// Jul 10, 2022 09:31:24 $public_end finds the index position of "/public" in the string returned by $_SERVER["SCRIPT_NAME"]; normally, strpos() would return the index of the START of the needle string, but since we want to include "/public", we have to offset the index position by the number of characters in "/public", 7.
$public_end = strpos($_SERVER['SCRIPT_NAME'], "/public") + 7;
// Jul 10, 2022 09:37:16 Now that we know the index position of the end of "/public" in the string returned by $_SERVER["SCRIPT_NAME"], we can use substr() to create a string that ends at that point, creating a filepath ending with "/public", and set that string/filepath to the variable $doc_root.
// Jul 10, 2022 09:40:27 Doesn't that mean that we're setting "/public" as our root? That doesn't seem right.
// Jul 10, 2022 09:45:19 Apparently that IS right. In my case, $public_end (and therefore WWW_ROOT) returns "/globe_bank/public". I'm assuming if I created the project so that I was nested more deeply, it would return something like "/php-with-mysql-1/globe_bank/public". I feel like "/globe_bank" should be the root, but /shrug.
$doc_root = substr($_SERVER["SCRIPT_NAME"], 0, $public_end);
// Finally, we define "WWW_ROOT" as the variable $doc_root.
define("WWW_ROOT", $doc_root);

require_once("functions.php");
// Aug 12, 2022 12:40:30 Any time any page loads initialize.php, it will load database.php, which includes loading db_credentials.php, and run the db_connect() function, connecting to the database; Every page that uses initialize.php (so, every page) will automatically connect to the database. Logging out of the database is handled on staff-footer.php.

require_once("database.php");
require_once("query_functions.php");
require_once("validation_functions.php");

$db = db_connect();
