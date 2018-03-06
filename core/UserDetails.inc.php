<?php
//require 'core.php';
require_once 'data.inc.php';

function checkUserCredentals($inputUsername, $inputPassword) {
    global $db;
    $sql = "SELECT Email, Password FROM Users Where Email='".$inputUsername."' AND Password='".$inputPassword."'";
    $result = $db->query($sql);

    $counter = $result->size();
    if ($counter > 0) {
        //authentication succeeded
        return (true);
    }
    else {
        //authentication failed
        return (false);
    }
}

function checkUserEnable($inputUsername, $inputPassword) {
    global $db;
    $sql = "SELECT * FROM Users Where Email='".$inputUsername."' AND Password='".$inputPassword."'";
    $result = $db->query($sql);

    $row = $result->fetch();

    if ($row['Enabled'] == 1) {
        return true;
    }
    else {
        return false;
    }
}


function checkUserCredentals_old($inputUsername, $inputPassword) {
    /*
    This function takes input username and password as parameters and
    returns TRUE if the user is authenticated, FALSE if the user is not authenticated
    */

    // create connection
    $mysqli = new mysqli("localhost", "qualitybags", "8ecy6Ex99emx", "qualitybags");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    // query the users table for name and surname
    $sql = "SELECT Email, Password FROM Users Where Email='".$inputUsername."' AND Password='".$inputPassword."'";

    //Execute query
    $rs=$mysqli->query($sql);
    if (!$rs)
    {exit("Error in SQL");}

    //Count the record number
    $counter = $rs->num_rows;

    if ($counter > 0)
    {
        //authentication succeeded
        return (true);
    }
    else
    {
        //authentication failed
        return (false);
    }
}
