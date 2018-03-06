<?php
require_once 'data.inc.php';
require_once 'ErrorFunctions.php';

class Order
{
    public static function displayOrder()
    {
        global $db;
        $sql = "SELECT * FROM Orders ORDER BY OrderId";
        $result = $db->query($sql);

        while ($row = $result->fetch()) {
            echo '<tr>
                    <td>
                        ' . $row['OrderId'] . '
                    </td>
                    <td>
                        ' . $row['OrderDate'] . '
                    </td>
                    <td>
                        ' . $row['FirstName'] . '
                    </td>
                    <td>
                        ' . $row['LastName'] . '
                    </td>
                    <td>
                        ' . $row['Address'] . '
                    </td>
                    <td>
                        ' . $row['Phone'] . '
                    </td>
                    <td>
                        $' . $row['Total'] . '
                    </td>
                    <td><a href="index.php?content_page=manageOrder&detail='.$row['OrderId'].'" class="btn btn-primary btn-xs">Detail</a></td>
                    ';
            if ($row['Status'] == 1) {
                echo '<td>
                        <form method="post">
                        <a type="button" class="btn btn-success btn-xs" role="button" style="cursor: default;">Shipped <span class="glyphicon glyphicon-ok"></span></a>&nbsp;&nbsp;<input type="submit" value="Mark as Waiting" class="btn btn-primary btn-xs"><input name="MarkAsWaiting" type="hidden" value="' . $row['OrderId'] . '" />
                        </form></td>
                    </tr>';
            }
            if ($row['Status'] == 0) {
                echo '<td>
                        <form method="post"><a type="button" class="btn btn-default btn-xs" role="button" style="cursor: default;">Waiting <span class="glyphicon glyphicon-transfer"></span></a>&nbsp;&nbsp;<input type="submit" value="Mark as Shipped" class="btn btn-primary btn-xs"><input name="MarkAsShipped" type="hidden" value="' . $row['OrderId'] . '" />
                        </form></td>
                    </tr>';
            }
        }
    }

    public static function MarkAsShipped()
    {
        global $db;
        $sql = "UPDATE Orders SET Status = 1 WHERE OrderId = " . $_POST['MarkAsShipped'];
        //echo $sql;

        if ($result = $db->query($sql)) {
            echo "<div class='text-center'><div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                    <strong>Success!</strong> Order ID = " . $_POST['MarkAsShipped'] . " <strong>marked as shipped</strong> successfully.</div></div>";
        }
    }

    public static function MarkAsWaiting()
    {
        global $db;
        $sql = "UPDATE Orders SET Status = 0 WHERE OrderId = " . $_POST['MarkAsWaiting'];
        //echo $sql;

        if ($result = $db->query($sql)) {
            echo "<div class='text-center'><div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                    <strong>Success!</strong> Order ID = " . $_POST['MarkAsWaiting'] . " <strong>marked as waiting</strong> successfully.</div></div>";
        }
    }

    public static function orderDetails()
    {
        global $db;
        $sql = "SELECT * FROM Orders, OrderDetail, Product 
                WHERE Orders.OrderId = OrderDetail.OrderId 
                  AND Product.ProductID = OrderDetail.ProductID 
                  AND Orders.OrderId = ".$_GET['detail'];
        $result = $db->query($sql);

        echo '<h2>Order Management -> Order Details <a class="btn btn-info pull-right" href="index.php?content_page=manageOrder"><span class="glyphicon glyphicon-menu-left"></span> Back to List</a></h2>
                        <div>
                            <h4>Order Details</h4>
                            <div class="text-right"><button class="btn btn-primary btn-sm" onclick="window.print();"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print Invoice</button></div>
                            <hr />
                            <dl class="dl-horizontal">
                                <dt>Order ID</dt>
                                <dd>'.$_GET['detail'].'</dd>';

        // get user info
        $sql = "SELECT * FROM Orders 
                        WHERE OrderId = ".$_GET['detail'];
        $result = $db->query($sql);
        $total = 0;
        while ($row = $result->fetch()) {
            echo '
                            <dt>Order Date</dt>
                            <dd>'.$row['OrderDate'].'</dd>
                            <dt>Order Status</dt>
                            <dd>';
            if ($row['Status'] == 1) {
                echo '<kbd>Shipped</kbd>';
            } else {
                echo '<kbd>Waitting</kbd>';
            }

            echo '</dd>
                            <dt>Customer ID</dt>
                            <dd>'.$row['UserId'].'</dd>
                            <dt>First Name</dt>
                            <dd>'.$row['FirstName'].'</dd>
                            <dt>Last Name</dt>
                            <dd>'.$row['LastName'].'</dd>
                            <dt>Phone Number</dt>
                            <dd>'.$row['Phone'].'</dd>
                            <dt>Address</dt>
                            <dd>'.$row['Address'].'</dd>
                            <dt>City</dt>
                            <dd>'.$row['City'].'</dd>
                            <dt>Postal Code</dt>
                            <dd>'.$row['PostalCode'].'</dd>
                            <dt>Total Price</dt>
                            <dd>$'.$row['Total'].'</dd>
                            ';
            $total = $row['Total'];
        }
        $gst = number_format($total * 0.15, 2);
        $subtotal = number_format($total * 0.85,2);


        echo '<dd><br />
                        <table class="table">
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>';

        $sql = "SELECT * FROM Orders, OrderDetail, Product 
                WHERE Orders.OrderId = OrderDetail.OrderId 
                  AND Product.ProductID = OrderDetail.ProductID 
                  AND Orders.OrderId = ".$_GET['detail'];
        $result = $db->query($sql);

        while ($row = $result->fetch()) {
            echo '<tr>
                            <td>'.$row['ProductID'].'</td>
                            <td>'.$row['ProductName'].'</td>
                            <td>'.$row['Quantity'].'</td>
                            <td>$'.$row['Price'] * $row['Quantity'].'</td>
                        </tr>';
        }
        echo ' 
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <label>Subtotal <small>(Ex. GST)</small> :</label>
                                </td>
                                <td>$ '.$subtotal.'</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><label>GST:</label></td>
                                <td>$ '.$gst.'</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><label>Total <small>(Inc. GST)</small>:</label>
                                </td>
                                <td><p>$'.$total.'</p></td>
                            </tr>
                        </table>
                    </dd>
                </dl>
            
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-sm" onclick="window.print();"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print Invoice</button>
            </div>
            <div class="mypadding text-center">
        <a class="btn btn-info" href="index.php?content_page=manageOrder"><span class="glyphicon glyphicon-menu-left"></span> Back to List</a>
    </div>

            ';
    }
}