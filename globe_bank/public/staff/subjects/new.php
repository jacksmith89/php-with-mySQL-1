<?php require_once("../../../private/initialize.php");

$subject_set = find_all_subjects();
// Aug 15, 2022 10:47:36 we're adding +1 so that the new subject defaults to a position one higher than the current number of subjects.
$subject_count = mysqli_num_rows($subject_set) + 1;
mysqli_free_result($subject_set);

$subject = [];
$subject["position"] = $subject_count;

$test = $_GET["test"] ?? '';
if ($test == "404") {
    error_404();
} elseif ($test == "500") {
    error_500();
} elseif ($test == 'redirect') {
    redirect_to(url_for("/staff/subjects/index.php"));
}
?>

<?php $page_title = "Create Subject"; ?>
<?php include(SHARED_PATH . "/staff-header.php") ?>
<div id="content">
    <a href="<?php echo url_for("/staff/subjects/index.php") ?>" class="back-link">&laquo; Back to List</a>
    <div class="subject new">
        <h1>Create Subject</h1>
        <form action="<?php echo url_for('/staff/subjects/create.php'); ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd>
                    <input type="text" name="menu_name" value="">
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
                    <input type="checkbox" name="visible" value="1">
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Subject">
            </div>
        </form>
    </div>
</div>
<?php include(SHARED_PATH . "/staff-footer.php") ?>