//Get all coins from the DB for your cryptofolio
function getAllCoinsPortfolio() {
    $.ajax({
        type: "GET",
        url: "includes/get_coins_db.php",
        dataType: "json",

        success: function (coinsFromDB) {
            // coinsFromDB is an array of your coins from DB
            let requests = [];

            coinsFromDB.forEach((coin, index) => {
                // Prepare an AJAX request for each coin to get real-time price
                let request = $.ajax({
                    type: "GET",
					url: "https://rest.coincap.io/v3/assets/"+ coin.name +"/?apiKey=<YOUR API KEY HERE>",
                    dataType: "json",
                    success: function (coinData) {
                        // Merge real-time price into your DB coin data
                        coin.priceUsd = coinData.data.priceUsd;

						coin.changeClass = coin.priceUsd < coin.price ? "text-success" : coin.priceUsd > coin.price ? "text-danger" : "";
                    }
                });

                requests.push(request);
            });

            // Wait for all AJAX calls to finish
            $.when.apply($, requests).then(function () {
                var portfolioTemplate = $("#coins-cryptofolio-template").html();

                var renderTemplate = Mustache.render(portfolioTemplate, coinsFromDB);

                $("#crypto-folio-table tbody").html(renderTemplate);

                // Calculate total
                let total = coinsFromDB.reduce((sum, coin) => {
                    return sum + (parseFloat(coin.totalValue));
                }, 0);

                // Display in footer
                $("#total-value").text("$" + total.toFixed(2));
            });
        }
    });


}

//Save coin function
function saveCoin(getSaveButton) {
	coinId = $(getSaveButton).attr("value");

	var coinPrice = $(getSaveButton).closest("tr").find(".coin-price").text();
	var coinAmount = $(getSaveButton).closest("tr").find(".coin-amount").val();

	$.ajax({
		type: "POST",
		url: "includes/save_coin_db.php",
		data: {
			coin_id: coinId,
			coin_price: coinPrice,
			amount_coins: coinAmount,
		},

		success: function (data) {
			// console.log(data);

			if(data == "succes") {
				alert("Saved coin!")
			} else {
				alert("Something went wrong!")
			}
			//show the new data
			getAllCoinsPortfolio();
		}
	})
}

//Delete coin function
function deleteCoin(getDeleteButton) { 
	coinId = $(getDeleteButton).attr("value");

	if (!confirm("Are you sure you want to delete this coin?")) {
		return; // stop if user clicks "Cancel"
	}

	$.ajax({
		type: "POST",
		url: "includes/delete_coin_db.php",
		data: {
			coin_id: coinId
		},

		success: function (data) {
			console.log(data);

			if(data == "succes") {
				alert("Deleted coin!")
			} else {
				alert("Something went wrong!")
			}
			//show the new data
			getAllCoinsPortfolio();
		}
	})
}


$(document).ready(function () {
	//Get all coins from the database
	getAllCoinsPortfolio();

	//On click event to update the amount of coins
	$(document).on("click", ".save-coin-btn", function () {
		saveCoin(this);
	});

	//On click event to delete coin
    $(document).on("click", ".delete-coin-btn", function () {
		deleteCoin(this);
	});
});
