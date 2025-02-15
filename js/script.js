/*
// page: index.php
document.addEventListener("DOMContentLoaded", function () {
    const fileForm = document.getElementById("fileForm");
    const fileInput = document.getElementById("fileInput");
    const cardsSection = document.getElementById("cardsSection");
    const uploadSection = document.querySelector(".cards");

    cardsSection.style.display = "none";

    fileForm.addEventListener("submit", function (event) {
        event.preventDefault(); 

        if (fileInput.files.length > 0) {
            uploadSection.style.display = "none";
            cardsSection.style.display = "block";
        }
    });
});*/
