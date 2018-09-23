function myFunction() {
  var topNav = document.getElementById("myTopNav");
  if (topNav.className === "topnav") {
      topNav.className += " responsive";
  } else {
      topNav.className = "topnav";
  }
  var logo = document.getElementById("nav-logo");
  var originalLogoClassName = "nav-link topnav-logo-link"
  if (logo.className === originalLogoClassName) {
      logo.className += " responsive";
  } else {
      logo.className = originalLogoClassName;
  }
}

var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("myTopNav").style.top = "0";
  } else {
    document.getElementById("myTopNav").style.top = "-44px";
  }
  prevScrollpos = currentScrollPos;
}
