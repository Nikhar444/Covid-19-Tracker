<?php

//include('header.php');
//echo "JSG in db";
//$con = mysqli_connect("localhost","jodhdoit", "Doit@123", "covid"); 
$con = mysqli_connect("localhost","root", "", "covid1");
//echo "JSG".$_POST['pid'];

$sel="select  count(`Patient_id`) as count1,from_date from pstatus group by from_date";


$result = mysqli_query($con,$sel);

$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//mysqli_close($con);

echo json_encode($data);


//echo $sel;
//$pat_rs=mysqli_query($con, $sel);


 //



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