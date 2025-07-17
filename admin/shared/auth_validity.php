<?php
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["admin_login"]) || !$_SESSION["admin_login"]){
	?>
	<script type="text/javascript">
		alert("Login first!");
		window.location.assign("../index.php");
	</script>
	<?php

	exit();
}
?>