<?php
require_once 'core/customer.inc.php';
require_once 'core/shoppingcart.inc.php';

Customer::needLogin();

$orderplaced = false;

if (isset($_POST['FirstName']) && $_POST['FirstName'] != '') {
    ShoppingCart::placeorder();
    $orderplaced = true;
}

if (!$orderplaced) {

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }

    if (!isset($cart) || $cart == '') {
        echo '<h1>Checkout</h1>
                    <div>
                        <h3>somthing wrong.</h3>
                        <hr />
                        <h3>Your shopping cart is empty.</h3>
                    </div>';
    }
    else {
        echo '<h1>Checkout</h1>

<h3>Please Fill in the Details</h3>

<form action="index.php?content_page=checkout" method="post">
    <div class="form-horizontal">
        <hr />
        <div class="text-danger"></div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="FirstName">First Name</label>
            <div class="col-md-8">
                <input class="form-control" type="text" data-val="true" data-val-length="First name cannot be longer than 50 characters." maxlength="50" data-val-required="The First Name field is required." id="FirstName" name="FirstName" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="FirstName" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="LastName">Last Name</label>
            <div class="col-md-8">
                <input class="form-control" type="text" data-val="true" data-val-length="Last name cannot be longer than 50 characters." maxlength="50" data-val-required="The Last Name field is required." id="LastName" name="LastName" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="LastName" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="Phone">Phone</label>
            <div class="col-md-8">
                <input class="form-control" type="text" data-val="true" data-val-required="The Phone field is required." id="Phone" name="Phone" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="Phone" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="State">Address</label>
            <div class="col-md-8">
                <input class="form-control" type="text" id="Address" name="Address" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="Address" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="City">City</label>
            <div class="col-md-8">
                <input class="form-control" type="text" id="City" name="City" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="City" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="PostalCode">PostalCode</label>
            <div class="col-md-8">
                <input class="form-control" type="text" id="PostalCode" name="PostalCode" value="" required />
                <span class="text-danger field-validation-valid" data-valmsg-for="PostalCode" data-valmsg-replace="true" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-10">
                <button type="submit" class="btn btn-primary">
                    Place Order&nbsp;&nbsp;<span class="glyphicon glyphicon-fast-forward"></span>
                </button>
            </div>
        </div>
    </div>
</form>';
    }

}




