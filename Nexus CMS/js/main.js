window.onload = function () {
  let w = window.innerWidth;
  if (w <= 788) {
    let sidebar = document.querySelector(".sidebar");
    if (sidebar) {
      sidebar.classList.add("close");
    }
  }
  let u = document.querySelector(".con"); // Added a period (".") to the selector
  if (w <= 788) {
    u.style.display = 'none';
  }
};
window.onresize = function () {
  let w = window.innerWidth;
  if (w <= 788) {
    sidebar.classList.add("close");
  }
};
let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
  });
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

let select = document.getElementById('selectAllBoxes');
select.addEventListener('click', function () {
  if (this.checked) {
    let checkboxes = document.querySelectorAll('.checkBoxes');
    for (let i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = true;
    }
  } else {
    let checkboxes = document.querySelectorAll('.checkBoxes');
    for (let i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = false;
    }
  }
}
);