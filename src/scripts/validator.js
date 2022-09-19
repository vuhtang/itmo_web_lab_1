import {consts} from "../resources/constants.js";
import {messages} from "../resources/messages.js";
import {fetchShot} from "./api-functions.js";

function bindValidation() {

    consts.coordinatesX.forEach(elem => {
        elem.addEventListener('change', function () {
            consts.coordinateXWarning.textContent = ""
        })
    })

    consts.coordinateY.addEventListener("input", function () {
        let inputValue = consts.coordinateY.value;
        if (!isNumeric(inputValue) || inputValue < -3 || inputValue > 5) {
            consts.coordinateYWarning.textContent = messages['y_warning']['en']
            consts.coordinateY.yIsValid = false
        } else {
            consts.coordinateYWarning.textContent = ""
            consts.coordinateY.yIsValid = true
        }
    })

    consts.form.addEventListener("submit", function (event) {
        event.preventDefault()
        let currXValue
        consts.coordinatesX.forEach(function (obj) {
            if (obj.checked) {
                currXValue = obj.value
            }
        })
        if (!currXValue) {
            consts.coordinateXWarning.textContent = messages['x_warning']['en']
            return
        }
        if (!consts.coordinateY.yIsValid) {
            consts.coordinateYWarning.textContent = messages['y_warning']['en']
            return
        }
        fetchShot(currXValue, consts.coordinateY.value, consts.currentRHidden.value)
    })

}

function isNumeric(value) {
    return !isNaN(value - parseFloat(value));
}

export default bindValidation