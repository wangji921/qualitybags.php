<?php

// create connection
$mysqli = new mysqli("localhost", "qualitybags", "8ecy6Ex99emx", "qualitybags");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";

// create SQL statement
/*
$sql = "INSERT INTO Employees(FirstName,LastName,Title)
        VALUES('" . $_POST['paper_author'] . "','"
    . $_FILES["paper_file"]["name"] . "','"
    . $_POST['paper_title'] . "')";
*/

// execute SQL statement and get results
//if (!$mysqli->query($sql)) {
//    echo "SQL operation failed: (" . $mysqli->errno . ") " . $mysqli->error;
//}
?>


<h2 class="text-center">Our Products</h2>
<p class="text-center mypadding">Here are the most popular our products. </p>



<div class="row mypadding">
    <div class="text-center">
        <form method="POST" role="search" class="form-inline" enctype="multipart/form-data" action="index.php?content_page=Product">
            <div class="form-group">
                <input type="text" name="SearchString" class="form-control input-sm" placeholder="<?php if (isset($_POST['SearchString'])) {echo $_POST['SearchString'];} else {echo "Looking for..."; } ?>">
                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Go</button>
                <a href="index.php?content_page=Product" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Show All</a>
            </div>
        </form>
    </div>
</div>



<div class="product_cat btn-group btn-group-justified">
    <a href="index.php?content_page=Product" class="btn btn-primary">All</a>
    <?php
    $sql_category = "SELECT CategoryID AS category_ID,
                            CategoryName AS category_name
                    FROM Category";
    $rs_cate = $mysqli->query($sql_category);
    if (!$rs_cate) {
        exit("Error in SQL");
    }

    while ($row = $rs_cate->fetch_assoc()) {
        $category_ID = $row["category_ID"];
        $category_name = $row["category_name"];
        echo "<a href=\"index.php?content_page=Product&CategoryID=$category_ID\" class=\"btn btn-primary\">$category_name</a>";
    }
    ?>
</div>



<?php

//Select the file information
if (isset($_POST['SearchString']) && ($_POST['SearchString'] != '')) {
    $sql="SELECT Product.ProductID As product_ID,
              Product.ProductName As product_name,
              Product.ProductDescription As product_description,
              Product.Price As product_price,
              Product.PathOfFile As product_file
          FROM Product
          WHERE ProductName LIKE '%".$_POST['SearchString']."%'";
}
else {
    if (isset($_GET['CategoryID']) && ($_GET['CategoryID'] != ''))
    {
        $sql="SELECT Product.ProductID As product_ID,
              Product.ProductName As product_name,
              Product.ProductDescription As product_description,
              Product.Price As product_price,
              Product.PathOfFile As product_file
          FROM Product
              WHERE CategoryID =".$_GET['CategoryID'];
    }
    else {
        $sql="SELECT Product.ProductID As product_ID,
              Product.ProductName As product_name,
              Product.ProductDescription As product_description,
              Product.Price As product_price,
              Product.PathOfFile As product_file
          FROM Product";
    }
}


$rs=$mysqli->query($sql);
if (!$rs) {
    exit("Error in SQL");
}

//Count the record number
$counter = $rs->num_rows;
if (isset($_POST['SearchString']) && ($_POST['SearchString'] != '')) {
    echo "<div class=\"row text-center\">
            <div class=\"\">
                <kbd class=\"\">
            ";
    if ($counter == 0) {
        echo $counter." result";
    }
    elseif ($counter == 1) {
        echo $counter." result";
    }
    else {
        echo $counter." results";
    }
    echo "</kbd></div></div>";
}


//set the page size
$PageSize=10;
$PageCount=$counter/$PageSize + 1;

//Output page index table
echo "<div class='text-center'>";
echo "<nav aria-label=\"Page navigation\">";
echo "<ul class=\"pagination\">";
if (isset($_GET['CategoryID']) && ($_GET['CategoryID'] != '')) {
    for( $i=1; $i <= $PageCount; $i++)
    {
        echo "<li><a href=index.php?content_page=Product&CategoryID=$_GET[CategoryID]&pg=$i>$i</a></li>";
    }
}
else {
    for( $i=1; $i <= $PageCount; $i++)
    {
        echo "<li><a href=index.php?content_page=Product&pg=$i>$i</a></li>";
    }
}
echo "</ul></nav></div>";


