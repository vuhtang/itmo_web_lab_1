const form = document.getElementById("shot")
const coordinateY = document.getElementById("y")
const coordinateYWarning = document.getElementById("y_warning")
const coordinateXWarning = document.getElementById("x_warning")
const coordinatesX = document.getElementsByName("x")

let yIsValid = false
checkY()

function checkY(event) {
    let inputValue = parseFloat(coordinateY.value)
    if (Number.isNaN(inputValue) || inputValue < -3 || inputValue > 5) {
        coordinateYWarning.textContent = "(Y must be a number in (-3,5))"
        yIsValid = false
    } else {
        coordinateYWarning.textContent = ""
        yIsValid = true
    }
}

coordinateY.addEventListener("input", checkY)

form.addEventListener("submit", function (event) {
    let xIsValid = false
    coordinatesX.forEach(function (obj) {
        if (!xIsValid) xIsValid = obj.checked
    })
    if (!xIsValid) {
        coordinateXWarning.textContent = "(choose X coordinate)"
        event.preventDefault()
    } else {
        coordinateXWarning.textContent = ""
        if (!yIsValid) {
            coordinateYWarning.textContent = "(Y must be a number in (-3,5))"
            event.preventDefault()
        } else coordinateYWarning.textContent = ""
    }
})
