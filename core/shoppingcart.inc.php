<?php
require_once('data.inc.php');

class ShoppingCart {
    public static function showShoppingCart() {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }

        if (!isset($cart) || $cart == '') {
            echo '<div class="shoppingcart">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12"><h3>Your shopping cart is empty.</h3></div>
                        </div>
                        <p></p>
                        <button id="shoppingcart_close" class="btn btn-danger btn-sm">Close&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span></button>
                    </div>
                </div>';
        } else {
            global $db;
            $cart = $_SESSION['cart'];
            if ($cart) {
                $items = explode(',',$cart);
                $contents = array();
                $total = 0;
                foreach ($items as $item) {
                    $contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
                }
                $output[] = '<div class="shoppingcart">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12"><h3>Shopping Cart</h3><hr /></div>
                                        <br />
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1"><p>ID</p></div>
                                        <div class="col-sm-7"><p>Product</p></div>
                                        <div class="col-sm-2 text-center">Qty</div>
                                        <div class="col-sm-2 text-right">Price</div>
                                    </div>';


                $output[] = '<form action="cart.php?action=update" method="post" id="cart">';
                foreach ($contents as $id=>$qty) {
                    $sql = 'SELECT * FROM Product, Category WHERE Product.CategoryID = Category.CategoryID AND ProductID = '.$id;
                    $result = $db->query($sql);
                    $row = $result->fetch();
                    extract($row);
                    $output[] = '<div class="row">';
                    $output[] = '<div class="col-sm-1">'.$id.'</div>';
                    $output[] = '<div class="col-sm-7">'.$ProductName.'&nbsp;<small>*'.$CategoryName.'&nbsp;<a href="cart.php?action=delete&id='.$id.'" title="Remove Product"><span class="glyphicon glyphicon-remove"></span></a></small></div>';
                    $output[] = '<div class="col-sm-2 text-center"><input type="text" hidden name="qty'.$id.'" value="'.$qty.'" />'.$qty.' <a class="btn btn-xs" href="ddd"><span class="glyphicon glyphicon-minus"></span></a></div>';
                    $output[] = '<div class="col-sm-2 text-right">$'.$Price.'</div>';
                    $output[] = '</div>';
                    //$output[] = '<td><input type="text" name="qty'.$id.'" value="'.$qty.'" /></td>';
                    //$output[] = '<td>&pound;'.($price * $qty).'</td>';
                    $total += $Price * $qty;
                }
                $gst = number_format($total * 0.15, 2);
                $subtotal = number_format($total * 0.85,2);

                $output[] = '<div class="row">
                                <div class="col-sm-12"><hr /></div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-5 text-right">Subtotal <small>(Exc. GST):</small></div>
                                <div class="col-sm-3 text-right">$'.$subtotal.'</div>
                    
                                <div class="col-sm-4"></div>
                                <div class="col-sm-5 text-right">GST:</div>
                                <div class="col-sm-3 text-right">$'.$gst.'</div>
                    
                                <div class="col-sm-4"></div>
                                <div class="col-sm-5 text-right">Grand Total <small>(Inc. GST):</small>:</div>
                                <div class="col-sm-3 text-right">$'.$total.'</div>
                                <br />&nbsp;<br />
                                <ul class="list-inline text-right">
                                    <li><button id="shoppingcart_close" class="btn btn-danger btn-sm">Close&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span></button></li>
                                    <li><button class="btn btn-danger btn-sm" type="submit">Update Cart&nbsp;&nbsp;<span class="glyphicon glyphicon-refresh"></span></button></li>
                                    <li><a class="btn btn-danger btn-sm" href="cart.php?action=empty">Empty Cart&nbsp;&nbsp;<span class="glyphicon glyphicon-trash"></span></a></li>
                                    <li><a class="btn btn-danger btn-sm" href="index.php?content_page=checkout">Checkout&nbsp;&nbsp;<span class="glyphicon glyphicon-ok"></span></a></li>
                                </ul>
                            </div>
                            </form>
                        </div>
                    </div>';
            } else {
                $output[] = '<p>You shopping cart is empty.</p>';
            }
            echo join('',$output);
        }

    }


    //Process shopping actions
    public static function processActions() {
        if (isset($_SESSION['cart']))
        {
            $cart = $_SESSION['cart'];
        }

        if (isset($_GET['action']))
        {
            $action = $_GET['action'];
        }

        switch ($action) {
            case 'add':
                if (isset($cart) && $cart!='') {
                    $cart .= ','.$_GET['id'];
                } else {
                    $cart = $_GET['id'];
                }
                break;
            case 'delete':
                if ($cart) {
                    $items = explode(',',$cart);
                    $newcart = '';
                    foreach ($items as $item) {
                        if ($_GET['id'] != $item) {
                            if ($newcart != '') {
                                $newcart .= ','.$item;
                            } else {
                                $newcart = $item;
                            }
                        }
                    }
                    $cart = $newcart;
                }
                break;
            case 'update':
                if ($cart) {
                    $newcart = '';
                    foreach ($_POST as $key=>$value) {
                        if (stristr($key,'qty')) {
                            $id = str_replace('qty','',$key);
                            $items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
                            $newcart = '';
                            foreach ($items as $item) {
                                if ($id != $item) {
                                    if ($newcart != '') {
                                        $newcart .= ','.$item;
                                    } else {
                                        $newcart = $item;
                                    }
                                }
                            }
                            for ($i=1;$i<=$value;$i++) {
                                if ($newcart != '') {
                                    $newcart .= ','.$id;
                                } else {
                                    $newcart = $id;
                                }
                            }
                        }
                    }
                }
                $cart = $newcart;
                break;
            case 'empty':
                $cart = NULL;
                break;
        }
        $_SESSION['cart'] = $cart;
    }

    public static function placeorder() {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }

        if (!isset($cart) || $cart == '') {
            echo '<h1>Checkout</h1>
                    <div>
                        <h3>somthing wrong.</h3>
                        <hr />
                        <h3>Your shopping cart is empty.</h3>
                    </div>';
        } else {
            global $db;
            $cart = $_SESSION['cart'];
            if ($cart) {
                $items = explode(',', $cart);
                $contents = array();
                $total = 0;
                foreach ($items as $item) {
                    $contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
                }

                //get the total price
                foreach ($contents as $id => $qty) {
                    $sql = 'SELECT * FROM Product, Category WHERE Product.CategoryID = Category.CategoryID AND ProductID = ' . $id;
                    $result = $db->query($sql);
                    $row = $result->fetch();
                    extract($row);
                    $total += $Price * $qty;
                }
                $gst = number_format($total * 0.15, 2);
                $subtotal = number_format($total * 0.85,2);

                // insert order record
                $sql = 'INSERT INTO Orders (City, Address, FirstName, LastName, OrderDate, Phone, PostalCode, Status, Total, UserId)
                        VALUES ("'.$_POST['City'].'", "'.$_POST['Address'].'","'.$_POST['FirstName'].'","'.$_POST['LastName'].'","'.date('Y-m-d H:i:s').'",
                        "'.$_POST['Phone'].'","'.$_POST['PostalCode'].'", 0, "'.$total.'","'.$_SESSION['current_user'].'")';

                $insertorder = $db->query($sql);
                $insertorderid = $insertorder->insertID();
                //var_dump($sql);

                // insert order details records
                foreach ($contents as $id => $qty) {
                    $sql = 'SELECT * FROM Product, Category WHERE Product.CategoryID = Category.CategoryID AND ProductID = ' . $id;
                    $result = $db->query($sql);
                    $row = $result->fetch();
                    extract($row);
                    $sql = 'INSERT INTO OrderDetail (OrderId, ProductID, Quantity, UnitPrice)
                                  VALUES ('.$insertorderid.', '.$id.', '.$qty.', '.$Price.')';
                    $db->query($sql);
                }

                // empty the cart
                $cart = NULL;
                $_SESSION['cart'] = null;


                echo '<h2>Thank you For Your Purchase! <span class="glyphicon glyphicon-saved"></span></h2>
                        <div>
                            <h4>The following order will be dispatched as per the details below.</h4>
                            <div class="text-right"><button class="btn btn-primary btn-sm" onclick="window.print();"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print Invoice</button></div>
                            <hr />
                            <dl class="dl-horizontal">
                                <dt>Order ID</dt>
                                <dd>'.$insertorderid.'</dd>';

                // get user info
                $sql = "SELECT * FROM Orders 
                        WHERE OrderId = ".$insertorderid;
                $result = $db->query($sql);

                while ($row = $result->fetch()) {
                    echo '
                            <dt>Order Date</dt>
                            <dd>'.$row['OrderDate'].'</dd>
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
                            <dt>Postal Code
                            </dt>
                            <dd>'.$row['PostalCode'].'
                            </dd>
                            <dt>Total Price
                            </dt>
                            <dd>$'.$row['Total'].'
                            </dd>
                            ';
                }


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
                  AND Orders.OrderId = ".$insertorderid;
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
            <div class="mypadding text-center"><a class="btn btn-info" href="index.php?content_page=myaccount">Back to Your Account</a></div>

            ';
            }
        }
    }
}
