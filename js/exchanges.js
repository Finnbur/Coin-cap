//get all coins
function getAllCoins() {

	$.ajax({
		type: "GET",
		dataType: "json",
		url: "https://rest.coincap.io/v3/assets",

		success: function (allCoinsData) {
			coins = allCoinsData;

            console.log(coins.data);

            //get Template
            var coinTemplate = $("#js-coin-template").html();

            //Render output with Mustache (template, data)
            var renderTemplate = Mustache.render(coinTemplate, coins);

            //Add the data to HTML
            $("#coins-table .row").append(renderTemplate);

			//after everything loaded
			$("#preloader").fadeOut(500, function () {
				$(this).remove();
			});
		}
	});
}

$(document).ready(function () {
	//load all coins @ loading
	getAllCoins();
});