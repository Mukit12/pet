<?php
require_once("../../shared/db.php");
session_start();

// =============updating admininfo==================
if(isset($_POST) && isset($_POST["update_admininfo"])){
	extract($_POST);
	try{
		$query = "UPDATE `users` SET `name`=:name, `contact`=:contact, `username`=:username, `email`=:email";
		if($_FILES["profile_pic"]["name"] != ""){
			$query .= ", `profile_pic`=:profile_pic ";
			$profile_pic = basename($_FILES["profile_pic"]["name"]);

			// uploading pic
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../profile_pic/".$profile_pic);
		}
		
		$query .= "WHERE id=1 ";
		$stmnt = $conn->prepare($query);
		$stmnt->bindParam(":name", $name);
		$stmnt->bindParam(":contact", $contact);
		$stmnt->bindParam(":username", $username);
		$stmnt->bindParam(":email", $email);
		if($_FILES["profile_pic"]["name"] != "") $stmnt->bindParam(":profile_pic", $profile_pic);

		if($stmnt->execute()){
			?>
			<script type="text/javascript">
				alert("Information updated successfully");
				window.location.assign("../index.php");
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert("Credentials did not match. Try again");
				window.location.assign("../index.php");
			</script>
			<?php
		}
	}
	catch(PDOException $e){
		?>
		<script type="text/javascript">
			alert("Error: <?php echo $e->getMessage(); ?>");
			window.location.assign("../index.php");
		</script>
		<?php
	}
}



