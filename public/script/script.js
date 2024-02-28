function toggleSubMenu(submenuId) {
  var submenus = document.getElementsByClassName("submenu-side");
  var parentElement = document.getElementById(submenuId).previousElementSibling;
  var panah = parentElement.querySelector(".panah-si");

  for (var i = 0; i < submenus.length; i++) {
    if (submenus[i].id === submenuId) {
      if (submenus[i].style.display === "block") {
        submenus[i].style.display = "none";
        panah.style.transform = "rotate(0deg)";
      } else {
        submenus[i].style.display = "block";
        panah.style.transform = "rotate(90deg)";
      }
    } else {
      submenus[i].style.display = "none";
      var otherParentElement = submenus[i].previousElementSibling;
      var otherPanah = otherParentElement.querySelector(".panah-si");
      if (otherPanah) {
        otherPanah.style.transform = "rotate(0deg)";
      }
    }
  }
}
function ukurUlang() {
  var sidebar = document.getElementById("sidebar");

  var lebarLayar = window.innerWidth;
  var conmain = document.getElementById("con-main");
  var mainAd = document.getElementById("main-ad");
  var mainLeft = document.getElementById("main-left");
  var mainRight = document.getElementById("main-right");
  var button = document.getElementById("burger-menu");
  var lConMain = conmain.clientWidth;
  var conPko = document.getElementById("con-pko");
  var namePage = document.getElementById("namePage");

  // if (lConMain < 693) {
  if (lConMain < 560) {
    // mainAd.style.backgroundColor = "red";
    console.log(`kecil${lConMain}`);
    button.style.display = "block";

    if (mainLeft.classList.contains("col-8")) {
      mainLeft.classList.remove("col-8");
      mainRight.classList.remove("col-4");
      mainRight.classList.add("mt-3");
      mainAd.classList.remove("row");
    }

    if (!mainAd.classList.contains("row-cols-1")) {
      mainAd.classList.add("row-cols-1");
    }
    if (!conPko.classList.contains("row-cols-2")) {
      conPko.classList.add("row-cols-2");
      // namePage.classList.add("ms-2");
    }
  } else {
    console.log(`besar ${lConMain}`);
    // mainAd.style.backgroundColor = "blue";
    if (lConMain < 693 || sidebar.style.display === "none") {
      button.style.display = "block";
    } else {
      button.style.display = "none";
    }

    if (mainLeft) {
      if (!mainLeft.classList.contains("col-8")) {
        mainLeft.classList.add("col-8");
        mainRight.classList.add("col-4");
        mainRight.classList.remove("mt-3");

        mainAd.classList.add("row");
      }

      if (mainAd.classList.contains("row-cols-1")) {
        mainAd.classList.remove("row-cols-1");
      }
      if (conPko.classList.contains("row-cols-2")) {
        conPko.classList.remove("row-cols-2");
        // namePage.classList.remove("ms-2");
      }
    }
  }
}

window.addEventListener("DOMContentLoaded", ukurUlang);
window.addEventListener("resize", ukurUlang);

document.addEventListener("DOMContentLoaded", function () {
  var button = document.getElementById("burger-menu");
  // var burgerMenu = document.getElementById("burger-menu");
  button.addEventListener("click", function () {
    button.classList.toggle("close");

    var sidebar = document.getElementById("sidebar");
    const main = document.getElementById("main-pri");
    if (sidebar.style.display === "block") {
      main.style.width = "100%";
      sidebar.style.display = "none";
      setTimeout(ukurUlang, 500);
    } else {
      main.style.width = "calc(100% - 261px)";
      sidebar.style.display = "block";
      // ukurUlang();
      setTimeout(ukurUlang, 500);
    }
  });
});

// xs: 0,
// sm: 576px,
// md: 768px,
// lg: 992px,
// xl: 1200px,
// xxl: 1400px

// window.addEventListener("resize", ukurUlang);
