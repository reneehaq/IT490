/** 
    Reference:
     - https://theysaidso.com/api/
     - For categories, route syntax, image locations,
       usage rules, copyright etc.
*/


// Debug levels
var verbose = true;//true is show messages

/** # My functions **************************************** */

/** Initialize the first quote after the document is loaded 
    with $(document).ready
*/
$(document).ready(function () {
    $("#reqQOD").trigger("click"); //click the button
});


/** ## randomCategory 
     input arg: arr is an array of category names as strings
     output:    one category name string randomly selected
 */
function randomCategory(arr) {
    var rand = Math.floor((Math.random() * arr.length) + 1);
    return arr[rand]; //one random category element as string from the array
} /* end of randomCategory ====================  */

/** Request a Quote of the Day */
$("#reqQOD").on("click", function () { //when the button is clicked
    /** To reduce the numbers of requests to the API I have
         manually copied the categories here.  If a new
         category were to be added on the server we would not
         know it.
     */
    var myCat = randomCategory(["inspire", "management", "sports", "life", "funny", "love", "art"]);
    var route = "https://quotes.rest/qod.json?category=" + myCat;
    /* Rate limit: 10 API calls per hour  with public free version */
    $.catObj = {}; //initialize outside the scope of following invocation (stored in jQuery!)
    $.getJSON(route, function (json) {
        var theQuote;
        var theAuthor;
        var theBackgroundURL;
        // store copy in jquery scope before 'json' loses scope!
        $.catObj = JSON.parse(JSON.stringify(json)); // what if nothing gets returned in json?          
        if(typeof($.catObj)!=='undefined'){
            // get the quote, author and backgroundURL defined by 'they said so'quote API
            theQuote = $.catObj.contents.quotes[0].quote;
            theAuthor = $.catObj.contents.quotes[0].author;
            theBackgroundURL = $.catObj.contents.quotes[0].background;
            $("#QOD").html(JSON.stringify(theQuote)); //display the quote
            $("<p>" + "by: " + theAuthor + "</p>").appendTo("#QOD");
            $("#QOD-image").attr("src", theBackgroundURL);
        }else{
            // get the already stored alternate quote from brainy quote
            $("#alt1_QOD").show();//show this alternate quote source
            theQuote = $("#alt1_QOD").html();
            vvD.konsole(true,"#alt1_QOD  theQuote: " + theQuote)
        }

       // update the tweet button attribute data-text
       // with a random quote
        var shortendQuote = "text="+theQuote.slice(0,90) + "... "+"by: " + theAuthor;
        shortendQuote = shortendQuote.slice(0,110);// max 140 characters for twitter
        $( "#reqTweet" ).attr( "data-text", shortendQuote );//add quote to button       
    })
    .fail(function( jqxhr, textStatus, error ) {
        var err = jqxhr.responseJSON.error.message;
        //vvD.modal(true, "Request for quote from 'They Said So' failed: " + err);
        vvD.konsole(true, "Request for free quote from 'They Said So' failed " + err, jqxhr);
        vvD.konsole(true, "Displaying alternate quote sourced from brainyquote.com ");
        $("#alt1_QOD").show();//display this alternate quote source
        theQuote = $("#alt1_QOD").html();//does this return what we need to change update the tweet button?
        vvD.konsole(true,"#alt1_QOD  theQuote: " + theQuote);//      
    }); //end of getJSON

  
    //return $.catObj; //the quote  ?    
}); //end of on click handling


$( "#reqTweet" ).on( "click", function() {
  var dataHref = $("#reqTweet").attr("data-href");
  var dataText = encodeURI( $("#reqTweet").attr("data-text") );
  var dataURL = encodeURI( $("#reqTweet").attr("data-url") );
  var dataHastags = encodeURI( $("#reqTweet").attr("data-hashtags") );
  var route = dataHref + "?" + dataHastags + "&" + dataText + "&" + dataURL;
  vvD.konsole(true, "route: " + decodeURI(route) );//debug only
/* Debug only
  var res = confirm("Tweeting at\n" + route);//debug only
  switch (res) {//debug only - comment out for production
    case true:
      window.open(route);
      break;
    case false:
      // no new window
  }
*/
  window.open(route);//uncomment for production
});// end of reqTweet



