import {consts} from "../resources/constants.js";
import {clearHistory} from "./api-functions.js";

function listenButtons() {

    let buttons = consts.buttonsRVisible
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', function () {
            consts.currentRHidden.value = buttons[i].value
            consts.currentRVisible.textContent = buttons[i].value
        })
    }

    consts.clearButton.addEventListener('click', function (event) {
        event.preventDefault()
        clearHistory()
    })

}

export default listenButtons