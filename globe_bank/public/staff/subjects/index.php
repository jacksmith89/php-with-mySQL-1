<?php require_once("../../../private/initialize.php"); ?>


<?php
// Aug 12, 2022 13:02:32 we're going to now call the find_all_subjects() function from query_functions.php.

$subject_set = find_all_subjects();
// Jul 10, 2022 11:54:55 $subjects will be an array filled with assoc arrays
// $subjects = [
//     ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About Globe Bank'],
//     ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Nose Picking'],
//     ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Removing Sticks From Butts'],
//     ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Customer Service'],
// ]
?>

<?php $page_title = "Subjects"; ?>
<?php include(SHARED_PATH . "/staff-header.php"); ?>

<div id="content">
    <!-- Jul 10, 2022 11:55:02 Inside #content, we're creating a container div with .subjects and .listing (I don't know what those classes will do yet), with a h1 of "Subjects". -->
    <div class="subjects listing">
        <h1>Subjects</h1>

        <!-- Jul 10, 2022 11:56:01 A new container with .actions, containing a link with .action called "Create New Subject", and a table with headings data to be filled by the following php loop. -->
        <div class="actions">
            <a href="<?php echo url_for('/staff/subjects/new.php') ?>" class="action">Create New Subject</a>
            <table class="list">
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th>Name</th>
                    <!-- <th colspan="4">Name</th> -->
                    <!-- These last three heading spaces are empty, but if we're not going to fill them it looks like I could just use colspan instead. -->
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <!-- Jul 10, 2022 11:57:22 A forEach that will loop through the $subjects array. I think we put a closing tag after the opening code bracket so we could put php tags inside each td element, but it still looks very weird to me. -->
                <!-- Jul 10, 2022 17:47:54 Update: Kyle says this is indeed best practice. -->
                <!-- Jul 10, 2022 12:01:53 The loop will fill the table according to the assoc arrays inside $subjects; I assume we're going to find a way to quickly add additional assoc arrays to $subjects, and eventually move $subjects to a database instead of being in the code. -->
                <!-- Aug 12, 2022 13:18:04 Now we're drawing from the database to create the table! The while loop will run through the associative array derived from $subject_set (which we got from the query at the top of the page) to populate the data. -->
                <?php while ($subject = mysqli_fetch_assoc($subject_set)) { ?>
                    <tr>
                        <td><?php echo h($subject["id"]); ?></td>
                        <td><?php echo h($subject["position"]); ?></td>
                        <!-- Jul 10, 2022 12:03:45 Reminder: this is a shorthand if statement. -->
                        <td><?php echo $subject["visible"] == 1 ? 'true' : 'false'; ?></td>
                        <td><?php echo h($subject["menu_name"]); ?></td>
                        <td><a href="<?php echo url_for("/staff/subjects/show.php?id=" . h(u($subject["id"]))); ?>" class="action">View</a></td>
                        <td><a href="<?php echo url_for("/staff/subjects/edit.php?id=" . h(u($subject["id"]))); ?>" class="action">Edit</a></td>
                        <td><a href="<?php echo url_for("/staff/subjects/delete.php?id=" . h(u($subject["id"]))); ?>" class="action">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
            <!-- Aug 12, 2022 12:57:27 Here we're releasing the data that we called with $sql above. -->
            <?php
            mysqli_free_result($subject_set);
            ?>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . "/staff-footer.php"); ?>