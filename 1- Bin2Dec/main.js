const btnConverter = document.querySelector("fieldset .btn.btn-normal");
const btnInverter = document.querySelector("fieldset .btn.btn-link");

const dataContainer = document.getElementById("data");

let dadoDecimal = document.querySelector('input[name="decimal"]');
let dadoBinario = document.querySelector('input[name="binary"]');

dadoDecimal.addEventListener("onchange", () => {
    validateDecimal(dadoDecimal.value);
});

function validateDecimal(number) {
    if (parseInt(dadoDecimal.value) < 0) {
        dadoDecimal.classList.add("invalido");
        return false;
    } else {
        dadoDecimal.classList.remove("invalido");
        return true;
    }
}

btnConverter.addEventListener("click", (e) => {
    e.preventDefault();
    let a = dataContainer.querySelector("div:first-of-type input");

    if (
        a.getAttribute("id") == "decimal" &&
        validateDecimal(dadoDecimal.value)
    ) {
        toBinary();
    } else {
        console.log("é binário");
    }
});

btnInverter.addEventListener("click", (e) => {
    e.preventDefault();
    dataContainer.insertBefore(
        dataContainer.querySelector("div .column:last-of-type"),
        dataContainer.querySelector("div .column:first-of-type"),
    );
    dadoBinario.value = "";
    dadoDecimal.value = "";
});



function toBinary() {
    let numberToBinary = parseInt(dadoDecimal.value);
    let binario = "";
    while (numberToBinary > 0) {
        // Divide o número decimal por 2 e armazena o resto na variável binário
        binario = (numberToBinary % 2) + binario;
        numberToBinary = Math.floor(numberToBinary / 2);
    }
    dadoBinario.value = "";
    dadoBinario.value = binario;
}

function toDecimal(number) {}