/* side bar change ---------------------------------------------------------------------------------- */

  document.addEventListener('DOMContentLoaded', function() {
  const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
  const currentPage = window.location.pathname.split('/').pop(); // Get the current page URL
console.log(currentPage);
console.log(allSideMenu);
  allSideMenu.forEach(item => {
    const li = item.parentElement;

    if (item.getAttribute('href') === currentPage) {
      li.classList.add('active');
    }

    item.addEventListener('click', function() {
      allSideMenu.forEach(i => {
        i.parentElement.classList.remove('active');
      })
      li.classList.add('active');
    })
  });
});


/* side bar change ends---------------------------------------------------------------------------------- */