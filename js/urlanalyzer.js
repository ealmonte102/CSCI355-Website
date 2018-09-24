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
    var protocolUsage = {
      https: 0,
      http: 0,
      other: 0
    };
    var portUsage = {};
    for (var i = 0; i < fileContent.length; ++i) {
      try {
        if (!(fileContent[i].startsWith("http://") || fileContent[i].startsWith("https://"))) {
          fileContent[i] = "http://" + fileContent[i];
        }
        const currentURL = new URL(fileContent[i]);
        var urlToResolve = dnsResolverURL + currentURL.host;
        var row = document.createElement("tr");
        var protocolColumn = document.createElement("td");
        var userInfoColumn = document.createElement("td");
        var hostColumn = document.createElement("td");
        var portColumn = document.createElement("td");
        var pathColumn = document.createElement("td");
        var queryColumn = document.createElement("td");
        var fragmentColumn = document.createElement("td");
        var ipColumn = document.createElement("td");
        var protocol = currentURL.protocol.substring(0, currentURL.protocol.length - 1);
        protocolColumn.innerHTML = protocol
        userInfoColumn.innerHTML = currentURL.username;
        hostColumn.innerHTML = currentURL.hostname;
        portColumn.innerHTML = currentURL.port;
        pathColumn.innerHTML = currentURL.pathname;
        queryColumn.innerHTML = currentURL.search;
        fragmentColumn.innerHTML = currentURL.hash;
        row.appendChild(protocolColumn);
        row.appendChild(userInfoColumn);
        row.appendChild(hostColumn);
        row.appendChild(portColumn);
        row.appendChild(pathColumn);
        row.appendChild(queryColumn);
        row.appendChild(fragmentColumn);
        row.appendChild(ipColumn);
        tableBody.appendChild(row);
        protocolUsage[protocol]++;
        var portUsed = getPort(protocol, currentURL.port);
        if(portUsed in portUsage) {
          portUsage[portUsed]++;
        } else {
          portUsage[portUsed] = 1;
        }
        makeDNSRequest(urlToResolve, ipColumn);
      } catch (err) {
        console.log(err);
      }
    }
    var protocolData = [{
        x: "HTTPS",
        value: protocolUsage["https"]
      },
      {
        x: "HTTP",
        value: protocolUsage["http"]
      },
      {
        x: "NONE",
        value: protocolUsage
      }
    ]
    var portData = [];
    var keys = Object.keys(portUsage)
    for(var index in keys) {
      portData.push({
        x: keys[index],
        value: portUsage[keys[index]]
      });
    }
    console.log(portData);
    createChart(protocolData, "Protocol Usage", "protocol-chart-container");
    createChart(portData, "Port Usage", "port-chart-container");
  };

  reader.onerror = function(event) {
    console.error("File could not be read! Code " + event.target.error.code);
  };
  reader.readAsText(fileChosen);
}

function getPort(protocolUsed, portUsed) {
  if(portUsed === "") {
    switch(protocolUsed) {
      case "https":
        return "443";
      case "http":
        return "80";
    }
  }
  return portUsed;
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

function createChart(data, title, container) {
  var chart = anychart.pie();
  chart.title(title);
  chart.data(data);
  chart.container(container);
  chart.draw();
}
