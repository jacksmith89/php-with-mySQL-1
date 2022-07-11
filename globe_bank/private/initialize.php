<?php
// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . "/public");
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

require_once "functions.php";
