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
            <div id="coins-exchanges">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"></div>
            </div>
        </div>
    </div>

	<template id="js-coin-template">
        {{#data}}
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-text">{{rank}}. {{name}}</h5>
                    <p class="card-text">Volume: ${{volumeUsd}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{exchangeUrl}}" class="btn btn-primary">Website</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		{{/data}}
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
    <script src="js/exchanges.js"></script>
</body>
</html>