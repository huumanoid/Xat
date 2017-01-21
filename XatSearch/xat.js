var request     = require('request');
var cheerio     = require('cheerio');
var check       = [];

function init(search) {
    console.log("Please wait until we have fetched everything...");
    request({
        url: 'http://xat.com/web_gear/chat/search.php', //URL to hit
        method: 'POST',
        form: {'search': search}
    }, function(error, response, body){
        if(error) {
            console.log("Failed to get informations from this website!");
        } else {
            var $       = cheerio.load(body);
            $('td').each(function() {
                var classN      = $(this).attr('class');
                if (classN == "name") {
                    var message = $('a', this).text();
                    var name    = $('font', this).text().replace("[", "").replace("]", "");
                    if (name !== "") { // fetching if name is not empty
                        check.push(name);
                        console.log("Name :" + name);
                    }
                    if (message.indexOf('[') == -1) { // fetching only the message and not both >.<'
                        console.log("Message : " + message );
                    }
                }
                if (classN == "minutes") { // We'll get the xat URL on this class.
                    var xats = $('a', this).text();
                    console.log("Xat: " + xats + "\n");
                }
            });
            if (check.length == 0) {
                console.log("No results found c:");
            }
        }
    });
};

init('sloom');
