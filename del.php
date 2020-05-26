<?php

include('header.php');
//echo "JSG in db";
//$con = mysqli_connect("localhost","root", "", "covid1");
echo "JSG"."<br>";
if(isset($_GET['pid']) && !empty($_GET['pid'])){
	$del_id=$_GET['pid'];
$delsql="delete from p34n where Patient_id='".$del_id."'";
$deltemp="delete from temp_p where Patient_id='".$del_id."'";
echo $delsql;
if(mysqli_query($con, $delsql) && mysqli_query($con, $deltemp)){
echo "Record Deleted Successfully of Patient Id ".$del_id;
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