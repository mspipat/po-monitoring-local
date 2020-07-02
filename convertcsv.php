<?php
	include 'db/conn.php';
	header("Content-Type: application/vnd.ms-excel");
	// header('Content-Type: text/csv; charset=utf-8');  
    header("Content-Disposition: ; filename=\"po.xls\"");
?>
	<table border="1">
		<thead>
			<tr>
				<th>No.</th>
				<th>PO Number</th>
				<th>Product Number</th>
				<th>Lot</th>
				<th>PO Qty</th>
				<th>IRCS Record</th>
				<th>Invoiced <br> Shiped Out</th>
				<th>Ship</th>
				<th>Air</th>
				<th>No Entry <br> (Scanned)</th>
				<th>Remaining <br>Balance</th>
			</tr>
		</thead>
		<tbody>
			<tr>
<?php
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
				// $shipMode = $res['shipMode'];
				// $destination = $res['destination'];
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
					  <td>'.$ship.'</td>
					  <td>'.$air.'</td>
					  <td>'.$noInvNo.'</td>
					  <td>'.$balancePO.'</td>
				</tr>';
				$count++;
			}
?>
		</tbody>
	</table>