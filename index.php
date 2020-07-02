<!DOCTYPE html>
<html>
<head>
	<title> PO Monitoring System</title>
	<?php
		include 'src/link.php';
		include 'db/conn.php';
	?>
	<style type="text/css">
		.overlay {
  			position: fixed; 
  			display: none; 
  			width: 95.5%; 
  			height: 100%; 
  			background-color: rgba(0,0,0,0.5); 
 			z-index: 5; 
  			cursor: pointer; 
		}
	</style>
</head>
<body>
	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<h2 class="card-title text-center font-weight-bold mt-2"> PO Monitoring</h2>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-3">
								<!-- UPLOAD PO FILE -->
								<form action="" method="post" enctype="multipart/form-data" class="md-form">
			            <div class="input-group">
			              <div class="custom-file" style="margin-left: 14px;">
			                <input type="hidden" name="" id="working-po">
			                <input type="file" class="custom-file-input " id="po_file" name="file" accept=".csv" aria-describedby="inputGroupFileAddon01" >
			                <label class="custom-file-label" style="color: black;" for="inputGroupFile01">Choose file</label>
			              </div>
			            </div>
			          </form>
								<!-- /UPLOAD PO FILE -->
							</div>
							<div class="col-lg-9" style="margin-top: 30px;">
								<!-- UPDATE PO -->
								<button class="btn btn-success btn-sm" id="btnUpdate">Update</button>
			        	<a  class="btn btn-danger btn-sm"  href="convertcsv.php" id="btnExcel">Export Excel</a>
			        	<a  class="btn btn-danger btn-sm" href="template.csv" download>Download Template</a>
								<!-- /UPDATE PO -->	
							</div>
						</div>
						<div class="row">
							<div class="custom-control custom-checkbox">
    						<input type="checkbox" class="custom-control-input" id="defaultUnchecked">
    						<label class="custom-control-label" for="defaultUnchecked" style="font-size: 0.9rem;">Remaining Balance</label>
							</div>
						</div>
			    </div>
				</div>
				<!-- LOADING LOADER -->
						<div id="loading" class="overlay">
							<div class="col-lg-12" style="width: 2000px;background-color: white;height: 600px;">
								<img src="img/loading.gif" width="300" height="450" style="margin-left: 500px;">
							</div>
						</div>
				<!-- /LOADING LOADER -->
			</div>
		</div>
	<div class="row mt-5">
			<div class="col-lg-12">
				<!-- <div class="card" style="margin: 20px;"> -->
					<table id="tablePORec" class="table table-bordered table-sm text-center table-striped">
						<thead class="blue-gradient text-white font-weight-bold">
							<tr>
								<th>No.</th>
								<th>PO Number</th>
								<th>Product Number</th>
								<th>Lot</th>
								<th>PO Qty</th>
								<th>IRCS Record</th>
								<th>Invoiced <br> Shiped Out</th>
								<!-- <th>Mode of Transport <br> Air/Ship</th> -->
								<th>Ship</th>
								<th>Air</th>
								<!-- <th>Destination</th> -->
								<th>No Entry <br> (Scanned)</th>
								<th>Remaining <br>Balance</th>
							</tr>
						</thead>
						<tbody id="tablePO">
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
					<table id="tablePORecRem" class="table table-bordered table-sm text-center table-striped">
						<thead class="blue-gradient text-white font-weight-bold">
							<tr>
								<th colspan="13">Remaining</th>
							</tr>
							<tr>
								<th>No.</th>
								<th>PO Number</th>
								<th>Product Number</th>
								<th>Lot</th>
								<th>PO Qty</th>
								<th>IRCS Record</th>
								<th>Invoiced <br> Shiped Out</th>
								<!-- <th>Mode of Transport <br> Air/Ship</th> -->
								<th>Ship</th>
								<th>Air</th>
								<!-- <th>Destination</th> -->
								<th>No Entry <br> (Scanned)</th>
								<th>Remaining <br>Balance</th>
							</tr>
						</thead>
						<tbody id="tablePORem">
							<?php
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
				<!-- </div> -->
			</div>
		</div>	
	</div>
<?php
	 include 'src/script.php';
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablePORecRem').hide();
		var table = $('#tablePORec').DataTable();
		$('#tablePORec').DataTable();
		$('.dataTables_length').addClass('bs-select');
	});
	$('#po_file').change(function(){
			upload_po();
	});

	function upload_po(){
		resettbl();
			$('#loading').show();
			var form_data = new FormData();
			var ins = document.getElementById('po_file').files.length;
		 		for (var x = 0; x < ins; x++) {
            	form_data.append("file", document.getElementById('po_file').files[x]);
    	 		}
        		$.ajax({
			        	url: 'functions/uploads/upload_po.php',
			        	dataType: 'text',
			            cache: false,
			            contentType: false,
			            processData: false,
			            data: form_data,
			            type: 'post',
		            success: function (response){
             			var response = response.trim();
		            	// alert(response);
             			$('#loading').hide();
	             			if(response == 'true'){
			             		Swal.fire({
								  position: 'center',
								  icon: 'success',
								  title: 'Import PO File success',
								  showConfirmButton: false,
								  timer: 1500
								})
	 			    		updatetable();
	 			    		}else{
			             		Swal.fire({
					    	     icon: 'error',
					    	     title: 'Oops...',
					    	     text: 'The file your uploading is not a CSV file. Please try again.'
					    	    })
	 			   			}
             		}, error: function (response) {
            		}
        		});
		}

		function resettbl(){
			var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() {
	    		if (this.readyState == 4 && this.status == 200) {
	        		document.getElementById("tablePO").innerHTML = this.responseText;
	    		}
  			};
		  	xhttp.open("GET", "ajax/request-data.php?requesteddata=resetTable", true);
		  	xhttp.send();
		}
	$('#defaultUnchecked').click(function(){
		if($(this).prop("checked") == true){
				$('#tablePORecRem').show();
				$('#tablePORec').hide();
				$('#tablePORecRem').DataTable();
				var table = $('#tablePORec').DataTable();
				 table.destroy();
				$('.dataTables_length').addClass('bs-select');
			}else{
				$('#tablePORec').show();
				$('#tablePORecRem').hide();
				$('#tablePORec').DataTable();
				var table = $('#tablePORecRem').DataTable();
				 table.destroy();
				$('.dataTables_length').addClass('bs-select');
			}
	});

	$('#btnUpdate').click(function(){
			$('#loading').show();
			update_po();
	});

	function update_po(){
			var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() {
	    		if (this.readyState == 4 && this.status == 200) {
	        		// document.getElementById("tablePO").innerHTML = this.responseText;
	        		// alert(this.responseText);
	        		updatetable();
	        		$('#loading').hide();
	    		}
  			};
		  	xhttp.open("GET", "ajax/process-data.php?requesteddata=update_po", true);
		  	xhttp.send();
	}

	function updatetable(){
			var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() {
	    		if (this.readyState == 4 && this.status == 200) {
	        		// document.getElementById("tablePO").innerHTML = this.responseText;
	        		location.reload();
	    		}
  			};
		  	xhttp.open("GET", "ajax/request-data.php?requesteddata=po_record", true);
		  	xhttp.send();
		}
</script>
</body>
</html>