<!-- Jul 12, 2022 08:53:12 show.php is the script that runs when "View" in the Subjects page is clicked.-->
<?php require_once("../../../private/initialize.php"); ?>
<?php $page_title = "pageTitle"; ?>
<?php include(SHARED_PATH . "/staff-header.php") ?>
<!-- Jul 10, 2022 12:13:47 Below is the "Null Coalescing Operator", "??". If the first operand is null or doesn't exist, it returns the second operand. This is essentially a shorthand version of "Is this variable set? If not, print this instead". Only works in PHP 7 or higher. -->
<?php $id = $_GET['id'] ?? '1'; ?>
<!-- PHP > 7 -->

<!-- Jul 10, 2022 12:20:24 Another shorthand option using a ternary expression, where the "?" and ":" are essentially "if" and "else".
$id = isset($_GET['id']) ? $_GET['id'] : '1'; -->

<!-- Jul 10, 2022 12:19:45 Longhand way of checking whether $id is set, and providing a default value if not.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '1';
} -->
<div id="content">
    <a href="<?php echo url_for("/staff/subjects/index.php") ?>" class="back-link">&laquo; Back to Subjects.</a>
    <!-- Jul 12, 2022 09:26:58 check functions.php for notes on h(). -->
    <div class="subject show">
        <?php echo h($id); ?>
        <a href="show.php?name=<?php echo u('John Doe'); ?>">Link</a><br>
        <a href="show.php?company=<?php echo u('Widgets&More'); ?>">Link</a><br>
        <a href="show.php?query=<?php echo u('!#*?'); ?>">Link</a><br>
    </div>
</div>
<?php include(SHARED_PATH . "/staff-footer.php") ?>