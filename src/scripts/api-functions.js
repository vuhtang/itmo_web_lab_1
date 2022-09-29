import {consts} from "../resources/constants.js";
import {BASE_URL} from "./routes.js";

const api = {

    fetchShot: function (x, y, r) {
        let table = consts.table
        let formData = new FormData()
        formData.append('x', x)
        formData.append('y', y)
        formData.append('r', r)
        fetch(BASE_URL + 'server/main.php', {
            method: 'POST',
            mode: 'no-cors',
            body: formData
        }).then(res => res.text()
            .then(strRes => table.insertAdjacentHTML('afterbegin', strRes)))
            .catch(reason => console.log("error :(( " + reason))
    },

    requestShots: function () {
        let table = consts.table
        fetch(BASE_URL + 'server/main.php?action=request', {
            method: 'GET',
            mode: 'no-cors'
        }).then(res => res.text()
            .then(strRes => table.insertAdjacentHTML('afterbegin', strRes)))
            .catch(reason => console.log("error:(( " + reason))
    },

    clearHistory: function () {
        let table = consts.table
        fetch(BASE_URL + 'server/main.php?action=clear', {
            method: 'GET',
            mode: 'no-cors'
        }).then(res => res.text()
            .then(() => table.innerHTML = ""))
            .catch(reason => console.log("error:(( " + reason))
    }
}

export const fetchShot = api.fetchShot
export const requestShots = api.requestShots
export const clearHistory = api.clearHistory