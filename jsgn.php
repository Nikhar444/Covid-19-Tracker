

	<?php 
  include("header.php");
	 
	$pat_query="select distinct(Patient_id) as pid from p34n order by Patient_id ";

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
		<form action="" method="post" name="track">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>&nbsp;</td>
				</tr>
				<style>
    select {
        width: 150px;
        margin: 10px;
    }
    select:focus {
        min-width: 150px;
        width: auto;
    }    
</style>
				<tr>
					
					<td align="center" colspan="3">Select Patient id Here  &nbsp;&nbsp;&nbsp; 
				<SELECT NAME="patient_id"width="10px" >
					<?php foreach ($pat_id as $pid) {  
						if(isset($_POST['patient_id'])){
						?>
				<option value="<?php echo $pid['pid']; ?>" <?php if ($pid['pid']==$_POST['patient_id']) { echo "selected"; }?> >p<?php echo $pid['pid']; ?></option>

				<?php }

					else { ?>
							<option value="<?php echo $pid['pid']; ?>">p<?php echo $pid['pid']; ?></option>

			<?php	
							}		

					}


				?>
				<!--<option value="all">ALL</option>-->
				</SELECT></td></tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<!--<tr>
				<td align="center"> Select From Date &nbsp;	<input type="date" name="pdate"></td>
				</tr>-->
				
				<tr>
					<td align="center">Enter  Latitude&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="lati" value="26.264736"></td>

				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="center">Enter Longitude&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="longi" value="73.009400"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="center">Enter Distance (In <b>KM</b>)&nbsp;<input type="text" name="distance" value="0" size="18"></td>
				</tr>
				<tr>
					<td>&nbsp;</td> 
				</tr>
				<tr>
					<td align="center">
						<input type="submit" name="submit_data" value="Submit">&nbsp;&nbsp;&nbsp; 
						<!--<input type="submit" name="submit_data2" value="Submit (upto 2 Decimal Points Lat-Long)">-->
					</td>
					<td align="center">
						
					</td>
				</tr>
					
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr align="right">
                <td height="25" align="right" colspan="12"><button onclick="export1()">Export To Excel File</button></td>
              </tr>
              <tr>
					<td>&nbsp;</td>
				</tr> 
			

		
