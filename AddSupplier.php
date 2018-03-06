<?php
require_once 'CheckLogin.php';
?>

<h2>Supplier Management -> Create</h2>

<form method="post" action="index.php?content_page=manageSupplier">
    <div class="form-horizontal">
        <h4>Supplier</h4>
        <hr />
        <div class="text-danger"></div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="SupplierName">Supplier Name</label>
            <div class="col-md-10">
                <input class="form-control" type="text" data-val="true" data-val-length="Supplier name should between 3 and 50 characters." maxlength="50" minlength="3" data-val-required="The Supplier Name field is required." id="SupplierName" name="SupplierName" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="SupplierName" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="Address">Address</label>
            <div class="col-md-10">
                <input class="form-control" type="text" data-val="true" data-val-length="Address cannot be longer than 50 characters." maxlength="50" data-val-required="The Address field is required." id="Address" name="Address" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="Address" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="SupplierEmaill">Email</label>
            <div class="col-md-10">
                <input class="form-control" type="email" data-val="true" data-val-length="Email should between 5 and 30 characters." maxlength="30" minlength="5" data-val-required="The Email field is required." id="SupplierEmaill" name="SupplierEmaill" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="SupplierEmaill" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="SDefaultPhone">Default Phone</label>
            <div class="col-md-10">
                <input class="form-control" type="text" data-val="true" data-val-length="Default phone number should between 3 and 20 characters." maxlength="20" minlength="3" data-val-required="The Default Phone field is required." id="SDefaultPhone" name="SDefaultPhone" required value="" />
                <span class="text-danger field-validation-valid" data-valmsg-for="SDefaultPhone" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="MobilePhone">Mobile Phone</label>
            <div class="col-md-10">
                <input class="form-control" type="text" id="MobilePhone" name="MobilePhone" value="" />
                <span class="text-danger field-validation-valid" data-valmsg-for="MobilePhone" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="WorkPhone">Work Phone</label>
            <div class="col-md-10">
                <input class="form-control" type="text" id="WorkPhone" name="WorkPhone" value="" />
                <span class="text-danger field-validation-valid" data-valmsg-for="WorkPhone" data-valmsg-replace="true" />
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
    <a class="btn btn-info" href="index.php?content_page=manageSupplier"><span class="glyphicon glyphicon-menu-left"></span> Back to List</a>
</div>
