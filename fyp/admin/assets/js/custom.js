// go back arrow on login and signup page
function goBack() {
  window.history.back();
}

//toggle the filter and search button of categories page
function toggle() {
  var showhide = document.getElementById("side-bar");
  if (showhide.style.display == "block") {
    showhide.style.display = "none";
  } else {
    showhide.style.display = "block";
  }
}

// Get the container element
var btnContainer = document.getElementById("sidebar-nav");

// Get all buttons with class="btn" inside the container
var btns = btnContainer.getElementsByClassName("nav-item");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function () {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
