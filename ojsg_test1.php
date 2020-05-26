<?php 
include("header.php");  
//  $con = mysqli_connect("localhost","jodhdoit", "Doit@123", "covid"); 
  //$con = mysqli_connect("localhost","root", "", "covid1");

?>

<script type="text/javascript">
    function get_detail(id)
             {
              
              //alert("JSG");
              //alert(id);
              document.getElementById("patient_id1").value=id;
              //alert(document.getElementById("patient_id1").value);
            
  
        }

</script>
<style type="text/css">
  select {
        width: 150px;
        margin: 10px;
    }
    select:focus {
        min-width: 150px;
        width: auto;
    }    
</style>


  <?php 
   
  //$pat_query="select Patient_id as pid,p_name,CALLINGA  from p34n group by Patient_id,p_name,CALLINGA order by Patient_id  ";
  $pat_query="select Patient_id as pid,p_name,CALLINGA  from p34n  where discharge=0 group by Patient_id,p_name,CALLINGA order by p_name";

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
  $statuscount="SELECT  count(*) as total,SUM(status=1) AS uploaded, SUM(status=2) na,SUM(status=3) la,SUM(status=4) pending,SUM(status=5) dup,SUM(status=6) multiple,SUM(status=0) notset from `pstatus`";
  $status_rs=mysqli_query($con, $statuscount);
  $status_row=mysqli_fetch_assoc($status_rs);
 // print_r($status_row);

