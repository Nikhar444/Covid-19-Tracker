<?php
session_start();
	unset($_SESSION["USER"]); 
	echo "<script>window.location.assign('./')</script>";
	session_destroy(oid);
?>
