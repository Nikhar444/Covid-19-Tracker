<?php
include("header.php");  
if(isset($_POST["submit"]))
{
				$conn= mysqli_connect("localhost","root", "", "covid1");
        // $conn = mysqli_connect("localhost","jodhdoit", "Doit@123", "covid");      
          if(!$conn){
          die('Could not Connect My Sql:' .mysqli_error());
		  }

      /*   $check="select * from p34n where Patient_id='".$_POST['pid']."' limit 10";
        // echo $check;
        $pat_rs=mysqli_query($conn, $check);
        if(count($pat_rs)>0){
          echo "Check Patient_id. May Be Duplicate";
        }
        else{*/

          $file = $_FILES['file']['tmp_name'];
          $handle = fopen($file, "r");
          $c = 0;
          while(($filesop = fgetcsv($handle, 2000, ",")) !== false)
                    {
                      if ($filesop[0]!=0 && (strlen(($filesop[11]))>0))
                      {
                        try {
         $date = date('Y-m-d', strtotime($filesop[7]));
         $time = date('H:i:s', strtotime($filesop[7]));
         $cd = date('Y-m-d H:i:s', strtotime($filesop[7]));

          $sql = "INSERT INTO p34n (
          Rowno, 
          Patient_id,
          CALLINGA,
          CallingAAddress,
          CALLEDB,
          CalledBAddress,
          CalledBMobileOperator,
          CalledBOperatorCircle,
          CALLDATE,
          Call_Date,
          Call_Time,
          CALLDURATION,
          CALLTYPE,
          FIRSTCELLIDA,
          FirstcellidaAddress,
          LASTCELLIDA,
          IMEIA,
          IMSIA,
          Latitude,
          Langitude,
          CalledBCircle,
          HandsetDetail,
          CallingACircle,
          CallingAOperatorCircle,
          CallingAMobileOperator,
          CALLTIME,p_name,p_latitude,p_longitude,p_admitdate,p_addr) values (
          '$filesop[0]',
          '".$_POST['pid']."',
          '$filesop[1]',
          '$filesop[2]',
          '$filesop[3]',
          '$filesop[4]',
          '$filesop[5]',
          '$filesop[6]',
          '".$cd."',
          '".$date."',
          '".$time."',
          '$filesop[8]',
          '$filesop[9]',
          '$filesop[10]',
          '$filesop[11]',
          '$filesop[12]',
          '$filesop[13]',
          '$filesop[14]',
          '$filesop[15]',
          '$filesop[16]',
          '$filesop[17]',
          '$filesop[18]',
          '$filesop[19]',
          '$filesop[20]',
          '$filesop[21]',
          '$filesop[22]','".$_POST['pname']."','".$_POST['plat']."','".$_POST['plong']."','".$_POST['padmit']."','".$_POST['haddr']."')";
          print_r($sql);
          //$date = date('Y-d-m', strtotime($filesop[7]));
         //$time = date('H:i:s', strtotime($filesop[7]));
         //echo $date." ".$time."<br>";
          $stmt = mysqli_prepare($conn,$sql);
         mysqli_query($conn,$sql);

         $c = $c + 1;
           }
            
            catch(Exception $e) {
                 echo 'Message: ' .$e->getMessage();
            }
          }


}
            if($sql){
               echo "success";
             } 
		 else
		 {
            echo "Sorry! Unable to import.";
          }

//}
}
?>
<!DOCTYPE html>
<html>
<body>
<form enctype="multipart/form-data" method="post" role="form">
    <div class="form-group" align="center">
        Enter Patient Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="pid"><br><br>
        Enter Patient Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="pname"><br><br>
        Enter Patient Home Longitude <input type="text" name="plong"><br><br>
        Enter Patient Home Latitude&nbsp;&nbsp;&nbsp;  <input type="text" name="plat"><br><br>
        Enter Patient Home Address&nbsp;&nbsp;&nbsp;  <input type="text" name="haddr"><br><br>
        Enter Patient Admit Date &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input type="date" name="padmit"><br><br>
        <b>File Upload</b> <input type="file" name="file" id="file" size="150">
        <p class="help-block">Only CSV File Import.</p>
        <button type="submit"  class="btn btn-default" name="submit" value="submit">Upload</button>
    </div>
</form>
</body>
</html>