//print_r($pat_id);
  ?>
    <form action="" method="post" name="track">
       <input type="hidden" name="patient_id1" value="" id="patient_id1">
      <table width="50%" border="1" cellspacing="0" cellpadding="1">
        <tr>
          <td align="center"><b><font color="3258a8"> No. of Patients:<?php echo $status_row['total'];  ?></b></font></td>
         <td align="center"><b><font color="3258a8"> CDR Uploaded: <?php echo $status_row['uploaded'];  ?></b></font></td>
         <td align="center"><b><font color="3258a8"> CDR N/A: <?php echo $status_row['na'];  ?></b></font></td>
         <td align="center"><b><font color="3258a8"> Lat-Long N/A: <?php echo $status_row['la'];  ?></b></font></td>
         <td align="center"><b><font color="3258a8"> Pending: <?php echo $status_row['pending'];  ?></b></font></td>
         <td align="center"><b><font color="3258a8"> Duplicate Number: <?php echo $status_row['dup'];  ?></b></font></td>
         <td align="center"><b><font color="3258a8"> Status not Set: <?php echo $status_row['notset'];  ?></b></font></td>
       </tr>
      </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td align="right"> <b><font color="red">Please Refresh Page After Each Report Generation</font></b> </td></tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          
          <td align="center" colspan="3">Select Patient Name Here &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <SELECT NAME="patient_id" onchange="get_detail(this.value)" width="">
          <option>Select Patient Name</option>
          <?php foreach ($pat_id as $pid) {  
            if(isset($_POST['patient_id1'])){
            ?>
        <option value="<?php echo $pid['pid']; ?>" <?php if ($pid['pid']==$_POST['patient_id1']) { echo "selected"; }?> ><?php echo $pid['p_name'].' ('.$pid['pid'] .')'; ?></option>

        <?php }

          else { ?>
              <option value="<?php echo $pid['pid']; ?>"><?php echo $pid['p_name'].' ('.$pid['pid'] .')'; ?></option>

      <?php 
              }   

          }


        ?>
        <!--<option value="all">ALL</option>-->
        </SELECT></td>
      </tr>
        <tr>
        <td align="center">OR</td>
      </tr>
      <tr>
        <td align="center" colspan="3">Select Patient Phone No Here &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <SELECT NAME="patient_idp"  onchange="get_detail(this.value)">
          <option>Select Phone No.</option>
          <?php foreach ($pat_id as $pid) {  
            if(isset($_POST['patient_id1'])){
            ?>
        <option value="<?php echo $pid['pid']; ?>" <?php if ($pid['pid']==$_POST['patient_id1']) { echo "selected"; }?> ><?php echo $pid['CALLINGA']; ?></option>

        <?php }

          else { ?>
              <option value="<?php echo $pid['pid']; ?>"><?php echo $pid['CALLINGA']; ?></option>

      <?php 
              }   

          }


        ?>
        <!--<option value="all">ALL</option>-->
        </SELECT></td>
      </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        
       
        <tr class="a" id="a"></tr>
        <tr>
          <td align="center">Buffer Area Around Home Address &nbsp;&nbsp;(In <b>KM</b>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="distance" value="1" size="4"></td>
        </tr>
        <tr>
          <td>&nbsp;</td> 
        </tr>
        <tr>
          <td align="center">
            <input type="submit" name="submit_data" value="Submit">&nbsp;<button onClick="location.href='https://theartheaters.in/covid/jsg_test1.php';">Refresh Page</button>&nbsp;&nbsp;&nbsp;<button onclick="export1()">Export To Excel File</button>
  &nbsp;<?php if(isset($_POST['submit_data'])) { ?><a href="./map.php?pid=<?php echo $_POST['patient_id1']; ?>"  target="_blank"> <img src="g.jpg" height="25px" width="20px">&nbsp;<input type="button" value="Click Here to Get Map"></a>  <?php } ?>
       
          </td>
          <td align="center">
            
          </td>
        </tr>
             
  
        <tr>
          <td align="right"></td>
        </tr>
     
  <tr>
          <td>&nbsp;</td>
        </tr>
        <tr align="right">
                <td height="25" align="right" colspan="12"></td>
              </tr>
              <tr>
          <td>&nbsp;</td>
        </tr> 
      

    
<?php 
//if(isset($_POST['submit_data']) && !empty($_POST['longi']) && !empty($_POST['lati'])){
if(isset($_POST['submit_data']) && !empty($_POST['patient_id1'])){
 // print_r($_POST);

//echo "JSG";
$dates=array();
//$con = mysqli_connect("127.0.0.1","root", "", "covid");
if($_POST['patient_id']=="all")
{  

}




else{
  //$date_query="select distinct(Call_Date) as cdates from p34n WHERE FirstcellidaAddress IS NOT NULL  and Call_Date >='2020-03-10' and Patient_id='".$_POST['patient_id']."' order by Call_Date ";

  $date_query="select distinct(Call_Date) as cdates from p34n WHERE FirstcellidaAddress IS NOT NULL  and Patient_id='".$_POST['patient_id1']."' order by Call_Date desc";
  //echo $date_query;

  $date_rs=mysqli_query($con, $date_query);
while($row=mysqli_fetch_assoc($date_rs))
    {
      $dates[]=$row;
      
  }
$temp='';
$long='';
$lat='';
$date=date('Y-m-d H:i:s', strtotime('2020-03-09'));
$flag=0;
$aangwa_miles=0;
$aiims_miles=0;
$mdm_miles=0;
$miles1=0;
$i=1;
if (count($dates)>0)
{
?>
<table width="100%" border="1" cellspacing="2" cellpadding="0" align="center">
  <tr>
    <td> </td>
<!--    <td align="right"><a href="./map.php?pid=<?php echo $_POST['patient_id1']; ?>"  target="_blank"> Click Here to Get Map</a></td></tr>-->
  
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script type="text/javascript">
    function export1()
    {
      //alert("JSG");
      $("#tblData").table2excel({
        exclude: ".excludeThisClass",
        name: "Worksheet Name",
       filename: "<?php echo 'Patient Report'?>.xls", // do include extension
        preserveColors: false // set to true if you want background colors and font colors preserved
    });

    }
</script>
 
<?php

  $del_sql="delete from temp_p where Patient_id='".$_POST['patient_id1']."'";
  $con->query($del_sql);




foreach ($dates as $da) {
  

$roomid_query="SELECT * FROM `p34n` WHERE FirstcellidaAddress IS NOT NULL and Call_Date='".$da['cdates']."' and Patient_id='".$_POST['patient_id1']."' ORDER BY Call_Date desc,Call_Time desc"; 

  //echo $roomid_query."<br>";
    $rs=mysqli_query($con, $roomid_query);
    while($row=mysqli_fetch_assoc($rs))
    {
      //print_r($row);
      $data[]=$row;
      //echo "<br>";
    }
    //$temp=count($data);
    if(mysqli_num_rows($rs)) { 
      //print_r($data);
        ?>
    
      
  
    <?php 
      
    foreach ($data as $d) {
      //print_r($d['Call_Time']);
        $date_cmp=date('Y-m-d H:i:s', strtotime($da['cdates']));
                
      if($long!=$d['Langitude'] && $date!=$da['cdates']){
        //echo ":First JSG";
        //echo $long." ".$date_cmp." ".$d['Rowno']."<br>";

        $long=$d['Langitude'];
        $latitude=$d['Latitude'];
        $date=date('Y-m-d H:i:s', strtotime($d['CALLDATE']));

        if($flag==0){}
          else{
              if($miles1<=($_POST['distance']) || $mdm_miles<=(float)($_POST['distance']) || $aiims_miles<=(float)($_POST['distance']) || $aangwa_miles<=(float)($_POST['distance']))
              { 
               }  
              ?>
        

          </tr>

          <?php } ?>
      

        <?php 
          //echo "JSG".$d['p_longitudeitude'];

        if((number_format($d['p_longitude'],4))==number_format($long,4)){ ?>
              <!--<td height="25" align="center"><?php  echo "-"; ?></td>
              <td height="25" align="center"><?php  echo "-"; ?></td>-->
          <?php  } 
            else{
            
             // echo $d['p_longitudeitude'];
             $theta = $d['p_longitude'] - $long;
              $dist = sin(deg2rad($d['p_latitude'])) * sin(deg2rad($latitude)) +  cos(deg2rad($d['p_latitude'])) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
              $dist = acos($dist);
              $dist = rad2deg($dist);
              $miles1 = number_format((($dist * 60 * 1.1515)*1.60934),2);
              
              //Aaganwa

              $theta = 73.093902 - $long;
              $dist = sin(deg2rad(26.351289)) * sin(deg2rad($latitude)) +  cos(deg2rad(26.351289)) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
              $dist = acos($dist);
              $dist = rad2deg($dist);
              $aangwa_miles = number_format((($dist * 60 * 1.1515)*1.60934),2);


              //MDM

              $theta = 73.009400 - $long;
              $dist = sin(deg2rad(26.264736)) * sin(deg2rad($latitude)) +  cos(deg2rad(26.264736)) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
              $dist = acos($dist);
              $dist = rad2deg($dist);
              $mdm_miles = number_format((($dist * 60 * 1.1515)*1.60934),2);

              //AIIMS

              $theta = 73.005903 - $long;
              $dist = sin(deg2rad(26.240305)) * sin(deg2rad($latitude)) +  cos(deg2rad(26.240305)) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
              $dist = acos($dist);
              $dist = rad2deg($dist);
              $aiims_miles = number_format((($dist * 60 * 1.1515)*1.60934),2);
              //echo $miles1," ".$aangwa_miles." ".$mdm_miles." ".$aiims_miles."<br>";
            
            if($miles1<=(float)($_POST['distance'])|| $mdm_miles<=(float)($_POST['distance']) || $aiims_miles<=(float)($_POST['distance']) || $aangwa_miles<=(float)($_POST['distance'])){ ?>
               <!-- <td height="25" align="center">-</td>
                <td height="25" align="center">-</td>-->

            <?php }
 
              else if($miles1>(float)($_POST['distance']))
                { 
                    //echo $miles1."<br>";

                     $insert_sql="insert into temp_p (Rowno,Patient_id,p_addr,p_latitude,p_longitude,CALLINGA,Call_Date,CALLTYPE,FIRSTCELLIDA,FirstcellidaAddress,Latitude,Langitude,Call_Time,status,distance,buffer) values ('".$d['Rowno']."',
                    '".$d['Patient_id']."',
                    '".$d['p_addr']."',
                    '".$d['p_latitude']."',
                    '".$d['p_longitude']."',
                    '".$d['CALLINGA']."',
                    '".$d['Call_Date']."',
                    '".$d['CALLTYPE']."',
                    '".$d['FIRSTCELLIDA']."',
                    '".$d['FirstcellidaAddress']."',
                    '".$d['Latitude']."',
                    '".$d['Langitude']."',
                    '".$d['Call_Time']."',
                    'Out',
                    '".$miles1."',
                    '".$_POST['distance']."'

                  )";
                 

                    $stmt = mysqli_prepare($con,$insert_sql);
                    mysqli_query($con,$insert_sql);
                    //echo $insert_sql;
                    //echo "JSG data inserted";
  




                  //echo (float)$_POST['distance']." ".$miles;
                ?>
                 <!-- <td height="25" align="center"><?php  echo $miles1; ?></td>
                  <td height="25" align="center"><?php  echo "Out"; ?></td>-->
                <?php }
                 else  if($mdm_miles>(float)($_POST['distance']))
                { 
                  //echo (float)$_POST['distance'];

                  
                     $insert_sql="insert into temp_p (Rowno,Patient_id,p_addr,p_latitude,p_longitude,CALLINGA,Call_Date,CALLTYPE,FIRSTCELLIDA,FirstcellidaAddress,Latitude,Langitude,Call_Time,status,distance,buffer) values ('".$d['Rowno']."',
                    '".$d['Patient_id']."',
                    '".$d['p_addr']."',
                    '".$d['p_latitude']."',
                    '".$d['p_longitude']."',
                    '".$d['CALLINGA']."',
                    '".$d['Call_Date']."',
                    
                    '".$d['CALLTYPE']."',
                    '".$d['FIRSTCELLIDA']."',
                    '".$d['FirstcellidaAddress']."',
                    '".$d['Latitude']."',
                    '".$d['Langitude']."',
                    '".$d['Call_Time']."',
                    'Out',
                    '".$mdm_miles."',
                    '".$_POST['distance']."'

                  )";

                    $stmt = mysqli_prepare($con,$insert_sql);
                    mysqli_query($con,$insert_sql);

                    //echo "JSG data inserted";

                ?>
               <?php }
              else if($aiims_miles>(float)($_POST['distance']))
                { 
                    
                     $insert_sql="insert into temp_p (Rowno,Patient_id,p_addr,p_latitude,p_longitude,CALLINGA,Call_Date,CALLTYPE,FIRSTCELLIDA,FirstcellidaAddress,Latitude,Langitude,Call_Time,status,distance,buffer) values ('".$d['Rowno']."',
                    '".$d['Patient_id']."',
                    '".$d['p_addr']."',
                    '".$d['p_latitude']."',
                    '".$d['p_longitude']."',
                    '".$d['CALLINGA']."',
                    '".$d['Call_Date']."',
                    
                    '".$d['CALLTYPE']."',
                    '".$d['FIRSTCELLIDA']."',
                    '".$d['FirstcellidaAddress']."',
                    '".$d['Latitude']."',
                    '".$d['Langitude']."',
                    '".$d['Call_Time']."',
                    'Out',
                    '".$aiims_miles."',
                    '".$_POST['distance']."'

                  )";

                    $stmt = mysqli_prepare($con,$insert_sql);
                    mysqli_query($con,$insert_sql);
                    //echo "JSG data inserted";


                  //echo (float)$_POST['distance'];
                  ?>
                <!--<td height="25" align="center"><?php  echo $aiims_miles; ?></td>
                  <td height="25" align="center"><?php  echo "Out"; ?></td>-->

              <?php }
              else if($aangwa_miles>(float)($_POST['distance']))
                { 

                    
                     $insert_sql="insert into temp_p (Rowno,Patient_id,p_addr,p_latitude,p_longitude,CALLINGA,Call_Date,CALLTYPE,FIRSTCELLIDA,FirstcellidaAddress,Latitude,Langitude,Call_Time,status,distance,buffer) values ('".$d['Rowno']."',
                    '".$d['Patient_id']."',
                    '".$d['p_addr']."',
                    '".$d['p_latitude']."',
                    '".$d['p_longitude']."',
                    '".$d['CALLINGA']."',
                    '".$d['Call_Date']."',
                    
                    '".$d['CALLTYPE']."',
                    '".$d['FIRSTCELLIDA']."',
                    '".$d['FirstcellidaAddress']."',
                    '".$d['Latitude']."',
                    '".$d['Langitude']."',
                    '".$d['Call_Time']."',
                    'Out',
                    '".$aangwa_miles."',
                    '".$_POST['distance']."'

                  )";

                    $stmt = mysqli_prepare($con,$insert_sql);
                    mysqli_query($con,$insert_sql);
                    ///echo $aangwa_miles." ".$_POST['distance']."<br>";
                    //echo "JSG data inserted";

                ?>
              <!--  <td height="25" align="center"><?php  echo $aangwa_miles; ?></td>
                  <td height="25" align="center"><?php  echo "Out"; ?></td>-->

              <?php }
              else{ ?>


            <?php    }

              $aangwa_miles=0;
              $aiims_miles=0;
              $mdm_miles=0;
              $miles1=0;

            }



             ?>




       <!-- <td height="25" align="center"><?php  echo date('h:i:s A',strtotime($d['Call_Time'])); ?></td>-->

       
      

    
<?php }
      else{ ?>

    <?php }
      ?>
    

    <?php 
        $endtime=$d['Call_Time'];
        $flag=1;

    //}

    }
}
     ?>
     
          </tr>
          

          </tr>
    <?php $flag=0; //$i=1 ?>      

<?php 
  unset($data);
  $long='';
}
?>
</table>
<?php } 
else {

    echo "<B><font color='red'>Please Refresh Page</font></b>";
  }
  

}




} 
else{
  //echo "<b>Enter Proper Home Location for Patient. (By Default it is MDM Hospital)</b>";
}

