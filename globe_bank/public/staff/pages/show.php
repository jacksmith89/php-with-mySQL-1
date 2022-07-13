<!-- Jul 12, 2022 18:09:44 Like in /subjects, this is the script that will run when "View" is clicked on the table on the "Pages" page. -->
<?php require_once("../../../private/initialize.php"); ?>
<!-- Jul 12, 2022 18:11:23 We'll use a null coalescing operator to check if the id exists, if not it will get a default value of "1". -->
<?php $id = $_GET["id"] ?? "1"; ?>
<?php $page_title = "Show Page"; ?>
<?php include(SHARED_PATH . "/staff-header.php") ?>
<div id="content">
    <!-- A double backwards arrow is &laquo; -->
    <a href="<?php echo url_for("/staff/pages/index.php") ?>" class="back-link">&laquo; Back to pages.</a>
    <div class="page show">
        Page ID: <?php echo h($id); ?>
    </div>
</div>
<?php include(SHARED_PATH . "/staff-footer.php") ?>