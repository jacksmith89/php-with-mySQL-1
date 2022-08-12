<?php

// Aug 12, 2022 12:54:18 Now, we're making an sql query to pull the array from the database instead of creating the array in PHP.

function find_all_subjects()
{
    global $db;

    $sql = "SELECT * FROM subjects ";
    // Below is a common way of concatenating together an sql statement over multiple lines. MAKE SURE TO HAVE THE ENDING SPACE ON PREVIOUS LINES, otherwise the concatenation will run words together.
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    return $result;
}
