<?php
class dbInfo {
public function __construct()
 { 

      $this->host="localhost";
     /* $this->username="redefine_xpress";
      $this->password="xpress@098";
      $this->database="redefine_xpress";*/
	  $this->username="root";
      $this->password="";
      $this->database="xpress";
      $this->con = mysqli_connect($this->host, $this->username, $this->password, $this->database);
	  if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
     
  }
  //---------------------------------$connection = mysqli_connect('localhost', 'username', 'password', 'database');----------
  public function get_rooms()
  {
      $query = ("select dep_name,dep_tag,dep_image,dep_desc from n_departments");
      $sql= mysqli_query($this->con,$query);
      $final_result = array();
      $i = 0;
      while($result= mysqli_fetch_array($sql))
      {
	$final_result[$i]['dep_name'] =  $result['dep_name'];
	$final_result[$i]['dep_tag']  =  $result['dep_tag'];
	$final_result[$i]['dep_image']=  $result['dep_image'];
	$final_result[$i]['dep_desc'] =  $result['dep_desc'];
// 	
	$i++;
      }

     return $final_result;
   
  }
   //---------------------------------$connection = mysqli_connect('localhost', 'username', 'password', 'database');----------
  public function get_slots()
  {
      $query = ("select * from es_slots");
      $sql= mysqli_query($this->con,$query);
      $final_result = array();
      $i = 0;
      while($result= mysqli_fetch_array($sql))
      {
	$final_result[$i]['start_time'] =  $result['start_time'];
	$final_result[$i]['slot_id']     =  $result['slot_id'];
	$final_result[$i]['status']     =  $result['status'];
	
// 	
	$i++;
      }

     return $final_result;
   
  }
  //-------------------------------------------------------
  public function reserve_slot($usrData)
  {
      $result = $this->insert($usrData,'es_sales');
      if($result){
	$query = ("update es_slots set status = 'Deactive' where slot_id = '".$usrData['slot_id']."' ");
	$sql= mysqli_query($this->con,$query);
	//-----------------------------------------------------
	/*$to ="";
	$from ="";
	$message ="";
	$subject ="";
	mail($to,$subject,$message);*/
	//--------------------------------------------------------------------
      }  
  }
    //-------------------------------------------------------
  public function change_slot_status($slot)
  {

	 $query = ("UPDATE es_slots
	       SET status = CASE status 
               WHEN 'Active' THEN 'Deactive'
               WHEN 'Deactive' THEN 'Active' 
             END WHERE `slot_id` = '$slot'");
	$sql= mysqli_query($this->con,$query);

  }
  //------------------------------------------------------
  private function insert($usrData,$table)
  {
	$count = 0;
	$fields= "";
	foreach($usrData as $col => $val) {
	    if ($count++ != 0) $fields .= ', ';
	    $col = strip_tags($col);
	    $val = strip_tags($val);
	    $fields .= "`$col` = '$val'";
	}

        $query = "INSERT INTO `".$table."` SET $fields;";

      
	mysqli_query($this->con,$query) or die(mysql_error());
	$result = mysqli_insert_id($this->con);
   
	return $result;
     }
 //----------------------------------
   public function get_orders()
  {
      $query = ("select * from es_sales order by sale_id desc limit 50");
      $sql= mysqli_query($this->con,$query);
      $final_result = array();
      $i = 0;
      while($result= mysqli_fetch_array($sql))
      {
	$final_result[$i]['slot_time'] =  $result['slot_time'];
	$final_result[$i]['phone']     =  $result['phone'];
	$final_result[$i]['vehicle_number']     =  $result['vehicle_number'];
	$final_result[$i]['date']     =  $result['date'];
	
// 	
	$i++;
      }

     return $final_result;
   
  }
  //--
}

?>