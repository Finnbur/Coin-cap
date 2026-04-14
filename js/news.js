//get all news
function getAllNews() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "https://api.thenewsapi.net/crypto?apikey=A5C85310A30961F16DA8F627DA6C9F0E&page=1&size=10",
        
        success: function (response) {
            console.log(response.data);

            //get Template
            var template = $('#js-news-template').html();

            //Render output with Mustache (template, data)
            var rendered = Mustache.render(template, response);

            //Add the data to HTML
            $('#news-table .row').html(rendered);
            
            //after everything loaded
            $("#preloader").fadeOut(500, function () {
                $(this).remove();
            });
        },
        error: function() {
            console.error("Could not load news data.");
        }
    });
}

$(document).ready(function () {
	//load all news @ loading
	getAllNews();
});