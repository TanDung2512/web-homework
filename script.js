
var number = document.getElementById("number").innerHTML

function convertToArray(number){

    var numberArr = number.toString().split()
    return numberArr.reverse().join()
}
document.getElementById("reverse-number").innerHTML = convertToArray(number)
