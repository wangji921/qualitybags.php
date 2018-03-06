<?php
require_once 'CheckLogin.php';
require_once 'core/order.inc.php';

if (isset($_POST['MarkAsShipped']) && ($_POST['MarkAsShipped'] != '')) {
    Order::MarkAsShipped();
}

if (isset($_POST['MarkAsWaiting']) && ($_POST['MarkAsWaiting'] != '')) {
    Order::MarkAsWaiting();
}

if (isset($_GET['detail']) && ($_GET['detail'] != '')) {
    Order::orderDetails();
} else {
    echo '<h2>Order Management</h2>
<table class="table">
    <thead>
    <tr>
        <th>
            ID
        </th>
        <th>
            Order Date
        </th>
        <th>
            First Name
        </th>
        <th>
            Last Name
        </th>
        <th>
            Address
        </th>
        <th>
            Phone Number
        </th>
        <th>
            Total
        </th>
        <th>
            Detail
        </th>
        <th>
            Status
        </th>
        <th>
        </th>
    </tr>
    </thead>
    <tbody>
    ';

    Order::displayOrder();

    echo '</tbody></table>';
}