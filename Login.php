<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['flag'])) {
    if ($_SESSION['flag'] == true) {
        $redirect_page = "http://php.jasonwong.co.nz/qualitybags/index.php";
        header("Location: ".$redirect_page);
        echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$redirect_page.'">';
        exit();
    }
}


// include username and password array and the function
require("core/UserDetails.inc.php");

// if the user has input username and password
if (isset($_POST['form_username']) and isset($_POST['form_password']))
{
    //The login is not successful, set the login flag to false
    $_SESSION['flag'] = false;

    // call the pre-defined function and check if user is authenticated
    if (checkUserCredentals($_POST['form_username'], $_POST['form_password']))
    {
        if (checkUserEnable($_POST['form_username'], $_POST['form_password'])) {
            //The login is successful, set the login flag to true and save the current user name
            $_SESSION['flag'] = true;
            $_SESSION['current_user'] = $_POST['form_username'];

            if ($_POST['form_username'] == 'admin@email.com') {
                $_SESSION['role'] = 'admin';
            }

            //redirect the user to the correct page
            //find out where to go after login
            if (isset($_SESSION['request_page']))
                $redirect_page = "http://php.jasonwong.co.nz/qualitybags/index.php?content_page=".$_SESSION['request_page'];
            else
                $redirect_page = "http://php.jasonwong.co.nz/qualitybags/index.php";

            //redirect the user to the correct page after login
            header("Location: ".$redirect_page);
        } else {
            $failedlogin = "<div class=\"alert alert-warning\" role=\"alert\">Your account has been disabled. Please contact our customer service.</div>";
        }

    }
    else {
        $failedlogin = "<div class=\"alert alert-warning\" role=\"alert\">Invalid login attempt. Please check your Email / password and try agian.</div>";
    }
} //Otherwise, stay in the login page

?>
<!-- User credential form -->

<h2>Log in.</h2>
<div class="row">
    <div class="col-md-8">
        <section>
            <form method="post" class="form-horizontal">
                <h4>Use a local account to log in.</h4>
                <hr />
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Email">Email</label>
                    <div class="col-md-10">
                        <input class="form-control" type="email" data-val="true" data-val-email="The Email field is not a valid e-mail address." data-val-required="The Email field is required." id="Email" name="form_username" value="" />
                        <span class="text-danger field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Password">Password</label>
                    <div class="col-md-10">
                        <input class="form-control" type="password" data-val="true" data-val-required="The Password field is required." id="Password" name="form_password" />
                        <span class="text-danger field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <div class="checkbox">
                            <label for="RememberMe">
                                <input data-val="true" data-val-required="The Remember me? field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true" />
                                Remember me?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <?php
                        if (isset($failedlogin)) {
                            echo $failedlogin;
                        }
                        ?>
                        <button type="submit" class="btn btn-primary">Log in&nbsp;&nbsp;<span class="glyphicon glyphicon-log-in"></span></button>
                    </div>
                </div>
                <p class="text-right">
                    <a class="btn btn-primary btn-sm" href="index.php?content_page=Register">Register as a new user?</a>
                </p>
                <p class="text-right">
                    <a class="btn btn-primary btn-sm" href="index.php?content_page=Contact">Forgot your password?</a>
                </p>
                <input name="RememberMe" type="hidden" value="false" />
            </form>
        </section>
    </div>
    <div class="col-md-4">
    </div>
</div>