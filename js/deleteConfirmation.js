/* delete button confirmation box --------------------------------------------------------------------- */

    var adminDeleteBtns = document.querySelectorAll(".adminDeleteBtn");
    var alumniDeleteBtns = document.querySelectorAll(".alumniDeleteBtn");
    var confirmationModalAdmin = document.getElementById("confirmationModalAdmin");
    var confirmationModalAlumni = document.getElementById("confirmationModalAlumni");
    var confirmDeleteBtnAdmin = document.getElementById("confirmDeleteBtnAdmin");
    var confirmDeleteBtnAlumni = document.getElementById("confirmDeleteBtnAlumni");
    var cancelDeleteBtnAdmin = document.getElementById("cancelDeleteBtnAdmin");
    var cancelDeleteBtnAlumni = document.getElementById("cancelDeleteBtnAlumni");

    adminDeleteBtns.forEach(function (deleteBtn) {
        deleteBtn.addEventListener("click", function () {
            confirmationModalAdmin.style.display = "block";
        });
    });

    alumniDeleteBtns.forEach(function (deleteBtn) {
        deleteBtn.addEventListener("click", function () {
            confirmationModalAlumni.style.display = "block";
        });
    });

    confirmDeleteBtnAdmin.addEventListener("click", function () {
        // Close the modal
        confirmationModalAdmin.style.display = "none";
    });

    confirmDeleteBtnAlumni.addEventListener("click", function () {
        // Close the modal
        confirmationModalAlumni.style.display = "none";
    });

    cancelDeleteBtnAdmin.addEventListener("click", function () {
        // Close the modal
        confirmationModalAdmin.style.display = "none";
    });

    cancelDeleteBtnAlumni.addEventListener("click", function () {
        // Close the modal
        confirmationModalAlumni.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target == confirmationModalAdmin) {
            // Close the modal
            confirmationModalAdmin.style.display = "none";
        }

        if (event.target == confirmationModalAlumni) {
            // Close the modal
            confirmationModalAlumni.style.display = "none";
        }
    });


    /* delete button confirmation box --------------------------------------------------------------------- */