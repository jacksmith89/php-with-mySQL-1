<!-- Aug 12, 2022 12:35:53 first, we're going to require db_credentials.php, which is where we've defined some constants for the database server, the user, the password, and the database name. -->
<?php
require_once('db_credentials.php');

// Aug 12, 2022 12:36:44 This function references the constants from db_credentials.php and uses the mysqli_connect method using those constants as the credentials, and sets the variable $connection equal to that method; then it returns the variable $connection.
function db_connect()
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    return $connection;
}

// Aug 12, 2022 12:38:14 This function checks to see if the connection to mysql is set, using the $connection variable, and if it is, runs the mysqli_close method on that variable.
function db_disconnect($connection)
{
    if (isset($connection)) {
        mysqli_close($connection);
    }
}

function confirm_db_connect()
{
    if (mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function confirm_result_set($result_set)
{
    if (!$result_set) {
        exit("Database query failed.");
    }
}
