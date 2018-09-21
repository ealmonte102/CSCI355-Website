window.onresize = onResize;

document.getElementById('user-agent-string-content').innerHTML = navigator.userAgent;

document.getElementById('operating-system-content').innerHTML = getOSName();

document.getElementById('language-content').innerHTML = navigator.language;

document.getElementById('cookies-content').innerHTML = navigator.cookieEnabled == true ? "Yes" : "No";

document.getElementById('color-depth-content').innerHTML = screen.colorDepth + " bit";


document.getElementById('browser-size-content').innerHTML = window.outerWidth + " x " + window.innerHeight;

document.getElementById('screen-size-content').innerHTML = screen.width + " x " + screen.height;


function getOSName() {
  var operatingSystemName = "Unkown OS";
  if(navigator.appVersion.indexOf("Win") != -1) {
    operatingSystemName = "Windows";
  }
  if(navigator.appVersion.indexOf("Linux") != -1) {
    operatingSystemName = "Linux";
  }
  if(navigator.appVersion.indexOf("Mac") != -1) {
    operatingSystemName = "MacOS";
  }
  if(navigator.appVersion.indexOf("X11") != -1) {
    operatingSystemName = "UNIX";
  }
  return operatingSystemName;
}

function onResize() {
  document.getElementById('browser-size-content').innerHTML = window.outerWidth + " x " + window.innerHeight;

  document.getElementById('screen-size-content').innerHTML = screen.width + " x " + screen.height;
}
