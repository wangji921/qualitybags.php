<!-- navbar -->
<?php
include_once 'core.php';
include_once 'core/shoppingcart.inc.php';
?>

<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logoshadow" href="index.php?content_page=HomePage"><span class="glyphicon glyphicon-tag"></span> <span class="logosize">QUALITY BAGS</span></a>
            </div>
            <div class="navbar-collapse collapse" id="mynavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php?content_page=HomePage">HOME</a></li>
                    <li><a href="index.php?content_page=Product">PRODUCT</a></li>
                    <li><a href="index.php?content_page=Contact">CONTACT</a></li>
                    <?php nav_admin_panel(); ?>
                </ul>


                <?php
                nav_login_check();
/*                session_start();
                if (!isset($_SESSION['flag']) || ($_SESSION['flag'] == false)) {
                    echo "<ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"#\" id=\"shoppingcart\" title=\"Shopping Cart\"><span class=\"glyphicon glyphicon-shopping-cart\"></span>&nbsp;CART&nbsp;<span class=\"caret\"></span></a></li>
                    <li><a href=\"index.php?content_page=Register\"><span class=\"glyphicon glyphicon-user\"></span>&nbsp;REGISTER</a></li>
                    <li><a href=\"index.php?content_page=Login\"><span class=\"glyphicon glyphicon-log-in\"></span>&nbsp;LOG IN</a></li>
                </ul>";
                } else {
                    echo "<ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"#\" id=\"shoppingcart\" title=\"Shopping Cart\"><span class=\"glyphicon glyphicon-shopping-cart\"></span>&nbsp;CART&nbsp;<span class=\"caret\"></span></a></li>
                    <li><a href=\"index.php?content_page=Register\"><span class=\"glyphicon glyphicon-user\"></span>&nbsp;$_SESSION[current_user]</a></li>
                    <li><a href=\"index.php?content_page=LogOff\"><span class=\"glyphicon glyphicon-log-out\"></span>&nbsp;LOG OFF</a></li>
                </ul>";
                }
                */?>

                <!--
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" id="shoppingcart" title="Shopping Cart"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;CART&nbsp;<span class="caret"></span></a></li>
                    <li><a href="index.php?content_page=Register"><span class="glyphicon glyphicon-user"></span>&nbsp;REGISTER</a></li>
                    <li><a href="index.php?content_page=Login"><span class="glyphicon glyphicon-log-in"></span>&nbsp;LOG IN</a></li>
                </ul>
                -->

            </div>
        </div>
    </nav>

    <?php
    ShoppingCart::showShoppingCart();
    ?>

    <script></script>
</div>
<!-- navbar end -->