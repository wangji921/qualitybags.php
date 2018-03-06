<?php
require_once 'CheckLogin.php';
require_once 'core/supplier.inc.php';
?>

<h2>Supplier Management</h2>

<p class="text-right">
    <a class="btn btn-info btn-sm" href="index.php?content_page=AddSupplier"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; New Supplier</a>
</p>

<?php
if (isset($_POST['Address']) && ($_POST['Address'] != '')) {
    Supplier::addSupplier();
}
?>
<table class="table">
    <thead>
    <tr>
        <th>
            ID
        </th>
        <th>
            Supplier Name
        </th>
        <th>
            Address
        </th>
        <th>
            Email
        </th>
        <th>
            Default Phone
        </th>
        <th>
            Mobile Phone
        </th>
        <th>
            Work Phone
        </th>
    </tr>
    </thead>
    <tbody>
    <?php Supplier::displaySupplier() ?>
    </tbody>
</table>
