<!-- Aug 10, 2022 18:00:33 "Edit" and "Create" forms will be created almost identical, but "edit" forms will need to access the database to pull existing data for modification. -->
<!-- Aug 10, 2022 18:32:37 Now we're making edit.php into a single-page form, so that we can see the form data that exists and/or that we're trying to edit, I think. -->
<?php require_once("../../../private/initialize.php");

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {
    $page = [];
    $page['id'] = $id;
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $result = update_page($page);
    redirect_to(url_for('/staff/pages/show.php?id=' . $id));
} else {
    $page = find_page_by_id($id);

    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);
}
?>

<?php $page_title = "Edit Page"; ?>
<?php include(SHARED_PATH . "/staff-header.php") ?>
<div id="content">
    <a href="<?php echo url_for("/staff/pages/index.php") ?>" class="back-link">&laquo; Back to List</a>
    <div class="subject edit">
        <h1>Edit Page</h1>
        <form action="<?php echo url_for("/staff/pages/edit.php?id=" . h(u($id))) ?>" method="post">
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject_id" id"">
                        <?php
                        $subject_set = find_all_subjects();
                        while ($subject = mysqli_fetch_assoc($subject_set)) {
                            echo "<option value=\"" . h($subject['id']) . "\"";
                            if ($page["subject_id"] == $subject['id']) {
                                echo " selected";
                            }
                            echo ">" . h($subject['menu_name']) . "</option>";
                        }
                        mysqli_free_result($subject_set);
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dl>
                    <dt>Menu Name</dt>
                    <dd>
                        <input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>">
                    </dd>
                </dl>
                <dl>
                    <dt>Position</dt>
                    <dd>
                        <select name="position" id="">
                            <?php
                            for ($i = 1; $i <= $page_count; $i++) {
                                echo "<option value=\"{$i}\"";
                                if ($page["position"] == $i) {
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
                        <input type="checkbox" name="visible" value="1" <?php if ($page['visible'] == "1") {
                                                                            echo " checked";
                                                                        } ?>>
                    </dd>
                </dl>
                <dl>
                    <dt>Content</dt>
                    <dd>
                        <textarea name="content" cols="60" rows="10"><?php echo h($page['content']); ?></textarea>
                    </dd>
                </dl>
                <div id="operations">
                    <input type="submit" value="Edit Page">
                </div>
        </form>
    </div>
</div>
<?php include(SHARED_PATH . "/staff-footer.php") ?>