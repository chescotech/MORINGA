<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login - <?php include('dist/includes/title.php'); ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Font Awesome -->
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

    <?php
    include('dist/includes/dbcon.php');
    if (isset($_POST['login'])) {
        $key = $_POST['key'];
        $now = new DateTime();
        $year = $now->format("Y") + 1;
        $hashTag = "ADMIN" . $year;
        $hash = substr(md5($hashTag), 0, 8);

        if ($key == $hash) {

            $end = date('Y-m-d', strtotime('+1 years'));

            mysqli_query($con, " UPDATE  licience_reg_tb SET exp_date ='$end' ")or die(mysqli_error($con));

            echo "<script type='text/javascript'>alert('Congratulations, Your Licience Has been renewed for one Year !!');         
	  document.location='index.php'</script>";

            // update the expiry date for the licience...  licience_reg_tb 
        } else {
            echo "<script type='text/javascript'>alert('Invalid Licience Key Entered !!');
	  document.location='licience-activation.php'</script>";
        }
    }
    ?>

    <body class="hold-transition login-page">
        <div class="login-box" style="border: 2px solid black">
            <div class="login-logo">
                <b style="color: purple">Chesco-Tech <br> <h4><u>Point Of Sale</u></h4></b>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg" style="color: black"><b>PLease Enter Activation Key !</b></p>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Enter Activation Key" name="key" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 pull-right">
                            <button type="reset" class="btn btn-block btn-flat">Clear</button>
                        </div>
                        <div class="col-xs-6 pull-right">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login" default>Activate</button>
                        </div><!-- /.col -->
                    </div>
                </form>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
    </body>
</html>
