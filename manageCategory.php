<?php
require_once 'CheckLogin.php';
require_once 'core/category.inc.php';
?>

<h2>Category Management</h2>

<p class="text-right">
    <a class="btn btn-info btn-sm" href="index.php?content_page=AddCategory"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Category</a>
</p>

<?php
if (isset($_POST['CategoryName']) && ($_POST['CategoryName'] != '')) {
    Category::addCategory();
}
?>
<table class="table">
    <thead>
    <tr>
        <th>
            ID
        </th>
        <th>
            Name
        </th>
        <th>
            Description
        </th>
    </tr>
    </thead>
    <tbody>
    <?php Category::displayCategory() ?>
    </tbody>
</table>
