<?php
require_once 'data.inc.php';

class Supplier
{
    public static function displaySupplier()
    {
        global $db;
        $sql = 'SELECT * FROM Supplier ORDER BY ID';
        $result = $db->query($sql);

        //$output[] = '<ul>';
        while ($row = $result->fetch()) {
            echo '<tr>
                    <td>
                        ' . $row['ID'] . '
                    </td>
                    <td>
                        ' . $row['SupplierName'] . '
                    </td>
                    <td>
                        ' . $row['Address'] . '
                    </td>
                    <td>
                        ' . $row['SupplierEmaill'] . '
                    </td>
                    <td>
                        ' . $row['SDefaultPhone'] . '
                    </td>
                    <td>
                        ' . $row['MobilePhone'] . '
                    </td>
                    <td>
                        ' . $row['WorkPhone'] . '
                    </td>
                    </tr>';
        }
    }

    public static function addSupplier()
    {
        global $db;
        $sql = "INSERT INTO Supplier
                (Address, MobilePhone, SDefaultPhone, SupplierEmaill, SupplierName, WorkPhone)
                VALUES ('" . $_POST['Address'] . "', '"
                            . $_POST['MobilePhone'] . "', '"
                            . $_POST['SDefaultPhone'] . "', '"
                            . $_POST['SupplierEmaill'] . "', '"
                            . $_POST['SupplierName'] . "', '"
                            . $_POST['WorkPhone'] . "')";
        //echo $sql;
        if ($result = $db->query($sql)) {
            echo "<div class='text-center'><div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                    <strong>Success!</strong> The record was added successfully.</div></div>";
        }
    }
}