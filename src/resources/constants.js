const constants = {
    form: document.getElementById("shot"),
    table: document.getElementsByTagName('tbody')[0],

    //y
    coordinateY: document.getElementById("y"),
    coordinateYWarning: document.getElementById("y_warning"),

    //x
    coordinateXWarning: document.getElementById("x_warning"),
    coordinatesX: document.getElementsByName("x"),

    //r
    buttonsRVisible: document.getElementsByClassName("r-buttons"),
    currentRVisible: document.getElementById("r_visible"),
    currentRHidden: document.getElementById("r_value"),

    //clear
    clearButton: document.getElementById("clear")
}

export const consts = constants