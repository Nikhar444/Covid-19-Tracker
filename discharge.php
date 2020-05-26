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
  $pat_query="SELECT DISTINCT patient_id,p_name,discharge FROM p34n ORDER BY p_name";

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
       <input type="hidden" name="patient_id1" value="" id="patient_id1">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td align="center">
         <!--   <input type="submit" name="submit_data" value="Submit">&nbsp;&nbsp;<button onclick="export1()">Export To Excel File</button>-->
 
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
      

    




<table width="100%" border="1" cellspacing="0" cellpadding="0" id="tblData">
     
      <tr>
        <td align="center"><b>S. No. </b></td>
       <!--  <td align="center"><b>District</b></td>-->
        <td align="center"><b>Patient_Id </b></td>
       <td align="center"><b>Name</b></td>
        <td align="center"><b>Select Status</b></td>
        <!--  <td align="center"><b>Address</b></td>
        <td align="center"><b>Mobile</b></td>
        <td align="center"><b>Gender</b></td>
        <td align="center"><b>Rural/Urban</b></td>
        <td align="center"><b>Age</b></td>
        <td align="center"><b>Remarks</b></td>
        <td align="center"><b>From Date</b></td>
        <td align="center"><b>From To</b></td>
      <td align="center"><b>SSOID</b></td>
        <td align="center"><b>Added On</b></td>
        <td align="center"><b>CDR File</b></td>
        <td align="center"><b>CDR Analysis Report</b></td>
        <td align="center"><b>KML File</b></td>
        <td align="center"><b>Foreign Travel</b></td>
        <td align="center"><b>Other Diseases</b></td>
        <td align="center"><b>Present Condition </b></td>
        <td align="center"><b>Latitude </b></td>
        <td align="center"><b>Longitude</b></td>-->
        
      <!--  <td align="center"><b>End Time</b></td>-->
          
          </tr>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script type="text/javascript">
            function setstatus()
             {
              //alert("JSG");
              var target = event.target || event.srcElement;
            var name_id = target.id;
            var control_name=target.name;
            var e = document.getElementById(name_id).value;
            //alert(control_name);
            se=name_id.substring(name_id.lastIndexOf("x") + 1, name_id.lastIndexOf("y"));
            //alert(se);
       $.ajax({

                  type: "POST",

                  url: "./dischargep.php",
                  data: {
                  pid: se,
                  se:e,
                              
                    },
                  success: function(msg) {
                      alert(msg);
                     //$(".r").html(msg);
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      alert("Failed to load page" + jqXHR.status + " "+textStatus + "  "+errorThrown);
                  }
              });
            }
          

</script>




  
<?php
      $i=1;
      $sta=array("0"=>"Positive","1"=>"Discharge","2"=>"Negative");

      //echo $sta
    foreach ($pat_id as $d) {
      ?>
      
      <tr>
        <td height="25" align="center"><?php  echo $i++; ?></td>
      <!--  <td height="25" align="center"><?php  echo  $d['district'] ; ?></td>-->
        <td height="25" align="center"><?php  echo $d['patient_id']; ?></td>

       
        <td height="25" align="center"><?php  echo $d['p_name']; ?></td>
         <?php if($d['discharge']==1) { ?>
         <td height="25" align="center" bgcolor="#d2f779">
          <select name="discharge[]" onchange="setstatus()" id="dischargepx<?php echo $d['patient_id'] ?>y">
             <option>Select discharge</option>
           <?php foreach ($sta as $key => $value) {
             ?>
           
            <option value="<?php echo $key ?>" <?php echo ($key==$d['discharge'])?"selected":""?>><?php echo $value; ?>

              <?php  } ?>
         </select></td>
       <?php } else { ?>
        <td height="25" align="center" >
          <select name="discharge[]" onchange="setstatus()" id="dischargepx<?php echo $d['patient_id'] ?>y">
             <option>Select discharge</option>
           <?php foreach ($sta as $key => $value) {
             ?>
           
            <option value="<?php echo $key ?>" <?php echo ($key==$d['discharge'])?"selected":""?>><?php echo $value; ?>

              <?php  } ?>
         </select></td>



       <?php } ?>    
       <!--    <td height="25" align="center"><?php  echo $d['p_addr']; ?></td>
        <td height="25" align="center"><?php  echo ($d['p_mobile']); ?></td>
        <td height="25" align="center"><?php  echo ($d['p_gender']); ?></td>
        <td height="25" align="center"><?php  echo $d['rural_urban']; ?></td>
        <td height="25" align="center"><?php  echo $d['Age']; ?></td>
         <td height="25" align="center"><?php  echo $d['remarks']; ?></td>
        <td height="25" align="center"><?php  echo date('d-m-Y', strtotime($d['from_date'])); ?></td>
        <td height="25" align="center"><?php  echo $d['from_to']; ?></td>
      <!--  <td height="25" align="center"><?php  echo $d['ssoid']; ?></td>
        <td height="25" align="center"><?php  echo $d['added_on']; ?></td>
        <td height="25" align="center"><?php  echo $d['cdr']; ?></td>
        <td height="25" align="center"><?php  echo $d['cdr_analysis']; ?></td>
        <td height="25" align="center"><?php  echo $d['kml']; ?></td>
        <td height="25" align="center"><?php  echo $d['foreign']; ?></td>
        <td height="25" align="center"><?php  echo $d['other_d']; ?></td>
        <td height="25" align="center"><?php  echo $d['present_c']; ?></td>
        <td height="25" align="center"><?php  echo $d['latitude']; ?></td>
        <td height="25" align="center"><?php  echo $d['logitude']; ?></td>-->

        
        

      </tr>

    <?php } //end of for ?>
  
    </table>
<?php 
  

//} //end patient id 1



?>







</form>

  </table>
</body>

</html>

