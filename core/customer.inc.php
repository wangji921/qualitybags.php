<?php
require_once 'data.inc.php';

class Customer
{
    public static function displayUsers()
    {
        global $db;
        $sql = 'SELECT * FROM Users ORDER BY ID';
        $result = $db->query($sql);

        //$output[] = '<ul>';
        while ($row = $result->fetch()) {
            echo '<tr>
                    <td>
                        ' . $row['Id'] . '
                    </td>
                    <td>
                        ' . $row['Email'] . '
                    </td>
                    <td>
                        ' . $row['UserName'] . '
                    </td>
                    <td>
                        ' . $row['Address'] . '
                    </td>
                    <td>
                        ' . $row['UserDefaultNumber'] . '
                    </td>
                    <td>
                        ' . $row['UserSecondNumber'] . '
                    </td>
                    <td>
                        ' . $row['UserThirdNumber'] . '
                    </td>
                    <td>';
            if ($row['Enabled'] == 1) {
                echo '<input checked="checked" class="check-box" disabled="disabled" type="checkbox" /></td><td>
                        <form method="post"><input type="submit" value="Disable User" class="btn btn-primary btn-xs"><input name="DisableId" type="hidden" value="' . $row['Id'] . '" />
                        <input name="Email" type="hidden" value="' . $row['Email'] . '" /></form></td>
                    </tr>';
            }
            if ($row['Enabled'] == 0) {
                echo '<input class="check-box" disabled="disabled" type="checkbox" /></td><td>
                        <form method="post"><input type="submit" value="Enable User" class="btn btn-primary btn-xs"><input name="EnableId" type="hidden" value="' . $row['Id'] . '" />
                        <input name="Email" type="hidden" value="' . $row['Email'] . '" /></form></td>
                    </tr>';
            }
        }
    }

    public static function DisableUser()
    {
        global $db;
        $sql = "UPDATE Users SET Enabled = 0 WHERE Id = " . $_POST['DisableId'];
        //echo $sql;
        if ($result = $db->query($sql)) {
            echo "<div class='text-center'><div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                    <strong>Success!</strong> The customer " . $_POST['Email'] . " was <strong>disabled</strong> successfully.</div></div>";
        }
    }

    public static function EnableUser()
    {
        global $db;
        $sql = "UPDATE Users SET Enabled = 1 WHERE Id = " . $_POST['EnableId'];
        //echo $sql;
        if ($result = $db->query($sql)) {
            echo "<div class='text-center'><div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                <strong>Success!</strong> The customer " . $_POST['Email'] . " was <strong>enabled</strong> successfully.</div></div>";
        }
    }