<?php 
if(isset($_POST['submit_data']) && !empty($_POST['longi']) && !empty($_POST['lati'])){
//echo "JSG";
$dates=array();
//$con = mysqli_connect("127.0.0.1","root", "", "covid");
if($_POST['patient_id']=="all")
{  /* ?>
	<table width="100%" border="1" cellspacing="2" cellpadding="0" align="center" id="tblData">
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
	<tr>
	<td colspan="15" height="1" align="center"> <b>Patient Data (All Patients)</b></td>
   		</tr>
   		<tr>
   			<td align="center"><b>S. No. </b></td>
   			<th align="center"><b>Patient_Id </b></th>
   			<th align="center"><b>Call_Date</b></th>
   			<th align="center"><b>Call_Type</b></th>
   			<th align="center"><b>Tower_Id</b></th>
   			<th align="center"><b>Longitude</b></th>
   			<th align="center"><b>Latitude </b></th>
   			<th align="center"><b>Tower_Location</b></th>
   			<th align="center"><b>Approximate_Area</b></th>
   			<th align="center"><b>Start Time</b></th>
   			<th align="center"><b>End Time</b></th>
   			<th align="center"><b>Distance (KM)</b></th>
   			<th align="center"><b>Status</b></th>
   					
   		    </tr>
<?php
	//$date_query="SELECT DISTINCT patient_id,Call_Date AS cdates FROM p34n WHERE FirstcellidaAddress IS NOT NULL  AND Call_Date >='2020-03-10'  ORDER BY patient_id,Call_Date ";

	$date_query="SELECT DISTINCT patient_id,Call_Date AS cdates FROM p34n WHERE FirstcellidaAddress IS NOT NULL  ORDER BY patient_id,Call_Date ";
	//echo $date_query;
	$date_rs=mysqli_query($con, $date_query);
	while($row=mysqli_fetch_assoc($date_rs))
		{
			$dates[]=$row;
			
	}
$temp='';
$long='';
$lat='';
$patfor_date='';
//print_r($dates);
$date=date('Y-m-d H:i:s', strtotime('2020-03-09'));
$flag=0;
$i=1;
if (count($dates)>0)
{
?>

<?php
foreach ($dates as $da) {
	//$patfor_date=$da['patient_id'];
	if($patfor_date!=$da['patient_id']){
		$i=1;
		$patfor_date=$da['patient_id'];
	}

$roomid_query="SELECT * FROM `p34n` WHERE FirstcellidaAddress IS NOT NULL and Call_Date='".$da['cdates']."' and Patient_id='".$da['patient_id']."' ORDER BY Patient_id,Call_Date,Call_Time"; 

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
			$date_cmp=date('Y-m-d H:i:s', strtotime($da['cdates']));
								
			if($long!=$d['Langitude'] && $date!=$da['cdates']){
				//echo ":First JSG";
				//echo $long." ".$date_cmp." ".$d['Rowno']."<br>";

				$long=$d['Langitude'];
				$latitude=$d['Latitude'];
				$date=date('Y-m-d H:i:s', strtotime($d['CALLDATE']));

				if($flag==0){}
					else{
	
						$theta = $_POST['longi'] - $long;
    					$dist = sin(deg2rad($_POST['lati'])) * sin(deg2rad($latitude)) +  cos(deg2rad($_POST['lati'])) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
   						$dist = acos($dist);
    					$dist = rad2deg($dist);
    					$miles = number_format((($dist * 60 * 1.1515)*1.60934),2);
    					$meter_miles=number_format(($miles/1000),2);

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
    					
    					

						
						?>
						<td height="25" align="center"><?php	echo date('h:i:s A',strtotime($endtime)) ?></td>
						
						<?php if($miles>$_POST['distance'])
								{?>
									<td height="25" align="center"><?php	echo $miles; ?></td>
									<td height="25" align="center"><?php	echo "Out"; ?></td>
								<?php }
							else if($mdm_miles>$_POST['distance']){ ?>
								<td height="25" align="center"><?php	echo $mdm_miles; ?></td>
							    <td height="25" align="center"><?php	echo "Out"; ?></td>

							<?php }
							else if($aiims_miles>$_POST['distance']){ ?>
								<td height="25" align="center"><?php	echo $aiims_miles; ?></td>
							    <td height="25" align="center"><?php	echo "Out"; ?></td>

							<?php }
							else if($aangwa_miles>$_POST['distance'])
							{ ?>
								<td height="25" align="center"><?php	echo $aangwa_miles; ?></td>
							    <td height="25" align="center"><?php	echo "Out"; ?></td>

							<?php }
							else{ ?>	
								<td height="25" align="center"><?php	echo "-"; ?></td>
								<td height="25" align="center"><?php	echo "-"; ?></td>

						<?php } ?>

					<?php } ?>
			

			<tr>
				<td height="25" align="center"><?php	echo $i++; ?></td>
				<td height="25" align="center"><?php	echo $d['Patient_id']; ?></td>
				<td height="25" align="center"><?php	echo $d['CALLDATE']; ?></td>
				<td height="25" align="center"><?php	echo $d['CALLTYPE']; ?></td>
				<td height="25" align="center"><?php	echo $d['FIRSTCELLIDA']; ?></td>
				<td height="25" align="center"><?php	echo $d['Langitude']; ?></td>
				<td height="25" align="center"><?php	echo $d['Latitude']; ?></td>
				<td height="25" align="center"><?php	echo $d['FirstcellidaAddress']; ?></td>
				<!--<td height="25" align="center"><?php	echo $d['CALLDATE']; ?></td>
				<td height="25"><?php	echo date('h:i:s A',strtotime($d['Call_Time'])) ?></td>-->
				<td height="25" align="center"><?php	//echo "Yet to be decided." ?></td>
				<td height="25" align="center"><?php	echo date('h:i:s A',strtotime($d['Call_Time'])); ?></td>
				

		
<?php	}
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

		 		
				<?php	$theta = $_POST['longi'] - $long;
    					$dist = sin(deg2rad($_POST['lati'])) * sin(deg2rad($latitude)) +  cos(deg2rad($_POST['lati'])) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
   						$dist = acos($dist);
    					$dist = rad2deg($dist);
    					$miles = number_format((($dist * 60 * 1.1515)*1.60934),2);
    					$meter_miles=number_format(($miles/1000),2);

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
    					
    					

						
						?>
						<td height="25" align="center"><?php	echo date('h:i:s A',strtotime($endtime)) ?></td>
						
						<?php if($miles>$_POST['distance'])
								{?>
									<td height="25" align="center"><?php	echo $miles; ?></td>
									<td height="25" align="center"><?php	echo "Out"; ?></td>
								<?php }
							else if($mdm_miles>$_POST['distance']){ ?>
								<td height="25" align="center"><?php	echo $mdm_miles; ?></td>
							    <td height="25" align="center"><?php	echo "Out"; ?></td>

							<?php }
							else if($aiims_miles>$_POST['distance']){ ?>
								<td height="25" align="center"><?php	echo $aiims_miles; ?></td>
							    <td height="25" align="center"><?php	echo "Out"; ?></td>

							<?php }
							else if($aangwa_miles>$_POST['distance'])
							{ ?>
								<td height="25" align="center"><?php	echo $aangwa_miles; ?></td>
							    <td height="25" align="center"><?php	echo "Out"; ?></td>

							<?php }
							else{ ?>	
								<td height="25" align="center"><?php	echo "-"; ?></td>
								<td height="25" align="center"><?php	echo "-"; ?></td>

						<?php } ?>

					</tr>
		<?php $flag=0; ?>			
<!--	<tr>
		<td  colspan="7">&nbsp;</td>
	</tr> -->

<?php	
	unset($data);
	$long='';
}
?>
</table>
</div>
<?php } 
else {

		echo "Selected Date Not Available";
	}
	
*/

}




else{
	//$date_query="select distinct(Call_Date) as cdates from p34n WHERE FirstcellidaAddress IS NOT NULL  and Call_Date >='2020-03-10' and Patient_id='".$_POST['patient_id']."' order by Call_Date ";

	$date_query="select distinct(Call_Date) as cdates from p34n WHERE FirstcellidaAddress IS NOT NULL  and Patient_id='".$_POST['patient_id']."' order by Call_Date ";

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
<table width="100%" border="1" cellspacing="2" cellpadding="0" align="center" id="tblData">
	
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
   <tr>
   	<td colspan="15" height="1" align="center"> <b>Patient Data P-<?php echo $_POST['patient_id'];?></b></td>
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
        <td align="center"><b>Start Time</b></td>
        <td align="center"><b>End Time</b></td>
   				
   		    </tr>
<?php
foreach ($dates as $da) {
	

$roomid_query="SELECT * FROM `p34n` WHERE FirstcellidaAddress IS NOT NULL and Call_Date='".$da['cdates']."' and Patient_id='".$_POST['patient_id']."' ORDER BY Call_Date,Call_Time"; 

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
         /*   $aangwa_miles=0;
            $aiims_miles=0;
            $mdm_miles=0;
            $miles1=0;*/
						//$miles=0;?>
						<td height="25" align="center"><?php	echo date('h:i:s A',strtotime($endtime)); ?></td>
						<?php
					
						?>
						
						
						<?php 
							//echo "new miles".$miles;
							if($miles1<=($_POST['distance']) || $mdm_miles<=(float)($_POST['distance']) || $aiims_miles<=(float)($_POST['distance']) || $aangwa_miles<=(float)($_POST['distance']))
							{ ?>
								
							<?php }  
							?>
				

					</tr>

					<?php } ?>
			

			<tr>
				<td height="25" align="center"><?php	echo $i++; ?></td>
				<td height="25" align="center"><?php	echo $d['Patient_id']; ?></td>
				<td height="25" align="center"><?php	echo $d['CALLDATE']; ?></td>
				<td height="25" align="center"><?php	echo $d['CALLTYPE']; ?></td>
				<td height="25" align="center"><?php	echo $d['FIRSTCELLIDA']; ?></td>
				<td height="25" align="center"><?php	echo number_format($d['Langitude'],6); ?></td>
				<td height="25" align="center"><?php	echo number_format($d['Latitude'],6); ?></td>
				<td height="25" align="center"><?php	echo $d['FirstcellidaAddress']; ?></td>
				<!--<td height="25" align="center"><?php	echo $d['CALLDATE']; ?></td>
				<td height="25"><?php	echo date('h:i:s A',strtotime($d['Call_Time'])) ?></td>
				<td height="25" align="center"><?php	//echo "Yet to be decided." ?></td>-->
        <?php if((number_format($_POST['longi'],4))==number_format($long,4)){ ?>
              <td height="25" align="center"><?php  echo "-"; ?></td>
              <td height="25" align="center"><?php  echo "-"; ?></td>
          <?php  } 
            else{
            //echo $long;
              $theta = $_POST['longi'] - $long;
              $dist = sin(deg2rad($_POST['lati'])) * sin(deg2rad($latitude)) +  cos(deg2rad($_POST['lati'])) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
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
                <td height="25" align="center">-</td>
                <td height="25" align="center">-</td>

            <?php }
 
              else if($miles1>(float)($_POST['distance']))
                { 
                  //echo (float)$_POST['distance']." ".$miles;
                ?>
                  <td height="25" align="center"><?php  echo $miles1; ?></td>
                  <td height="25" align="center"><?php  echo "Out"; ?></td>
                <?php }
                 else  if($mdm_miles>(float)($_POST['distance']))
                { 
                  //echo (float)$_POST['distance'];
                ?>
                <td height="25" align="center"><?php  echo $mdm_miles; ?></td>
                  <td height="25" align="center"><?php  echo "Out"; ?></td>

              <?php }
              else if($aiims_miles>(float)($_POST['distance']))
                { 
                  //echo (float)$_POST['distance'];
                  ?>
                <td height="25" align="center"><?php  echo $aiims_miles; ?></td>
                  <td height="25" align="center"><?php  echo "Out"; ?></td>

              <?php }
              else if($aangwa_miles>(float)($_POST['distance']))
                { 
                ?>
                <td height="25" align="center"><?php  echo $aangwa_miles; ?></td>
                  <td height="25" align="center"><?php  echo "Out"; ?></td>

              <?php }
              else{ ?>


            <?php    }

              $aangwa_miles=0;
              $aiims_miles=0;
              $mdm_miles=0;
              $miles1=0;

            }



             ?>




				<td height="25" align="center"><?php	echo date('h:i:s A',strtotime($d['Call_Time'])); ?></td>

       
			

		
<?php	}
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
		 <?php	
						$counter=0;
					/*	if((number_format($_POST['longi'],4))==number_format($long,4)){
							$miles=0;
							//echo "miles n".$miles;
							//if($miles<=(float)($_POST['distance']))
							//	echo $_POST['longi']."JSG".$miles."<br>";
						}
						else{
						$theta = $_POST['longi'] - $long;
    					$dist = sin(deg2rad($_POST['lati'])) * sin(deg2rad($latitude)) +  cos(deg2rad($_POST['lati'])) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
   						$dist = acos($dist);
    					$dist = rad2deg($dist);
    					$miles= number_format((($dist * 60 * 1.1515)*1.60934),2);
    					$meter_miles=number_format(($miles/1000),2);
    				
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

    					//AIIMS  || $mdm_miles<=(float)($_POST['distance']) || $aiims_miles<=(float)($_POST['distance']) || $aangwa_miles<=(float)($_POST['distance']) 

    					$theta = 73.005903 - $long;
    					$dist = sin(deg2rad(26.240305)) * sin(deg2rad($latitude)) +  cos(deg2rad(26.240305)) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
   						$dist = acos($dist);
    					$dist = rad2deg($dist);
    					$aiims_miles = number_format((($dist * 60 * 1.1515)*1.60934),2);
    					}
    					

						
						?>
						<td height="25" align="center"><?php	echo date('h:i:s A',strtotime($endtime)) ?></td>
						
						<?php 
						//echo $miles."IF";
						if($miles<=(float)($_POST['distance'])|| $mdm_miles<=(float)($_POST['distance']) || $aiims_miles<=(float)($_POST['distance']) || $aangwa_miles<=(float)($_POST['distance']))
							{ ?>
								<td height="25" align="center"><?php	echo "-"; ?></td>
							    <td height="25" align="center"><?php	echo "-"; ?></td>
							<?php } else if($miles>(float)($_POST['distance']))
								{	
								?>
									<td height="25" align="center"><?php	echo $miles; ?></td>
									<td height="25" align="center"><?php	echo "Out"; ?></td>
								<?php }
								else if($mdm_miles>(float)($_POST['distance']))
								{	
								?>
								<td height="25" align="center"><?php	echo $mdm_miles; ?></td>
							    <td height="25" align="center"><?php	echo "Out"; ?></td>

							<?php }
							else if($aiims_miles>(float)($_POST['distance']))
								{	
									?>
								<td height="25" align="center"><?php	echo $aiims_miles; ?></td>
							    <td height="25" align="center"><?php	echo "Out"; ?></td>

							<?php }
							else if($aangwa_miles>(float)($_POST['distance']))
								{	
								?>
								<td height="25" align="center"><?php	echo $aangwa_miles; ?></td>
							    <td height="25" align="center"><?php	echo "Out"; ?></td>

							<?php }*/
							?> 
              <td height="25"><?php echo date('h:i:s A',strtotime($endtime)); 
        
      ?></td>
          </tr>

					</tr>
		<?php $flag=0; //$i=1 ?>			
