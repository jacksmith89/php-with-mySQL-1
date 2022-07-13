<?php require_once("../../../private/initialize.php");

$test = $_GET["test"] ?? '';
if ($test == "404") {
    error_404();
} elseif ($test == "500") {
    error_500();
} else {
    echo "No error";
}
?>

<?php $page_title = "pageTitle"; ?>
<?php include(SHARED_PATH . "/staff-header.php") ?>
<div id="content">

</div>
<?php include(SHARED_PATH . "/staff-footer.php") ?>