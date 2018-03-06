<?php
require_once 'CheckLogin.php';
require_once 'core/product.inc.php';
?>

<h2>Product Management</h2>

<p class="text-right">
    <a class="btn btn-info btn-sm" href="index.php?content_page=AddProduct"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; New Product</a>
</p>

<?php
if (isset($_POST['ProductName']) && ($_POST['ProductName'] != '')) {
    Product::addProduct();
}
?>
<table class="table">
    <thead>
    <tr>
        <th>
            ID
        </th>
        <th class="col-lg-2">
            Image
        </th>
        <th>
            Name
        </th>
        <th class="col-lg-4">
            Description
        </th>
        <th>
            Price
        </th>
        <th>
            Supplier
        </th>
        <th>
            Category
        </th>
    </tr>
    </thead>
    <tbody>
    <?php Product::displayProduct() ?>
    </tbody>
</table>
