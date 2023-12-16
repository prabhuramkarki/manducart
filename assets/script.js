// for modal popup
let modalBox = document.getElementById("modal-box");
let modalButton = document.getElementById("modal-button");

modalButton.onclick = function () {
  modalBox.classList.add("active");

  setTimeout(() => {
    modalBox.classList.remove("active");
  }, 5000);
};
//end modal

// for history refresh
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}



// for active link 
const currentUrl = window.location.href;
const links = document.querySelectorAll('.link');

links.forEach(link => {
  if (link.href === currentUrl) {
    link.classList.add('active-link');
  }
});