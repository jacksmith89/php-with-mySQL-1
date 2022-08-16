<?php
// Jul 10, 2022 09:55:37 This function will generate a full filepath *relative to the "/public" folder*. I'm pretty sure I could also just use PUBLIC_PATH that I made in initialize.php? The function name is "url_for", and we're passing in "$script_path" as a placeholder variable.
function url_for($script_path)
{
    // add the leading "/" if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

// Jul 12, 2022 09:15:47 urlencode() and rawurlencode() encode the special characters like spaces and & in urls and queries into code that won't break things. Mostly we'll use urlencode() for queries, using rawurlencode() will be less common.
function u($string = "")
{
    return urlencode($string);
}
function raw_u($string = "")
{
    return rawurlencode($string);
}

// Jul 12, 2022 09:15:55 htmlspecialchars() will convert special characters passed into queries and forms so that the browser interprets them as part of a string, and not as code (I think). This is especially important to prevent cross-site scripting, a form of hacking where script tags are passed into a query or url and the browser just runs whatever (probably malicious) script is passed in.
function h($string = "")
{
    return htmlspecialchars($string ?? '');
}

function sqlEscape($string = "")
{
    global $db;
    return mysqli_real_escape_string($db, $string ?? '');
}

function error_404()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}
function error_500()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
}
function redirect_to($location)
{
    header("Location: " . $location);
    exit;
}
// Aug 10, 2022 18:26:50 These functions check what request method was used to determine if a form was submitted or not.
function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}
