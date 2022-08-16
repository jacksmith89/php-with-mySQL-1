<!-- Jul 12, 2022 08:53:12 show.php is the script that runs when "View" in the Subjects page is clicked.-->
<?php require_once("../../../private/initialize.php"); ?>
<?php $page_title = "pageTitle"; ?>
<?php include(SHARED_PATH . "/staff-header.php") ?>
<!-- Jul 10, 2022 12:13:47 Below is the "Null Coalescing Operator", "??". If the first operand is null or doesn't exist, it returns the second operand. This is essentially a shorthand version of "Is this variable set? If not, print this instead". Only works in PHP 7 or higher. -->
<?php $id = $_GET['id'] ?? '1';

//Aug 14, 2022 10:46:26 Walking through the whole thing again: the variable $sql will hold the sql code/query/statement that we're going to use, and it's one of the arguments we'll pass into the premade mysqli_query() method. We're using "procedural style", which includes the connection as the first argument for mysqli_query(), which in our case is the variable $db, created in initialize.php; $db is a variable that holds the db_connect() function created in database.php, which holds our credentials and the mysqli_connect() method, and returns the variable $connection; we're setting the value returned by the mysqli_query() method to the variable $result, which we'll pass into the mysqli_fetch_assoc() method to return an associative array of the data we requested in our mysqli_query(), and set that associative array to the variable $subject, which we'll use on this page.
//$sql = "SELECT * FROM subjects ";
//Aug 14, 2022 10:44:24 We're adding single quotes to the string around the variable of $id;
$subject = find_subject_by_id($id);
?>
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
        <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>
        <dl>
            <dt>Menu Name</dt>
            <dd><?php echo h($subject['menu_name']); ?></dd>
        </dl>
        <dl>
            <dt>Position</dt>
            <dd><?php echo h($subject['position']); ?></dd>
        </dl>
        <dl>
            <dt>Visible</dt>
            <dd><?php echo h($subject['visible']); ?></dd>
        </dl>
    </div>
</div>
<?php include(SHARED_PATH . "/staff-footer.php") ?>