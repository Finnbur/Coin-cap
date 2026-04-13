<?php 
session_start() 
?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">

	<title>CryptoMania</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<?php include 'includes/nav.php'; ?>

	<div class="container">

		<image src="images/spin_wheel.gif" id="preloader" class="d-block mx-auto my-5" height="600" width="600" alt="Loading...">

		<div class="container my-4">
			<div class="table-responsive shadow-sm rounded-3 overflow-hidden">
				<table class="table table-striped table-hover align-middle mb-0" id="coins-table">
					<thead class="table-secondary">
						<tr>
							<th class="text-nowrap">ID</th>
							<th class="text-nowrap">Symbol</th>
							<th class="text-nowrap">Price USD</th>
							<th class="text-nowrap">Price EUR</th>
							<th class="text-nowrap">%24hr</th>
							<th class="text-nowrap">More info</th>
							<?php if(isset($_SESSION['loggedIn'])) { ?>
								<th class="text-nowrap">Add to Wallet</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody class="bg-white"></tbody>
				</table>
			</div>
		</div>
	</div>

<template id="js-coin-template">
    {{#data}}
        <tr>
            <td class="fw-semibold"><img src="https://static.coincap.io/assets/icons/{{symbolLow}}@2x.png" height="30" width="30" class="me-2" alt="{{symbol}}">{{id}}</td>
            <td class="text-uppercase">{{symbol}}</td>
            <td>${{priceUsd}}</td>
            <td>€{{priceEur}}</td>
            <td class="{{changeClass}} fw-semibold">{{changePercent24Hr}}%</td>
            <td>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" id="{{id}}" class="btn btn-primary btn-sm coin-info-btn-modal">
                    More info
                </button>
            </td>
            <?php if(isset($_SESSION['loggedIn'])) { ?>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" id="{{id}}" class="btn btn-success btn-sm coin-add-btn-modal">
                        Add to wallet
                    </button>
                </td>
            <?php } ?>
        </tr>
    {{/data}}
</template>

	<!-- modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content">
		</div>
	</div>
	</div>

	<template id="js-modal-template">
				<div class="modal-header">
					<h5 class="modal-title" id="coin-name">{{name}} ({{symbol}})</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
			<div class="modal-body" id="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-6 mb-3">
							<h5>Price</h5>
							<p>${{priceUsd}}</p>
							
						</div>
						<div class="col-6 mb-3">
							<h5>Supply</h5>
							<p>{{supply}}</p>
						</div>
						<div class="col-6 mb-3">
							<h5>Market Cap</h5>
							<p>{{marketCapUsd}}</p>
						</div>
						<div class="col-6 mb-3">
							<h5>Volume</h5>
							<p>${{volumeUsd24Hr}}</p>
						</div>
					</div>

				<canvas id="coin-history-chart"></canvas>
				</div>
			</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
	</template>

<?php if(isset($_SESSION['loggedIn'])) { ?>
	<template id="js-modal-coinAdd">
				<div class="modal-header">
					<h5 class="modal-title" id="coin-name">{{id}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
			<div class="modal-body" id="modal-body">
				<h5>Price:</h5>
				<p>$<price id="coin-price">{{priceUsd}}</price></p>
				<h5>Amount:</h5>
				<p><input type="number" min="1" value="1" id="coin-amount"></p>
				<h5>Total:</h5>
				<p>$<price id="total-value">{{priceUsd}}</price></p>
				<button type="button" class="btn btn-primary coin-add-btn">Add</button>
			</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
	</template>
<?php } ?>



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