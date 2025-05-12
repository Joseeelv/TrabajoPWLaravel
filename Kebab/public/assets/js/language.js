document.addEventListener("DOMContentLoaded", function () {
    const langBtn = document.getElementById("lang-btn");
    const langDropdown = document.getElementById("lang-dropdown");

    langBtn.addEventListener("click", function () {
        const isVisible = langDropdown.style.display === "block";
        langDropdown.style.display = isVisible ? "none" : "block";
    });

    document.addEventListener("click", function (event) {
        if (
            !langBtn.contains(event.target) &&
            !langDropdown.contains(event.target)
        ) {
            langDropdown.style.display = "none";
        }
    });
});
