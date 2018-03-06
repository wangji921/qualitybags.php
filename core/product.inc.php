<?php
require_once 'data.inc.php';

class Product
{
    public static function displayProduct()
    {
        global $db;
        $sql = 'SELECT * FROM Product, Category, Supplier WHERE Product.CategoryID = Category.CategoryID AND Supplier.ID = Product.SupplierID ORDER BY Product.ProductID';
        $result = $db->query($sql);

        //$output[] = '<ul>';
        while ($row = $result->fetch()) {
            echo '<tr>
                    <td>
                        ' . $row['ProductID'] . '
                    </td>
                    <td>
                        <div class="thumbnail">
                    <img src="images/ProductImages/' . $row['PathOfFile'] . '" alt="Product Image" onerror="this.onerror = null; this.src = \'Images/Bag.jpg\'">
                </div>
                    </td>
                    <td>
                        ' . $row['ProductName'] . '
                    </td>
                    <td>
                        ' . $row['ProductDescription'] . '
                    </td>
                    <td>
                        $' . $row['Price'] . '
                    </td>
                    <td>
                        ' . $row['SupplierName'] . '
                    </td>
                    <td>
                        ' . $row['CategoryName'] . '
                    </td>
                    </tr>';
        }
    }

    public static function displaySupplier()
    {
        global $db;
        $sql = 'SELECT * FROM Supplier ORDER BY ID';
        $result = $db->query($sql);

        //$output[] = '<ul>';
        while ($row = $result->fetch()) {
            echo '<option value="' . $row['ID'] . '">' . $row['SupplierName'] . '</option>';
        }
    }

    public static function displayCategory()
    {
        global $db;
        $sql = 'SELECT * FROM Category ORDER BY CategoryID';
        $result = $db->query($sql);

        //$output[] = '<ul>';
        while ($row = $result->fetch()) {
            echo '<option value="' . $row['CategoryID'] . '">' . $row['CategoryName'] . '</option>';
        }
    }

    public static function addProduct()
    {
        global $db;
        $sql = "INSERT INTO Product
                (CategoryID, PathOfFile, Price, ProductDescription, ProductName, SupplierID)
                VALUES ('" . $_POST['CategoryID'] . "', '"
            . $_FILES['PathOfFile']["name"] . "', '"
            . $_POST['Price'] . "', '"
            . $_POST['ProductDescription'] . "', '"
            . $_POST['ProductName'] . "', '"
            . $_POST['SupplierID'] . "')";

        if (isset($_FILES["PathOfFile"])) {
            move_uploaded_file($_FILES["PathOfFile"]["tmp_name"], "images/ProductImages/" . $_FILES["PathOfFile"]["name"]);
        }

        //echo $sql;
        if ($result = $db->query($sql)) {
            echo "<div class='text-center'><div class=\"alert alert-success alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
  <strong>Success!</strong> The record was added successfully.</div></div>";
        }
    }
}