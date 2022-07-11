<!-- Jul 10, 2022 08:54:32 initialize can't be accessed with constants, since that's where the constants are loaded from. -->
<?php require_once("../../private/initialize.php"); ?>

<?php $page_title = "Staff Menu"; ?>
<?php include(SHARED_PATH . "/staff-header.php"); ?>

<div id="content">
    <!-- Main menu -->
    <div id="main-menu">
        <h2>Main Menu</h2>
        <ul>
            <li><a href="<?php echo url_for("/staff/subjects/index.php") ?>">Subjects</a></li>
        </ul>
    </div>
</div>

<?php include(SHARED_PATH . "/staff-footer.php"); ?>