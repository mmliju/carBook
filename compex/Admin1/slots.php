<?php
require '../classes/main.class.php';
$obj = new dbInfo();
if(isset($_GET['slot']))
{
  $obj->change_slot_status($_GET['slot']);
}
//----------------------------------------
$result = $obj->get_slots();

?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="bootstrap theme, bootstrap template, html5 theme">
    <meta name="description" content="Free Bootstrap template based on HTML5 and CSS3">
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="./css/animate.css"/>
    <script src="../js/jquery-2.1.0.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/typer.js"></script>
    <script src="../js/blocs.js"></script>
    <link rel='stylesheet' href='../css/et-line.min.css'/>
    <link rel='stylesheet' href='../css/font-awesome.min.css'/>
    <link href='http://fonts.googleapis.com/css?family=Montserrat&subset=latin,latin-ext' rel='stylesheet'
          type='text/css'>
  <!--  ======================================================= -->

    <title>Compas</title>

   

</head>
<body>
<!-- Main container -->
<div class="page-container">
<h2>All Slots</h2>

  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Slot</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
<?php
$i=1;
foreach($result as $val){


?>
    
      <tr class="<?php if($val['status'] == 'Active'){ echo 'success';  }else{ echo 'danger';} ?>" >
        <td><?php echo $i; ?></td>
        <td><?php echo $val['start_time']; ?></td>
        <td><?php echo $val['status']; ?></td>
        <td><span class="label <?php if($val['status'] == 'Active'){ echo 'label-danger';  }else{ echo 'label-success';} ?>"><a href="slots.php?slot=<?php echo $val['slot_id']; ?>" ><?php if($val['status'] == 'Active'){ echo 'Disable';  }else{ echo 'Enable';} ?></a></span></td>
      </tr> 
<?php
$i++;
}
?>
    
    </tbody>
  </table>
</div>

</body>
</html>
<!-- Modal -->