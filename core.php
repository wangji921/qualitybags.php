<?php
$mysqli = new mysqli("localhost", "qualitybags", "8ecy6Ex99emx", "qualitybags");

function nav_login_check() {
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['flag']) || ($_SESSION['flag'] == false)) {
        echo "<ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"#\" id=\"shoppingcart\" title=\"Shopping Cart\"><span class=\"glyphicon glyphicon-shopping-cart\"></span>&nbsp;CART&nbsp;<span class=\"caret\"></span></a></li>
                    <li><a href=\"index.php?content_page=Register\"><span class=\"glyphicon glyphicon-user\"></span>&nbsp;REGISTER</a></li>
                    <li><a href=\"index.php?content_page=Login\"><span class=\"glyphicon glyphicon-log-in\"></span>&nbsp;LOG IN</a></li>
                </ul>";
    } else {
        echo "<ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"#\" id=\"shoppingcart\" title=\"Shopping Cart\"><span class=\"glyphicon glyphicon-shopping-cart\"></span>&nbsp;CART&nbsp;<span class=\"caret\"></span></a></li>
                    <li><a href=\"index.php?content_page=myaccount\"><span class=\"glyphicon glyphicon-user\"></span>&nbsp;$_SESSION[current_user]</a></li>
                    <li><a href=\"logoff.php\"><span class=\"glyphicon glyphicon-log-out\"></span>&nbsp;LOG OFF</a></li>
                </ul>";
    }
}

function nav_admin_panel() {
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['flag']) && isset($_SESSION['role'])) {
        if ((isset($_SESSION['flag']) || ($_SESSION['flag'] == true)) && $_SESSION['role'] == 'admin') {
            echo "<li>
                <a data-target=\"#\" data-toggle=\"dropdown\" href=\"#\">MANAGE <span class=\"caret\"></span></a>
                <ul class=\"dropdown-menu\" aria-labelledby=\"drop_manage\">
                    <li><a href=\"index.php?content_page=manageProduct\">Product</a> </li>
                    <li><a href=\"index.php?content_page=manageCustomer\">Customer</a></li>
                    <li><a href=\"index.php?content_page=manageSupplier\">Supplier</a></li>
                    <li><a href=\"index.php?content_page=manageCategory\">Category</a></li>
                    <li><a href=\"index.php?content_page=manageOrder\">Order</a></li>
                </ul>
            </li>";
        }
    }
}