// =============adding vet==================
elseif(isset($_POST) && isset($_POST["add_vet"])){
	extract($_POST);
	try{
		$pic = basename($_FILES["profile_pic"]["name"]);
		move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../../uploads/vets_profile_pics/".$pic);

		$stmnt = $conn->prepare("INSERT INTO `vets`(name, email, address, profile_pic, fee, service_start, service_end) VALUES(?, ?, ?, ?, ?, ?, ?); ");
		if($stmnt->execute([$name, $email, $address, $pic, $fee, $service_start, $service_end])){
			?>
			<script type="text/javascript">
				alert("Vet added successfully");
				window.location.assign("../vets.php");
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
			window.location.assign("../vet_form.php");
		</script>
		<?php
	}
}



// =============update vet==================
elseif(isset($_POST) && isset($_POST["update_vet"])){
	extract($_POST);
	try{
		$sql = "UPDATE `vets` SET `name`=:name, `email`=:email, `fee`=:fee, `service_start`=:service_start, `service_end`=:service_end, `address`=:address";
		if($_FILES["profile_pic"]["name"] != ""){
			$sql .= ", `profile_pic`=:profile_pic";
			$profile_pic = basename($_FILES["profile_pic"]["name"]);

			// uploading pic
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../../uploads/vets_profile_pics/".$profile_pic);
		}
		$sql .= " WHERE `id`=:id ";

		$stmnt = $conn->prepare($sql);
		$stmnt->bindParam(":name", $name);
		$stmnt->bindParam(":email", $email);
		$stmnt->bindParam(":address", $address);
		$stmnt->bindParam(":fee", $fee);
		$stmnt->bindParam(":id", $id);
		$stmnt->bindParam(":service_start", $service_start);
		$stmnt->bindParam(":service_end", $service_end);
		if($_FILES["profile_pic"]["name"] != "") $stmnt->bindParam(":profile_pic", $profile_pic);
		if($stmnt->execute()){
			?>
			<script type="text/javascript">
				alert("Vet updated successfully");
				window.location.assign("../vets.php");
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
			window.location.assign("../vet_form.php");
		</script>
		<?php
	}
}



// =============removing vet==================
elseif(isset($_GET) && isset($_GET["t"]) && $_GET["t"]=="vr"){
	extract($_GET);
	try{
		$stmnt = $conn->prepare("DELETE FROM `vets` WHERE `id`=?; ");
		if($stmnt->execute([$id])){
			?>
			<script type="text/javascript">
				alert("Vet removed successfully");
				window.location.assign("../vets.php");
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
			window.location.assign("../vets.php");
		</script>
		<?php
	}
}



// =============confirm appointment==================
elseif(isset($_GET) && isset($_GET["t"]) && $_GET["t"]=="ac"){
	extract($_GET);
	try{
		$stmnt = $conn->prepare("UPDATE `appointments` SET status=1 WHERE id=?; ");
		if($stmnt->execute([$id])){
			?>
			<script type="text/javascript">
				alert("Appointment confirmed successfully");
				window.location.assign("../appointments.php");
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
			window.location.assign("../appointments.php");
		</script>
		<?php
	}
}



// =============reject appointment==================
elseif(isset($_GET) && isset($_GET["t"]) && $_GET["t"]=="ar"){
	extract($_GET);
	try{
		$stmnt = $conn->prepare("UPDATE `appointments` SET status=2 WHERE id=?; ");
		if($stmnt->execute([$id])){
			?>
			<script type="text/javascript">
				alert("Appointment rejected successfully");
				window.location.assign("../appointments.php");
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
			window.location.assign("../appointments.php");
		</script>
		<?php
	}
}




// ============adding pets===================
elseif(isset($_POST) && isset($_POST["add_pet"])){
	extract($_POST);
	try {
		$query = $conn->prepare("INSERT INTO `pets`(`name`, `age`, `pic`) VALUES (?, ?, ?); ");
		$pic = basename($_FILES["pic"]["name"]);

		// uploading pic
		move_uploaded_file($_FILES["pic"]["tmp_name"], "../../uploads/products/animals/".$pic);

		if(!$query->execute([$name, $age, $pic])){
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
				alert("Pet added successfully");
				window.location.assign("../update_pets.php");
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




// ============updating pets===================
elseif(isset($_POST) && isset($_POST["update_pet"])){
	extract($_POST);
	try {
		$sql = "UPDATE `pets` SET `name`=:name, `age`=:age";
		if($_FILES["pic"]["name"] != ""){
			$sql .= ", `pic`=:pic";
			$pic = basename($_FILES["pic"]["name"]);

			// uploading pic
			move_uploaded_file($_FILES["pic"]["tmp_name"], "../../uploads/products/animals/".$pic);
		}
		$sql .= " WHERE `id`=:id ";

		$query = $conn->prepare($sql);
		$query->bindParam(":name", $name);
		$query->bindParam(":age", $age);
		$query->bindParam(":id", $pet_id);
		if($_FILES["pic"]["name"] != "") $query->bindParam(":pic", $pic);
		if(!$query->execute()){
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
				alert("Pet updated successfully");
				window.location.assign("../update_pets.php");
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



// =============removing pets==================
elseif(isset($_GET) && isset($_GET["t"]) && $_GET["t"]=="pet"){
	extract($_GET);
	try{
		$stmnt = $conn->prepare("DELETE FROM `pets` WHERE `id`=?; ");
		if($stmnt->execute([$id])){
			?>
			<script type="text/javascript">
				alert("Pet removed successfully");
				window.location.assign("../update_pets.php");
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
			window.history.go(-1);
		</script>
		<?php
	}
}



// =============confirm adoption==================
elseif(isset($_GET) && isset($_GET["t"]) && $_GET["t"]=="adc"){
	extract($_GET);
	try{
		$stmnt = $conn->prepare("UPDATE `adopts` SET status=1 WHERE id=?; ");
		if($stmnt->execute([$id])){
			?>
			<script type="text/javascript">
				alert("Adoption request confirmed successfully");
				window.location.assign("../adoptions.php");
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
			window.location.assign("../adoptions.php");
		</script>
		<?php
	}
}



// =============reject adoption==================
elseif(isset($_GET) && isset($_GET["t"]) && $_GET["t"]=="adr"){
	extract($_GET);
	try{
		$stmnt = $conn->prepare("UPDATE `adopts` SET status=2 WHERE id=?; ");
		if($stmnt->execute([$id])){
			?>
			<script type="text/javascript">
				alert("Adoption request rejected successfully");
				window.location.assign("../adoptions.php");
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
			window.location.assign("../adoptions.php");
		</script>
		<?php
	}
}




// =============adding products==================
elseif(isset($_POST) && isset($_POST["add_product"])){
	extract($_POST);
	try{
		$pic = basename($_FILES["img"]["name"]);
		move_uploaded_file($_FILES["img"]["tmp_name"], "../../assets/images/products/".$pic);

		$stmnt = $conn->prepare("INSERT INTO `accessories`(`name`, `prize`, `description`, `type`, `pet_type`, `image`, `qty`, `vendor_id`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
		$res = $stmnt->execute([$name, $prize, $description, $type, $pet_type, $pic, $qty, $vendor_id]);

		if($res){
			?>
			<script type="text/javascript">
				alert("Product added successfully");
				window.location.assign("../products.php");
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert("Product was uanble to be added. Try again");
				window.history.go(-1);
			</script>
			<?php
		}
	}
	catch(PDOException $e){
		?>
		<script type="text/javascript">
			alert("Error: <?php echo $e->getMessage(); ?>");
			window.history.go(-1);
		</script>
		<?php
	}
}



// =============updating product==================
elseif(isset($_POST) && isset($_POST["update_product"])){
	extract($_POST);
	try{
		$query = "UPDATE `accessories` SET `name`=:name, `description`=:description, `type`=:type, `pet_type`=:pet_type, `qty`=:qty, `prize`=:prize, `vendor_id`=:vendor_id ";
		if($_FILES["img"]["name"] != ""){
			$query .= ", `image`=:image ";
			$profile_pic = basename($_FILES["img"]["name"]);

			// uploading pic
			move_uploaded_file($_FILES["img"]["tmp_name"], "../../assets/images/products/".$profile_pic);
		}
		
		$query .= "WHERE id=:id";
		$stmnt = $conn->prepare($query);
		$stmnt->bindParam(":name", $name);
		$stmnt->bindParam(":description", $description);
		$stmnt->bindParam(":type", $type);
		$stmnt->bindParam(":pet_type", $pet_type);
		$stmnt->bindParam(":qty", $qty);
		$stmnt->bindParam(":prize", $prize);
		$stmnt->bindParam(":vendor_id", $vendor_id);
		$stmnt->bindParam(":id", $id);
		if($_FILES["img"]["name"] != "") $stmnt->bindParam(":image", $profile_pic);

		if($stmnt->execute()){
			?>
			<script type="text/javascript">
				alert("Information updated successfully");
				window.location.assign("../products.php");
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert("Credentials did not match. Try again");
				window.history.go(-1);
			</script>
			<?php
		}
	}
	catch(PDOException $e){
		?>
		<script type="text/javascript">
			alert("Error: <?php echo $e->getMessage(); ?>");
			window.history.go(-1);
		</script>
		<?php
	}
}





// =============removing product==================
elseif(isset($_GET) && isset($_GET["t"]) && $_GET["t"]=="pr"){
	extract($_GET);
	try{
		$stmnt = $conn->prepare("DELETE FROM `accessories` WHERE `id`=?; ");
		if($stmnt->execute([$id])){
			?>
			<script type="text/javascript">
				alert("Product removed successfully");
				window.location.assign("../products.php");
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
			window.location.assign("../products.php");
		</script>
		<?php
	}
}




// ============adding vendor===================
elseif(isset($_POST) && isset($_POST["add_vendor"])){
	extract($_POST);
	try {
		$query = $conn->prepare("INSERT INTO `vendors` VALUES (0, ?, ?, ?, ?); ");

		if(!$query->execute([$name, $address, $contact, $email])){
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
				alert("Vendor added successfully");
				window.location.assign("../vendors.php");
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




// ============updating vendor===================
elseif(isset($_POST) && isset($_POST["update_vendor"])){
	extract($_POST);
	try {
		$query = $conn->prepare("UPDATE `vendors` SET `name`=?,`email`=?,`contact`=?,`address`=? WHERE `id`=?; ");

		if(!$query->execute([$name, $email, $contact, $address, $id])){
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
				alert("Vendor updated successfully");
				window.location.assign("../vendors.php");
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



// =============removing vendor==================
elseif(isset($_GET) && isset($_GET["t"]) && $_GET["t"]=="vendr"){
	extract($_GET);
	try{
		$stmnt = $conn->prepare("DELETE FROM `vendors` WHERE `id`=?; ");
		if($stmnt->execute([$id])){
			?>
			<script type="text/javascript">
				alert("Vendor removed successfully");
				window.location.assign("../vendors.php");
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
			window.history.go(-1);
		</script>
		<?php
	}
}


else{
	echo "Invalid request";
}
?>