/* Gallery pagination ------------------------------------------------ */

    // Define the number of images to show per page
    const imagesPerPage = 9;

    // Get the gallery container and the pagination buttons
    const galleryContainer = document.getElementById('galleryContainer');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    // Get all the gallery images
    const galleryImages = Array.from(document.querySelectorAll('.wrapper'));

    // Calculate the total number of pages
    const totalPages = Math.ceil(galleryImages.length / imagesPerPage);

    // Set the current page to 1
    let currentPage = 1;

    // Function to show the images for the current page
    function showImages() {
        // Calculate the starting and ending indexes for the current page
        const startIndex = (currentPage - 1) * imagesPerPage;
        const endIndex = startIndex + imagesPerPage;

        // Clear the gallery container
        galleryContainer.innerHTML = '';

        // Loop through the images for the current page and append them to the gallery container
        for (let i = startIndex; i < endIndex; i++) {
            const image = galleryImages[i];
            if (image) {
                galleryContainer.appendChild(image.cloneNode(true));
            }
        }
    }

    // Event handler for the previous button click
    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            showImages();
        }
    });

    // Event handler for the next button click
    nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            showImages();
        }
    });

    // Show the initial set of images
    showImages();



    /* Gallery pagination ------------------------------------------------ */