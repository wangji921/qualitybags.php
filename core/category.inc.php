<?php
require_once 'data.inc.php';

class Category
{
    public static function displayCategory()
    {
        global $db;
        $sql = 'SELECT * FROM Category ORDER BY CategoryID';
        $result = $db->query($sql);

        //$output[] = '<ul>';
        while ($row = $result->fetch()) {
            echo '<tr>
                    <td>
                        ' . $row['CategoryID'] . '
                    </td>
                    <td>
                        ' . $row['CategoryName'] . '
                    </td>
                    <td>
                        ' . $row['CategoryDescription'] . '
                    </td>
                    </tr>';
        }
    }

    public static function addCategory()
    {
        global $db;
        $sql = "INSERT INTO Category
                (CategoryName, CategoryDescription)
                VALUES ('" . $_POST['CategoryName'] . "', '"
            . $_POST['CategoryDescription'] . "')";
        //echo $sql;
        if ($result = $db->query($sql)) {
            echo "<div class='text-center'><div class=\"alert alert-success alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
  <strong>Success!</strong> The record was added successfully.</div></div>";
        }
    }
}