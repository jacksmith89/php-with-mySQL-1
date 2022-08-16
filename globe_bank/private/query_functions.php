<?php

// Aug 12, 2022 12:54:18 Now, we're making an sql query to pull the array from the database instead of creating the array in PHP.

function find_all_subjects()
{
    global $db;

    $sql = "SELECT * FROM subjects ";
    // Below is a common way of concatenating together an sql statement over multiple lines. MAKE SURE TO HAVE THE ENDING SPACE ON PREVIOUS LINES, otherwise the concatenation will run words together.
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_subject_by_id($id)
{
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . $id . "'";
    // Aug 14, 2022 11:51:27 The $result from mysqli_query is a "result set", so it has all the data from the query, but it's not organized in any particular way. In order for it to be presented in a more usable way, we want to "fetch" from that result set and turn it into some kind of array, in this case with mysqli_fetch_assoc() to get back an associative array.
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
}

function insert_subject($subject)
{
    global $db;

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible)";
    $sql .= "Values (";
    // Aug 15, 2022 09:50:35 For security reasons, always put single quotes around all of the values that you submit into SQL.
    $sql .= "'" . sqlEscape($subject['menu_name']) . "',";
    $sql .= "'" . sqlEscape($subject['position']) . "',";
    $sql .= "'" . sqlEscape($subject['visible']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        // Aug 15, 2022 09:54:22 Remember, show.php requires an id, so we're using the mysqli_insert_id() function to give this new result an id. Maybe? Not sure I understand everything that's going on here, honestly.
        //$new_id = mysqli_insert_id($db);        
        //redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_subject($subject)
{
    global $db;

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . sqlEscape($subject['menu_name']) . "', ";
    $sql .= "position='" . sqlEscape($subject['position']) . "', ";
    $sql .= "visible='" . sqlEscape($subject['visible']) . "' ";
    $sql .= "WHERE id='" . sqlEscape($subject['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    //for UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_subject($id)
{
    global $db;
    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    //For DELETE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        //DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function find_all_pages()
{
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY subject_id ASC, position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
function find_page_by_id($id)
{
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . $id . "'";
    // Aug 14, 2022 11:51:27 The $result from mysqli_query is a "result set", so it has all the data from the query, but it's not organized in any particular way. In order for it to be presented in a more usable way, we want to "fetch" from that result set and turn it into some kind of array, in this case with mysqli_fetch_assoc() to get back an associative array.
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page;
}
function insert_page($page)
{
    global $db;

    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . sqlEscape($page['subject_id']) . "',";
    $sql .= "'" . sqlEscape($page['menu_name']) . "',";
    $sql .= "'" . sqlEscape($page['position']) . "',";
    $sql .= "'" . sqlEscape($page['visible']) . "',";
    $sql .= "'" . sqlEscape($page['content']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function update_page($page)
{
    global $db;

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='" . sqlEscape($page['subject_id']) . "', ";
    $sql .= "menu_name='" . sqlEscape($page['menu_name']) . "', ";
    $sql .= "position='" . sqlEscape($page['position']) . "', ";
    $sql .= "visible='" . sqlEscape($page['visible']) . "', ";
    $sql .= "content='" . sqlEscape($page['content']) . "' ";
    $sql .= "WHERE id='" . sqlEscape($page['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function delete_page($id)
{
    global $db;
    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
