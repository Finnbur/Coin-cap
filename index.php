<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">

	<title>CryptoMania - Workshop - API</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Cryptomania</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="cryptoportfolio.php">Crypto portfolio</a>
					</li>
				</ul>
				</div>
			</div>
		</nav>

		<table class="table" id="coins-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>symbol</th>
					<th>Price USD</th>
					<th>More info</th>
				</tr>
			</thead>
			<tbody>
				<template id="js-coin-template">
					{{#data}}
						<tr>
							<td><img src="https://static.coincap.io/assets/icons/{{symbolLow}}@2x.png" height="30px" width="30px">  {{id}}</td>
							<td>{{symbol}}</td>
							<td>{{priceUsd}}</td>
							<td><button data-bs-toggle='modal' data-bs-target='#exampleModal' type='button' id='{{id}}' class='btn btn-primary coin-info-btn'>info</button></td>
						</tr>
					{{/data}}
				</template>
			</tbody>
		</table>
	</div>

	<!-- modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
	</div>

	<template id="js-modal-template">
				<div class="modal-header">
					<h5 class="modal-title" id="modal-title">{{name}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
			<div class="modal-body" id="modal-body">
				Supply: {{supply}}
				<canvas id="coin-history-chart"></canvas>
			</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
	</template>



	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

	<!-- Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<!-- Mustache -->
	<script src="https://unpkg.com/mustache@latest/mustache.min.js"></script>

	<!-- Chart JS -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom js  -->
    <script src="js/main.js"></script>
</body>
</html>