import listenUserChanges from "./listener.js";
import {requestShots} from "./api-functions.js";

document.addEventListener("DOMContentLoaded", () => {
    startApplication()
})

const startApplication = () => {
    requestShots()
    listenUserChanges()
}
