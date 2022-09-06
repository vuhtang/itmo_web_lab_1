const currentRVisible = document.getElementById("r_visible")
const currentRHidden = document.getElementById("r_value")

function setValueR(value) {
    currentRVisible.textContent = value
    currentRHidden.value = value
}