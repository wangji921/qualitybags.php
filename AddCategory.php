<?php
require_once 'CheckLogin.php';
?>

<h2>Category Management -> Create</h2>

<form method="post" action="index.php?content_page=manageCategory">
    <div class="form-horizontal">
        <h4>Category</h4>
        <hr />
        <div class="text-danger"></div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="CategoryName">Category Name</label>
            <div class="col-md-10">
                <input class="form-control" type="text" data-val="true" data-val-length="Category name should between 3 and 50 characters." maxlength="50" minlength="3" data-val-required="The Category Name field is required." id="CategoryName" name="CategoryName" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="CategoryName" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="CategoryDescription">Category Description</label>
            <div class="col-md-10">
                <input class="form-control" type="text" data-val="true" data-val-length="Category Description should between 3 and 100 characters." maxlength="100" minlength="3" data-val-required="The Category Description field is required." id="CategoryDescription" name="CategoryDescription" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="CategoryDescription" data-valmsg-replace="true" />
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
    <a class="btn btn-info" href="index.php?content_page=manageCategory"><span class="glyphicon glyphicon-menu-left"></span> Back to List</a>
</div>
