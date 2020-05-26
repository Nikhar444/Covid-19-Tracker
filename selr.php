<?php

//include('header.php');
//echo "JSG in db";
$con = mysqli_connect("localhost","jodhdoit", "Doit@123", "covid"); 
//$con = mysqli_connect("localhost","root", "", "covid1");
//echo "JSG".$_POST['pid'];
if(isset($_POST['pid']) && !empty($_POST['pid'])){
	$p_id=$_POST['pid'];
$sel="select distinct rid,p_name from relative where Patient_id='".$p_id."'";
//echo $sel;
$pat_rs=mysqli_query($con, $sel);
echo "Select Relative Name Here &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$res ="<select name='patient_id' id='patient_id' onChange='get_detail(this.value)'>";
$res.="<option>" . "Select Relative Name" . "</option>";
while($row=mysqli_fetch_assoc($pat_rs))
    {
  //    print_r($row);
     // $rid[]=$row;
    	$res.="<option value=\"" . $row['rid']. "\">" . $row['p_name'] . "</option>";
      //echo $dates['cdates']."<br>";
  }
$res.="</select></span>";
echo $res;


}



/*if($_GET['arrange_id']){
$id=$_GET['arrange_id'];

//echo $id;
$update_arrange_status="Delete from es_arrangements where es_arrange_id='".$_GET['arrange_id']."'";
//echo $update_arrange_status;


if ($link->query($update_arrange_status) === TRUE) {
   					 echo "Successfully Deleted";
			}
			else {
				echo "Not Deleted";
			}

}*/
exit;


?>