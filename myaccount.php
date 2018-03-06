<?php
require_once 'core/customer.inc.php';

Customer::needLogin();

if (isset($_GET['detail']) && $_GET['detail'] != '') {
    Customer::orderDetails();
}
else {
    echo '<h2>Account Summary</h2>

<div>
    <h4>Welcome back!</h4>
    <hr />
    <dl class="dl-horizontal">
        ';

    Customer::UserDetails();

    echo '
    </dl>
</div>
<p>&nbsp;</p>
<h2>Your Orders</h2>

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
            Status
        </th>
        <th>
        Detail
        </th>
    </tr>
    </thead>
    <tbody>
    ';
    Customer::getUserOrders();
    echo '
    </tbody>
</table>';
}