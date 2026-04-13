<?php
session_start();
if(!isset($_SESSION['loggedIn'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">

	<title>CryptoMania - Portfolio</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" >

</head>
<body>
	<?php include 'includes/nav.php'; ?>

	<div class="container">

		<div class="container my-4">
			<div class="table-responsive shadow rounded-3 overflow-hidden">
				<table class="table table-striped table-hover align-middle mb-0" id="crypto-folio-table">
					<thead class="table-secondary">
						<tr>
							<th class="text-nowrap">Bought on</th>
							<th class="text-nowrap">Name</th>
							<th class="text-nowrap">Price now</th>
							<th class="text-nowrap">Price when bought</th>
							<th class="text-nowrap">Amount</th>
							<th class="text-nowrap">Total</th>
							<th class="text-nowrap text-center">Save</th>
							<th class="text-nowrap text-center">Delete</th>
						</tr>
					</thead>
					<tbody class="bg-white"></tbody>
					<tfoot class="table-light">
						<tr class="fw-bold">
							<td colspan="5" class="text-end">Portfolio Total:</td>
							<td id="total-value" class="text-success"></td>
							<td colspan="2"></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

	</div>

	<template id="coins-cryptofolio-template">
		{{#.}}
			<tr>
				<td class="text-muted small">{{bought_on}}</td>
				<td class="fw-semibold">{{name}}</td>
				<td class="fw-semibold">${{priceUsd}}</td>
				<td class="coin-price {{changeClass}}">${{price}}</td>
				<td style="max-width: 100px;">
					<input type="number" value="{{amount}}" class="form-control form-control-sm coin-amount" min="1">
				</td>
				<td class="fw-bold">${{totalValue}}</td>
				<td class="text-center">
					<button type="button" class="btn btn-warning btn-sm save-coin-btn" value="{{id}}">
						Save
					</button>
				</td>
				<td class="text-center">
					<button type="button" class="btn btn-danger btn-sm delete-coin-btn" value="{{id}}">
						Delete
					</button>
				</td>
			</tr>
		{{/.}}
	</template>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

	<!-- Bootstrap -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>	

	<!-- Mustache JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.js"></script>

	<!-- Chart JS -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    
    <!-- Custom js  -->
	<script src="js/portfolio.js"></script>
</body>
</html>