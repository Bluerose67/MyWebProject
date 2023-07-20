// Get the required elements
const addBtn = document.querySelector('.add-button');
const popupContainer = document.getElementById('popup-container');

// Event listener for the "Add new Event" button
addBtn.addEventListener('click', function () {
  popupContainer.style.display = 'block';
});

// Event listener to close the popup if clicked outside
popupContainer.addEventListener('click', function (event) {
  if (event.target === this) {
    popupContainer.style.display = 'none';
  }
});
