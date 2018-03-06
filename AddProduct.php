<?php
require_once 'core/product.inc.php';
require_once 'CheckLogin.php';
?>
<h2>Product Management -> Create</h2>

<form enctype="multipart/form-data" action="index.php?content_page=manageProduct" method="post">
    <div class="form-horizontal">
        <h4>Product</h4>
        <hr />
        <div class="text-danger"></div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="ProductName">ProductName</label>
            <div class="col-md-10">
                <input class="form-control" type="text" data-val="true" data-val-length="ProductName should between 3 and 100 characters." maxlength="100" minlength="3" data-val-required="The ProductName field is required." id="ProductName" name="ProductName" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="ProductName" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="ProductDescription">ProductDescription</label>
            <div class="col-md-10">
                <input class="form-control" type="text" data-val="true" data-val-length="ProductName should between 10 and 1000 characters." maxlength="1000" minlength="10" data-val-required="The ProductDescription field is required." id="ProductDescription" name="ProductDescription" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="ProductDescription" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="Price">Price</label>
            <div class="col-md-10">
                <input class="form-control" type="number" step="0.01" data-val="true" data-val-number="The field Price must be a number." data-val-required="The Price field is required." id="Price" name="Price" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="Price" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="CategoryID">Category</label>
            <div class="col-md-10">
                <select class="form-control" data-val="true" data-val-required="The CategoryID field is required." id="CategoryID" name="CategoryID">
                    <?php Product::displayCategory() ?>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label" for="SupplierID">Supplier</label>
            <div class="col-md-10">
                <select class="form-control" data-val="true" data-val-required="The SupplierID field is required." id="SupplierID" name="SupplierID">
                    <?php Product::displaySupplier() ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="PathOfFile">Product Image</label>
            <div class="col-md-10">
                <input type="file" name="PathOfFile" id="PathOfFile" accept=".jpg, .gif, .jpeg, .png, image/jpeg, image/gif, image/png" />
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="Create" class="btn btn-primary" />
            </div>
        </div>
    </div>
</form>

<div class="text-center">
    <a class="btn btn-info" href="index.php?content_page=manageProduct"><span class="glyphicon glyphicon-menu-left"></span> Back to List</a>
</div>
