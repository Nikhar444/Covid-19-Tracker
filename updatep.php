<?php

//include('header.php');
//echo "JSG in db";
//$con = mysqli_connect("localhost","jodhdoit", "Doit@123", "covid"); 
$con = mysqli_connect("localhost","root", "", "covid1");
//echo "JSG".$_POST['pid'];
if(isset($_POST['pid']) && !empty($_POST['pid'])){
	$p_id=$_POST['pid'];
$sel="update pstatus set status='".$_POST['se']."' where patient_id='".$p_id."'";
//echo $sel;
//$pat_rs=mysqli_query($con, $sel);
if (mysqli_query($con, $sel)=== TRUE) {
             echo "Successfully Updated";
      }
      else {
        echo "Not Deleted";
      }




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