<html>
<title>Patient Tracking System</title>
<body>
    <div id="map" style="width:80%;height:500px;"></div>
    </div>
	<?php 
	$con = mysqli_connect("localhost","jodhdoit", "Doit@123", "covid"); 
	//$con = mysqli_connect("localhost","root", "", "covid1");
	$pid=$_GET['pid'];
	
	//$pat_query="select distinct Latitude,Langitude,FirstcellidaAddress from temp_r where Patient_id='".$pid."'";
	$pat_query="SELECT Rowno,Langitude,Latitude,CALLDATE,FirstcellidaAddress
				FROM temp_r
				WHERE Langitude IN
				(
				    SELECT Langitude
				    FROM temp_r
				    GROUP BY Langitude,Latitude
				) AND patient_id='".$pid."'";
	//echo $pat_query;

	$pat_rs=mysqli_query($con, $pat_query);
	while($row=mysqli_fetch_assoc($pat_rs))
		{
			//print_r($row);
			$pat_id1[]=$row;
			//echo $dates['cdates']."<br>";
	}
	$pat_ll="select distinct p_latitude,p_longitude,FirstcellidaAddress from temp_r where Patient_id='".$pid."'";
	$pat_rsll=mysqli_query($con, $pat_ll);
	$row_ll=mysqli_fetch_assoc($pat_rsll)

	
	?>

    <script type="text/javascript">
	function loadMap() {
    var mapOptions = {
        center: new google.maps.LatLng(26.274642, 73.078174),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
	var points = <?php echo json_encode( $pat_id1 ) ?>;
	points = points.map(point => [parseFloat(point["Latitude"]), parseFloat(point["Langitude"]),point["FirstcellidaAddress"],point["CALLDATE"]]);
	//alert(points[0][0]+" "+points[0][1]);
    var points1 = [[26.351289, 73.093902, 'Anganwa'], [26.264736, 73.009400,'MDM'], [26.240305, 73.005903,'AIIMS'],[<?php echo $row_ll['p_latitude'] ?>, <?php echo $row_ll['p_longitude'] ?> ,'Patient Home'  ]]
		//alert(points[0]);

		for (let point of points1) {
		   var marker = new google.maps.Marker({
            position: new google.maps.LatLng(point[0], point[1]),
	icon: {
      		  path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
        		  strokeColor: "blue",
		  scale: 5
   			 },
            map: map,	
			title : point[2]

        });
		 n=point[2].localeCompare('Patient Home');
		 if(n==0){
		var circle = new google.maps.Circle({
		  map: map,
		  radius: 500,    // 10 miles in metres
		  fillColor: '#03fc39',
            fillOpacity: 0.3,
            strokeColor: "#343deb",
            strokeWeight: 4   
		});
		circle.bindTo('center', marker, 'position');
	}
	else{
		var circle = new google.maps.Circle({
		  map: map,
		  radius: 500,    // 10 miles in metres
		  fillColor: '#FF6600',
            fillOpacity: 0.1,
            strokeColor: "#42f5a1",
            strokeWeight: 4   
		});
		circle.bindTo('center', marker, 'position');

	}

    }




    for (let point of points) {
		   var marker = new google.maps.Marker({
            position: new google.maps.LatLng(point[0], point[1]),
            map: map,	
			title : 'Patient Postition: '+point[2]+':'+point[3]

        });
		/*var circle = new google.maps.Circle({
		  map: map,
		  radius: 500,    // 10 miles in metres
		  fillColor: '#FF6600',
            fillOpacity: 0.2,
            strokeColor: "#FFF",
            strokeWeight: 2   
		});
		circle.bindTo('center', marker, 'position');*/

    }
}
	
	
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvxdIBNs56ryQXcayAaS1SXe1yecKrBy4&callback=loadMap">
    </script>
	<?php echo "<font color='red'><b>Map for Relative Id :-" .$pid."</b></font>";
		echo "<br>";
		echo "<font color='red'>If Coordinates are from outside Jodhpur, then reduce map size by clicking '-' to see Markers</font>";


	 ?>

</body>

</html>