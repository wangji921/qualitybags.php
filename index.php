<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Quality Bags</title>
    <meta name="description" content="This website is for the assignment 2 of ISCG7420">
    <meta name="keywords" content="Quality Bags">
    <meta name="author" content="Ji Wang (Student ID: 1472041)">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/site.css" />
</head>
<!-- File Heading
Name:	    index.php
Purpose:	Display a supplied content page with the defined master page
            This is the main page to implement the master page concept in PHP
Author:		Ji Wang 1472041
History:	12/06/2017
-->
<body id="myBody">

<?php
//Retrieve the requested content page name and construct the file name
if (isset($_GET['content_page']))
{
    $page_name = $_GET['content_page'];
    $page_content = $page_name.'.php';
}
elseif (isset($_POST['content_page']))
{
    $page_name = $_POST['content_page'];
    $page_content = $page_name.'.php';
}
else
{
    $page_content = 'HomePage.php';
}

//This must be below the setting of $page_content
include 'QBMaster.php';
?>


<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-2.2.0.min.js">
</script>
<!--
<script>(window.jQuery||document.write("\u003Cscript src=\u0022\/wangj180\/asp_assignment\/lib\/jquery\/dist\/jquery.min.js\u0022\u003E\u003C\/script\u003E"));</script>
-->
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $("#shoppingcart").click(function(){
            $(".shoppingcart").slideToggle("fast");
        });
        $("#shoppingcart_close").click(function(){
            $(".shoppingcart").slideUp("fast");
        });
        $('div.eachproduct').fadeIn('slow');
    });
</script>

</body>
</html>