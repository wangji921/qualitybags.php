<?php
ob_start();
session_start();

require_once 'core/shoppingcart.inc.php';
ShoppingCart::processActions();

$redirect_page = "http://php.jasonwong.co.nz/qualitybags/index.php?content_page=Product";

//redirect the user to product page
header("Location: ".$redirect_page);
