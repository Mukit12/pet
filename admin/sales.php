<!DOCTYPE html>
<html>
<head>
    <?php require_once("shared/header.php") ?>
</head>
<body>
	<!-- navbar -->
	<?php require_once("shared/navbar.php") ?>

	<div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-12">
                <h1 class="my-5 text-center" style="color: rosybrown; margin: 4rem 0">Sales report</h1>

                <table class="table table-responsive table-hover" style="border: 1px dashed #8c8b8b; border-top: 1px dashed #8c8b8b;">
                    <tr>
                        <th style="border: 1px dashed #8c8b8b; text-align: center;">#</th>
                        <th style="border: 1px dashed #8c8b8b; text-align: center;">Month</th>
                        <th style="border: 1px dashed #8c8b8b; text-align: center;">Datetime</th>
                        <th style="border: 1px dashed #8c8b8b; text-align: center;">Transaction ID</th>
                        <th style="border: 1px dashed #8c8b8b; text-align: center;">Transaction method</th>
                        <th style="border: 1px dashed #8c8b8b; text-align: center;">Transaction amount</th>
                    </tr>

                    <?php
                    require_once("../shared/db.php");
                    $query = $conn->prepare("SELECT * FROM `transactions` ORDER BY trans_date, MONTH(trans_date); ");
                    $query->execute();
                    $query->setFetchMode(PDO::FETCH_ASSOC);
                    $res = $query->fetchAll();
                    $cnt = 0;
                    $total_income = 0;
                    ?>

                    <?php foreach($res as $r): ?>
                        <tr style="border: 1px dashed #8c8b8b;">
                            <td style="border: 1px dashed #8c8b8b;">
                                <center><strong class="wow fadeInDown"><p style="margin-top:25px;">No. <?php echo ++$cnt ?></p></strong></center>
                            </td>

                            <td style="border: 1px dashed #8c8b8b;">
                                <center><?php echo date("F, Y", strtotime($r["trans_date"])) ?></center>
                            </td>

                            <td style="border: 1px dashed #8c8b8b;">
                                <center><?php echo $r["trans_date"] ?></center>
                            </td>

                            <td style="border: 1px dashed #8c8b8b;">
                                <center><?php echo $r["trans_id"] ?></center>
                            </td>

                            <td style="border: 1px dashed #8c8b8b;">
                                <center><?php echo $r["card_type"] ?></center>
                            </td>

                            <td style="border: 1px dashed #8c8b8b;">
                                <center>
                                    <?php echo $r["trans_amount"] ?>/=
                                    <?php $total_income += $r["trans_amount"] ?>
                                </center>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr style="border: 1px dashed #8c8b8b;">
                        <th style="border: 1px dashed #8c8b8b; text-align: right;" colspan="5">Total</th>
                        <td style="border: 1px dashed #8c8b8b; text-align: center;"><?php echo $total_income ?>/=</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

	<div style="display: flex; justify-content: center; margin-bottom: 2rem;">
		<button class="btn btn-success" onclick="printReport(this)">Print</button>
	</div>

	<!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>

	<script type="text/javascript">
		function printReport(btn){
			btn.remove();
			window.print();
		}
	</script>
</body>
</html>