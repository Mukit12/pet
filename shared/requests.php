<?php
require_once("db.php");
session_start();

// ============login===================
if(isset($_POST) && isset($_POST["login"])){
	extract($_POST);
	try {
		$query = $conn->prepare("SELECT `is_admin` FROM `users` WHERE `username`=? AND `password`=?; ");
		$query->execute([$username, $password]);

		if($query->rowCount() == 0){
			?>
			<script type="text/javascript">
				alert("Credentials did not match. Try again");
				window.location.assign("../index.php");
			</script>
			<?php
		}
		else{
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$res = $query->fetchAll();

			if($res[0]["is_admin"]==1){
				$_SESSION["admin_login"] = true;
				?>
				<script type="text/javascript">
					alert("Logged-in successfully");
					window.location.assign("../admin/index.php");
				</script>
				<?php
			}
			else{
				$_SESSION["user"] = $username;
				?>
				<script type="text/javascript">
					alert("Logged-in successfully");
					window.location.assign("../index.php");
				</script>
				<?php
			}
		}
	} catch (PDOException $e) {
		?>
		<script type="text/javascript">
			alert("Error: <?php echo $e->getMessage(); ?>");
			window.location.assign("../index.php");
		</script>
		<?php
	}
}


// ============register===================
elseif(isset($_POST) && isset($_POST["register"])){
	extract($_POST);
	try {
		$query = $conn->prepare("INSERT INTO `users`(name, username, email, contact, password) VALUES(?, ?, ?, ?, ?); ");

		if(!$query->execute([$name, $username, $email, $phn_num, $password])){
			?>
			<script type="text/javascript">
				alert("Credentials did not match. Try again");
				window.location.assign("../index.php");
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert("Registration successful. Login to proceed");
				window.location.assign("../index.php");
			</script>
			<?php
		}
	} catch (PDOException $e) {
		?>
		<script type="text/javascript">
			alert("Error: <?php echo $e->getMessage(); ?>");
			window.location.assign("../index.php");
		</script>
		<?php
	}
}


// ============opinion submission===================
elseif(isset($_POST) && isset($_POST["opinion"])){
	?>
	<script type="text/javascript">
		alert("Response received!!");
		window.location.assign("../contact.php");
	</script>
	<?php
}


// ============set appointment(v1.0.0)===================
/*elseif(isset($_POST) && isset($_POST["set_appointment"])){
	extract($_POST);
	try {
		$appointment_time = date("H:i:s", strtotime($appointment_time));
		$appointment_end_time = date("H:i:s", strtotime("+1hour", strtotime($appointment_time)));

		$stmnt = $conn->prepare("SELECT * FROM `appointments` WHERE `vet_id`=? AND `appointment_date`=? AND ((`appointment_time`=?) OR (`appointment_time`>? AND `appointment_time`<?) OR (ADDTIME(`appointment_time`, '01:10:0')>? AND ADDTIME(`appointment_time`, '01:10:0')<?)); ");
		$stmnt->execute([$vet_id, $appointment_date, $appointment_time, $appointment_time, $appointment_end_time, $appointment_time, $appointment_end_time]);
		if($stmnt->rowCount() != 0){
			?>
			<script type="text/javascript">
				alert("Select a different time. Schedule is already booked");
				window.history.go(-1);
			</script>
			<?php
		}
		else{
			$query = $conn->prepare("INSERT INTO `appointments`(`username`, `vet_id`, `name`, `email`, `phn_num`, `address`, `pet_name`, `pet_breed`, `pet_species`, `pet_age`,  `appointment_date`, `appointment_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ");

			if(!$query->execute([$_SESSION["user"], $vet_id, $name, $email, $phn_num, $address, $pet_name, $pet_breed, $pet_species, $pet_age, $appointment_date, $appointment_time])){
				?>
				<script type="text/javascript">
					alert("Something went wrong. Try again");
					window.history.go(-1);
				</script>
				<?php
			}
			else{
				?>
				<script type="text/javascript">
					alert("Appointment made successfully");
					window.location.assign("../orders.php");
				</script>
				<?php
			}
		}
	} catch (PDOException $e) {
		?>
		<script type="text/javascript">
			alert("Error: <?php echo $e->getMessage(); ?>");
			window.history.go(-1);
		</script>
		<?php
	}
}*/