<!--	<tr>
		<td  colspan="7">&nbsp;</td>
	</tr> -->

<?php	
	unset($data);
	$long='';
}
?>
</table>
<?php } 
else {

		echo "Selected Date Not Available";
	}
	

}




} 
else{
	echo "<b>Enter Proper Home Location for Patient. (By Default it is MDM Hospital)</b>";
}

?>



<?php 
if(isset($_POST['submit_data2']) && !empty($_POST['longi']) && !empty($_POST['lati'])){
	//echo "JSG";
$dates=array();
//$con = mysqli_connect("127.0.0.1","root", "", "covid");
if($_POST['patient_id']=="all")
{ ?>
	<table width="100%" border="1" cellspacing="2" cellpadding="0" align="center" id="tblData">
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
	<tr>
	<td colspan="12" height="1" align="center"> <b>Patient Data (All Patients)</b></td>
   		</tr>
   		<tr>
   			<td align="center"><b>S. No. </b></td>
   			<th align="center"><b>Patient_Id </b></th>
   			<th align="center"><b>Call_Date</b></th>
   			<th align="center"><b>Call_Type</b></th>
   			<th align="center"><b>Tower_Id</b></th>
   			<th align="center"><b>Longitude</b></th>
   			<th align="center"><b>Latitude </b></th>
   			<th align="center"><b>Tower_Location</b></th>
   			<th align="center"><b>Approximate_Area</b></th>
   			<th align="center"><b>Start Time</b></th>
   			<th align="center"><b>End Time</b></th>
   					
   		    </tr>
<?php
	//$date_query="SELECT DISTINCT patient_id,Call_Date AS cdates FROM p34n WHERE FirstcellidaAddress IS NOT NULL  AND Call_Date >='2020-03-10'  ORDER BY patient_id,Call_Date ";

	$date_query="SELECT DISTINCT patient_id,Call_Date AS cdates FROM p34n WHERE FirstcellidaAddress IS NOT NULL  ORDER BY patient_id,Call_Date ";
	//echo $date_query;
	$date_rs=mysqli_query($con, $date_query);
	while($row=mysqli_fetch_assoc($date_rs))
		{
			$dates[]=$row;
			
	}
$temp='';
$long='';
$lat='';
$patfor_date='';
//print_r($dates);
$date=date('Y-m-d H:i:s', strtotime('2020-03-09'));
$flag=0;
$i=1;
if (count($dates)>0)
{
?>

<?php
foreach ($dates as $da) {
	//$patfor_date=$da['patient_id'];
	if($patfor_date!=$da['patient_id']){
		$i=1;
		$patfor_date=$da['patient_id'];
	}

$roomid_query="SELECT * FROM `p34n` WHERE FirstcellidaAddress IS NOT NULL and Call_Date='".$da['cdates']."' and Patient_id='".$da['patient_id']."' ORDER BY Patient_id,Call_Date,Call_Time"; 

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
			$date_cmp=date('Y-m-d H:i:s', strtotime($da['cdates']));
								
			//if($long!=$d['Langitude'] && $date!=$da['cdates']){
			if((substr($long, 0, 5)!=(substr($d['Langitude'], 0, 5)) && $date!=$da['cdates'])){
				//echo ":First JSG";
				//echo $long." ".$date_cmp." ".$d['Langitude']."<br>";

				$long=$d['Langitude'];
				$date=date('Y-m-d H:i:s', strtotime($d['CALLDATE']));

				if($flag==0){}
					else{
						
						?>
						<td height="25"><?php	echo date('h:i:s A',strtotime($endtime)) ?></td>
					</tr>

					<?php } ?>
			

			<tr>
				<td height="25" align="center"><?php	echo $i++; ?></td>
				<td height="25" align="center"><?php	echo $d['Patient_id']; ?></td>
				<td height="25" align="center"><?php	echo $d['CALLDATE']; ?></td>
				<td height="25" align="center"><?php	echo $d['CALLTYPE']; ?></td>
				<td height="25" align="center"><?php	echo $d['FIRSTCELLIDA']; ?></td>
				<td height="25" align="center"><?php	echo $d['Langitude']; ?></td>
				<td height="25" align="center"><?php	echo $d['Latitude']; ?></td>
				<td height="25" align="center"><?php	echo $d['FirstcellidaAddress']; ?></td>
				<!--<td height="25" align="center"><?php	echo $d['CALLDATE']; ?></td>
				<td height="25"><?php	echo date('h:i:s A',strtotime($d['Call_Time'])) ?></td>-->
				<td height="25" align="center"><?php	//echo "Yet to be decided." ?></td>
				<td height="25" align="center"><?php	echo date('h:i:s A',strtotime($d['Call_Time'])); ?></td>
				

		
<?php	}
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
			<td height="25"><?php	echo date('h:i:s A',strtotime($endtime)); 
				
			?></td>
					</tr>
		<?php $flag=0; ?>			
<!--	<tr>
		<td  colspan="7">&nbsp;</td>
	</tr> -->

<?php	
	unset($data);
	$long='';
}
?>
</table>
</div>
<?php } 
else {

		echo "Selected Date Not Available";
	}
	


}




else{
	//$date_query="select distinct(Call_Date) as cdates from p34n WHERE FirstcellidaAddress IS NOT NULL  and Call_Date >='2020-03-10' and Patient_id='".$_POST['patient_id']."' order by Call_Date ";

	$date_query="select distinct(Call_Date) as cdates from p34n WHERE FirstcellidaAddress IS NOT NULL  and Patient_id='".$_POST['patient_id']."' order by Call_Date ";

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
$i=1;
if (count($dates)>0)
{
?>
<table width="100%" border="1" cellspacing="2" cellpadding="0" align="center" id="tblData">
	
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
   <tr>
   	<td colspan="12" height="1" align="center"> <b>Patient Data P-<?php echo $_POST['patient_id'];?></b></td>
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
   			<td align="center"><b>Approximate_Area</b></td>
   			<td align="center"><b>Start Time</b></td>
   			<td align="center"><b>End Time</b></td>
   				
   		    </tr>
<?php
foreach ($dates as $da) {
	

$roomid_query="SELECT * FROM `p34n` WHERE FirstcellidaAddress IS NOT NULL and Call_Date='".$da['cdates']."' and Patient_id='".$_POST['patient_id']."' ORDER BY Call_Date,Call_Time"; 

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
								
			//if($long!=$d['Langitude'] && $date!=$da['cdates']){
				if((substr($long, 0, 5)!=(substr($d['Langitude'], 0, 5)) && $date!=$da['cdates'])){
				//echo ":First JSG";
				//echo $long." ".$date_cmp." ".$d['Rowno']."<br>";

				$long=$d['Langitude'];
				$date=date('Y-m-d H:i:s', strtotime($d['CALLDATE']));

				if($flag==0){}
					else{
						
						?>
						<td height="25"><?php	echo date('h:i:s A',strtotime($endtime)) ?></td>
					</tr>

					<?php } ?>
			

			<tr>
				<td height="25" align="center"><?php	echo $i++; ?></td>
				<td height="25" align="center"><?php	echo $d['Patient_id']; ?></td>
				<td height="25" align="center"><?php	echo $d['CALLDATE']; ?></td>
				<td height="25" align="center"><?php	echo $d['CALLTYPE']; ?></td>
				<td height="25" align="center"><?php	echo $d['FIRSTCELLIDA']; ?></td>
				<td height="25" align="center"><?php	echo $d['Langitude']; ?></td>
				<td height="25" align="center"><?php	echo $d['Latitude']; ?></td>
				<td height="25" align="center"><?php	echo $d['FirstcellidaAddress']; ?></td>
				<!--<td height="25" align="center"><?php	echo $d['CALLDATE']; ?></td>
				<td height="25"><?php	echo date('h:i:s A',strtotime($d['Call_Time'])) ?></td>-->
				<td height="25" align="center"><?php	//echo "Yet to be decided." ?></td>
				<td height="25" align="center"><?php	echo date('h:i:s A',strtotime($d['Call_Time'])); ?></td>
			

		
<?php	}
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
			<td height="25"><?php	echo date('h:i:s A',strtotime($endtime)); 
				
			?></td>
					</tr>
		<?php $flag=0; //$i=1 ?>			
<!--	<tr>
		<td  colspan="7">&nbsp;</td>
	</tr> -->

<?php	
	unset($data);
	$long='';
}
?>
</table>
<?php } 
else {

		echo "Selected Date Not Available";
	}
	

}




} 

?>








</form>

	</table>
</body>

</html>