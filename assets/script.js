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
