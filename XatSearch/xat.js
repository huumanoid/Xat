var request     = require('request');
var cheerio     = require('cheerio');
var hasResults = false;

var keyword = process.argv[2] || "sloom";

function init(search) {
    console.log("Please wait until we have fetched everything...");
    request({
        url: 'http://xat.com/web_gear/chat/search.php', //URL to hit
        method: 'POST',
        form: {'search': search}
    }, function(error, response, body){
        if (error) {
            console.log("Failed to get informations from this website!");
        } else {
            var $       = cheerio.load(body);
            $('td').each(function() {
                var classN      = $(this).attr('class');
                if (classN == "name") {
                    var message = $('a', this).text();
                    var name = $('font', this).text().replace("[", "").replace("]", "");
                    var lastIndexOfBrace = message.lastIndexOf('[');

                    if (name !== "") { // fetching if name is not empty
                        hasResults = true;
                        console.log("Name:", name);
                    }
                    if (lastIndexOfBrace === -1) { // fetching only the message and not both >.<'
                        console.log("Message:", message);
                    } else {
                        console.log('Nickname:',
                            message.substr(0, lastIndexOfBrace));
                    }
                }
                if (classN === "minutes") { // We'll get the xat URL on this class.
                    var content = $(this).text().split('on');
                    var time = content[0];
                    var xats = content[1].trim();

                    console.log("Xat:", xats);
                    console.log("Time:", time);

                    console.log();
                }
            });
            if (!hasResults) {
                console.log("No results found c:");
            }
        }
    });
};

init(keyword);
