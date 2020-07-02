<?php
	include '../../db/conn_oracle.php';
	include '../../db/conn.php';
	
	$target_dir = "";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$file_name = basename($_FILES['file']['name']);
	$file = $_FILES['file']['name'];
	$row = 0;
	if ($FileType != "csv") {
    	echo "false";
    	$uploadOk = 0;
	}

	if ($uploadOk != 0) {
		$sql_del = "TRUNCATE `po_data`";
		$del = $conn_db->query($sql_del);
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			if (($handle = fopen($file, "r")) !== FALSE){
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
				 	$row++;
				 	if($row == 1){

				 	}else{
				 		// $poNum = $data[0];
				 		$prodNum = $data[0];
					 	$lotNo = $data[1];
					 	// $poQty = $data[3];


				 		$inv_sql = oci_parse($conn_oracle_fsib, "SELECT SUM(L_SUU) AS inv_count FROM T_YUSYUTDAT WHERE C_FAPHINBAN = '$prodNum' AND C_LOTNO = '$lotNo'AND C_INVNO IS NOT NULL");
						oci_execute($inv_sql);
						$inv = oci_fetch_array($inv_sql);
							$invCount = $inv[0];
								$poQty = oci_parse($conn_oracle_fsib, "SELECT L_SUU FROM M_POMST WHERE C_FAPHINBAN = '$prodNum' AND C_LOTNO = '$lotNo'");
								oci_execute($poQty);
									$poQty1 = oci_fetch_array($poQty);
										$poQtyNo = $poQty1[0];
							$balance = $poQtyNo - $invCount;

							$getPONo = oci_parse($conn_oracle_fsib, "SELECT C_PONO FROM M_POMST WHERE C_FAPHINBAN = '$prodNum' AND C_LOTNO = '$lotNo'");
							oci_execute($getPONo);
							$poNo1 = oci_fetch_array($getPONo);
										$poNum = $poNo1[0];
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
								// $shipMode = oci_parse($conn_oracle_fsib, "SELECT C_AIRSIP FROM M_POMST WHERE C_LOTNO = '$lotNo'");
								// oci_execute($shipMode);
								// $ship = oci_fetch_array($shipMode);
								// 	$shippingMode = $ship[0];

								// 	$selectDestination = oci_parse($conn_oracle_fsib, "SELECT C_NIHKOUMEI FROM M_POMST WHERE C_LOTNO = '$lotNo'");
								// 	oci_execute($selectDestination);
								// 	$selectedDest = oci_fetch_array($selectDestination);
								// 		$destination = $selectedDest[0];

									$shipsql = oci_parse($conn_oracle_fsib, "SELECT SUM(L_SUU) FROM T_YUSYUTDAT WHERE C_FAPHINBAN = '$prodNum' AND C_LOTNO = '$lotNo'AND C_INVNO IS NOT NULL AND C_CONTGR LIKE '%SHIP%'");
									oci_execute($shipsql);
									$shipNo = oci_fetch_array($shipsql);
										$shipQty = $shipNo[0];

										$airsql = oci_parse($conn_oracle_fsib, "SELECT SUM(L_SUU) FROM T_YUSYUTDAT WHERE C_FAPHINBAN = '$prodNum' AND C_LOTNO = '$lotNo'AND C_INVNO IS NOT NULL AND C_CONTGR LIKE '%AIR%'");
									oci_execute($airsql);
									$ariNo = oci_fetch_array($airsql);
										$airQty = $ariNo[0];


				 	$sql = "INSERT INTO `po_data`
				 	(`poNum`, `prodNum`, `poQty`, `lotNum`, `ircsData`, `invNo`, shipQty , airQty, `noInvNo`, `balancePO`) VALUES ('$poNum','$prodNum','$poQtyNo','$lotNo','$packwk','$invCount','$shipQty' , '$airQty', '$noInv','$balance')";
				 	$query = $conn_db->query($sql);
				 	}
				}
				echo 'true';
				fclose($handle);
			}
		}
	}
?>