// Test if this is the first page
if (isset($_GET['pg']))
{
    // set the parameters for the rest pages
    $start= ($_GET['pg']-1)*$PageSize + 1;
    $end= $_GET['pg']*$PageSize;
    if( $end > $counter )
        $end = $counter;
}
else
{
    //set the parameters for the first page
    $start= 1;
    $end= $PageSize;
    if( $end > $counter )
        $end = $counter;
}//end if IsSet("$_GET['pg']")

$j = $start - 1;

/* seek to row no. $j */
$rs->data_seek($j);

//Display the page
echo "<div class=\"row\">";
for( $i=$start; $i <= $end; $i++)
{
    $row = $rs->fetch_assoc();

    $product_ID = $row["product_ID"];
    $product_name = $row["product_name"];
    $product_description = $row["product_description"];
    $product_price = $row["product_price"];
    $product_file = $row["product_file"];
    echo "<div class=\"col-sm-6 eachproduct\">
        <div class=\"row\">
            <div class=\"col-sm-6\">
                <div class=\"thumbnail\">
                    <img src=\"images/ProductImages/$product_file\" alt=\"Product Image\" onerror=\"this.onerror = null; this.src = 'Images/Bag.jpg'\">
                </div>
            </div>
            <div class=\"col-sm-6\">
                <h3>$product_name</h3>
                <p>$product_description</p>
                <h3 class=\"text-primary\">$ $product_price</h3>
                <a class=\"btn btn-primary btn-sm\" href=\"cart.php?action=add&id=$product_ID\">
                    <span class=\"glyphicon glyphicon-shopping-cart\"></span>&nbsp;&nbsp;Add To Cart
                </a>
            </div>
        </div>
    </div>
    <div class=\"clearfix visible-xs-block\"></div>";
}
echo "</div>";

//Output page index table
echo "<div class='text-center'>";
echo "<nav aria-label=\"Page navigation\">";
echo "<ul class=\"pagination\">";
if (isset($_GET['CategoryID']) && ($_GET['CategoryID'] != '')) {
    for( $i=1; $i <= $PageCount; $i++)
    {
        echo "<li><a href=index.php?content_page=Product&CategoryID=$_GET[CategoryID]&pg=$i>$i</a></li>";
    }
}
else {
    for( $i=1; $i <= $PageCount; $i++)
    {
        echo "<li><a href=index.php?content_page=Product&pg=$i>$i</a></li>";
    }
}
echo "</ul></nav></div>";

//Display all the products information
/*
echo "<div class=\"row\">";
while ($row = $rs->fetch_assoc())
{
    $product_ID = $row["product_ID"];
    $product_name = $row["product_name"];
    $product_supplier = $row["product_supplier"];
    $product_price = $row["product_price"];
    echo "<div class=\"col-sm-6 eachproduct\">
        <div class=\"row\">
            <div class=\"col-sm-6\">
                <div class=\"thumbnail\">
                    <img src=\"images/ProductImages/22052017-004520795554.jpg\" alt=\"Product Image\" onerror=\"this.onerror = null; this.src = 'Images/Bag.jpg'\">
                </div>
            </div>
            <div class=\"col-sm-6\">
                <h3>$product_name</h3>
                <p>$product_supplier</p>
                <h3 class=\"text-primary\">$ $product_price</h3>
                <a class=\"btn btn-primary btn-sm\" href=\"/wangj180/asp_assignment/ShoppingCart/AddToCart/2\">
                    <span class=\"glyphicon glyphicon-shopping-cart\"></span>&nbsp;&nbsp;Add To Cart
                </a>
            </div>
        </div>
    </div>
    <div class=\"clearfix visible-xs-block\"></div>";
}
echo "</div>";
*/

$rs->free();
//close connection
$mysqli->close();
?>


