<?php
session_start();
session_destroy();
//echo var_dump($_SESSION);
//redirect the user to the correct page
//if (isset($_SESSION['request_page']))
//    $redirect_page = "http://php.jasonwong.co.nz/qualitybags/index.php?content_page=".$_SESSION['request_page'];
//else
    $redirect_page = "http://php.jasonwong.co.nz/qualitybags/index.php";

//redirect the user to the correct page after login
header("Location: ".$redirect_page);


