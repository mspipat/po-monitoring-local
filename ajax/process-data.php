<?php
	include '../db/conn.php';
	include '../db/conn_oracle.php';
	if (isset($_GET['requesteddata'])) {
	$request = $_GET['requesteddata'];
		if($request == "update_po")
		{
			$sql = "SELECT * FROM `po_data` WHERE balancePO != '0'";
			$query_open = $conn_db->query($sql);
			while ($res = $query_open->fetch_assoc()) {
				$lotNo = $res['lotNum'];
				$prodNum = $res['prodNum'];
				$poQty = $res['poQty'];
				
				$inv_sql = oci_parse($conn_oracle_fsib, "SELECT SUM(L_SUU) AS inv_count FROM T_YUSYUTDAT WHERE C_FAPHINBAN = '$prodNum' AND C_LOTNO = '$lotNo'AND C_INVNO IS NOT NULL");
					oci_execute($inv_sql);
					$inv = oci_fetch_array($inv_sql);
						$invCount = $inv[0];
						$balance = $poQty - $invCount;

						$pack_sql = oci_parse($conn_oracle_ircs, "SELECT COUNT(LOT) FROM T_PACKINGWK WHERE LOT = '$lotNo' AND PACKINGBOXCARDJUDGMENT = '1'");
						oci_execute($pack_sql);
						$pack = oci_fetch_array($pack_sql);
							$packwk = $pack[0];

							$no_invoice = oci_parse($conn_oracle_fsib, "SELECT SUM(L_SUU) AS NO_INVOICED FROM T_YUSYUTDAT WHERE C_FAPHINBAN = '$prodNum' AND C_LOTNO = '$lotNo'AND C_INVNO IS NULL");
							oci_execute($no_invoice);
							$totalnoinv = oci_fetch_array($no_invoice);
								$noInv = $totalnoinv[0];
								if(!$noInv){	
									$noInv = 0;
								}
						$sql1 = "UPDATE `po_data` SET `ircsData`= '$packwk',`invNo`='$invCount',`noInvNo`='$noInv',`balancePO`='$balance' WHERE `lotNum`='$lotNo' AND`prodNum`='$prodNum' AND`poQty`='$poQty'";
						$query1 = $conn_db->query($sql1);
			}
			echo 'true';
		}
	}