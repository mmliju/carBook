<?php
session_start();
require '../classes/main.class.php';
$message="";
//----------------------------------------------
if(isset($_GET["type"]) && $_GET["type"] == "logout" ) {
	$_SESSION["user_id"] = "";
	session_destroy();
}
//--------------------------------------------------
if(!empty($_POST["login"])) 
{
  //------------------------------------
  $db_obj = new dbInfo();
  //---------------------------------------
  // Perform a query, check for error
if (!mysqli_query($db_obj->con,"SELECT * FROM es_admin WHERE user_name='" . $_POST["username"] . "' and password = '". $_POST["password"]."'"))
  {
  echo("Error description: " . mysqli_error($con));
  }
  $result = mysqli_query($db_obj->con,"SELECT * FROM es_admin WHERE user_name='" . $_POST["username"] . "' and password = '". $_POST["password"]."'");
  $row  = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if(is_array($row)) {
	$_SESSION["user_id"]   = $row['user_id'];
	$_SESSION["logged_in"] = true;
	
	header("location:home.php");
  } else {
	$message = "Invalid Username or Password!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Xpress Shine Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                       
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                         <strong style="color:red;"><?php echo $message;  ?></strong>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="login" value="Login" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