// ============set appointment(v1.1.0)===================
elseif(isset($_POST) && isset($_POST["set_appointment"])){
	extract($_POST);
	try {
		$stmnt = $conn->prepare("SELECT * FROM `appointments` WHERE `vet_id`=? AND `appointment_date`=? AND `appointment_time`=?; ");
		$stmnt->execute([$vet_id, $appointment_date, $appointment_time]);
		if($stmnt->rowCount() != 0){
			?>
			<script type="text/javascript">
				alert("Select a different time. Schedule is already booked");
				window.history.go(-1);
			</script>
			<?php
		}
		else{
			$query = $conn->prepare("INSERT INTO `appointments`(`username`, `vet_id`, `name`, `email`, `phn_num`, `address`, `pet_name`, `pet_breed`, `pet_species`, `pet_age`,  `appointment_date`, `appointment_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ");

			if(!$query->execute([$_SESSION["user"], $vet_id, $name, $email, $phn_num, $address, $pet_name, $pet_breed, $pet_species, $pet_age, $appointment_date, $appointment_time])){
				?>
				<script type="text/javascript">
					alert("Something went wrong. Try again");
					window.history.go(-1);
				</script>
				<?php
			}
			else{
				?>
				<script type="text/javascript">
					alert("Appointment made successfully");
					window.location.assign("../orders.php");
				</script>
				<?php
			}
		}
	} catch (PDOException $e) {
		?>
		<script type="text/javascript">
			alert("Error: <?php echo $e->getMessage(); ?>");
			window.history.go(-1);
		</script>
		<?php
	}
}



// =============cancel appointment==================
elseif(isset($_GET) && isset($_GET["a"]) && $_GET["a"]=="cancel_appointment"){
	extract($_GET);
	try{
		$stmnt = $conn->prepare("UPDATE `appointments` SET status=3 WHERE id=?; ");
		if($stmnt->execute([$id])){
			?>
			<script type="text/javascript">
				alert("Appointment rejected successfully");
				window.location.assign("../orders.php");
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert("Something went wrong. Try again");
				window.history.go(-1);
			</script>
			<?php
		}
	}
	catch(PDOException $e){
		?>
		<script type="text/javascript">
			alert("Error: <?php echo $e->getMessage(); ?>");
			window.location.assign("../orders.php");
		</script>
		<?php
	}
}


// ============adoption request===================
elseif(isset($_POST) && isset($_POST["req_adopt"])){
	extract($_POST);
	try {
		$query = $conn->prepare("INSERT INTO `adopts`(`username`, `pet_id`, `name`, `email`, `phn_num`, `address`, `age`, `proffession`, `have_prev_pets`, `budget`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ");

		if(!$query->execute([$_SESSION["user"], $pet_id, $name, $email, $phn_num, $address, $age, $proffession, $have_prev_pets, $budget])){
			?>
			<script type="text/javascript">
				alert("Something went wrong. Try again");
				window.history.go(-1);
			</script>
			<?php
		}
		else{
			$conn->prepare("UPDATE `pets` SET `status`=0 WHERE `id`=?; ")->execute([$pet_id]);
			?>
			<script type="text/javascript">
				alert("Adoption requested successfully");
				window.location.assign("../orders.php");
			</script>
			<?php
		}
	} catch (PDOException $e) {
		?>
		<script type="text/javascript">
			alert("Error: <?php echo $e->getMessage(); ?>");
			window.history.go(-1);
		</script>
		<?php
	}
}

else{
	echo "Invalid request";
}
?>