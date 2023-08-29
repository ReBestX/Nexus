ScrollReveal().reveal(".post", {
  interval: 16,
  reset: false,
});
ScrollReveal().reveal(".Categories", {
  interval: 16,
  reset: true,
});
ScrollReveal().reveal(".recentPosts", {
  interval: 16,
  reset: true,
});
ScrollReveal().reveal(".sidePost", {
  interval: 16,
  reset: true,
});
ScrollReveal().reveal(".heading h1", {
  interval: 16,
  reset: false,
});
ScrollReveal().reveal(".heading img", {
  interval: 16,
  reset: false,
});
ScrollReveal().reveal(".header", {
  interval: 16,
  reset: true,
});
const allSkeleton = document.querySelectorAll(".skeleton");

window.addEventListener("load", function () {
  allSkeleton.forEach((item) => {
    item.classList.remove("skeleton");
  });
});
// Open and Close Navbar Menu
const navbarMenu = document.getElementById("menu");
const burgerMenu = document.getElementById("burger");
const bgOverlay = document.querySelector(".overlay");

if (burgerMenu && bgOverlay) {
  burgerMenu.addEventListener("click", () => {
    navbarMenu.classList.add("is-active");
    bgOverlay.classList.toggle("is-active");
  });

  bgOverlay.addEventListener("click", () => {
    navbarMenu.classList.remove("is-active");
    bgOverlay.classList.toggle("is-active");
  });
}

// Close Navbar Menu on Links Click
document.querySelectorAll(".menu-link").forEach((link) => {
  link.addEventListener("click", () => {
    navbarMenu.classList.remove("is-active");
    bgOverlay.classList.remove("is-active");
  });
});

// Open and Close Search Bar Toggle
const searchBlock = document.querySelector(".search-block");
const searchToggle = document.querySelector(".search-toggle");
const searchCancel = document.querySelector(".search-cancel");

if (searchToggle && searchCancel) {
  searchToggle.addEventListener("click", () => {
    searchBlock.classList.add("is-active");
  });

  searchCancel.addEventListener("click", () => {
    searchBlock.classList.remove("is-active");
  });
}

// Close Search Bar on ESC Key
document.addEventListener("keydown", (event) => {
  const e = event || window.event;
  if (e.keyCode === 27) {
    searchBlock.classList.remove("is-active");
  }
});

