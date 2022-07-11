<?php
// Jul 10, 2022 09:55:37 This function will generate a full filepath *relative to the "/public" folder*. I'm pretty sure I could also just use PUBLIC_PATH that I made in initialize.php? The function name is "url_for", and we're passing in "$script_path) as a placeholder variable.
function url_for($script_path)
{
    // add the leading "/" if not present
    if ($script_path[0] != '/') {
        $script_path = "/"         . $script_path;
    }
    return WWW_ROOT . $script_path;
}
