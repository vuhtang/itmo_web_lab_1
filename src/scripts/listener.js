import bindValidation from "./validator.js";
import listenButtons from "./buttons.js";

function listenUserChanges() {
    listenButtons()
    bindValidation()
}

export default listenUserChanges