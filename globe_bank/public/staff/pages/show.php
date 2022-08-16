<!-- Jul 12, 2022 18:09:44 Like in /subjects, this is the script that will run when "View" is clicked on the table on the "Pages" page. -->
<?php require_once("../../../private/initialize.php"); ?>
<!-- Jul 12, 2022 18:11:23 We'll use a null coalescing operator to check if the id exists, if not it will get a default value of "1". -->
<?php $page_title = "Show Page"; ?>
<?php include(SHARED_PATH . "/staff-header.php") ?>
<?php $id = $_GET["id"] ?? "1";
$page = find_page_by_id($id);
?>
<div id="content">
    <!-- A double backwards arrow is &laquo; -->
    <a href="<?php echo url_for("/staff/pages/index.php") ?>" class="back-link">&laquo; Back to pages.</a>
    <div class="page show">
        <h1>Page: <?php echo h($page['menu_name']); ?></h1>
        <dl>
            <dt>Subject Name</dt>
            <dd><?php $subject = find_subject_by_id($page["subject_id"]);
                echo $subject["menu_name"] ?></dd>
        </dl>
        <dl>
            <dt>Page Name</dt>
            <dd><?php echo h($page['menu_name']); ?></dd>
        </dl>

        <dl>
            <dt>Position</dt>
            <dd><?php echo h($page['position']); ?></dd>
        </dl>
        <dl>
            <dt>Visible</dt>
            <dd><?php echo h($page['visible']); ?></dd>
        </dl>
        <dl>
            <dt>Content</dt>
            <dd><?php echo h($page['content']); ?></dd>
        </dl>
    </div>
</div>
<?php include(SHARED_PATH . "/staff-footer.php") ?>