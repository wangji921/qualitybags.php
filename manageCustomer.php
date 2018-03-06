<?php
require_once 'CheckLogin.php';
require_once 'core/customer.inc.php';
?>

<h2>Customer Management</h2>

<p class="text-right hide">
    <a class="btn btn-info" href="index.php?content_page=AddProduct">Add New Customer</a>
</p>

<?php
if (isset($_POST['UserName']) && ($_POST['UserName'] != '')) {
    Customer::addUsers();
}

if (isset($_POST['DisableId']) && ($_POST['DisableId'] != '')) {
    Customer::DisableUser();
}

if (isset($_POST['EnableId']) && ($_POST['EnableId'] != '')) {
    Customer::EnableUser();
}
?>

<table class="table">
    <thead>
    <tr>
        <th>
            ID
        </th>
        <th class="col-lg-2">
            Email
        </th>
        <th>
            Name
        </th>
        <th class="col-lg-3">
            Address
        </th>
        <th>
            Default Number
        </th>
        <th>
            Work Number
        </th>
        <th>
            Home Number
        </th>
        <th>
            Enabled
        </th>
        <th>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php Customer::displayUsers() ?>
    </tbody>
</table>
