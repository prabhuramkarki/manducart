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


// for carasouel
document.addEventListener('DOMContentLoaded', function () {
  var currentIndex = 0;
  var items = document.querySelectorAll('.carousel-item');
  var totalItems = items.length;

  // Auto slide the carousel every 3 seconds
  var autoSlide = setInterval(function () {
      nextSlide();
  }, 3000);

  // Previous button click event
  document.getElementById('prevBtn').addEventListener('click', function () {
      clearInterval(autoSlide);
      prevSlide();
  });

  // Next button click event
  document.getElementById('nextBtn').addEventListener('click', function () {
      clearInterval(autoSlide);
      nextSlide();
  });

  function updateCarousel() {
      document.querySelector('.carousel').style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
  }

  function nextSlide() {
      if (currentIndex < totalItems - 1) {
          currentIndex++;
      } else {
          currentIndex = 0;
      }
      updateCarousel();
  }

  function prevSlide() {
      if (currentIndex > 0) {
          currentIndex--;
      } else {
          currentIndex = totalItems - 1;
      }
      updateCarousel();
  }
});