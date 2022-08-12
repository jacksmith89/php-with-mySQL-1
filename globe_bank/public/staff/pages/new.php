<?php require_once("../../../private/initialize.php");

$menu_name = '';
$position = '';
$visible = '';

if (is_post_request()) {
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Form parameters<br>";
    echo "Menu name: " . $menu_name . "<br>";
    echo "Position: " . $position . "<br>";
    echo "Visible: " . $visible . "<br>";
}
?>

<?php $page_title = "Create Page"; ?>
<?php include(SHARED_PATH . "/staff-header.php") ?>
<div id="content">
    <a href="<?php echo url_for("/staff/pages/index.php") ?>" class="back-link">&laquo; Back to List</a>
    <div class="page new">
        <h1>Create Page</h1>
        <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd>
                    <input type="text" name="menu_name" value="<?php echo h($menu_name); ?>">
                </dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position" id="">
                        <option value="1" <?php if ($position == "1") {
                                                echo " selected";
                                            } ?>>1</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <!-- Aug 10, 2022 17:52:49 using the first line here, "hidden" etc, is a way to avoid having no value if the "visible" checkbox is left unchecked. -->
                    <input type="hidden" name="visible" value="0">
                    <input type="checkbox" name="visible" value="1" <?php if ($visible == "1") {
                                                                        echo " checked";
                                                                    } ?>>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Subject">
            </div>
        </form>
    </div>
</div>
<?php include(SHARED_PATH . "/staff-footer.php") ?>