<?php
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["user"])){
	?>
	<script type="text/javascript">
		alert("Login first!");
		window.location.assign("/pet/index.php");
	</script>
	<?php

	exit();
}
?>