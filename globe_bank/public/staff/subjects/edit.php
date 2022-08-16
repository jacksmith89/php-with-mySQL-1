<!-- Aug 10, 2022 18:00:33 "Edit" and "Create" forms will be created almost identical, but "edit" forms will need to access the database to pull existing data for modification. -->
<!-- Aug 10, 2022 18:32:37 Now we're making edit.php into a single-page form, so that we can see the form data that exists and/or that we're trying to edit, I think. -->
<?php require_once("../../../private/initialize.php");

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {
    $subject = [];
    $subject['id'] = $id;
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '';

    $result = update_subject($subject);
    redirect_to(url_for('/staff/subjects/show.php?id=' . $id));
} else {
    $subject = find_subject_by_id($id);

    $subject_set = find_all_subjects();
    $subject_count = mysqli_num_rows($subject_set);
    mysqli_free_result($subject_set);
}
?>

<?php $page_title = "Edit Subject"; ?>
<?php include(SHARED_PATH . "/staff-header.php") ?>
<div id="content">
    <a href="<?php echo url_for("/staff/subjects/index.php") ?>" class="back-link">&laquo; Back to List</a>
    <div class="subject edit">
        <h1>Edit Subject</h1>
        <form action="<?php echo url_for("/staff/subjects/edit.php?id=" . h(u($id))) ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd>
                    <input type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>">
                </dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position" id="">
                        <?php
                        for ($i = 1; $i <= $subject_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if ($subject["position"] == $i) {
                                echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <!-- Aug 10, 2022 17:52:49 using the first line here, "hidden" etc, is a way to avoid having no value if the "visible" checkbox is left unchecked. -->
                    <input type="hidden" name="visible" value="0">
                    <input type="checkbox" name="visible" value="1" <?php if ($subject['visible'] == "1") {
                                                                        echo " checked";
                                                                    } ?>>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject">
            </div>
        </form>
    </div>
</div>
<?php include(SHARED_PATH . "/staff-footer.php") ?>