/** Mainline code */
/** =============================== */
// debug messages
// Reference:
//     https://github.com/NorthDecoder/jsDebugUtility/blob/master/vvD/js/vvD_module.js
//     vvD.modal(verbose,logMsg,dirMsg); //syntax
//     var verbose = true;// messages on, set at the top of thise file
//vvD.modal(verbose,"vvD.version: "+vvD.version,{"key":"value"});
vvD.konsole(verbose,"The vvD.version: "+vvD.version);
//vvD.modal(false,"Turn off the modal");// modal not visible

/** =============================== */
/** End of mainline */


/////////////////////////////////  
/**  # Tests  */
/**
     ## With Jasmine
       https://jasmine.github.io/2.4/introduction.html
*/

// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
describe("The random quote API: ", function () {

    it("should return a category list as JSON ", function () {
        /* A stub to simulate the server */
        $.response = {
            "success": {
                "total": 7
            },
            "contents": {
                "categories": {
                    "inspire": "Inspiring Quote of the day",
                    "management": "Management Quote of the day",
                    "sports": "Sports Quote of the day",
                    "life": "Quote of the day about life",
                    "funny": "Funny Quote of the day",
                    "love": "Quote of the day about Love",
                    "art": "Art quote of the day "
                },
                "copyright": "2013-15 http://theysaidso.com"
            }
        };

        /* Rate limit: 10 API calls per hour 
         
          $.getJSON("https://quotes.rest/qod/categories.json", function(json) {
            $.response = json;// store in jquery scope before json loses scope!
            $("#test-message").html(JSON.stringify($.response));//debug only
            console.log("$.response: "+"typeof: "+ typeof($.response));//debug only
            console.dir($.response);//debug only
          });
          
         */

        /** for example {"success":{"total":7} ... */
        expect(typeof ($.response) === 'object').toBe(true);
        expect(typeof ($.response.success.total) === 'number').toBe(true);
    });

    it("should return a random category string ", function () {
        var category = randomCategory(["inspire", "management", "sports", "life", "funny", "love", "art"]);
        expect(typeof (category) === 'string').toBe(true);
    });

    it("should return a random Quote of the Day as JSON with parameter set like category=management  ", function () {
        var myCat = randomCategory(["inspire", "management", "sports", "life", "funny", "love", "art"]);
        var route = "https://quotes.rest/qod.json?category=" + myCat;
        /* Rate limit: 10 API calls per hour  with public free version */
        $.catObj = {}; //initialize outside the scope of following invocation
        $.getJSON(route, function (json) {
            $.catObj = JSON.parse(JSON.stringify(json)); // store copy in jquery scope before json loses scope!
        });
        expect(typeof ($.catObj) === 'object').toBe(true);
    });
});
// ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
describe("The random quote user interface(UX): ", function () {

    describe(" #QOD should receive a random quote (or other response) ", function () {
        $("#QOD").html(""); // initialize to empty 

        var response = {}; // store QOD in this object    
        response = $("#reqQOD").trigger("click"); //click the button to request a quote    
        it(" on #reqQOD button click", function (done) {
            // quote asynchronous response from server 
            // stored in html to not be zero length or empty
            expect($("#QOD").html().length).not.toBe(0);
            done();
        }); //end of it 
    }); //end of describe   

    it("Button #reqTweet click opens new tweet window with the quote already entered", function () {
        //See possible solution at:
        //  http://www.slideshare.net/larsthorup/advanced-jasmine
        //  https://github.com/larsthorup/jasmine-demo-advanced
        //  for pop up window testing and mocking
    });
}); // end of describe
