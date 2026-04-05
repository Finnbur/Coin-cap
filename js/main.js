//example API (Docs): https://pro.coincap.io/api-docs
//get all coins
function getAllCoins() {

	$.ajax({
		type: "GET",
		dataType: "json",
		url: "https://rest.coincap.io/v3/assets?apiKey=<YOUR API KEY HERE>",

		success: function (allCoinsData) {
			coins = allCoinsData;

            console.log(coins.data);

			$.each(coins.data, function (index, value) {
				value.symbolLow = value.symbol.toLowerCase();
			});

            //get Template
            var coinTemplate = $("#js-coin-template").html();

            //Render output with Mustache (template, data)
            var renderTemplate = Mustache.render(coinTemplate, coins);

            //Add the data to your HTML
            $("#coins-table tbody").append(renderTemplate);
		}
	});
}


//function to get a single coin
function getCoin(selectedButton) {
    coin = $(selectedButton).attr("id");

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "https://rest.coincap.io/v3/assets/"+ coin +"/?apiKey=<YOUR API KEY HERE>",

        success: function (allCoinsData) {
            coins = allCoinsData.data;

            //get Template
            var modalTemplate = $("#js-modal-template").html();

            //Render output with Mustache (template, data)
            var renderTemplate = Mustache.render(modalTemplate, coins);

            //Add the data to your HTML
            $("#exampleModal .modal-content").html(renderTemplate);

            // $("#modal-title").empty().append(coins.data.name)
            // $("#modal-body").empty().append("Supply: "+ coins.data.supply)
        }
    })

    getChartInfo();
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

$(document).ready(function () {
	//load all coins @ loading
	getAllCoins();

	//On click to get a single coin
	$("#coins-table").on("click", ".coin-info-btn", function () {
		getCoin(this);
	});
});


