document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const toggle = document.getElementById("btnToggleSidebar");

    if (toggle) {
        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("-translate-x-full");
        });
    }
});
