import listenUserChanges from "./listener.js";
import {requestShots} from "./babah.js";

document.addEventListener("DOMContentLoaded", () => {
    startApplication()
})

const startApplication = () => {
    requestShots()
    listenUserChanges()
}
