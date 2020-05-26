<?php
include("header.php");  
if(isset($_POST["submit"]))
{
				//$conn= mysqli_connect("localhost","root", "", "covid1");
        // $conn = mysqli_connect("localhost","jodhdoit", "Doit@123", "covid");      
          if(!$con){
          die('Could not Connect My Sql:' .mysqli_error());
		  }

      /*   $check="select * from p34n where Patient_id='".$_POST['pid']."' limit 10";
        // echo $check;
        $pat_rs=mysqli_query($conn, $check);
        if(count($pat_rs)>0){
          echo "Check Patient_id. May Be Duplicate";
        }
        else{*/ ?>








<?php

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

          $sql = "INSERT INTO relative (
          Rowno, 
          Patient_id,
          rid,
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
          CALLTIME,p_name,p_latitude,p_longitude,p_admitdate,Remark,p_addr) values (
          '$filesop[0]',
          '".$_POST['patient_id']."',
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
          '$filesop[22]','".$_POST['pname']."','".$_POST['plat']."','".$_POST['plong']."','".$_POST['padmit']."','".$_POST['remark']."','".$_POST['haddr']."')";
          //print_r($sql);
          //$date = date('Y-d-m', strtotime($filesop[7]));
         //$time = date('H:i:s', strtotime($filesop[7]));
         //echo $date." ".$time."<br>";
          $stmt = mysqli_prepare($con,$sql);
         mysqli_query($con,$sql);

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
  <style type="text/css">
  select {
        width: 170px;
        margin: 10px;
    }
    select:focus {
        min-width: 170px;
        width: auto;
    }    
</style>

  <?php 
   
  //$pat_query="select Patient_id as pid,p_name,CALLINGA  from p34n group by Patient_id,p_name,CALLINGA order by Patient_id  ";
  $pat_query="select Patient_id as pid,p_name,CALLINGA  from p34n group by Patient_id,p_name,CALLINGA order by p_name";

$pat_rs=mysqli_query($con, $pat_query);
//print_r($date_rs);
//$row=mysqli_fetch_assoc($date_rs);
//print_r($row);
while($row=mysqli_fetch_assoc($pat_rs))
    {
      //print_r($row);
      $pat_id[]=$row;
      //echo $dates['cdates']."<br>";
  }
//print_r($pat_id);
  ?>
   


<form enctype="multipart/form-data" method="post" role="form">


   <form action="" method="post" name="track">
       <input type="hidden" name="patient_id1" value="" id="patient_id1">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          
          <td align="center" colspan="3">&nbsp; Select Patient Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <SELECT NAME="patient_id" onchange="get_detail(this.value)" height="25">
          <option>Select Patient Name</option>
          <?php foreach ($pat_id as $pid) {  
            if(isset($_POST['patient_id1'])){
            ?>
        <option value="<?php echo $pid['pid']; ?>" <?php if ($pid['pid']==$_POST['patient_id1']) { echo "selected"; }?> ><?php echo $pid['p_name']." (".$pid['pid'].")";   ?></option>

        <?php }

          else { ?>
              <option value="<?php echo $pid['pid']; ?>"><?php  echo $pid['p_name']." (".$pid['pid'].")"; ?></option>

      <?php 
              }   

          }


        ?>
        <!--<option value="all">ALL</option>-->
        </SELECT></td>
      </tr>
    </table>



    <div class="form-group" align="center">
        Enter Relative Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="pid"><br><br>
        Enter Relative Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="pname"><br><br>
        Enter Relative Home Longitude <input type="text" name="plong"><br><br>
        Enter Relative Home Latitude&nbsp;&nbsp;&nbsp;  <input type="text" name="plat"><br><br>
        Enter Relative Home Address&nbsp;&nbsp;&nbsp;  <input type="text" name="haddr"><br><br>
        Enter Relative Remark&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  <input type="text" name="remark"><br><br>
        Enter Relative Entry Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input type="date" name="padmit"><br><br>
        <b>File Upload</b> <input type="file" name="file" id="file" size="150">
        <p class="help-block">Only CSV File Import.</p>
        <button type="submit"  class="btn btn-default" name="submit" value="submit">Upload</button>
    </div>
</form>
</body>
</html>