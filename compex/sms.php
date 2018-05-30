<?php
/*require 'slim/classes/textlocal.class.php';
	$textlocal = new Textlocal('lijuzlab@gmail.com','02aee5a134e6c749487a503820bd6f846940f8929383ad33de4d2b1f1818b5d1 ');

    $numbers = array(9048185978);
    $sender = 'TXTLCL';
    $sms ="New booking, Vehicle Number : ".$data['vehicle_number']."<br/>Phone Number : ".$data['phone']."<br/>Slot : ".$data['slot_time'];
    
    try {
        $result = $textlocal->sendSms($numbers, $sms, $sender);
        print_r($result);
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }*/
      $host="localhost";
      $username="redefine_xpress";
      $password="xpress@098";
      $database="redefine_xpress";
      $con = mysqli_connect($host, $username, $password, $database)or die(mysql_error());
      date_default_timezone_set('Asia/Kolkata');
     
       $query = ("select * from es_slots");
      $sql= mysqli_query($con,$query);
      $final_result = array();
      $i = 0;
      while($result= mysqli_fetch_array($sql))
      {
          $slot    = $result['start_time'];
        $current = date("h A");
        
        $d1=  strtotime($slot);
        $d2=  strtotime($current);
        if($d1<$d2){
            //-----------------------------------------------
    	    $final_result[$i]['start_time'] =  $result['start_time'];
    	    $final_result[$i]['slot_id']     =  $result['slot_id'];
    	    $final_result[$i]['status']     =  $result['status'];
    	    	$i++;

	}
// 	

      }

     print_r( $final_result);
//echo date_default_timezone_get();
//$d1 =  date("h A");
$slot    = "11.00 PM";
$current = date("h A");

$d1=  strtotime($slot);
$d2=  strtotime($current);

if($d1<$d2)
{
    echo "yes";
}
else
{
    echo "No";
}

   // @mail($to,"$subject",$result,$headers);
?>