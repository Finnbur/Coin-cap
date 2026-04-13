//get all coins
function getAllCoins() {
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "https://rest.coincap.io/v3/assets",

		success: function (allCoinsData) {
			coins = allCoinsData;

			$.ajax({
				type: "GET",
				dataType: "json",
				url: "https://rest.coincap.io/v3/rates/euro",

				success: function (euroData) { 
					$.each(coins.data, function (index, value) {
						value.symbolLow = value.symbol.toLowerCase();

						// format price
						value.priceUsd = Number(value.priceUsd).toFixed(2);

						value.priceEur = (value.priceUsd / euroData.data.rateUsd).toFixed(2);

						// format percentage
						value.changePercent24Hr = Number(value.changePercent24Hr).toFixed(2);
						
						// if number in - red else green
						let change = Number(value.changePercent24Hr);
						value.changeClass = change < 0 ? "text-danger" : "text-success";
					});

					//get Template
					var coinTemplate = $("#js-coin-template").html();

					//Render output with Mustache (template, data)
					var renderTemplate = Mustache.render(coinTemplate, coins);

					//Add the data to HTML
					$("#coins-table tbody").append(renderTemplate);

					//after everything loaded
					$("#preloader").fadeOut(500, function () {
						$(this).remove();
					});
				}
			});

            console.log(coins.data);

			
		}
	});
}

//function to get a single coin
function getCoin(selectedButton) {
    coin = $(selectedButton).attr("id");

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "https://rest.coincap.io/v3/assets/"+ coin +"/",

        success: function (allCoinsData) {
            coins = allCoinsData.data;

            //Get Template
            var modalTemplate = $("#js-modal-template").html();

            //Render output with Mustache (template, data)
            var renderTemplate = Mustache.render(modalTemplate, coins);

            //Add the data to your HTML
            $("#exampleModal .modal-content").html(renderTemplate);

			//Use bigger modal
			$("#exampleModal .modal-dialog").addClass("modal-lg");

			//Generate chart
			getChartInfo();
        }
    })
}

function getAddCoin(selectedButton) {
    coin = $(selectedButton).attr("id");

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "https://rest.coincap.io/v3/assets/"+ coin +"/?apiKey=<YOUR API KEY HERE>",

        success: function (allCoinsData) {
            coins = allCoinsData.data;

            //Get Template
            var modalTemplate = $("#js-modal-coinAdd").html();

            //Render output with Mustache (template, data)
            var renderTemplate = Mustache.render(modalTemplate, coins);

            //Add the data to your HTML
            $("#exampleModal .modal-content").html(renderTemplate);

			//Use smaller modal
			$("#exampleModal .modal-dialog").removeClass("modal-lg");

			//Get right cost
			calculateTotal();
        }
    })
}

function addCoin() {
	var coinName = $("#coin-name").text();
	var coinPrice = $("#coin-price").text();
	var coinAmount = $("#coin-amount").val();
	var totalValue = $("#total-value").text();

	$.ajax({
		type: "POST",
		url: "includes/add_coins_db.php",
		data: {
			coin_name: coinName,
			coin_price: coinPrice,
			amount_coins: coinAmount,
			total_value: totalValue,
		},

		success: function (data) {
			// console.log(data);

			if(data == "succes") {
				alert("Added coin to portfolio!")
			} else {
				alert("Something went wrong!")
			}
		}
	})
}

function getChartInfo() {
    var weekAgo = new Date();
    weekAgo.setDate(weekAgo.getDate() - 7);

	$.ajax({
		type: "GET",
		dataType: "json",
		url: "https://rest.coincap.io/v3/assets/"+ coin +"/history?interval=d1&start=" + weekAgo.getTime() + "&end=" + new Date().getTime(),

		success: function (historicalData) {
			dateArray = [];
            priceArray = [];

            $.each(historicalData.data, function (index, value) {
                dateArray.push(new Date(value.date).toISOString().split("T")[0])
                priceArray.push(value.priceUsd)
            })

			generateChart(dateArray, priceArray)
		}
	})
}

function generateChart(chartDate, chartPrice) {
	var ctx = document.getElementById('coin-history-chart').getContext('2d');

	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'line',

		// The data for our dataset
		data: {
			labels: chartDate,
			datasets: [{
				type: "line",
				label: "Price",
				borderColor: '#3e95cd',
				data: chartPrice,
			}]
		},

		// Configuration options go here
		options: {
			scales: {
				x: {
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Date'
					}
				},
				y: {
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Price'
					}
				}
			},
			elements: { point: { radius: 0 } }
		}
	});
}

function calculateTotal() {
	var coinPrice = $("#coin-price").text();
	var coinAmount = $("#coin-amount").val();
	var totalPrice = coinPrice * coinAmount;

	$("#total-value").text(totalPrice);

}

$(document).ready(function () {
	//load all coins @ loading
	getAllCoins();

	//On click to get a single coin
	$("#coins-table").on("click", ".coin-info-btn-modal", function () {
		getCoin(this);
	});

	//On click to get modal of adding coin
	$("#coins-table").on("click", ".coin-add-btn-modal", function () {
		getAddCoin(this);
	});

	$(document).on("click", ".coin-add-btn", function () {
		addCoin();
	});

	$(document).on("input change", "#coin-amount", function () {
        calculateTotal();
    });
});