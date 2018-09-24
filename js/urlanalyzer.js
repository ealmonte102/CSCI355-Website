function analyzeFile() {
  var fileWrapper = document.getElementById("url-file");
  var txt = "";
  if (fileWrapper.files.length == 0) {
    return;
  }

  var fileChosen = fileWrapper.files[0];
  var descriptionElement = document.getElementById("url-analyzer-content");
  var reader = new FileReader();
  var tableBody = document.getElementById("url-table").childNodes[3];
  tableBody.innerHTML = "";
  reader.onload = function(event) {
    var dnsResolverURL = "https://dns.google.com/resolve?name=";
    var fileContent = event.target.result.split('\n');
    var protocolUsage = {https: 0, http: 0, other: 0};
    var portUsage = {};
    for (var i = 0; i < fileContent.length; ++i) {
      try {
        if(!(fileContent[i].startsWith("http://") || fileContent[i].startsWith("https://"))) {
          fileContent[i] = "http://" + fileContent[i];
        }
        const currentURL = new URL(fileContent[i]);
        var urlToResolve = dnsResolverURL + currentURL.host;
        var row = document.createElement("tr");
        var schemeColumn = document.createElement("td");
        var userInfoColumn = document.createElement("td");
        var hostColumn = document.createElement("td");
        var portColumn = document.createElement("td");
        var pathColumn = document.createElement("td");
        var queryColumn = document.createElement("td");
        var fragmentColumn = document.createElement("td");
        var ipColumn = document.createElement("td");
        var scheme = currentURL.protocol.substring(0, currentURL.protocol.length - 1);
        schemeColumn.innerHTML = scheme
        userInfoColumn.innerHTML = currentURL.username;
        hostColumn.innerHTML = currentURL.hostname;
        portColumn.innerHTML = currentURL.port;
        pathColumn.innerHTML = currentURL.pathname;
        queryColumn.innerHTML = currentURL.search;
        fragmentColumn.innerHTML = currentURL.hash;
        row.appendChild(schemeColumn);
        row.appendChild(userInfoColumn);
        row.appendChild(hostColumn);
        row.appendChild(portColumn);
        row.appendChild(pathColumn);
        row.appendChild(queryColumn);
        row.appendChild(fragmentColumn);
        row.appendChild(ipColumn);
        tableBody.appendChild(row);
        protocolUsage[scheme]++;
        var port = currentURL.port == "" ? "none" : "" + currentURL.port;
        if(port in portUsage) {
          portUsage[port]++;
        } else {
          portUsage[port] = 0;
        }
        makeDNSRequest(urlToResolve, ipColumn);
      } catch (err) {
        console.log(err);
      }
    }
  };

  reader.onerror = function(event) {
    console.error("File could not be read! Code " + event.target.error.code);
  };
  reader.readAsText(fileChosen);
}

function makeDNSRequest(urlToResolve, ipColumn) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(xhttp.responseText);
      ipColumn.innerHTML = response.Answer[response.Answer.length - 1].data;
    }
  };
  xhttp.open("GET", urlToResolve, true);
  xhttp.send();
}
