<?php
require_once 'core/customer.inc.php';
Customer::checkLoginStatus();

$registersucc = false;

if (isset($_POST['Email']) && ($_POST['Email'] != '')) {
    Customer::addUsers();
    $registersucc = true;
}

if (!$registersucc) {
    echo '
<h2>Register.</h2>

<form method="post" class="form-horizontal" action="index.php?content_page=Register">
    <h4>Create a new account.</h4>
    <hr />
    <div class="text-danger validation-summary-valid" data-valmsg-summary="true"><ul><li style="display:none"></li>
        </ul></div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="Email">Email</label>
        <div class="col-md-10">
            <input class="form-control" type="email" data-val="true" data-val-email="The Email field is not a valid e-mail address." data-val-required="The Email field is required." id="Email" name="Email" value="" required />
            <span class="text-danger field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="Password">Password</label>
        <div class="col-md-10">
            <input class="form-control" type="password" data-val="true" data-val-length="The Password must be at least 6 and at max 100 characters long." maxlength="100" minlength="6" data-val-required="The Password field is required." id="Password" name="Password" required />
            <span class="text-danger field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="ConfirmPassword">Confirm password</label>
        <div class="col-md-10">
            <input class="form-control" type="password" data-val="true" data-val-equalto="The password and confirmation password do not match." data-val-equalto-other="*.Password" id="ConfirmPassword" name="ConfirmPassword" required oninput="check(this)" />
            <script language=\'javascript\' type=\'text/javascript\'>
                function check(input) {
                    if (input.value != document.getElementById(\'Password\').value) {
                        input.setCustomValidity(\'Password Must be Matching.\');
                    } else {
                        // input is valid -- reset the error message
                        input.setCustomValidity(\'\');
                    }
                }
            </script>
            <span class="text-danger field-validation-valid" data-valmsg-for="ConfirmPassword" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="Address">Name</label>
        <div class="col-md-10">
            <input class="form-control" type="text" data-val="true" data-val-length="The Name must be at least 6 and at max 100 characters long." maxlength="100" minlength="6" data-val-required="The Name field is required." id="Name" name="Name" value="" required />
            <span class="text-danger field-validation-valid" data-valmsg-for="Address" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="Address">Address</label>
        <div class="col-md-10">
            <input class="form-control" type="text" data-val="true" data-val-length="The Address must be at least 6 and at max 100 characters long." maxlength="100" minlength="6" data-val-required="The Address field is required." id="Address" name="Address" value="" required />
            <span class="text-danger field-validation-valid" data-valmsg-for="Address" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="UserDefaultNumber">Default Number</label>
        <div class="col-md-10">
            <input class="form-control" type="text" data-val="true" data-val-length="Default Number should between 3 and 20 characters." maxlength="20" minlength="3" data-val-required="The Default Number field is required." id="UserDefaultNumber" name="UserDefaultNumber" value="" required />
            <span class="text-danger field-validation-valid" data-valmsg-for="UserDefaultNumber" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="UserSecondNumber">Work Number</label>
        <div class="col-md-10">
            <input class="form-control" type="text" id="UserSecondNumber" name="UserSecondNumber" value="" />
            <span class="text-danger field-validation-valid" data-valmsg-for="UserSecondNumber" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="UserThirdNumber">Home Number</label>
        <div class="col-md-10">
            <input class="form-control" type="text" id="UserThirdNumber" name="UserThirdNumber" value="" />
            <span class="text-danger field-validation-valid" data-valmsg-for="UserThirdNumber" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </div>
</form>

';
}


