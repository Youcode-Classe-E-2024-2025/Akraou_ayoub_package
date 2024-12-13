const addForm = document.querySelector("#addPackageForm");
const addPackageBtn = document.querySelector("#add-package");

addPackageBtn.addEventListener("click", () => addForm.classList.remove("hidden"));

const closeBtn = document.querySelector("#close-btn");
closeBtn.addEventListener("click", closeForm);
function closeForm() {
	addForm.classList.add("hidden");
}
