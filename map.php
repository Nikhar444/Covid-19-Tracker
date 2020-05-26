<html>

<body>
    <div id="map" style="width:80%;height:500px;"></div>
    </div>
	<?php 
	//$con = mysqli_connect("localhost","jodhdoit", "Doit@123", "covid"); 
	$con = mysqli_connect("localhost","root", "", "covid1");
	$pid=$_GET['pid'];
	
	$pat_query="select distinct Latitude,Langitude from temp_p where Patient_id='".$pid."'";
	//echo $pat_query;

	$pat_rs=mysqli_query($con, $pat_query);
	while($row=mysqli_fetch_assoc($pat_rs))
		{
			//print_r($row);
			$pat_id1[]=$row;
			//echo $dates['cdates']."<br>";
	}
	
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
	points = points.map(point => [parseFloat(point["Latitude"]), parseFloat(point["Langitude"])]);
	//alert(points[0][0]+" "+points[0][1]);
    var points1 = [[26.351289, 73.093902], [26.264736, 73.009400], [26.240305, 73.005903]]
		//alert(points[0]);

		for (let point of points1) {
		   var marker = new google.maps.Marker({
            position: new google.maps.LatLng(point[0], point[1]),
            map: map,	
			title : 'Patient Postitions'+point

        });
		var circle = new google.maps.Circle({
		  map: map,
		  radius: 500,    // 10 miles in metres
		  fillColor: '#FF6600',
            fillOpacity: 0.1,
            strokeColor: "#42f5a1",
            strokeWeight: 3   
		});
		circle.bindTo('center', marker, 'position');

    }




    for (let point of points) {
		   var marker = new google.maps.Marker({
            position: new google.maps.LatLng(point[0], point[1]),
            map: map,	
			title : 'Patient Postitions'+point

        });
		var circle = new google.maps.Circle({
		  map: map,
		  radius: 500,    // 10 miles in metres
		  fillColor: '#FF6600',
            fillOpacity: 0.1,
            strokeColor: "#FFF",
            strokeWeight: 2   
		});
		circle.bindTo('center', marker, 'position');

    }
}
	
	
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUF0ITSHmh6aCAyEa-yHFzCn_-NInARbk&callback=loadMap">
    </script>
	<?php echo "<font color='red'><b>Map for Patient_id :-" .$pid."</b></font>";
		echo "<br>";
		echo "<font color='red'>If Coordinates are from outside Jodhpur, then reduce map size by clicking '-' to see Markers</font>";


	 ?>

</body>

</html>