?>
<?php  
if(isset($_POST['patient_id1'])){
  $data=array();
  $points_map=array();
  $i=0;
  //echo "JSG";
  $sql="select * from temp_p where Patient_id='".$_POST['patient_id1']."' order by Call_Date desc,Call_Time desc";
  //$sql="select *,MIN(Call_Date) AS mindate, MAX(Call_Date) AS maxdate from temp_p where Patient_id='".$_POST['patient_id1']."' order by Call_Date desc";
  $date_sql="select MIN(Call_Date) AS mindate, MAX(Call_Date) AS maxdate from temp_p where Patient_id='".$_POST['patient_id1']."'";
  //echo $date_sql;
  $date_rs=mysqli_query($con, $date_sql);
  $date_row=mysqli_fetch_assoc($date_rs);
 // print_r($date_row);

 // $point_sql="select distinct Langitude,Latitude from temp_p where Patient_id='".$_POST['patient_id1']."' ";
  //echo $sql;
  $rs=mysqli_query($con, $sql);
    while($row=mysqli_fetch_assoc($rs))
    {
      //print_r($row);
      $data[]=$row;
      /*if(!in_array($value, $array)){
      $points[$i]['Latitude']=$row['Latitude'];
      $points[$i++]['Longitude']=$row['Langitude'];*/
    }

   /* $p_rs=mysqli_query($con, $point_sql);
    while($row=mysqli_fetch_assoc($p_rs))
    {
      //print_r($row);
      $points_map[]=$row;
      
    }*/
    //print_r($points_map);




      //echo "<br>";
    
?>    

 <script type="text/javascript">
 /* function loadMap() {
    var mapOptions = {
        center: new google.maps.LatLng(26.274642, 73.078174),
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  var points = <?php echo json_encode( $points_map ) ?>;
  //points = points.map(point => [parseFloat(point["Latitude"]), parseFloat(point["Langitude"])]);
  //alert(points[0][0]+" "+points[0][1]);
    var points = [[26.274642, 73.078174], [26.274642, 73.075074], [26.273642, 73.075074]]
    //alert(points[0]);


    for (let point of points) {
       var marker = new google.maps.Marker({
            position: new google.maps.LatLng(point[0], point[1]),
            map: map, 
      title : 'Patient Postitions'+point

        });
    var circle = new google.maps.Circle({
      map: map,
      radius: 700,    // 10 miles in metres
      fillColor: '#FF6600',
            fillOpacity: 0.05,
            strokeColor: "#FFF",
            strokeWeight: 1   
    });
    circle.bindTo('center', marker, 'position');

    }
}
  */
  
  </script>
    
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align="center"><b>Home Address: <?php echo $data[0]['p_addr']; ?></b>  </td>
  </tr>
  <tr>
    <td align="center"><b>Data Available From: <?php echo date('d-m-Y', strtotime($date_row['mindate']))." "; ?> To: <?php echo date('d-m-Y', strtotime($date_row['maxdate']))." "; ?></b>  </td>
  </tr>

</table>




<table width="100%" border="1" cellspacing="0" cellpadding="0" id="tblData">
      <tr>
    <td colspan="15" height="1" align="center"> <b>Patient Data P-<?php echo $_POST['patient_id1'];?></b></td>
      </tr>
      <tr>
        <td align="center"><b>S. No. </b></td>
        <td align="center"><b>Patient_Id </b></td>
        <td align="center"><b>Call_Date</b></td>
        <td align="center"><b>Call_Type</b></td>
        <td align="center"><b>Tower_Id</b></td>
        <td align="center"><b>Longitude</b></td>
        <td align="center"><b>Latitude </b></td>
        <td align="center"><b>Tower_Location</b></td>
        <th align="center"><b>Distance (KM)</b></th>
        <th align="center"><b>Status</b></th>
        <td align="center"><b>Last Call Time</b></td>
      <!--  <td align="center"><b>End Time</b></td>-->
          
          </tr>




  
<?php
      $i=1;
    foreach ($data as $d) {
      ?>
      <tr>
        <td height="25" align="center"><?php  echo $i++; ?></td>
        <td height="25" align="center"><?php  echo $d['Patient_id']; ?></td>
        <td height="25" align="center"><?php  echo  date('d-m-Y', strtotime($d['Call_Date'])) ; ?></td>
        <td height="25" align="center"><?php  echo $d['CALLTYPE']; ?></td>
        <td height="25" align="center"><?php  echo $d['FIRSTCELLIDA']; ?></td>
        <td height="25" align="center"><?php  echo number_format($d['Langitude'],6); ?></td>
        <td height="25" align="center"><?php  echo number_format($d['Latitude'],6); ?></td>
        <td height="25" align="center"><?php  echo $d['FirstcellidaAddress']; ?></td>
        <td height="25" align="center"><?php  echo $d['distance']; ?></td>
         <td height="25" align="center"><?php  echo $d['status']; ?></td>
        <td height="25" align="center"><?php  echo date('h:i:s A',strtotime($d['Call_Time'])); ?></td>
        

      </tr>

    <?php } //end of for ?>
  
    </table>
<?php 
  

} //end patient id 1



?>







</form>

  </table>
</body>

</html>
<!--echo $long;
              /*$earth_radius = 6371;
 
               $dLat = deg2rad($_POST['lati']- $latitude);
               $dLon = deg2rad($_POST['longi'] - $long);
 
              $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($_POST['lati'])) * cos(deg2rad($latitude)) * sin($dLon/2) * sin($dLon/2);
              $c = 2 * asin(sqrt($a));
              $miles1 = $earth_radius * $c;*/-->

