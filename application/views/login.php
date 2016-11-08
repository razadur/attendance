<?php $base_url = base_url();?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from minetheme.com/Endless1.5.1/login.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 21 Sep 2014 20:26:30 GMT -->
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $base_url;?>asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo $base_url;?>asset/css/font-awesome.min.css" rel="stylesheet">

    <!-- Endless -->
    <link href="<?php echo $base_url;?>asset/css/endless.min.css" rel="stylesheet">

</head>

<body>
<div class="login-wrapper">
    <div class="text-center" id="siteTitle">
        <h2 class="fadeInUp animation-delay8" style="font-weight:bold">
            <span class="text-success">AKMMCH</span>
            <!--            <span style="color:#ccc; text-shadow:0 1px #fff">Name</span>-->
        </h2>
    </div>

    <!--signin section-->
    <div class="login-widget ">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-left">
                    <i class="fa fa-lock fa-lg"></i> Sign in
                </div>

            </div>
            <div class="panel-body">
                <form class="form-login" id="signinForm" action="<?php echo site_url('Welcome/signin_process')?>" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" placeholder="Username" class="form-control input-sm bounceIn animation-delay2" name="username" >
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="Password" class="form-control input-sm bounceIn animation-delay4" name="password">
                    </div>
                    <hr/>
                    <input class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right" href="#" onClick=" document.getElementById('signinForm').submit();" type="submit" value="Signin">
                    <!--                <a class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right" href="#" onclick=" document.getElementById('signinForm').submit();"><i class="fa fa-sign-in"></i> Sign in</a>-->
                </form>
            </div>
        </div><!-- /panel -->
    </div><!-- /login-widget -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src="<?php echo $base_url;?>js/jquery-1.10.2.min.js"></script>

<!-- Bootstrap -->
<script src="<?php echo $base_url;?>asset/bootstrap/js/bootstrap.min.js"></script>

<!-- Modernizr -->
<script src='<?php echo $base_url;?>asset/js/modernizr.min.js'></script>

<!-- Pace -->
<script src='<?php echo $base_url;?>asset/js/pace.min.js'></script>

<!-- Popup Overlay -->
<script src='<?php echo $base_url;?>asset/js/jquery.popupoverlay.min.js'></script>

<!-- Slimscroll -->
<script src='<?php echo $base_url;?>asset/js/jquery.slimscroll.min.js'></script>

<!-- Cookie -->
<script src='<?php echo $base_url;?>asset/js/jquery.cookie.min.js'></script>

<!-- Endless -->
<script src="<?php echo $base_url;?>asset/js/endless/endless.js"></script>
</body>

<!-- Mirrored from minetheme.com/Endless1.5.1/login.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 21 Sep 2014 20:26:30 GMT -->
</html>
