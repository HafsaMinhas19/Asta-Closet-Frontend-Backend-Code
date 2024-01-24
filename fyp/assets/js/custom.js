// toggle images of product description page
const productImages = document.querySelectorAll(".product-img");
const productImageSlide = document.querySelector(".image-slider");
// this variable stores the current active image
let activeImageSlide = 0;
productImages.forEach((item, i) => {
  item.addEventListener("click", () => {
    productImages[activeImageSlide].classList.remove("active");
    item.classList.add("active");
    productImageSlide.style.background = `url('${item.src}')`;
    productImageSlide.style.backgroundSize = "Cover";
    activeImageSlide = i;
  });
});

// toggle size buttons of product description page
const sizeBtns = document.querySelectorAll(".size-radio-btn");
// const sizeBtnslide = document.querySelector('.image-slider');
// this variable stores the current checked size button
let checkedBtn = 0;
sizeBtns.forEach((item, i) => {
  item.addEventListener("click", () => {
    sizeBtns[checkedBtn].classList.remove("check");
    item.classList.add("check");
    checkedBtn = i;
  });
});

// index women-banner and men-banner slider js
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

// go back arrow on login and signup page
function goBack() {
  window.history.back();
}

//toggle the filter and search button of categories page
function toggle() {
  var showhide = document.getElementById("toggle-para");
  if (showhide.style.display == "block") {
    showhide.style.display = "none";
  } else {
    showhide.style.display = "block";
  }
}

//login page validation

function clearErrors() {
  errors = document.getElementsByClassName("formerror");
  for (let item of errors) {
    item.innerHTML = "";
  }
}

function seterror(id, error) {
  //sets error inside tag of id
  element = document.getElementById(id);
  element.getElementsByClassName("formerror")[0].innerHTML = error;
}

function validateLoginForm() {
  var returnval = true;
  clearErrors();
  //perform validation and if validation fails, set the value of returnval to false
  var email = document.forms["loginForm"]["e-mail"].value;
  if (email.length > 50) {
    seterror("e-mail", "*Email length is too long!");
    returnval = false;
  }
  var passColor = document.forms["loginForm"]["pass"];
  var password = document.forms["loginForm"]["pass"].value;
  if (password.search(/[0-9]/) == -1) {
    passColor.style.border = "1px solid red";
    seterror("pass", "*Password should contain atleast one numeric value!");
    returnval = false;
  }
  if (password.search(/[a-z]/) == -1) {
    passColor.style.border = "1px solid red";
    seterror(
      "pass",
      "*Password should contain atleast one lowercase character!"
    );
    returnval = false;
  }
  if (password.search(/[A-Z]/) == -1) {
    passColor.style.border = "1px solid red";
    seterror(
      "pass",
      "*Password should contain atleast one uppercase character!"
    );
    returnval = false;
  }
  if (
    password.search(
      /[~\`\!\@\#\$\%\^\&\*\(\)\_\-\+\=\{\(\)\[\}\]\|\:\;\"\'\<\,\>\.\?\/]/
    ) == -1
  ) {
    passColor.style.border = "1px solid red";
    seterror("pass", "*Password should contain atleast one special character!");
    returnval = false;
  }
  if (password.length < 6) {
    passColor.style.border = "1px solid red";
    seterror("pass", "*Password should be atleast 6 characters long!");
    returnval = false;
  }
  if (password.length > 16) {
    passColor.style.border = "1px solid red";
    seterror("pass", "*Password is too lengthy!");
    returnval = false;
  }
  if (password.indexOf(" ") !== -1) {
    passColor.style.border = "1px solid red";
    seterror("pass", "*Blank Spaces Not Allowed!");
    returnval = false;
  }
  return returnval;
}
