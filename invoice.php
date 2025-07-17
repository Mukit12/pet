<?php
	extract($_GET);
	session_start();
	require_once("shared/db.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Invoice</title>
	<style type="text/css">
		table{
			width: 500px;
			margin: auto;
		}

		table th{
			text-align: left;
		}

		table tr td:nth-child(2n){
			padding-right: 7px;
		}

		.print-btn{
			display: block;
			margin: 2rem auto;
			font-size: 24px;
			padding: 0.5rem 1rem;
			border-radius: 8px;
			cursor: pointer;
			border: 1px solid green;
			color: white;
			background-color: green;
			transition: 0.4s;
			font-weight: bold;
		}

		.print-btn:hover{
			color: green;
			background-color: white;
		}
	</style>
</head>
<body>

	<h1 style="text-align: center;">Online Pet care center Management System</h1>
	<h3 style="text-align: center;"><u>Invoice Document</u></h3>

	<table>
		<tr>
			<th>Invoice ID</th>
			<td>:</td>
			<td><?php echo md5(sha1(date("h:i A, d M, Y"))) ?></td>
		</tr>
		<tr>
			<th>Generating time</th>
			<td>:</td>
			<td><?php echo date("h:i A, d M, Y") ?></td>
		</tr>
		<tr>
			<th>Invoice type</th>
			<td>:</td>
			<td>
				<?php echo $type ?>
			</td>
		</tr>

		<?php
			if($type == "Appointment"){
                $query = $conn->prepare("SELECT appointments.id, appointments.status, appointments.name, appointments.email, appointments.phn_num, appointments.address, appointments.pet_name, appointments.pet_breed, appointments.pet_species, appointments.pet_age, appointments.appointment_date, appointments.appointment_time, vets.id as vets_id, vets.name AS vet_name FROM appointments INNER JOIN vets ON appointments.username=? AND appointments.vet_id=vets.id WHERE appointments.id=?; ");
                $query->execute([$_SESSION["user"], $id]);
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $res = $query->fetchAll();

                ?>
	                <tr>
						<th>Appointment ID</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["id"] ?>
						</td>
					</tr>
	                <tr>
						<th>Name</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["name"] ?>
						</td>
					</tr>
	                <tr>
						<th>Email</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["email"] ?>
						</td>
					</tr>
	                <tr>
						<th>Contact</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["phn_num"] ?>
						</td>
					</tr>
	                <tr>
						<th>Address</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["address"] ?>
						</td>
					</tr>
	                <tr>
						<th>Pet name</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["pet_name"] ?>
						</td>
					</tr>
	                <tr>
						<th>Pet breed</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["pet_breed"] ?>
						</td>
					</tr>
	                <tr>
						<th>Pet species</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["pet_species"] ?>
						</td>
					</tr>
	                <tr>
						<th>Pet age</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["pet_age"] ?>
						</td>
					</tr>
	                <tr>
						<th>Vet ID</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["vets_id"] ?>
						</td>
					</tr>
	                <tr>
						<th>Vet name</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["vet_name"] ?>
						</td>
					</tr>
	                <tr>
						<th>Appointment time</th>
						<td>:</td>
						<td>
							<?php echo date("h:i A", strtotime($res[0]["appointment_time"])) ?>, <?php echo date("d M, Y", strtotime($res[0]["appointment_date"])) ?>
						</td>
					</tr>
	                <tr>
						<th>Status</th>
						<td>:</td>
						<td>
							<?php
								if($res[0]["status"] == 0) echo "Pending";
	                            elseif($res[0]["status"] == 1) echo "Confirmed";
	                            if($res[0]["status"] == 2) echo "Rejected";
							?>
						</td>
					</tr>
                <?php
			}
			else if($type == "Purchase"){
                $query = $conn->prepare("SELECT accessories.name as prod_name, vendors.name as vend_name, transactions.id as transac_id, transactions.qty as purchase_qty, transactions.trans_id, transactions.trans_amount, transactions.trans_date, transactions.card_type, transactions.card_no, transactions.pay_type, transactions.address, transactions.prod_id FROM `accessories` INNER JOIN `transactions` ON accessories.id=transactions.prod_id INNER JOIN `vendors` ON accessories.vendor_id=vendors.id WHERE transactions.username=? AND transactions.id=?; ");
                $query->execute([$_SESSION["user"], $id]);
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $res = $query->fetchAll();

                ?>
	                <tr>
						<th>Purchase ID</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["transac_id"] ?>
						</td>
					</tr>
	                <tr>
						<th>Product ID</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["prod_id"] ?>
						</td>
					</tr>
	                <tr>
						<th>Product name</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["prod_name"] ?>
						</td>
					</tr>
	                <tr>
						<th>Vendor</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["vend_name"] ?>
						</td>
					</tr>
	                <tr>
						<th>Quantity</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["purchase_qty"] ?>
						</td>
					</tr>
	                <tr>
						<th>Total amount</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["trans_amount"] ?> Taka
						</td>
					</tr>
	                <tr>
						<th>Address</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["address"] ?>
						</td>
					</tr>
	                <tr>
						<th>Payment type</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["pay_type"]==1 ? "Cash On Delivery" : "Online" ?>
						</td>
					</tr>
	                <tr>
						<th>Purchase method</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["card_type"] ?>
						</td>
					</tr>
	                <tr>
						<th>Transaction ID</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["trans_id"] ?>
						</td>
					</tr>
	                <tr>
						<th>Purchase time</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["trans_date"] ?>
						</td>
					</tr>
                <?php
			}
			else if($type == "Adoption"){
				$query = $conn->prepare("SELECT adopts.id as adopt_id, adopts.status, adopts.name, adopts.email, adopts.username, adopts.phn_num, adopts.address, adopts.age, adopts.proffession, adopts.have_prev_pets, adopts.budget, pets.id AS pet_id, pets.name AS pet_name FROM adopts INNER JOIN pets ON adopts.username=? AND adopts.pet_id=pets.id WHERE adopts.id=?; ");
                $query->execute([$_SESSION["user"], $id]);
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $res = $query->fetchAll();

                ?>
	                <tr>
						<th>Adoption ID</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["adopt_id"] ?>
						</td>
					</tr>
	                <tr>
						<th>Name</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["name"] ?>
						</td>
					</tr>
	                <tr>
						<th>Email</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["email"] ?>
						</td>
					</tr>
	                <tr>
						<th>Contact</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["phn_num"] ?>
						</td>
					</tr>
	                <tr>
						<th>Address</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["address"] ?>
						</td>
					</tr>
	                <tr>
						<th>Age</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["age"] ?> yrs
						</td>
					</tr>
	                <tr>
						<th>Pet ID</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["pet_id"] ?>
						</td>
					</tr>
	                <tr>
						<th>Pet name</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["pet_name"] ?>
						</td>
					</tr>
	                <tr>
						<th>Previous Pets</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["have_prev_pets"] ?>
						</td>
					</tr>
	                <tr>
						<th>Budget</th>
						<td>:</td>
						<td>
							<?php echo $res[0]["budget"] ?> Taka
						</td>
					</tr>
	                <tr>
						<th>Status</th>
						<td>:</td>
						<td>
							<?php
								if($res[0]["status"] == 0) echo "Pending";
	                            elseif($res[0]["status"] == 1) echo "Confirmed";
	                            if($res[0]["status"] == 2) echo "Rejected";
							?>
						</td>
					</tr>
				<?php
			}
		?>
	</table>

	<button class="print-btn" onclick="this.remove();window.print();">Print</button>

</body>
</html>