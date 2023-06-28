// Get the sidebar element
const sidebar = document.getElementById('sidebar');

// Function to handle sidebar item click
function handleSidebarItemClick(event) {
  // Remove the 'active' class from all sidebar items
  const sidebarItems = sidebar.querySelectorAll('.sidebar-item');
  sidebarItems.forEach(item => item.classList.remove('active'));

  // Add the 'active' class to the clicked sidebar item
  const clickedItem = event.target.closest('.sidebar-item');
  clickedItem.classList.add('active');

  // Update the sidebar items on all pages
  const allSidebarItems = document.querySelectorAll('.sidebar-item');
  allSidebarItems.forEach(item => {
    // Update the appearance of the sidebar item based on the clicked item
    // You can modify this part based on your requirements
    if (item === clickedItem) {
      item.classList.add('active');
    } else {
      item.classList.remove('active');
    }
  });

  // Store the selected sidebar item in local storage
  localStorage.setItem('selectedSidebarItem', clickedItem.innerHTML);
}

// Attach the click event listener to each sidebar item
const sidebarItems = sidebar.querySelectorAll('.sidebar-item');
sidebarItems.forEach(item => {
  item.addEventListener('click', handleSidebarItemClick);
});

// Retrieve the selected sidebar item from local storage
const selectedSidebarItem = localStorage.getItem('selectedSidebarItem');
if (selectedSidebarItem) {
  // Find the matching sidebar item and set it as active
  const matchingSidebarItem = Array.from(sidebarItems).find(item => item.innerHTML.includes(selectedSidebarItem));
  if (matchingSidebarItem) {
    matchingSidebarItem.classList.add('active');
  }
}
