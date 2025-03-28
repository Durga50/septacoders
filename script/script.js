const historyIcon = document.querySelector(".history-icon");
const historyModal = document.getElementById("historyModal");
const closeModal = document.querySelector(".close-btn");

historyIcon.addEventListener("click", () => {
    historyModal.classList.add("active");
});

closeModal.addEventListener("click", () => {
    historyModal.classList.remove("active");
});



