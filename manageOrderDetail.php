<?php
require_once 'CheckLogin.php';
require_once 'core/order.inc.php';
?>

<h2>Order Management -> Order Details</h2>

<?php
if (isset($_GET['detail']) && ($_POST['detail'] != '')) {
    Order::orderDetails();
}
?>

