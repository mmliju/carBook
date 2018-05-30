<?php
class dbInfo {
public function __construct()
 { 
      $this->host="localhost";
      $this->username="redefine_xpress";
      $this->password="xpress@098";
      $this->database="redefine_xpress";
      $this->con = mysqli_connect($this->host, $this->username, $this->password, $this->database);
     
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
		if (!mysqli_query($con,$query))
		{
		    $result1 = $query;
		}
		else
			$result1 = $query;
		//$sql= mysqli_query($this->con,$query);
		
		return $result1;
      }  
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
}

?>