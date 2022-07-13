<!-- Jul 12, 2022 09:31:20
"Add a Page" Challenge
- link from /staff/index.php to /staff/pages/index.php, similar to the link to subjects/index.php Jul 12, 2022 09:47:12 Done
- build staff/pages/index.php, making sure to:
    - include initialize.php Jul 12, 2022 10:01:34 Done
    - the header Jul 12, 2022 18:07:38 Done
    - the footer Jul 12, 2022 18:07:42 Done
    - a table to list the pages Jul 12, 2022 18:07:46 Done
- no copy-pasting from subjects/index.php
- to build the table, we'll need a $pages variable that contains an array of pages
- create staff/pages/show.php (just like for /subjects) and link to it through pages/index.php
- use file path techniques like include and require
- use URL techniques like WWW_ROOT
- encode any dynamic data for links and HTML
- set $page_title for each page so the header populates correctly-->

<!-- Jul 12, 2022 09:46:05 First, we're going to require_once initialize; this will bring in all the other functions we've built -->
<?php require_once("../../../private/initialize.php") ?>
<!-- Jul 12, 2022 10:06:57 set $page_title, idk why this wasn't higher up on the list . . . -->
<?php $page_title = "Pages"; ?>
<!-- Jul 12, 2022 09:48:24 We'll include the header, using the URL technique SHARED_PATH to shortcut to the "shared" folder. I've included the slash at the start, but I think SHARED_PATH should fill it in if I forget. Jul 12, 2022 09:50:34 Nope! That's just with WWW_ROOT.-->
<?php include(SHARED_PATH . "/staff-header.php") ?>
<?php $pages = [
    ["id" => "1", "position" => "1", "visible" => "1", "menu_name" => "Globe Bank"],
    ["id" => "2", "position" => "2", "visible" => "1", "menu_name" => "About Us"],
    ["id" => "3", "position" => "3", "visible" => "1", "menu_name" => "History"],
    ["id" => "4", "position" => "4", "visible" => "1", "menu_name" => "Contact Us"],
] ?>

<!-- div#content for styling -->
<div id="content">
    <!-- I'm not sure what either of these classes is for, I don't see them in the stylesheet -->
    <div class="pages listing">
        <h1>Pages</h1>
        <!-- .actions is indeed in the stylesheet -->
        <div class="actions">
            <a href="" class="action">Create New Page</a>
            <!-- .list is also in the stylesheet -->
            <table class="list">
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th colspan="4">Name</th>
                </tr>
                <!-- Jul 12, 2022 10:12:38 in the next row, we'll put the foreach loop that will get the data from our array $pages, which I'll build now. -->
                <?php foreach ($pages as $page) { ?>
                    <tr>
                        <td><?php echo h($page["id"]); ?></td>
                        <td><?php echo h($page["position"]); ?></td>
                        <td><?php echo $page["visible"] == 1 ? "true" : "false"; ?></td>
                        <td><?php echo h($page["menu_name"]); ?></td>
                        <td><a href="<?php echo url_for("/staff/pages/show.php?id=") . h(u($page["id"])); ?>" class="action">View</a></td>
                        <td><a href="<?php echo url_for(""); ?>">Edit</a></td>
                        <td><a href="<?php echo url_for(""); ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . "/staff-footer.php") ?>