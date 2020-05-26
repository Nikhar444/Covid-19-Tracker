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
        function del()
        {

              
              alert("JSG");
              //alert(id);
              //document.getElementById("patient_id1").value=id;
              //alert(document.getElementById("patient_id1").value);
             
         /*     var target = event.target || event.srcElement;
            var name_id = target.id;
            var id=target.name; 
              alert(id);
               $.ajax({

        type: "POST",

        url: "./del.php",
        data: {
        pid: id,
               },
        success: function(msg) {
          alert(msg);
            //toastr.success('Success messages');
            //alet
          
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Failed to load page" + jqXHR.status + " "+textStatus + "  "+errorThrown);

        }
    });*/
            

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
    <form action="" method="post" name="track">
       <input type="hidden" name="patient_id1" value="" id="patient_id1">
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
        <option value="<?php echo $pid['pid']; ?>" <?php if ($pid['pid']==$_POST['patient_id1']) { echo "selected"; }?> ><?php echo $pid['p_name']; ?></option>

        <?php }

          else { ?>
              <option value="<?php echo $pid['pid']; ?>"><?php echo $pid['p_name']; ?></option>

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
     
        <tr>
          <td align="center">
            <input type="submit" name="submit_data" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="export1()">Export To Excel File</button>
	
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
 ?>
<table width="100%" border="1" cellspacing="0" cellpadding="0" id="tblData">
      <tr>
        <td colspan="20" align="center">
         <b><font color="red">  <a href="del.php?pid=<?php echo $_POST['patient_id1'];  ?>"  target="_blank">  <input type="button" name="<?php echo $_POST['patient_id1'] ?>" value="Delete Record of Patient <?php echo $_POST['patient_id1'];  ?>"> </a></font>
        </td>
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
        <td align="center"><b>P_Name </b></td>
        <td align="center"><b>P_Home_Logitude</b></td>
        <td align="center"><b>P_Home_Latitude</b></td>
               
     </tr>


<?php $pat_query="select * from p34n where Patient_id='".$_POST['patient_id1']."'";

$pat_rs=mysqli_query($con, $pat_query); 
//echo $pat_query;
 $i=1;
$data=array();

while($row=mysqli_fetch_assoc($pat_rs))
    {
        $data[]=$row;


    }    

      ?>
  
<?php
     
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
        <td height="25" align="center"><?php  echo $d['p_name']; ?></td>
         <td height="25" align="center"><?php  echo $d['p_longitude']; ?></td>
        <td height="25" align="center"><?php  echo ($d['p_latitude']); ?></td>
        

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
