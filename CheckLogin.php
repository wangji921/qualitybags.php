<?php
if(!isset($_SESSION))
{
    session_start();
}

//checking if user is not authenticated
if (!isset($_SESSION['flag']) || ($_SESSION['flag'] == false) || ($_SESSION['role'] != 'admin'))
{
    if (!$_GET['content_page'])
    {
        $full_name = $_SERVER['PHP_SELF'];
        $full_name = str_replace(".php","",$full_name);
        $full_name = str_replace("/qualitybags/","",$full_name);
    }
    else
    {
        //save the current page name from the input parameter of index.php
        $full_name = $_GET['content_page'];
    }

    //Save the file name requested initially
    $_SESSION['request_page'] = $full_name;
    //redirecting user to the login page
    header("Location: http://php.jasonwong.co.nz/qualitybags/index.php?content_page=Login");
    exit();
}

