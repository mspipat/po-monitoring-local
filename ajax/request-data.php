<?php
	include '../db/conn.php';
	if (isset($_GET['requesteddata'])) {
	$request = $_GET['requesteddata'];

		if($request == "po_record")
		{
			$sql = "SELECT * FROM po_data";
			$query = $conn_db->query($sql);
			$count = 1;
			while ($res = $query->fetch_assoc()) {
				$poNum = $res['poNum'];
				$lotNo = $res['lotNum'];
				$prodNo = $res['prodNum'];
				$poQty = $res['poQty'];
				$ircsData = $res['ircsData'];
				$invNo = $res['invNo'];
				$shipMode = $res['shipMode'];
				$destination = $res['destination'];
				$noInvNo = $res['noInvNo'];
				$balancePO = $res['balancePO'];
				$ship = $res['shipQty'];
				$air = $res['airQty'];

				echo '<td>'.$count.'</td>
					  <td>'.$poNum.'</td>
					  <td>'.$prodNo.'</td>
					  <td>'.$lotNo.'</td>
					  <td>'.$poQty.'</td>
					  <td>'.$ircsData.'</td>
					  <td>'.$invNo.'</td>
					  <td>'.$shipMode.'</td>
					  <td>'.$ship.'</td>
					  <td>'.$air.'</td>
					  <td>'.$destination.'</td>
					  <td>'.$noInvNo.'</td>
					  <td>'.$balancePO.'</td>
				</tr>';
				$count++;
			}
		}
		elseif($request == "po_recordrem"){
			$sql = "SELECT * FROM po_data WHERE balancePO >= 1";
			$query = $conn_db->query($sql);
			$count = 1;
			while ($res = $query->fetch_assoc()) {
				$poNum = $res['poNum'];
				$lotNo = $res['lotNum'];
				$prodNo = $res['prodNum'];
				$poQty = $res['poQty'];
				$ircsData = $res['ircsData'];
				$invNo = $res['invNo'];
				$shipMode = $res['shipMode'];
				$destination = $res['destination'];
				$noInvNo = $res['noInvNo'];
				$balancePO = $res['balancePO'];
				$ship = $res['shipQty'];
				$air = $res['airQty'];

				echo '<td>'.$count.'</td>
					  <td>'.$poNum.'</td>
					  <td>'.$prodNo.'</td>
					  <td>'.$lotNo.'</td>
					  <td>'.$poQty.'</td>
					  <td>'.$ircsData.'</td>
					  <td>'.$invNo.'</td>
					  <td>'.$shipMode.'</td>
					  <td>'.$ship.'</td>
					  <td>'.$air.'</td>
					  <td>'.$destination.'</td>
					  <td>'.$noInvNo.'</td>
					  <td>'.$balancePO.'</td>
				</tr>';
				$count++;
			}
			elseif($request == "resetTable"){
				echo '<td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
				</tr>';
			}
		}
	}
?>