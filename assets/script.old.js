var domReady = function(callback) {
    document.readyState === "interactive" || document.readyState === "complete" ? callback() : document.addEventListener("DOMContentLoaded", callback);
};
domReady(function(){
    var form = document.querySelector('#form');
    form.addEventListener('submit', validateForm, false);
});

function validateForm(e) {
    if (e.preventDefault) {
        e.preventDefault();
    }
    e.returnValue = false; // for IE
    var form = this;
    loadMoreEvent(form);

}

function loadMoreEvent(a){

    var url = a.getAttribute('action');
    console.log(url);
    var XHR = new XMLHttpRequest();
    var urlEncodedData = "";
    var urlEncodedDataPairs = [];
    var name, data = a;

    // Turn the data object into an array of URL-encoded key/value pairs.
    for(name in data) {
        urlEncodedDataPairs.push(encodeURIComponent(name) + '=' + encodeURIComponent(data[name]));
    }

    // Combine the pairs into a single string and replace all %-encoded spaces to
    // the '+' character; matches the behaviour of browser form submissions.
    urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');

    // Define what happens on successful data submission


    // Set up our request
    XHR.open('post', url);

    // Add the required HTTP header for form data POST requests
    XHR.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
    XHR.onload = function() {
        if (XHR.status === 200) {
            console.log('OK ' + XHR.responseText);
        }
        else if (XHR.status !== 200) {
            console.log('Request failed.  Returned status of ' + XHR.status);
        }
    };
    //console.log(urlEncodedData);
    // Finally, send our data.
    var dd = {
        "value" : "string data"
    }
    XHR.send();
}