    public static function checkLoginStatus() {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['flag'])) {
            if ($_SESSION['flag'] == true) {
                $redirect_page = "http://php.jasonwong.co.nz/qualitybags/index.php";
                header("Location: ".$redirect_page);
                echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$redirect_page.'">';
                exit();
            }
        }


    }

    public static function addUsers()
    {
        global $db;
        $sql = "SELECT * FROM Users WHERE Email = '" . $_POST['Email'] . "'";
        $result = $db->query($sql);

        $counter = $result->size();
        if ($counter == 1) {
            echo '<h1>Something wrong</h1>
                        <p>Your email address <kbd>'.$_POST[Email].'</kbd> has already registered.</p>
                        <p>Please try <a href="index.php?content_page=Login" class="btn btn-primary btn-xs">Log-in</a> with your account</p>
                        <p>If you forget your password, please contact our customer service.</p>';
        }
        else {
            $sql = "INSERT INTO Users
                (UserName, Address, Email, Enabled, Password, UserDefaultNumber, UserSecondNumber, UserThirdNumber)
                VALUES ('" . $_POST['Name'] . "', '"
                . $_POST['Address'] . "', '"
                . $_POST['Email'] . "', 1, '"
                . $_POST['Password'] . "', '"
                . $_POST['UserDefaultNumber'] . "', '"
                . $_POST['UserSecondNumber'] . "', '"
                . $_POST['UserThirdNumber'] . "')";
            //echo $sql;
            if ($result = $db->query($sql)) {
                echo '<h1>Thanks for Registering!</h1>
                        <p>We have sent you an email to your email address: <kbd>'.$_POST['Email'].'</kbd></p>
                        <p>You can <a href="index.php?content_page=Login" class="btn btn-primary btn-xs">Log-in</a> and start shopping now.</p>';
            }

            date_default_timezone_set("Pacific/Auckland");
            mail($_POST['Email'],"Quality Bags: Registration Successful","Dear ".$_POST['Name']."\n\nYour account has successfully created.\n\nYour username is:\n\n".$_POST['Email']."\n\nKind regards,\nQuality Bags Customer Service","FROM: Support@qualitybags.co.nz");

        }

    }

    public static function needLogin() {
        if (!isset($_SESSION)) {
            session_start();
        }

        $redirect_page = "http://php.jasonwong.co.nz/qualitybags/index.php?content_page=Login";

        if (!isset($_SESSION['flag'])) {
            echo '<h2>You need to login first</h2><h4>Redirecting to log-in, or <a href="index.php?content_page=Login">click here.</a></h4>';
            echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$redirect_page.'">';
            exit();
        }

        if ($_SESSION['flag'] == false) {
            header("Location: ".$redirect_page);
            echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$redirect_page.'">';
            exit();
        }

    }

    public static function UserDetails() {
        if (!isset($_SESSION)) {
            session_start();
        }

        global $db;
        $sql = "SELECT * FROM Users WHERE Email = '" . $_SESSION['current_user'] . "'";
        $result = $db->query($sql);

        while ($row = $result->fetch()) {
            echo '
        <dt>Email:</dt>
        <dd>
            ' . $row['Email'] . '
        </dd>

        <dt>Name:</dt>
        <dd>
            <p>' . $row['UserName'] . '</p>
        </dd>

        <dt>Address:</dt>
        <dd>
            <p>' . $row['Address'] . '</p>
        </dd>

        <dt>Default Number:</dt>
        <dd>
            <p>' . $row['UserDefaultNumber'] . '</p>
        </dd>

        <dt>Work Number:</dt>
        <dd>
            <p>' . $row['UserSecondNumber'] . '</p>
        </dd>
        
        <dt>Home Number:</dt>
        <dd>
            <p>' . $row['UserThirdNumber'] . '</p>
        </dd>';
        }
    }

    public static function getUserOrders() {
        if (!isset($_SESSION)) {
            session_start();
        }

        global $db;
        $sql = "SELECT * FROM Users, Orders WHERE Orders.UserId = Users.Email AND Email = '" . $_SESSION['current_user'] . "'";
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
                    </td>';
            if ($row['Status'] == 1) {
                echo '<td>
                        <kbd>Shipped <span class="glyphicon glyphicon-ok"></span></kbd>
                        </td>
                    ';
            }
            if ($row['Status'] == 0) {
                echo '<td>
                        <kbd>Waiting <span class="glyphicon glyphicon-transfer"></span></kbd>
                        </td>
                    ';
            }
            echo '<td><a class="btn btn-primary btn-xs" href="index.php?content_page=myaccount&detail='.$row['OrderId'].'">Order Detail</a> </td></tr>';
        }
    }

    public static function orderDetails()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        global $db;

        echo '<h2>Account Summary -> Order Details <a class="btn btn-info pull-right" href="index.php?content_page=myaccount"><span class="glyphicon glyphicon-menu-left"></span> Back to Your Account</a></h2>
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
                  AND Orders.OrderId = ".$_GET['detail']."
                  AND UserId = '".$_SESSION['current_user']."'";
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
        <a class="btn btn-info" href="index.php?content_page=myaccount"><span class="glyphicon glyphicon-menu-left"></span> Back to Your Account</a>
    </div>';
    }
}