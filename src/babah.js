import {consts} from "./resources/constants.js";

const babahers = {

    fetchShot: function (x, y, r) {
        let table = consts.table
        let formData = new FormData()
        formData.append('x', x)
        formData.append('y', y)
        formData.append('r', r)
        fetch('http://localhost:8888/src/server/main.php', {
            method: 'POST',
            mode: 'no-cors',
            body: formData
        }).then(res => res.text()
            .then(strRes => table.insertAdjacentHTML('afterbegin', strRes)))
            .catch(reason => console.log("error :(( " + reason))
    },

    requestShots: function () {
        let table = consts.table
        fetch('http://localhost:8888/src/server/main.php?action=request', {
            method: 'GET',
            mode: 'no-cors'
        }).then(res => res.text()
            .then(strRes => table.insertAdjacentHTML('afterbegin', strRes)))
            .catch(reason => console.log("error:(( " + reason))
    },

    clearHistory: function () {
        let table = consts.table
        fetch('http://localhost:8888/src/server/main.php?action=clear', {
            method: 'GET',
            mode: 'no-cors'
        }).then(res => res.text()
            .then(strRes => table.innerHTML = ""))
            .catch(reason => console.log("error:(( " + reason))
    }
}

export const fetchShot = babahers.fetchShot
export const requestShots = babahers.requestShots
export const clearHistory = babahers.clearHistory